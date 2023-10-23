<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Redirect to the appropriate dashboard based on user role
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
}
include 'templates/login_form.php';

?>
