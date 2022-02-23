<?php
  session_start();
  unset($_SESSION['current_user']);
  echo '<script> window.location.href = "../index.php"; alert ("Đăng xuất thành công");  </script>';
?>