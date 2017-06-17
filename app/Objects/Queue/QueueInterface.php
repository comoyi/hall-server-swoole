<?php

namespace Comoyi\Hall\Objects\Queue;

/**
 * 消息队列
 */
interface QueueInterface
{

    /**
     * 添加到队尾
     *
     * @param string $queue 队列名
     * @param $data
     * @return bool
     */
    public function push($queue, $data);

    /**
     * 从队首取出一项并从队列移除
     *
     * @param string $queue 队列名
     * @return bool|mixed
     */
    public function pop($queue);

    /**
     * 队列消息数量
     *
     * @param string $queue 队列名
     * @return mixed
     */
    public function size($queue);

}
