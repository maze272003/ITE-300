<?php
require_once('dbconfig.php');
$db = new DbConfig();

class Book
{

    function __construct()
    {
    }
    function __destruct()
    {
        //echo "The fruit is {$this->name} and the color is {$this->color}.";
    }

    function getBookList($search)
    {
        global $db;

        $where = "";
        if ($search['title'] != "") {
            $where = $where . "AND B.Title LIKE '%" . $search['title'] . "%'";
        }
        if ($search['category'] != "") {

            $where = $where . "AND C.Id = '" . $search['category'] . "' ";
        }
        if ($search['publisher'] != "") {
            $where = $where . "AND P.Id = '" . $search['publisher'] . "'";
        }


        if ($where != "") {
            $where = "WHERE 1=1 " . $where;
        }
        $sql = "SELECT 
                    B.Id,
                    B.Title,
                    B.Description,
                    C.Name as Category,
                    P.Name as Publisher
                FROM books B
                LEFT JOIN category C ON B.Category_Id = C.Id
                LEFT JOIN publisher P ON P.Id = B.Publisher_Id
                " . $where
        ;
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