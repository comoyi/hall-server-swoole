<?php

namespace Comoyi\Hall\Objects;

use Comoyi\Hall\Task\SystemInfoTask;
use Swoole\Websocket\Server as SwooleWebsocketServer;

/**
 * 消息网关
 */
class Gate
{

    /**
     * start
     */
    public function start()
    {
        $server = new SwooleWebsocketServer(WEBSOCKET_HOST, WEBSOCKET_PORT);

        // 添加到容器
        container('server', $server);

        // 设置task worker 数量
        $server->set([
            'worker_num' => 3,
            'task_worker_num' => 5,
        ]);

        // 服务开启
        $server->on('start', function ($server) {
            echo '[' . date('Y-m-d H:i:s') . ']' . ' server started!' . PHP_EOL;
            echo "[master pid: {$server->master_pid}] [manager pid: {$server->manager_pid}]" . PHP_EOL;
        });

        $server->on('workerStart', function ($server, $workerId) {
            echo '[' . date('Y-m-d H:i:s') . ']' . " worker started! [id: {$workerId}]" . PHP_EOL;

            if (0 == $workerId) {
                $server->task('system-info');
            }
        });

        // client连接
        $server->on('open', function ($server, $request) {
            echo "client-{$request->fd} connected success." . PHP_EOL;
            foreach ($server->connections as $connection) {
                container('packet')->send($connection, [
                    'cmd' => 'GlobalMessage',
                    'msg' => $request->fd . ' connected success.'
                ]);
            }
        });

        // 收到消息
        $server->on('message', function ($server, $frame) {
            // 例 $frame->data {"packageId":"","clientId":"","packageType":"","token":"","data":[{"cmd":"ping"},{"cmd":"login","username":"user-1","password":"pwd-1"}]}
            container('packet')->receive($frame);
        });

        // client端开连接
        $server->on('close', function ($server, $fd) {
            foreach ($server->connections as $connection) {
                container('packet')->send($connection, [
                    'cmd' => 'GlobalMessage',
                    'msg' => $fd . ' closed'
                ]);
            }
            echo "client-{$fd} is closed" . PHP_EOL;
        });

        //处理异步任务
        $server->on('task', function ($server, $taskId, $fromId, $data) {
            if ($data == 'system-info') {
                $task = new SystemInfoTask();
                $task->run();
            }
            $server->finish($data);
        });

        //处理异步任务的结果
        $server->on('finish', function ($server, $taskId, $data) {
            echo "AsyncTask[$taskId] Finish: ", PHP_EOL;
            echo var_dump($data), PHP_EOL;
        });

        $server->start();
    }

}
