<?php
require_once ('../init.php');

use \NetPay\Config;

try {
    $data = array(
        'userName' => Config::USER_NAME,
        'password' => Config::PASS,
    );

    $login = \NetPay\Api\Login::post($data);
    $jwt = $login['result']['token'];

    if ($jwt === false) {
        print_r($login);
        return false;
    }

    $data = array(
        'webhook' => 'http://localhost:8080/wordpress-4.9.10/index.php?charitable-listener=netpay&recurring=true',
    );

    $response = \NetPay\Api\Webhook::post($jwt, $data);
    print_r($response);
} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>