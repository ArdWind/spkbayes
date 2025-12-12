<?php
// ...\spkbayes\app\Helpers\Database.php

namespace App\Helpers;

use PDO;

class Database
{
    public static function connect()
    {
        $config = include __DIR__ . '/../../config/database.php';

        $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['database']};charset={$config['charset']}";

        return new PDO($dsn, $config['username'], $config['password']);
    }
}
