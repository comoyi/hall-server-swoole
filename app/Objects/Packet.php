<?php

namespace Comoyi\Hall\Objects;

use Comoyi\Hall\Factory\ReceiveMsgFactory;

/**
 * 数据包
 */
class Packet
{

    /**
     * 接收数据包
     *
     * @param $frame
     */
    public function receive($frame)
    {

        // 包长度限制
//        if () {
//            return;
//        }

        // TODO 通过队列
//        container('receiveQueue')->push(json_encode($frame->data));

        $body = json_decode($frame->data, true);

        if (empty($body)) {
            return;
        }

        // TODO 做消息合法性校验

        foreach ($body['data'] as $v) {
//            try {
            container('receiver')->handle(ReceiveMsgFactory::create($v['cmd'], $v, $frame->fd));
//            } catch (\Exception $e) {
//
//            }
        }
    }

    /**
     * 发送数据包
     *
     * @param $fd
     * @param $data
     */
    public function send($fd, $data)
    {
        $packetData = [
            'packageId' => uniqid(),
            'clientId' => $fd,
            'packageType' => '1',
            'token' => '',
            'data' => [
                $data
            ]
        ];
        if (APP_DEBUG) {
            echo json_encode($packetData), PHP_EOL;
        }

        // TODO 通过队列发送
//        container('sendQueue')->push(json_encode($packetData));

        container('server')->push($fd, json_encode($packetData));
    }

}
