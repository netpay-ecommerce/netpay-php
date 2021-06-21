<?php
require 'libs/Smarty.class.php';
require_once('../../init.php');

use \NetPay\NetPayConfig;

$smarty = new Smarty;
//$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = true;
$smarty->cache_lifetime = 120;

$smarty->assign("title", "NetPay Checkout");

define('TEST_MODE', true);
define('PRIVATE_KEY', 'sk_netpay_kdxBjHVQqyXvTNCUPwZYEvDMjtoRspcZCPmexBVaLfJlf');

NetPayConfig::init(TEST_MODE);

if (!empty($_POST['token'])) {
    $token = filter_var ( $_POST['token'], FILTER_SANITIZE_STRING);

    try {
        $installments = 9; //null=no MSI, 3=3 MSI, 6=6 MSI, 9=9 MSI, 12=12 MSI, 18=18 MSI
        $billing = array(
            'billing_city' => 'Panuco',
            'billing_country' => 'MX',
            'billing_first_name' => 'Jhon',
            'billing_last_name' => 'Doe',
            'billing_email' => 'review@netpay.com.mx',//review@netpay.com.mx, accept@netpay.com.mx, reject@netpay.com.mx
            'billing_phone' => '8461234567',
            'billing_postcode' => '93994',
            'billing_state' => 'Veracruz',
            'billing_address_1' => 'Zona Centro 123',
            'billing_address_2' => 'Col Centro',
            'reference' => '12345',
        );
        $shipping = array( //optional, for virtual products it must be empty
            'shipping_city' => 'city',
            'shipping_country' => 'MX',
            'shipping_first_name' => 'Name',
            'shipping_last_name' => 'Last',
            'shipping_phone' => '0987654321',
            'shipping_postcode' => '66478',
            'shipping_state' => 'state',
            'shipping_address_1' => 'address1',
            'shipping_address_2' => 'address2',
            'shipping_method' => 'flat',
        );
        $data = array(
            'description' => 'Cobro de colegiatura',
            'source' => $token,
            'amount' => 900,
            "billing" => \NetPay\NetPayBill::format($billing),
            "shipping" => \NetPay\NetPayShip::format($shipping),
            'redirect3dsUri' => 'http://localhost:8888/netpay-checkout-php/demo/form/checkout.php'
        );

        $checkout = \NetPay\Api\NetPayCheckout::post(PRIVATE_KEY, $data, $installments);
        $transaction_token_id = $checkout['result']['transactionTokenId'];
        $status = \NetPay\Api\NetPayTransaction::get(PRIVATE_KEY, $transaction_token_id);
        if($status['result']['status'] == "DONE") {
            echo json_encode(
                array(
                    "status"=>"DONE", 
                    "result"=>$checkout
                ));
        }
        else if($status['result']['status'] == "REVIEW") {
            echo json_encode(
                array(
                    "status"=>"REVIEW", 
                    "redirect"=>$checkout['result']['returnUrl']
                ));
        }
        else if($status['result']['status'] == "FAILED") {
            echo json_encode(
                array(
                    "status"=>"FAILED", 
                    "result"=>$checkout
                ));
        }
        else if($status['result']['status'] == "REJECTED") {
            echo json_encode(
                array(
                    "status"=>"REJECTED", 
                    "result"=>$checkout
                ));
        }
        else if($status['result']['status'] == "INSECURE") {
            echo json_encode(
                array(
                    "status"=>"INSECURE", 
                    "result"=>$checkout
                ));
        }
    } catch (Exception $e) {
        $description = $e->getMessage();
        echo json_encode(
            array(
                "status"=>"ERROR", 
                "result"=>$description
            ));
    }
}
else if(!empty($_GET['transaction_token'])) {
    $transaction_token = filter_var ( $_GET['transaction_token'], FILTER_SANITIZE_STRING);
    if(!empty($transaction_token)) {
        $status = \NetPay\Api\NetPayTransaction::get(PRIVATE_KEY, $transaction_token);
        if($status['result']['status'] == "CHARGEABLE") {
            $confirm = \NetPay\Api\NetPayConfirm::post(PRIVATE_KEY, $transaction_token);
            echo json_encode(
                array(
                    "status"=>"DONE", 
                    "result"=>$confirm
                ));
        }
        else if($status['result']['status'] == "REJECT") {
            echo json_encode(
                array(
                    "status"=>"REJECT", 
                    "result"=>$checkout
                ));
        }
        else {
            echo json_encode(
                array(
                    "status"=>"REJECT"
                ));
        }
    }
}
else {
    $smarty->display('checkout.tpl');
}
