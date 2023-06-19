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

    'type_' . AddressType::BASIC => 'podstawowy',
    'type_' . AddressType::HOME => 'dom',
    'type_' . AddressType::BUSINESS => 'firma',
    'type_' . AddressType::BILLING => 'rozliczenie',
    'type_' . AddressType::SHIPPING => 'dostawa',
    'type_' . AddressType::CONTRACT => 'kontrakt',
    'type_' . AddressType::RECIPIENT => 'odbiorca',
];
