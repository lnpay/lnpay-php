<?php
require '../vendor/autoload.php';

use LNPay\LNPayClient;

// Creating Client object
$lnPayClient = new LNPayClient(
    'sak_KEY',
    'waka_KEY'
);

/**
 * Create a wallet
 * @see https://docs.lnpay.co/wallet/create-wallet
 **/
$response = $lnPayClient->wallet->create(array(
        'user_label' => 'My New Wallet'
    ));
print_r($response);

/**
 * Get the wallet object which includes current balance.
 * @see https://docs.lnpay.co/wallet/get-balance
 **/
$response = $lnPayClient->wallet->getBalance();
print_r($response);

/**
 * Get a list of wallet transactions that have been SETTLED.
 * @see https://docs.lnpay.co/wallet/get-transactions
 **/
$response = $lnPayClient->wallet->getTransactions();
print_r($response);

/**
 * Generates an invoice for this wallet
 * @see https://docs.lnpay.co/wallet/generate-invoice
 **/
$response = $lnPayClient->wallet->createInvoice(array(
        "num_satoshis" => "2",
        "meno" => "Tester",
    ));
print_r($response);

/**
 * Pay a LN invoice from the specified wallet.
 * @see https://docs.lnpay.co/wallet/pay-invoice
 **/
$response = $lnPayClient->wallet->payInvoice(array(
        "payment_request" => "2"
    ));
print_r($response);

/**
 * Transfer satoshis from source wallet to destination wallet.
 * @see https://docs.lnpay.co/wallet/transfers-between-wallets
 **/
$response = $lnPayClient->wallet->internalTransfer(array(
        "num_satoshis" => 1,
        "Memo" => "SateBack",
    ));
print_r($response);

/**
 * Generate an LNURL-withdraw link.
 * @see https://docs.lnpay.co/wallet/lnurl-withdraw
 **/
$response = $lnPayClient->wallet->internalTransfer(array(
        "num_satoshis" => 1,
        "Memo" => "SateBack",
    ));
print_r($response);


