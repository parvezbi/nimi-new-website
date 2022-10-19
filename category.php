<?php 
    include 'header.php'; 
    include 'config.php'; 
?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <?php
                    $cat_id = $_GET['cat'];
                    $catName = "SELECT * FROM category WHERE category_id = {$cat_id}";
                    $catNameResult = mysqli_query($conn,$catName);
                    if (mysqli_num_rows($catNameResult)>0) {
                      while ($cat = mysqli_fetch_assoc($catNameResult)) {?>
                        <h2 class="page-heading"><?php echo $cat['category_name']; ?></h2>
                      <?php }
                    }
                  ?>
                    <!-- post-container -->
                    <div class="post-container">
                      <div class="post-content">
                          <?php
                              $cat_id = $_GET['cat'];
                              $limit = 3;
                              if (isset($_GET['page'])) {
                                  $page = $_GET['page'];
                              }else{
                                  $page = 1;
                              }
                              $offset = ($page-1)*$limit;
                              $readPost = "SELECT post.post_id, post.title, post.description, post.post_date, post.post_img, category.category_name, category.category_id, user.username, user.user_id FROM post LEFT JOIN category ON post.category=category.category_id LEFT JOIN user ON post.author=user.user_id WHERE category_id = {$cat_id} LIMIT {$offset},{$limit}";
                              $readPostResult = mysqli_query($conn,$readPost);
                              if (mysqli_num_rows($readPostResult)>0) {
                                  while ($post = mysqli_fetch_assoc($readPostResult)) {?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a class="post-img" href="single.php?id=<?php echo $post['post_id']; ?>"><img src="admin/upload/<?php echo $post['post_img']?>" alt=""/></a>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="inner-content clearfix">
                                                    <h3><a href='single.php?id=<?php echo $post['post_id']; ?>'><?php echo $post['title']?></a></h3>
                                                    <div class="post-information">
                                                        <span>
                                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                                            <a><?php echo $post['category_name']; ?></a>
                                                        </span>
                                                        <span>
                                                            <i class="fa fa-user" aria-hidden="true"></i>
                                                            <a href='author.php?author=<?php echo $post["user_id"]; ?>'><?php echo $post['username']; ?></a>
                                                        </span>
                                                        <span>
                                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            <?php echo $post['post_date']; ?>
                                                        </span>
                                                    </div>
                                                    <p class="description"><?php echo substr($post['description'], 0,130); ?>...</p>
                                                    <a class='read-more pull-right' href='single.php?id=<?php echo $post['post_id']?>'>read more</a>
                                                </div>
                                            </div>
                                        </div>
                                      <?php }
                                  }else{
                                      echo "No Post Found.";
                                  }
                              ?>
                        </div>
                        <ul class='pagination'>
                            <?php
                              $cat_id = $_GET['cat'];
                              $paginationQuery = "SELECT post.post_id, post.title, post.description, post.post_date, post.post_img, category.category_name, user.username FROM post LEFT JOIN category ON post.category=category.category_id LEFT JOIN user ON post.author=user.user_id WHERE category_id = {$cat_id}";
                              $paginationQResult = mysqli_query($conn,$paginationQuery);
                              if ($paginate = mysqli_num_rows($paginationQResult)) {
                                  $totalRecords = mysqli_num_rows($paginationQResult);
                                  $totalPages = ceil($totalRecords/$limit);
                                  if ($page > 1) { ?>
                                      <li><a href="category.php?cat=<?php echo $cat_id; ?>&page=<?php echo $page-1; ?>">Pre</a></li>
                                  <?php }
                                  for ($i=1; $i <=$totalPages; $i++) {
                                    if ($i==$page) {?>
                                      <li class="active"><a href="category.php?cat=<?php echo $user_id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php }else{?>
                                      <li><a href="category.php?cat=<?php echo $user_id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php }
                                  }
                                  if ($totalPages > $page) { ?>
                                      <li><a href="category.php?cat=<?php echo $cat_id; ?>&page=<?php echo $page+1; ?>">Next</a></li>
                                  <?php }
                              }
                            ?>
                        </ul>
                    </div><!-- /post-container -->
                </div>
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
