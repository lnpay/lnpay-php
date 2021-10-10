<?php

namespace LNPayClient;

use GuzzleHttp\Client;

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
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function get(string $uri, array $query = [], float $timeOut = 2.0)
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

        $jsonString = "";
        try {
            $request = $client->request('GET', $uri, $options);
            $jsonString = $request->getBody()->getContents();
            $this->status = $request->getStatusCode();
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            // This is will catch all connection timeouts
            $this->status = 'Connection timeout';
        }

        return json_decode($jsonString, false);
    }

    /**
     * Make a POST request to server
     * @param string $uri
     * @param array $params
     * @param float $timeOut
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function post(string $uri, array $params = [], float $timeOut = 2.0)
    {
        $client = new Client([
            'base_uri' => LNPayClient::getEndPointUrl(),
            'timeout' => $timeOut,
        ]);

        $options = [];
        $options['headers'] = $this->getHeaders();
        if ($params) {
            $options['form_params'] = $params;
        }

        $jsonString = "";
        try {
            $request = $client->request('POST', $uri, $options);
            $jsonString = $request->getBody()->getContents();
            $this->status = $request->getStatusCode();
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            // This is will catch all connection timeouts
            $this->status = 'Connection timeout';
        }

        return json_decode($jsonString, false);
    }

    /**
     * Get HTTP headers
     * @return array headers
     * @throws \Exception
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
