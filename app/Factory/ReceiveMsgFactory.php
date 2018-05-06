<?php

namespace Comoyi\Hall\Factory;

use Comoyi\Hall\Core\ReceiveMsg;

/**
 * 接收消息工厂
 */
class ReceiveMsgFactory {

    /**
     * 创建
     *
     * @param $cmd
     * @param $data
     * @param $fd
     * @return ReceiveMsg
     */
    public static function create($cmd, $data = null, $fd = null) {
        return new ReceiveMsg($cmd, $data, $fd);
    }

}