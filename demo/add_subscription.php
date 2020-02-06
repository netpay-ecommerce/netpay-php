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

    $today = date("Y-m-d");
    $tomorrow = date('Y-m-d', strtotime($today . ' +1 day'));
    $data = array(
        'billingStart' => $today,
        'deviceFingerprintID' => '086e46a7d7b0d22a8966feed39eefd1c881507939638',
        'merchantReferenceCode' => '12345',
        'plan' => 'zvbE=XfX3Q7EX2Tuxzn1sGyZjNJYjN',
        'storeToken' => 'VW2FdHVU6BXGoiR99teVRHfGUbpOrlKyG/ER2e7T2C3r1xPr1SCXg10xx3iFymW9QTKCVuZoHSArw9odxWPiX547U0HaiSaj0kbEpRZLjTk=',
        'client' => '2i8Z42utJO5he4ubTwSufL=UxQqn_p',
    );

    $response = \NetPay\Api\Subscription::post($jwt, $data);
    print_r($response);
} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>