<?php
session_start();

include('database.php');
if(isset($_POST['update'])){
  $id=$_POST['id'];
  $title=$_POST['title'];
  $image=$_POST['image'];
  $content=$_POST['content'];
  $author=$_POST['author'];

  $query="UPDATE blogs SET title='$title', image='$image', content='$content', author='$author' WHERE id='$id'";
  mysqli_query($connection,$query);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-600: #4f46e5;
      --primary-700: #4338ca;
      --primary-50: #eef2ff;
      --primary-100: #e0e7ff;
      --gray-50: #f9fafb;
      --gray-100: #f3f4f6;
      --gray-200: #e5e7eb;
      --gray-300: #d1d5db;
      --gray-400: #9ca3af;
      --gray-500: #6b7280;
      --gray-600: #4b5563;
      --gray-700: #374151;
      --gray-800: #1f2937;
      --gray-900: #111827;
      --success-600: #059669;
      --success-700: #047857;
      --error-600: #dc2626;
      --error-700: #b91c1c;
      --warning-600: #d97706;
      --warning-700: #b45309;
      --white: #ffffff;
      --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
      --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
      --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
      --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
      --ring-primary: 0 0 0 3px rgb(79 70 229 / 0.1);
      --border-radius-sm: 0.375rem;
      --border-radius-md: 0.5rem;
      --border-radius-lg: 0.75rem;
      --border-radius-xl: 1rem;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background-color: var(--gray-50);
      color: var(--gray-900);
      line-height: 1.6;
      font-size: 16px;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    .page {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Header Section */
    .up {
      background: var(--white);
      border-bottom: 1px solid var(--gray-200);
      padding: 2rem 0;
      position: relative;
    }

    .header-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 2rem;
      display: flex;
      justify-content: between;
      align-items: center;
    }

    .word {
      flex: 1;
    }

    .word h1 {
      font-size: 2rem;
      font-weight: 700;
      color: var(--gray-900);
      margin-bottom: 0.5rem;
      letter-spacing: -0.025em;
      line-height: 1.2;
    }

    .word p {
      font-size: 1.125rem;
      color: var(--gray-600);
      font-weight: 400;
      margin: 0;
    }

    .logout-btn {
      background: var(--error-600);
      color: var(--white);
      padding: 0.75rem 1.5rem;
      text-decoration: none;
      border-radius: var(--border-radius-md);
      font-weight: 500;
      font-size: 0.875rem;
      transition: all 0.2s ease-in-out;
      box-shadow: var(--shadow-sm);
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .logout-btn:hover {
      background: var(--error-700);
      box-shadow: var(--shadow-md);
      transform: translateY(-1px);
    }

    .logout-btn:focus {
      outline: none;
      box-shadow: var(--ring-primary), var(--shadow-md);
    }

    /* Filter Section */
    .filter-section {
      background: var(--white);
      border-bottom: 1px solid var(--gray-200);
      padding: 1.5rem 0;
      overflow-x: auto;
    }

    .filter-btn {
      background: var(--white);
      color: var(--gray-700);
      padding: 0.75rem 1.25rem;
      border: 1px solid var(--gray-200);
      border-radius: var(--border-radius-md);
      font-weight: 500;
      font-size: 0.875rem;
      cursor: pointer;
      transition: all 0.2s ease-in-out;
      position: relative;
      overflow: hidden;
    }

    .filter-btn:hover {
      background: var(--primary-50);
      color: var(--primary-600);
      border-color: var(--primary-600);
      transform: translateY(-1px);
      box-shadow: var(--shadow-sm);
    }

    .filter-btn.active {
      background: var(--primary-600);
      color: var(--white);
      border-color: var(--primary-600);
      box-shadow: var(--shadow-md);
    }

    .filter-btn:focus {
      outline: none;
      box-shadow: var(--ring-primary);
    }

    .filter-btn::after {
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background: var(--primary-600);
      opacity: 0;
      transition: opacity 0.2s ease;
      pointer-events: none;
    }

    .filter-btn:active::after {
      opacity: 0.1;
    }

    .filter-container {
      display: flex;
      gap: 0.75rem;
      flex-wrap: wrap;
      align-items: center;
      padding: 1rem 2rem;
      background: var(--white);
      border-radius: var(--border-radius-lg);
      box-shadow: var(--shadow-sm);
    }

    @media (max-width: 768px) {
      .filter-btn {
        padding: 0.5rem 1rem;
        font-size: 0.8125rem;
      }
      
      .filter-container {
        padding: 0.75rem 1rem;
        gap: 0.5rem;
      }
    }

    /* Main Content */
    .main-content {
      flex: 1;
      max-width: 1280px;
      margin: 0 auto;
      padding: 3rem 2rem;
      width: 100%;
    }

    .card {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
      gap: 2rem;
    }

    .box {
      background: var(--white);
      border-radius: var(--border-radius-xl);
      padding: 1.5rem;
      box-shadow: var(--shadow-md);
      border: 1px solid var(--gray-200);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .box:hover {
      box-shadow: var(--shadow-xl);
      transform: translateY(-2px);
      border-color: var(--gray-300);
    }

    .card-content h3 {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--gray-900);
      margin-bottom: 1rem;
      line-height: 1.4;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
      min-height: 3.2em;
    }

    .card-content img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      object-position: center;
      border-radius: var(--border-radius-lg);
      margin: 0 0 1rem 0;
      box-shadow: var(--shadow-sm);
      transition: all 0.3s ease;
      border: 1px solid var(--gray-200);
      image-rendering: -webkit-optimize-contrast;
      image-rendering: crisp-edges;
      backface-visibility: hidden;
      transform: translateZ(0);
    }

    .card-content img:hover {
      box-shadow: var(--shadow-md);
    }

    .size {
      margin-bottom: 1.5rem;
    }

    .size p {
      color: var(--gray-600);
      line-height: 1.6;
      margin-bottom: 0.75rem;
      font-size: 0.875rem;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .size p:last-child {
      margin-bottom: 0;
    }

    .size p strong {
      color: var(--gray-800);
      font-weight: 600;
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    /* Button Styling */
    .btn {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 0.75rem;
      margin-top: 1.5rem;
    }

    .btn a {
      text-align: center;
      padding: 0.625rem 1rem;
      border-radius: var(--border-radius-md);
      text-decoration: none;
      font-weight: 500;
      font-size: 0.875rem;
      transition: all 0.2s ease-in-out;
      cursor: pointer;
      border: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      box-shadow: var(--shadow-sm);
    }

    .btn a:focus {
      outline: none;
      box-shadow: var(--ring-primary), var(--shadow-sm);
    }

    .btn-view {
      background: var(--success-600);
      color: var(--white);
      border: 1px solid var(--success-600);
    }

    .btn-view:hover {
      background: var(--success-700);
      border-color: var(--success-700);
      box-shadow: var(--shadow-md);
      transform: translateY(-1px);
    }

    .btn-delete {
      background: var(--error-600);
      color: var(--white);
      border: 1px solid var(--error-600);
    }

    .btn-delete:hover {
      background: var(--error-700);
      border-color: var(--error-700);
      box-shadow: var(--shadow-md);
      transform: translateY(-1px);
    }

    .btn-update {
      background: var(--primary-600);
      color: var(--white);
      border: 1px solid var(--primary-600);
    }

    .btn-update:hover {
      background: var(--primary-700);
      border-color: var(--primary-700);
      box-shadow: var(--shadow-md);
      transform: translateY(-1px);
    }

    /* Modal Styling */
    #updateModal, #deleteMessage {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(4px);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
      padding: 1rem;
    }

    #updateModal form, #deleteMessage form {
      background: var(--white);
      padding: 2rem;
      border-radius: var(--border-radius-xl);
      box-shadow: var(--shadow-xl);
      text-align: center;
      min-width: 400px;
      max-width: 90vw;
      border: 1px solid var(--gray-200);
    }

    #updateModal form p, #deleteMessage form p {
      font-size: 1.125rem;
      color: var(--gray-800);
      margin-bottom: 2rem;
      font-weight: 500;
      line-height: 1.5;
    }

    #updateModal form input[type="button"], 
    #deleteMessage form input[type="button"],
    #deleteMessage form input[type="submit"] {
      padding: 0.75rem 1.5rem;
      border: 1px solid transparent;
      border-radius: var(--border-radius-md);
      font-weight: 500;
      font-size: 0.875rem;
      cursor: pointer;
      transition: all 0.2s ease-in-out;
      margin: 0 0.5rem;
      box-shadow: var(--shadow-sm);
    }

    #cancel, #cancel-update {
      background: var(--gray-100);
      color: var(--gray-700);
      border-color: var(--gray-300);
    }

    #cancel:hover, #cancel-update:hover {
      background: var(--gray-200);
      border-color: var(--gray-400);
      box-shadow: var(--shadow-md);
    }

    #confirmDelete {
      background: var(--error-600);
      color: var(--white);
      border-color: var(--error-600);
    }

    #confirmDelete:hover {
      background: var(--error-700);
      border-color: var(--error-700);
      box-shadow: var(--shadow-md);
    }

    #updateBtn {
      background: var(--primary-600);
      color: var(--white);
      border-color: var(--primary-600);
    }

    #updateBtn:hover {
      background: var(--primary-700);
      border-color: var(--primary-700);
      box-shadow: var(--shadow-md);
    }

    /* Footer Styling */
    footer {
      background: var(--gray-900);
      color: var(--gray-100);
      padding: 3rem 0 2rem;
      margin-top: auto;
    }

    .foot {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 2rem;
      text-align: center;
    }

    .foot p {
      margin-bottom: 0.5rem;
      color: var(--gray-300);
      font-size: 0.875rem;
      line-height: 1.6;
    }

    .foot p:first-child {
      font-size: 1.125rem;
      font-weight: 600;
      color: var(--white);
      margin-bottom: 1rem;
    }

    .create {
      margin-top: 2rem;
      display: flex;
      justify-content: center;
    }

    .upload a {
      background: var(--primary-600);
      color: var(--white);
      padding: 1rem 2rem;
      text-decoration: none;
      border-radius: var(--border-radius-md);
      font-weight: 500;
      font-size: 1rem;
      transition: all 0.2s ease-in-out;
      box-shadow: var(--shadow-md);
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .upload a:hover {
      background: var(--primary-700);
      box-shadow: var(--shadow-lg);
      transform: translateY(-1px);
    }

    .upload a:focus {
      outline: none;
      box-shadow: var(--ring-primary), var(--shadow-lg);
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
      .card {
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
      }
      
      .main-content {
        padding: 2rem 1rem;
      }
    }

    @media (max-width: 768px) {
      .header-container {
        flex-direction: column;
        gap: 1.5rem;
        text-align: center;
      }
      
      .word h1 {
        font-size: 1.75rem;
      }
      
      .word p {
        font-size: 1rem;
      }
      
      .card {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }
      
      .filter-container {
        padding: 0 1rem;
      }
      
      .main-content {
        padding: 1.5rem 1rem;
      }
      
      .btn {
        grid-template-columns: 1fr;
        gap: 0.5rem;
      }
      
      .box {
        padding: 1.25rem;
      }
      
      #updateModal form, #deleteMessage form {
        min-width: 320px;
        padding: 1.5rem;
      }
    }

    @media (max-width: 480px) {
      .header-container,
      .filter-container,
      .main-content,
      .foot {
        padding-left: 1rem;
        padding-right: 1rem;
      }
      
      .word h1 {
        font-size: 1.5rem;
      }
      
      .filter-section a,
      .filter-section h3 {
        font-size: 0.8125rem;
        padding: 0.375rem 0.75rem;
      }
      
      .card-content h3 {
        font-size: 1.125rem;
      }
    }

    /* Animation for cards */
    .box {
      animation: fadeInUp 0.6s ease forwards;
      opacity: 0;
      transform: translateY(20px);
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .box:nth-child(1) { animation-delay: 0.05s; }
    .box:nth-child(2) { animation-delay: 0.1s; }
    .box:nth-child(3) { animation-delay: 0.15s; }
    .box:nth-child(4) { animation-delay: 0.2s; }
    .box:nth-child(5) { animation-delay: 0.25s; }
    .box:nth-child(6) { animation-delay: 0.3s; }

    /* Professional scrollbar */
    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }

    ::-webkit-scrollbar-track {
      background: var(--gray-100);
    }

    ::-webkit-scrollbar-thumb {
      background: var(--gray-400);
      border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: var(--gray-500);
    }

    /* Focus states for accessibility */
    button:focus,
    input:focus,
    a:focus {
      outline: 2px solid var(--primary-600);
      outline-offset: 2px;
    }

    /* Utility classes */
    .sr-only {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border: 0;
    }

    /* Loading states and empty states could be added here */
    .loading {
      opacity: 0.6;
      pointer-events: none;
    }

    /* Better focus indicators */
    .btn a:focus-visible {
      outline: 2px solid var(--primary-600);
      outline-offset: 2px;
    }
  </style>
</head>
<body>
  <div class="page">
    <div class="up">
      <div class="header-container">
        <div class="word">
          <h1>Content Management Dashboard</h1>
          <p>Manage and organize your blog content efficiently</p>
        </div>
        <a href="logout.php" class="logout-btn">
          <span>Logout</span>
        </a>
      </div>
    </div>
    
    <!-- Update Modal with corrected ID -->
    <div id="updateModal" style="display:none;" role="dialog" aria-modal="true" aria-labelledby="update-modal-title">
      <form>
        <input type="hidden" name="updateId" id="Idupdate">
        <p id="update-modal-title">Do you need to update this card?</p>
        <div style="display: flex; gap: 0.5rem; justify-content: center;">
          <input type="button" id="cancel-update" value="Cancel" onClick="closeUpdateCard()">
          <input type="button" id="updateBtn" value="Update" onClick="confirmUpdate()">
        </div>
      </form>
    </div>
    
    <div id="deleteMessage" style="display: none;" role="dialog" aria-modal="true" aria-labelledby="delete-modal-title">
      <form action="delete.php" method="POST">
        <input type="hidden" name="deleteId" id="IdInput">
        <p id="delete-modal-title">Are you sure you want to delete this card?</p>
        <div style="display: flex; gap: 0.5rem; justify-content: center;">
          <input type="button" id="cancel" value="Cancel" onClick="closeDeleteCard()">
          <input type="submit" name="delete" value="Delete" id="confirmDelete">
        </div>
      </form>
    </div>
    
    <div class="filter-section">
      <div class="filter-container">
        <a href="admin.php" class="filter-btn active">All Posts</a>
        <?php 
        // Get unique titles
        $titleQuery = "SELECT DISTINCT title FROM blogs";
        $titleResult = mysqli_query($connection, $titleQuery);
        
        if($titleResult){
            while($title = mysqli_fetch_assoc($titleResult)){
                echo '<button class="filter-btn" data-title="' . htmlspecialchars($title['title']) . '">' 
                    . htmlspecialchars($title['title']) . 
                    '</button>';
            }
        }
        ?>
      </div>
    </div>
    
    <div class="main-content">
      <div class="card">
        <?php
          // Get the selected title id if any
          $titleFilter = isset($_GET['id']) ? $_GET['id'] : null;
          
          $query = "SELECT * FROM blogs ORDER BY id DESC";
          if($titleFilter) {
              $query = "SELECT * FROM blogs WHERE id = " . intval($titleFilter);
          }
          
          $result = mysqli_query($connection,$query);
          while($row=mysqli_fetch_assoc($result)){
            echo"<div class='box'>";
              echo "<div class='card-content'>";
                echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                echo "<img src='" . htmlspecialchars($row['image']) . "' alt='Blog post image for: " . htmlspecialchars($row['title']) . "'>";
                  echo"<div class='size'>";
                    echo "<p><strong>Content:</strong> " . htmlspecialchars($row['content']) . "</p>";
                    echo "<p><strong>Author:</strong> " . htmlspecialchars($row['author']) . "</p>";
                    echo "<div class='btn'>";
                    // Using unique IDs and classes for each button
                    echo "<a class='btn-view' href='read.php?id=" . $row['id'] . "' onclick='showViewAlert()'>Read More</a>";
                    echo "<a class='btn-delete' onClick='deleteCard(" . $row['id'] . ")'>Delete</a>";
                    echo "<a class='btn-update' onClick='updateCard(" . $row['id'] . ")'>Update</a>";
                  echo"</div>";
                echo "</div>";
              echo "</div>";
            echo "</div>";
          }
        ?>
      </div>
    </div>

    <script>
      let updateModal = document.getElementById("updateModal");
      let deleteMessage = document.getElementById("deleteMessage");
      let cancel = document.getElementById("cancel");
      let IdInput = document.getElementById("IdInput");
      let confirmDelete = document.getElementById('confirmDelete');
      let Idupdate = document.getElementById("Idupdate");

      
      function deleteCard(id){
        IdInput.value = id;
        deleteMessage.style.display = "flex";
        // Focus management for accessibility
        document.getElementById('cancel').focus();
      }

      function closeDeleteCard(){
        deleteMessage.style.display = "none";
      }

      function updateCard(id){
        Idupdate.value = id;
        updateModal.style.display = "flex";
        // Focus management for accessibility
        document.getElementById('cancel-update').focus();
      }

      function closeUpdateCard(){
        updateModal.style.display = "none";
      }

      function confirmUpdate(){
        const id = Idupdate.value;
        if(id) {
          window.location.href = 'update.php?id=' + id;
        }
      }

      function showViewAlert(){
        // Removed alert as it's not very professional - the navigation will handle feedback
      }

      confirmDelete.addEventListener("click", () => {
        // Professional feedback could be added here if needed
      });

      // Close modals with escape key for better UX
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          closeDeleteCard();
          closeUpdateCard();
        }
      });

      // Filter functionality
    // Replace the existing filter functionality in your <script> tag
// Filter functionality
document.querySelectorAll('.filter-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Remove active class from all buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Add active class to clicked button
        this.classList.add('active');
        
        const selectedTitle = this.getAttribute('data-title');
        const cards = document.querySelectorAll('.box');
        
        cards.forEach(card => {
            const cardTitle = card.querySelector('h3').textContent;
            if (!selectedTitle || cardTitle === selectedTitle) {
                card.style.display = 'block';
                // Add fade-in animation
                card.style.animation = 'fadeInUp 0.6s ease forwards';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

// Trigger click on 'All Posts' if no filter is active
if (!window.location.search) {
    document.querySelector('.filter-btn').click();
}
    </script>
  </div>

  <footer>
    <div class="foot">
      <p>Professional Blog Management System</p>
      <p>Contact: jmukwaya721@gmail.com</p>
      <p>Phone: 0793024677</p>
      <div class="create">
        <div class="upload">
          <a href="blog.php">
            <span>Create New Post</span>
          </a>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>