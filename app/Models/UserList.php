<?php

namespace Comoyi\Hall\Models;

/**
 * 用户列表
 */
class UserList
{
    /**
     * @var array
     */
    private $users = [];

    /**
     * 添加用户
     * @param User $user
     */
    public function add(User $user)
    {
        $this->users[$user->getId()] = $user;
    }

    /**
     * 根据用户id取用户
     * @param $id
     * @return mixed
     */
    public function getUserById($id)
    {
        return $this->users[$id];
    }
}
