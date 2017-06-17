<?php

namespace Comoyi\Hall\Objects\Send;

use Comoyi\Hall\Interfaces\SendMessageHandlerInterface;
use Comoyi\Hall\Objects\Msg;

/**
 * 发送消息处理
 */
abstract class SendHandler implements SendMessageHandlerInterface
{

//    /**
//     * cmd
//     *
//     * @var string
//     */
//    protected $cmd = '';

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    abstract public function handle(Msg $msg);

//    /**
//     * @return string
//     */
//    public function getCmd() {
//        return $this->cmd;
//    }

}
