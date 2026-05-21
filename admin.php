<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>H&H Tech - Admin Panel</title>
  <?php 
    include "header.php";
    include "static/pages/side_nav.html";
    include "static/pages/admin_nav.php";
    require_once "includes/class_autoloader.php";
  ?>

  <link rel="stylesheet" href="static/css/admin_panel.css">
</head>

<body>
  <div class="admin-wrapper">

    <!-- Stat cards -->
    <div class="stat-cards-grid">

      <!-- SignUps -->
      <div class="stat-card">
        <div class="corner-tr"></div>
        <div class="corner-bl"></div>
        <div class="card-accent accent-blue"></div>
        <div class="card-body">
          <div class="card-icon-row">
            <div class="card-icon icon-blue">
              <i class="material-icons text-blue" style="font-size:1.2rem">supervisor_account</i>
            </div>
            <div>
              <div class="card-label">Sign-ups</div>
              <div class="card-value" id="signup">
                <?php 
                  $sql = "SELECT * FROM Members";
                  $conn = new Dbhandler();
                  $result = $conn->conn()->query($sql) or die($conn->conn()->error);
                  $signUpCount = $result->num_rows;
                  echo $signUpCount;
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="card-divider">
          <div class="line"></div><div class="diamond"></div><div class="line"></div>
        </div>
        <div class="card-actions">
          <a href="admin_report.php#user"></a>
          <span class="sep">·</span>
          <a href="admin_manage_users.php">Manage Users</a>
        </div>
      </div>

      <!-- Products -->
      <div class="stat-card">
        <div class="corner-tr"></div>
        <div class="corner-bl"></div>
        <div class="card-accent accent-amber"></div>
        <div class="card-body">
          <div class="card-icon-row">
            <div class="card-icon icon-amber">
              <i class="material-icons text-amber" style="font-size:1.2rem">category</i>
            </div>
            <div>
              <div class="card-label">Products</div>
              <div class="card-value">
                <?php 
                  $sql = "SELECT * FROM Items";
                  $conn = new Dbhandler();
                  $result = $conn->conn()->query($sql) or die($conn->conn()->error);
                  $productCount = $result->num_rows;
                  echo $productCount;
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="card-divider">
          <div class="line"></div><div class="diamond"></div><div class="line"></div>
        </div>
        <div class="card-actions">
          <a href="admin_report.php#product"></a>
          <span class="sep">·</span>
          <a href="admin_manage_products.php">Manage Products</a>
        </div>
      </div>

      <!-- Total Orders -->
      <div class="stat-card">
        <div class="corner-tr"></div>
        <div class="corner-bl"></div>
        <div class="card-accent accent-green"></div>
        <div class="card-body">
          <div class="card-icon-row">
            <div class="card-icon icon-green">
              <i class="material-icons text-green" style="font-size:1.2rem">shopping_cart</i>
            </div>
            <div>
              <div class="card-label">Total Orders</div>
              <div class="card-value" id="order">
                <?php 
                  $sql = "SELECT M.*, O.*, P.* FROM Members M, Orders O, Payment P
                    WHERE M.PrivilegeLevel = 0 AND P.OrderID = O.OrderID AND M.MemberID = O.MemberID ORDER BY P.PaymentDate DESC";
                  $conn = new Dbhandler();
                  $result = $conn->conn()->query($sql) or die($conn->conn()->error);
                  $orderCount = $result->num_rows;
                  echo $orderCount;
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="card-divider">
          <div class="line"></div><div class="diamond"></div><div class="line"></div>
        </div>
        <div class="card-actions">
          <a href="admin_report.php#order"></a>
          <span class="sep">·</span>
          <a href="admin_view_orders.php">Manage Orders</a>
        </div>
      </div>

      <!-- Today's Orders -->
      <div class="stat-card">
        <div class="corner-tr"></div>
        <div class="corner-bl"></div>
        <div class="card-accent accent-red"></div>
        <div class="card-body">
          <div class="card-icon-row">
            <div class="card-icon icon-red">
              <i class="material-icons text-red" style="font-size:1.2rem">add_shopping_cart</i>
            </div>
            <div>
              <div class="card-label">Today's Orders</div>
              <div class="card-value" id="order1">
                <?php 
                  $sql = "SELECT M.*, O.*, P.* FROM Members M, Orders O, Payment P
                    WHERE M.PrivilegeLevel = 0 AND P.OrderID = O.OrderID AND M.MemberID = O.MemberID 
                    AND P.PaymentDate = CURDATE() ORDER BY P.PaymentDate DESC";
                  $conn = new Dbhandler();
                  $result = $conn->conn()->query($sql) or die($conn->conn()->error);
                  $orderCountNew = $result->num_rows;

                  if ($orderCountNew >= 1) {
                    echo $orderCountNew;
                    echo '<span class="pulse-badge">';
                    echo ($orderCountNew === 1) ? '1 New' : $orderCountNew . ' New';
                    echo '</span>';
                  } else {
                    echo $orderCountNew;
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="card-divider">
          <div class="line"></div><div class="diamond"></div><div class="line"></div>
        </div>
        <div class="card-actions">
          <a href="admin_view_orders.php">Manage Orders</a>
        </div>
      </div>

    </div><!-- /.stat-cards-grid -->

    <!-- Product Reviews -->
    <div class="reviews-section">
      <div class="corner-tr"></div>
      <div class="corner-bl"></div>
      <div class="accent-bar"></div>
      <div class="reviews-inner">
        <div class="reviews-title">Product Reviews</div>
        <table class="reviews-table" id="pagination">
          <thead>
            <tr>
              <?php /* Table headers are rendered by showReviews() or add them here if needed */ ?>
            </tr>
          </thead>
          <tbody>
            <?php 
              $oper = new adminContr;
              $oper->showReviews();
            ?>
          </tbody>
        </table>
        <div class="reviews-pagination">
          <span id="total_reg"></span>
          <ul id="myPager" class="reviews-pagination"></ul>
        </div>
      </div>
    </div><!-- /.reviews-section -->

  </div><!-- /.admin-wrapper -->
</body>

<script type="text/javascript">
  $(document).ready(function(){
    $('#pagination').pageMe({
      pagerSelector:'#myPager',
      activeColor: 'blue',
      prevText:'Previous',
      nextText:'Next',
      showPrevNext:true,
      hidePageNumbers:false,
      perPage:3
    });
    autoSyncTotalOrder();
    autoSyncTodayOrder();
    autoSyncTotalSignUp();
  });

  function autoSyncTotalOrder(){
    $("#order").load(location.href + " #order", function(){
      setTimeout(autoSyncTotalOrder, 3000);
    });
  }

  function autoSyncTodayOrder(){
    $("#order1").load(location.href + " #order1", function(){
      setTimeout(autoSyncTotalOrder, 3000);
    });
  }

  function autoSyncTotalSignUp(){
    $("#signup").load(location.href + " #signup", function(){
      setTimeout(autoSyncTotalSignUp, 3000);
    });
  }
</script>

</html>