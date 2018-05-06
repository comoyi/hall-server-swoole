<?php

namespace Comoyi\Hall\Handlers\Recv;

use Comoyi\Hall\Factory\SendMsgFactory;
use Comoyi\Hall\Handlers\Recv\RecvHandler;
use Comoyi\Hall\Cmd\ChatSendCmd;
use Comoyi\Hall\Cmd\ChatRecvCmd;
use Comoyi\Hall\Core\Msg;

/**
 * 房间聊天
 */
class RoomMessageHandler extends RecvHandler
{
    /**
     * cmd
     */
    protected $cmd = ChatRecvCmd::ROOM_MESSAGE;

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

        // 获取房间
        $roomList = container('roomList');
        $room = $roomList->getRoomById($roomId);

        container('sender')->handle(SendMsgFactory::create(ChatSendCmd::ROOM_MESSAGE, [
            'msg' => "room message [room id: {$room->getId()}], [sender user id: {$user->getId()}], [room users" . json_encode($room->getUsers()) . ']',
            'room_id' => $room->getId(),
        ], $msg->getFd()));
    }
}
