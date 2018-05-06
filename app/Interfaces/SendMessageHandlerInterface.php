<?php

namespace Comoyi\Hall\Interfaces;

use Comoyi\Hall\Core\Msg;

/**
 * 发送消息处理
 */
interface SendMessageHandlerInterface {

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg);

}