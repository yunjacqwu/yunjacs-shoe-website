<?php
  session_start();

  // Periksa apakah pengguna sudah login
  if(!isset($_SESSION['login'])) {
      header('location: login.php'); // Redirect ke halaman login jika belum login
      exit;
  }

  include('../config.php');
  $user_id = $_SESSION['user_id'];
  $queryCart = mysqli_query($con, "SELECT * FROM cart WHERE user_id='$user_id'");

  $total = 0;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>yunjac's | Checkout</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link rel="stylesheet" href="ustyle-page.css" />
    <link rel="stylesheet" href="dropdowncat.css" />

    <style>
        .error {
            color: red;
            font-size: 12px;
        }
        .cart-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .cart-items {
            width: 60%;
        }

        .cart-totals {
            width: 35%;
            margin-left: 100px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
        }

        .cart-totals table {
            width: 100%;
        }
        
        .summary {
            padding-bottom: 20px;
        }

        .cekform {
            padding-left: 80px;
            padding-top: 30px;
        }

        #checkout-form {
            display: flex;
            justify-content: space-between;
            margin: 30px;
            padding: 0 80px 80px 80px;
        }

        #checkout-form form {
            width: 65%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        #checkout-form form input {
            width: 100%;
            padding: 12px 15px;
            outline: none;
            margin-bottom: 20px;
            border: 1px solid #e1e1e1;
        }

        #checkout-form form button:hover {
            background: #606063;
            color: #fff;
        }

        .checkoutBtn {
            background-color: #ccc; /* Warna abu saat tombol disable */
            color: #fff; /* Warna teks putih saat tombol disable */
            font-size: 14px;
            font-weight: 600;
            padding: 15px 30px;
            border-radius: 4px;
            cursor: pointer;
            border: none;
            outline: none;
            transition: 0.2s;
        }

        .checkoutBtn:enabled {
            background-color: #097642; /* Warna hijau saat tombol aktif */
            cursor: pointer;
        }

        .checkoutBtn:disabled {
            background-color: #ccc; /* Warna abu saat tombol disable */
            color: #fff; /* Warna teks putih saat tombol disable */
            cursor: not-allowed;
        }
    </style>
    
  </head>

  <body>
    <section id="header" style="padding-top: 12px; padding-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
        <div style="display: flex; align-items: center;">
            <a href="cart.php" style="text-decoration: none; color: black; font-size: 18px;">
            <i class="fa-solid fa-arrow-left"></i><strong> Back to Cart</strong> 
            </a>
        </div>
        <a href="indexu.php">
            <img src="../img/yunjac.png" class="logo" alt="" style="padding-left: 20px; width: 160px; height: auto;" />
        </a>
    </section>

    <section id="cart" class="section-p1">
        <h2 class="summary">Cart Summary</h2>
        <table width="100%" style="table-layout: fixed;">
            <colgroup>
                <col style="width: 15%;">
                <col style="width: 30%;">
                <col style="width: 15%;">
                <col style="width: 15%;">
                <col style="width: 25%;">
            </colgroup>
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cartItem = mysqli_fetch_assoc($queryCart)) {
                    $total += $cartItem['subtotal'];
                    echo '<tr>';
                    echo '<td><img src="../adminpanel/uploads/product/' . htmlspecialchars($cartItem['image']) . '" alt="" /></td>';
                    echo '<td>' . htmlspecialchars($cartItem['product_name']) . ' (' . htmlspecialchars($cartItem['product_size']) . ')</td>';
                    echo '<td>Rp' . number_format($cartItem['price'], 0, ',', '.') . '</td>';
                    echo '<td>' . htmlspecialchars($cartItem['quantity']) . '</td>';
                    echo '<td>Rp' . number_format($cartItem['subtotal'], 0, ',', '.') . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </section>

    <div id="subtotal" class="cart-totals">
        <h3>Cart Totals</h3>
        <table>
            <tr>
                <td>Cart Subtotal</td>
                <td>Rp<?php echo number_format($total, 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td>Free</td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong>Rp<?php echo number_format($total, 0, ',', '.'); ?></strong></td>
            </tr>
        </table>
    </div>

    <h2 class="cekform">Checkout Form</h2>
    <section id="checkout-form">
        <form id="checkoutForm" action="process_checkout.php" method="POST">
            <input type="text" id="name" name="name" placeholder="Your Name" required><br>
            <input type="text" id="address" name="address" placeholder="Address" required><br>
            <input type="text" id="phone" name="phone" placeholder="Phone" required>
            <span id="phoneError" class="error"></span><br>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <span id="emailError" class="error"></span><br>

            <button class="checkoutBtn" type="submit" id="checkoutButton" disabled>Checkout</button>
        </form>
    </section>

    <footer class="section-p1" style="margin-top: 110px;">
      <div class="col">
        <img class="logo" src="../img/yunjac3.png" alt="" style="/* padding-left: 35px;  */width: 180px; height: auto;" />
      </div>

      <div class="col">
        <h4>Contact</h4>
        <p><strong>Address: </strong> 562 Wellington Road, Street 32, San Francisco</p>
        <p><strong>Phone: </strong> +01 2222 365 /(+91) 01 2345 6789</p>
        <p><strong>Hours: </strong> 10:00 - 20.00, Mon - Sat</p>
        <div class="follow">
          <h4>Follow Us</h4>
          <div class="icon">
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-tiktok"></i>
            <i class="fa-brands fa-discord"></i>
          </div>
        </div>
      </div>

      <div class="col">
        <h4>About</h4>
        <a href="#">About Us</a>
        <a href="#">Delivery Information</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms & Conditions</a>
        <a href="#">Contact Us</a>
      </div>

      <div class="col install">
        <h4>Coming Soon In Mobile</h4>
        <p>From App Store or Google Play</p>
        <div class="row">
          <img src="../img/pay/app.jpg" alt="" />
          <img src="../img/pay/play.jpg" alt="" />
        </div>
        <p>Secured Payment Gateways</p>
        <img src="../img/pay/pay.png" alt="" />
      </div>

      <div class="copyright">
        <p style="margin-top: 13px;">®️ 2023, Tech etc - yunjac's Ecommerce</p>
      </div>
    </footer>


    <script src="script.js"></script>
    <script>
    var logoutDropdown = document.getElementById("logout-dropdown");
    logoutDropdown.addEventListener("click", function() {
      var dropdownMenu = this.querySelector(".dropdown-menu");
      dropdownMenu.style.display = dropdownMenu.style.display === "none" ? "block" : "none";
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
      var categoryBtn = document.getElementById('categoryBtn');
      var categoryDropdown = document.getElementById('categoryDropdown');

      // Menambahkan event listener untuk mengubah tampilan dropdown saat tombol "Category" diklik
      categoryBtn.addEventListener('click', function() {
        if (categoryDropdown.style.display === 'none') {
          categoryDropdown.style.display = 'block';
        } else {
          categoryDropdown.style.display = 'none';
        }
      });
    });
    </script>
    <script>
      // Menutup dropdown saat kursor bergerak keluar dari area dropdown
      document.querySelector('.dropdown-content').addEventListener('mouseleave', function() {
        this.style.display = 'none';
      });

      // Membuka dropdown saat kursor bergerak ke dalam area dropdown
      document.querySelector('.dropdown').addEventListener('mouseenter', function() {
        document.querySelector('.dropdown-content').style.display = 'block';
      });
    </script>
    <script>
      var dropdown = document.querySelector('.dropdown');
      var dropdownContent = document.querySelector('.dropdown-content');

      dropdown.addEventListener('mouseenter', function() {
        dropdownContent.style.display = 'block';
      });

      dropdown.addEventListener('mouseleave', function() {
        // Cek apakah kursor berada di dalam dropdown atau dropdown content
        if (!isCursorInside(dropdown) && !isCursorInside(dropdownContent)) {
          dropdownContent.style.display = 'none';
        }
      });

      function isCursorInside(element) {
        var rect = element.getBoundingClientRect();
        return (
          rect.top <= event.clientY &&
          event.clientY <= rect.bottom &&
          rect.left <= event.clientX &&
          event.clientX <= rect.right
        );
      }
    </script>
    <script>
    document.getElementById('checkoutForm').addEventListener('input', function() {
        var phone = document.getElementById('phone').value;
        var email = document.getElementById('email').value;
        var phoneError = document.getElementById('phoneError');
        var emailError = document.getElementById('emailError');
        var checkoutButton = document.getElementById('checkoutButton');
        
        // Validate phone number
        if (!/^\d{12,13}$/.test(phone)) {
            phoneError.textContent = 'Phone number must be between 12 to 13 digits.';
        } else {
            phoneError.textContent = '';
        }

        // Validate email
        if (!/^[^\s@]+@gmail\.com$/.test(email)) {
            emailError.textContent = 'Email must be in the format example@gmail.com.';
        } else {
            emailError.textContent = '';
        }

        // Enable checkout button if both validations pass
        if (phoneError.textContent === '' && emailError.textContent === '') {
            checkoutButton.disabled = false;
        } else {
            checkoutButton.disabled = true;
        }
    });
    </script>

  </body>
</html>