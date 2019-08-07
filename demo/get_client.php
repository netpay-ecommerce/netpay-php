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

    $client_id = 'cb!_P!Kd0s5W4SG6psp1sNPANX=NWX';
    $response = \NetPay\Api\Client::get_client($jwt, $client_id);
    print_r($response);
} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>