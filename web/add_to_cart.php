<?php
session_start();
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = str_replace(['Rp', '.', ','], '', $_POST['price']);
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];
    $image = $_POST['image'];
    $user_id = $_POST['user_id'];

    $subtotal = $price * $quantity;

    // Fetch product ID from the database
    $result = mysqli_query($con, "SELECT id FROM products WHERE name='$name'");
    $product = mysqli_fetch_assoc($result);
    $product_id = $product['id'];

    // Insert into cart table
    $sql = "INSERT INTO cart (user_id, product_id, image, product_name, product_size, quantity, price, subtotal) VALUES ('$user_id', '$product_id', '$image', '$name', '$size', '$quantity', '$price', '$subtotal')";
    mysqli_query($con, $sql);
}
?>
