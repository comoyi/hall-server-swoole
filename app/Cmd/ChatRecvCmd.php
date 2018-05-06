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
    const CREATE_ROOM = 4;
    const ROOM_LIST = 5;
    const ENTER_ROOM = 6;
    const EXIT_ROOM = 7;
    const ROOM_MESSAGE = 8;
}
