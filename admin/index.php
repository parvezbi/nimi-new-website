<?php 
  include "config.php";
  session_start();
  if (isset($_SESSION['username'])) {
     header("Location:post.php");
  }
  if (isset($_POST['login'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo '<div class="alert alert-danger">Username and Password cannot be null!</div>';
    }else{
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $password = md5($_POST['password']);
      $loginQuery = "SELECT user_id,username,role FROM user WHERE username = '{$username}' AND password = '{$password}'";
      $loginQResult = mysqli_query($conn,$loginQuery) or die("Login Query Failed");
      if (mysqli_num_rows($loginQResult)>0) {
          while ($user = mysqli_fetch_assoc($loginQResult)) {
              session_start();
              $_SESSION['user_id'] = $user['user_id'];
              $_SESSION['username'] = $user['username'];
              $_SESSION['user_role'] = $user['role'];
              header("Location:post.php");
          }
      }else{
        echo '<div class="alert alert-danger">Username and Password not Matched!</div>';
      }
    }
  }
?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <h3 class="heading" style="text-align: center;">Admin</h3>
                        <!-- Form Start -->
                        <form  action="" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="password">
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
