<?php

namespace Comoyi\Hall\Objects\Receive;

use Comoyi\Hall\Factory\SendMsgFactory;
use Comoyi\Hall\Objects\Msg;

/**
 * 世界喇叭
 */
class GlobalMessageHandler extends ReceiveHandler
{

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        container('sender')->handle(SendMsgFactory::create(CMD_SEND_GLOBAL_MESSAGE, [
            'msg' => $msg->getData()['msg']
        ], $msg->getFd()));
    }
}
