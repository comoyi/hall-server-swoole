<?php

namespace Comoyi\Hall\Cmd;

use Comoyi\Hall\Cmd\Cmd;

class ChatSendCmd extends Cmd
{
    /**
     * cmd
     */
    const PONG = 1;
    const LOGIN = 2;
    const GLOBAL_MESSAGE = 3;
    const ROOM_MESSAGE = 8;
}
