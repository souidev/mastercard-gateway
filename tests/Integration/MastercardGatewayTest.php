<?php

namespace Souidev\MastercardGateway\Tests\Integration;

use PHPUnit\Framework\Attributes\Test;
use Souidev\MastercardGateway\Connection;
use Souidev\MastercardGateway\Facades\MastercardGateway;
use Souidev\MastercardGateway\Tests\TestCase;

class MastercardGatewayTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Set the configuration values for the test
        config()->set('mastercard-gateway.merchant_id', 'TESTMERCHANT');
        config()->set('mastercard-gateway.api_username', 'merchant.TESTMERCHANT');
        config()->set('mastercard-gateway.password', 'testpassword');
    }

    #[Test]
    public function it_can_perform_a_charge()
    {
        // Mock the Connection class
        $this->mock(Connection::class, function ($mock) {
            $mock->shouldReceive('post')
                ->once()
                ->andReturn([
                    'result' => 'SUCCESS',
                    'order' => [
                        'id' => '12345',
                        'amount' => 100.00,
                        'currency' => 'USD',
                    ],
                ]);
        });

        // Make the call through the facade
        $response = MastercardGateway::charge([
            'orderId' => '12345',
            'transaction' => [
                'amount' => 100.00,
                'currency' => 'USD',
            ],
        ]);

        // Assert the response
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('12345', $response->order['id']);
    }
}
