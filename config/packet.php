<?php

use App\Models\Enums\PictureSize;

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'thumbs' => [
        PictureSize::SIZE_RX => [
            'suffix' => 'rx',
            'width' => 1600,
            'height' => 1200,
            'crop' => false,
        ],
        PictureSize::SIZE_RL => [
            'suffix' => 'rl',
            'width' => 800,
            'height' => 600,
            'crop' => false,
        ],
        PictureSize::SIZE_RM => [
            'suffix' => 'rm',
            'width' => 400,
            'height' => 300,
            'crop' => false,
        ],
        PictureSize::SIZE_RS => [
            'suffix' => 'rs',
            'width' => 200,
            'height' => 150,
            'crop' => false,
        ],
        PictureSize::SIZE_SX => [
            'suffix' => 'sx',
            'width' => 1600,
            'height' => 1200,
            'crop' => true,
        ],
        PictureSize::SIZE_SL => [
            'suffix' => 'sl',
            'width' => 800,
            'height' => 600,
            'crop' => true,
        ],
        PictureSize::SIZE_SM => [
            'suffix' => 'sm',
            'width' => 400,
            'height' => 300,
            'crop' => true,
        ],
        PictureSize::SIZE_SS => [
            'suffix' => 'ss',
            'width' => 200,
            'height' => 150,
            'crop' => true,
        ],

    ],
];
