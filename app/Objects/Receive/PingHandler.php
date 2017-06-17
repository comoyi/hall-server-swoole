<?php

namespace Comoyi\Hall\Objects\Receive;

use Comoyi\Hall\Factory\SendMsgFactory;
use Comoyi\Hall\Objects\Msg;

/**
 * ping
 */
class PingHandler extends ReceiveHandler
{

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        container('sender')->handle(SendMsgFactory::create(CMD_SEND_PONG, [], $msg->getFd()));
    }
}
