<?php

/**
 * подключение к базе данных
 */
class Database
{
    private $host = "127.0.0.1";
    private $db_name = "users";
    private $username = "root";
    private $password = "";
    public $conn;
    public function __construct()
    {
        $this->conn = parent::__construct($this->host, $this->username, $this->password, $this->db_name);
    }
}