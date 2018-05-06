<?php

namespace Comoyi\Hall\Handlers\Send;

use Comoyi\Hall\Handlers\Send\SendHandler;
use Comoyi\Hall\Cmd\ChatSendCmd;
use Comoyi\Hall\Core\Msg;

/**
 * Login
 */
class LoginHandler extends SendHandler
{

    /**
     * cmd
     */
    protected $cmd = ChatSendCmd::LOGIN;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        $data = $msg->getData();
        $data[ChatSendCmd::CMD] = ChatSendCmd::LOGIN;
        container('packet')->send($msg->getFd(), $data);
    }
}
