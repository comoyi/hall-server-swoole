<?php

use Comoyi\Hall\Objects\Config;
use Comoyi\Hall\Objects\Container;

define('APP_DEBUG', true); // 调试

/**
 * 基础设施
 */
define('WEBSOCKET_HOST', '0.0.0.0'); // websocket host
define('WEBSOCKET_PORT', 9777); // websocket端口

define('KEY_CMD', 'cmd'); // cmd

// receive
define('CMD_RECEIVE_PING', 'Ping');
define('CMD_RECEIVE_LOGIN', 'Login');
define('CMD_RECEIVE_GLOBAL_MESSAGE', 'GlobalMessage');

// send
define('CMD_SEND_PONG', 'Pong');
define('CMD_SEND_LOGIN', 'Login');
define('CMD_SEND_GLOBAL_MESSAGE', 'GlobalMessage');

// 配置
$configs = [
    'redis_host' => '127.0.0.1',
    'redis_port' => '6379'
];
Config::setConfigs($configs);

/**
 * 获取配置
 *
 * @param $key
 * @param null $default
 * @return mixed
 */
function config($key, $default = null)
{
    $value = Config::get($key);
    return $value ?: $default;
}

/**
 * 获取/设置 容器内对象
 *
 * @param $alias
 * @param $obj
 * @return mixed
 */
function container($alias = null, $obj = null)
{
    if (!is_null($obj)) {
        Container::add($alias, $obj);
    }
    if (is_null($alias)) {
        return Container::getAll();
    }
    return Container::get($alias);
}

/**
 * 处理redis的key
 * @param $key
 * @param bool $isHandle 是否对key进行处理 false的时候不处理直接返回$key
 * @return string
 */
function handle_redis_key($key, $isHandle = true)
{
    if (!$isHandle) {
        return $key;
    }

    $isMd5 = true; // true: 进行md5处理, false: 不进行md5处理

    if ($isMd5) {
        return md5($key);
    }

    return $key;
}
