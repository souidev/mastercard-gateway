<?php

namespace Souidev\MastercardGateway;

use Souidev\MastercardGateway\DTOs\Response;
use Souidev\MastercardGateway\Exceptions\MastercardApiException;

class Parser
{
    public function formatRequest(string $apiOperation, array $data): array
    {
        return array_merge_recursive([
            'apiOperation' => $apiOperation,
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
