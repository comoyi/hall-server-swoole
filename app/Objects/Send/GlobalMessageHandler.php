<?php

namespace Comoyi\Hall\Objects\Send;

use Comoyi\Hall\Objects\Msg;

/**
 * 世界消息
 */
class GlobalMessageHandler extends SendHandler
{

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
            KEY_CMD => CMD_SEND_GLOBAL_MESSAGE,
            'msg' => $msg->getData()['msg']
        ];

        // 发送给所有客户端
        foreach ($server->connections as $fd) {
            container('packet')->send($fd, $data);
        }
    }
}
