<?php

namespace Souidev\MastercardGateway;

use Souidev\MastercardGateway\DTOs\Response;
use Souidev\MastercardGateway\Exceptions\MastercardApiException;

class Parser
{
    public function formatRequest(array $data, Merchant $merchant): array
    {
        return array_merge_recursive([
            'apiOperation' => 'PAY',
            'merchant' => $merchant->getMerchantId(),
        ], $data);
    }

    public function parseResponse(array $response): Response
    {
        if (isset($response['result']) && $response['result'] === 'ERROR') {
            throw new MastercardApiException(
                $response['error']['explanation'] ?? 'An unknown API error occurred.',
                $response['error']['cause'] ?? 'UNKNOWN'
            );
        }

        return new Response($response);
    }
}
