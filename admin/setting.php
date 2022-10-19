<?php 
  include "header.php";
  include "config.php";
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading" style="text-align: center;">Website Setting</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
      <?php
        $settingRead = "SELECT * FROM settings";
        $settingRResult = mysqli_query($conn,$settingRead) or die("Post Read Query Failed");
        if (mysqli_num_rows($settingRResult)>0) {
          while ($setting = mysqli_fetch_assoc($settingRResult)) {?>
           <form action="update-setting.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                    <label for="exampleInputTile">Website Name</label>
                    <input type="text" name="website_name"  class="form-control" id="exampleInputUsername" value="<?php echo $setting['websitename']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Upload Logo</label>
                    <input type="file" name="logo">
                    <img  src="upload/<?php echo $setting['logo']; ?>" height="150px">
                    <input type="hidden" name="old_logo" value="<?php echo $setting['logo']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Footer Description</label>
                    <textarea name="footer_des" class="form-control"  required rows="5"><?php echo $setting['footerdesc']; ?></textarea>
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Update" />
            </form>
          <?php }
        }
      ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>