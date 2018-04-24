<?php

namespace Comoyi\Hall\Handlers\Recv;

use Comoyi\Hall\Factory\SendMsgFactory;
use Comoyi\Hall\Handlers\Recv\RecvHandler;
use Comoyi\Hall\Cmd\ChatSendCmd;
use Comoyi\Hall\Cmd\ChatRecvCmd;
use Comoyi\Hall\Core\Msg;

/**
 * 世界喇叭
 */
class GlobalMessageHandler extends RecvHandler
{
    /**
     * cmd
     */
    protected $cmd = ChatRecvCmd::GLOBAL_MESSAGE;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        container('sender')->handle(SendMsgFactory::create(ChatSendCmd::GLOBAL_MESSAGE, [
            'msg' => $msg->getData()['msg'],
        ], $msg->getFd()));
    }
}
