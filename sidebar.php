<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
    <?php 
    $readPost = "SELECT post.post_id, post.title, post.post_date, post.post_img, category.category_name, category.category_id FROM post LEFT JOIN category ON post.category=category.category_id ORDER BY post.post_id DESC LIMIT 4";
    $readPostResult = mysqli_query($conn,$readPost);
    if (mysqli_num_rows($readPostResult)>0) {
        while ($post = mysqli_fetch_assoc($readPostResult)) {?>
        <div class="recent-post">
            <a class="post-img" href="">
                <img src="admin/upload/<?php echo $post['post_img']; ?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=<?php echo $post['post_id']; ?>"><?php echo $post['title']; ?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cat=<?php echo $post['category_id']; ?>'><?php echo $post['category_name']; ?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $post['post_date']; ?>
                </span>
                <a class="read-more" href="single.php?id=<?php echo $post['post_id']; ?>">read more</a>
            </div>
        </div>
        <?php }
    }
    ?>
    </div>
    <!-- /recent posts box -->
</div>
