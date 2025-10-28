<?php

namespace Souidev\MastercardGateway;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Souidev\MastercardGateway\Exceptions\MastercardConnectionException;

class Connection
{
    protected array $config;

    protected Client $client;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->client = new Client([
            'base_uri' => $this->config['gateway_url'],
            'auth' => [
                'merchant.'.$this->config['merchant_id'],
                $this->config['password'],
            ],
            'debug' => $this->config['debug'] ?? false,
            'proxy' => $this->config['proxy']['server'] ?? null,
            'verify' => $this->config['certificate']['path'] ?? true,
        ]);
    }

    public function post(string $url, array $data): array
    {
        try {
            $response = $this->client->post($url, ['json' => $data]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            throw new MastercardConnectionException('Error connecting to Mastercard Gateway: '.$e->getMessage(), $e->getCode(), $e);
        }
    }

    public function put(string $url, array $data): array
    {
        try {
            $response = $this->client->put($url, ['json' => $data]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            throw new MastercardConnectionException('Error connecting to Mastercard Gateway: '.$e->getMessage(), $e->getCode(), $e);
        }
    }
}
