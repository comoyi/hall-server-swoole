<?php

namespace Comoyi\Hall\Objects;

/**
 * 客户端
 */
class Client
{

    /**
     * id
     *
     * @var int
     */
    protected $id = 0;

    /**
     * 用户
     *
     * @var User
     */
    protected $user = null;

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
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {

        // 设置用户对应的client
        $user->setClient($this);

        $this->user = $user;
    }

}
