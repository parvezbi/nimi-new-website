<?php 
  include "header.php";
  include "config.php";
  if ($_SESSION['user_role'] == 0) {
    header("Location:post.php");
  }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                      <?php
                        $limit = 4;
                        if (isset($_GET['page'])) {
                          $page = $_GET['page'];
                        }else{
                          $page = 1;
                        }
                        $offset = ($page-1)*$limit;
                        $readUserQuery = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit}";
                        $readUQResult = mysqli_query($conn,$readUserQuery) or die("Read User Query Failed");
                        if (mysqli_num_rows($readUQResult) > 0) {
                          while ($user = mysqli_fetch_assoc($readUQResult)) { ?>
                            <tr>
                                <td class='id'><?php echo $user['user_id']; ?></td>
                                <td><?php echo $user['first_name'].' '. $user['last_name']; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php if($user['role']==1){ echo "Admin";}else{echo "User";}?></td>
                                <td class='edit'><a href='update-user.php?id=<?php echo $user['user_id']; ?>'><i class='fa fa-edit'></i></a></td>
                                <td class='delete'><a href='delete-user.php?id=<?php echo $user['user_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                            </tr>
                          <?php }
                        } else{
                          echo "<p>No Data Found!</p>";
                        }
                      ?>
                    </tbody>
                </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                  <?php
                    $paginationQuery = "SELECT * FROM user";
                    $paginationQResult = mysqli_query($conn,$paginationQuery);
                    if (mysqli_num_rows($paginationQResult)>0) {
                      $totalRecords = mysqli_num_rows($paginationQResult);
                      $totalPages = ceil($totalRecords/$limit);
                      echo "<ul class='pagination admin-pagination'>";
                      if ($page > 1) {?>
                        <li><a href="users.php?page=<?php echo $page-1; ?>">Pre</a></li>
                      <?php }
                      for ($i=1; $i <= $totalPages ; $i++) {
                        if($i==$page){ ?>
                          <li class="active"><a href="users.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php }else{ ?>
                          <li><a href="users.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php }
                      }
                      if ($totalPages > $page) {?>
                        <li><a href="users.php?page=<?php echo $page+1; ?>">Next</a></li>
                      <?php }
                      echo "</ul>";
                    }
                  ?>
            </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
