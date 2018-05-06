<?php

namespace Comoyi\Hall\Handlers\Recv;

use Comoyi\Hall\Factory\SendMsgFactory;
use Comoyi\Hall\Handlers\Recv\RecvHandler;
use Comoyi\Hall\Cmd\ChatSendCmd;
use Comoyi\Hall\Cmd\ChatRecvCmd;
use Comoyi\Hall\Core\Msg;

/**
 * 获取房间列表
 */
class RoomListHandler extends RecvHandler
{
    /**
     * cmd
     */
    protected $cmd = ChatRecvCmd::ROOM_LIST;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        $roomList = container('roomList');
        $lists = [];
        $rooms = $roomList->getRooms();
        foreach ($rooms as $room) {
            $tmp = [];
            $tmp['id'] = $room->getId();
            $lists[] = $tmp;
        }
        $formattedLists = json_encode($lists);

        container('sender')->handle(SendMsgFactory::create(ChatSendCmd::GLOBAL_MESSAGE, [
            'msg' => "room list [lists: {$formattedLists}]",
        ], $msg->getFd()));
    }
}
