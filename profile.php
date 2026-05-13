<?php
   include_once('./includes/headerNav.php');
   if (!(isset($_SESSION['id']))) {
      header("location:index.php?UnathorizedUser");
   }

   include "includes/config.php";
   $sql8 = "SELECT * FROM customer WHERE customer_id='{$_SESSION['id']}';";
   $result8 = $conn->query($sql8);
   $row8 = $result8->fetch_assoc();

   $_SESSION['customer_name'] = $row8['customer_fname'];
   $_SESSION['customer_email'] = $row8['customer_email'];
   $_SESSION['customer_phone'] = $row8['customer_phone'];
   $_SESSION['customer_address'] = $row8['customer_address'];
   $_SESSION['customer_role'] = $row8['customer_role'];
?>
<?php
require_once './includes/topheadactions.php';
require_once './includes/desktopnav.php';
require_once './includes/mobilenav.php';
?>

<head>
  <title>Profile</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: white;
      padding-bottom: 40px;
    }

    h1 {
      text-align: center;
      margin: 30px 0;
      color: #4d3e29;
      text-transform: uppercase;
      font-weight: bold;
    }

    #role {
      color: #4d3e29;
    }


    .card-container {
      display: flex;
      justify-content: space-between;
      gap: 25px;
      flex-wrap: wrap;
    }

    .card {
      width: 18rem;
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      border: 1px solid #4d3e29;
      box-shadow: 0 4px 10px  #4d3e29;
      margin-bottom: 100px;
    }

    .card-title {
      color: #4d3e29;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      color: #fff;
      background-color: #4d3e29;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      cursor: pointer;
      margin-bottom: 20px;
    }

    .btn:hover {
      background-color: #4d3e29;
    }

    input.form-control {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #4d3e29;
      border-radius: 6px;
      font-size: 14px;
    }

    input.form-control:focus {
      border-color: #4d3e29;
      box-shadow: 0 0 0 0.2rem rgba(231, 84, 128, 0.25);
    }

    .profile_edit, .address_edit, .contact_edit {
      display: none;
    }

    .admin-btn {
      background-color: white;
      color: #4d3e29;
      border: 2px solid #4d3e29;
      margin-top: 30px;
    }

    .admin-btn:hover {
      background-color: #4d3e29;
      color: white;
    }

    @media (max-width: 768px) {
      .card {
        width: 100% !important;
        margin-bottom: 20px;
      }

      .card-container {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>

<h1>
  Hello, <span id="role">
  <?php echo ($_SESSION['customer_role'] == 'admin') ? 'Admin' : $_SESSION['customer_name']; ?>
  </span> welcome!
</h1>

<div class="container">
  <div class="card-container">

    <!-- Profile Card -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">PROFILE</h5>
        <a class="btn mb-3" href="#/profile/edit" id="edit_link1">Edit</a>

        <div class="profile_edit">
          <form action="" method="post">
            <input type="text" name="name" class="form-control mb-2" placeholder="New Name..." />
            <input type="email" name="email" class="form-control mb-2" placeholder="New Email..." />
            <button type="submit" name="save" class="btn">Save</button>
          </form>
        </div>

        <p class="mt-3"><?php echo $_SESSION['customer_name'] . " (" . $_SESSION['customer_role'] . ")" ?></p>
        <p><?php echo $_SESSION['customer_email'] ?></p>

        <?php if ($_SESSION['customer_role'] == 'admin') { ?>
          <a id="admin" href="admin/login.php" class="btn admin-btn mt-2">Visit Admin Panel</a>
        <?php } ?>
      </div>
    </div>

    <!-- Address Card -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">ADDRESS</h5>
        <a href="#/address/edit" id="edit_link2" class="btn mb-3">Edit</a>

        <div class="address_edit">
          <form action="" method="post">
            <input type="text" name="address" class="form-control mb-2" placeholder="New Address..." />
            <button type="submit" name="save" class="btn">Save</button>
          </form>
        </div>

        <p class="mt-3"><?php echo $_SESSION['customer_address'] ?></p>
      </div>
    </div>

    <!-- Contact Card -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">CONTACT</h5>
        <a href="#/contact/edit" id="edit_link3" class="btn mb-3">Edit</a>

        <div class="contact_edit">
          <form action="" method="post">
            <input type="number" name="number" class="form-control mb-2" placeholder="New Number..." />
            <button type="submit" name="save" class="btn">Save</button>
          </form>
        </div>

        <p class="mt-3"><?php echo $_SESSION['customer_phone'] ?></p>
      </div>
    </div>

  </div>
</div>
<?php require_once './includes/footer.php'; ?>
<?php
if (isset($_POST['save'])) {
   include "includes/config.php";

   if (!empty($_POST['name']) && !empty($_POST['email'])) {
      $sql = "UPDATE customer 
              SET customer_fname='{$_POST['name']}', 
                  customer_email='{$_POST['email']}' 
              WHERE customer_id='{$_SESSION['id']}'";
      $conn->query($sql);
   }

   if (!empty($_POST['address'])) {
      $sql = "UPDATE customer 
              SET customer_address='{$_POST['address']}' 
              WHERE customer_id='{$_SESSION['id']}'";
      $conn->query($sql);
   }

   if (!empty($_POST['number'])) {
      $sql = "UPDATE customer 
              SET customer_phone='{$_POST['number']}' 
              WHERE customer_id='{$_SESSION['id']}'";
      $conn->query($sql);
   }

   $conn->close();
   echo "<script>window.location.reload();</script>";
}
?>

<script src="./js/jquery.js"></script>
<script>
  $(document).ready(function () {
    $("#edit_link1").click(function () {
      $(".profile_edit").slideToggle();
    });
    $("#edit_link2").click(function () {
      $(".address_edit").slideToggle();
    });
    $("#edit_link3").click(function () {
      $(".contact_edit").slideToggle();
    });
  });
</script>
