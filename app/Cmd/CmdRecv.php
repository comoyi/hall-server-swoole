<?php

namespace Comoyi\Hall\Cmd;

class CmdRecv
{
    /**
     * 消息数据里cmd的字段名
     */
    const CMD = 'cmd';
//    const SUB_CMD = 'subcmd'; // 如果cmd分两级那原来的cmd就是父cmd，这个就是子cmd

    /**
     * cmd
     */
    const PING = 1;
    const LOGIN = 2;
    const GLOBAL_MESSAGE = 3;

}
