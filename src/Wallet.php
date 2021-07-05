<?php

namespace LNPay;

/**
 * Class Wallet
 * @package LNPay
 */
class Wallet extends Request
{
    /**
     * @param string $walletAccessKey
     * @return $this
     */
    public function setWalletAccessKey(string $walletAccessKey = ''): Wallet
    {
        if (!empty($walletAccessKey)) {
            LNPayClient::setWalletAccessKey($walletAccessKey);
        }
        return $this;
    }

    /**
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $params): \Psr\Http\Message\ResponseInterface
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet',
                $params
            );
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBalance(): \Psr\Http\Message\ResponseInterface
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->get('wallet/' . LNPayClient::getWalletAccessKey());
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTransactions(): \Psr\Http\Message\ResponseInterface
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->get('wallet/' . LNPayClient::getWalletAccessKey()."/transaction");
    }

    /**
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createInvoice(array $params): \Psr\Http\Message\ResponseInterface
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet/' . LNPayClient::getWalletAccessKey()."/invoice",
                $params
            );
    }

    /**
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function payInvoice(array $params): \Psr\Http\Message\ResponseInterface
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet/' . LNPayClient::getWalletAccessKey()."/withdraw",
                $params
            );
    }

    /**
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function internalTransfer(array $params): \Psr\Http\Message\ResponseInterface
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet/' . LNPayClient::getWalletAccessKey()."/transfer",
                $params
            );
    }

    /**
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLnUrl(array $params): \Psr\Http\Message\ResponseInterface
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet/' . LNPayClient::getWalletAccessKey()."/transfer",
                $params
            );
    }
}
