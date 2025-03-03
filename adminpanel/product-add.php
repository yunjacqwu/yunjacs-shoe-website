<?php
    session_start();
    if(!isset($_SESSION['login'])) {
      header('location: ../login.php');
      exit;
    }
    /* require "session.php"; */
    include('../config.php');
    include('includes/header.php');
    include('includes/topbar.php');
    include('includes/sidebar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Modal -->
    <!-- <div class="modal fade" id="CategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 10px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="code.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Category Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea type="text" name="description" class="form-control" placeholder="Description" required rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Trending</label>
                            <input type="checkbox" name="trending">
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <input type="checkbox" name="status">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="product_save" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

    <!-- Delete Product -->
    <div class="modal fade" id="DeletModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="prod_delete_id" class="delete_id">
                    <p>
                        Are you sure, you want to delete this product?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="prod_delete_btn" class="btn btn-primary">Yes, Delete.!</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Delete Product -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Dashboard <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Product</li>
        </ol>
    </section>
    <!-- /.content-header -->
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-success">
                        <?php
                        if(isset($_SESSION['status']))
                        {
                            echo "<h4>".$_SESSION['status']."</h4>";
                            unset($_SESSION['status']);
                        }
                        ?>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 style="margin-bottom: 50px";>
                                Add Product
                                <!-- <a href="product.php" class="btn btn-primary btn-sm float-right" style="margin-left: 1090px;margin-bottom: 10px;">BACK</a> -->
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Select Category</label>
                                        <?php
                                            $query = "SELECT * FROM categories";
                                            $query_run = mysqli_query($con, $query);

                                            if(mysqli_num_rows($query_run) > 0)
                                            {
                                                ?>
                                                <select name="category_id" class="form-control">
                                                    <?php foreach($query_run as $item) { ?>
                                                            <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Small Description</label>
                                            <textarea name="small_description" class="form-control" rows="3" placeholder="Enter Small Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Long Description</label>
                                            <textarea name="long_description" class="form-control" required rows="3" placeholder="Enter Long Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="text" name="price" class="form-control" required placeholder="Enter Price">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Offer Price</label>
                                            <input type="text" name="offerprice" class="form-control" required placeholder="Enter Offer Price">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tax</label>
                                            <input type="text" name="tax" class="form-control" required placeholder="Enter TAX">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="text" name="quantity" class="form-control" required placeholder="Enter Quantity">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Weight</label>
                                            <input type="text" name="weight" class="form-control" required placeholder="Enter Weight">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status (checked = Show | Hide)</label><br>
                                            <input type="checkbox" name="status" > Show / Hide
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Upload Image</label>
                                            <input type="file" name="image" class="form-control" required>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Click to Save</label><br>
                                            <button type="submit" name="product_save" class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="modal-footer">
                                    <a href="product.php" class="btn btn-danger btn-secondary">BACK</a>
                                    <button type="submit" name="product_save" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>