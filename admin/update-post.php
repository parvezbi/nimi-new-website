<?php 
  include "header.php";
  include "config.php";
  if ($_SESSION['user_role']==0) {
      $post_id = $_GET['id'];
      $sessioncheck = "SELECT author FROM post WHERE post_id = '{$post_id}'";
      $sessioncheckResult = mysqli_query($conn,$sessioncheck);
      $session = mysqli_fetch_assoc($sessioncheckResult);
      if ($session['author'] != $_SESSION['user_id']) {
        header("Location:post.php");
      }
  }
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading" style="text-align: center;">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
    <?php 
        $post_id = $_GET['id'];
        $postRead = "SELECT post.post_id, post.title, post.description, post.category, post.post_img, category.category_name FROM post LEFT JOIN category ON post.category = category.category_id WHERE post_id = '{$post_id}'";
        $postRResult = mysqli_query($conn,$postRead) or die("Post Read Query Failed");
        if (mysqli_num_rows($postRResult)) {
            while ($post = mysqli_fetch_assoc($postRResult)) {?>
            <!-- Form for show edit-->
            <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                    <input type="hidden" name="post_id"  class="form-control" value="<?php echo $post['post_id']; ?>" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputTile">Title</label>
                    <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $post['title']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1"> Description</label>
                    <textarea name="postdesc" class="form-control"  required rows="5">
                        <?php echo $post['description']; ?>
                    </textarea>
                </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                          <?php
                            $readCat = "SELECT * FROM category";
                            $readCatResult = mysqli_query($conn,$readCat);
                            if (mysqli_num_rows($readCatResult)>0) {
                              while ($cat = mysqli_fetch_assoc($readCatResult)) {
                                  if ($cat['category_id'] == $post['category']) {?>
                                      <option selected value="<?php echo $cat['category_id']; ?>"><?php echo $cat['category_name']; ?></option>
                                  <?php }else{ ?>
                                      <option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['category_name']; ?></option>
                                  <?php }
                              }
                            }
                          ?>
                          </select>
                          <input type="hidden" name="old_category" value="<?php echo $post['category']; ?>">
                      </div>
                <div class="form-group">
                    <label for="">Post image</label>
                    <input type="file" name="new_image">
                    <img  src="upload/<?php echo $post['post_img']; ?>" height="150px">
                    <input type="hidden" name="old_image" value="<?php echo $post['post_img']; ?>">
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Update" />
            </form>
            <!-- Form End -->
            <?php }
        }
    ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
