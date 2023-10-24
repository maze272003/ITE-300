<?php
class DbConfig
{
    public $connection;
    function __construct()
    {
        $this->db_connect();
    }
    function __destruct()
    {

    }

    public function db_connect()
    {

        // Create connectionww
        $this->connection = mysqli_connect('localhost', 'root', '', 'lib1');
        // Check connection
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
}
?>