<?php

namespace Comoyi\Hall\Core;

/**
 * 程序对象容器 important!
 */
final class Container
{

    static $member = [];

    /**
     * get
     *
     * @param $alias
     * @return mixed
     */
    public static function get($alias)
    {
        return static::$member[$alias];
    }

    /**
     * 取出所有对象
     */
    public static function getAll()
    {
        return static::$member;
    }

    /**
     * add
     *
     * @param $alias
     * @param $member
     * @return bool
     */
    public static function add($alias, $member)
    {
        if (isset(static::$member[$alias])) {
            return false;
        }

        static::$member[$alias] = $member;
        return true;
    }

    /**
     * remove
     *
     * @param $alias
     * @return bool
     */
    public static function remove($alias)
    {
        if (!isset(static::$member[$alias])) {
            return true;
        }

        unset(static::$member[$alias]);
        return true;
    }
}
