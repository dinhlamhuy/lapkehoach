<?php
session_start();
$conn = mysqli_connect("127.0.0.1", "root", "", "lapkehoach");
if (isset($_SESSION['current_user']) && !empty($_SESSION['current_user'])) {
    $nhanvien = $_SESSION['current_user'];
} else {
     $nhanvien  = '';
 
}
$sqlnv = mysqli_query($conn, "SELECT * FROM `nhanvien` WHERE `nv_ma`='" . $nhanvien['nv_ma'] . "'");
$rownvht = mysqli_fetch_assoc($sqlnv);
if (isset($_POST['id'])) {
    $ma = str_replace('dragtarget', '', $_POST['id']);
    $update = mysqli_query($conn, "UPDATE `kehoachcongviec` SET `khcv_tiendo`='Đang thực hiện' WHERE `khcv_ma`='$ma'");
    xulykhcvchacon($ma);
    
}
include_once __DIR__ . '/../pages/functions.php';

$tuan = timidtuan(date('Y-m-d'));
$kh = mysqli_query($conn, "SELECT * FROM `kehoachcongviec` INNER JOIN chitiet_khcv ON kehoachcongviec.khcv_ma=chitiet_khcv.khcv_ma WHERE `khcv_tiendo`='Đang thực hiện' AND `t_ma`='$tuan' AND `nv_thuchien` ='".$rownvht['nv_ma']."'");


$data = [];
while ($row = mysqli_fetch_array($kh, MYSQLI_ASSOC)) {
    $data[] = [
        'ma'        =>  $row['khcv_ma'],
        'noidung'   =>  $row['khcv_noidung'],
        'khcv_thoihanhoanthanh'   =>  $row['khcv_thoihanhoanthanh'],
        'trangthai'   =>  $row['khcv_tiendo']
    ];
}
foreach ($data as $dangthuchien) {
?>
 
    <div class="shadow-none p-2 w-100 mb-2 bg-light noidungcv rounded" ondragstart="dragStart(event)" draggable="true" id="dragtarget<?= $dangthuchien['ma'] ?>" disabled>
        <sup class="text-muted float-left mt-1"><b><?= 'CV'.sprintf('%03d',$dangthuchien['ma']) ?></b></sup> <sup class="text-muted mt-1 float-right"><?= $dangthuchien['khcv_thoihanhoanthanh'] ?></sup>
    <p class="float-none"><?= $dangthuchien['noidung'] ?></p>
</div>
<?php 
}
?>