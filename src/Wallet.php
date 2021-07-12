<?php

namespace LNPayClient;

/**
 * Class Wallet
 * @see https://docs.lnpay.co
 * @package LNPay
 */
class Wallet extends Request
{
    /**
     * Set the Access key
     * @param string $walletAccessKey Access key for a specific wallet.
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
     * Create a wallet
     * @see https://docs.lnpay.co/wallet/create-wallet
     * @param array $params
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $params): string
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet',
                $params
            );
    }

    /**
     * Get the wallet object which includes current balance.
     * @see https://docs.lnpay.co/wallet/get-balance
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBalance(): string
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->get('wallet/' . LNPayClient::getWalletAccessKey());
    }

    /**
     * Get a list of wallet transactions that have been SETTLED. This includes only transactions that have an impact
     * on wallet balance. These DO NOT include unsettled/unpaid invoices.
     * @see https://docs.lnpay.co/wallet/get-transactions
     * @return string List of wallet transactions
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTransactions(): string
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->get('wallet/' . LNPayClient::getWalletAccessKey()."/transactions");
    }

    /**
     * Generates an invoice for this wallet
     * @see https://docs.lnpay.co/wallet/generate-invoice
     * @param array $params Array representing an invoice request. Example: `{'num_satoshis': 2,'memo': 'Tester'}`
     * @return string LnTx Object (https://docs.lnpay.co/lntx/)
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createInvoice(array $params): string
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet/' . LNPayClient::getWalletAccessKey()."/invoice",
                $params
            );
    }

    /**
     * Pay a LN invoice from the specified wallet.
     * @see https://docs.lnpay.co/wallet/pay-invoice
     * @param array $params Array representing an invoice payment request. Example: `{'payment_request': 'ln....'}`
     * @return string Returns invoice payment information if successful or a specific error
     * directly from the Lightning Node.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function payInvoice(array $params): string
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet/' . LNPayClient::getWalletAccessKey()."/withdraw",
                $params
            );
    }

    /**
     * Transfer satoshis from source wallet to destination wallet.
     * @see https://docs.lnpay.co/wallet/transfers-between-wallets
     * @param array $params Array representing a transfer request.
     * Example: `{'dest_wallet_id': 'w_XXX','num_satoshis': 1,'memo': 'Memo'}`
     * @return string Transfer execution information.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function internalTransfer(array $params): string
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet/' . LNPayClient::getWalletAccessKey()."/transfer",
                $params
            );
    }

    /**
     * Generate an LNURL-withdraw link.
     * Note: These LNURLs are ONE-TIME use. This is to prevent repeated access to the wallet.
     * @see https://docs.lnpay.co/wallet/lnurl-withdraw
     * @param array $params Array representing a lnurl withdraw request. Example: `{'num_satoshis': 1,'memo': 'SatsBack'}`
     * @return string Generated lnurl object.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLnUrl(array $params): string
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet/' . LNPayClient::getWalletAccessKey()."/lnurl/withdraw",
                $params
            );
    }
}
