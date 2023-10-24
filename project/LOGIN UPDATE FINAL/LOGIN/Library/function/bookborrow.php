<?php
require_once('dbconfig.php');
$db = new DbConfig();

class BookBorrow
{

    function __construct()
    {
    }
    function __destruct()
    {
        //echo "The fruit is {$this->name} and the color is {$this->color}.";
    }

    function add($data)
    {
        global $db;

        $sql = "INSERT INTO bookborrow (bookId, borrowFrom, borrowTo, userId) VALUES (" . $data['bookId'] . ",'" . $data['borrowFrom'] . "','" . $data['borrowTo'] . "'," . $data['borrowerId'] . ")";
        $result = mysqli_query(
            $db->connection,
            $sql
        );
        if ($result) {
            return "New record created successfully";
        } else {
            return "Error: " . $sql . "<br>" . mysqli_error($db->connection);
        }
    }
    function bookborrowlist($search)
    {
        global $db;
        $where = "";
        if ($search['title'] != "") {
            $where = $where . "AND B.Title LIKE '%" . $search['title'] . "%'";
        }
        if ($search['borrower'] != "") {

            $where = $where . "AND L.Username like '%" . $search['borrower'] . "%' ";
        }



        if ($where != "") {
            $where = "WHERE 1=1 " . $where;
        }
        $sql = "SELECT BB.id, b.Title, BB.borrowFrom, BB.borrowTo, L.Username as borrower FROM bookborrow BB 
                LEFT JOIN books B on B.Id = BB.bookId 
                LEFT JOIN login L on L.ID = BB.userId
                " . $where;

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