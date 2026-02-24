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

        $guzzleOptions = [
            'base_uri' => $this->config['gateway_url'],
            'auth' => [
                'merchant.'.$this->config['merchant_id'],
                $this->config['password'],
            ],
            'debug' => $this->config['debug'] ?? false,
            'proxy' => $this->config['proxy']['server'] ?? null,
            'verify' => true,
        ];

        if (!empty($this->config['ssl']['ca'])) {
            $caPath = base_path($this->config['ssl']['ca']);
            if (file_exists($caPath)) {
                $guzzleOptions['verify'] = $caPath;
            }
        }

        $this->client = new Client($guzzleOptions);
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

    public function get(string $url): array
    {
        try {
            $response = $this->client->get($url);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            throw new MastercardConnectionException('Error connecting to Mastercard Gateway: '.$e->getMessage(), $e->getCode(), $e);
        }
    }

    public function delete(string $url): array
    {
        try {
            $response = $this->client->delete($url);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            throw new MastercardConnectionException('Error connecting to Mastercard Gateway: '.$e->getMessage(), $e->getCode(), $e);
        }
    }
}
