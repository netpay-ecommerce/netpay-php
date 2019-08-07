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
        'name' => 'nuevo',
        'amount' => 10,
        'currency' => 'MXN',
        'interval' => 'MONTHLY',
        'frecuency' => 1,
        'trialDays' => 0,
        'expiryCount' => 12,
    );

    $response = \NetPay\Api\Plan::post($jwt, $data);
    print_r($response);
} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>