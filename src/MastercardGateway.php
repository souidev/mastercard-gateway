<?php

namespace Souidev\MastercardGateway;

use Souidev\MastercardGateway\DTOs\Response;

class MastercardGateway
{
    protected Merchant $merchant;

    protected Connection $connection;

    protected Parser $parser;

    public function __construct(Merchant $merchant, Connection $connection, Parser $parser)
    {
        $this->merchant = $merchant;
        $this->connection = $connection;
        $this->parser = $parser;
    }

    public function pay(array $data): Response
    {
        $apiRequest = $this->parser->formatRequest('PAY', $data, $this->merchant);

        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/order/'.($data['orderId'] ?? '').'/transaction/'.($data['transactionId'] ?? '');

        $response = $this->connection->put(trim($url, '/'), $apiRequest);

        return $this->parser->parseResponse($response);
    }

    public function updateTransaction(string $orderId, string $transactionId, array $data): Response
    {
        $apiRequest = $this->parser->formatRequest('UPDATE_TRANSACTION', $data, $this->merchant);

        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/order/'.$orderId.'/transaction/'.$transactionId;

        $response = $this->connection->put($url, $apiRequest);

        return $this->parser->parseResponse($response);
    }

    public function authorize(array $data): Response
    {
        $apiRequest = $this->parser->formatRequest('AUTHORIZE', $data, $this->merchant);

        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/order/'.($data['orderId'] ?? '').'/transaction/'.($data['transactionId'] ?? '');

        $response = $this->connection->put(trim($url, '/'), $apiRequest);

        return $this->parser->parseResponse($response);
    }

    public function capture(string $orderId, string $transactionId, array $data): Response
    {
        $apiRequest = $this->parser->formatRequest('CAPTURE', $data, $this->merchant);

        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/order/'.$orderId.'/transaction/'.$transactionId;

        $response = $this->connection->put($url, $apiRequest);

        return $this->parser->parseResponse($response);
    }

    public function refund(string $orderId, string $transactionId, array $data): Response
    {
        $apiRequest = $this->parser->formatRequest('REFUND', $data, $this->merchant);

        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/order/'.$orderId.'/transaction/'.$transactionId;

        $response = $this->connection->put($url, $apiRequest);

        return $this->parser->parseResponse($response);
    }

    public function void(string $orderId, string $transactionId, array $data): Response
    {
        $apiRequest = $this->parser->formatRequest('VOID', $data, $this->merchant);

        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/order/'.$orderId.'/transaction/'.$transactionId;

        $response = $this->connection->put($url, $apiRequest);

        return $this->parser->parseResponse($response);
    }

    public function verify(array $data): Response
    {
        $apiRequest = $this->parser->formatRequest('VERIFY', $data, $this->merchant);

        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/order/'.($data['orderId'] ?? '').'/transaction/'.($data['transactionId'] ?? '');

        $response = $this->connection->put(trim($url, '/'), $apiRequest);

        return $this->parser->parseResponse($response);
    }

    public function retrieveTransaction(string $orderId, string $transactionId): Response
    {
        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/order/'.$orderId.'/transaction/'.$transactionId;

        $response = $this->connection->get($url);

        return $this->parser->parseResponse($response);
    }

    public function retrieveOrder(string $orderId): Response
    {
        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/order/'.$orderId;

        $response = $this->connection->get($url);

        return $this->parser->parseResponse($response);
    }

    public function authenticatePayer(array $data): Response
    {
        $apiRequest = $this->parser->formatRequest('AUTHENTICATE_PAYER', $data, $this->merchant);

        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/order/'.($data['orderId'] ?? '').'/transaction/'.($data['transactionId'] ?? '');

        $response = $this->connection->put(trim($url, '/'), $apiRequest);

        return $this->parser->parseResponse($response);
    }

    public function createToken(array $data): Response
    {
        $apiRequest = $this->parser->formatRequest('CREATE_TOKEN', $data, $this->merchant);

        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/token';

        $response = $this->connection->post($url, $apiRequest);

        return $this->parser->parseResponse($response);
    }

    public function updateToken(string $tokenId, array $data): Response
    {
        $apiRequest = $this->parser->formatRequest('UPDATE_TOKEN', $data, $this->merchant);

        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/token/'.$tokenId;

        $response = $this->connection->put($url, $apiRequest);

        return $this->parser->parseResponse($response);
    }

    public function deleteToken(string $tokenId): Response
    {
        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/token/'.$tokenId;

        $response = $this->connection->delete($url);

        return $this->parser->parseResponse($response);
    }

    public function retrieveToken(string $tokenId): Response
    {
        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/token/'.$tokenId;

        $response = $this->connection->get($url);

        return $this->parser->parseResponse($response);
    }
}
