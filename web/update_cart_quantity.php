<?php
session_start();
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    // Fetch product price from the cart
    $result = mysqli_query($con, "SELECT price FROM cart WHERE id='$cart_id'");
    $cartItem = mysqli_fetch_assoc($result);
    $price = $cartItem['price'];
    $subtotal = $price * $quantity;

    // Update cart quantity and subtotal
    $sql = "UPDATE cart SET quantity='$quantity', subtotal='$subtotal' WHERE id='$cart_id'";
    mysqli_query($con, $sql);
}
?>
