<?php

namespace LNPayClient;

use GuzzleHttp\Client;

use function PHPUnit\Framework\throwException;

/**
 * Class Request
 * @package LNPayClient
 */
class Request
{
    /**
     * HTTP headers
     * @var array
     */
    protected $headers = [];

    /**
     * @var http response code
     */
    protected $status;

    /**
     * Make a GET request to server
     * @param string $uri
     * @param array $query
     * @param float $timeOut
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function get(string $uri, array $query = [], float $timeOut = 2.0): string
    {
        $client = new Client([
            'base_uri' => LNPayClient::getEndPointUrl(),
            'timeout' => $timeOut,
        ]);

        $options = [];
        $options['headers'] = self::getHeaders();
        if ($query) {
            $options['query'] = $query;
        }

        try {
            $request = $client->request('GET', $uri, $options);
            $this->status = $request->getStatusCode();
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            // This is will catch all connection timeouts
            return 'Connection timeout';
        }

        return $request->getBody()->getContents();
    }

    /**
     * Make a POST request to server
     * @param string $uri
     * @param array $params
     * @param float $timeOut
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function post(string $uri, array $params = [], float $timeOut = 2.0): string
    {
        $client = new Client([
            'base_uri' => LNPayClient::getFullUrl($uri),
            'timeout' => $timeOut,
        ]);

        $options = [];
        $options['headers'] = $this->getHeaders();
        if ($params) {
            $options['form_params'] = $params;
        }

        try {
            $request = $client->request('POST', $uri, $options);
            $this->status = $request->getStatusCode();
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            // This is will catch all connection timeouts
            return 'Connection timeout';
        }

        return $request->getBody()->getContents();
    }

    /**
     * Get HTTP headers
     * @return array headers
     */
    public function getHeaders(): array
    {
        if (isset(self::$headers['X-Api-Key']) && !empty(self::$headers['X-Api-Key'])) {
            throw new \Exception("'No account public key specified!");
        }

        if (isset(self::$headers['X-LNPay-sdk']) && !empty(self::$headers['X-LNPay-sdk'])) {
            throw new \Exception("'No wallet access key specified!");
        }
        return $this->headers;
    }

    /**
     * Set HTTP headers
     * @param string $key
     * @param string $value
     * @return Request
     */
    public function setHeaders(string $key, string $value): Request
    {
        $this->headers[$key] = $value;
        return $this;
    }

    /**
     * @return String
     */
    public function getStatus()
    {
        return $this->status;
    }
}
