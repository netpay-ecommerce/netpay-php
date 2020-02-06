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

    $transaction_token_id = '5e2a57e1-5321-4b98-9e37-fe78951fa610';
    $grandTotalAmount = 7500; //optional
    $transactionType = 'Auth'; //Auth, PreAuth, PostAuth

    $status = \NetPay\Api\Charge::post($jwt, $transaction_token_id, $grandTotalAmount, $transactionType);
    print_r($status);
} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>