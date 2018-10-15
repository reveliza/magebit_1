<?php
require_once 'classes/database.php';
require_once 'classes/user.php';
require_once 'classes/attribute.php';
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
  <div id="box-container">

    <!-- ==========Blue container========== -->
    <div class="container cover">
      <div class="row text">
        <!-- Sign up side -->
        <div class="col-6">
          <h1>Don't have an account?</h1>
          <div class="line"></div>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <input type="submit" name="signup" value="SIGN UP" id="signup_change" class="button-blue">
        </div>
        <!-- Login side -->
        <div class="col-6">
          <h1>Have an account?</h1>
          <div class="line"></div>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
          <input type="submit" name="login" value="LOGIN" id="login_change" class="button-blue">
        </div>
      </div>
    </div>

    <!-- ==========White slider========== -->
    <div class="slider">
      <!-- Login side -->
      <div class="col-slider login">
        <div class="heading">
          <h1>Login</h1>
          <img class="logo" src="assets/CSS/images/logo.png" alt="Magebit_logo">
        </div>
        <div class="line"></div>
        <form class="add" action="" method="post">
          <div class="form-div">
            <label for="email">Email<span class="asterisk">*</span></label>
            <input class="form-control" type="email" name="email" value="" required>
            <img class="specs" src="assets/CSS/images/mail_inactive.png" alt="">
          </div>
          <div class="form-div">
            <label for="password">Password<span class="asterisk">*</span></label>
            <input class="form-control" type="password" name="password" value="" required>
            <img class="specs" src="assets/CSS/images/lock_inactive.png" alt="">
          </div>
          <div class="form-buttons">
            <input type="submit" name="submit_login" value="LOGIN" id="login_submit" class="button-orange">
            <a href="#" id="forgot">Forgot?</a>
          </div>
        </form>
        <!-- Process login form -->
        <?php
        // If login submit button clicked
        if (isset($_POST['submit_login'])) {  
          // Collect data from POST
          $email = $_POST['email'];
          $password = $_POST['password'];
          // Create new User instance
          $user = new User;
          // Call method findUser to the new instance
          $user->findUser($email, $password);
        }
        ?>
      </div>
      <!-- Sign up side -->
      <div class="col-slider signup">
        <div class="heading">
          <h1>Sign Up</h1>
          <img class="logo" src="assets/CSS/images/logo.png" alt="Magebit_logo">
        </div>
        <div class="line"></div>
        <form class="add" action="" method="post">
          <div class="form-div">
            <label for="name">Name<span class="asterisk">*</span></label>
            <input class="form-control" type="text" name="name" value="" required>
            <img class="specs" src="assets/CSS/images/user_inactive.png" alt="">
          </div>
          <div class="form-div">
            <label for="email">Email<span class="asterisk">*</span></label>
            <input class="form-control" type="email" name="email" value="" required>
            <img class="specs" src="assets/CSS/images/mail_inactive.png" alt="">
          </div>
          <div class="form-div">
            <label for="password">Password<span class="asterisk">*</span></label>
            <input class="form-control" type="password" name="password" value="" required>
            <img class="specs" src="assets/CSS/images/lock_inactive.png" alt="">
          </div>
          <!-- Extra attributes -->
          <!-- =================== -->
          <!-- TO ADD NEW ATTRIBUTE, COPY-PASTE THE FOLLOWING DIV AND REPLACE INNERHTML OF THE LABEL -->
          <!-- =================== -->
<!--           <div class="extra-attributes">
            <div class="form-div">
              <label class="label-name" for="attribute">Age</label>
              <input class="input-name" type="hidden" name="attribute_name[]" value="" required>
              <input class="form-control" type="text" name="attribute_value[]" value="" required>
            </div>
            <div class="form-div">
              <label class="label-name" for="attribute">Gender</label>
              <input class="input-name" type="hidden" name="attribute_name[]" value="" required>
              <input class="form-control" type="text" name="attribute_value[]" value="" required>
            </div>
          </div> -->
          <div class="form-buttons">
            <input type="submit" name="submit_signup" value="SIGN UP" id="signup_submit" class="button-orange">
          </div>
        </form>
        <!-- Process sign up form -->
        <?php
        // If signup submit button clicked
        if (isset($_POST['submit_signup'])) {
          // Collect data from POST
          $name = $_POST['name'];           
          $email = $_POST['email'];
          $password = $_POST['password'];
          // Create new User object
          $user = new User;
          // Call method addUser on the new object.
          $user->addUser($name, $email, $password);

          // Set counter variable
          $i=0;
          // Process each extra attribute by assigning attribute name and value to input values
          foreach ($_POST['attribute_name'] as $key => $value) {
            $attr_n = $value;
            $attr_v = $_POST['attribute_value'][$i];
            // Create new Attribute instance
            $attribute = new Attribute;
            // Call method addAttribute to the new instance
            $attribute->addAttribute($email, $attr_n, $attr_v);
            $i++;
          }
        }
        ?>
      </div>
    </div>
  </div>

  <footer>
    <p>All rights reserved "Magebit" 2016.</p>
  </footer>

  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="assets/JS/app.js"></script>
</body>
</html>