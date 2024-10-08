<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            font-family: 'Times New Roman', Times, serif
        }

        form {
            background-color: gray;
            width: 350px;
            border-radius: 5px;
            padding: 20px 25px 30px 25px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        form h3 {
            margin-bottom: 15px;
            color: #30475e;
        }

        form input {
            width: 100%;
            margin-bottom: 20px;
            background-color: transparent;
            border: none;
            padding: 5px 0;
            font-weight: 550;
            font-size: 16px;
            outline: none;
        }

        form button {
            font-weight: 550;
            font-size: 16px;
            background-color: #30475e;
            color: white;
            padding: 4px 10px;
            border: none;
            outline: none;
            margin-top: 5px;

        }
    </style>
</head>

<body>
    <?php
    require("/laragon/www/dulich/connection.php");

    if (isset($_GET['email']) && isset($_GET['reset_token'])) {
        date_default_timezone_set('Asia/kolkata');
        $date = date("Y-m-d");
        $query = "SELECT * FROM `user_form` WHERE `email`='$_GET[email]' AND `resettoken`='$_GET[reset_token]' AND `resettokenexpired`='$date'";
        $result = mysqli_query($con, $query);
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                echo "
                <form method='POST'>
                    <h3>Create New Password</h3>
                    <input type='password' placeholder='New Password' name='Password'>
                    <button type='submit' name='updatepassword'>UPDATE</button>
                    <input type='hidden' name='email' value='$_GET[email]'>
                </form>";
            } else {
                echo "
                <script>
                    alert('Invalid or Expired Link');
                    window.location.href='/index.php'
                </script>
                ";
            }
        } else {
            echo "
            <script>
                alert('Cannot run query');
                window.location.href='/index.php'
            </script>
            ";
        }
    }
    ?>


    <?php

    if (isset($_POST['updatepassword']))
    {
        $pass = password_hash($_POST['Password'],PASSWORD_BCRYPT);
        $update = "UPDATE `user_form` SET `password`='$pass',`resettoken`=NULL,`resettokenexpired`=NULL WHERE `email`='$_POST[email]'";

        if(mysqli_query($con,$update)){
            echo "
                <script>
                    alert('pass updated successful');
                    window.location.href='/index.php'
                </script>
                ";
        }
        else
        {
            echo "
                <script>
                    alert('server down, try again');
                    window.location.href='/index.php'
                </script>
                ";
        }
    }
    ?>
</body>

</html>