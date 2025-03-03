<?php
session_start();
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $user_id = $_SESSION['user_id'];

    // Validate phone and email
    if (!preg_match('/^\d{12,13}$/', $phone)) {
        die('Phone number must be exactly 13 digits.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email format.');
    }

    // Process the checkout (e.g., save order to the database, clear cart, etc.)
    $queryCart = mysqli_query($con, "SELECT * FROM cart WHERE user_id='$user_id'");
    while ($cartItem = mysqli_fetch_assoc($queryCart)) {
        $product_id = $cartItem['product_id'];
        $quantity = $cartItem['quantity'];
        $subtotal = $cartItem['subtotal'];

        // Insert order details into the orders table (example table)
        $sql = "INSERT INTO orders (user_id, product_id, quantity, subtotal, name, address, phone, email) VALUES ('$user_id', '$product_id', '$quantity', '$subtotal', '$name', '$address', '$phone', '$email')";
        mysqli_query($con, $sql);
    }

    // Clear the cart
    $sql = "DELETE FROM cart WHERE user_id='$user_id'";
    mysqli_query($con, $sql);

    // Redirect to a success page or show a success message
    echo "Checkout completed successfully!";
}
?>
