<?php

namespace Comoyi\Hall\Objects\Send;

use Comoyi\Hall\Objects\Msg;

/**
 * Login
 */
class LoginHandler extends SendHandler
{

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        $data = $msg->getData();
        $data[KEY_CMD] = CMD_SEND_LOGIN;
        container('packet')->send($msg->getFd(), $data);
    }
}
