<?php
  session_start();

  // Periksa apakah pengguna sudah login
  if(!isset($_SESSION['login'])) {
      header('location: login.php'); // Redirect ke halaman login jika belum login
      exit;
  }

  if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set in the session";
    exit;
  }
  include('../config.php');
  $user_id = $_SESSION['user_id'];

  // Fetch cart items for the logged-in user
  $queryCart = mysqli_query($con, "SELECT * FROM cart WHERE user_id='$user_id'");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>yunjac's | Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link rel="stylesheet" href="ustyle-page.css" />
    <link rel="stylesheet" href="dropdowncat.css" />
  </head>

  <body>
    <section id="header"style="padding-top: 12px; padding-bottom: 12px;">
      <a href="indexu.php">
        <img src="../img/yunjac.png" class="logo" alt="" style="padding-left: 20px; width: 160px; height: auto;" />
      </a>
      <div>
        <ul id="navbar">
          <li><a href="indexu.php">Home</a></li>
          <li><a href="shop.php">Shop</a></li>
          <li class="dropdown">
            <a href="#" class="dropbtn" id="categoryBtn">Category</a>
            <div class="dropdown-content" id="categoryDropdown">
              <!-- Tempat untuk menampilkan daftar kategori -->
              <?php 
              include_once "../config.php";

              $query = "SELECT name FROM categories";
              $result = mysqli_query($con,$query);

              if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<a href="#">' . $row["name"] . '</a>';
                }
              } else {
                echo "No Categories Found!";
              }
              ?>
            </div>
          </li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li id="lg-bag">
            <a class="active" href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
          </li>
          <li id="logout-dropdown">
            <a href="#"><i class="bi bi-person-circle"></i></a>
            <ul class="dropdown-menu">
              <li><a href="../logout.php" >Log Out</a></li>
            </ul>
          </li>
          <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
        </ul>
      </div>
      <div id="mobile">
        <a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
        <i id="bar" class="fa-solid fa-bars"></i>
      </div>
    </section>

    <section id="page-header" class="about-header">
      <h2>#Cart</h2>

      <p>Effortless Checkout. Shop with Confidence!</p>
    </section>
    <!-- Keranjang/Cart -->
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody id="cart-items">
                <?php
                $total = 0;
                if (mysqli_num_rows($queryCart) > 0) {
                    while ($cartItem = mysqli_fetch_assoc($queryCart)) {
                        $total += $cartItem['subtotal'];
                        echo '<tr>';
                        echo '<td><a href="#" onclick="removeProduct(' . $cartItem['id'] . ')"><i class="fa-solid fa-circle-xmark"></i></a></td>';
                        echo '<td><img src="../adminpanel/uploads/product/' . htmlspecialchars($cartItem['image']) . '" alt="" /></td>';
                        echo '<td>' . htmlspecialchars($cartItem['product_name']) . ' (' . htmlspecialchars($cartItem['product_size']) . ')</td>';
                        echo '<td>Rp' . number_format($cartItem['price'], 0, ',', '.') . '</td>';
                        echo '<td><input type="number" value="' . htmlspecialchars($cartItem['quantity']) . '" min="1" onchange="updateQuantity(' . $cartItem['id'] . ', this.value)" /></td>';
                        echo '<td>Rp' . number_format($cartItem['subtotal'], 0, ',', '.') . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6" style="text-align: center; font-weight: bold;">Anda belum memasukkan produk ke dalam keranjang.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </section>


    <!-- Appy Coupon/Kode Discount -->
    <section id="cart-add" class="section-p1">
      <div id="coupon">
        <h3>Apply Coupon</h3>
        <div>
          <input type="text" placeholder="Enter Your Coupon" />
          <button class="submit">Apply</button>
        </div>
      </div>
      <!-- Jumlah Keseluruhan dari Keranjang/Cart yang ada di atas -->
      <div id="subtotal">
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
          <button class="submit" onclick="proceedToCheckout()">Proceed to checkout</button>
      </div>
    </section>

    <footer class="section-p1">
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
    function removeProduct(cartId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "remove_from_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                location.reload();
            }
        };
        xhr.send("cart_id=" + cartId);
    }

    function updateQuantity(cartId, quantity) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_cart_quantity.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                location.reload();
            }
        };
        xhr.send("cart_id=" + cartId + "&quantity=" + quantity);
    }
    </script>
    <script>
      function proceedToCheckout() {
        window.location.href = "checkout.php";
    }
    </script>
  </body>
</html>
