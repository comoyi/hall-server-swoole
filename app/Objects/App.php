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
        echo 'start', PHP_EOL;

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
            'Ping' => \Comoyi\Hall\Objects\Receive\PingHandler::class, // ping
            'Login' => \Comoyi\Hall\Objects\Receive\LoginHandler::class, // 登录
            'GlobalMessage' => \Comoyi\Hall\Objects\Receive\GlobalMessageHandler::class, // 全局消息
        ];

        // 发送处理
        $sendHandlers = [
            'Pong' => \Comoyi\Hall\Objects\Send\PongHandler::class, // pong
            'GlobalMessage' => \Comoyi\Hall\Objects\Send\GlobalMessageHandler::class, // 全局消息
            'Login' => \Comoyi\Hall\Objects\Send\LoginHandler::class, // login
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
        foreach ($receiveHandlers as $alias => $handler) {
            container('receiver')->add($alias, new $handler);
        }

        // 发送处理
        foreach ($sendHandlers as $alias => $handler) {
            container('sender')->add($alias, new $handler);
        }

        // redis
        container('redis', RedisManager::getInstance());

        // start websocket
        container('gate')->start();
    }
}
