<?php

namespace Comoyi\Hall\Models;

use SplObjectStorage;

/**
 * Client列表
 */
class ClientList extends SplObjectStorage
{
    /**
     * 添加用户
     * @param Client $client
     */
    public function add(Client $client)
    {
        $this->attach($client);
    }
}
