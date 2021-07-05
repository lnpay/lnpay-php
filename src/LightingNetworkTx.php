<?php

namespace LNPay;

use LNPay\Request;

/**
 * Class LightingNetworkTx
 * @package LNPay
 */
class LightingNetworkTx extends Request
{
    /**
     * @param string $transactionID
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInfo(string $transactionID): string
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->get('lntx/' . $transactionID);
    }
}
