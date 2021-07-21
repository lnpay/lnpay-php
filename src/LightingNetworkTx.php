<?php

namespace LNPayClient;

/**
 * Class LightingNetworkTx
 * @see https://docs.lnpay.co/api/lntx
 * @package LNPayClient
 */
class LightingNetworkTx extends Request
{
    /**
     *  Gets the invoice information for the `tx_id`
     *
     * @param string $transactionID
     * @return string LnTx (Lightning Invoice)
     * @see https://docs.lnpay.co/api/lntx/retrieve
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInfo(string $transactionID): string
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->get('lntx/' . $transactionID);
    }
}
