<?php 

$ngaybatdau = $_POST['ngaybatdau'];
$ngayketthuc = $_POST['ngayketthuc'];
$tuandau = date('W', strtotime($ngaybatdau));
$tuancuoi = date('W', strtotime($ngayketthuc));
echo "Từ tuần: T" . $tuandau."/".date('Y', strtotime($ngaybatdau)) . " - T" . $tuancuoi."/".date('Y', strtotime($ngayketthuc));

?>