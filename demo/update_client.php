<?php
require_once ('../init.php');

use \NetPay\Config;
Config::init();

try {
    $data = array(
        'userName' => Config::$USER_NAME,
        'password' => Config::$PASS,
        'storeIdAdq' => Config::$STORE_ID_ACQ
    );

    $login = \NetPay\Api\Login::post($data);
    $jwt = $login['result']['token'];

    if ($jwt === false) {
        print_r($login);
        return false;
    }

    $data = array(
        'name' => 'Jhon Doe',
        'email' => 'ecommerce@netpay.com.mx',
        'phone' => '1234567890',
    );

    $response = \NetPay\Api\Client::post($jwt, $data);
    print_r($response);
} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>