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

    $create_api_key = \NetPay\Api\CreateApiKey::post($jwt);
    print_r($create_api_key);
} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>