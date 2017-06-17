<?php

namespace Comoyi\Hall\Objects\Send;

use Comoyi\Hall\Objects\Msg;

/**
 * pong
 */
class PongHandler extends SendHandler
{

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        $data = [
            KEY_CMD => CMD_SEND_PONG
        ];
        container('packet')->send($msg->getFd(), $data);
    }
}
