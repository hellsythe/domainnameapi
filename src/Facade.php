<?php

namespace Hellsythe\DomainNameApi;

class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'nameapi';
    }
}
