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

    public function charge(array $data): Response
    {
        $apiRequest = $this->parser->formatRequest($data, $this->merchant);

        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/order/'.($data['orderId'] ?? '').'/transaction/'.($data['transactionId'] ?? '');

        $response = $this->connection->post(trim($url, '/'), $apiRequest);

        return $this->parser->parseResponse($response);
    }

    public function updateTransaction(string $orderId, string $transactionId, array $data): Response
    {
        $apiRequest = $this->parser->formatRequest($data, $this->merchant);

        $url = '/version/'.$this->merchant->getApiVersion().'/merchant/'.$this->merchant->getMerchantId().'/order/'.$orderId.'/transaction/'.$transactionId;

        $response = $this->connection->put($url, $apiRequest);

        return $this->parser->parseResponse($response);
    }
}
