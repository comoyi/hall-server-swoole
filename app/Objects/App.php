<?php

namespace Comoyi\Hall\Objects;

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
            'packet' => \Comoyi\Hall\Objects\Packet::class, // 消息包
            'receiver' => \Comoyi\Hall\Objects\Receiver::class, // 接收者
            'sender' => \Comoyi\Hall\Objects\Sender::class, // 发送者
            'gate' => \Comoyi\Hall\Objects\Gate::class, // 数据包网关
            'sendQueue' => \Comoyi\Hall\Objects\SendQueue::class, // 发送队列
            'receiveQueue' => \Comoyi\Hall\Objects\ReceiveQueue::class, // 接收队列
            'redisQueue' => \Comoyi\Hall\Objects\Queue\RedisQueue::class, // redis消息队列
        ];

        // 接收处理
        $receiveHandlers = [
            \Comoyi\Hall\Handlers\Recv\PingHandler::class, // ping
            \Comoyi\Hall\Handlers\Recv\LoginHandler::class, // 登录
            \Comoyi\Hall\Handlers\Recv\GlobalMessageHandler::class, // 全局消息
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
