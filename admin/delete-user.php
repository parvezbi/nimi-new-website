<?php 
  include "header.php";
  include "config.php";
  //Delete User Start Here -----------
  if (isset($_POST['delete'])) {
    $user_id = $_GET['id'];
    $deleteUser = "DELETE FROM user WHERE user_id = {$user_id}";
    $deleteUserResult = mysqli_query($conn, $deleteUser);
    header("Location:users.php");
  }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading" style="text-align: center;">Are you sure to delete this user?</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                <?php
                  //read data from database for delete
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
                            <input type="text" name="f_name" class="form-control" disabled value="<?php echo $user['first_name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="l_name" class="form-control" disabled value="<?php echo $user['last_name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="username" class="form-control" disabled value="<?php echo $user['username']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>User Role</label>
                            <select class="form-control" name="role" disabled value="<?php echo $user['role']; ?>">
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
                        <input type="submit" name="delete" class="btn btn-primary" value="Delete" required />
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
