<?php 
  include "config.php";
  //image upload checking-----------------
  if (empty($_FILES['logo']['name'])) {
    $file_name = $_POST['old_logo'];
  }else{
    //Image Upload
    $errors = array();
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_tmp = $_FILES['logo']['tmp_name'];
    $file_type = $_FILES['logo']['type'];
    //checking file extension
    $exp = explode('.', $file_name);
    $file_ext = strtolower(end($exp));
    $extensions = array("jpeg","jpg","png");
    if (in_array($file_ext, $extensions)===false) {
      $errors[] = "This extension is not allowed, please choose a jpeg,jpg or png format.";
    }
    //check file size
    if ($file_size > 2097152) {
      $errors[] = "File size must be 2MB or lower.";
    }
    //All Error Checking and file upload--------
    if (empty($errors)==true) {
      move_uploaded_file($file_tmp, 'upload/'.$file_name);
      unlink("upload/".$_POST['old_logo']);
    }else{
      print_r($errors);
      die();
    }
  }
  $website_name = $_POST['website_name'];
  $footer_des = $_POST['footer_des'];
  echo $updateSettingQuery = "UPDATE settings SET websitename = '{$website_name}', logo = '{$file_name}', footerdesc = '{$footer_des}'";
  $updateSQResult = mysqli_query($conn, $updateSettingQuery);
  if ($updateSQResult) {
    header("Location:setting.php");
  }else{
    echo "query Failed";
  }
?>