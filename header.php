<?php
  include 'config.php';
  $page = basename($_SERVER['PHP_SELF']);
  switch ($page) {
      case 'single.php':
          if (isset($_GET['id'])) {
              $sql_title = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
              $result_title = mysqli_query($conn,$sql_title);
              $row_title = mysqli_fetch_assoc($result_title);
              $page_title = $row_title['title'];
          }else{
              $page_title = "No Post Found";
          }
          break;
      case 'category.php':
          if (isset($_GET['cat'])) {
              $sql_title = "SELECT * FROM category WHERE category_id = {$_GET['cat']}";
              $result_title = mysqli_query($conn,$sql_title);
              $row_title = mysqli_fetch_assoc($result_title);
              $page_title = $row_title['category_name']." News";
          }else{
              $page_title = "No Category Found";
          }
          break;
      case 'author.php':
          if (isset($_GET['author'])) {
              $sql_title = "SELECT * FROM user WHERE user_id = {$_GET['author']}";
              $result_title = mysqli_query($conn,$sql_title);
              $row_title = mysqli_fetch_assoc($result_title);
              $page_title = "News By ".$row_title['first_name']. " " .$row_title['last_name'];
          }else{
              $page_title = "No Author Found";
          }
          break;
      case 'search.php':
          if (isset($_GET['search'])) {
              $page_title = "Search Result Of ".$_GET['search'];
          }else{
              $page_title = "No Search Result Found";
          }
          break;
      default:
          $page_title = "News Site";
          break;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
              <?php 
                $settingRead = "SELECT * FROM settings";
                $settingRResult = mysqli_query($conn,$settingRead) or die("Post Read Query Failed");
                if (mysqli_num_rows($settingRResult)>0) {
                  while ($setting = mysqli_fetch_assoc($settingRResult)) {?>
                  <a href="index.php" id="logo"><img src="admin/upload/<?php echo $setting['logo']; ?>"></a>
                  <?php }
                }
              ?>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                    <li><a href='index.php'>Home</a></li>
                    <?php 
                        $allCat = "SELECT * FROM category";
                        $allCatQuery = mysqli_query($conn,$allCat);
                        if (mysqli_num_rows($allCatQuery)>0) {
                            while ($cat = mysqli_fetch_assoc($allCatQuery)) { ?>
                                <li><a href='category.php?cat=<?php echo $cat['category_id']; ?>'><?php echo $cat['category_name']; ?></a></li>
                            <?php }
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
