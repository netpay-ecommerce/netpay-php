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
        'billing_email' => 'review@netpay.com.mx',
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
        "storeApiKey" => 'oe1206Pv!VvBEG73F3HVllLd7K_9F2!K',
        "promotion" => '000000',
        "order_id" => '12345',
        "deviceFingerprintID" => 'fea7f7888a184a10ae2820969ef3062a',
        "cardToken" => 'VW2FdHVU6BXGoiR99teVRNLK8lBK/6vMkVoY4LNi2O2cey0It99AuG/SlBakT6gC6HfamF/4O0MU9gGrhnIuIfki/u7q0ljC+VHyTkNA41w=',
        "bill" => \NetPay\Billing::format($billing),
        "ship" => \NetPay\Shipping::format($shipping),
        "itemList" => \NetPay\ItemList::format($itemList),
        "total" => '7500.00',
        "currency" => 'MXN',
    );

    $risk_manager = \NetPay\Api\RiskManager::post($jwt, $fields, $mdds);

    if($risk_manager['result']['status'] === 'REVIEW') {
        $transactionTokenId = $risk_manager['result']['transactionTokenId'];
        /**
         * Agregar el parametro webHook en la url, que es la url de callback de la respuesta del 3ds
         */
        $webHook = '?webHook=https://www.netpay.mx';
        $authUrl = $risk_manager['result']['threeDSecureResponse']['authUrl'] . $webHook;
        header('Location: '.$authUrl);

        /**
         * respuesta:
         * https://netpay.mx/?transaction_token=9376c85c-1143-413b-b44a-1bac48b7712b
         * El valor de transaction_token que se obtiene por parametro get
         * se debera de ejecutar el ejemplo status para validar el estatus de la transacción
         * si la el estatus es REJECT, la transacción fué rechazada y se termina el flujo,
         * si el estatus es CHARGEABLE, se deberá de ejecutar el ejemplo charge para procesar el pago
       */ 
    }

} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>