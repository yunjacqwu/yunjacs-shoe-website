<?php
  session_start();

  include('../config.php');
  $queryProductFirst = mysqli_query($con, "SELECT id, name, price, image FROM products LIMIT 8");
  $queryProductSecond = mysqli_query($con, "SELECT id, name, price, image FROM products LIMIT 8 OFFSET 8");

  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>yunjac's | Home</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link rel="stylesheet" href="styleun.css" />
    <link rel="stylesheet" href="dropdowncatun.css" />
    
  </head>

  <body>
    <section id="header" style="padding-top: 12px; padding-bottom: 12px;">
      <a href="indexun.php">
        <img src="../img/yunjac.png" class="logo" alt="" style="padding-left: 20px; width: 160px; height: auto;" />
      </a>
      <div>
        <ul id="navbar">
          <li><a class="active" href="indexun.php">Home</a></li>
          <li><a href="shopun.php">Shop</a></li>
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
          <li><a href="aboutun.php">About</a></li>
          <li><a href="contactun.php">Contact</a></li>
          <button class="normal" onclick="window.location.href='../login.php'">Sign In</button>
          <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
        </ul>
      </div>
      <div id="mobile">
        <a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
        <i id="bar" class="fa-solid fa-bars"></i>
      </div>
      
    </section>

    <section id="hero">
      
      <h4>Trade-in-offer</h4>
      <h2>Super value deals</h2>
      <h1>On all Sneakers</h1>
      <p>Save more with coupons & up to 40% off!</p>
      <button class="submit" onclick="window.location.href='shopun.php';">Shop Now</button>
    </section>

    <section id="home1" class="section-p1">
      <h2>Featured Products</h2>
      <p>Summer Collection</p>
      <div class="pro-container">
        <?php while($data = mysqli_fetch_array($queryProductFirst)) { ?>
        <div class="pro" onclick="window.location.href='prodetun.php?name=<?php echo $data['name'];?>';">
          <img src="../adminpanel/uploads/product/<?php echo $data['image']; ?>" alt="" />
          <div class="des">
            <span>yunjac's</span>
            <h5><?php echo $data['name']; ?></h5>
            <h4>Rp<?php echo $data['price']; ?></h4>
          </div>
        </div>
        <?php } ?>
      </div>
    </section>

    <section id="banner" class="section-m1">
      <h4>Repair Service</h4>
      <h2>Up to <span>40% off</span> - All Sneakers</h2>
      <button class="normal" onclick="window.location.href='shopun.php';">Explore More</button>
    </section>

    <section id="product2" class="section-p1">
      <h2>New Arrivals</h2>
      <p>Summer Collection</p>
      <div class="pro-container">
        <?php while($data = mysqli_fetch_array($queryProductSecond)) { ?>
        <div class="pro" onclick="window.location.href='prodetun.php?name=<?php echo $data['name'];?>';">
          <img src="../adminpanel/uploads/product/<?php echo $data['image']; ?>" alt="" />
          <div class="des">
            <span>yunjac's</span>
            <h5><?php echo $data['name']; ?></h5>
            <h4>Rp<?php echo $data['price']; ?></h4>
          </div>
        </div>
        <?php } ?>
      </div>
    </section>

    <section id="sm-banner" class="section-p1">
      <div class="banner-box">
        <h4>Crazy deals</h4>
        <h2>Buy 1 get 1 free apparel</h2>
        <span>The best Sneakers in on sale at yunjac's</span>
        <button class="white" onclick="window.location.href='shopun.php';">Learn More</button>
      </div>
      <div class="banner-box banner-box2">
        <h4>Spring/Summer</h4>
        <h2>Upcomming Season</h2>
        <span>The best Sneakers in on sale at yunjac's</span>
        <button class="white" onclick="window.location.href='shopun.php';">Collection</button>
      </div>
    </section>

    <section id="banner3">
      <div class="banner-box">
        <h2>SEASONAL SALE</h2>
        <h3>Winter Collection -50% 0FF</h3>
      </div>
      <div class="banner-box banner-box2">
        <h2>NEW FOOTWEAR COLLECTION</h2>
        <h3>Spring / Summer 2023</h3>
      </div>
      <div class="banner-box banner-box3">
        <h2>T-SHIRTS</h2>
        <h3>New Trendy Prints</h3>
      </div>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
      <div class="newstext">
        <h4>Sign Up For Newsletter</h4>
        <p>Get E-mail updates about out latest shop and <span>special offers.</span></p>
      </div>
      <button onclick="window.location.href='../login.php'" class="normal">Sign In here</button>
      <!-- <div class="form">
        <input type="text" placeholder="Your email address" />
      </div> -->
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
  </body>
</html>