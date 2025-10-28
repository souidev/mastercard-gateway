<?php

namespace Souidev\MastercardGateway\Tests\Unit;

use Souidev\MastercardGateway\Exceptions\MissingMerchantIdException;
use Souidev\MastercardGateway\Merchant;
use Souidev\MastercardGateway\Tests\TestCase;

class MerchantTest extends TestCase
{
    public function test_it_requires_credentials_to_be_instantiated()
    {
        $this->expectException(MissingMerchantIdException::class);

        new Merchant([]);
    }

    public function test_it_can_be_instantiated_with_valid_credentials()
    {
        $config = [
            'merchant_id' => 'TESTMERCHANT',
            'api_username' => 'merchant.TESTMERCHANT',
            'password' => 'testpassword',
            'gateway_url' => 'https://test-gateway.com',
            'version' => '61',
        ];

        $merchant = new Merchant($config);

        $this->assertInstanceOf(Merchant::class, $merchant);
        $this->assertEquals('TESTMERCHANT', $merchant->getMerchantId());
        $this->assertEquals('merchant.TESTMERCHANT', $merchant->getApiUsername());
        $this->assertEquals('testpassword', $merchant->getPassword());
        $this->assertEquals('https://test-gateway.com', $merchant->getGatewayUrl());
        $this->assertEquals('61', $merchant->getApiVersion());
    }
}
