<?php
require_once('dbconfig.php');
$db = new DbConfig();

class Publisher
{

    function __construct()
    {
    }
    function __destruct()
    {
        //echo "The fruit is {$this->name} and the color is {$this->color}.";
    }

    function getPublisherList()
    {
        global $db;
        $sql = "SELECT * FROM `publisher`";
        $result = mysqli_query(
            $db->connection,
            $sql
        );

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            return $result;
        } else {
            return array();
        }
    }
}


?>