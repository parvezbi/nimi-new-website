<?php

  include "header.php";
  include "config.php";

  //update data here start-----------
  if (isset($_POST['submit'])) {
    $user_id = mysqli_real_escape_string($conn,$_POST['user_id']);
    $f_name = mysqli_real_escape_string($conn,$_POST['f_name']);
    $l_name = mysqli_real_escape_string($conn,$_POST['l_name']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $role = mysqli_real_escape_string($conn,$_POST['role']);
    $updateUserQuery = "UPDATE user SET first_name = '{$f_name}', last_name = '{$l_name}', username = '{$username}', role = '{$role}' WHERE user_id = '{$user_id}'";
    $updateUQResult = mysqli_query($conn,$updateUserQuery) or die("Update User Query Failed");
    header('Location:users.php');
  }

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading" style="text-align: center;">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                <?php
                
                  //read data from database for edit & Update
                  $user_id = $_GET['id'];
                  $readForEdit = "SELECT * FROM user WHERE user_id = '{$user_id}'";
                  $readFEResult = mysqli_query($conn,$readForEdit);
                  if (mysqli_num_rows($readFEResult)>0) {
                    while ($user = mysqli_fetch_assoc($readFEResult)) { ?>
                    <!-- Form Start -->
                    <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                        <div class="form-group">
                            <input type="hidden" name="user_id"  class="form-control" value="<?php echo $user['user_id']; ?>" >
                        </div>
                            <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="f_name" class="form-control" value="<?php echo $user['first_name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="l_name" class="form-control" value="<?php echo $user['last_name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>User Role</label>
                            <select class="form-control" name="role" value="<?php echo $user['role']; ?>">
                              <?php 
                                if ($user['role']==1) {?>
                                  <option value="1" selected>Admin</option>
                                  <option value="0">normal User</option>
                                <?php }else{ ?>
                                  <option value="1">Admin</option>
                                  <option value="0" selected>normal User</option>
                                <?php }
                              ?>
                            </select>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                    </form>
                    <!-- /Form -->
                    <?php }
                  }
                ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
