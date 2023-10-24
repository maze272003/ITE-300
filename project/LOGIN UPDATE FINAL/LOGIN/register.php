<?php

require_once 'class/user.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Username = $_POST['username'];
    $Password = $_POST['password'];

    $userHandler = new User();
    $userData = $userHandler->registerUser($Username, $Password);
    // $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
} 
include("templates/regi_form.php");

?>