<?php

namespace Souidev\MastercardGateway;

use Souidev\MastercardGateway\Exceptions\MissingMerchantIdException;

class Merchant
{
    protected array $config;

    public function __construct(array $config)
    {
        if (empty($config['merchant_id']) || empty($config['api_username']) || empty($config['password'])) {
            throw new MissingMerchantIdException('Merchant ID, API username, and password are required.');
        }

        $this->config = $config;
    }

    public function getGatewayUrl(): string
    {
        return $this->config['gateway_url'];
    }

    public function getMerchantId(): string
    {
        return $this->config['merchant_id'];
    }

    public function getApiUsername(): string
    {
        return $this->config['api_username'];
    }

    public function getPassword(): string
    {
        return $this->config['password'];
    }

    public function getApiVersion(): string
    {
        return $this->config['version'];
    }

    public function isDebug(): bool
    {
        return $this->config['debug'] ?? false;
    }

    public function getProxy(): array
    {
        return $this->config['proxy'] ?? [];
    }

    public function getCertificate(): array
    {
        return $this->config['certificate'] ?? [];
    }

    public function toArray(): array
    {
        return $this->config;
    }
}
