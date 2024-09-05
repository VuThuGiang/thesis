<?php require('/laragon/www/dulich/connection.php') ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripBoss</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/edit_user.css">
    <link rel="stylesheet" href="/assets/css/des.css">
    <link rel="stylesheet" href="/assets/css/tourpackage.css">
    <link rel="stylesheet" href="/assets/css/user_orders.css">
    <link rel="stylesheet" href="/assets/css/wishlist.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/tour_detail.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .navbar .dropdown-toggle::after {
            display: none;
        }

        .dropdown-menu.show {
            display: block;
        }

        .navbar .nav-link img {
            width: 40px;
            /* Adjust this value to make the image larger or smaller */
            height: 40px;
            /* Adjust this value to make the image larger or smaller */
            border-radius: 50%;
        }
    </style>
</head>
<?php session_start(); ?>

<nav class="navbar navbar-expand-lg" style="height: 80px">
    <div class="container-fluid">
        <a class="navbar-brand" href="/index.php" style="font-size: 30px; "><span>TripBoss</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav" style="margin-right: 100px;">
            <ul class="navbar-nav ms-auto" style="font-weight: bold;">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/about.php">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/destination.php">Destination</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/tourpackage.php">Tour Package</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/contact.php">Contact</a>
                </li>

                <li class="nav-item dropdown">
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        $user_id = $_SESSION['uid'];

                        $sql = "SELECT img FROM user_form WHERE id='$user_id'";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $_SESSION['avatar'] = "/assets/img/profile/" . $row['img'];
                        } else {
                        }
                        $avatar_url = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : '/assets/img/profile/default_image.jpg';
                        echo <<<data
                            <a class='nav-link dropdown-toggle' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false' style='padding-right: 0;'>
                            <img src='$avatar_url' alt='Avatar'>
                            </a>

                            <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                            <li><a class='dropdown-item' href='/pages/edit_user.php'>Edit Profile</a></li>
                            <li><a class='dropdown-item' href='/pages/wishlist.php'>Wishlist</a></li>
                            <li><a class='dropdown-item' href='/pages/user_orders.php'>Order</a></li>
                            <li><a class='dropdown-item' href='/pages/logout.php'>Logout</a></li>

                            </ul>
                        data;
                    } else {
                        echo "
    <a type='button' href='/pages/login.php' class='btn btn-brand ms-lg-2' name='login' style='font-weight: 500; color: #ffdd00; background-color: white;'>LOGIN</a>
    <a type='button' href='/pages/register.php' class='btn btn-brand ms-lg-2' name='register' style='font-weight: 500; color: #ffdd00; background-color: white;'>REGISTER</a>";
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>