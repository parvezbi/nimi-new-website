<?php

  include "header.php";
  include "config.php";
  //update category here start-----------
  if (isset($_POST['submit'])) {
    $cat_id = mysqli_real_escape_string($conn,$_POST['cat_id']);
    $cat_name = mysqli_real_escape_string($conn,$_POST['cat_name']);
    echo $updateCatQuery = "UPDATE category SET category_name = '{$cat_name}' WHERE category_id = '{$cat_id}'";
    $updateCQResult = mysqli_query($conn,$updateCatQuery) or die("Update Category Failed");
    header("Location:category.php");
  }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading" style="text-align: center;">Want to update this category?</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                  $cateId = $_GET['category'];
                  $readCatFUpdate = "SELECT * FROM category WHERE category_id = '{$cateId}'";
                  $readCFUResult = mysqli_query($conn,$readCatFUpdate);
                  if (mysqli_num_rows($readCFUResult)>0) {
                    while ($cat = mysqli_fetch_assoc($readCFUResult)) { ?>

                      <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                          <div class="form-group">
                              <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $cat['category_id']; ?>" placeholder="">
                          </div>
                          <div class="form-group">
                              <label>Category Name</label>
                              <input type="text" name="cat_name" class="form-control" value="<?php echo $cat['category_name']; ?>"  placeholder="" required>
                          </div>
                          <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                      </form>

                    <?php }
                  }
                ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
