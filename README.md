# NetPay PHP bindings

You can sign up for a NetPay account at https://manager.netpay.com.mx.

## Minimum Requirements

PHP 5.4.0 and later.


## Manual Installation

If you do not wish to use Composer, you can download the [latest release](https://github.com/netpay-ecommerce/netpay-php/releases). Then, to use the bindings, include the `init.php` file.

```php
require_once('/path/to/netpay-php/init.php');
```

## Getting Started

Tokenization:
https://docs.netpay.com.mx/reference/sin-guardar-tarjeta#1-tokenizar-tarjeta-2

Sample code:

```php
require_once('../../init.php');

use \NetPay\NetPayConfig;

define('TEST_MODE', true);
define('PRIVATE_KEY', 'sk_netpay_lyNzonHFhwqoMHXfMFmOILqgZjAAjUVOjisfSkikPkrDA');

NetPayConfig::init(TEST_MODE);

try {
    $installments = 3; //null=no MSI, 3=3 MSI, 6=6 MSI, 9=9 MSI, 12=12 MSI, 18=18 MSI
    $billing = array(
        'billing_city' => 'Panuco',
        'billing_country' => 'MX',
        'billing_first_name' => 'Jhon',
        'billing_last_name' => 'Doe',
        'billing_email' => 'accept@netpay.com.mx',
        'billing_phone' => '8461234567',
        'billing_postcode' => '93994',
        'billing_state' => 'Veracruz',
        'billing_address_1' => 'Zona Centro 123',
        'billing_address_2' => 'Col Centro',
        'reference' => '12345',
    );
    $shipping = array( //optional, for virtual products it must be empty
        'shipping_city' => 'city',
        'shipping_country' => 'MX',
        'shipping_first_name' => 'Name',
        'shipping_last_name' => 'Last',
        'shipping_phone' => '0987654321',
        'shipping_postcode' => '66478',
        'shipping_state' => 'state',
        'shipping_address_1' => 'address1',
        'shipping_address_2' => 'address2',
        'shipping_method' => 'flat',
    );
    $data = array(
        'description' => 'Cobro de colegiatura',
        'source' => 'token_AyRPMSxsOpIsEaoYywLQEQyrccUVrRLzoaPNrsic',
        'amount' => 300,
        "billing" => \NetPay\NetPayBill::format($billing),
        "shipping" => \NetPay\NetPayShip::format($shipping),
        'redirect3dsUri' => 'https://netpay.mx'
    );

    $checkout = \NetPay\Api\NetPayCheckout::post(PRIVATE_KEY, $data, $installments);
    print_r($checkout);
} catch (Exception $e) {
    $description = $e->getMessage();
    echo $description;
}
```

## Documentation

Please see https://docs.netpay.com.mx/reference/sin-guardar-tarjeta#31-pago-2 for up-to-date documentation.

## Custom Request Timeouts

*NOTE:* We do not recommend decreasing the timeout for non-read-only calls (e.g. charge creation), since even if you locally timeout, the request on NetPay's side can still complete.

File lib/NetPayConfig.php

```php
//-- General settings
const CURLOPT_TIMEOUT = 40; //Timeout in seconds
```

File lib/NetPay/Api/Curl.php

```php
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, strlen($fields_string));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_ENCODING, "gzip, deflate");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, Config::$CURLOPT_TIMEOUT);
curl_setopt($ch, CURLOPT_TIMEOUT, Config::$CURLOPT_TIMEOUT);
```