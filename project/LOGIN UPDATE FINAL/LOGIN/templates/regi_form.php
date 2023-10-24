<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<?php

?>
<body>

<div class="container mt-3">
<div class="col-sm-8">
<button onclick="window.location.href='main.php'" class="btn btn-danger">BACK</button>
  </div>
  <h2>REGISTER HERE</h2>
  <form action="register.php" method="post">
    <div class="mb-3 mt-3">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" placeholder="Enter Username" name='username'>
    </div>
    <div class="mb-3">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name='password'>
    </div>
    <div class="mt-3 container">
    <button type="submit" class="btn btn-primary" name="register">Register</button>
    </div>
  </form>
</div>

</body>
</html>