<?php
    session_start();
    if(!isset($_SESSION['login'])) {
      header('location: ../login.php');
      exit;
    }
    include('../config.php');
    /* require "session.php"; */
    include('includes/header.php');
    include('includes/topbar.php');
    include('includes/sidebar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Modal -->
    <div class="modal fade" id="CategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>

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
                    <input type="hidden" name="prod_delete_id" class="delete_prod_id">
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
                            <h3>
                                Add Product
                                <a href="product-add.php" class="btn btn-primary btn-sm float-right" style="margin-left: 1050px;margin-bottom: 10px;">Add Product</a>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM products";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $prod_item)
                                            {
                                                ?>
                                                    <tr>
                                                        <td><?= $prod_item['id']; ?></td>
                                                        <td><?= $prod_item['name']; ?></td>
                                                        <td><?= $prod_item['price']; ?></td>
                                                        <td>
                                                            <input type="checkbox" <?= $prod_item['status'] == '1' ? 'checked':'' ?> readonly />
                                                        </td>
                                                        <td><?= $prod_item['created_at']; ?></td>
                                                        <td>
                                                            <a href="product-edit.php?prod_id=<?php echo $prod_item['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                                            <button type="button" value="<?php echo $prod_item['id']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</button>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="6">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
 
<?php include('includes/script.php'); ?> 
<script>
    $(document).ready(function () {
        $('.deletebtn').click(function (e) {
            e.preventDefault();

            var prod_id = $(this).val();
            //console.log(id);
            $('.delete_prod_id').val(prod_id);
            $('#DeletModal').modal('show');
        });
    });
</script>
<?php include('includes/footer.php'); ?> 