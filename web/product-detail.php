<?php
  session_start();

  // Periksa apakah pengguna sudah login
  if(!isset($_SESSION['login'])) {
      header('location: login.php'); // Redirect ke halaman login jika belum login
      exit;
  }

  include('../config.php');
  $name = htmlspecialchars($_GET['name']);
  $queryProduct = mysqli_query($con, "SELECT * FROM products WHERE name='$name'");
  $product = mysqli_fetch_array($queryProduct);

  $queryProductFeatured = mysqli_query($con, "SELECT * FROM products");

  // Menghitung jumlah total produk
  $totalProducts = mysqli_num_rows($queryProductFeatured);

  // Mencari indeks produk yang sedang ditampilkan
  $currentProductIndex = 0;
  for ($i = 0; $i < $totalProducts; $i++) {
      if ($product['id'] == mysqli_fetch_array($queryProductFeatured)['id']) {
          $currentProductIndex = $i;
          break;
      }
  }

  // Mengatur indeks produk yang akan ditampilkan di featured product
  $featuredIndexes = array();
  for ($i = 1; $i <= 4; $i++) {
      $featuredIndex = ($currentProductIndex + $i) % $totalProducts;
      $featuredIndexes[] = $featuredIndex;
  }

  // Mengambil data produk yang akan ditampilkan di featured product
  $featuredProducts = array();
  foreach ($featuredIndexes as $index) {
      mysqli_data_seek($queryProductFeatured, $index);
      $featuredProducts[] = mysqli_fetch_array($queryProductFeatured);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>yunjac's | Detail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link rel="stylesheet" href="ustyle-page.css" />
    <link rel="stylesheet" href="dropdowncat.css" />
    <script src="assets/js/jquery-3.7.1.min.js"></script>
  </head>

  <body>
    <section id="header" style="padding-top: 12px; padding-bottom: 12px;">
      <a href="indexu.php">
        <img src="../img/yunjac.png" class="logo" alt="" style="padding-left: 20px; width: 160px; height: auto;" />
      </a>
      <div>
        <ul id="navbar">
          <li><a href="indexu.php">Home</a></li>
          <li><a class="active" href="shop.php">Shop</a></li>
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
            <a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
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

    <section id="prodetails" class="section-p1 product_data">
      <div class="single-pro-image">
        <img src="../adminpanel/uploads/product/<?php echo $product['image']; ?>" width="100%" id="Mai00nImg" alt="" style="border-radius: 10px;" />
      </div>

      <div class="single-pro-details" style="padding-top: 10px;">
        <h6>Shop / Detail</h6>
        <h4 style="padding-bottom: 0px;padding-top: 30px;"><?php echo $product['name']; ?></h4>
        <h2 style="padding-top: 7px;padding-bottom: 25px;">Rp<?php echo $product['price']; ?></h2>
        <h5>Stock Total: <?php echo $product['quantity']; ?></h5>
        <div class="right">
          <div class="size">
            <p>Size :</p>
            <?php for($i = 40; $i <= 44; $i++): ?>
                <div class="psize" onclick="selectSize(this)"><?php echo $i; ?></div>
            <?php endfor; ?>
          </div>
          <div class="quantity">
            <p>Quantity</p>
            <button class="min" id="decrease-btn" onclick="decreaseQuantity()">-</button>
            <label for="quantity-input">
              <input type="number" id="quantity-input" value="1" min="1" max="<?php echo $product['quantity']; ?>" readonly />
            </label>
            <button class="plus" id="increase-btn" onclick="increaseQuantity()">+</button>
          </div>
        </div>
 
        <button class="submit" id="add-to-cart-btn" onclick="addToCart()">Add To Cart</button>

        <h4>Product Details</h4>
        <div class="description-scroll-box">
          <span><?php echo trim(htmlspecialchars($product['long_description'])); ?></span>
          <span><?php echo trim(htmlspecialchars($product['small_description'])); ?></span>
        </div>
      </div>
    </section>


    <section id="product1" class="section-p1">
      <h2>Featured Products</h2>
      <p>Summer Collection New Morden Design</p>
      <div class="pro-container">
        <?php foreach ($featuredProducts as $data){ ?>
        <div class="pro" onclick="window.location.href='product-detail.php?name=<?php echo $data['name'];?>';">
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

    <!-- <section id="newsletter" class="section-p1 section-m1">
      <div class="newstext">
        <h4>Sign Up For Newsletter</h4>
        <p>Get E-mail updates about out latest shop and <span>special offers.</span></p>
      </div>
      <button href="../register.php" class="normal">Sign Up here</button>
      <div class="form">
        <input type="text" placeholder="Your email address" />
      </div>
    </section> -->

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

    <script>
      var MainImg = document.getElementById("MainImg");
      var smallimg = document.getElementsByClassName("small-img");

      smallimg[0].onclick = function () {
        MainImg.src = smallimg[0].src;
      };
      smallimg[1].onclick = function () {
        MainImg.src = smallimg[1].src;
      };
      smallimg[2].onclick = function () {
        MainImg.src = smallimg[2].src;
      };
      smallimg[3].onclick = function () {
        MainImg.src = smallimg[3].src;
      };
    </script>

    <script src="script.js"></script>
    <script>
    var logoutDropdown = document.getElementById("logout-dropdown");
    logoutDropdown.addEventListener("click", function() {
      var dropdownMenu = this.querySelector(".dropdown-menu");
      dropdownMenu.style.display = dropdownMenu.style.display === "none" ? "block" : "none";
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
    function increaseQuantity() {
      var input = document.getElementById("quantity-input");
      var value = parseInt(input.value);
      var max = parseInt(input.max);
      if (value < max) {
        input.value = value + 1;
      }
    }

    function decreaseQuantity() {
      var input = document.getElementById("quantity-input");
      var value = parseInt(input.value);
      var min = parseInt(input.min);
      if (value > min) {
        input.value = value - 1;
      }
    }
  </script>
  <script>
  let selectedSize = null;
  function selectSize(element) {
    if (element.classList.contains("active")) {
      element.classList.remove("active");
      selectedSize = null;
    } else {
      if (selectedSize) {
        selectedSize.classList.remove("active");
      }

      element.classList.add("active");
      selectedSize = element;
    }
  }
  </script>
  <script>
  function addToCart() {
        var name = "<?php echo $product['name']; ?>";
        var price = "<?php echo $product['price']; ?>";
        var quantity = document.getElementById("quantity-input").value;
        var size = selectedSize ? selectedSize.innerText : null;
        var image = "<?php echo $product['image']; ?>";
        var userId = <?php echo $_SESSION['user_id']; ?>;

        if (size) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_to_cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    window.location.href = "cart.php";
                }
            };
            xhr.send("name=" + name + "&price=" + price + "&quantity=" + quantity + "&size=" + size + "&image=" + image + "&user_id=" + userId);
        } else {
            alert("Please select a size.");
        }
    }
  </script>

    
    

  </body>
</html>
