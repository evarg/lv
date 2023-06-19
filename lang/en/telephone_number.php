<?php

use App\Models\Enums\TelephoneNumberType;

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

    'type_' . TelephoneNumberType::DEFAULT => 'default',
    'type_' . TelephoneNumberType::HOME => 'home',
    'type_' . TelephoneNumberType::WORK => 'work',
    'type_' . TelephoneNumberType::MOBILE => 'mobile',
    'type_' . TelephoneNumberType::OTHER => 'other',
];
