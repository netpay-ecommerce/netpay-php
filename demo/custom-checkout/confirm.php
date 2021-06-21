<?php
require_once ('../init.php');

use \NetPay\NetPayConfig;

define('TEST_MODE', true);
define('PRIVATE_KEY', 'sk_netpay_kdxBjHVQqyXvTNCUPwZYEvDMjtoRspcZCPmexBVaLfJlf');

NetPayConfig::init(TEST_MODE);

try {
    $transaction_token_id = '8f0da36c-91a2-48c6-9109-c31eab630f62';

    $confirm = \NetPay\Api\NetPayConfirm::post(PRIVATE_KEY, $transaction_token_id);
    print_r($confirm);
} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>