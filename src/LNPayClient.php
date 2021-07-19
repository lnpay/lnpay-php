<?php

namespace LNPayClient;

/**
 * Class LNPayClient
 * @package LNPayClient
 */
class LNPayClient extends Request
{
    /**
     * CLient's version
     */
    protected const VERSION = "0.1.1";
    /**
     * API Major version
     */
    protected const API_VERSION = "v1";

    /**
     * Base URL with API version
     * @var string
     */
    protected static $endPointUrl = "https://api.lnpay.co/" . self::API_VERSION . '/';
    /**
     * @var string
     */
    protected static $walletAccessKey;
    /**
     * @var string
     */
    protected static $publicApiKey;
    /**
     * @var mixed
     */
    private $lightingNetworkTx;
    /**
     * @var mixed
     */
    private $wallet;
    /**
     * @var mixed
     */
    private $lnNode;
    /**
     * @var mixed
     */
    private $paywall;

    /**
     * LNPayClient constructor.
     * @param string $publicApiKey
     * @param string $walletAccessKey
     */
    public function __construct(string $publicApiKey, string $walletAccessKey = '')
    {
        self::$publicApiKey = $publicApiKey;
        self::$walletAccessKey = $walletAccessKey;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        $className = __NAMESPACE__ . '\\' . ucwords($name);
        return new $className();
    }

    /**
     * Show the Client version
     * @return string
     */
    public static function showVersion(): string
    {
        return self::VERSION;
    }

    /**
     * Get base URL
     * @return string
     */
    public static function getEndPointUrl(): string
    {
        return self::$endPointUrl;
    }

    /**
     * Set Wallet Access Key
     * @param string $walletAccessKey
     */
    public static function setWalletAccessKey(string $walletAccessKey): void
    {
        self::$walletAccessKey = $walletAccessKey;
    }

    /**
     * Set public key
     * @param string $publicApiKey
     */
    public static function setPublicApiKey(string $publicApiKey): void
    {
        self::$publicApiKey = $publicApiKey;
    }

    /**
     * Get wallet access key
     * @return string
     */
    public static function getWalletAccessKey(): string
    {
        return self::$walletAccessKey;
    }

    /**
     * Get public key
     * @return string
     */
    public static function getPublicApiKey(): string
    {
        return self::$publicApiKey;
    }

    /**
     * Get Full URL
     * @param string $uri
     * @return string
     */
    public static function getFullUrl(string $uri): string
    {
        return self::$endPointUrl . $uri;
    }

    /**
     * List all the wallets
     * @see https://docs.lnpay.co/api/wallets/list
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listAll(): string
    {
        return $this->setHeaders('X-LNPay-sdk', self::showVersion())
            ->setHeaders('X-Api-Key', self::getPublicApiKey())
            ->get('wallets');
    }
}
