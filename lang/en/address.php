<?php

use App\Models\Enums\AddressType;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'deleted' => 'Adress was deleted.',

    'type_' . AddressType::BASIC => 'basic',
    'type_' . AddressType::HOME => 'home',
    'type_' . AddressType::BUSINESS => 'business',
    'type_' . AddressType::BILLING => 'billing',
    'type_' . AddressType::SHIPPING => 'shipping',
    'type_' . AddressType::CONTRACT => 'contract',
    'type_' . AddressType::RECIPIENT => 'recipient',
];
