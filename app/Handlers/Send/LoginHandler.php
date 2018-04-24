<?php

namespace Comoyi\Hall\Handlers\Send;

use Comoyi\Hall\Handlers\Send\SendHandler;
use Comoyi\Hall\Cmd\CmdSend;
use Comoyi\Hall\Core\Msg;

/**
 * Login
 */
class LoginHandler extends SendHandler
{

    /**
     * cmd
     */
    protected $cmd = CmdSend::LOGIN;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        $data = $msg->getData();
        $data[CmdSend::CMD] = CmdSend::LOGIN;
        container('packet')->send($msg->getFd(), $data);
    }
}
