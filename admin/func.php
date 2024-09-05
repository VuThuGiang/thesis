<!-- chan dan link lung tung -->
<?php
function login(){
    session_start();
    if(!(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) ){
        echo " 
        <script> 
        window.location.href= 'login.php';
        </script>
        ";
    }
};
