<?php

namespace Comoyi\Hall\Handlers\Send;

use Comoyi\Hall\Handlers\Send\SendHandler;
use Comoyi\Hall\Models\CmdSend;
use Comoyi\Hall\Objects\Msg;

/**
 * 世界消息
 */
class GlobalMessageHandler extends SendHandler
{

    /**
     * cmd
     */
    protected $cmd = CmdSend::GLOBAL_MESSAGE;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        $server = container('server');
        $data = [
            CmdSend::CMD => CmdSend::GLOBAL_MESSAGE,
//            CmdSend::CMD => container('sender')->getExternalCmd(CmdSend::GLOBAL_MESSAGE),
            'msg' => $msg->getData()['msg'],
        ];

        // 发送给所有客户端
        foreach ($server->connections as $fd) {
            container('packet')->send($fd, $data);
        }
    }
}
