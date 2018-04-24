<?php

namespace Comoyi\Hall\Handlers\Recv;

use Comoyi\Hall\Factory\SendMsgFactory;
use Comoyi\Hall\Handlers\Recv\RecvHandler;
use Comoyi\Hall\Models\CmdSend;
use Comoyi\Hall\Models\CmdRecv;
use Comoyi\Hall\Objects\Msg;

/**
 * 世界喇叭
 */
class GlobalMessageHandler extends RecvHandler
{
    /**
     * cmd
     */
    protected $cmd = CmdRecv::GLOBAL_MESSAGE;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        container('sender')->handle(SendMsgFactory::create(CmdSend::GLOBAL_MESSAGE, [
            'msg' => $msg->getData()['msg'],
        ], $msg->getFd()));
    }
}
