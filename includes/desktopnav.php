<!-- desktop navigation -->


<nav class="desktop-navigation-menu">
  <div class="container">
    <ul class="desktop-menu-category-list">

      <li class="menu-category">
        <a href="index.php?id=<?php echo (isset($_SESSION['customer_name'])) ? $_SESSION['id'] : 'unknown';?>" class="menu-title">
          Home
        </a>
      </li>

      <li class="menu-category">
        <a href="./category.php?category=<?php echo "Flowers"; ?>" class="menu-title">Flowers</a>
      </li>

      

      <li class="menu-category">
        <a href="contact.php?id=<?php echo (isset($_SESSION['customer_name'])) ? $_SESSION['id'] : 'unknown';?>" class="menu-title">
          Contact
        </a>
      </li>

      <li class="menu-category">
        <a href="about.php?id=<?php echo (isset($_SESSION['customer_name'])) ? $_SESSION['id'] : 'unknown';?>" class="menu-title">About</a>
      </li>

      <!-- Profile Link Setup -->
      <!-- if logged in -->
      <?php if (isset($_SESSION['id'])) { ?>

        <li class="menu-category" style="opacity:1">
          <a href="profile.php?id=<?php echo (isset($_SESSION['customer_name'])) ? $_SESSION['id'] : 'unknown';?>" class="menu-title">
            Profile
          </a>
        </li>
        
        

<li class="menu-category dropdown" style="position: relative;">
  <a href="#" class="menu-title" onclick="event.preventDefault(); toggleDropdown();">
    My Purchases ▾
  </a>
  <ul id="myPurchasesDropdown" class="dropdown-menu" style="display: none; position: absolute; top: 100%; left: 0; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0); z-index: 999; min-width: 200px; padding: 0; margin: 0; list-style: none; border-radius: 8px;">

    <li style="border-bottom: 1px solid #eee;">
      <a href="my_purchases_ongoing.php" style="display: block; padding: 10px 15px; color: #333; text-decoration: none;">Ongoing Orders</a>
    </li>
    <li style="border-bottom: 1px solid #eee;">
      <a href="my_purchases_completed.php" style="display: block; padding: 10px 15px; color: #333; text-decoration: none;">Completed Orders</a>
    </li>
    <li>
      <a href="my_purchase_cancelled.php" style="display: block; padding: 10px 15px; color: #333; text-decoration: none;">Cancelled Orders</a>
    </li>

  </ul>
</li>


<style>

  /* Dropdown behavior */
.menu-category.dropdown:hover .dropdown-menu {
  display: block;
  
}

/* Optional: hover effects */
.dropdown-menu li:hover {
  background-color: #f7f4ef;
  transition: background 0.2s ease;
}


  </style>


<script>
  function toggleDropdown() {
    var dropdown = document.getElementById('myPurchasesDropdown');
    dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
  }

  // Optional: Close dropdown when clicking outside
  document.addEventListener('click', function(event) {
    var dropdown = document.getElementById('myPurchasesDropdown');
    var trigger = event.target.closest('.dropdown');

    if (!trigger) {
      dropdown.style.display = 'none';
    }
  });
</script>


      <!-- if not logged in reduce opacity -->
      <?php } else { ?>

        <li class="menu-category" style="opacity:0.5">
          <a style="cursor: not-allowed;" href="#?loginfirst" class="menu-title">
            Profile (login First)
          </a>
        </li>

      <?php } ?>

      <!-- Visit Admin Panel After Login -->
      <?php if (isset($_SESSION['logged-in'])) { ?>
        <li class="menu-category">
          <a href="admin/post.php" class="menu-title">
            Admin Panel
          </a>
        </li>
      <?php } ?>

    </ul>
  </div>


</nav>
