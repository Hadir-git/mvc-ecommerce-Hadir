<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>H&H Tech - Sign Up</title>
  <?php include "header.php"; ?>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="static/css/signup.css">
</head>

<body>

<form action="includes/signup.inc.php" method="POST">
  <div class="signup-wrapper">

    <!-- Titre -->
    <h3 class="signup-title">Sign Up</h3>

    <!-- Carte -->
    <div class="signup-card">
      <div class="corner-tr"></div>
      <div class="corner-bl"></div>

      <!-- Username -->
      <div class="signup-field">
        <label for="username">Username</label>
        <svg class="field-icon" viewBox="0 0 24 24" fill="none"
             stroke="#c9922a" stroke-width="1.6"
             stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="8" r="4"/>
          <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
        </svg>
        <input name="username" id="username" type="text"
               placeholder="your_username"
               minlength="5" maxlength="12">
        <div class="gold-bar"></div>
        <span class="field-hint">Min 5, Max 12 characters</span>
      </div>

      <!-- Password -->
      <div class="signup-field">
        <label for="pwd">Password</label>
        <svg class="field-icon" viewBox="0 0 24 24" fill="none"
             stroke="#c9922a" stroke-width="1.6"
             stroke-linecap="round" stroke-linejoin="round">
          <rect x="5" y="11" width="14" height="10" rx="2"/>
          <path d="M8 11V7a4 4 0 0 1 8 0v4"/>
          <circle cx="12" cy="16" r="1" fill="#c9922a" stroke="none"/>
        </svg>
        <input name="pwd" id="pwd" type="password"
               placeholder="••••••••"
               minlength="8" maxlength="20">
        <div class="gold-bar"></div>
        <span class="field-hint">Min 8, Max 20 characters</span>
      </div>

      <!-- Repeat Password -->
      <div class="signup-field">
        <label for="repeat_pwd">Repeat Password</label>
        <svg class="field-icon" viewBox="0 0 24 24" fill="none"
             stroke="#c9922a" stroke-width="1.6"
             stroke-linecap="round" stroke-linejoin="round">
          <rect x="5" y="11" width="14" height="10" rx="2"/>
          <path d="M8 11V7a4 4 0 0 1 8 0v4"/>
          <circle cx="12" cy="16" r="1" fill="#c9922a" stroke="none"/>
        </svg>
        <input name="repeat_pwd" id="repeat_pwd" type="password"
               placeholder="••••••••"
               maxlength="20">
        <div class="gold-bar"></div>
      </div>

      <!-- Email -->
      <div class="signup-field">
        <label for="email">Email</label>
        <svg class="field-icon" viewBox="0 0 24 24" fill="none"
             stroke="#c9922a" stroke-width="1.6"
             stroke-linecap="round" stroke-linejoin="round">
          <rect x="2" y="4" width="20" height="16" rx="2"/>
          <path d="M2 7l10 7 10-7"/>
        </svg>
        <input name="email" id="email" type="email"
               placeholder="your@email.com"
               maxlength="25">
        <div class="gold-bar"></div>
      </div>

      <!-- Séparateur -->
      <div class="signup-divider">
        <div class="line"></div>
        <div class="diamond"></div>
        <div class="line"></div>
      </div>

      <!-- Bouton -->
      <input class="signup-btn" type="submit" name="submit" value="Sign Up">

      <!-- Lien Login -->
      <div class="signup-login">
        <span>Already a member?</span>
        <a href="login.php">Log In!</a>
      </div>

      <!-- Erreurs / Succès -->
      <div class="signup-errors">
        <?php
          if (isset($_GET["error"]))
          {
            if ($_GET["error"] == "empty_input")
              echo "<p>* Fill in all fields!</p>";

            else if ($_GET["error"] == "invalid_uid")
              echo "<p>* Choose a proper username!</p>";

            else if ($_GET["error"] == "passwords_dont_match")
              echo "<p>* Passwords don't match!</p>";

            else if ($_GET["error"] == "username_taken")
              echo "<p>* Username/Email already taken!</p>";

            else if ($_GET["error"] == "none")
              echo "<p class='success'>You have signed up! Redirecting to login…</p>";
              echo '<META HTTP-EQUIV="Refresh" Content="2; URL=signup.php">';
              exit();
          }
        ?>
      </div>

    </div><!-- .signup-card -->
  </div><!-- .signup-wrapper -->
</form>

<?php include "footer.php"; ?>
</body>
</html>