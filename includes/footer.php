
   <!--
    - FOOTER
  -->
<style>
  /* Add to your CSS file */
footer {
  background-color: #f7f4ef;
  color: #4d3e29;
}
.footer-category-link,
.footer-nav-link,
.nav-title,
address,
a {
  color: #4d3e29;
}
.footer-category-link:hover,
.footer-nav-link:hover {
  color: white; /* Yellow accent on hover */
}
html, footer {
  margin-bottom: 0;
  padding-bottom: 0;
}
body {
  margin: 0;
  padding: 0;
}



  </style>
    <footer style="margin-top:70px">
      <div class="footer-category">
        <div class="container">
          <h2 class="footer-category-title">Kraftin'e</h2>

          <div class="footer-category-box">
            <h3 class="category-box-title">Flowers : </h3>

            <a href="#" class="footer-category-link">Butterfly</a>
            <a href="#" class="footer-category-link">Mariposa</a>
            <a href="#" class="footer-category-link">Maiah</a>
            <a href="#" class="footer-category-link">Money Bouquet</a>
            <a href="#" class="footer-category-link">Roses</a>
            <a href="#" class="footer-category-link">Sunflower</a>
            <a href="#" class="footer-category-link">Tulips</a>
          </div>

          <div class="footer-category-box">
            <h3 class="category-box-title">Events : </h3>

            <a href="#" class="footer-category-link">Birthday</a>
            <a href="#" class="footer-category-link">Wedding</a>
            <a href="#" class="footer-category-link">Anniversary</a>
            <a href="#" class="footer-category-link">Mothers Day</a>
            <a href="#" class="footer-category-link">Fathers Day</a>
            <a href="#" class="footer-category-link">Sympathy</a>
            <a href="#" class="footer-category-link">Memorial Day</a>
            <a href="#" class="footer-category-link">Valentines Day</a>

          </div>


      <div class="footer-nav">
        <div class="container">
          <ul class="footer-nav-list">
            <li class="footer-nav-item">
              <h2 class="nav-title">Popular Events</h2>
            </li>

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">Birthday</a>
            </li>

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">Valentines Day</a>
            </li>

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">Wedding</a>
            </li>

            
          </ul>

          <ul class="footer-nav-list">
            <li class="footer-nav-item">
              <h2 class="nav-title">Products</h2>
            </li>

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">Prices drop</a>
            </li>

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">New products</a>
            </li>

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">Best sales</a>
            </li>

            <li class="footer-nav-item">
              <a href="./contact.php" class="footer-nav-link">Contact us</a>
            </li>

            
          </ul>

          <ul class="footer-nav-list">
            <li class="footer-nav-item">
              <h2 class="nav-title">Our Company</h2>
            </li>

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">Delivery</a>
            </li>

          

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">Terms and conditions</a>
            </li>

            <li class="footer-nav-item">
              <a href="./about.php" class="footer-nav-link">About us</a>
            </li>

            
          </ul>

          <ul class="footer-nav-list">
            <li class="footer-nav-item">
              <h2 class="nav-title">Services</h2>
            </li>

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">Prices drop</a>
            </li>

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">New products</a>
            </li>

            <li class="footer-nav-item">
              <a href="#" class="footer-nav-link">Best sales</a>
            </li>

            <li class="footer-nav-item">
              <a href="./contact.php" class="footer-nav-link">Contact us</a>
            </li>

            
          </ul>

          <ul class="footer-nav-list">
            <li class="footer-nav-item">
              <h2 class="nav-title">Contact</h2>
            </li>

            <li class="footer-nav-item flex">
              <div class="icon-box">
                <ion-icon name="location-outline"></ion-icon>
              </div>
              <!-- Adress -->
              <address class="content">
                <?php echo ($site_address); ?>
              </address>
            </li>

            <li class="footer-nav-item flex">
              <div class="icon-box">
                <ion-icon name="call-outline"></ion-icon>
              </div>

              <a href="Mobile:+63 912 345 6789" class="footer-nav-link"><?php echo ($site_contact_num); ?></a>
            </li>

            <li class="footer-nav-item flex">
              <div class="icon-box">
                <ion-icon name="mail-outline"></ion-icon>
              </div>

              <a href="mailto:<?php echo($site_info_email); ?>" class="footer-nav-link"><?php echo($site_info_email); ?></a>
            </li>
          </ul>

          <ul class="footer-nav-list">
            <li class="footer-nav-item">
              <h2 class="nav-title">Follow Us</h2>
            </li>

            <li>
              <ul class="social-link">
                <li class="footer-nav-item">
                  <a href="https://web.facebook.com/lkraftine?_rdc=1&_rdr#" class="footer-nav-link">
                    <ion-icon name="logo-facebook"></ion-icon>
                  </a>
                </li>

                <li class="footer-nav-item">
                  <a href="#" class="footer-nav-link">
                    <ion-icon name="logo-twitter"></ion-icon>
                  </a>
                </li>

                <li class="footer-nav-item">
                  <a href="#" class="footer-nav-link">
                    <ion-icon name="logo-linkedin"></ion-icon>
                  </a>
                </li>

                <li class="footer-nav-item">
                  <a href="#" class="footer-nav-link">
                    <ion-icon name="logo-instagram"></ion-icon>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <div class="container">

          <p class="copyright">
            Copyright &copy; <a href="#"><?php echo $_SESSION['web-footer']; ?></a> all rights reserved.
          </p>
        </div>
      </div>
    </footer>

    <!--
    - custom js link
  -->
    <!-- <script src="./assets/js/script.js"></script> -->
    <script src="./js/notification.js"></script>
    <script src="./js/mobilemenu.js"></script>
    <script src="./js/datamodal.js"></script>
    <script src="./js/dataaccordion.js"></script>
    <script src="./ajax/I.js"></script>
    <!--
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
	<script src="./js/jquery.js" type="text/javascript"></script>
	<script src="./js/bootstrap.min.js" type="text/javascript"></script>
	<script src="./js/electricshop.js"></script>
	<script src="./js/main.js"></script>

    </body>

    </html>