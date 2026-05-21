<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>H&H Tech - Login</title>
  <?php include "header.php"; ?>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="static/css/login.css">
</head>

<body>

<form method="POST" action="includes/login.inc.php">
  <div class="login-wrapper">

    <!-- Titre -->
    <h3 class="login-title">Login</h3>

    <!-- Carte -->
    <div class="login-card">
      <div class="corner-tr"></div>
      <div class="corner-bl"></div>

      <!-- Username -->
      <div class="login-field">
        <label for="username">Username or Email</label>
        <svg class="field-icon" viewBox="0 0 24 24" fill="none"
             stroke="#c9922a" stroke-width="1.6"
             stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="8" r="4"/>
          <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
        </svg>
        <input type="text" name="username" id="username"
               placeholder="your@email.com">
        <div class="gold-bar"></div>
      </div>

      <!-- Password -->
      <div class="login-field">
        <label for="pwd">Password</label>
        <svg class="field-icon" viewBox="0 0 24 24" fill="none"
             stroke="#c9922a" stroke-width="1.6"
             stroke-linecap="round" stroke-linejoin="round">
          <rect x="5" y="11" width="14" height="10" rx="2"/>
          <path d="M8 11V7a4 4 0 0 1 8 0v4"/>
          <circle cx="12" cy="16" r="1" fill="#c9922a" stroke="none"/>
        </svg>
        <input type="password" name="pwd" id="pwd"
               placeholder="••••••••">
        <div class="gold-bar"></div>
      </div>

      <!-- Séparateur -->
      <div class="login-divider">
        <div class="line"></div>
        <div class="diamond"></div>
        <div class="line"></div>
      </div>

      <!-- Bouton -->
      <button type="submit" name="submit" class="login-btn">Login</button>

      <!-- Signup + Erreurs -->
      <div class="login-signup">
        <span>Not yet a member?</span>
        <a href="signup.php">Sign Up!</a>
      </div>

      <div class="login-errors">
        <?php
          if (isset($_GET["error"])) {
            if     ($_GET["error"] === "empty_input")    echo "<p>* Fill in all fields!</p>";
            elseif ($_GET["error"] === "WrongLogin")     echo "<p>* Incorrect credentials!</p>";
            elseif ($_GET["error"] === "usernotfound")   echo "<p>* User does not exist!</p>";
            elseif ($_GET["error"] === "stmtfailed")     echo "<p>* SQL error — try again later.</p>";
            elseif ($_GET["error"] === "attemptReached") echo "<p>* Too many failed attempts. Retry in 15 s.</p>";
          }
        ?>
      </div>

    </div><!-- .login-card -->
  </div><!-- .login-wrapper -->
</form>

<?php include "footer.php"; ?>
</body>
</html>