<?php
include('database.php');
session_start();

if (isset($_POST['register'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $role=$_POST['role'];
    $Password1 = password_hash($password, PASSWORD_DEFAULT);
    echo $Password1;

    
    $email= mysqli_real_escape_string($connection, $email);
    $Password1 = mysqli_real_escape_string($connection, $Password1);


    $query = "INSERT INTO users (email, password, role) VALUES ('$email', '$Password1','$role')";

    if (mysqli_query($connection, $query)) {
        header('Location: login.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>
