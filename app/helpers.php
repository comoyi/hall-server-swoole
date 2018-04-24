<?php

use Comoyi\Hall\Core\Container;

/**
 * 获取配置
 *
 * @param $key
 * @param null $default
 * @return mixed
 */
function config($key = null, $default = null)
{
    $config = container('config');
    if (is_null($key)) {
        return $config;
    }

    if (is_array($key)) {
        return $config->set($key);
    }

    return $config->get($key, $default);
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
