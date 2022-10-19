<?php
  include "header.php";
  include "config.php";
  session_start();
  if ($_SESSION['user_role'] == 0) {
    header("Location:post.php");
  }

  //image upload-------
  if (isset($_FILES['fileToUpload'])) {
  	$errors = array();
  	$file_name = $_FILES['fileToUpload']['name'];
  	$file_size = $_FILES['fileToUpload']['size'];
  	$file_tmp = $_FILES['fileToUpload']['tmp_name'];
  	$file_type = $_FILES['fileToUpload']['type'];

  	//Check File Extension--------
  	$file_ext = strtolower(end(explode('.',$file_name)));
  	$extensions = array("jpeg","jpg","png");
  	if (in_array($file_ext, $extensions)===false) {
  		$errors[] = "This extension is not allowed, please choose a jpeg,jpg or png format";
  	}

  	//Check File Size--------
  	if ($file_size > 2097152) {
  		$errors[] = "File size must be 2MB or lower.";
  	}

    //Avoid Same Image Name--------
    $rand = rand(0000,9999);
    $filename = $rand."-".$file_name;

  	//All Error Cheking and file upload--------
  	if (empty($errors) == true) {
  		move_uploaded_file($file_tmp, "upload/".$filename);
  	}else{
  		print_r($errors);
  		die();
  	}

  }
  //image upload kattam-------

  $title = mysqli_real_escape_string($conn, $_POST['post_title']);
  $description = mysqli_real_escape_string($conn, $_POST['postdesc']);
  $category = mysqli_real_escape_string($conn, $_POST['category']);
  $date = date("d M, Y");
  $author = $_SESSION['user_id'];
  $addPost = "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES ('{$title}','{$description}','{$category}','{$date}','{$author}','{$filename}');";
  $addPost .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";
  if (mysqli_multi_query($conn,$addPost)) {
  	header("Location:post.php");
  }else{
  	echo '<p class="alert alert-danger">Query Failed</p>';
  }
?>