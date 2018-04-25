<?php

namespace Comoyi\Hall\Handlers\Recv;

use Comoyi\Hall\Factory\SendMsgFactory;
use Comoyi\Hall\Handlers\Recv\RecvHandler;
use Comoyi\Hall\Cmd\ChatSendCmd;
use Comoyi\Hall\Cmd\ChatRecvCmd;
use Comoyi\Hall\Core\Msg;
use Comoyi\Hall\Models\Room;

/**
 * 创建房间
 */
class CreateRoomHandler extends RecvHandler
{
    /**
     * cmd
     */
    protected $cmd = ChatRecvCmd::CREATE_ROOM;

    /**
     * handle
     *
     * @param Msg $msg
     * @return mixed
     */
    public function handle(Msg $msg)
    {
        $room = new Room();
        container('roomList')->add($room);

        container('sender')->handle(SendMsgFactory::create(ChatSendCmd::GLOBAL_MESSAGE, [
            'msg' => "create room [id: {$room->getId()}]",
        ], $msg->getFd()));
    }
}
