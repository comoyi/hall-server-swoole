<?php

namespace Comoyi\Hall\Logic;

/**
 * 用户逻辑
 */
class UserLogic {

    /**
     * 登录
     *
     * @param int|string $username 帐号
     * @param string $password 密码
     * @return bool|int
     */
    public function login($username, $password) {

        // TODO
        if (false) { // 帐号密码错误
            return false;
        }

        $userId = time() . mt_rand(10000, 99999);
        return $userId;
    }

}