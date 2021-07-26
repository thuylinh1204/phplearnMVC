<?php
namespace App\Models;

class DbConnect
{
    private $configs;
    protected $conn;

    public function __construct() {
        $this->configs = require_once '../configs/database.php';

        $this->conn = $this->connect();
    }

    protected function connect()
    {
        try {
            $dns = "mysql:host=" . $this->configs['db_host'];
            $dns .= ";dbname=" . $this->configs['db_name'];
            $conn = new \PDO($dns,
                $this->configs['db_user'], $this->configs['db_password']);
            // set the PDO error mode to exception
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(\PDOException $e) {
            return false;
        }
    }
}

