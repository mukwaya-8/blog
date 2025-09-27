<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
</head>
<body>
  <form action="registerback.php" method="POST">
    <div class="email">
      <input type="email" name="email" placeholder="Email" required>
    </div>

    <div class="password">
      <input type="password" name="password" placeholder="Password" required>
    </div>

    <div class="role">
      <select name="role" required>
        
        <option value="Admin">Admin</option>
        <option value="User">User</option>
      </select>
    </div>

    <input type="submit" name="register" value="Sign Up">
  </form>
</body>
</html>
