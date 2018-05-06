<?php

namespace Comoyi\Hall\Handlers\Recv;

use Comoyi\Hall\Factory\SendMsgFactory;
use Comoyi\Hall\Handlers\Recv\RecvHandler;
use Comoyi\Hall\Cmd\ChatSendCmd;
use Comoyi\Hall\Cmd\ChatRecvCmd;
use Comoyi\Hall\Core\Msg;

/**
 * 离开房间
 */
class ExitRoomHandler extends RecvHandler
{
    /**
     * cmd
     */
    protected $cmd = ChatRecvCmd::EXIT_ROOM;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        $fd = $msg->getFd();
        $clientList = container('clientList');
        $client = $clientList->getClientById($fd);
        $user = $client->getUser();

        $roomId = $msg->getData()['room_id'];

        // 获取用户
        $userList = container('userList');
        $user = $userList->getUserById($user->getId());

        // 获取房间
        $roomList = container('roomList');
        $room = $roomList->getRoomById($roomId);
        $room->removeUser($user);

        container('sender')->handle(SendMsgFactory::create(ChatSendCmd::GLOBAL_MESSAGE, [
            'msg' => "exit room [room id: {$room->getId()}], [room users" . json_encode($room->getUsers()) . ']',
        ], $msg->getFd()));
    }
}
