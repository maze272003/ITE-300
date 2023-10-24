<?php

require_once("user.php");

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "lib1";
    protected $conn;

    public function __construct()
    {
        error_reporting(0);
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}

?>