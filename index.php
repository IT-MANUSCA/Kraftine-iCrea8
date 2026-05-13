<?php
  include_once('./includes/headerNav.php');

  // Get all banner products
  $banner_products = get_banner_details();
  $deals_of_the_day = get_deal_of_day();
  // Get all category bar products
  $catgeory_bar_products = get_category_bar_products();

  // Get categories
  $categories = get_categories();
  $anniversary = get_anniversary_category();
  $wedding = get_wedding_category();
  $sympathy = get_sympathy_category();
  $mothers_day = get_mothers_day_category();
  $fathers_day = get_fathers_day_category();
  $valentines_day = get_valentines_day_category();
  $birthday = get_birthday_category();


  // Get all new arrivals
$new_arrivals1 = get_new_arrivals();
$new_arrivals2 = get_new_arrivals();

// Get trending products
$trending_products1 = get_trending_products();
$trending_products2 = get_trending_products();

// Get top rated products
$top_rated_products1 = get_top_rated_products();
$top_rated_products2 = get_top_rated_products();
?>



<div class="overlay" data-overlay></div>

<!--
    - MODAL
  -->

<!--
    - NOTIFICATION TOAST
  -->



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

<!--
    - MAIN
  -->

<main>
  <!--
      - BANNER: Carousel
    -->
    <?php
$query = "SELECT * FROM banner";
$banner_products = mysqli_query($conn, $query);

if (!$banner_products) {
  die("Query Failed: " . mysqli_error($conn));
}
?>
<div class="banner">
  <div class="container">
    <div class="slider-container has-scrollbar">
      <?php while ($row = mysqli_fetch_assoc($banner_products)) { ?>
        <div class="slider-item">
          <img src="images/carousel/<?php echo $row['banner_image']; ?>" alt="KRAFTINE IMAGE" class="banner-img" />

          <div class="banner-content">
            <p class="banner-subtitle" style="color: <?php echo $row['banner_subtitle_color']; ?>;">
              <?php echo $row['banner_subtitle']; ?>
            </p>

            <h2 class="banner-title" style="color: <?php echo $row['banner_title_color']; ?>;">
              <?php echo $row['banner_title']; ?>
            </h2>

           

          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>



  <!--
      - CATEGORY: Bar 
    -->

  <div class="category">
    <div class="container">
      <div class="category-item-container has-scrollbar">
        <!--  -->
        <?php
        while ($row = mysqli_fetch_assoc($catgeory_bar_products)) {
        ?>


          <div class="category-item">
            <div class="category-img-box">
            <img src="./images/icons/<?php echo $row['category_img']; ?>" alt="category bar img" width="30">

            </div>

            <div class="category-content-box">
              <div class="category-content-flex">
                <h3 class="category-item-title"><?php echo $row['category_title'] ?></h3>
              </div>

            <!-- updated it. set to form and will send data to search page -->
                  <form class="search-form" method="post" action="./search.php">
                    <input type="hidden" name="search" value="<?php echo $row['category_title'] ?>" />
                        <button type="submit" name="submit" class="sidebar-submenu-title">

                          <p class="category-btn">
                            Show all
                          </p>

                        </button>
                  </form>              
            </div>
          </div>
        <?php
        }
        ?>


        <!--  -->

      </div>
    </div>
  </div>

  <!--
      - PRODUCT
    -->

  <div class="product-container">
    <div class="container">
      <!--
          - SIDEBAR
        -->
      <!-- adding side bar php page -->
      <?php require_once './includes/categorysidebar.php' ?>







      <div class="product-box">



      
        <!--
            - PRODUCT MINIMAL
          -->



<?php
$new_arrivals1 = mysqli_query($conn, "SELECT * FROM products WHERE post_type = 'new_arrival' ORDER BY product_id DESC LIMIT 8");

?>
        <div class="product-minimal">
          <div class="product-showcase">
            <h2 class="title">New Arrivals</h2>

            <div class="showcase-wrapper has-scrollbar">
              <!-- new arrival container 1 -->

              <div class="showcase-container">
                <!-- get element from table with id less than 4 -->
                <?php
                $itemID;
                $counter = 0;
                while ($row1 = mysqli_fetch_assoc($new_arrivals1)) {
                  // prints 4 items and then break out
                  if ($counter == 4) {
                    break;
                  }

                ?>
                  <div class="showcase">
                    <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>" class="showcase-img-box">
                      <img src="./admin/upload/<?php echo $row1['product_img']; ?>" alt="relaxed short full sleeve t-shirt" width="70" class="showcase-img" />
                    </a>

                    <div class="showcase-content">
                      <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>">
                        <h4 class="showcase-title">
                          <?php echo $row1['product_title']; ?>
                        </h4>
                      </a>

                      <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>" class="showcase-category">
                        <?php echo "New Arrival!"; ?>
                      </a>

                      <div class="price-box">
                        <p class="price">₱<?php echo $row1['discounted_price']; ?></p>
                        <del>₱<?php echo $row1['product_price']; ?></del>
                      </div>
                    </div>
                  </div>
                <?php
                  $itemID = $row1['product_id'];
                  $counter += 1;
                }
                ?>


              </div>
              <!--  -->
              <!-- new arrival container 2 -->
              <div class="showcase-container">
                <!-- get element from table with id greaer than 4 -->
                <?php
                // $itemID = 4;
                $counter = 0;
                while ($row2 = mysqli_fetch_assoc($new_arrivals2)) {
                  // breaks after printing 4 items
                  if ($counter == 4) {
                    break;
                  }
                  if ($row2['product_id'] > $itemID) {

                ?>
                    <div class="showcase">
                      <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>" class="showcase-img-box">
                        <img src="./admin/upload/<?php echo $row2['product_img']; ?>" alt="flower" class="showcase-img" width="70" />
                      </a>

                      <div class="showcase-content">
                        <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>">
                          <h4 class="showcase-title">
                            <?php echo $row2['product_title']; ?>
                          </h4>
                        </a>

                        <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>" class="showcase-category">
                          <?php echo "New Arrival!"; ?>
                        </a>

                        <div class="price-box">
                          <p class="price">
                            ₱<?php echo $row2['discounted_price']; ?>
                          </p>
                          <del>
                            ₱<?php echo $row2['product_price']; ?>
                          </del>
                        </div>
                      </div>
                    </div>

                <?php
                    $counter += 1;
                  }
                }
                ?>

                <!--  -->
              </div>
            </div>
          </div>









          <?php


// Trending products queries
$trending_products1 = mysqli_query($conn, "SELECT * FROM products WHERE post_type = 'trending' ORDER BY product_id ASC LIMIT 8");

?>


          <!-- Trending Items -->
          <div class="product-showcase">
            <h2 class="title">Trending</h2>

            <div class="showcase-wrapper has-scrollbar">
              <!-- get data from trending table in db -->
              <!-- trending container 1 -->
              <div class="showcase-container">
                <!-- get element from table with id less than 4 -->
                <?php
                $itemID;
                $counter = 0;
                while ($row1 = mysqli_fetch_assoc($trending_products1)) {
                  // prints 4 items and then break out
                  if ($counter == 4) {
                    break;
                  }

                ?>
                  <div class="showcase">
                    <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>" class="showcase-img-box">
                      <img src="./admin/upload/<?php echo $row1['product_img']; ?>" alt="Treding products image" width="70" class="showcase-img" />
                    </a>

                    <div class="showcase-content">
                      <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>">
                        <h4 class="showcase-title">
                          <?php echo $row1['product_title']; ?>
                        </h4>
                      </a>

                      <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>" class="showcase-category">
                        <?php echo "Trending Now!"; ?>
                      </a>

                      <div class="price-box">
                        <p class="price">₱<?php echo $row1['discounted_price']; ?></p>
                        <del>₱<?php echo $row1['product_price']; ?></del>
                      </div>
                    </div>
                  </div>
                <?php
                  $itemID = $row1['product_id'];
                  $counter += 1;
                }
                ?>


              </div>
              <!-- trending container 2 -->
              <div class="showcase-container">
                <!-- get element from table with id greaer than 4 -->
                <?php
                // $itemID = 4;
                $counter = 0;
                while ($row2 = mysqli_fetch_assoc($trending_products2)) {
                  // breaks after printing 4 items
                  if ($counter == 4) {
                    break;
                  }
                  if ($row2['product_id'] > $itemID) {

                ?>
                    <div class="showcase">
                      <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>" class="showcase-img-box">
                        <img src="./admin/upload/<?php echo $row2['product_img']; ?>" alt="trending product image" class="showcase-img" width="70" />
                      </a>

                      <div class="showcase-content">
                        <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>">
                          <h4 class="showcase-title">
                            <?php echo $row2['product_title']; ?>
                          </h4>
                        </a>

                        <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>" class="showcase-category">
                          <?php echo "Trending Now!"; ?>
                        </a>

                        <div class="price-box">
                          <p class="price">
                            ₱<?php echo $row2['discounted_price']; ?>
                          </p>
                          <del>
                            ₱<?php echo $row2['product_price']; ?>
                          </del>
                        </div>
                      </div>
                    </div>

                <?php
                    $counter += 1;
                  }
                }
                ?>

                <!--  -->
              </div>
              <!--  -->
            </div>
          </div>















          <div class="product-showcase">
            <h2 class="title">Top Rated</h2>
            <!-- Load data from top rated table -->
            <div class="showcase-wrapper has-scrollbar">
              <!-- top rated container 1 -->
              <div class="showcase-container">
                <!-- get element from table with id less than 4 -->
                <?php
                $itemID;
                $counter = 0;
                while ($row1 = mysqli_fetch_assoc($top_rated_products1)) {
                  // prints 4 items and then break out
                  if ($counter == 4) {
                    break;
                  }

                ?>
                  <div class="showcase">
                    <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>" class="showcase-img-box">
                      <img src="./admin/upload/<?php echo $row1['product_img']; ?>" alt="relaxed short full sleeve t-shirt" width="70" class="showcase-img" />
                    </a>

                    <div class="showcase-content">
                      <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>">
                        <h4 class="showcase-title">
                          <?php echo $row1['product_title']; ?>
                        </h4>
                      </a>

                      <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>" class="showcase-category">
                        <?php echo "Top Rated!"; ?>
                      </a>

                      <div class="price-box">
                        <p class="price">₱<?php echo $row1['discounted_price']; ?></p>
                        <del>₱<?php echo $row1['product_price']; ?></del>
                      </div>
                    </div>
                  </div>
                <?php
                  $itemID = $row1['product_id'];
                  $counter += 1;
                }
                ?>


              </div>
              <!-- top rated conatiner 2 -->
              <div class="showcase-container">
                <!-- get element from table with id greaer than 4 -->
                <?php
                // $itemID = 4;
                $counter = 0;
                while ($row2 = mysqli_fetch_assoc($top_rated_products2)) {
                  // breaks after printing 4 items
                  if ($counter == 4) {
                    break;
                  }
                  if ($row2['product_id'] > $itemID) {

                ?>
                    <div class="showcase">
                      <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>" class="showcase-img-box">
                        <img src="./admin/upload/<?php echo $row2['product_img']; ?>" alt="trending product image" class="showcase-img" width="70" />
                      </a>

                      <div class="showcase-content">
                        <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>">
                          <h4 class="showcase-title">
                            <?php echo $row2['product_title']; ?>
                          </h4>
                        </a>

                        <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>" class="showcase-category">
                          <?php echo "Top Rated!"; ?>
                        </a>

                        <div class="price-box">
                          <p class="price">
                            ₱<?php echo $row2['discounted_price']; ?>
                          </p>
                          <del>
                            ₱<?php echo $row2['product_price']; ?>
                          </del>
                        </div>
                      </div>
                    </div>

                <?php
                    $counter += 1;
                  }
                }
                ?>

                <!--  -->
              </div>
              <!--  -->
            </div>
          </div>
        </div>

        <!--
            - PRODUCT FEATURED
          -->

<?php require_once './includes/dealoftheday.php' ?>




  <!--
      - TESTIMONIALS, CTA & SERVICE
    -->

  <div>
    <div class="container">
      <div class="testimonials-box">
        <!--
            - TESTIMONIALS
          -->

        <div class="testimonial">
          <h2 class="title">testimonial</h2>

          <div class="testimonial-card">
            <img src="./images/flogo/fav.png" alt="FLower" class="testimonial-banner" width="80" height="80" />

            <p class="testimonial-name">Lianne</p>

            <p class="testimonial-title">What makes us Different?</p>

            <p class="testimonial-desc">
            We pour heart and dedication into every arrangement we create. Our handcrafted designs go beyond aesthetics—they are thoughtfully made to bring joy to both the giver and receiver. With a keen eye for detail and a commitment to quality, we ensure that each bouquet reflects the emotions and sentiments behind every order. We continuously innovate, offering new designs and expanding our craft to keep up with evolving customer preferences.
            </p>
          </div>
        </div>


        <style>
    .testimonial{
      width: 1000px;
      margin-left:-10px;
    }
    .service{
      width: 1000px;
      margin-left:-10px;
    }
    .service-icon{
      margin-left: 70px;
    }
    </style>
        <!--
            - SERVICE
          -->

        <div class="service">
          <h2 class="title">Our Services</h2>

          <div class="service-container">
            <a href="#" class="service-item">
              <div class="service-icon">
                <ion-icon name="boat-outline"></ion-icon>
              </div>


              <div class="service-content">
                <h3 class="service-title">Same day delivery</h3>
                <p class="service-desc">RIZAL AREA ONLY</p>
              </div>
            </a>

            <a href="#" class="service-item">
              <div class="service-icon">
                <ion-icon name="call-outline"></ion-icon>
              </div>

              <div class="service-content">
                <h3 class="service-title">Customer Service</h3>
                <p class="service-desc">Hours: 8AM - 6PM</p>
              </div>
            </a>

            <a href="#" class="service-item">
              <div class="service-icon">
                <ion-icon name="arrow-undo-outline"></ion-icon>
              </div>

              <div class="service-content">
                <h3 class="service-title">Return Policy</h3>
                <p class="service-desc">Easy Refund with receipt</p>
              </div>
            </a>

           

              
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>


<?php include 'includes/my_purchases_modal.php'; ?>


<?php require_once './includes/footer.php'; ?>