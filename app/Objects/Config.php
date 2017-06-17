<?php

namespace Comoyi\Hall\Objects;

/**
 * 配置
 */
class Config
{

    /**
     * 配置信息
     *
     * @var array
     */
    protected static $configs = [];

    /**
     * 获取配置项
     *
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        if (!isset(static::$configs[$key])) {
            return null;
        }
        return static::$configs[$key];
    }

    /**
     * 设置配置项
     *
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        static::$configs[$key] = $value;
    }

    /**
     * @return array
     */
    public static function getConfigs()
    {
        return self::$configs;
    }

    /**
     * @param array $configs
     */
    public static function setConfigs($configs)
    {
        self::$configs = $configs;
    }

}
