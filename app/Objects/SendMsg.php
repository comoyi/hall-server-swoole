<?php

namespace Comoyi\Hall\Objects;

/**
 * 消息
 */
class SendMsg extends Msg
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
     * SendMsg constructor.
     *
     * @param $cmd
     * @param $data
     * @param $fd
     */
    public function __construct($cmd = null, $data = null, $fd = null)
    {
        $this->setCmd($cmd);
        $this->setData($data);
        $this->setFd($fd);
    }

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
