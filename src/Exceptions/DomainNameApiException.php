<?php

namespace Hellsythe\DomainNameApi\Exceptions;

use Exception;

class DomainNameApiException extends Exception
{
    public function __construct(array $errors = [], $code = 0)
    {
        parent::__construct(json_encode($errors), (int) $code);
    }
}
