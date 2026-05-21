<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OG Tech PC - Manage Products Panel</title>
  <?php
    include "header.php"; 
    include "static/pages/side_nav.html";
    include "static/pages/admin_nav.php";
  ?>
</head>
<body>
  <div class="container" style="margin-top: 150px">
    <h3 class="page-title">Manage Products</h3>

    <div class="rounded-card-parent center" style="margin-bottom: 100px">
      <div class="card rounded-card">
        <div class="card-content white-text">
          <span class="orange-text" style="font-size: 24px">Products List - Sorted by quantity
          <th>
            <button class='deep-orange btn'><a href="admin_manage_products.php"><i class='material-icons white-text'>refresh</i></a>
            </button>
          </th>
          </span>

          <!-- search product input field start -->
          <form action="admin_manage_products.php" method="POST">
            <div class="row" style="margin: 0px;">
              <div class="input-field col s3" style = "color:azure">
                <input name="search_product" id="search_product" type="text" class="validate white-text" maxlength="20">
                <label for="search_product">Search product by Name or Brand</label>
                <div id="error" class="errormsg">
                  
                </div>
                
              </div>
            </div>
          </form>
          <!-- search product input field end -->

          <!-- search product result list start -->
          <form action="" method="GET">
            <table class="responsive-table" id="pagination">
              <thead class="text-primary">
                <tr>
                  <th>Name</th><th>Brand</th><th class='center'>Quantity In Stock</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $products = new adminContr();
                  $products->productsList();
                ?>
              </tbody>
            </table>
            <div class="col-md-12 center text-center">
              <span class="left" id="total_reg"></span>
              <ul class="pagination pager white-text" id="myPager"></ul>
            </div>
          </form>
          <!-- search product result list end -->
        </div>
      </div>
    </div>
    <!-- products table end -->

    <!-- selected product details start -->
  <?php if (isset($_GET["inspect_product"])) { ?>
  <div class="rounded-card-parent">
    <div class="card rounded-card">
      <div class="card-content white-text">
        <span class="card-title orange-text bold">Selected Product Details</span>
        <table class="responsive-table center">
          <form action="admin_manage_products.php" method="GET">
            <thead class="text-primary center">
            <tr><th>Image</th><th>Name</th><th>Brand</th>
            <th>Description</th><th>Category</th><th>Selling Price</th><th>Qty In Stock</th></tr>
            </thead>
            <tbody>
              <?php
                $showInspect = new adminContr();
                $showInspect->showInspectedProduct();
              ?>
            </tbody>
          </form>
        </table>
      </div>
    </div>
  </div>
  <?php }
    // delete product
    if (isset($_GET["delete_product"]))
    {
      $id = $_GET["delete_product"];
      $sql =  "DELETE FROM Items WHERE ItemID = $id";
      $dbh = new Dbhandler();
      $dbh->conn()->query($sql) or die ("<p class='red-text'>*Delete statement FAILED!</p>");
    }
  ?>
  <!-- selected member details end -->

  <!-- create product start -->
  <div class="rounded-card-parent" style="margin-top: 100px">
    <div class="card rounded-card">
      <div class="card-content">
        <span class="card-title orange-text bold">Create Product</span>

        <?php
        // ----------------------------------------------------------------
        // Traitement de la création du produit (avec upload réel du fichier)
        // ----------------------------------------------------------------
        if (isset($_POST["submit_product"])) {
          require_once "includes/class_autoloader.php";
          $util = new CommonUtil();

          $name           = trim($_POST["name"]);
          $brand          = trim($_POST["brand"]);
          $description    = trim($_POST["description"]);
          $category       = $_POST["category"];
          $sellingprice   = $_POST["sellingprice"];
          $quantityinstock = $_POST["quantityinstock"];

          // Vérification du fichier uploadé
          if (!isset($_FILES["product_image"]) || $_FILES["product_image"]["error"] === UPLOAD_ERR_NO_FILE) {
            echo "<p class='errormsg'>*Veuillez choisir une image.</p>";
          } elseif ($_FILES["product_image"]["error"] !== UPLOAD_ERR_OK) {
            echo "<p class='errormsg'>*Erreur lors de l'upload (code " . $_FILES["product_image"]["error"] . ").</p>";
          } else {
            $imageName    = basename($_FILES["product_image"]["name"]);
            $uploadTarget = "product_images/" . $imageName;

            // Vérification type MIME
            $allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
            $fileMime     = mime_content_type($_FILES["product_image"]["tmp_name"]);

            if (!in_array($fileMime, $allowedTypes)) {
              echo "<p class='errormsg'>*Format non supporté. Utilisez JPG, PNG, GIF ou WEBP.</p>";
            } elseif (empty($name) || empty($brand) || empty($description) || $category === "" || empty($sellingprice) || empty($quantityinstock)) {
              echo "<p class='errormsg'>*Veuillez remplir tous les champs.</p>";
            } else {
              // Upload physique du fichier dans product_images/
              if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $uploadTarget)) {
                $util->setProduct($name, $brand, $description, $category, $sellingprice, $quantityinstock, $imageName);
                echo "<p class='green-text bold'>✓ Produit ajouté avec succès.</p>";
              } else {
                echo "<p class='errormsg'>*Échec de l'upload. Vérifiez les permissions du dossier product_images/.</p>";
              }
            }
          }
        }
        ?>

        <!-- FIX : enctype="multipart/form-data" obligatoire pour l'upload de fichier -->
        <form id="create" name="create" action="admin_manage_products.php" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col s6" style="padding-right: 40px;">
              <div class="row">
                <div class="input-field white-text">
                  <i class="material-icons prefix">inventory_2</i>
                  <input name="name" id="name" type="text" class="validate white-text">
                  <label for="name" class="white-text">Product Name</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field white-text">
                  <i class="material-icons prefix">branding_watermark</i>
                  <input name="brand" id="brand" type="text" class="validate white-text" maxlength="20">
                  <label for="brand" class="white-text">Brand</label>
                </div>
              </div>
              <div class="row">
                <div class="row">
                  <div class="input-field white-text col s12">
                    <i class="material-icons prefix">description</i>
                    <textarea name="description" id="description" class="materialize-textarea white-text" minlength="5"></textarea>
                    <label for="description" class="white-text">Description</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col s6" style="padding-right: 40px;">
              <div class="row">
                <div class="input-field white-text">
                  <i class="material-icons prefix white-text">category</i>
                  <select name="category" id="category">
                    <option value="" disabled selected>Choose category</option>
                    <option value=0>PC Packages</option>
                    <option value=1>Monitor & Audio</option>
                    <option value=2>Peripherals</option>
                  </select>
                  <label class="white-text">Category</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field white-text">
                  <i class="material-icons prefix">attach_money</i>
                  <input name="sellingprice" id="sellingprice" type="number" step=".01" class="validate white-text" maxlength="30">
                  <label for="sellingprice" class="white-text">Selling Price</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field white-text">
                  <i class="material-icons prefix white-text">production_quantity_limits</i>
                  <input name="quantityinstock" id="quantityinstock" type="number" class="validate white-text" maxlength="30">
                  <label for="quantityinstock" class="white-text">Quantity In Stock</label>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="file-field col s6">
              <div class="btn">
                <span>File</span>
                <!-- FIX : id unique "file_input" pour le champ fichier -->
                <input type="file" id="file_input" name="product_image" accept="image/*">
              </div>
              <div class="file-path-wrapper">
                <!-- FIX : id "file_path_text" distinct, plus de onchange ici -->
                <input class="file-path validate white-text" type="text"
                  id="file_path_text" placeholder="Choose Image">
              </div>
            </div>
            <!-- Prévisualisation de l'image -->
            <div class="col s6">
              <img id="image_preview" src="" alt="Prévisualisation"
                style="width: 200px; height: 200px; object-fit: contain; display: none;
                       border: 1px solid #e0e0e0; border-radius: 8px; padding: 4px;">
            </div>
          </div>

          <input class="btn orange btn-block z-depth-5" type="submit" name="submit_product" id="submit_product" value="Create Product">
        </form>
      </div>
    </div> 
  </div>
  <!-- create product end -->
  </div>
</body>
<script>
  $(document).ready(function(){
    $('select').formSelect();

    // FIX : écouter le champ file (file_input) pour la prévisualisation
    document.getElementById("file_input").addEventListener("change", function() {
      var file = this.files[0];
      if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
          var preview = document.getElementById("image_preview");
          preview.src = e.target.result;
          preview.style.display = "block";
        };
        reader.readAsDataURL(file);
      }
    });
  });
</script>

<?php include "footer.php"; ?>
</html>