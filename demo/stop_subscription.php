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

    $subscription_id = 'Tk66de_DgwD7v1pVHERn4_YVWSFkEL';

    $response = \NetPay\Api\Subscription::stop($jwt, $subscription_id);
    print_r($response);
} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>