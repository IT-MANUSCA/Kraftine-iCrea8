<?php  
session_start();
include_once 'includes/config.php';
require_once 'functions/functions.php';

$login_error = "";

// Login logic at the top
if(isset($_POST['login'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['pwd']);

  $sql = "SELECT * FROM customer WHERE customer_email='{$email}';";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    if ($row['status'] == 0) {
      $login_error = "Your account has been archived. Please contact admin.";
    } elseif ($password == $row['customer_pwd']) {
      $_SESSION['id'] = $row['customer_id'];
      $_SESSION['customer_role'] = $row['customer_role'];
      header("Location: profile.php?id={$_SESSION['id']}");
      exit;
    } else {
      $login_error = "Incorrect password.";
    }
  } else {
    $login_error = "Account not found. Please sign up.";
  }
}

// Get site settings
$sql5 = "SELECT * FROM settings;";
$result5 = $conn->query($sql5);
$row5 = $result5->fetch_assoc();
$_SESSION['web-name'] = $row5['website_name'];
$_SESSION['web-img'] = $row5['website_logo'];
$_SESSION['web-footer'] = $row5['website_footer'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login (User)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      height: 100vh;
      justify-content: center;
      align-items: center;
      background: #f9f9f9;
      font-family: 'Segoe UI', sans-serif;
    }

    form {
      background: #fff;
      border: 1px solid #ddd;
      width: 400px;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .logo-box {
      padding: 10px;
      display: flex;
      justify-content: center;
      flex-direction: column;
      align-items: center;
    }

    .logo-box img {
      width: 180px;
      transition: transform 0.3s ease;
    }

    .logo-box img:hover {
      transform: scale(1.05);
    }

    .btn-pink {
      background-color: #E75480;
      border: none;
      color: white;
    }

    .btn-pink:hover {
      background-color: #ff85c1;
    }

    
.password-toggle {
      position: relative;
    }

    .password-toggle .toggle-password {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6c757d;
    }

    #error_login {
      color: red;
      margin-top: 15px;
      text-align: center;
    }
  </style>
</head>
<body>

<?php if(!isset($_SESSION['id'])) { ?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
  <div class="logo-box">
    <a href="index.php">
      <img src="admin/upload/<?php echo $_SESSION['web-img']; ?>" alt="logo" />
    </a>
  </div>

  <div class="mb-3">
    <input type="email" name="email" class="form-control" placeholder="Email" required />
  </div>

  <div class="mb-3 password-toggle">
  <input type="password" class="form-control" id="password" name="pwd" placeholder="Password" required>
  <span class="toggle-password" id="eye-icon" onclick="togglePassword()">
    <!-- Closed Eye SVG -->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M1 1l22 22M12 4C7.72 4 4.03 6.24 2.2 8.8c-.1.15-.2.31-.3.46-.12.16-.2.33-.3.5-.04.07-.08.14-.12.21.03-.08.06-.15.1-.23C2.91 7.63 7.02 5 12 5c4.98 0 9.09 2.63 10.21 4.74.04.08.07.16.1.24-.04-.07-.08-.14-.12-.21-.1-.17-.18-.34-.3-.5-.1-.15-.2-.31-.3-.46C19.97 6.24 16.28 4 12 4zm0 10c-2.5 0-4.5-1.5-6-3.5C7.5 12.5 9.5 14 12 14c2.5 0 4.5-1.5 6-3.5C16.5 9.5 14.5 8 12 8c-2.5 0-4.5 1.5-6 3.5C9.5 9.5 11.5 7 12 7s4.5 3.5 6 3.5z"/>
    </svg>
  </span>
</div>

<script>
  function togglePassword() {
    var passwordField = document.getElementById('password');
    var eyeIcon = document.getElementById('eye-icon');
    
    var closedEye = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                       <path d="M1 1l22 22M12 4C7.72 4 4.03 6.24 2.2 8.8c-.1.15-.2.31-.3.46-.12.16-.2.33-.3.5-.04.07-.08.14-.12.21.03-.08.06-.15.1-.23C2.91 7.63 7.02 5 12 5c4.98 0 9.09 2.63 10.21 4.74.04.08.07.16.1.24-.04-.07-.08-.14-.12-.21-.1-.17-.18-.34-.3-.5-.1-.15-.2-.31-.3-.46C19.97 6.24 16.28 4 12 4zm0 10c-2.5 0-4.5-1.5-6-3.5C7.5 12.5 9.5 14 12 14c2.5 0 4.5-1.5 6-3.5C16.5 9.5 14.5 8 12 8c-2.5 0-4.5 1.5-6 3.5C9.5 9.5 11.5 7 12 7s4.5 3.5 6 3.5z"/>
                     </svg>`;

    var openEye = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 1l22 22M12 4c-4.98 0-9.09 2.63-10.21 4.74-.04.08-.07.16-.1.24.04-.07.08-.14.12-.21.1-.17.18-.34.3-.5.1-.15.2-.31.3-.46C4.03 6.24 7.72 4 12 4c4.98 0 9.09 2.63 10.21 4.74.04.08.07.16.1.24-.04-.07-.08-.14-.12-.21-.1-.17-.18-.34-.3-.5-.1-.15-.2-.31-.3-.46C19.97 6.24 16.28 4 12 4zm0 10c2.5 0 4.5 1.5 6 3.5C16.5 12.5 14.5 14 12 14c-2.5 0-4.5 1.5-6 3.5C7.5 14.5 9.5 13 12 13c2.5 0 4.5-1.5 6-3.5z"/>
                    </svg>`;

    if (passwordField.type === 'password') {
      passwordField.type = 'text';
      eyeIcon.innerHTML = openEye; // Open eye
    } else {
      passwordField.type = 'password';
      eyeIcon.innerHTML = closedEye; // Closed eye
    }
  }
</script>



  <div class="mb-3 form-check">
    <input class="form-check-input" type="checkbox" id="gridCheck1" />
    <label class="form-check-label" for="gridCheck1">
      Remember Me
    </label>
  </div>

  <div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-pink" name="login">LOGIN</button>
  </div>

  <!-- Show errors below -->
  <?php if(!empty($login_error)) { echo "<div id='error_login'>{$login_error}</div>"; } ?>
</form>

<!-- Sign Up Button -->
<div style="margin-top: 15px;">
  <a href="./signup.php" class="btn btn-secondary">Create an Account</a>
</div>
<?php } ?>




</body>
</html>
