<?php

namespace LNPayClient;

/**
 * Class WalletTransaction
 * @see https://docs.lnpay.co/api/wallets
 * @package LNPayClient
 */
class WalletTransaction extends Request
{
    /**
     * Set the Access key
     * @param string $walletAccessKey Access key for a specific wallet.
     * @return $this
     */
    public function setWalletAccessKey(string $walletAccessKey = ''): self
    {
        if (!empty($walletAccessKey)) {
            LNPayClient::setWalletAccessKey($walletAccessKey);
        }
        return $this;
    }

    /**
     * Get transactions for a particular wallet.
     * @see https://docs.lnpay.co/api/wallets/list-transactions
     * @return mixed - List of wallet transactions
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWalletTransactions()
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->get('wallet/' . LNPayClient::getWalletAccessKey() . '/transactions');
    }

    /**
     * Get a list of all transactions across all wallets
     * @see https://docs.lnpay.co/api/wallets/list-all-transactions
     * @return mixed - List of wallet all transactions
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllTransactions()
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->get('wallet-transactions');
    }

}
