<?php

namespace Comoyi\Hall\Factory;

use Comoyi\Hall\Objects\SendMsg;

/**
 * 发送消息工厂
 */
class SendMsgFactory {

    /**
     * 创建
     *
     * @param $cmd
     * @param $data
     * @param $fd
     * @return SendMsg
     */
    public static function create($cmd, $data = null, $fd = null) {
        return new SendMsg($cmd, $data, $fd);
    }

}