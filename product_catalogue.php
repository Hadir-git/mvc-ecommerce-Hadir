<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OG Tech PC - Product Catalogue</title>
    <?php 
      require_once "header.php";
      require_once "includes/product_catalogue.inc.php";
    ?>
    <style>
      /* Force reset any Materialize/global link color interference */
      #filter-sidebar a,
      #filter-sidebar a:hover,
      #filter-sidebar a:focus,
      #filter-sidebar a:active,
      #filter-sidebar a:visited {
        color: #00e5ff !important;
        text-decoration: none !important;
      }

      /* The fixed sidebar container */
      #filter-sidebar {
        position: fixed;
        z-index: 200;
      }

      .filter-block {
        margin-bottom: 60px;
      }

      /* ── Button ── */
      .flt-btn {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        width: 190px !important;
        height: 36px !important;
        padding: 0 10px 0 14px !important;
        background-color: #00bcd4 !important;   /* cyan */
        color: #ffffff !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        letter-spacing: 0.8px !important;
        text-transform: uppercase !important;
        border: none !important;
        border-radius: 2px !important;
        cursor: pointer !important;
        box-shadow: 0 2px 5px rgba(0,0,0,0.45) !important;
        outline: none !important;
        -webkit-tap-highlight-color: transparent !important;
        /* no transition so no flash */
        transition: none !important;
      }
      /* Keep EXACTLY the same cyan on every state */
      .flt-btn:hover,
      .flt-btn:focus,
      .flt-btn:active {
        background-color: #00bcd4 !important;
        color: #ffffff !important;
      }

      /* Sort button is grey */
      .flt-btn.flt-grey {
        background-color: #757575 !important;
      }
      .flt-btn.flt-grey:hover,
      .flt-btn.flt-grey:focus,
      .flt-btn.flt-grey:active {
        background-color: #757575 !important;
        color: #ffffff !important;
      }

      .flt-btn .flt-arrow {
        font-size: 22px !important;
        line-height: 1 !important;
        pointer-events: none !important;
        flex-shrink: 0 !important;
      }

      /* ── Wrapper for positioning ── */
      .flt-wrap {
        position: relative;
        display: inline-block;
      }

      /* ── Dropdown list ── */
      .flt-list {
        display: none;
        position: absolute;
        top: calc(100% + 2px);
        left: 0;
        width: 190px;
        background-color: #111111 !important;
        border: 1px solid #222;
        box-shadow: 0 6px 18px rgba(0,0,0,0.7);
        z-index: 9999;
        list-style: none !important;
        margin: 0 !important;
        padding: 6px 0 !important;
        border-radius: 2px;
      }
      .flt-list.flt-open {
        display: block !important;
      }

      /* ── List items ── */
      .flt-list li {
        display: block !important;
        margin: 0 !important;
        padding: 0 !important;
      }

      .flt-list li a,
      .flt-list li a:link,
      .flt-list li a:visited,
      .flt-list li a:hover,
      .flt-list li a:active,
      .flt-list li a:focus {
        display: block !important;
        padding: 9px 16px !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        letter-spacing: 0.2px !important;
        cursor: pointer !important;
        white-space: nowrap !important;
        background: transparent !important;
        text-decoration: none !important;
        /* Cyan text for category & brand */
        color: #00e5ff !important;
      }
      .flt-list li a:hover {
        background-color: rgba(0,229,255,0.08) !important;
      }

      /* Sort list: white text */
      .flt-list.flt-sort-list li a,
      .flt-list.flt-sort-list li a:link,
      .flt-list.flt-sort-list li a:visited,
      .flt-list.flt-sort-list li a:hover,
      .flt-list.flt-sort-list li a:active,
      .flt-list.flt-sort-list li a:focus {
        color: #ffffff !important;
      }
      .flt-list.flt-sort-list li a:hover {
        background-color: rgba(255,255,255,0.08) !important;
      }
    </style>
</head>
<body>
  <main>
    <div class="row" style="padding-top: 15px;">
      <div class="col s2 center">

        <div id="filter-sidebar">
          <form id="form-filter" action="" method="GET">
            <input type="hidden" name="query" value="<?php if(isset($_GET['query'])) echo htmlspecialchars($_GET['query']); ?>">

            <?php
              $category = -1;
              if (isset($_GET['category']) && $_GET['category'] !== '') $category = intval($_GET['category']);

              $sort = -1;
              if (isset($_GET['sort']) && $_GET['sort'] !== '') $sort = intval($_GET['sort']);

              $brand = -1;
              if (isset($_GET['brand']) && $_GET['brand'] !== '') $brand = intval($_GET['brand']);

              $cat_label   = ($category != -1) ? htmlspecialchars(CATEGORY_NAMES[$category]) : 'Select Category';
              $sort_label  = ($sort     != -1) ? htmlspecialchars(SORT_NAMES[$sort])         : 'Select Sort Type';
              $brand_label = ($brand    != -1) ? htmlspecialchars(BRAND_NAMES[$brand])       : 'Select Brand';
            ?>

            <input type="hidden" name="category" id="inp-category" value="<?php echo $category; ?>">
            <input type="hidden" name="sort"     id="inp-sort"     value="<?php echo $sort; ?>">
            <input type="hidden" name="brand"    id="inp-brand"    value="<?php echo $brand; ?>">

            <!-- ══ CATEGORY ══ -->
            <div class="filter-block">
              <div class="flt-wrap">
                <button type="button" class="flt-btn" onclick="toggleDD('dd-category')">
                  <span id="lbl-category"><?php echo $cat_label; ?></span>
                  <i class="flt-arrow material-icons">arrow_drop_down</i>
                </button>
                <ul id="dd-category" class="flt-list">
                  <li><a onclick="pick('category',-1,'Select Category')">Clear</a></li>
                  <li><a onclick="pick('category', 0,'PC Packages')">PC Packages</a></li>
                  <li><a onclick="pick('category', 1,'Monitor &amp; Audio')">Monitor &amp; Audio</a></li>
                  <li><a onclick="pick('category', 2,'Peripherals')">Peripherals</a></li>
                </ul>
              </div>
            </div>

            <!-- ══ SORT ══ -->
            <div class="filter-block">
              <div class="flt-wrap">
                <button type="button" class="flt-btn flt-grey" onclick="toggleDD('dd-sort')">
                  <span id="lbl-sort"><?php echo $sort_label; ?></span>
                  <i class="flt-arrow material-icons">arrow_drop_down</i>
                </button>
                <ul id="dd-sort" class="flt-list flt-sort-list">
                  <li><a onclick="pick('sort',-1,'Select Sort Type')">Clear</a></li>
                  <li><a onclick="pick('sort', 0,'Price low to high')">Price low to high</a></li>
                  <li><a onclick="pick('sort', 1,'Price high to low')">Price high to low</a></li>
                </ul>
              </div>
            </div>

            <!-- ══ BRAND ══ -->
            <div class="filter-block">
              <div class="flt-wrap">
                <button type="button" class="flt-btn" onclick="toggleDD('dd-brand')">
                  <span id="lbl-brand"><?php echo $brand_label; ?></span>
                  <i class="flt-arrow material-icons">arrow_drop_down</i>
                </button>
                <ul id="dd-brand" class="flt-list">
                  <li><a onclick="pick('brand',-1,'Select Brand')">Clear</a></li>
                  <li><a onclick="pick('brand', 0,'Asus')">Asus</a></li>
                  <li><a onclick="pick('brand', 1,'MSI')">MSI</a></li>
                  <li><a onclick="pick('brand', 2,'Razer')">Razer</a></li>
                  <li><a onclick="pick('brand', 3,'Logitech')">Logitech</a></li>
                  <li><a onclick="pick('brand', 4,'Viewsonic')">Viewsonic</a></li>
                  <li><a onclick="pick('brand', 5,'Acer')">Acer</a></li>
                  <li><a onclick="pick('brand', 6,'HyperX')">HyperX</a></li>
                  <li><a onclick="pick('brand', 7,'Steelseries')">Steelseries</a></li>
                  <li><a onclick="pick('brand', 8,'Corsair')">Corsair</a></li>
                </ul>
              </div>
            </div>

          </form>
        </div>
      </div><!-- col s2 -->

      <div class="col s9" style="margin-bottom: 80px;">
        <?php searchItems($category, $brand, $sort); ?>
      </div>
    </div>
  </main>

  <script>
    function toggleDD(id) {
      document.querySelectorAll('.flt-list').forEach(function(el) {
        if (el.id !== id) el.classList.remove('flt-open');
      });
      document.getElementById(id).classList.toggle('flt-open');
    }

    function pick(field, value, label) {
      document.getElementById('inp-' + field).value = value;
      document.getElementById('lbl-' + field).textContent = label;
      document.getElementById('dd-'  + field).classList.remove('flt-open');
      document.getElementById('form-filter').submit();
    }

    document.addEventListener('click', function(e) {
      if (!e.target.closest('.flt-wrap')) {
        document.querySelectorAll('.flt-list').forEach(function(el) {
          el.classList.remove('flt-open');
        });
      }
    });
  </script>

  <?php include_once "footer.php"; ?>
</body>
</html>