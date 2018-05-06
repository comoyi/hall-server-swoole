<?php

namespace Comoyi\Hall\Handlers\Recv;

use Comoyi\Hall\Factory\SendMsgFactory;
use Comoyi\Hall\Handlers\Recv\RecvHandler;
use Comoyi\Hall\Cmd\ChatSendCmd;
use Comoyi\Hall\Cmd\ChatRecvCmd;
use Comoyi\Hall\Core\Msg;

/**
 * ping
 */
class PingHandler extends RecvHandler
{
    /**
     * cmd
     */
    protected $cmd = ChatRecvCmd::PING;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        container('sender')->handle(SendMsgFactory::create(ChatSendCmd::PONG, [], $msg->getFd()));
    }
}
