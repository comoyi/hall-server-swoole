<?php

namespace Comoyi\Hall\Objects;

use Comoyi\Hall\Objects\Send\SendHandler;

/**
 * 消息发送者
 */
class Sender
{

    /**
     * 成员
     *
     * @var array
     */
    protected $handlers = [];

    /**
     * 内部命令和外部命令的对应关系
     * 没有设置的说明内部命令和外部命令相同
     *
     * @var array
     */
    protected $cmdMap = [
        // 内 => 外
        'Pong' => 'Pong'
    ];

    /**
     * 处理
     *
     * @param Msg $msg
     * @internal param $data
     */
    public function handle(Msg $msg)
    {

        if (APP_DEBUG) {
            echo '--- sender get ---', PHP_EOL;
//            var_dump($msg);
            print_r($msg);
        }

        // 判断处理者是否存在
        $handler = $this->getHandler($msg->getCmd());
        if ($handler) {
            $handler->handle($msg);
        }

    }

    /**
     * 处理
     *
     * @param $cmd
     * @return SendHandler
     */
    private function getHandler($cmd)
    {
        if (!isset($this->handlers[$cmd])) {
            return null;
        }
        return $this->handlers[$cmd];
    }

    /**
     * 获取外部对应cmd
     *
     * @param $cmd
     * @return mixed
     */
    public function getExternalCmd($cmd)
    {
        $externalCmd = isset($this->cmdMap[$cmd]) ? $this->cmdMap[$cmd] : $cmd;
        return $externalCmd;
    }

    /**
     * 添加处理者
     *
     * @param $alias
     * @param SendHandler $handler
     */
    public function add($alias, SendHandler $handler)
    {
        $this->handlers[$alias] = $handler;
    }

}
