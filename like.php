<?php
session_start();
include('database.php');

header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

// make it more good

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blog_id = intval($_POST['blog_id']); // safer
    $user_id = intval($_SESSION['id']);

    // Check if user already liked this blog
    $checkQuery = "SELECT * FROM likes WHERE blog_id = '$blog_id' AND user_id = '$user_id'";
    $result = mysqli_query($connection, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Unlike
        $query = "DELETE FROM likes WHERE blog_id = '$blog_id' AND user_id = '$user_id'";
        $action = 'unliked';
    } else {
        // Like
        $query = "INSERT INTO likes (blog_id, user_id) VALUES ('$blog_id', '$user_id')";
        $action = 'liked';
    }

    if (mysqli_query($connection, $query)) {
        // Get updated like count
        $countQuery = "SELECT COUNT(*) as count FROM likes WHERE blog_id = '$blog_id'";
        $countResult = mysqli_query($connection, $countQuery);
        $likeCount = mysqli_fetch_assoc($countResult)['count'];

        echo json_encode([
            'success' => true,
            'action'  => $action,
            'likes'   => $likeCount
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error'   => mysqli_error($connection)
        ]);
    }
    exit;
}

echo json_encode(['success' => false, 'error' => 'Invalid request']);
?>
