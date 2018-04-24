<?php

namespace Comoyi\Hall\Handlers\Send;

use Comoyi\Hall\Handlers\Send\SendHandler;
use Comoyi\Hall\Cmd\CmdSend;
use Comoyi\Hall\Core\Msg;

/**
 * pong
 */
class PongHandler extends SendHandler
{

    /**
     * cmd
     */
    protected $cmd = CmdSend::PONG;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        $data = [
            CmdSend::CMD => CmdSend::PONG,
        ];
        container('packet')->send($msg->getFd(), $data);
    }
}
