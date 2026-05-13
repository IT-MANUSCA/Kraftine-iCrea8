 
     <div class="header-top">
        <div class="container">
          <ul class="header-social-container">
            <li>
              <a href="https://web.facebook.com/lkraftine/?_rdc=1&_rdr" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-instagram"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-linkedin"></ion-icon>
              </a>
            </li>
          </ul>

          <div class="header-alert-news">
            <p>
              <b>WELCOME TO KRAFTIN'E</b>
              
            </p>
          </div>

        </div>
      </div>


      <style>

        .header-alert-news,
        .social-link{
          color: #4d3e29;
          
        }

        .search-field {
  border: 2px solid #ccc; /* default border */
  padding: 10px;
  border-radius: 5px;
  outline: none; /* remove default blue outline */
  transition: border-color 0.3s ease;
}

.search-field:focus {
  border-color: #4d3e29; /* your desired outline color */
  box-shadow: 0 0 5px #4d3e29; /* optional glow effect */
}

   

        </style>

      <div class="header-main" style="background-color: #f7f4ef; padding: 30px 0;">
  <div class="container">
    <!-- logo section -->
    <a href="./index.php?id=<?php echo (isset($_SESSION['customer_name'])) ? $_SESSION['id'] : 'unknown'; ?>" class="header-logo" style="color: hsl(0, 0%, 13%);">
      <h1 style="text-align: center;">
        <img src="admin/upload/<?php echo $_SESSION['web-img']; ?>" alt="logo" width="130px">
      </h1>
    </a>

    <!-- search input -->
    <div class="header-search-container">
      <form class="search-form" method="post" action="./search.php">
        <input type="search" name="search" class="search-field" placeholder="Enter flower name..." required oninvalid="this.setCustomValidity('Enter product name...')" oninput="this.setCustomValidity('')" />
        <button class="search-btn" type="submit" name="submit">
          <ion-icon name="search-outline"></ion-icon>
        </button>
      </form>
    </div>

    <!-- user actions -->
    <div class="header-user-actions">
      <!-- Logout button -->
      <?php if (isset($_SESSION['id'])) { ?>
        <button id="lg-btn" class="action-btn">
          <a href="logout.php" id="a" role="button">
            <ion-icon name="log-out-outline"></ion-icon>
          </a>
        </button>
        <script src="./js/logout.js"></script>
      <?php } else { ?>
        <!-- Login Button -->
        <button class="action-btn">
          <a href="./login.php" id="a">
            <ion-icon name="person-outline"></ion-icon>
          </a>
        </button>
      <?php } ?>

 

      





      <?php
      include 'config.php';
$total_cart_items = 0;
$customer_id = $_SESSION['id'] ?? null;

if ($customer_id) {
    // Logged-in user: Count from database
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM cart WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $total_cart_items = $row['total'];
    }
} else {
    // Guest user: Count from session
    if (isset($_SESSION['mycart'])) {
        $total_cart_items = count($_SESSION['mycart']);
    }
}
?>

      
<button class="action-btn">
  <a href="./cart.php">
    <ion-icon name="bag-handle-outline"></ion-icon>
  </a>
  <span class="count">
    <?php echo $total_cart_items; ?>
  </span>
</button>


    </div>
  </div>
</div>
