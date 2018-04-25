<?php

namespace Comoyi\Hall\Core;

use Comoyi\Hall\Config;
use Comoyi\Hall\Env;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class App
{
    /**
     * start
     */
    public function start()
    {
        echo 'start' . PHP_EOL;

        // 设置时区
        date_default_timezone_set('Asia/Shanghai');

        // 对象
        $classes = [

            // system
            'packet' => \Comoyi\Hall\Core\Packet::class, // 消息包
            'receiver' => \Comoyi\Hall\Core\Receiver::class, // 接收者
            'sender' => \Comoyi\Hall\Core\Sender::class, // 发送者
            'gate' => \Comoyi\Hall\Core\Gate::class, // 数据包网关
            'sendQueue' => \Comoyi\Hall\Core\SendQueue::class, // 发送队列
            'receiveQueue' => \Comoyi\Hall\Core\ReceiveQueue::class, // 接收队列
            'redisQueue' => \Comoyi\Hall\Core\Queue\RedisQueue::class, // redis消息队列

            'userList' => \Comoyi\Hall\Models\UserList::class, // 用户列表
            'clientList' => \Comoyi\Hall\Models\ClientList::class, // 用户列表
            'roomList' => \Comoyi\Hall\Models\RoomList::class, // room列表
        ];

        // 接收处理
        $receiveHandlers = [
            \Comoyi\Hall\Handlers\Recv\PingHandler::class, // ping
            \Comoyi\Hall\Handlers\Recv\LoginHandler::class, // 登录
            \Comoyi\Hall\Handlers\Recv\GlobalMessageHandler::class, // 全局消息
            \Comoyi\Hall\Handlers\Recv\CreateRoomHandler::class, // 创建房间
            \Comoyi\Hall\Handlers\Recv\RoomListHandler::class, // 所有房间列表
            \Comoyi\Hall\Handlers\Recv\EnterRoomHandler::class, // 进入房间
            \Comoyi\Hall\Handlers\Recv\ExitRoomHandler::class, // 离开房间
        ];

        // 发送处理
        $sendHandlers = [
            \Comoyi\Hall\Handlers\Send\PongHandler::class, // pong
            \Comoyi\Hall\Handlers\Send\GlobalMessageHandler::class, // 全局消息
            \Comoyi\Hall\Handlers\Send\LoginHandler::class, // login
        ];


        // env
        container('env', new Env());
        container('env')->loadEnvConfig(realpath(__DIR__ . '/../../'));

        // config
        container('config', new Config());
        container('config')->loadConfigFiles(realpath(__DIR__ . '/../../config'));

        // 日志
        $log = new Logger('app');
        $log->pushHandler(new StreamHandler(config('log.path'), Logger::DEBUG));
        container('log', $log);

        // 创建对象添加到容器
        foreach ($classes as $alias => $class) {
            container($alias, new $class);
        }

        // 接收处理
        foreach ($receiveHandlers as $handler) {
            container('receiver')->add(new $handler);
        }

        // 发送处理
        foreach ($sendHandlers as $handler) {
            container('sender')->add(new $handler);
        }

        // redis
        container('redis', RedisManager::getInstance());

        // start websocket
        container('gate')->start();
    }
}
