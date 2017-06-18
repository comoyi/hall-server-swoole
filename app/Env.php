<?php

namespace Comoyi\Hall;

use Dotenv\Dotenv;
use Illuminate\Filesystem\Filesystem;

class Env
{
    public function loadEnvConfig($path)
    {
        $fileSystem = new Filesystem();
        $envFile = realpath($path . '/.env');

        if ($fileSystem->isFile($envFile)) {
            $dotEnv = new Dotenv($path);
            $dotEnv->load();
        }
    }
}
