<?php
    session_start();
    if(isset($_SESSION['login'])) {
        if($_SESSION['role'] == 'admin') {
        header('location: adminpanel/index.php');
        exit;
    }
    else
    {
        header('location: web/indexu.php');
    }
    }
    require "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="wrapper">
        <div class="container main flex-column position-relative">
            <div class="row">
                <div class="col-md-6 side-image" id="sideImage">
                    <!-------Image-------->
                </div>
                <div class="col-md-6 right flex-colimn">
                    <div class="input-box">
                        <form action="" method="post">
                        <header>Log in account</header>
                            <div class="input-field">
                                <input class="input" type="text" name="email" required autocomplete="off">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field">
                                <input class="input" type="password" name="password" required>
                                <label for="password">Password</label>
                            </div>
                            <div class="input-field">
                                <button class="submit" type="submit" name="loginbtn">Login</button>
                            </div>
                            <div class="signin">
                                <span>Create new account? <a href="register.php">Register here</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="position-absolute bottom-0 start-50 translate-middle-x" style="width: 900px">
                <?php
                    if(isset($_POST['loginbtn'])) {
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $result = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");

                        //cek username 
                        if(mysqli_num_rows($result)===1){
                            //cek password
                            $row = mysqli_fetch_assoc($result);
                            if(password_verify($password, $row['password'])) {
                                //set session
                                $_SESSION['login'] = true;
                                $_SESSION['user_id'] = $row['id'];  
                                $_SESSION['role'] = $row['role'];
                                //cek role pengguna
                                if($row['role']=='admin'){
                                    header('location: adminpanel/index.php');
                                }
                                else
                                {
                                    header('location: web/indexu.php');
                                }
                                /* header('location: adminpanel/index.php'); */
                            }
                            else 
                            {
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    Wrong password!
                                </div>
                                <?php
                            }
                        }
                        else {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Account not available!
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <script>
    const images = [
        'img/login1.jpg',
        'img/login2.jpg',
        'img/login3.jpg',
        'img/login4.jpg'
    ];

    let currentIndex = 0;
    const sideImage = document.getElementById('sideImage');

    function changeImage() {
        // Fade out current image
        sideImage.classList.add('fade-out');

        setTimeout(() => {
            // Change the image once fade out is complete
            currentIndex = (currentIndex + 1) % images.length;
            sideImage.style.backgroundImage = `url('${images[currentIndex]}')`;

            // Fade in new image
            sideImage.classList.remove('fade-out');
        }, 1000); // This timeout should match the CSS transition duration
    }

    // Change image every 5 seconds
    setInterval(changeImage, 5000);

    // Initial image load
    window.onload = () => {
        sideImage.style.backgroundImage = `url('${images[currentIndex]}')`;
    };
    </script>


</body>
</html>