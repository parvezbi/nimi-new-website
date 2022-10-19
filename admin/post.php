<?php 
  include "header.php";
  include "config.php";
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
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
                          if ($_SESSION['user_role'] == '1') {
                          $readPost = "SELECT post.post_id, post.title, post.description, post.post_date, category.category_id, category.category_name, user.username FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                          }elseif($_SESSION['user_role'] == '0'){
                          $readPost = "SELECT post.post_id, post.title, post.description, post.post_date, category.category_id, category.category_name, user.username FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post.author = {$_SESSION['user_id']} ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                          }

                          $readPostResult = mysqli_query($conn,$readPost);
                          if (mysqli_num_rows($readPostResult)>0) {
                            $serial = $offset+1;
                            while ($post = mysqli_fetch_assoc($readPostResult)) {?>
                            <tr>
                                <td class='id'><?php echo $serial; ?></td>
                                <td><?php echo $post['title']; ?></td>
                                <td><?php echo $post['category_name']; ?></td>
                                <td><?php echo $post['post_date']; ?></td>
                                <td><?php echo $post['username']; ?></td>
                                <td class='edit'><a href='update-post.php?id=<?php echo $post['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                                <td class='delete'><a href='delete-post.php?id=<?php echo $post['post_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                            </tr>
                            <?php 
                                $serial++;
                            }
                          }
                        ?>
                      </tbody>
                  </table>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <?php
              if ($_SESSION['user_role'] == '1') {
                $paginationQuery = "SELECT * FROM post";
              }elseif($_SESSION['user_role'] == '0'){
                $paginationQuery = "SELECT * FROM post WHERE post.author = {$_SESSION["user_id"]}";
              }
                $paginationQResult = mysqli_query($conn,$paginationQuery);
                if (mysqli_num_rows($paginationQResult)) {
                  $totalRecords = mysqli_num_rows($paginationQResult);
                  $totalPages = ceil($totalRecords/$limit);
                  echo "<ul class='pagination admin-pagination'>";
                  if ($page>1) {?>
                      <li><a href="post.php?page=<?php echo $page-1; ?>">Pre</a></li>
                  <?php }
                  for ($i=1; $i <= $totalPages ; $i++) { 
                    if ($i==$page) {?>
                      <li class="active"><a href="post.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php }else{?>
                      <li><a href="post.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php }
                  }
                  if ($totalPages>$page) {?>
                      <li><a href="post.php?page=<?php echo $page+1; ?>">Next</a></li>
                  <?php }
                  echo "</ul>";
                }
              ?>
            </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
