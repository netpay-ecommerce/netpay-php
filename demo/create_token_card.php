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
        'username' => 'ecommerce@netpay.com.mx',
        'storeApiKey' => 'afmPOLMF0U4Fl=hqYVdOK=Cx0e0LMfEB',
        'customerCard' => array(
            'cardNumber' => '4000000000000002',
            'expirationMonth' => '01',
            'expirationYear' => '24',
            'cvv' => '123',
            'cardType' => '001',
            'cardHolderName' => 'John Doe'
        )
    );

    $create_token_card = \NetPay\Api\CreateTokenCard::post($jwt, $data);
    print_r($create_token_card);
} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>