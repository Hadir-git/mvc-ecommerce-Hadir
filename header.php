<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="./static/materialize/js/materialize.min.js" defer></script>
  <script type="text/javascript" src="static/js/pagination.js"></script>
  <link rel="stylesheet" href="./static/css/base.css">
  <link rel="stylesheet" href="./static/css/header.css">
</head>

<?php
  require_once "includes/class_autoloader.php";
  session_start();

  if (isset($_SESSION["Member"])) {
    $member = $_SESSION["Member"];
    $member = Member::CreateMemberFromID($member->getMemberID());
    $_SESSION["Member"] = $member;
    $memberID = $member->getMemberID();
    $username = $member->getUsername();
    $email = $member->getEmail();
    $privilegeLevel = $member->getPrivilegeLevel();
    $cart = $member->getCart();
    $orderItemCount = count($cart->getOrderItems());
    $orders = $member->getOrders();
  }
?>

<div class="nav-wrapper" style="height: 100px">
  <nav style="height: 100px;">
    <div class="nav-wrapper" style="background-color: var(--nav-bg); box-shadow: 0px 0px 2px var(--nav-shadow);">
      <a href="index.php" class="brand-logo" style="padding-left: 20px; color: var(--nav-text);">H&H Tech </a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li id="search-bar" style="background-color: var(--nav-bg);">
          <form action="product_catalogue.php">
            <div class="row" style="padding-left: 20px; color: var(--nav-text);">
              <input type="text" name="query" placeholder="Browse products..."
                class="input-field col s10 autocomplete" id="autocomplete-input"
                value="<?php if (isset($_GET["query"])) echo($_GET["query"]); ?>"
                style="font-size: 14px; z-index: 5050; color: var(--nav-text);"
              />
              <button value='<?php if (isset($_GET["query"])) echo($_GET["query"]); ?>' 
                class='btn underline' style="margin-bottom: 50px; padding-bottom: 50px; background-color: var(--nav-btn-bg);">
                <i class='material-icons'>search</i>
              </button>
            </div>
          </form>
        </li>
        <?php
          if (isset($_SESSION["Member"])) {
            if ($privilegeLevel == 1)
              echo("<li><a class='admin admin_manage_users admin_view_orders' href='admin.php' target='_blank'>Admin Panel</a></li>");
            echo("
              <li>
                <a class='cart' href='cart.php?member_id=$memberID'>
                  Cart<span class='new badge unglow' id='cart_badge'>$orderItemCount</span>
                </a>
              </li>
              <li><a class='manage_profile' href='manage_profile.php?email=$email'>Manage Profile</a></li>
              <li><a href='includes/logout.inc.php'>Logout</a></li>
            ");
          } else {
            echo("
              <li><a class='login' href='login.php'>Login</a></li>
              <li><a class='signup' href='signup.php'>Sign Up</a></li>
            ");
          }
        ?>
      </ul>
    </div>
  </nav>
</div>

<script>
  $(document).ready(function(){
    $('input.autocomplete').autocomplete({
      data: {
        'Acer': 'static/images/acer.png',
        'Asus': 'static/images/asus.jpg',
        'Corsair': 'static/images/corsair.png',
        'Headset': 'static/images/audio.png',
        'HyperX': 'static/images/hyperx.jpg',
        'Keyboard': 'static/images/category_2.gif',
        'Logitech': 'static/images/logitech.png',
        'Mouse': 'static/images/mouse.png',
        'Monitor': 'static/images/monitor.jpg',
        'MSI': 'static/images/msi.png',
        'PC': 'static/images/category_1.gif',
        'Razer': 'static/images/razer.png',
        'Speaker': 'static/images/speaker.jpg',
        'Steelseries': 'product_images/steelseries l.png',
        'Viewsonic': 'static/images/viewsonic.jpeg'
      }
    });
  });

  // underline current page
  var path = window.location.pathname;
  var page = path.split("/").pop().split(".")[0];

  // ✅ Ajout de 'admin' dans les exclusions
  var links = document.getElementsByClassName(page);
  if (links[0] != null) {
    var el = links[0];
    if (el.id !== 'search-bar'
        && !el.classList.contains('manage_profile')
        && !el.classList.contains('cart')
        && !el.classList.contains('admin')) {  // ✅ Correction ici
      el.classList.add("page_underline");
    }
  }

  // style search bar
  var style = document.getElementById("search-bar");
  style.classList.add("search");
</script>
</html>