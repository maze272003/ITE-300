<?php
require_once 'class/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userHandler = new User();
    $userData = $userHandler->loginUser($username, $password);

    if ($userData) {
        session_start();
        $_SESSION['user_id'] = $userData['ID'];
        $_SESSION['username'] = $userData['Username'];
        $_SESSION['role'] = $userData['role'];

        switch ($_SESSION['role']) {
            case 'admin':
                header("Location: admin_dashboard.php");
                break;
            case 'student':
                header("Location: student_dashboard.php");
                break;
            default:
                // Handle unexpected role
                break;
        }
        exit();
    } else {
        echo "Invalid credentials. Please try again.";
    }

    if (isset($_SESSION['user'])) {
        echo "Current session user is: " . $_SESSION['user'];
    } else {
        echo "No user in the current session.";
    }
}
?>