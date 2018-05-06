<?php

namespace Comoyi\Hall\Models;

/**
 * Room列表
 */
class RoomList
{
    /**
     * @var array
     */
    private $rooms = [];

    /**
     * 添加用户
     * @param Room $room
     */
    public function add(Room $room)
    {
        $this->rooms[$room->getId()] = $room;
    }

    /**
     * 根据id获取房间
     * @param $id
     * @return Room
     */
    public function getRoomById($id)
    {
        return $this->rooms[$id];
    }

    /**
     * @return array
     */
    public function getRooms()
    {
        return $this->rooms;
    }
}
