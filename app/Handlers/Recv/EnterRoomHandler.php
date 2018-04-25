<?php

namespace Comoyi\Hall\Handlers\Recv;

use Comoyi\Hall\Factory\SendMsgFactory;
use Comoyi\Hall\Handlers\Recv\RecvHandler;
use Comoyi\Hall\Cmd\ChatSendCmd;
use Comoyi\Hall\Cmd\ChatRecvCmd;
use Comoyi\Hall\Core\Msg;

/**
 * 进入房间
 */
class EnterRoomHandler extends RecvHandler
{
    /**
     * cmd
     */
    protected $cmd = ChatRecvCmd::ENTER_ROOM;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        $roomId = $msg->getData()['room_id'];
        $userId = $msg->getData()['user_id'];

        // 获取用户
        $userList = container('userList');
        $user = $userList->getUserById($userId);

        // 获取房间
        $roomList = container('roomList');
        $room = $roomList->getRoomById($roomId);
        $room->addUser($user);

        container('sender')->handle(SendMsgFactory::create(ChatSendCmd::GLOBAL_MESSAGE, [
            'msg' => "enter room [room id: {$room->getId()}], [room users" . json_encode($room->getUsers()) . ']',
        ], $msg->getFd()));
    }
}
