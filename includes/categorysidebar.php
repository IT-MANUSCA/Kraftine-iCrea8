<?php
// get best sellers
$best_sellers = get_best_sellers();

// Get categories
$categories = get_categories();
$anniversary = get_anniversary_category();
$wedding = get_wedding_category();
$sympathy = get_sympathy_category();
$mothers_day = get_mothers_day_category();
$fathers_day = get_fathers_day_category();
$valentines_day = get_valentines_day_category();
$birthday = get_birthday_category();


?>
<!-- SIDEBAR -->
<div class="sidebar has-scrollbar" data-mobile-menu>
  <div class="sidebar-category">
    <div class="sidebar-top">
      <h2 class="sidebar-title">Category</h2>

      <button class="sidebar-close-btn" data-mobile-menu-close-btn>
        <ion-icon name="close-outline"></ion-icon>
      </button>
    </div>

    <ul class="sidebar-menu-category-list">
      <?php while ($row = mysqli_fetch_assoc($categories)) { ?>
        <li class="sidebar-menu-category">
          <form class="search-form" method="post" action="./search.php">
            <input type="hidden" name="search" value="<?php echo $row['name']; ?>" />
            <button type="submit" name="submit" class="sidebar-accordion-menu">
              <div class="menu-title-flex">
                <img src="./images/icons/<?php echo $row['img'] ?>" alt="<?php echo $row['name'] ?>" width="20" height="20" class="menu-title-img" />
                <p class="menu-title"><?php echo $row['name'] ?></p>
              </div>
            </button>
          </form>
        </li>
      <?php } ?>
    </ul>
  </div>
</div>




