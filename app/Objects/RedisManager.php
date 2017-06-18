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

        $redisConfig = config('redis');
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