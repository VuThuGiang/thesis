<?php
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrQkTyf08lPg0be3RwHzMxf6N9hA6O2W/pU1T2nMDc1K5Tc7osQbP1hlo6u8s5p8SzPZq8TkfRvXlX0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .alert {
            padding: 15px;
            margin: 20px 0;
            border: 1px solid transparent;
            border-radius: 4px;
            position: relative;
            width: 90%;
            max-width: 300px;
            text-align: center;
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
            margin-left: auto;
            margin-right: 40px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .search-box {
            margin-top: 25px;
            margin-right: 400px;
        }

        .search-box input {
            width: 200px;
            padding: 5px;
        }

        .search-box button {
            padding: 5px 10px;
        }

        .action-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-left: 35px;
            margin-top: 25px;
        }

        .btn-add {
            margin-left: -35px;
            margin-top: 25px;
        }

        .searchh {
            background-color: #41a728;
            color: #fff;
            border: none;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: pink;
            border: 1px solid #ddd;
            padding: 8px 16px;
            text-decoration: none;
            margin: 0 4px;
            border-radius: 5px;
        }

        .pagination a.active {
            background-color: pink;
            color: white;
            border: 1px solid pink;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>

<body>

    <div class="posts-list" style="margin-left: 330px; width: 95%;">
        <h2>List Of Blogs</h2>
        <?php
            // Kiểm tra nếu có tham số 'msg' và hiển thị thông báo tương ứng
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'deleted') {
                    echo '<div class="alert alert-success">Deleted successfully!</div>';
                } elseif ($_GET['msg'] == 'created') {
                    echo '<div class="alert alert-success">Created successfully!</div>';
                } elseif ($_GET['msg'] == 'updated') {
                    echo '<div class="alert alert-success">Updated successfully!</div>';
                }

                // Loại bỏ 'msg' khỏi URL sau khi hiển thị
                echo '<script>
                if (typeof window.history.replaceState === "function") {
                    var url = window.location.href.replace(window.location.search, "");
                    window.history.replaceState({}, "", url);
                }
                </script>';
            }
        ?>
        <div class="action-bar">
            <a href="/admin/blog/create.php" class="btn-add">Add new blog</a>
            <div class="search-box">
                <form action="" method="GET">
                    <input type="text" name="location" placeholder="Search by location" value="<?php echo htmlspecialchars(isset($_GET['location']) ? $_GET['location'] : ''); ?>">
                    <button type="submit" class="searchh">Search</button>
                </form>
            </div>
        </div>

        <table class="table table-bordered" style="margin-top: 20px; width: 80%;">
            <thead>
                <tr>
                    <th>Id</th>
                    <th style="width: 2%;">Date</th>
                    <th style="width: 15%;">Title</th>
                    <th style="width: 40%;">Content</th>
                    <th style="width: 9%;">Image</th>
                    <th style="width: 9%;">Locations</th>
                    <th style="width: 3%;">Views</th> <!-- Thêm cột Views -->
                    <th style="width: 39%;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('/laragon/www/dulich/connection.php');

                // Pagination logic
                $limit = 10; // Number of entries to show in a page.
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = ($page - 1) * $limit;

                $location = isset($_GET['location']) ? $_GET['location'] : '';
                $sqlInsert = "SELECT blog.*, GROUP_CONCAT(location.name SEPARATOR ', ') as locations 
                              FROM blog
                              LEFT JOIN location_blog ON blog.id = location_blog.blog_id
                              LEFT JOIN location ON location_blog.location_id = location.id";
                if ($location != '') {
                    $sqlInsert .= " WHERE location.name LIKE '%" . mysqli_real_escape_string($con, $location) . "%'";
                }
                $sqlInsert .= " GROUP BY blog.id ORDER BY locations ASC LIMIT $start, $limit"; // Sắp xếp theo tên tỉnh

                $result = mysqli_query($con, $sqlInsert);
                $i = $start + 1;
                while ($data = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data["date"] ?></td>
                        <td><?php echo $data["title"] ?></td>
                        <td><?php echo $data["summary"] ?></td>

                        <td>
                            <img src="/admin/anh/<?php echo $data['image_url']; ?>" style="width: 80px; height: 60px;">
                        </td>
                        <td><?php echo $data["locations"] ?></td>
                        <td><?php echo $data["views"]; ?></td> <!-- Hiển thị số lượt xem -->
                        <td>
                            <a href="view.php?id=<?php echo $data["id"] ?>" class="btn btn-view">View</a>
                            <a href="edit.php?id=<?php echo $data["id"] ?>" class="btn btn-edit">Edit</a>
                            <a href="delete.php?id=<?php echo $data["id"] ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php
                }
                ?>

            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            // Calculate total pages
            $sqlTotal = "SELECT COUNT(DISTINCT blog.id) as total 
                         FROM blog
                         LEFT JOIN location_blog ON blog.id = location_blog.blog_id
                         LEFT JOIN location ON location_blog.location_id = location.id";
            if ($location != '') {
                $sqlTotal .= " WHERE location.name LIKE '%" . mysqli_real_escape_string($con, $location) . "%'";
            }

            $resultTotal = mysqli_query($con, $sqlTotal);
            $rowTotal = mysqli_fetch_assoc($resultTotal);
            $total = $rowTotal['total'];
            $totalPages = ceil($total / $limit);

            $queryParams = $_GET;
            for ($i = 1; $i <= $totalPages; $i++) {
                $queryParams['page'] = $i;
                $queryStr = http_build_query($queryParams);
                echo "<a href='?$queryStr' class='" . ($i == $page ? "active" : "") . "'>$i</a>";
            }
            ?>
        </div>
    </div>

    <script src="../assets/js/blog.js"></script>
</body>

<?php require("../footer.php") ?>
