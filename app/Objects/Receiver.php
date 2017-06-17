<?php

namespace Comoyi\Hall\Objects;

use Comoyi\Hall\Objects\Receive\ReceiveHandler;

/**
 * 消息接收者
 */
class Receiver
{

    /**
     * 处理者
     *
     * @var array
     */
    protected $handlers = [];

    /**
     * 外部命令和内部命令的对应关系
     * 没有设置的说明外部命令和内部命令相同
     *
     * @var array
     */
    protected $cmdMap = [
        // 外 => 内
        'Ping' => 'Ping',
        'Login' => 'Login',
        'GlobalMessage' => 'GlobalMessage',
    ];

    /**
     * 处理
     *
     * @param Msg $msg
     */
    public function handle(Msg $msg)
    {

        if (APP_DEBUG) {
            echo '--- receiver get ---', PHP_EOL;
//            var_dump($msg);
            print_r($msg);
        }

        // 格式不合法不处理

        $handler = $this->getHandler($msg->getCmd());

        // 判断cmd是否合法
        if ($handler instanceof ReceiveHandler) {
            $handler->handle($msg);
        }
    }

    /**
     * 获取处理者
     *
     * @param $cmd
     * @return ReceiveHandler
     */
    private function getHandler($cmd)
    {
        $internalCmd = isset($this->cmdMap[$cmd]) ? $this->cmdMap[$cmd] : $cmd;
        if (!isset($this->handlers[$internalCmd])) {
            return null;
        }
        return $this->handlers[$internalCmd];
    }

    /**
     * 添加成员
     *
     * @param $alias
     * @param ReceiveHandler $handler
     */
    public function add($alias, ReceiveHandler $handler)
    {
        $this->handlers[$alias] = $handler;
    }

}
