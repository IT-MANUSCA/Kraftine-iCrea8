<?php
// Get all deals of the day
$deals_of_the_day = get_deal_of_day();
?>

<!-- Deal of the day -->
<div class="product-featured">
  <h2 class="title">Deal of the day</h2>

  <div class="showcase-wrapper has-scrollbar">
    <!-- display data from db -->
    <?php while ($row = mysqli_fetch_assoc($deals_of_the_day)) {
      $now = new DateTime();
      $end = new DateTime($row['deal_end_date']);
      $interval = $now->diff($end);
      $days = $interval->invert ? 0 : $interval->days;
      $hours = $interval->invert ? 0 : $interval->h;
      $minutes = $interval->invert ? 0 : $interval->i;
      $seconds = $interval->invert ? 0 : $interval->s;
    ?>
      <div class="showcase-container">
        <div class="showcase">
          <div class="showcase-banner">
            <img src="./admin/upload/<?php echo $row['deal_image']; ?>" alt="flower" class="showcase-img" />
          </div>

          <div class="showcase-content">
            <div class="showcase-rating">
              <ion-icon name="star"></ion-icon>
              <ion-icon name="star"></ion-icon>
              <ion-icon name="star"></ion-icon>
              <ion-icon name="star"></ion-icon>
              <ion-icon name="star"></ion-icon>
            </div>

            <a href="./viewdetail.php?id=<?php echo $row['deal_id'] ?>&category=deal_of_day">
              <h3 class="showcase-title"><?php echo $row['deal_title']; ?></h3>
            </a>

            <p class="showcase-desc"><?php echo $row['deal_description']; ?></p>

            <div class="price-box">
              <p class="price">₱ <?php echo $row['deal_net_price']; ?></p>
              <del>₱<?php echo $row['deal_discounted_price']; ?></del>
            </div>

            <form method="POST" action="cart.php">
  <input type="hidden" name="product_id" value="<?php echo $row['deal_id']; ?>">
  <input type="hidden" name="product_name" value="<?php echo $row['deal_title']; ?>">
  <input type="hidden" name="product_price" value="<?php echo $row['deal_net_price']; ?>">
  <input type="hidden" name="product_img" value="<?php echo $row['deal_image']; ?>">
  <input type="hidden" name="product_qty" value="1">
  <input type="hidden" name="product_category" value="deal_of_day">
  <button type="submit" name="add_to_cart" class="add-cart-btn">Add to Cart</button>
</form>



            <div class="showcase-status">
              <div class="wrapper">
                <p>already sold: <b><?php echo $row['sold_deal']; ?></b></p>
                <p>available: <b><?php echo $row['available_deal']; ?></b></p>
              </div>
              <div class="showcase-status-bar"></div>
            </div>

            <div class="countdown-box">
  <p class="countdown-desc">Hurry Up! Offer ends in:</p>
  <div class="countdown" data-enddate="<?php echo $row['deal_end_date']; ?>" id="deal-timer-<?php echo $row['deal_id']; ?>">
    <div class="countdown-content">
      <p class="display-number">--</p>
      <p class="display-text">Days</p>
    </div>
    <div class="countdown-content">
      <p class="display-number">--</p>
      <p class="display-text">Hours</p>
    </div>
    <div class="countdown-content">
      <p class="display-number">--</p>
      <p class="display-text">Min</p>
    </div>
    <div class="countdown-content">
      <p class="display-number">--</p>
      <p class="display-text">Sec</p>
    </div>
  </div>
</div>


          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>


<script>
  document.querySelectorAll('.countdown').forEach(function (timerBox) {
    const endDateStr = timerBox.getAttribute('data-enddate');
    const displayElements = timerBox.querySelectorAll('.display-number');
    
    function updateCountdown() {
      const now = new Date().getTime();
      const endDate = new Date(endDateStr).getTime();
      const timeLeft = endDate - now;

      if (timeLeft <= 0) {
        displayElements[0].innerText = '00';
        displayElements[1].innerText = '00';
        displayElements[2].innerText = '00';
        displayElements[3].innerText = '00';
        return;
      }

      const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
      const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const mins = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
      const secs = Math.floor((timeLeft % (1000 * 60)) / 1000);

      displayElements[0].innerText = String(days).padStart(2, '0');
      displayElements[1].innerText = String(hours).padStart(2, '0');
      displayElements[2].innerText = String(mins).padStart(2, '0');
      displayElements[3].innerText = String(secs).padStart(2, '0');
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
  });
</script>


