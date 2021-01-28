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

    $webhook_id = 1;
    $data = array(
        'webhook' => 'http://localhost:8080/wordpress-4.9.10/index.php?charitable-listener=netpay&recurring=true',
    );

    $response = \NetPay\Api\Webhook::put($jwt, $data, $webhook_id);
    print_r($response);
} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>