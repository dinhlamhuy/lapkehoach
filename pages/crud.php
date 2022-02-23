<?php
include_once __DIR__ . '/../database.php';
$pb_ma = (isset($_POST['pb_ma'])) ? $_POST['pb_ma'] : '';
$nv_ma = (isset($_POST['nv_ma'])) ? $_POST['nv_ma'] : '';
$nv_hoten = (isset($_POST['nv_hoten'])) ? $_POST['nv_hoten'] : '';
$nv_oldmatkhau = (isset($_POST['nv_oldmatkhau'])) ? md5($_POST['nv_oldmatkhau']) : '';
$nv_matkhau = (isset($_POST['nv_matkhau'])) ? md5($_POST['nv_matkhau']) : '';
$nv_ngaysinh = (isset($_POST['nv_ngaysinh'])) ? $_POST['nv_ngaysinh'] : '';
$nv_gioitinh = (isset($_POST['nv_gioitinh'])) ? $_POST['nv_gioitinh'] : '';
$nv_email = (isset($_POST['nv_email'])) ? $_POST['nv_email'] : '';
$nv_sdt = (isset($_POST['nv_sdt'])) ? $_POST['nv_sdt'] : '';
$nv_chucvu = (isset($_POST['nv_chucvu'])) ? $_POST['nv_chucvu'] : '';
$nv_diachi = (isset($_POST['nv_diachi'])) ? $_POST['nv_diachi'] : '';
$nv_anhdaidien = (isset($_FILES['nv_anhdaidien']['name'])) ? $_FILES['nv_anhdaidien']['name'] : '';


$check = mysqli_query($conn, "SELECT * FROM `nhanvien` INNER JOIN `phongban` ON nhanvien.pb_ma=phongban.pb_ma WHERE `nv_ma`<>'$nv_ma' AND `nv_hoten`='$nv_hoten' AND `nv_email`='$nv_email' AND `nv_sdt`='$nv_sdt' ");
$data = [];
if (mysqli_num_rows($check) > 0) {
    $data[] = ['alert'  =>   'error:Nhân viên đã tồn tại!'];
} else {
    $hinh = mysqli_query($conn, "SELECT * FROM `nhanvien` WHERE `nv_ma`='$nv_ma'");
    $showhinh = mysqli_fetch_assoc($hinh);
    $allowed = array("" => "nv_anhdaidien/", "jpg" => "nv_anhdaidien/jpg", "jpeg" => "nv_anhdaidien/jpeg", "gif" => "nv_anhdaidien/gif", "png" => "nv_anhdaidien/png");

    if (empty($nv_anhdaidien)) {
        $newname = $showhinh['nv_anhdaidien'];
    } else {
        $extension = pathinfo($nv_anhdaidien, PATHINFO_EXTENSION);
        $randomno = rand(0, 100000);
        $rename = 'nhanvien' . date('Ymd') . $randomno;
        $newname = $rename . '.' . $extension;

        if (!array_key_exists($extension, $allowed)) {
            $error = "File không đúng định dạng";
        } else {
            move_uploaded_file($_FILES['nv_anhdaidien']['tmp_name'], '../assets/img/nhanvien/' . $newname);
            if (empty($showhinh['nv_anhdaidien'])) {
            } else {

                unlink('../assets/img/nhanvien/' . $showhinh['nv_anhdaidien']);
            }
        }
    }
    if (empty($nv_matkhau) && empty($nv_oldmatkhau)) {
        $sql = "UPDATE `nhanvien` SET `pb_ma`='$pb_ma', `nv_hoten`='$nv_hoten', `nv_ngaysinh`='$nv_ngaysinh',`nv_gioitinh`='$nv_gioitinh',`nv_anhdaidien`='$newname',`nv_sdt`='$nv_sdt',`nv_diachi`='$nv_diachi',`nv_chucvu`='$nv_chucvu' WHERE `nv_ma`='$nv_ma'";
    } else {
        if ($nv_oldmatkhau != $showhinh['nv_matkhau']) {
            $data[] = [
                'alert'  =>   'error:Mật khẩu cũ không đúng!',
            ];
        } else {

            $sql = "UPDATE `nhanvien` SET `pb_ma`='$pb_ma', `nv_hoten`='$nv_hoten', `nv_ngaysinh`='$nv_ngaysinh',`nv_gioitinh`='$nv_gioitinh',`nv_matkhau`='$nv_matkhau',`nv_anhdaidien`='$newname',`nv_sdt`='$nv_sdt',`nv_diachi`='$nv_diachi',`nv_chucvu`='$nv_chucvu' WHERE `nv_ma`='$nv_ma'";
        }
    }
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $data[] = ['alert'  =>   'success:Cập nhật nhân viên thành công'];
    } else {
        $data[] = [
            'alert'  =>   'error:Cập nhật nhân viên thất bại!',];
    }


}
print json_encode($data, JSON_UNESCAPED_UNICODE);
