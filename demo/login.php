<?php
require_once ('../init.php');

use \NetPay\Config;

try {
    $data = array(
        'userName' => Config::USER_NAME,
        'password' => Config::PASS,
    );

    $login = \NetPay\Api\Login::post($data);
    echo $login['result']['token'];
} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>