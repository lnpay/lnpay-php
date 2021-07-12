<?php

require '../vendor/autoload.php';

use LNPay\LNPayClient;

// Creating Client object
$lnPayClient = new LNPayClient(
    'sak_KEY',
);

/**
 * Gets the invoice information for the `tx_id`
 * @see https://docs.lnpay.co/lntx/
 **/
$response = $lnPayClient->lightingNetworkTx->getInfo('lntx_id');
print_r($response);