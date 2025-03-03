<?php
    session_start();
    require "config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>
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
                        <header>Register account</header>
                            <div class="input-field">
                                <input class="input" type="text" name="name" required autocomplete="off">
                                <label for="name">Username</label>
                            </div>
                            <div class="input-field">
                                <input class="input" type="text" name="phone" required>
                                <label for="phone">Phone Number</label>
                            </div>
                            <div class="input-field">
                                <input class="input" type="email" name="email" required autocomplete="off">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field">
                                <input class="input" type="password" name="password" required>
                                <label for="password">Enter your Password</label>
                            </div>
                            <div class="input-field">
                                <input class="input" type="password" name="cpassword" required>
                                <label for="password">Confirm your Password</label>
                            </div>
                            <div class="input-field">
                                <button class="submit" type="submit" name="submitbtn">Register</button>
                            </div>
                            <div class="signin">
                                <span>Already have an account? <a href="login.php">Log in here</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="position-absolute bottom-0 start-50 translate-middle-x" style="width: 900px">
                <?php
                    if(isset($_POST['submitbtn']))
                    {
                        $name = mysqli_real_escape_string($con, $_POST['name']);
                        $phone = mysqli_real_escape_string($con, $_POST['phone']);
                        $email = mysqli_real_escape_string($con, $_POST['email']);
                        $password = mysqli_real_escape_string($con, $_POST['password']);
                        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
                        
                        // Memeriksa Email Sudah Terdaftar
                        $select = "SELECT email FROM users WHERE email = '$email'";
                        $result = mysqli_query($con, $select);
                        
                        if(mysqli_num_rows($result) > 0) {
                            //Email Sudah Terdaftar
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Email already axist!
                            </div>
                            <?php
                        }
                        else 
                        {   
                            // Memeriksa apakah Username sudah terdaftar
                            $select = "SELECT name FROM users WHERE name = '$name'";
                            $result = mysqli_query($con, $select);

                            if(mysqli_num_rows($result) > 0) {
                                // Username sudah terdaftar
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    Username already exists!
                                </div>
                                <?php
                            }
                            
                            else
                            {   
                                // Memeriksa apakah phone sudah terdaftar
                                $select = "SELECT phone FROM users WHERE phone = '$phone'";
                                $result = mysqli_query($con, $select);

                                if(mysqli_num_rows($result) > 0) {
                                    // Phone sudah terdaftar
                                    ?>
                                    <div class="alert alert-danger" role="alert">
                                        Phone number already exists!
                                    </div>
                                    <?php
                                }
                                else
                                {
                                    if($password != $cpassword){
                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            Password not matched!
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        // Hash password
                                        $password = password_hash($password, PASSWORD_DEFAULT);

                                        $insert = "INSERT INTO users (name, phone, email, password, role) VALUES('$name', '$phone', '$email', '$password', 'user')";
                                        mysqli_query($con, $insert);
                                        header('location:login.php');
                                    }
                                }
                            }
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