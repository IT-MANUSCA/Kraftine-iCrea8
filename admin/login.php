<?php
  include_once('./includes/restriction.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>Admin | Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
      * {
        box-sizing: border-box;
      }
      body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f4f4f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
      .login-form {
        background-color: #fff;
        padding: 30px 35px;
        border-radius: 12px;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px;
      }
      .logo-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
      }
      .logo-box img {
        width: 150px;
        margin-bottom: 10px;
      }
      .login-form h4 {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 600;
      }
      .btn-primary {
        width: 100%;
        padding: 10px;
        background-color: #E75480;
        margin-top: 30px;
      }
      .alert {
        margin-top: 15px;
      }
    </style>
  </head>
  <body>

    <form class="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <div class="logo-box">
        <img src="./upload/<?php echo $_SESSION['web-img']; ?>" alt="Logo" />
      </div>
      <h4>ADMIN LOGIN</h4>

      <div class="mb-3">
        <input type="email" name="userEmail" class="form-control" placeholder="Email" required />
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required />
      </div>

      <button type="submit" name="login" class="btn btn-primary">Sign in</button>

      <?php 
        if (isset($_POST['login'])) {
          include "includes/config.php";
          
          $email = mysqli_real_escape_string($conn, $_POST['userEmail']);
          $password = $_POST['password'];

          if (empty($email) || empty($password)) {
              echo '<div class="alert alert-danger text-center">All fields must be filled in.</div>';
          } else {
              $sql = "SELECT customer_email, customer_pwd FROM customer WHERE customer_email = '{$email}' AND customer_pwd = '{$password}'";
              $result = mysqli_query($conn, $sql) or die("Query Failed.");

              if (mysqli_num_rows($result) > 0) {
                  $_SESSION['logged-in'] = '1';
                  header("Location: ./post.php");
                  exit();
              } else {
                  echo '<div class="alert alert-danger text-center">Email or Password is incorrect.</div>';
              }
          }
        }
      ?>
    </form>

  </body>
</html>
