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
            // Handle any database connection or query errors here
            // For debugging purposes, you can use: echo $e->getMessage();
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
            // Handle any database connection or query errors here
            // For debugging purposes, you can use: echo $e->getMessage();
            return false;
        }
    }
}

// Example usage:
$user = new User();
$userData = $user->getUserById(1); // Replace 1 with the desired user ID
if ($userData) {
    // User data found
    print_r($userData);
} else {
    // Handle the case when the user data is not found or there is an error
}

?>
