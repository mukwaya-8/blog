<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "blog");

// Initialize variables
$row = null;
$error = null;

// Handle form submission
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $image = mysqli_real_escape_string($connection, $_POST['image']);
    $content = mysqli_real_escape_string($connection, $_POST['content']);
    $author = mysqli_real_escape_string($connection, $_POST['author']);

    $updateQuery = "UPDATE blogs SET title='$title', image='$image', content='$content', author='$author' WHERE id=$id";
    $updateResult = mysqli_query($connection, $updateQuery);

    header('location:admin.php');

    if ($updateResult) {
        header('Location: admin.php');
        exit;
    } else {
        $error = "Error updating blog: " . mysqli_error($connection);
    }
}

// Get the blog ID from either POST or GET
$id = isset($_POST['id']) ? intval($_POST['id']) : (isset($_GET['id']) ? intval($_GET['id']) : null);

if ($id) {
    $query = "SELECT * FROM blogs WHERE id = '$id'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        $error = "Blog not found.";
    }
} else {
    $error = "No blog ID provided in URL.";
}

// If there's an error and we're not processing a form submission, show error and exit
if ($error && !isset($_POST['update'])) {
    echo "<p style='color:red; text-align:center;'>$error</p>";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit blog</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: linear-gradient(to right, #fffde7, #ffe082);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
    }

    form {
      background-color: #ffffff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      max-width: 500px;
      width: 100%;
    }

    form h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #444;
      font-size: 28px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #333;
    }

    input[type="text"],
    textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    textarea:focus {
      outline: none;
      border-color: #f57c00;
    }

    textarea {
      resize: vertical;
      min-height: 100px;
    }

    button {
      width: 100%;
      padding: 14px;
      background-color: #f57c00;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #ef6c00;
    }

    @media (max-width: 600px) {
      form {
        padding: 25px;
      }
    }
  </style>
</head>
<body>
  <form action="update.php?id=<?= $row['id'] ?>" method="POST">
    <h2>Edit content</h2>
    
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <label>Title</label>
    <input type="text" name="title" placeholder="title" value="<?= htmlspecialchars($row['title'])?>">
    
    <label>Image URL</label>
    <input type="text" name="image" value="<?= htmlspecialchars($row['image']) ?>" required>

    <label>Content</label>
    <textarea name="content" required><?= htmlspecialchars($row['content']) ?></textarea>

    <label>Author</label>
    <input type="text" name="author" value="<?= htmlspecialchars($row['author']) ?>" required>

    <button type="submit" name="update">Update</button>
  </form>
</body>
</html>