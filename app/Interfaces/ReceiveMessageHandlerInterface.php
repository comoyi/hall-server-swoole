<?php

namespace Comoyi\Hall\Interfaces;

use Comoyi\Hall\Objects\Msg;

/**
 * 消息处理
 */
interface ReceiveMessageHandlerInterface {

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg);

}