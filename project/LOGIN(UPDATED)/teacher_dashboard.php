<?php

class StudentDashboard {
    private $userId;
    private $role;

    public function __construct($userId, $role) {
        $this->userId = $userId;
        $this->role = $role;
    }

    public function displayDashboard() {
        if ($this->role !== 'teacher') {
            header("Location: index.php");
            exit();
        }

        // Student-specific content goes here
        echo "Welcome, Teacher!";
        echo "<br>";
        echo "<a href='logout.php'>Logout</a>";
    }
}

session_start();

if (isset($_SESSION['user_id'])) {
    $studentDashboard = new StudentDashboard($_SESSION['user_id'], $_SESSION['role']);
    $studentDashboard->displayDashboard();
} else {
    header("Location: index.php");
    exit();
}

?>

