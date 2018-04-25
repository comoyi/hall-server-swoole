<?php

namespace Comoyi\Hall\Core;

use Comoyi\Hall\Exceptions\RecvCmdDuplicateException;
use Comoyi\Hall\Cmd\ChatRecvCmd;
use Comoyi\Hall\Handlers\Recv\RecvHandler;

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
//        'Ping' => ChatRecvCmd::PING,
//        'Login' => ChatRecvCmd::LOGIN,
        'GlobalMessage' => ChatRecvCmd::GLOBAL_MESSAGE,
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
        if ($handler instanceof RecvHandler) {
            $handler->handle($msg);
        }
    }

    /**
     * 获取处理者
     *
     * @param $cmd
     * @return RecvHandler
     */
    private function getHandler($cmd)
    {
        $internalCmd = isset($this->cmdMap[$cmd]) ? $this->cmdMap[$cmd] : $cmd;
        if (!isset($this->handlers[$internalCmd])) {
//            $class = "\\Comoyi\\Hall\\Handlers\\Recv\\{$internalCmd}Handler";
//            $handler = new $class;
//            if ($handler instanceof RecvHandler) {
//                return $handler;
//            }
            return null;
        }
        return $this->handlers[$internalCmd];
    }

    /**
     * 添加成员
     *
     * @param RecvHandler $handler
     * @throws RecvCmdDuplicateException
     */
    public function add(RecvHandler $handler)
    {
        $alias = $handler->getCmd();
        if (isset($this->handlers[$alias])) {
            $currentClass = get_class($handler);
            $class = get_class($this->handlers[$alias]);
            throw new RecvCmdDuplicateException("Recv cmd duplicated [currentClass: {$currentClass}] [cmd: {$alias}] already used by [class: {$class}].");
        }
        $this->handlers[$alias] = $handler;
    }

}
