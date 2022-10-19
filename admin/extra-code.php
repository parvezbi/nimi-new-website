<?php 
  include "header.php";
  include "config.php";
  if (isset($_POST['submit'])) {
    $post_id = $_POST['post_id'];
    $cat_id = $_POST['cat_id'];
    $deletePost = "SELECT * FROM post WHERE post_id = '{$post_id}';";
    $deletePost .= "UPDATE category SET post=post-1 WHERE category_id = {$cat_id}";
    $deletePostResult = mysqli_multi_query($conn,$deletePost);
  }
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Delete Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
    <?php 
        $post_id = $_GET['id'];
        $postRead = "SELECT post.post_id, post.title, post.description, post.post_img, category.category_id, category.category_name FROM post LEFT JOIN category ON post.category = category.category_id WHERE post_id = {$post_id}";
        $postRResult = mysqli_query($conn,$postRead) or die("Post Read Query Failed");
        if (mysqli_num_rows($postRResult)) {
            while ($post = mysqli_fetch_assoc($postRResult)) {?>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <input type="hidden" name="post_id"  class="form-control" value="<?php echo $post['post_id']; ?>" placeholder="">
                </div>
                <div class="form-group">
                    <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $post['category_id']; ?>" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputTile">Title</label>
                    <input type="text" name="post_title"  class="form-control" disabled value="<?php echo $post['title']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1"> Description</label>
                    <textarea name="postdesc" class="form-control" disabled rows="5">
                        <?php echo $post['description']; ?>
                    </textarea>
                </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="" class="form-control" disabled>
                            <option><?php echo $post['category_name']; ?></option>
                          </select>
                      </div>
                <div class="form-group">
                    <label for="">Post image</label>
                    <input type="file" name="new_image" disabled>
                    <img  src="upload/<?php echo $post['post_img']; ?>" height="150px">
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Delete" />
            </form>

            <?php }
        }
    ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>