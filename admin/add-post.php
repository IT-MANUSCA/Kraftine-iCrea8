<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
 ?>
 <head>
     <style>
        .content-box-post {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
         .addpost{
            border: 1px solid black;
            width: 80%;
            padding: 25px;
            border-radius: 16px;
            background-color: #f1f1f1;
         }

     </style>
 </head>
<div class="content-box-post">
    
 <div class="addpost">
 <h1>Add post here</h1>

  <!-- Form -->
    <form
      action="save-post.php"
      method="POST"
      enctype="multipart/form-data"
      class="row g-3"
    >
      <div class="col-12">
        <label for="inputAddress" class="form-label">Title</label>
        <input
          name="prod-title"
          type="text"
          class="form-control"
          placeholder="Product Name..."
          required="required"
        />
      </div>
      <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Price</label>
        <input
          name="prod-price"
          type="number"
          class="form-control"
          value=""
          required="required"
        />
      </div>
      <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Discount</label>
        <input
          name="prod-discount"
          type="number"
          class="form-control"
          required="required"
        />
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label"
          >Description</label
        >
        <textarea
          class="form-control"
          rows="3"
          name="prod-desc"
          required="required"
        ></textarea>
      </div>
      <div class="col-md-6">
        <label for="inputCity" class="form-label">No. of Items</label>
        <input
          type="number"
          class="form-control"
          name="noofitem"
          value=""
          required="required"
        />
      </div>



      <div class="col-md-6">
        <label for="inputState" class="form-label">Category</label>
        <select name="prod-category" class="form-select" required>
  <option value="" disabled selected>Select Category</option>
  <?php
    include "includes/config.php"; // Include your DB connection

    $sql = "SELECT * FROM category WHERE id"; // Only fetch active categories
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
      }
    } else {
      echo '<option disabled>No categories available</option>';
    }

    $conn->close(); // Close DB
  ?>
</select>

      </div>


      <div class="col-12">
  <label class="form-label">Post Type</label><br>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="post_type" id="newArrival" value="new_arrival" required>
    <label class="form-check-label" for="newArrival">New Arrival</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="post_type" id="trending" value="trending">
    <label class="form-check-label" for="trending">Trending</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="post_type" id="bestSeller" value="best_seller">
    <label class="form-check-label" for="bestSeller">Best Seller</label>
  </div>
</div>





      <div class="col-12">
        <label for="inputAddress" class="form-label">Image</label>
        <input
          type="file"
          name="prod-img"
          class="form-control"
          required="required"
        />
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          name="flexRadioDefault"
          id="flexRadioDefault2"
        />
        <label class="form-check-label" for="flexRadioDefault2">
          Available
        </label>
      </div>
      <div class="col-12">
        <button type="submit" name="submit" class="btn btn-primary">Add</button>
      </div>
    </form>
                  <!--/Form -->
 </div>
</div>




