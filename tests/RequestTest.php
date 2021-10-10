<?php

namespace LNPayClient;

use \LNPayClient\Request;
use PHPUnit\Framework\TestCase;

/**
 * Class RequestTest
 * @package LNPayClient
 */
class RequestTest extends TestCase
{
    /**
     * @var \LNPayClient\Request
     */
    private $request;

    /**
     * Setup
     */
    public function setUp(): void
    {
        parent::setUp();
        $lnPayClient = new LNPayClient(
            $_SERVER['PUBLIC_API_KEY'],
        );

        $this->request = new Request();
        $this->request->setHeaders('X-LNPay-sdk', LNPayClient::showVersion());
        $this->request->setHeaders('X-Api-Key', LNPayClient::getPublicApiKey());
    }

    /**
     * Clean up
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        $this->request = null;
    }

    /**
     * Test POST request
     * @return void
     * @throws \ReflectionException
     */
    public function testPost(): void
    {
        $method = new \ReflectionMethod($this->request, 'post');
        $method->setAccessible(true);

        $response = $method->invoke($this->request, 'wallet', [
            'user_label' => 'My Test Wallet'
        ]);
        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertSame($response->user_label, 'My Test Wallet');
        $this->assertStringStartsWith("wal_", $response->id);
    }

    /**
     * Test GET request
     * @return void
     * @throws \ReflectionException
     */
    public function testGet(): void
    {
        $method = new \ReflectionMethod($this->request, 'get');
        $method->setAccessible(true);

        $response = $method->invoke($this->request, 'wallets');
        $this->assertIsArray($response);
        $this->assertGreaterThan(0, $response);

        $foundTheWallet = false;
        foreach ($response as $res) {
            if ($res->user_label === "My Test Wallet") {
                $foundTheWallet = true;
                break;
            }
        }
        $this->assertTrue($foundTheWallet);
    }
}
