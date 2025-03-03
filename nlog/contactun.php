<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>yunjac's | Contact</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link rel="stylesheet" href="styleun.css" />
    <link rel="stylesheet" href="dropdowncatun.css" />
  </head>

  <body>
    <section id="header"style="padding-top: 12px; padding-bottom: 12px;">
      <a href="indexun.php">
        <img src="../img/yunjac.png" class="logo" alt="" style="padding-left: 20px; width: 160px; height: auto;" />
      </a>
      <div>
        <ul id="navbar">
          <li><a href="indexun.php">Home</a></li>
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
          <li><a class="active" href="contactun.php">Contact</a></li>
          <button class="normal" onclick="window.location.href='../login.php'">Sign In</button>
          <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
        </ul>
      </div>
      <div id="mobile">
        <a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
        <i id="bar" class="fa-solid fa-bars"></i>
      </div>
    </section>

    <section id="page-header" class="about-header">
      <h2>#let's_talk</h2>

      <p>LEAVE A MESSAGE, We love to hear from you!</p>
    </section>

    <section id="contact-details" class="section-p1">
      <div class="details">
        <span>GET IN TOUCH</span>
        <h2>Visit one of our agency locations or contact us today</h2>
        <h3>Head Office</h3>
        <div>
          <li>
            <i class="fa-solid fa-map-location-dot"></i>
            <p>Jl. H. Alim No.59, RT.002/RW.002, Larangan Sel., Kec. Larangan, Kota Tangerang, Banten 15154</p>
          </li>
          <li>
            <i class="fa-solid fa-envelope"></i>
            <p>contact@example.com</p>
          </li>
          <li>
            <i class="fa-solid fa-phone"></i>
            <p>contact@example.com</p>
          </li>
          <li>
            <i class="fa-solid fa-clock"></i>
            <p>Monday to Saturday: 9.00am to 16.00pm</p>
          </li>
        </div>
      </div>
      <div class="map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.5370156977594!2d106.72980850118005!3d-6.244210081199828!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1e5451f4c11%3A0x6e6cf29270b0cc18!2srumah%20pepri!5e0!3m2!1sid!2sid!4v1719071465847!5m2!1sid!2sid"
          width="600"
          height="450"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
      </div>
    </section>

    <section id="form-details">
      <form action="">
        <span>LEAVE A MESSAGE</span>
        <h2>We love to hear from you</h2>
        <input type="text" placeholder="Your Name" />
        <input type="text" placeholder="E-mail" />
        <input type="text" placeholder="Subject" />
        <textarea name="" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
        <button class="submit">Submit</button>
      </form>

      <div class="people">
        <div>
          <img src="../img/people/1.png" alt="" />
          <p>
            <span>M.Andika A</span> Senior Marketing Manager <br />
            Phone: +62877 0000 0000 <br />E-mail: contact@example.com
          </p>
        </div>
        <div>
          <img src="../img/people/2.png" alt="" />
          <p>
            <span>M.Febriansyah</span> Senior Marketing Manager <br />
            Phone: +62877 0000 0000 <br />E-mail: contact@example.com
          </p>
        </div>
        <div>
          <img src="../img/people/3.png" alt="" />
          <p>
            <span>Grilly Billy</span> Support System <br />
            Phone: +62877 0000 0000 <br />E-mail: contact@example.com
          </p>
        </div>
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
        <button class="normal">Sign Up</button>
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