<?php

namespace Comoyi\Hall\Task;

class SystemInfoTask extends Task
{

    /**
     * run
     *
     * @return mixed
     */
    function run()
    {
        $server = container('server');
        $server->tick(5000, function () use ($server) {
            // 使用信息
            echo PHP_EOL;
            echo '+------------- info --------------', PHP_EOL;
            echo '| client quantity:       ' . count($server->connections), PHP_EOL;
            echo '| memory_get_peak_usage: ', number_format(memory_get_peak_usage() / 1024, 2), 'K', PHP_EOL;
            echo '| memory_get_usage:      ', number_format(memory_get_usage() / 1024, 2), 'K', PHP_EOL;

            // receive queue info
            $receiveQueueSize = container('receiveQueue')->size();
            echo "| receiveQueue size:     {$receiveQueueSize}", PHP_EOL;

            // send queue info
            $sendQueueSize = container('sendQueue')->size();
            echo "| sendQueue size:        {$sendQueueSize}", PHP_EOL;

            echo '+---------------------------------', PHP_EOL, PHP_EOL, PHP_EOL, PHP_EOL, PHP_EOL;
        });
    }
}
