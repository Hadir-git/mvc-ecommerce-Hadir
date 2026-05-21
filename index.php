<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>H&H Tech - Landing Page</title>
  <?php 
    require "header.php"; 
    require_once "includes/class_autoloader.php";

    // database initialization
    $dbinit = new InitDB();
    $dbinit->initDbExec();
  ?>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Raleway:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="static/css/style.css">
</head>

<body>

  <!-- ═══ CAROUSEL ═══════════════════════════════════════════ -->
  <div class="slider-wrapper">
    <div class="slider">
      <ul class="slides">
        <li>
          <img src="./static/images/category_3.jpg">
          <div class="caption center-align">
            <h3></h3>
            <h5 class="light">Build your dream setup with Us.</h5>
          </div>
        </li>
        <li>
          <img src="./static/images/carousel_4.gif">
          <div class="caption center-align">
            <h3>At H&amp;H Tech</h3>
            <h5>From pc to peripherals, we got u covered.</h5>
          </div>
        </li>
        <li>
          <img src="static/images/Banner-Rebate-1.jfif">
        </li>
        <li>
          <img src="./static/images/carousel_1.gif">
          <div class="caption center-align">
            <h3 style="color:var(--gold-pale)!important;">RTX ON</h3>
          </div>
        </li>
        <li>
          <img src="./static/images/carousel_4.gif">
          <div class="caption center-align"></div>
        </li>
      </ul>
    </div>
  </div>

  <!-- ═══ CATEGORIES ═══════════════════════════════════════════ -->
  <div class="categories-section container">
    <h4 class="gold-section-title">Categories</h4>
    <div class="categories-row">

      <a href="product_catalogue.php?category=0" style="text-decoration:none;">
        <div class="selectable-card">
          <img src="static/images/category_1.gif"/>
          <h5>PC Packages</h5>
        </div>
      </a>

      <a href="product_catalogue.php?category=1" style="text-decoration:none;">
        <div class="selectable-card">
          <img src="./static/images/category_3.jpg"/>
          <h5>Monitor &amp; Audio</h5>
        </div>
      </a>

      <a href="product_catalogue.php?category=2" style="text-decoration:none;">
        <div class="selectable-card">
          <img src="./static/images/category_2.gif"/>
          <h5>Peripherals</h5>
        </div>
      </a>

    </div>
  </div>

  <!-- ═══ GOLD DIVIDER ═══════════════════════════════════════════ -->
  <div class="gold-divider">
    <div class="line"></div>
    <div class="diamond"></div>
    <div class="line"></div>
    <div class="diamond"></div>
    <div class="line"></div>
  </div>

  <!-- ═══ ABOUT ═══════════════════════════════════════════ -->
  <div class="about-section">
    <h3>Built by Enthusiasts for Enthusiasts</h3>
    <h5>
      At <b>H&amp;H Tech PC</b>, we are a team of serious gamers and overclockers
      with a passion towards customized and fast PCs.
    </h5>
  </div>

  <!-- ═══ STATS ═══════════════════════════════════════════ -->
  <div class="stats-section">
    <div class="stat-item">
      <span class="count">15</span>
      <h5>Years of History</h5>
    </div>
    <div class="stat-item">
      <span class="count">10000</span>
      <h5>PCs Built</h5>
    </div>
    <div class="stat-item">
      <span class="count">14</span>
      <h5>States Covered</h5>
    </div>
    <div class="stat-item">
      <span class="count">100</span>
      <h5>% Satisfaction Guaranteed</h5>
    </div>
  </div>

  <!-- ═══ GOLD DIVIDER ═══════════════════════════════════════════ -->
  <div class="gold-divider">
    <div class="line"></div>
    <div class="diamond"></div>
    <div class="line"></div>
    <div class="diamond"></div>
    <div class="line"></div>
  </div>

  <!-- ═══ VIDEO SECTION ═══════════════════════════════════════════ -->
  <div class="video-section">
    <h3>H&amp;H Tech PC — White PC Build</h3>
    <div class="video-thumb-wrapper"
         onclick="this.nextElementSibling.style.display='block'; this.style.display='none'">
      <img src="static/images/ice_pc.png"/>
    </div>
    <div style="display:none; margin-bottom:100px;">
      <video style="display:block; margin:0 auto;" class="responsive-video"
             width="1280" height="720" autoplay controls muted>
        <source src="static/FROST Gaming PC.mp4" type="video/mp4">
      </video>
    </div>
  </div>

  <!-- ═══ OUR DIFFERENCE ═══════════════════════════════════════════ -->
  <div class="difference-section">
    <h3>Our Difference</h3>
    <h6>Compared to other PC builder services</h6>

    <div class="diff-cards-grid">

      <div class="value-card">
        <img src="static/images/values_images/P.svg">
        <div class="card-label">
          <span class="accent">O</span><span class="rest">RI PARTS</span>
        </div>
      </div>

      <div class="value-card">
        <img src="static/images/values_images/T.svg">
        <div class="card-label">
          <span class="accent">G</span><span class="rest">uaranteed Return/Warranty</span>
        </div>
      </div>

      <div class="value-card">
        <img src="static/images/values_images/E.svg">
        <div class="card-label">
          <span class="accent">T</span><span class="rest">echnical Support</span>
        </div>
      </div>

      <div class="value-card">
        <img src="static/images/values_images/Rebate.png">
        <div class="card-label">
          <span class="accent">E</span><span class="rest">XTRA Rebate For Upgrades</span>
        </div>
      </div>

      <div class="value-card">
        <img src="static/images/values_images/S.svg">
        <div class="card-label">
          <span class="accent">C</span><span class="rest">onfirm tested b4 shipping</span>
        </div>
      </div>

      <div class="value-card">
        <img src="static/images/values_images/H.png">
        <div class="card-label">
          <span class="accent">H</span><span class="rest">ighly Professional</span>
        </div>
      </div>

    </div>
  </div>

  <!-- ═══ ELFSIGHT REVIEWS ═══════════════════════════════ -->
  <script src="https://apps.elfsight.com/p/platform.js" defer></script>
  <div class="elfsight-app-dcc4934e-3eb0-4e18-98af-67fd2f034df1"></div>

  <?php require "footer.php"; ?>

</body>

<script>
  $(document).ready(function(){
    // carousel autoswipe
    $('.slider').slider({full_width: true});

    // counter
    $('.count').each(function () {
      $(this).prop('Counter', 0).animate({
        Counter: $(this).text()
      }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) { $(this).text(Math.ceil(now)); }
      });
    });
  });
</script>
</html>