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
                            $post_id = $_GET['id'];
                            $readPost = "SELECT post.post_id, post.title, post.description, post.post_date, post.post_img, category.category_id, category.category_name, user.user_id, user.username FROM post LEFT JOIN category ON post.category=category.category_id LEFT JOIN user ON post.author=user.user_id WHERE post_id = {$post_id}";
                            $readPostResult = mysqli_query($conn,$readPost);
                            if (mysqli_num_rows($readPostResult)>0) {
                                while ($post = mysqli_fetch_assoc($readPostResult)) { ?>
                                <div class="post-content single-post">
                                    <h3><?php echo $post['title']; ?></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href="category.php?cat=<?php echo $post['category_id']; ?>"><?php echo $post['category_name']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?author=<?php echo $post['user_id']; ?>'><?php echo $post['username']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $post['post_date']; ?>
                                        </span>
                                    </div>
                                    <img class="single-feature-image" src="admin/upload/<?php echo $post['post_img']?>" alt=""/>
                                    <p class="description"><?php echo $post['description']; ?></p>
                                </div>
                                <?php }
                            }
                        ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
