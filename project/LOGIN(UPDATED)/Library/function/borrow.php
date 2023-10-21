<?php
require_once('dbconfig.php');
$db = new DbConfig();

class Category
{

    function __construct()
    {
    }
    function __destruct()
    {
        //echo "The fruit is {$this->name} and the color is {$this->color}.";
    }

    function getCategoryList()
    {
        global $db;
        $sql = "SELECT * FROM `category`";
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