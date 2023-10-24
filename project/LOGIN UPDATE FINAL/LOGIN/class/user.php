<?php
require_once("database.php");

class User extends Database {
    public function getUserById($id) {
        try {
            $query = "SELECT * FROM login WHERE ID = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function loginUser($username, $password) {
        try {
            $query = "SELECT * FROM login WHERE username = :username AND password = :password";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function registerUser($Username, $Password) {;
        try {
            $query = "INSERT INTO login (`ID`, `role`, `Username`, `Password`) VALUES ('','student',?,?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':username', $Username);
            $stmt->bindValue(':password', $Password);
            $stmt->execute(array($Username, $Password));
            return $stmt->fetch(PDO::FETCH_ASSOC)->exit;
        } catch (PDOException $e) {
            return false;
        }
    }
}



?>
