<!--  -->
<?php include_once('./includes/headerNav.php'); ?>
<?php require_once './includes/topheadactions.php'; ?>
<?php require_once './includes/mobilenav.php'; ?>

<?php
// work on getting string with spaces from url
$category_ID = "";
if (isset($_GET['category'])) {
  $category_ID = $_GET['category'];
}


$items = get_items_by_category_items($category_ID);

?>

<div class="overlay" data-overlay></div>
<!--
    - HEADER
  -->
<header>
  <!-- top head action, search etc in php -->
  <!-- inc/topheadactions.php -->
  <?php require_once './includes/topheadactions.php'; ?>
  <!-- desktop navigation -->
  <!-- inc/desktopnav.php -->
  <?php require_once './includes/desktopnav.php' ?>
  <!-- mobile nav in php -->
  <!-- inc/mobilenav.php -->
  <?php require_once './includes/mobilenav.php'; ?>

</header>




<main>

  <div class="product-container">
    <div class="container">
      <!--
          - SIDEBAR
        -->
      <!-- CATEGORY SIDE BAR MOBILE MENU -->
    <?php require_once 'includes/categorysidebar.php' ?>

     
      <div class="product-box">
       



        <div class="product-main">

        <!--
            - PRODUCT GRID
          -->

          <div class="product-main">
          <h2 class="title">ALL FLOWERS</h2>

          <div class="product-grid">

            <!-- display data from table new products -->

            <?php
//this will dynamically fetch data from a database and show all the post from mysql
//and this will auto create product div as per no of post available in database
/* define how much data to show in a page from database*/
$limit = 8;
if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = 1;
}
//define from which row to start extracting data from database
$offset = ($page - 1) * $limit;

$product_left = array();


            $new_product_counter = 1;

            $new_products_result = get_new_products($offset, $limit);
    if($new_products_result->num_rows > 0){

            while ($row = mysqli_fetch_assoc($new_products_result)) {

            ?>


              <div class="showcase">
                <div class="showcase-banner">
                  <img src="./admin/upload/<?php
                                                      echo $row['product_img']
                                                      ?>" alt="FLOWER" width="300" class="product-img default" />
                  <img src="./admin/upload/<?php
                                                      echo $row['product_img']
                                                      ?>" alt="FLOWER" width="300" class="product-img hover" />
                  <!-- Applying coditions on dicount and sale tags  -->
                  <!--  -->
                  <?php
                  if ($new_product_counter == 1) {
                  ?>
                    <p class="showcase-badge"></p>
                  <?php
                  }
                  ?>
                  <!--  -->
                  <?php
                  if ($new_product_counter == 3) {
                  ?>
                    <p class="showcase-badge angle black">sale</p>
                  <?php
                  }
                  ?>

                </div>

                <div class="showcase-content">
                  <a href="./viewdetail.php?id=<?php
                                                echo $row['product_id']
                                                ?>&category=<?php
                                                            echo $row['category_id']
                                                            ?>" class="showcase-category">
                    <?php echo $row['product_title'] ?>
                  </a>

                  <a href="./viewdetail.php?id=<?php
                                                echo $row['product_id']
                                                ?>&category=<?php
                                                            echo $row['category_id']
                                                            ?>">
                    <h3 class="showcase-title">
                      <?php echo $row['product_desc'] ?>
                    </h3>
                  </a>

                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>

                  <div class="price-box">
                    <p class="price">
                    ₱<?php echo $row['discounted_price'] ?>
                    </p>
                    <del>
                    ₱<?php echo $row['product_price'] ?>
                    </del>
                  </div>
                </div>
              </div>

            <?php
              $new_product_counter = $new_product_counter + 1;
            }
    }else { 
      echo "No Results Found"; }
             $conn->close(); 

            ?>
            <!--  -->
          </div>
        </div>
        <!-- pagination start -->
        <!--Pagination-->
<?php
    include "includes/config.php"; 
    // Pagination btn using php with active effects 

    $sql1 = "SELECT * FROM products";
    $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

    if(mysqli_num_rows($result1) > 0){
        $total_products = mysqli_num_rows($result1);
        $total_page = ceil($total_products / $limit);

?>
    <nav class="main-pagination" style="margin-left: 10px;">
      <ul class="pagination-ul">


        <?php 
            for($i=1; $i<=$total_page; $i++){
                //important this is for active effects that denote in which page you are in current position
                if ($page==$i) {
                    $active = "page-active";
                } else {
                    $active = "";
                }
        ?>
        <li class="page-item-number <?php echo $active; // page number ?>">
            <a class="page-number-link " href="index.php?page=<?php echo $i; // page number ?>">
            <?php echo $i; // page number ?>
            </a>
        </li>
        <?php }} ?>

      </ul>
    </nav>
  <!-- pagination end -->
      </div>
    </div>
  </div>


          <div class="product-grid">

     

            <?php
            $new_product_counter = 1;
            while ($row = mysqli_fetch_assoc($items)) {

            ?>
              <!-- display all category products -->
              <div class="showcase">
                <div class="showcase-banner">
                  <img src="./admin/upload/<?php
                                                      echo $row['product_img']
                                                      ?>" alt="Flower" width="300" class="product-img default" />
                  <img src="./admin/upload/<?php
                                                      echo $row['product_img']
                                                      ?>" alt="Flower" width="300" class="product-img hover" />
                  <!-- Applying coditions on dicount and sale tags  -->
                  <!--  -->
                  <?php
                  if ($new_product_counter == 1) {
                  ?>
                    <p class="showcase-badge">15%</p>
                  <?php
                  }
                  ?>
                  <!--  -->
                  <?php
                  if ($new_product_counter == 3) {
                  ?>
                    <p class="showcase-badge angle black">sale</p>
                  <?php
                  }
                  ?>

                </div>

                <div class="showcase-content">
                  <a href="./viewdetail.php?id=<?php echo $row['product_id'] ?>&category=<?php $row['category_id'] ?>" class="showcase-category">
                    <?php echo $row['product_title'] ?>
                  </a>

                  <a href="./viewdetail.php?id=<?php echo $row['product_id'] ?>&category=<?php $row['category_id'] ?>">
                    <h3 class="showcase-title">
                      <?php echo $row['product_desc'] ?>
                    </h3>
                  </a>

                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>

                  <div class="price-box">
                    <p class="price">
                      $<?php echo $row['discounted_price'] ?>
                    </p>
                    <del>
                      $<?php echo $row['product_price'] ?>
                    </del>
                  </div>
                </div>
              </div>

            <?php
              $new_product_counter = $new_product_counter + 1;
            }

            ?>
            <!--  -->
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<?php require_once './includes/footer.php'; ?>
