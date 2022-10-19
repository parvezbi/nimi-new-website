<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <?php 
                $settingRead = "SELECT * FROM settings";
                $settingRResult = mysqli_query($conn,$settingRead) or die("Post Read Query Failed");
                if (mysqli_num_rows($settingRResult)>0) {
                  while ($setting = mysqli_fetch_assoc($settingRResult)) {?>
                <span><?php echo $setting['footerdesc']; ?></span>
                  <?php }
                }
              ?>

            </div>
        </div>
    </div>
</div>
</body>
</html>
