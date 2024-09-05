<?php require("../header.php");
require('/laragon/www/dulich/admin/sider.php');
require('/laragon/www/dulich/connection.php');
?>


<body>
    <div class="create-form " style="margin-left: 400px;">
        <form action="/admin/location/process.php" method="post" enctype="multipart/form-data">
            <div class="form-field">
                <input type="text" name="name" class="form-control" placeholder="Enter Name" id="">
            </div>
            <div class="form-field">
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-field ">
                <input type="submit" value="Submit" class="btn btn-primary" name="create">
            </div>
        </form>
    </div>

    <?php require("../footer.php") ?>