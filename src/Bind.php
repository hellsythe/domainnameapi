<?php

namespace Hellsythe\DomainNameApi;

use Hellsythe\DomainNameApi\Exceptions\DomainNameApiException;

require_once(__DIR__ . "/../api.php");

/**
 *
 */
abstract class Bind
{
    protected $api;

    function __construct()
    {
        $this->api = new \DomainNameAPI_PHPLibrary();
        $this->api->setUser(config('domainnameapi.username'), config('domainnameapi.password'));
        $this->api->useCaching(config('domainnameapi.cache'));
        $this->api->useTestMode(config('domainnameapi.test_mode'));
    }

    protected function throwError(array $result)
    {
        throw new DomainNameApiException([
            'message' => $result["error"]["Message"],
            'details' => $result["error"]["Details"],
        ], $result["error"]["Code"]);
    }

    protected function processResponse(array $result) : array
    {
        if($result["result"] == "OK")
        {
            return $result["data"];
        }

        $this->throwError($result);
    }
}
