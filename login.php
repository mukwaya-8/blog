<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #eef1f5;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    form {
      background: #ffffff;
      padding: 40px 30px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    .email, .pass {
      margin-bottom: 20px;
    }

    input[type="text"] {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <form action="loginback.php" method="POST">
    <div class="email">
      <input type="text" name="email" placeholder="Email" required>
    </div>
    <div class="pass">
      <input type="password" name="password" placeholder="Password" required>
    </div>
    <input type="submit" name="login" value="Login">
  </form>
</body>
</html>
