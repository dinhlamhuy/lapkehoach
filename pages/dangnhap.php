<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/logo.png" type="image/png">
   <link rel="stylesheet" href="../assets/css/dangnhap.css">
   <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="../vendor/font-awesome-4/css/font-awesome.min.css">
    <title>Đăng nhập</title>

</head>
<body>
<div class="loading" id="loading" >
            <img src="https://thumbs.gfycat.com/HighCorruptIsabellineshrike-max-1mb.gif" alt="loading">
        </div>
<?php
session_start();
include_once __DIR__ .'/../database.php';

$error = false;
if (isset($_POST['ten_tk']) && !empty($_POST['ten_tk']) && isset($_POST['mk']) && !empty($_POST['mk'])) {
    $result = mysqli_query($conn, "SELECT * FROM `nhanvien` WHERE (`nv_email`='" . $_POST['ten_tk'] . "' AND `nv_matkhau` =md5('" . $_POST['mk'] . "')) ");
    if (!$result) {
        $error = mysqli_error($conn);
    } else {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['current_user'] = $user;
    }
    mysqli_close($conn);
    if ($error !== false || $result->num_rows == 0) {
?>

        <div class="card" style="padding: 20px 200px; background-color:#320d0d; color:white;">
            <div class="card-body">

                <h1>Thông báo</h1>
                <h4><?= !empty($error) ? $error : "Thông tin đăng nhập không chính xác" ?></h4>
                <a href="./dangnhap.php">Quay lại</a>
            </div>
        </div>

    <?php
        exit;
    }
    ?>
<?php } ?>
<?php
if (empty($_SESSION['current_user'])) { ?>
   
    <div class="box-content" id="box">
        <form class="box" action="" method="POST" >
          
            <h1 style="margin-top:-40px;"><i class="fa fa-user-o iconusr"  aria-hidden="true"></i></h1>
            <h1><b><i>Đăng nhập</i></b></h1>
            <input type="text" name="ten_tk" placeholder="Email" maxlength="40" value="">
            <input type="password" id="pwd" name="mk" placeholder="Mật khẩu" maxlength="16" value="">
            <input type="checkbox" onclick="myFunction()"><span>Hiện mật khẩu</span>
            <input type="submit" id="btn_submit" value="Đăng nhập">
        </form>
    </div>
<?php
} else {
    $currentUser =  $_SESSION['current_user'];
    echo '<script> window.location.href = "../index.php";</script>';
}
?>

</body>
<script>
    function myFunction() {
        var x = document.getElementById("pwd");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
 
</script>

</html>