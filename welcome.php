<?php
require_once 'classes/database.php';
require_once 'classes/user.php';
?>

<!doctype html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Welcome</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <link rel="stylesheet" href="assets/CSS/app.css">
  <link rel="stylesheet" href="assets/CSS/normalize.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
</head>
<body>
  <div class="welcome-background">
    <?php 
    // Start sesstion and retrieve saved data
    session_start();
    if (isset($_SESSION['user'])) {
      // Create a welcome message for loged in user
        echo '<p class="success">Welcome, ' . $_SESSION['user'] . '!</div>';
        unset($_SESSION['message']);
      }
   ?>
  </div>
</body>
</html>