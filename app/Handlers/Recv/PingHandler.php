<?php

namespace Comoyi\Hall\Handlers\Recv;

use Comoyi\Hall\Factory\SendMsgFactory;
use Comoyi\Hall\Handlers\Recv\RecvHandler;
use Comoyi\Hall\Models\CmdSend;
use Comoyi\Hall\Models\CmdRecv;
use Comoyi\Hall\Objects\Msg;

/**
 * ping
 */
class PingHandler extends RecvHandler
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
