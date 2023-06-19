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

    'type_' . TelephoneNumberType::DEFAULT => 'domyślny',
    'type_' . TelephoneNumberType::HOME => 'dom',
    'type_' . TelephoneNumberType::WORK => 'praca',
    'type_' . TelephoneNumberType::MOBILE => 'komórka',
    'type_' . TelephoneNumberType::OTHER => 'inny',
];
