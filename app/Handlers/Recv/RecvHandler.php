<?php

namespace Comoyi\Hall\Handlers\Recv;

use Comoyi\Hall\Interfaces\ReceiveMessageHandlerInterface;
use Comoyi\Hall\Core\Msg;

/**
 * 接收消息处理
 */
abstract class RecvHandler implements ReceiveMessageHandlerInterface
{

    /**
     * cmd
     *
     * @var string
     */
    protected $cmd = '';

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    abstract public function handle(Msg $msg);

    /**
     * @return string
     */
    public function getCmd() {
        return $this->cmd;
    }

}
