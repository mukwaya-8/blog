<?php
session_start();
include('database.php');

if (isset($_GET['id'])) {
  $_SESSION['BLOG_ID'] = intval($_GET['id']);
  $id = $_SESSION['BLOG_ID'];
  // echo $_SESSION['BLOG_ID'];
  //  sanitize input
  $query = "SELECT * FROM blogs WHERE id = $id";
  $result = mysqli_query($connection, $query);

  $row = mysqli_fetch_assoc($result);
  // if(isset($_POST['Back to front page'])){
  //   $query="INSERT INTO blogs WHERE comment='$comment'";
  // }
  if ($row) {
    $_SESSION['title'] = $row['title'];
    $image = $row['image'];
    $_SESSION['content'] = $row['content'];
    $_SESSION['author'] = $row['author'];
    $_SESSION['date'] = $row['date'];
    $_SESSION['comment']=$row['comment'];
  } else {
    echo "Information not found";
    exit();
  }
}

if(isset($_POST['back']) && !empty($_POST['comment']) ){
  $comment = $_POST['comment'];
  $id = $_SESSION['BLOG_ID'];


  $query = "INSERT INTO comments (blogs_id, comment) VALUES ('$id', '$comment')";

  $result = mysqli_query($connection, $query);
  
  if($result){
    header('location:user.php');
  }


  if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);  
  }

  
}

else if(isset($_POST['back']) && empty($_POST['comment']) ){
  header('location:user.php');
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .zone{
      text-align:center;
      font-family:arial;
    }
    /* ...existing code... */
    
    .comments-section {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
    }

    .comments-section h3 {
        color: #333;
        margin-bottom: 20px;
        font-size: 1.5em;
    }

    .comment-item {
        background: #f8f9fa;
        border-left: 3px solid #3498db;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 4px;
    }

    .comment-text {
        color: #333;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .comment-meta {
        display: flex;
        justify-content: space-between;
        color: #666;
        font-size: 0.9em;
    }

    .commenter {
        font-weight: bold;
        color: #3498db;
    }

    .comment-date {
        color: #888;
    }

    .no-comments {
        text-align: center;
        color: #666;
        font-style: italic;
        margin: 20px 0;
    }
  </style>
</head>
<body>
  <form action="read.php" method="POST">
    <div class="zone">
      <p><?php echo $_SESSION['title']?></p>
      <img src="<?php echo $image ?>"/>;
      <p><?php echo $_SESSION['content']?></p>
      <p><?php echo $_SESSION['author']?></p>
      <p><?php echo $_SESSION['date']?></p>
      <?php
      // Fetch comments for this blog post
      $commentQuery = "SELECT comments.*, users.username 
                      FROM comments 
                      LEFT JOIN users ON comments.user_id = users.id 
                      WHERE comments.blogs_id = '$id' 
                      ORDER BY comments.created_at DESC";
      $commentResult = mysqli_query($connection, $commentQuery);

      if ($commentResult && mysqli_num_rows($commentResult) > 0) {
          echo "<div class='comments-section'>";
          echo "<h3>Comments</h3>";
          while ($comment = mysqli_fetch_assoc($commentResult)) {
              echo "<div class='comment-item'>";
              echo "<p class='comment-text'>" . htmlspecialchars($comment['comment_text']) . "</p>";
              echo "<div class='comment-meta'>";
              echo "<span class='commenter'>" . 
                   (htmlspecialchars($comment['username']) ?? 'Anonymous') . 
                   "</span>";
              echo "<span class='comment-date'>" . 
                   date('M d, Y H:i', strtotime($comment['created_at'])) . 
                   "</span>";
              echo "</div>";
              echo "</div>";
          }
          echo "</div>";
      } else {
          echo "<p class='no-comments'>No comments yet</p>";
      }
      ?>
     <textarea name="comment" id="Comment" placeholder="Write any comment..." style="width:300px; height:80px;"></textarea>
      </div>
      <div class="back" style="text-align: center; margin-top: 30px;">
  <button type="submit" name="back"
    style="
      display: inline-block;
      background-color: #3498db;
      color: white;
      padding: 12px 24px;
      font-size: 18px;
      border-radius: 8px;
      text-decoration: none;
      transition: background-color 0.3s ease;
      border: none;
      outline: none;
    "
    onmouseover="this.style.backgroundColor='#2980b9'"
    onmouseout="this.style.backgroundColor='#3498db'">
    Back to front page
  </button>
</div>

  </form>
</body>
</html>