<?php
session_start();
include('database.php');   

if (isset($_POST['login'])) {
    // Sanitize user input
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = $_POST['password'];

    // Only select users with role = 'admin'
    $query = "SELECT *FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Debug output to check password values
        // Remove these lines after debugging
        echo "Entered password: " . htmlspecialchars($password) . "<br>";
        echo "Hashed password from DB: " . htmlspecialchars($user['password']) . "<br>";

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session and redirect to admin panel
            $_SESSION['email'] = $user['email'];
            $_SESSION['id']=$user['id'];
            $_SESSION['role']=$user['role'];
            if($_SESSION['role']=="Admin"){
            header('Location: admin.php');
            }
            elseif($_SESSION['role']=="User"){
                header('location:user.php');
            }
        else {
            echo"missing the credentials";
        }
    } else {
        echo "❌ Account not found.";
    }
}
}

mysqli_close($connection);
?>