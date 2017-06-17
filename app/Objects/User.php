<?php

namespace Comoyi\Hall\Objects;

/**
 * 用户
 */
class User
{

    /**
     * id
     *
     * @var int
     */
    protected $id = 0;

    /**
     * 名称
     *
     * @var string
     */
    protected $name = '';

    /**
     * 昵称
     *
     * @var string
     */
    protected $nick = '';

    /**
     * 头像
     *
     * @var string
     */
    protected $avatar = '';

    /**
     * 客户端
     *
     * @var null
     */
    protected $client = null;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * @param string $nick
     */
    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return null
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param null $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

}
