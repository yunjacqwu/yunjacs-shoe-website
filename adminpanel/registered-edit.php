<?php
    session_start();
    if(!isset($_SESSION['login'])) {
      header('location: ../login.php');
      exit;
    }
    include('../config.php');
    include('includes/header.php');
    include('includes/topbar.php');
    include('includes/sidebar.php');
    
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Registered</li>
      </ol>
    </section>
    <!-- /.content-header -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Edit - Registered Users
                            </h3>
                            
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="code.php" method="POST">
                                        <div class="modal-body">
                                            <?php
                                                if(isset($_GET['user_id'])) 
                                                {
                                                    $user_id = $_GET["user_id"];
                                                    $query = "SELECT * FROM users WHERE id = '$user_id' LIMIT 1";
                                                    $query_run = mysqli_query($con, $query);

                                                    if(mysqli_num_rows($query_run) > 0)
                                                    {
                                                        foreach($query_run as $row)
                                                        {
                                                            ?>
                                                                <input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
                                                                <div class="form-group">
                                                                    <label for="">Name</label>
                                                                    <input type="text" name="name" value="<?php echo $row['name'] ?>" class="form-control" placeholder="Name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Phone Number</label>
                                                                    <input type="text" name="phone" value="<?php echo $row['phone'] ?>" class="form-control" placeholder="Phone Number">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Email</label>
                                                                    <input type="email" name="email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Email">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Password</label>
                                                                    <input type="password" name="password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="Password">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Give Role</label>
                                                                    <select name="role" class="form-control" required>
                                                                        <option value="user" <?php if($row['role'] == 'user') echo 'selected'; ?>>User</option>
                                                                        <option value="admin" <?php if($row['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                                                    </select>
                                                                </div>
                                                            <?php
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo "<h4>No Record Found.!</h4>";
                                                    }
                                                }
                                            ?>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <a href="registered.php" class="btn btn-danger btn-secondary">BACK</a>
                                            <button type="submit" name="updateUser" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('includes/script.php'); ?> 
<?php include('includes/footer.php'); ?> 