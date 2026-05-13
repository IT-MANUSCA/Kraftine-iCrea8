<?php
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $pwd = $_POST['pwd'];
    $rpwd = $_POST['rpwd'];

    require_once 'config.php';
    require_once 'signupFn.inc.php';

    if (emptyInputSignup($name, $email, $number, $address, $pwd, $rpwd)) {
        header("location: ../signup.php?error=emptyInput");
        exit();
    }

    if (invalidPhone($number)) {
        header("location: ../signup.php?error=enterValidNumber");
        exit();
    }

    if (invalidEmail($email)) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }

    if (!pwdMatch($pwd, $rpwd)) {
        header("location: ../signup.php?error=pwdnotmatch");
        exit();
    }

    // New: Check if name/email/number already exist
    $duplicateError = checkDuplicateUser($name, $email, $number);
    if ($duplicateError !== false) {
        header("location: ../signup.php?error=" . $duplicateError);
        exit();
    }

    createUser($name, $email, $address, $pwd, $number);

} else {
    header("location: ../signup.php");
    exit("Hey there is some errors!");
}
