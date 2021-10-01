
<?php
return [
    /*
     |--------------------------------------------------------------------------
     | Configuraciones basicas
     |--------------------------------------------------------------------------
     |
     |
     */
    'username' => env('DOMAINNAMEAPI_USERNAME', 'ownername'),
    'password' => env('DOMAINNAMEAPI_PASSWORD', 'ownerpass'),
    'cache' => env('DOMAINNAMEAPI_CACHE', false),
    'test_mode' => env('DOMAINNAMEAPI_TEST_MODE', true),
    'tlds' => [
        'com',
        'mx',
        'com.mx',
        'net',
        'org',
        'info',
        'site',
        'xyz',
    ],
    'increase_price' => '35',
    'contact_info' => [
        'FirstName' => 'Camilo Antonio',
        'LastName' => 'Rodríguez Cruz',
        'Company' => 'SDK Consultoría',
        'EMail' => 'camilo@sdkconsultoria.com',
        'AddressLine1' => 'Aldama #703.',
        'State' => 'Veracruz',
        'City' => 'Tierra Blanca',
        'Country' => 'MX',
        'Phone' => '2213428198',
        'PhoneCountryCode' => '52',
        'Type' => 'Contact',
        'ZipCode' => '95100',
        'Status' => '',
    ],
    'nameservers' => [
        'ns1.sdkconsultoria.com',
        'ns2.sdkconsultoria.com'
    ]
];
