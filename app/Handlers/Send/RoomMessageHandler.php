<?php

namespace Comoyi\Hall\Handlers\Send;

use Comoyi\Hall\Handlers\Send\SendHandler;
use Comoyi\Hall\Cmd\ChatSendCmd;
use Comoyi\Hall\Core\Msg;

/**
 * 房间消息
 */
class RoomMessageHandler extends SendHandler
{

    /**
     * cmd
     */
    protected $cmd = ChatSendCmd::ROOM_MESSAGE;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        $data = [
            ChatSendCmd::CMD => ChatSendCmd::ROOM_MESSAGE,
            'msg' => $msg->getData()['msg'],
        ];

        $roomId = $msg->getData()['room_id'];
        // 获取房间
        $roomList = container('roomList');
        $room = $roomList->getRoomById($roomId);
        $users = $room->getUsers();

        // 发送给所有房间内用户
        foreach ($users as $user) {
            $client = $user->getClient();
            $fd = $client->getId();
            container('packet')->send($fd, $data);
        }
    }
}
