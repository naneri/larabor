<?php

return [
    
    // the number by which the ads are increased on the main page
    'ad_increase_number' => 1000,

    // IDs of the users affiliated with the website
    'affiliates'    => [2, 25],

    // The validation rules for item description
    'item'  => [
        'desc_min'  => 5,
        'desc_max'  => 5000
    ],

    // default empty image path
    'item_no_image'     => 'images/no_photo.gif',

    'user_info_default'     => [
        'priceListUpdate'   => [
            'date'      => null,
            'updates'   => 0,
            'path'      => ''
        ],
    ],

    'export'    => [
        'updates'   => 10
    ],

    'telegram'  => [
        'api-key'   => '',
        'bot-name'  => ''
    ]
];
