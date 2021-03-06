<?php
require_once ('../init.php');

use \NetPay\NetPayConfig;

define('TEST_MODE', true);
define('PRIVATE_KEY', 'sk_netpay_kdxBjHVQqyXvTNCUPwZYEvDMjtoRspcZCPmexBVaLfJlf');

NetPayConfig::init(TEST_MODE);

try {
    $transaction_token_id = '11b171b3-5fea-4949-90f6-36d0fff7bce8';

    $status = \NetPay\Api\NetPayTransaction::get(PRIVATE_KEY, $transaction_token_id);
    print_r($status);
} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
?>