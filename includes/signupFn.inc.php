<?php

function emptyInputSignup($name, $email, $number, $address, $pwd, $rpwd) {
    return empty($name) || empty($email) || empty($number) || empty($address) || empty($pwd) || empty($rpwd);
}

function invalidPhone($number) {
    return strlen($number) < 11;
}

function invalidEmail($email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function pwdMatch($pwd, $rpwd) {
    return $pwd === $rpwd;
}

function checkDuplicateUser($name, $email, $number) {
    $conn = new mysqli("localhost", "root", "", "db_ecommerce");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT customer_fname, customer_email, customer_phone FROM customer WHERE customer_fname = ? OR customer_email = ? OR customer_phone = ?");
    $stmt->bind_param("sss", $name, $email, $number);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_name, $db_email, $db_phone);
        while ($stmt->fetch()) {
            if ($db_name === $name) return "nametaken";
            if ($db_email === $email) return "emailtaken";
            if ($db_phone === $number) return "numbertaken";
        }
    }

    $stmt->close();
    $conn->close();
    return false;
}

function createUser($name, $email, $address, $pwd, $number) {
    $conn = new mysqli("localhost", "root", "", "db_ecommerce");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = $conn->prepare("INSERT INTO customer (customer_fname, customer_email, customer_pwd, customer_phone, customer_address) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param('sssss', $name, $email, $pwd, $number, $address);
    $sql->execute();

    header("location: ../index.php?userSuccessfullycreated!loginNow");

    $sql->close();
    $conn->close();
}
