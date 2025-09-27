<?php
header('Content-Type: application/json');
include('database.php'); // Make sure this file connects to your DB

$response = ['success' => false]; // default

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blog_id = $_POST['blogs_id'] ?? null;
    $comment = $_POST['comment'] ?? null;

    if ($blog_id && $comment) {
        $blog_id = mysqli_real_escape_string($connection, $blog_id);
        $comment = mysqli_real_escape_string($connection, $comment);

        $query = "INSERT INTO comments (blogs_id, comment, created_at) 
                VALUES ('$blog_id', '$comment', NOW())";

        if (mysqli_query($connection, $query)) {
            $response['success'] = true;
        } else {
            $response['error'] = 'Database insert failed: ' . mysqli_error($connection);
        }
    } else {
        $response['error'] = $comment;
    }
} else {
    $response['error'] = 'Invalid request method';
}

echo json_encode($response);
?>
