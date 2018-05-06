<?php

namespace Comoyi\Hall\Handlers\Send;

use Comoyi\Hall\Handlers\Send\SendHandler;
use Comoyi\Hall\Cmd\ChatSendCmd;
use Comoyi\Hall\Core\Msg;

/**
 * pong
 */
class PongHandler extends SendHandler
{

    /**
     * cmd
     */
    protected $cmd = ChatSendCmd::PONG;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        $data = [
            ChatSendCmd::CMD => ChatSendCmd::PONG,
        ];
        container('packet')->send($msg->getFd(), $data);
    }
}
