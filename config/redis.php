<?php

return [
    'type' => 'direct', // direct: 直连, sentinel: 由sentinel决定host与port
    'password' => '', // redis auth 密码
    'master_name' => 'mymaster', // master name
    'direct' => [
        'masters' => [
            [
                'host' => env('REDIS_HOST', '127.0.0.1'),
                'port' => env('REDIS_PORT', '6379'),
            ]
        ],
        'slaves' => [
            [
                'host' => env('REDIS_HOST', '127.0.0.1'),
                'port' => env('REDIS_PORT', '6379'),
            ],
            [
                'host' => env('REDIS_HOST', '127.0.0.1'),
                'port' => env('REDIS_PORT', '6379'),
            ]
        ],
    ],
    'sentinel' => [
        'sentinels' => [
            [
                'host' => '127.0.0.1',
                'port' => '5000',
            ],
            [
                'host' => '127.0.0.1',
                'port' => '5001',
            ]
        ]

    ]
];
