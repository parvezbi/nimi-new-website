<?php 
  include "config.php";

  //image upload checking--------------------------------
  if (empty($_FILES['new_image']['name'])) {
  	$filename = $_POST['old_image'];
  }else{
  	//image upload-------
  	$errors = array();
  	$file_name = $_FILES['new_image']['name'];
  	$file_size = $_FILES['new_image']['size'];
  	$file_tmp = $_FILES['new_image']['tmp_name'];
  	$file_type = $_FILES['new_image']['type'];

  	//check file extension------
    $exp = explode('.', $file_name);
    $file_ext = strtolower(end($exp));
  	$extensions = array("jpeg","jpg","png");
  	if (in_array($file_ext, $extensions)===false) {
  		$errors[] = "This extension is not allowed, please choose a jpeg,jpg or png format.";
  	}

  	//check file size-----
  	if ($file_size > 2097152) {
  		$errors[] = "File size must be 2MB or lower.";
  	}

    //Avoid Same Image Name--------
    $rand = rand(0000,9999);
    $filename = $rand."-".$file_name;

  	//All Error Checking and file upload--------
  	if (empty($errors)==true) {
  		move_uploaded_file($file_tmp, 'upload/'.$filename);
      unlink("upload/".$_POST['old_image']);
  	}else{
  		print_r($errors);
  		die();
  	}
  }
  $title = $_POST["post_title"];
  $description = mysqli_real_escape_string($conn, $_POST["postdesc"]);
  $category = $_POST["category"];
  $post_id = $_POST["post_id"];
  $updatePost = "UPDATE post SET title = '{$title}', description = '{$description}', category = '{$category}', post_img = '{$filename}' WHERE post_id = '{$post_id}';";
  if ($_POST['old_category'] != $_POST["category"]) {
  $updatePost .= "UPDATE category SET post = post - 1 WHERE category_id = {$_POST["old_category"]};";
  $updatePost .= "UPDATE category SET post = post + 1 WHERE category_id = {$_POST["category"]};";
  }
  $updatePostResult = mysqli_multi_query($conn,$updatePost);
  if ($updatePostResult) {
    header("Location:post.php");
  }else{
    echo "Query Failed.";
  }


?>
