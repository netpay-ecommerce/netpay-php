<?php
require_once ('../init.php');

use \NetPay\Config;
Config::init();

try {
    $data = array(
        'userName' => Config::$USER_NAME,
        'password' => Config::$PASS,
    );

    $login = \NetPay\Api\Login::post($data);
    $jwt = $login['result']['token'];

    if(!empty($_GET['transactionToken'])) { //Si trae valor, es porque se ejecutó el callback
        $transactionToken = filter_var ( $_GET['transactionToken'], FILTER_SANITIZE_STRING);
        if(!empty($transactionToken)) {
            $status = \NetPay\Api\Transaction::get($jwt, $transactionToken, Config::$STORE_ID_ACQ);
            if($status['result']['transaction']['status'] === 'REJECT') {
                echo "La transacción ha sido rechazada.";
            }
            else if($status['result']['transaction']['status'] === 'DONE') {
                echo "Se aprobó la transacción.";
            }
            else {
                echo "Falló la transacción.";
            }
            return;
        }
    }

    if ($jwt === false) {
        print_r($login);
        return false;
    }

    $mdds[] = array(
        "id" => 0,
        "value" => 'dummy',
    );
    $shipping_method = 'flatrate_flatrate'; //flatrate_flatrate, free_shipping, local_pickup
    $billing = array(
        'billing_city' => 'Pánuco',
        'billing_country' => 'MX',
        'billing_first_name' => 'Jhon',
        'billing_last_name' => 'Doe',
        'billing_email' => 'reject@netpay.com.mx',
        'billing_phone' => '8461234567',
        'billing_postcode' => '93994',
        'billing_state' => 'Veracruz',
        'billing_address_1' => 'Zona Centro 123',
        'billing_address_2' => 'Col Centro',
        'customer_ip_address' => '127.0.0.1',
    );
    $shipping = array(//optional, for virtual products it must be empty
        'shipping_city' => '',
        'shipping_country' => '',
        'shipping_first_name' => '',
        'shipping_last_name' => '',
        'shipping_phone' => '',
        'shipping_postcode' => '',
        'shipping_state' => '',
        'shipping_address_1' => '',
        'shipping_address_2' => '',
        'shipping_method' => '',
    );
    $itemList[] = array(
        'product_id' => '1',
        'sku' => 'CELAZU128GB',
        'price' => '7500.00',
        'name' => 'Celular android color azul 128 GB',
        'qty' => '1',
        'code' => 'CEL128',
    );

    $fields = array(
        "store_customer" => Config::$STORE_ID_ACQ,
        "promotion" => '000000',
        "order_id" => '12345',
        "bill" => \NetPay\Billing::format($billing),
        "ship" => \NetPay\Shipping::format($shipping),
        "itemList" => \NetPay\ItemList::format($itemList),
        "total" => '7500.00',
        "currency" => 'MXN',
    );
    $transType = 'Auth'; //Auth, PreAuth
    $cardType = '001'; //001, 002, 003 //optional
    $checkout = \NetPay\Api\Checkout::post($jwt, $fields, $mdds, $transType, $cardType );
    
    if($checkout['result']['responseCode'] == '200' && $checkout['result']['response']['status'] == 'OK')
    {
        $checkout_token_id = $checkout['result']['response']['checkoutTokenId'];
        $web_authorizer_url = $checkout['result']['response']['webAuthorizerUrl'];
        
        $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
        $merchantResponseURL = urlencode(base64_encode($protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']));
        ?>
        <form action="<?php echo $web_authorizer_url . '?checkoutTokenId=' . $checkout_token_id . "&MerchantResponseURL=" . $merchantResponseURL; ?>" method="post">
            <input type="hidden" name="jwt" id="np-payment-jwt" value="<?php echo $jwt; ?>">
            <input type="submit" value="Pagar con NetPay">
        </form>
        <?php
    }
    else
    {
        echo "entra";
        print_r($checkout);
    }

} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>