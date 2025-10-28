<?php

namespace Souidev\MastercardGateway\DTOs;

class Response
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function isSuccessful(): bool
    {
        return isset($this->data['result']) && $this->data['result'] === 'SUCCESS';
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }
}
