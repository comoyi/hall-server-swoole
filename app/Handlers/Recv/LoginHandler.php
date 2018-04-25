<?php

namespace Comoyi\Hall\Handlers\Recv;

use Comoyi\Hall\Factory\SendMsgFactory;
use Comoyi\Hall\Handlers\Recv\RecvHandler;
use Comoyi\Hall\Logic\UserLogic;
use Comoyi\Hall\Cmd\ChatSendCmd;
use Comoyi\Hall\Cmd\ChatRecvCmd;
use Comoyi\Hall\Models\Client;
use Comoyi\Hall\Core\Msg;
use Comoyi\Hall\Models\User;

/**
 * 登录
 */
class LoginHandler extends RecvHandler
{
    /**
     * cmd
     */
    protected $cmd = ChatRecvCmd::LOGIN;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        $username = $msg->getData()['username'];
        $password = $msg->getData()['password'];

        // 验证用户帐号密码
        $userLogic = new UserLogic();
        $res = $userLogic->login($username, $password);
        if (false === $res) { // 验证错误

            // 发送消息 登录失败
            container('sender')->handle(SendMsgFactory::create($msg->getCmd(), [
                'code' => 1,
                'msg' => '帐号或密码错误',
            ], $msg->getFd()));

            return;
        }

        $userId = $res;

        // 创建用户对象
        $user = new User();
        $user->setId($userId);
        container('userList')->add($user);

        // 生成用户对应token
        $token = uniqid();
        // 存储token与用户对应关系
        $redisKey = 'token:user_id:' . $userId;
        $redis = container('redis');

        $redis->hMSet($redisKey, [
            'token' => $token,
            'time' => time()
        ]);
        $redis->expire($redisKey, 3600 * 24 * 30);

        $redisKey = 'token:' . $token;
        $redis->set($redisKey, $userId, ['ex' => 3600 * 24 * 30]);

        $client = new Client();
        $client->setId($msg->getFd());
        $client->setUser($user);
        container('clientList')->add($client);

        container('sender')->handle(SendMsgFactory::create(ChatSendCmd::LOGIN, [
            'code' => 0,
            'userID' => $userId,
            'token' => $token
        ], $msg->getFd()));
    }
}
