<?php
session_start();
include("database.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
  $query="SELECT * FROM blogs WHERE title='$title'";
  $result=mysqli_query($connection,$query);
  while(mysqli_fetch_assoc($result)){
  echo"<div class='box'>";
          echo "<div class='card-content'>";
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<img src='" . htmlspecialchars($row['image']) . "' alt='Blog Image'>";
              echo"<div class='size'>";
                echo "<p><strong>content:</strong> " . htmlspecialchars($row['content']) . "</p>";
                echo "<p>" . htmlspecialchars($row['author']) . "</p>";
                echo "<div class='btn'>";
                echo "<a id='view' href='read.php?id=" . $row['id'] . "'>Read more...</a>";
              // echo "<a id='delete' href='admin.php?id=" . $row['id'] . "')'>Delete</a>";
                echo "<a id='delete' onClick = 'deleteCard(". $row['id'] .")'>Delete</a>";
                echo "<a id='update' href='update.php?id=" . $row['id'] . "'>Update</a>";
              echo"</div>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
  }
  
  ?>
</body>
</html>