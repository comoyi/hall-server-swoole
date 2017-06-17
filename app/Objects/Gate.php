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
            echo '[' . date('Y-m-d H:i:s') . ']' . ' server started !' . PHP_EOL;
            echo "[master pid: {$server->master_pid}] [manager pid: {$server->manager_pid}]", PHP_EOL;
        });

        $server->on('workerStart', function ($server, $workerId) {
            echo '[' . date('Y-m-d H:i:s') . ']' . " worker started ! [id: {$workerId}]" . PHP_EOL;

            if (0 == $workerId) {
                $server->task('system-info');
            }
        });

        // client连接
        $server->on('open', function ($server, $request) {
            echo "client-{$request->fd} connected success.", PHP_EOL;
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

            // 使用信息
            echo PHP_EOL;
            echo '+-------------- info --------------', PHP_EOL;
            echo '| current timestamp:     ' . time(), PHP_EOL;
            echo '| client quantity:       ' . count($server->connections), PHP_EOL;
            echo '| memory_get_peak_usage: ', number_format(memory_get_peak_usage() / 1024, 2), 'K', PHP_EOL;
            echo '| memory_get_usage:      ', number_format(memory_get_usage() / 1024, 2), 'K', PHP_EOL;
            echo '+----------------------------------', PHP_EOL, PHP_EOL, PHP_EOL, PHP_EOL, PHP_EOL;
        });

        // client端开连接
        $server->on('close', function ($server, $fd) {
            foreach ($server->connections as $connection) {
                container('packet')->send($connection, [
                    'cmd' => 'GlobalMessage',
                    'msg' => $fd . ' closed'
                ]);
            }
            echo "client-{$fd} is closed\n";
        });

        //处理异步任务
        $server->on('task', function ($server, $task_id, $from_id, $data) {
            if ($data == 'system-info') {
                $task = new SystemInfoTask();
                $task->run();
            }
            $server->finish($data);
        });

        //处理异步任务的结果
        $server->on('finish', function ($server, $task_id, $data) {
            echo "AsyncTask[$task_id] Finish: ", PHP_EOL;
            echo var_dump($data), PHP_EOL;
        });

        $server->start();
    }

}
