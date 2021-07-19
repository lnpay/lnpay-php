<?php
/**
 * Author: Bapi Roy <mail2bapi@astrosoft.co.in>
 * Date: 18/07/21
 * Time: 5:08 PM
 **/

namespace LNPayClient;


/**
 * Class LnNode
 * @see https://docs.lnpay.co/api/lightning-network-nodes
 * @package LNPayClient
 */
class LnNode extends Request
{
    /**
     * Probe a route to see the fee and if the destination pubkey is reachable
     * @param string $pubKey
     * @param float $amount
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getQueryRoutes(string $pubKey, float $amount): string
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->get(
                'node/default/payments/queryroutes',
                [
                    'pub_key' => $pubKey,
                    'amt' => $amount,
                ]
            );
    }

    /**
     * Decode an invoice and get route hints. Uses LNPay.co node
     * @param string $paymentRequest
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function decodeInvoice(string $paymentRequest): string
    {
        return $this->setHeaders('X-LNPay-sdk', LNPayClient::showVersion())
            ->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey())
            ->get(
                'node/default/payments/decodeinvoice',
                ['payment_request' => $paymentRequest]
            );
    }
}
