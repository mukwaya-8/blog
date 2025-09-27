<?php
session_start();
include('database.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blog_id = mysqli_real_escape_string($connection, $_POST['blog_id']);
    $user_id = mysqli_real_escape_string($connection, $_POST['user_id']);
    
    // Check if already shared with this user
    $checkQuery = "SELECT * FROM shares WHERE blog_id = '$blog_id' AND user_id = '$user_id'";
    $checkResult = mysqli_query($connection, $checkQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        echo json_encode(['success' => false, 'error' => 'Already shared with this user']);
        exit;
    }
    
    // Insert new share
    $query = "INSERT INTO shares (user_id, blog_id) VALUES ('$user_id', '$blog_id')";
    
    if (mysqli_query($connection, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($connection)]);
    }
    exit;
}

// Handle GET request to fetch users
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT id, email FROM users";
    $result = mysqli_query($connection, $query);
    
    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    
    echo json_encode(['success' => true, 'users' => $users]);
}
?>