<?php
    include_once('./includes/config.php');
    include_once('./includes/restriction.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $role = $_POST['role'];
        $password = $_POST['password']; // Encrypt the password
        
        
        // Insert into DB
        $query = "INSERT INTO customer (customer_fname, customer_email, customer_phone, customer_address, customer_role, customer_pwd) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $fname, $email, $phone, $address, $role, $password);
        
        if ($stmt->execute()) {
            header("Location: admin-accounts.php?user_added=true");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
    }
?>
