<?php

  include "header.php";
  include "config.php";

  // create category and check if already exist the category start-----------------------
  if (isset($_POST['save'])) {
    $category = mysqli_real_escape_string($conn,$_POST['cat']);
    $alreadyExist = "SELECT category_name FROM category WHERE category_name = '{$category}'";
    $resultCheck = mysqli_query($conn,$alreadyExist);
    if (mysqli_num_rows($resultCheck)>0) {
      echo "<p style='color:red;text-align:center;'>This category is already exist, Create a new one.</p>";
    }else{
      $createNewCat = "INSERT INTO category (category_name) VALUES ('{$category}')";
      $createNCResult = mysqli_query($conn,$createNewCat) or die("Create New Category Failed");
      if (isset($createNCResult)) {
        header("Location:category.php");
      }
    }
  }
  // create category and check if already exist the category start-----------------------

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading" style="text-align: center;">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
