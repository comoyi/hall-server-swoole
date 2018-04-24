<?php

namespace Comoyi\Hall\Cmd;

use Comoyi\Hall\Cmd\Cmd;

class ChatRecvCmd extends Cmd
{
    /**
     * cmd
     */
    const PING = 1;
    const LOGIN = 2;
    const GLOBAL_MESSAGE = 3;
}
