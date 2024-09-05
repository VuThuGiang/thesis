<?php
require('/laragon/www/dulich/admin/header.php');
require('/laragon/www/dulich/admin/sider.php');
?>

<body>
    <div class="post" style="margin-left: 400px ;">
        <?php
        $id = $_GET["id"];
        if ($id) {
            include("/laragon/www/dulich/connection.php");
            $sqlSelectPost = "SELECT * FROM `location` WHERE id = $id";
            $result = mysqli_query($con, $sqlSelectPost);
            while ($data = mysqli_fetch_array($result)) {
        ?>
                <h1>Location name: <?php echo $data['name']; ?></h1>
                <?php if (!empty($data['image_url'])) : ?>
                    <img src="/admin/anh/<?php echo $data['image_url']; ?>" alt="Post Image" style="max-width: 100%; height:auto;">
                <?php endif; ?>
        <?php
            }
        } else {
            echo "Post Not Found";
        }
        ?>
    </div>
</body>



<?php require("../footer.php") ?>