<?php

namespace Souidev\MastercardGateway\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Souidev\MastercardGateway\MastercardGateway
 */
class MastercardGateway extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'mastercard-gateway';
    }
}
