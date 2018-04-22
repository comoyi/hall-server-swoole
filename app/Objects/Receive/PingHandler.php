<?php

namespace Comoyi\Hall\Objects\Receive;

use Comoyi\Hall\Factory\SendMsgFactory;
use Comoyi\Hall\Models\CmdSend;
use Comoyi\Hall\Models\CmdRecv;
use Comoyi\Hall\Objects\Msg;

/**
 * ping
 */
class PingHandler extends ReceiveHandler
{
    /**
     * cmd
     */
    protected $cmd = CmdRecv::PING;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        container('sender')->handle(SendMsgFactory::create(CmdSend::PONG, [], $msg->getFd()));
    }
}
