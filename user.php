<?php
session_start();
include('database.php');

if(isset($_POST['update'])){
  // Escape inputs to avoid SQL injection
  $id = mysqli_real_escape_string($connection, $_POST['id']);
  $title = mysqli_real_escape_string($connection, $_POST['title']);
  $image = mysqli_real_escape_string($connection, $_POST['image']);
  $content = mysqli_real_escape_string($connection, $_POST['content']);
  $author = mysqli_real_escape_string($connection, $_POST['author']);
  $comment = mysqli_real_escape_string($connection, $_POST['comment']);

  $query = "UPDATE blogs SET title='$title', image='$image', content='$content', author='$author', comment='$comment' WHERE id='$id'";
  mysqli_query($connection, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    /* --- styles unchanged --- */
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f8;
    }
    .up {
      background-color: #2c3e50;
      color: white;
      padding: 20px 0;
      text-align: center;
    }
    .up h1 { margin: 0; font-size: 24px; letter-spacing: 1px; }
    .card { display: grid; grid-template-columns: 350px 350px 350px; gap: 30px; padding: 40px; justify-items: center; }
    .box { background: #ffffff; box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 12px; width: 100%; max-width: 360px; transition: transform 0.3s ease; }
    .box:hover { transform: translateY(-5px); }
    .card-content img { max-width: 100%; height: auto; border-radius: 8px; margin-bottom: 15px; }
    .card-content h3 { font-size: 22px; margin: 0 0 10px; color: #333; text-align: center; }
    .card-content p { font-size: 16px; color: #555; margin-bottom: 8px; }
    .btn { text-align: center; margin-top: 12px; }
    .btn a { padding: 10px 18px; font-size: 14px; border-radius: 6px; text-decoration: none; font-weight: bold; transition: background-color 0.3s ease; background-color: #4CAF50; color: white; display: inline-block; }
    .btn a:hover { background-color: #45a049; }
    .foot { background-color: #2f3237; color: white; font-family: Arial; padding: 20px; }
    .foot p { margin: 5px 30px; font-size: 15px; }
    .comment { text-align: center; }
    .image { text-align: center; }
    .far.fa-heart, .fas.fa-heart { cursor: pointer; transition: color 0.2s, transform 0.2s; font-size: 20px; }
    .fas.fa-heart.liked { color: red; transform: scale(1.1); }
    .far.fa-heart { color: gray; }
    .like-count { margin-left: 5px; font-size: 15px; color: #666; }
    .comment-card { margin-top: 10px; padding: 10px; background: #f8f9fa; border-radius: 8px; }
    .comment-input-wrapper { display: flex; gap: 10px; align-items: flex-start; }
    .comment-input-wrapper textarea { flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px; resize: vertical; }
    .submit-comment { background: #4CAF50; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; transition: background-color 0.3s; }
    .submit-comment:hover { background: #45a049; }
    .comments-display { margin-top: 15px; max-height: 200px; overflow-y: auto; }
    .comment-item { background: #f8f9fa; padding: 8px 12px; margin: 5px 0; border-radius: 4px; border-left: 3px solid #4CAF50; }
    .comment-item p { margin: 0 0 5px 0; }
    .comment-item small { color: #666; font-size: 0.8em; }
    .wrapper{}
    .share-modal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center; z-index: 1000; }
    .share-content { background-color: white; padding: 20px; border-radius: 8px; width: 300px; max-height: 400px; position: relative; }
    .close-share { position: absolute; right: 10px; top: 5px; font-size: 24px; cursor: pointer; color: #666; }
    .users-list { margin-top: 15px; max-height: 300px; overflow-y: auto; }
    .user-item { padding: 10px; border-bottom: 1px solid #eee; cursor: pointer; transition: background-color 0.2s; }
    .user-item:hover { background-color: #f5f5f5; }
  </style>
</head>
<body>
  <div class="up">
    <h1>GET ALL THE UPDATES THAT YOU WANT HERE...</h1>
    <a href="logout.php" style="color:white;">Logout</a>
  </div>

  <div style="width: 100%; display: flex; justify-content: center; gap: 20px; padding-left:1em; background-color:lightgrey; ">
    <a href="user.php" style="text-decoration: none; color: inherit; text-align:center;">
      <h3 style="cursor:pointer; ">All</h3>
    </a>
    <?php 
      $query = "SELECT * FROM blogs";
      $result = mysqli_query($connection, $query);
      if($result){
        while($row = mysqli_fetch_assoc($result)){
          echo '<h3 style="cursor:pointer;" class="title-filter" data-id="' . $row['id'] . '">' . $row['title'] . '</h3>';
        }
      }
    ?>
  </div>

  <div class="card">
    <?php
// make sure your DB connection is included

$userId = $_SESSION['id'] ?? null; // ✅ use your session user ID

$query = "SELECT * FROM blogs";
$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='box'>";
    echo "<div class='card-content'>";
    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
    echo "<div class='image'><img src='" . htmlspecialchars($row['image']) . "' alt='Blog Image'></div>";
    echo "<p><strong>Content:</strong> " . htmlspecialchars($row['content']) . "</p>";
    echo "<p><strong>Author:</strong> " . htmlspecialchars($row['author']) . "</p>";
    
    echo "<div class='btn'>";
    echo "<a class='view-btn' data-id='" . $row['id'] . "' href='read.php?id=" . $row['id'] . "'>Read more...</a>";
    
    echo "<div class='wrapper'>";
    echo "<span class='like-wrapper'>";

    // ✅ Get current like count
    $likeQuery = "SELECT COUNT(*) as count FROM likes WHERE blog_id = '" . $row['id'] . "'";
    $likeResult = mysqli_query($connection, $likeQuery);
    $likeCount = mysqli_fetch_assoc($likeResult)['count'];

    // ✅ Check if THIS USER liked it
    $isLiked = false;
    if ($userId) {
        $isLikedQuery = "SELECT 1 FROM likes WHERE blog_id = '" . $row['id'] . "' AND user_id = '" . $userId . "' LIMIT 1";
        $isLikedResult = mysqli_query($connection, $isLikedQuery);
        $isLiked = mysqli_num_rows($isLikedResult) > 0;
    }

    // ✅ Heart icon depends on logged-in user
    $heartClass = $isLiked ? "fas fa-heart liked" : "far fa-heart";

    echo "<i onClick='likebtn(" . $row['id'] . ")' id='likeIcon" . $row['id'] . "' class='" . $heartClass . "'></i>";
    echo "<span class='like-count' id='likeCount" . $row['id'] . "'>" . $likeCount . "</span>";
    echo "</span>";
    echo "<span><i onClick='toggleComment(". $row['id'] .")' id='commentIcon". $row['id'] ."' class='far fa-comment'></i></span>";
    
    echo '
    <div id="commentCard' . htmlspecialchars($row['id']) . '" class="comment-card" style="display: none;">
        <div class="comment-input-wrapper">
            <input type="hidden" name="blogs_id" value="' . htmlspecialchars($row['id']) . '">
            <textarea id="commentInput' . htmlspecialchars($row['id']) . '" rows="4" placeholder="Write a comment..." name="comment"></textarea>
            <button type="button" onClick="submitComment(' . htmlspecialchars($row['id']) . ')" class="submit-comment">
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>';
    
    echo "</div>";
    echo "<span><i onClick='shareBtn(". $row['id'] .")' class='fas fa-share'></i></span>";
    echo "</div>";
    
    echo "<div class='comments-display'>";
    $commentQuery = "SELECT * FROM comments WHERE blog_id = " . $row['id'] . " ORDER BY created_at DESC";
    $commentResult = mysqli_query($connection, $commentQuery);
    
    if ($commentResult && mysqli_num_rows($commentResult) > 0) {
        while ($comment = mysqli_fetch_assoc($commentResult)) {
            echo "<div class='comment-item'>";
            echo "<p>" . htmlspecialchars($comment['comment_text']) . "</p>";
            echo "<small>Posted: " . date('M d, Y H:i', strtotime($comment['created_at'])) . "</small>";
            echo "</div>";
        }
    }
    echo "</div>"; // end comments-display
    echo "</div>"; // end card-content
    echo "</div>"; // end box
}
?>

  </div>
  
  <div id="shareModal" class="share-modal" style="display: none;">
    <div class="share-content">
        <span class="close-share">&times;</span>
        <h3>Share with:</h3>
        <div id="usersList" class="users-list">
            <!-- Users will be loaded here dynamically -->
        </div>
    </div>
  </div>
      
  <script>
    function toggleComment(id) {
        let card = document.getElementById('commentCard' + id);
        let input = document.getElementById('commentInput' + id);
        if (card.style.display === 'none') {
            card.style.display = 'block';
            input.focus();
        } else {
            card.style.display = 'none';
        }
    }

    function submitComment(id) {
        let comment = document.getElementById('commentInput' + id).value.trim();
        if (comment) {
            let formData = new FormData();
            formData.append('blogs_id', id); // fixed key name
            formData.append('comment', comment);

            fetch('comment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Comment saved successfully!');
                    document.getElementById('commentInput' + id).value = '';
                    document.getElementById('commentCard' + id).style.display = 'none';
                    location.reload();
                } else {
                    alert('Error saving comment: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving comment');
            });
        } else {
            alert('Please write a comment before submitting');
        }
    }

    function likebtn(id) {
        let formData = new FormData();
        formData.append('blog_id', id);
        alert("this is liked" + id);

        fetch('like.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {   // fixed syntax
            if (data.success) {
                const icon = document.getElementById('likeIcon' + id);
                const counter = document.getElementById('likeCount' + id);
              
                if (data.action === 'liked') {
                    icon.classList.remove('far');
                    icon.classList.add('fas', 'liked');
                } else {
                    icon.classList.remove('fas', 'liked');
                    icon.classList.add('far');
                }

                counter.textContent = data.likes;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    
    // View button fix
    document.querySelectorAll('.view-btn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const id = btn.getAttribute('data-id');
        alert('You are going to view this post ' + id);
        window.location.href = 'read.php?id=' + id;
      });
    });

    // Filtering posts by title
    document.querySelectorAll('.title-filter').forEach(title => {
      title.addEventListener('click', function() {
        const blogId = this.getAttribute('data-id');
        const cards = document.querySelectorAll('.box');
        cards.forEach(card => {
          if(card.querySelector(`a[href$="id=${blogId}"]`)) {
            card.style.display = 'block';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
    
    // Share modal
    function shareBtn(blogId) {
      const modal = document.getElementById('shareModal');
      const usersList = document.getElementById('usersList');
      modal.style.display = 'flex';
      
      fetch('share.php')
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            usersList.innerHTML = data.users.map(user => `
              <p>${user.email}</p>
            `).join('');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Error loading users');
        });
    }

    function shareTo(blog_id, user_id, username) {
      let formData = new FormData();
      formData.append('blog_id', blog_id);
      formData.append('user_id', user_id);
      
      fetch('share.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert(`Successfully shared with ${username}!`);
          document.getElementById('shareModal').style.display = 'none';
        } else {
          alert(data.error || 'Error sharing');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Error sharing');
      });
    }

    // Close modal when clicking X
    document.querySelector('.close-share').onclick = function() {
      document.getElementById('shareModal').style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
      const modal = document.getElementById('shareModal');
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    }
  </script>
</body>
<footer>
  <div class="foot">
    <p>This is the best source of information and updates.</p>
    <p>Email: jmukwaya721@gmail.com</p>
    <p>Telephone: 0793024677</p>
  </div>
</footer>
</html>
