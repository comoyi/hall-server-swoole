<?php

namespace Comoyi\Hall\Core;

/**
 * 消息
 */
class Msg
{

    /**
     * @var int
     */
    protected $fd = 0;

    /**
     * @var string
     */
    protected $cmd = '';

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @return int
     */
    public function getFd()
    {
        return $this->fd;
    }

    /**
     * @param int $fd
     */
    public function setFd($fd)
    {
        $this->fd = $fd;
    }

    /**
     * @return string
     */
    public function getCmd()
    {
        return $this->cmd;
    }

    /**
     * @param string $cmd
     */
    public function setCmd($cmd)
    {
        $this->cmd = $cmd;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }


}
