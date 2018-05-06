<?php

namespace Comoyi\Hall\Core;

/**
 * 消息包发送队列
 */
class SendQueue
{

    /**
     * 队列名称
     *
     * @var string
     */
    protected $queueName = 'queue:send';

    /**
     * 添加到队尾
     *
     * @param $data
     * @return bool
     */
    public function push($data)
    {
        return container('redisQueue')->push($this->getQueueName(), json_encode($data));
    }

    /**
     * 从队首取出一项并从队列移除
     *
     * @return bool|mixed
     */
    public function pop()
    {
        return container('redisQueue')->pop($this->getQueueName());
    }

    /**
     * 获取队列当前长度
     *
     * @return bool|mixed
     */
    public function size()
    {
        return container('redisQueue')->size($this->getQueueName());
    }

    /**
     * @return string
     */
    public function getQueueName()
    {
        return $this->queueName;
    }

}
