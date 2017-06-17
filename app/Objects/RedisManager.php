<?php

namespace Comoyi\Hall\Objects;

use Comoyi\Redis\RedisClient;

class RedisManager
{

    /**
     * redis连接池
     *
     * @var array
     */
    private static $pool = [];

    /**
     * constructor
     */
    private function __construct()
    {
    }

    /**
     * 获取redis连接
     *
     * @param int $db redis库
     * @return RedisClient
     */
    public static function getInstance($db = 0)
    {

        // 已经存在直接返回
        if (!is_null(static::getPool($db))) {
            return static::getPool($db);
        }

        $redisConf = [
            'host' => config('redis_host'),
            'port' => config('redis_port')
        ];

        $redisConfig = [
            'type' => 'direct', // direct: 直连, sentinel: 由sentinel决定host与port
            'password' => '', // redis auth 密码
            'master_name' => 'mymaster', // master name
            'direct' => [
                'masters' => [
                    [
                        'host' => $redisConf['host'],
                        'port' => $redisConf['port']
                    ]
                ],
                'slaves' => [
                    [
                        'host' => $redisConf['host'],
                        'port' => $redisConf['port']
                    ],
                    [
                        'host' => $redisConf['host'],
                        'port' => $redisConf['port']
                    ]
                ],
            ],
            'sentinel' => [
                'sentinels' => [
                    [
                        'host' => '127.0.0.1',
                        'port' => '5000'
                    ],
                    [
                        'host' => '127.0.0.1',
                        'port' => '5001'
                    ]
                ]

            ]
        ];
        $redis = new RedisClient($redisConfig);
        $redis->select($db);
        static::setPool($db, $redis);
        return $redis;
    }

    /**
     * @param $db
     * @return RedisClient
     */
    private static function getPool($db)
    {
        if (isset(static::$pool[$db])) {
            return static::$pool[$db];
        }
        return null;
    }

    /**
     * @param $db
     * @param $redis
     */
    private static function setPool($db, $redis)
    {
        static::$pool[$db] = $redis;
    }


}