<?php 
  include_once('./includes/headerNav.php');
?>



<div class="overlay" data-overlay></div>
<!--
    - HEADER
  -->

<header>
  <!-- top head action, search etc in php -->
  <?php require_once './includes/topheadactions.php'; ?>

  <!-- desktop navigation -->
  <?php require_once './includes/desktopnav.php' ?>
  <!-- mobile nav in php -->
 <?php require_once './includes/mobilenav.php'; ?>
</header>

<!--
    - MAIN
  -->
<main>

  <div class="product-container">
    <div class="container">
      <!--
          - SIDEBAR
        -->
      <!-- CATEGORY SIDE BAR MOBILE MENU -->
      <?php require_once './includes/categorysidebar.php' ?>
      <!-- ############################# -->

      <div class="product-box">
        <!-- get id and url for each category and display its dat from table her in this secton -->
        <div class="product-main">

          <!--  -->
          <!-- about us section -->
          <div class="about-us">
            <div class="about-us-section">
              <!-- about us text -->
              <div class="about-us-content">
                <div class="about-us-text">
                  <h1 id="about-title" style="text-align: center; color: #4d3e29;" >About Us!</h1>
                  <br>
                  <h2 style="text-align: center;">
                  Welcome To <span id="about-title"><span style="color: #4d3e29;"><?php echo $_SESSION['web-name'];?></span>
                  </h2>
                  <p>
                    <strong id="about-title"> <span style="color: #4d3e29;"><?php echo $_SESSION['web-name']; ?></strong> We specialize in handcrafted floral arrangements, from traditional flower bouquets to unique creations made with satin ribbons, money, balloons, and other customized elements. Whether it’s a special gift, a romantic gesture, or a decorative piece, our work is tailored to our customers’ vision. In addition to handcrafted flowers, we also provide fresh floral arrangements featuring roses and sunflowers. Every order is made with attention to detail, ensuring that each bouquet is as unique as the person receiving it.
                  </p>
                  <p style="font-weight: bold; text-align: center;">
                    Thanks For Visiting To <strong id="about-title"><span style="color: #4d3e29;"> <?php echo $_SESSION['web-name']; ?></strong>
                    <br>
                    <br>
                    <span style="font-size: 16px; font-weight: bold; text-align: center;">
                      Have a nice day!
                    </span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <!--  -->


        </div>
      </div>
    </div>
  </div>

  <!--
      - TESTIMONIALS, CTA & SERVICE
    -->

  <!--
      - BLOG
    -->

</main>


<?php require_once './includes/footer.php'; ?>