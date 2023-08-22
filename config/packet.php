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

    'thumbs_avaiable' => [
        PictureSize::SIZE_RX,
        PictureSize::SIZE_RL,
        PictureSize::SIZE_RM,
        PictureSize::SIZE_RS,
        PictureSize::SIZE_SX,
        PictureSize::SIZE_SL,
        PictureSize::SIZE_SM,
        PictureSize::SIZE_SS,
    ],
    'thumbs' => [
        PictureSize::SIZE_RX => [
            'file_name' => '%s_rx.%s',
            'width' => 1600,
            'height' => 1200,
            'crop' => false,
        ],
        PictureSize::SIZE_RL => [
            'file_name' => '%s_rl.%s',
            'width' => 800,
            'height' => 600,
            'crop' => false,
        ],
        PictureSize::SIZE_RM => [
            'file_name' => '%s_rm.%s',
            'width' => 400,
            'height' => 300,
            'crop' => false,
        ],
        PictureSize::SIZE_RS => [
            'file_name' => '%s_rs.%s',
            'width' => 200,
            'height' => 150,
            'crop' => false,
        ],
        PictureSize::SIZE_SX => [
            'file_name' => '%s_sx.%s',
            'width' => 1200,
            'height' => 1200,
            'crop' => true,
        ],
        PictureSize::SIZE_SL => [
            'file_name' => '%s_sl.%s',
            'width' => 600,
            'height' => 600,
            'crop' => true,
        ],
        PictureSize::SIZE_SM => [
            'file_name' => '%s_sm.%s',
            'width' => 300,
            'height' => 300,
            'crop' => true,
        ],
        PictureSize::SIZE_SS => [
            'file_name' => '%s_ss.%s',
            'width' => 150,
            'height' => 150,
            'crop' => true,
        ],

    ],
];
