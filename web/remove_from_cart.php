<?php
session_start();
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_id = $_POST['cart_id'];

    // Delete from cart table
    $sql = "DELETE FROM cart WHERE id='$cart_id'";
    mysqli_query($con, $sql);
}
?>
