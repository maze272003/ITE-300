
<!DOCTYPE html>
<html>
<head>
    
  <style>

body {
      background-color: #f1f1f1;
    }
    
    .container {
      width: 300px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ccc;
      background-color: #fff;
      text-align: center;
    }
    
    .login-button {
      margin-top: 20px;
    }
    
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    
    .login-button {
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    
    .login-button:hover {
      background-color: #45a049;
    }
    
    .options {
      margin-top: 10px;
    }
    
    .option-button {
      background: none;
      border: none;
      color: #4CAF50;
      text-decoration: underline;
      cursor: pointer;
    }
    
    .option-button:hover {
      color: #45a049;
    }
  
  </style>
</head>
<body>
  <div class="container">
    <h2>Sign in</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </div>
  </div>
</body>
</html>