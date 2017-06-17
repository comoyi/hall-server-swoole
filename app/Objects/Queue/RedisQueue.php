<?php

namespace Comoyi\Hall\Objects\Queue;

use Comoyi\Hall\Objects\RedisManager;

/**
 * redis消息队列
 */
class RedisQueue implements QueueInterface
{

    /**
     * redis
     */
    protected $redis;

    /**
     * constructor
     */
    function __construct()
    {
        $this->redis = RedisManager::getInstance();
    }

    /**
     * 添加到队尾
     *
     * @param string $queue 队列名
     * @param $data
     * @return bool
     */
    public function push($queue, $data)
    {
        return $this->redis->rPush($queue, $data);
    }

    /**
     * 从队首取出一项并从队列移除
     *
     * @param string $queue 队列名
     * @return bool|mixed
     */
    public function pop($queue)
    {
        return $this->redis->lPop($queue);
    }

    /**
     * 队列消息数量
     *
     * @param string $queue 队列名
     * @return mixed
     */
    public function size($queue)
    {
        return $this->redis->lLen($queue);
    }

}
