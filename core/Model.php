<?php

namespace App\Core;

class Model
{
    protected $db;

    public function __construct()
    {
        // Connection is now established lazily in db()
    }

    protected function db(): \PDO
    {
        if ($this->db === null) {
            $cfg = require dirname(__DIR__) . '/config/config.php';
            $dsn = "mysql:host={$cfg['host']};dbname={$cfg['dbname']};charset=utf8mb4";
            $this->db = new \PDO($dsn, $cfg['user'], $cfg['pass'], [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]);
        }

        return $this->db;
    }
}
