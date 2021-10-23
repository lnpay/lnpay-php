[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

# lnpay-php
The LNPay PHP library provides convenient access to the LNPay API from PHP applications.

The Api follows the following practices:
- Namespaced under LNPayClient
- Call $api->class->function() to access the API
- API throws exceptions instead of returning errors
- Options are passed as an array instead of multiple arguments wherever possible.
- All requests and responses will be communicated over JSON
    
## Requirements
- PHP 7.3.0 or higher.
- Extensions - curl, json and mbstring

## Installation via composer
Run in console below command to download package to your project:
```
composer require lnpay/lnpay-php
```

## Installation Manually
To manually install the library, you can download the latest release. Then, include the init.php file.
```
require_once('/path/to/lnpay-php/init.php');
```

## Documentation
The first alpha version of this SDK is mainly a wrapper for the [LNPay API](https://docs.lnpay.co/)

## Setup
```
// For Composer

// Load the autoload file from composer's vendor directory
require '../vendor/autoload.php';

use LNPayClient\LNPayClient;

// Creating Client object
$lnPayClient = new LNPayClient(
        'sak_KEY'
    );

```
```
// For Manual

require 'init.php';

use LNPayClient\LNPayClient;

// Creating Client object
$lnPayClient = new LNPayClient(
        'sak_KEY'
    );

```
```
// Wallet Access Key setup if not added while LNPayClient object creationation.

$lnPayClient->wallet->setWalletAccessKey('wal_KEY');
```

## Usage
Follow the instruction given SetUp section and initialize the LNPayClient.

### Check Balance
```
$response = $lnPayClient->wallet->getInfo();
print_r($response);
```

### Create a wallet
```
$response = $lnPayClient->wallet->create(array(
        'user_label' => 'My New Wallet'
    ));
print_r($response);
```

### Generate Invoice
```
$response = $lnPayClient->wallet->createInvoice(array(
        "num_satoshis" => "2",
        "memo" => "Tester",
    ));
print_r($response);
```

### Pay Invoice
```
$response = $lnPayClient->wallet->payInvoice(array(
        "payment_request" => "lnXXXX"
    ));
print_r($response);
```

### Transfers between wallets
```
$response = $lnPayClient->wallet->transfer(array(
        "num_satoshis" => 1,
        "memo" => "SateBack",
    ));
print_r($response);
```

### Get Wallet Transactions
```
$response = $lnPayClient->walletTransaction->getWalletTransactions();
print_r($response);
```

### Get Transaction Info
```
$response = $lnPayClient->lightingNetworkTx->getInfo('lntx_id');
print_r($response);
```

### Generate a disposable LNURL-withdraw link. 
```
$response = $lnPayClient->wallet->disposableLnUrlWithdraw(['num_satoshis'=> 1, 'memo'=> '1 sat over LNURL once']);
print_r($response);
```

### Generate a permanent LNURL-withdraw link. 
```
$response = $lnPayClient->wallet->permanentLnUrlWithdraw(['num_satoshis'=> 1, 'memo'=> '1 sat over LNURL again and again']);
print_r($response);
```

See the [example files](examples).

