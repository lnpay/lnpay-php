<?php

namespace LNPayClient;

/**
 * Class Wallet
 * @see https://docs.lnpay.co/api/wallets
 * @package LNPayClient
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
     * Create a new wallet and corresponding access keys
     * @see https://docs.lnpay.co/api/wallets/create
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $params)
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
     * @see https://docs.lnpay.co/api/wallets/retrieve
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInfo()
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->get('wallet/' . LNPayClient::getWalletAccessKey());
    }

    /**
     * Creating an invoice returns the LNPay representation of a BOLT11 invoice - the LnTx object
     * @see https://docs.lnpay.co/api/wallet-transactions/generate-invoice
     * @param array $params Array representing an invoice request. Example: `{'num_satoshis': 2,'memo': 'Tester'}`
     * @return mixed - LnTx Object (https://docs.lnpay.co/lntx/)
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function generateInvoice(array $params)
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet/' . LNPayClient::getWalletAccessKey() . '/invoice',
                $params
            );
    }

    /**
     * Pay a LN invoice from the specified wallet.
     * @see https://docs.lnpay.co/api/wallet-transactions/pay-invoice
     * @param array $params Array representing an invoice payment request. Example: `{'payment_request': 'ln....'}`
     * @return mixed - Returns invoice payment information if successful or a specific error
     * directly from the Lightning Node.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function payInvoice(array $params)
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet/' . LNPayClient::getWalletAccessKey() . '/withdraw',
                $params
            );
    }

    /**
     * Transfer satoshis from source wallet to destination wallet.
     * @see https://docs.lnpay.co/api/wallet-transactions/transfers
     * @param array $params Array representing a transfer request.
     * Example: `{'dest_wallet_id': 'w_XXX','num_satoshis': 1,'memo': 'Memo'}`
     * @return mixed - Transfer execution information.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function transfer(array $params)
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet/' . LNPayClient::getWalletAccessKey() . '/transfer',
                $params
            );
    }

    /**
     * Generate an LNURL-withdraw link.
     * Note: These LNURLs are ONE-TIME use. This is to prevent repeated access to the wallet.
     * @see https://docs.lnpay.co/api/lnurl-withdraw/disposable-lnurl-withdraw
     * @param array $params Array representing a lnurl withdraw request. Example:`{'num_satoshis': 1,'memo': 'SatsBack'}`
     * @return mixed - Generated lnurl object.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function disposableLnUrlWithdraw(array $params)
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet/' . LNPayClient::getWalletAccessKey() . '/lnurl/withdraw',
                $params
            );
    }

    /**
     * Static LNURL-withdraw provides an LNURL tied to a wallet that will always be active.
     * This will allow direct withdraw access to the wallet at all times.
     * @see https://docs.lnpay.co/api/lnurl-withdraw/permanent-lnurl-withdraw
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function permanentLnUrlWithdraw(array $params)
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->post(
                'wallet/' . LNPayClient::getWalletAccessKey() . '/lnurl/withdraw-static',
                $params
            );
    }

    /**
     * Initiate a keysend payment from your wallet to a destination pubkey
     * @see https://docs.lnpay.co/api/wallet-transactions/keysend
     * @param array $params
     * @param bool $makeAsynchronousRequest
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function keysend(array $params, bool $makeAsynchronousRequest = false)
    {
        $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey());

        if ($makeAsynchronousRequest) {
            $this->setHeaders('X-LNPAY-ASYNC', 1);
        }
        return $this->post(
            'wallet/' . LNPayClient::getWalletAccessKey() . '/keysend',
            $params
        );
    }
}
