<?php

namespace Comoyi\Hall\Task;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Output\ConsoleOutput;

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
        $server->tick(5000, function ($tickId) use ($server) {
            // 使用信息
            $table = new Table(new ConsoleOutput());
            $table
                ->setHeaders([
                    [
                        new TableCell('system info', [
                            'colspan' => 2,
                        ]),
                    ],
                ])
                ->addRow([
                    'current time',
                    date('Y-m-d H:i:s'),
                ])
                ->addRow([
                    'current timestamp',
                    time(),
                ])
                ->addRow([
                    'client quantity',
                    count($server->connections),
                ])
                ->addRow([
                    'memory_get_peak_usage',
                    number_format(memory_get_peak_usage() / 1024, 2) . 'K',
                ])
                ->addRow([
                    'memory_get_usa中ge',
                    number_format(memory_get_usage() / 1024, 2) . 'K'
                ])
                ->addRow([
                    'receiveQueue size',
                    container('receiveQueue')->size(),
                ])
                ->addRow([
                    'sendQueue size',
                    container('sendQueue')->size(),
                ]);
            $table->render();
        });
    }
}
