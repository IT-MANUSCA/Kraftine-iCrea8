<?php include_once('./includes/headerNav.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <title>Sign Up</title>
  <style>
    body {
      background: #f5f5f5;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .registeration-box {
      background: #fff;
      padding: 30px;
      margin-top: 50px;
      margin-bottom: 50px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 1000px;
    }

    .logo-box img {
      max-width: 180px;
      margin-bottom: 10px;
    }

    .signup-title {
      text-align: center;
      font-size: 28px;
      font-weight: bold;
      color: #36454F;
      margin-bottom: 20px;
    }

    .form-label {
      font-weight: 500;
    }

    .btn-primary {
      width: 100%;
      padding: 10px;
      font-size: 18px;
      border-radius: 8px;
      background-color: #E75480;
      margin-top: 30px;
    }

    .password-strength,
    #password-match {
      font-size: 14px;
      margin-top: 5px;
    }

    .strength-weak {
      color: red;
    }

    .strength-medium {
      color: orange;
    }

    .strength-strong {
      color: green;
    }

    .alert {
      width: 100%;
      max-width: 800px;
      margin: 20px auto;
    }
  </style>
</head>
<body>

  <div class="container d-flex justify-content-center align-items-center flex-column">
    <div class="registeration-box">
      <div class="logo-box text-center">
        <a href="index.php">
          <img src="admin/upload/<?php echo $_SESSION['web-img']; ?>" alt="logo">
        </a>
      </div>

      <h1 class="signup-title">SIGN UP</h1>
      <hr class="mb-4">

      <form action="includes/signup.inc.php" method="post" class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control" name="name" required placeholder="Your full name">
        </div>

        <div class="col-md-6">
          <label class="form-label">Phone Number</label>
          <input type="text" class="form-control" name="number" id="mobile" required placeholder="+0945 *** ****" maxlength="11" minlength="11">
        </div>

        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="email" required placeholder="you@example.com">
        </div>

        <div class="col-md-6">
          <label class="form-label">Address</label>
          <input type="text" class="form-control" name="address" required placeholder="Antipolo 12345">
        </div>

        <div class="col-md-6">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="pwd" id="password" required placeholder="Password" onkeyup="checkPasswordStrength()">
          <div id="password-strength" class="password-strength"></div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Confirm Password</label>
          <input type="password" class="form-control" name="rpwd" id="confirm-password" required placeholder="Repeat Password" onkeyup="checkPasswordMatch()">
          <div id="password-match"></div>
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-primary" name="submit" id="submit-btn">Register</button>
        </div>
      </form>
    </div>

    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger text-center">
        <?php
          switch ($_GET['error']) {
            case "emptyInput": echo "Please fill in all fields."; break;
            case "enterValidNumber": echo "Please enter a valid phone number."; break;
            case "invalidemail": echo "Invalid email format."; break;
            case "pwdnotmatch": echo "Passwords do not match."; break;
            case "nametaken": echo "Name already taken."; break;
            case "emailtaken": echo "Email already taken."; break;
            case "numbertaken": echo "Contact number already taken."; break;
            default: echo "An unknown error occurred."; break;
          }
        ?>
      </div>
    <?php endif; ?>
  </div>

  <script>
    document.getElementById('mobile').addEventListener('input', function (e) {
      const mobile = e.target.value;
      if (!/^\d{11}$/.test(mobile)) {
        e.target.setCustomValidity('Mobile number must be exactly 11 digits.');
      } else {
        e.target.setCustomValidity('');
      }
    });

    document.getElementById('email').addEventListener('input', function (e) {
      const email = e.target.value;
      if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
        e.target.setCustomValidity('Please enter a valid email address.');
      } else {
        e.target.setCustomValidity('');
      }
    });

    function checkPasswordStrength() {
      const password = document.getElementById('password').value;
      const strengthIndicator = document.getElementById('password-strength');
      const regexUppercase = /[A-Z]/;
      const regexLowercase = /[a-z]/;
      const regexDigit = /\d/;
      const regexSpecial = /[!@#$%^&*(),.?":{}|<>]/;
      let strength = 'Weak';

      if (regexUppercase.test(password) && regexLowercase.test(password) && regexDigit.test(password) && regexSpecial.test(password) && password.length >= 8) {
        strength = 'Strong';
      } else if ((regexUppercase.test(password) || regexLowercase.test(password)) && regexDigit.test(password)) {
        strength = 'Medium';
      }

      strengthIndicator.textContent = `Password Strength: ${strength}`;
      strengthIndicator.className = `password-strength strength-${strength.toLowerCase()}`;
    }

    function checkPasswordMatch() {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm-password').value;
      const matchIndicator = document.getElementById('password-match');

      if (password !== confirmPassword) {
        matchIndicator.textContent = 'Passwords do not match.';
        matchIndicator.style.color = 'red';
      } else {
        matchIndicator.textContent = 'Passwords match.';
        matchIndicator.style.color = 'green';
      }
    }
  </script>

  <script src="./js/jquery.js"></script>
  <script src="./js/bootstrap.min.js"></script>
</body>
</html>
