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
        <li class="active">Edit Category</li>
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
                                Edit - Category
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="code.php" method="POST">
                                <?php
                                    if(isset($_GET['id']))
                                    {
                                        $cate_id = $_GET['id'];
                                        $query = "SELECT * FROM categories WHERE id='$cate_id'";
                                        $query_run = mysqli_query($con, $query);
                                        
                                        foreach($query_run as $item) : 
                                        ?>
                                            <input type="hidden" name="cate_id" value="<?= $item['id']; ?>">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Category Name</label>
                                                    <input type="text" name="name" value="<?= $item['name']; ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Description</label>
                                                    <textarea type="text" name="description" class="form-control" required rows="3"><?= $item['description']; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Trending</label>
                                                    <input type="checkbox" name="trending" <?= $item['trending'] == "1" ? 'checked':''; ?> />
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <input type="checkbox" name="status" <?= $item['status'] == "1" ? 'checked':''; ?> />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="category.php" class="btn btn-danger btn-secondary">BACK</a>
                                                <button type="submit" name="category_update" class="btn btn-primary">Update</button>
                                            </div>
                                        <?php
                                        endforeach; 
                                    }
                                    else
                                    {
                                        echo "No ID Found";
                                    }
                                ?>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </section>
</div

<?php include('includes/script.php'); ?> 
<?php include('includes/footer.php'); ?> 