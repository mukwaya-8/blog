<?php
session_start();
include('database.php');

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $image = $_POST['image'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $date = $_POST['date'];
    $likes = 0; // default likes value

    $query = "INSERT INTO blogs (title, content, author, date, image, likes) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);

    if ($stmt) {
        // "sssss" changed to "sssssi" because likes is integer
        $stmt->bind_param("sssssi", $title, $content, $author, $date, $image, $likes);

        if ($stmt->execute()) {
            header('Location: admin.php');
            exit();
        } else {
            echo "❌ Failed to post blog: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "❌ Prepare failed: " . $connection->error;
    }

    $connection->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Post a Blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .form-container {
            max-width: 600px;
            margin: 60px auto;
            padding: 30px 40px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-container input[type="text"],
        .form-container input[type="date"],
        .form-container textarea {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Post a New Blog</h2>
        <form action="blog.php" method="POST">
            <input type="text" name="title" placeholder="Title of the blog" required />
            <input type="text" name="image" placeholder="Image URL">
            <textarea name="content" rows="4" placeholder="A short description about the food..." required></textarea>
            <input type="text" name="author" placeholder="Author" required />
            <input type="date" name="date" required />
            <input type="submit" name="submit" value="Post" />
            <a href="admin.php" style="margin-left:350px; text-decoration:none; color:white; border:2px solid green; background-color:#28a745; border-radius:4px; padding:8px 12px;">Back to front page</a>
        </form>
    </div>
</body>
</html>
