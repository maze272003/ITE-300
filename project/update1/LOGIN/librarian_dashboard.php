<?php

class LibrarianDashboard {
    private $userId;
    private $role;

    public function __construct($userId, $role) {
        $this->userId = $userId;
        $this->role = $role;
    }

    public function displayDashboard() {
        if ($this->role !== 'Librarian') {
            header("Location: index.php");
            exit();
        }

        // Student-specific content goes here
        echo "Welcome, Librarian!";
        echo "<br>";
        echo "<a href='logout.php'>Logout</a>";
    }
}

session_start();

if (isset($_SESSION['user_id'])) {
    $librarianboard = new LibrarianDashboard($_SESSION['user_id'], $_SESSION['role']);
    $librarianboard->displayDashboard();
} else {
    header("Location: index.php");
    exit();
}

?>

