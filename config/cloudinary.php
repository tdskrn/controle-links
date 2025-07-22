<?php

return [

    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key'    => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
    ],

    'url' => env('CLOUDINARY_URL'),

    'secure' => env('CLOUDINARY_SECURE', true),

    // (opcional) Preset e outros campos se quiser manter
    'upload_preset'   => env('CLOUDINARY_UPLOAD_PRESET'),
    'upload_route'    => env('CLOUDINARY_UPLOAD_ROUTE'),
    'upload_action'   => env('CLOUDINARY_UPLOAD_ACTION'),
    'notification_url'=> env('CLOUDINARY_NOTIFICATION_URL'),
];
