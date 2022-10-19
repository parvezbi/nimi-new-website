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
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                            $limit = 5;
                            if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                            }else{
                                $page = 1;
                            }
                            $offset = ($page-1)*$limit;
                            $allCate = "SELECT * FROM category ORDER BY category_id DESC LIMIT {$offset},{$limit}";
                            $allCateResult = mysqli_query($conn,$allCate) or die("Read Category Query Failed");
                            if (mysqli_num_rows($allCateResult)>0) {
                                while ($cate = mysqli_fetch_assoc($allCateResult)) { ?>
                                <tr>
                                    <td class='id'><?php echo $cate['category_id']; ?></td>
                                    <td><?php echo $cate['category_name']; ?></td>
                                    <td><?php echo $cate['post']; ?></td>
                                    <td class='edit'><a href='update-category.php?category=<?php echo $cate['category_id']?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-category.php?category=<?php echo $cate['category_id']?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                                <?php }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php 
                    $paginationQuery = "SELECT * FROM category";
                    $paginationQResult = mysqli_query($conn,$paginationQuery) or die("Category Pagination Failed");
                    if (mysqli_num_rows($paginationQResult)>0) {
                        $totalRecords = mysqli_num_rows($paginationQResult);
                        $totalPages = ceil($totalRecords/$limit);
                        echo "<ul class='pagination admin-pagination'>";
                        if ($page >1) {?>
                            <li><a href="category.php?page=<?php echo $page-1; ?>">Pre</a></li>
                        <?php }
                        for ($i=1; $i <= $totalPages ; $i++) {
                            if ($i == $page) { ?>
                                <li class="active"><a href="category.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php }else{ ?>
                                <li><a href="category.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php }
                        }
                        if ($totalPages > $page) {?>
                            <li><a href="category.php?page=<?php echo $page+1; ?>">Next</a></li>
                        <?php }
                        echo "</ul>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
