<?php

namespace Comoyi\Hall\Core;

use Comoyi\Hall\Exceptions\SendCmdDuplicateException;
use Comoyi\Hall\Cmd\CmdSend;
use Comoyi\Hall\Handlers\Send\SendHandler;

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
//        CmdSend::PONG => 'Pong',
//        CmdSend::GLOBAL_MESSAGE => 'GlobalMessage',
    ];

    /**
     * 处理
     *
     * @param Msg $msg
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
     * @param SendHandler $handler
     * @throws SendCmdDuplicateException
     */
    public function add(SendHandler $handler)
    {
        $alias = $handler->getCmd();
        if (isset($this->handlers[$alias])) {
            $currentClass = get_class($handler);
            $class = get_class($this->handlers[$alias]);
            throw new SendCmdDuplicateException("Send cmd duplicated [currentClass: {$currentClass}] [cmd: {$alias}] already used by [class: {$class}].");
        }
        $this->handlers[$alias] = $handler;
    }

}
