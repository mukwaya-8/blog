<?php
$SERVER = "localhost";
$USER = "root";
$password = "";
$database = "blog";

// Establish the database connection
$connection = mysqli_connect($SERVER, $USER, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['delete'])) {
    // Sanitize input
    // $id = intval($_GETx['id']);  // Ensure it's an integer

    $IdInput = $_POST['deleteId'];

    // Use prepared statement to prevent SQL injection
    $query = "DELETE FROM blogs WHERE id = '$IdInput'";
    $stmt = mysqli_prepare($connection, $query);
    // mysqli_stmt_bind_param($stmt, "i", $id);
    
    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $message = "Item deleted successfully!";
        header("location: admin.php");

    } else {
        $message = "Error deleting record: " . mysqli_error($connection);
    }
    mysqli_stmt_close($stmt);
}

// Close the connection when done
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Blog Post</title>
</head>
<body>

  <!-- Display message if it's set -->
  <?php if (isset($message)) { echo "<p>$message</p>"; } ?>

  <!-- Form for deleting a blog post -->
  <div id="confirmDelete" style="display:none;">
    <form  action="admin.php"method="POST">
      <input type="text" name="id">
      <input type="submit" name="submit" value="delete">
    </form>
  </div>

</body>
</html>