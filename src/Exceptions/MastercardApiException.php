<?php

namespace Souidev\MastercardGateway\Exceptions;

use Exception;

class MastercardApiException extends Exception
{
    protected $cause;

    public function __construct($message, $cause = null)
    {
        parent::__construct($message);
        $this->cause = $cause;
    }

    public function getCause()
    {
        return $this->cause;
    }
}
