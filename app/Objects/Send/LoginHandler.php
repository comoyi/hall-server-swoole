<?php

namespace Comoyi\Hall\Objects\Send;

use Comoyi\Hall\Models\CmdSend;
use Comoyi\Hall\Objects\Msg;

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
