<?php

namespace Comoyi\Hall\Models;

/**
 * Client列表
 */
class ClientList
{
    /**
     * @var array
     */
    private $clients = [];

    /**
     * 添加用户
     * @param Client $client
     */
    public function add(Client $client)
    {
        $this->clients[$client->getId()] = $client;
    }

    /**
     * 根据id获取Client
     * @param $id
     * @return Client
     */
    public function getClientById($id)
    {
        return $this->clients[$id];
    }
}
