<?php

namespace Souidev\MastercardGateway\Tests\Feature;

use Souidev\MastercardGateway\MastercardGateway;
use Souidev\MastercardGateway\Tests\TestCase;

class MastercardGatewayFeatureTest extends TestCase
{
    /** @test */
    public function it_can_create_a_new_instance()
    {
        $mastercardGateway = $this->app->make(MastercardGateway::class);

        $this->assertInstanceOf(MastercardGateway::class, $mastercardGateway);
    }
    /** @test */
    public function it_can_make_a_pay_request()
    {
        $mastercardGateway = $this->app->make(MastercardGateway::class);

        $response = $mastercardGateway->pay([
            'orderId' => '12345',
            'transactionId' => '1',
            'order' => [
                'amount' => '100.00',
                'currency' => 'USD',
            ],
            'sourceOfFunds' => [
                'type' => 'CARD',
                'provided' => [
                    'card' => [
                        'number' => '5123456789012346',
                        'expiry' => [
                            'month' => '01',
                            'year' => '39',
                        ],
                        'securityCode' => '123',
                    ],
                ],
            ],
        ]);

        $this->assertEquals('SUCCESS', $response->result);
    }
    /** @test */
    public function it_can_make_an_authorize_request()
    {
        $mastercardGateway = $this->app->make(MastercardGateway::class);

        $response = $mastercardGateway->authorize([
            'orderId' => '12345',
            'transactionId' => '1',
            'order' => [
                'amount' => '100.00',
                'currency' => 'USD',
            ],
            'sourceOfFunds' => [
                'type' => 'CARD',
                'provided' => [
                    'card' => [
                        'number' => '5123456789012346',
                        'expiry' => [
                            'month' => '01',
                            'year' => '39',
                        ],
                        'securityCode' => '123',
                    ],
                ],
            ],
        ]);

        $this->assertEquals('SUCCESS', $response->result);
    }

    /** @test */
    public function it_can_make_a_capture_request()
    {
        $mastercardGateway = $this->app->make(MastercardGateway::class);

        $response = $mastercardGateway->capture('12345', '1', [
            'order' => [
                'amount' => '100.00',
                'currency' => 'USD',
            ],
        ]);

        $this->assertEquals('SUCCESS', $response->result);
    }

    /** @test */
    public function it_can_make_a_refund_request()
    {
        $mastercardGateway = $this->app->make(MastercardGateway::class);

        $response = $mastercardGateway->refund('12345', '1', [
            'order' => [
                'amount' => '100.00',
                'currency' => 'USD',
            ],
        ]);

        $this->assertEquals('SUCCESS', $response->result);
    }

    /** @test */
    public function it_can_make_a_void_request()
    {
        $mastercardGateway = $this->app->make(MastercardGateway::class);

        $response = $mastercardGateway->void('12345', '1', []);

        $this->assertEquals('SUCCESS', $response->result);
    }

    /** @test */
    public function it_can_make_a_verify_request()
    {
        $mastercardGateway = $this->app->make(MastercardGateway::class);

        $response = $mastercardGateway->verify([
            'orderId' => '12345',
            'transactionId' => '1',
            'order' => [
                'currency' => 'USD',
            ],
            'sourceOfFunds' => [
                'type' => 'CARD',
                'provided' => [
                    'card' => [
                        'number' => '5123456789012346',
                        'expiry' => [
                            'month' => '01',
                            'year' => '39',
                        ],
                        'securityCode' => '123',
                    ],
                ],
            ],
        ]);

        $this->assertEquals('SUCCESS', $response->result);
    }

    /** @test */
    public function it_can_make_a_retrieve_transaction_request()
    {
        $mastercardGateway = $this->app->make(MastercardGateway::class);

        $response = $mastercardGateway->retrieveTransaction('12345', '1');

        $this->assertEquals('SUCCESS', $response->result);
    }

    /** @test */
    public function it_can_make_a_retrieve_order_request()
    {
        $mastercardGateway = $this->app->make(MastercardGateway::class);

        $response = $mastercardGateway->retrieveOrder('12345');

        $this->assertEquals('SUCCESS', $response->result);
    }

    /** @test */
    public function it_can_make_an_authenticate_payer_request()
    {
        $mastercardGateway = $this->app->make(MastercardGateway::class);

        $response = $mastercardGateway->authenticatePayer([
            'orderId' => '12345',
            'transactionId' => '1',
            'order' => [
                'currency' => 'USD',
            ],
            'sourceOfFunds' => [
                'type' => 'CARD',
                'provided' => [
                    'card' => [
                        'number' => '5123456789012346',
                        'expiry' => [
                            'month' => '01',
                            'year' => '39',
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals('SUCCESS', $response->result);
    }

    /** @test */
    public function it_can_make_a_create_token_request()
    {
        $mastercardGateway = $this->app->make(MastercardGateway::class);

        $response = $mastercardGateway->createToken([
            'sourceOfFunds' => [
                'type' => 'CARD',
                'provided' => [
                    'card' => [
                        'number' => '5123456789012346',
                        'expiry' => [
                            'month' => '01',
                            'year' => '39',
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals('SUCCESS', $response->result);
    }

    /** @test */
    public function it_can_make_an_update_token_request()
    {
        $mastercardGateway = $this->app->make(MastercardGateway::class);

        $response = $mastercardGateway->updateToken('12345', [
            'sourceOfFunds' => [
                'type' => 'CARD',
                'provided' => [
                    'card' => [
                        'number' => '5123456789012346',
                        'expiry' => [
                            'month' => '01',
                            'year' => '39',
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals('SUCCESS', $response->result);
    }

    /** @test */
    public function it_can_make_a_delete_token_request()
    {
        $mastercardGateway = $this->app->make(MastercardGateway::class);

        $response = $mastercardGateway->deleteToken('12345');

        $this->assertEquals('SUCCESS', $response->result);
    }

    /** @test */
    public function it_can_make_a_retrieve_token_request()
    {
        $mastercardGateway = $this->app->make(MastercardGateway::class);

        $response = $mastercardGateway->retrieveToken('12345');

        $this->assertEquals('SUCCESS', $response->result);
    }
}
