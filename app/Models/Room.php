<?php

namespace Comoyi\Hall\Models;

/**
 * 房间
 */
class Room
{
    /**
     * id
     *
     * @var int
     */
    protected $id = 0;

    /**
     * @var array
     */
    protected $users = [];

    /**
     * Room constructor.
     */
    public function __construct()
    {
        // TODO 房间id应该全局唯一，可以从外部获取
        $this->id = uniqid();
    }

    /**
     * 添加用户
     * @param User $user
     */
    public function addUser(User $user)
    {
        $this->users[$user->getId()] = $user;
    }

    /**
     * 移除用户
     * @param User $user
     */
    public function removeUser(User $user)
    {
        unset($this->users[$user->getId()]);
    }

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
     * @return array
     */
    public function getUsers()
    {
        return $this->users;
    }
}
