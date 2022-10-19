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
                    <h2 class="page-heading">
                      <?php
                       $search_term = $_GET['search'];
                       echo $search_term;
                      ?>  
                    </h2>
                    <!-- post-container -->
                    <div class="post-container">
                      <div class="post-content">
                          <?php
                              $search_term = $_GET['search'];
                              $limit = 3;
                              if (isset($_GET['page'])) {
                                  $page = $_GET['page'];
                              }else{
                                  $page = 1;
                              }
                              $offset = ($page-1)*$limit;
                              $readPost = "SELECT post.post_id, post.title, post.description, post.post_date, post.post_img, category.category_name, category.category_id, user.username, user.user_id FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post.title LIKE '%{$search_term}%' OR post.description LIKE '%{$search_term}%' LIMIT {$offset},{$limit}";
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
                                                            <a href='category.php?cat=<?php echo $post["user_id"]; ?>'><?php echo $post['category_name']; ?></a>
                                                        </span>
                                                        <span>
                                                            <i class="fa fa-user" aria-hidden="true"></i>
                                                            <a><?php echo $post['username']; ?></a>
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
                              $search_term = $_GET['search'];
                              $paginationQuery = "SELECT post.post_id, post.title, post.description, post.post_date, post.post_img, category.category_name, user.username FROM post LEFT JOIN category ON post.category=category.category_id LEFT JOIN user ON post.author=user.user_id WHERE post.title LIKE '%{$search_term}%' OR post.description LIKE '%{$search_term}%'";
                              $paginationQResult = mysqli_query($conn,$paginationQuery);
                              if ($paginate = mysqli_num_rows($paginationQResult)) {
                                  $totalRecords = mysqli_num_rows($paginationQResult);
                                  $totalPages = ceil($totalRecords/$limit);
                                  if ($page > 1) { ?>
                                      <li><a href="search.php?search=<?php echo $search_term; ?>&page=<?php echo $page-1; ?>">Pre</a></li>
                                  <?php }
                                  for ($i=1; $i <=$totalPages; $i++) {
                                    if ($i==$page) {?>
                                      <li class="active"><a href="search.php?search=<?php echo $search_term; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php }else{?>
                                      <li><a href="search.php?search=<?php echo $search_term; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php }
                                  }
                                  if ($totalPages > $page) { ?>
                                      <li><a href="search.php?search=<?php echo $search_term; ?>&page=<?php echo $page+1; ?>">Next</a></li>
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
