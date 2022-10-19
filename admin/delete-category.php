<?php
  include "header.php";
  include "config.php";
  // Delete Category From database
  if (isset($_POST['submit'])) {
    $cat_id = mysqli_real_escape_string($conn,$_POST['cat_id']);
    $deleteCatQuery = "DELETE FROM category WHERE category_id = '{$cat_id}'";
    $deleteCatResult = mysqli_query($conn,$deleteCatQuery);
    header("Location:category.php"); 
  }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading" style="text-align: center;">Want to delete this category?</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php 
                  $cat_id = $_GET['category'];
                  $readFDQuery = "SELECT * FROM category WHERE category_id = '{$cat_id}'";
                  $readFDResult = mysqli_query($conn,$readFDQuery);
                  if (mysqli_num_rows($readFDResult)>0) {
                    while ($cat = mysqli_fetch_assoc($readFDResult)) { ?>
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                        <div class="form-group">
                            <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $cat['category_id']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="cat_name" class="form-control" value="<?php echo $cat['category_name']; ?>" disabled>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Delete" required />
                    </form>
                    <?php }
                  }
                ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
