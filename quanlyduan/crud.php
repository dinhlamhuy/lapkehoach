<?php
include_once __DIR__ . '/../database.php';
$kh_ma = (isset($_POST['kh_ma'])) ? $_POST['kh_ma'] : '';
$da_ma = (isset($_POST['da_ma'])) ? $_POST['da_ma'] : '';
$da_ten = (isset($_POST['da_ten'])) ? $_POST['da_ten'] : '';
$da_thoihan = (isset($_POST['da_thoihan'])) ? $_POST['da_thoihan'] : '';
$da_trangthai = (isset($_POST['da_trangthai'])) ? $_POST['da_trangthai'] : '';
$i=1;
$option = (isset($_POST['option'])) ? $_POST['option'] : '';
switch ($option) {
    case 1:
        $check = mysqli_query($conn, "SELECT * FROM `duan` INNER JOIN `khachhang` ON duan.kh_ma=khachhang.kh_ma WHERE `da_ten`='$da_ten'");
        $data = [];

        if (mysqli_num_rows($check) > 0) {
            $data[] = ['alert'  =>   'error:Dự án đã tồn tại!'];
        } else {
            $sql = "INSERT INTO `duan`(`da_ten`, `da_thoihan`, `da_trangthai`, `kh_ma`) VALUES('$da_ten', '$da_thoihan', '$da_trangthai', '$kh_ma') ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $data[] = ['alert'  =>   'success:Thêm Dự án mới thành công'];
            } else {
                $data[] = ['alert'  =>   'error:Thêm Dự án thất bại!'];
            }
            $sql = "SELECT * FROM `duan` INNER JOIN `khachhang` ON duan.kh_ma=khachhang.kh_ma ORDER BY da_ma DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $data[] = [
                    'alert' =>  '',
                    'da_stt' =>  $i++,
                    'da_id' =>  $row['da_ma'],
                    'kh_ma' =>  '<div class="makhachhang" data-id="' . $row['kh_ma'] . '" >KH' . sprintf('%03d', $row['kh_ma']) . '</div>',
                    'kh_ten' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_ten'] . '</div>',
                    'kh_sdt' =>  '<div class="sdtkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_sdt'] . '</div>',
                    'kh_email' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_email'] . '</div>',
                    'kh_diachi' =>  '<div class="diachikhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_diachi'] . '</div>', 
                    'da_ma' =>  '<div class="maduan" data-id="' . $row['kh_ma'] . '" >DA' . sprintf('%03d', $row['da_ma']) . '</div>',
                    'da_ten' =>  '<div class="tenduan" data-id="' . $row['kh_ma'] . '" >' . $row['da_ten'] . '</div>', 
                    'da_thoihan' =>  '<div class="thoihanduan" data-id="' . $row['kh_ma'] . '" >' . $row['da_thoihan'] . '</div>', 
                    'da_trangthai' =>  '<div class="trangthaiduan" data-id="' . $row['kh_ma'] . '" >' . $row['da_trangthai'] . '</div>',
                ];
            }
        }
        break;
    case 2:
        // `kh_sdt`='$kh_sdt' AND `kh_email`='$kh_email' AND `kh_diachi`='$kh_diachi'
        $check = mysqli_query($conn, "SELECT * FROM `duan` INNER JOIN `khachhang` ON duan.kh_ma=khachhang.kh_ma WHERE `da_ma`<>'$da_ma' AND `da_ten`='$da_ten' AND duan.kh_ma='$kh_ma'");
        $data = [];
        if (mysqli_num_rows($check) > 0) {
            $data[] = ['alert'  =>   'error:Dự án đã tồn tại!'];
        } else {
            $sql = "UPDATE `duan` SET `da_ten`='$da_ten', `kh_ma`='$kh_ma',`da_thoihan`='$da_thoihan',`da_trangthai`='$da_trangthai' WHERE `da_ma`='$da_ma'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $data[] = ['alert'  =>   'success:Cập nhật dự án mới thành công'];
            } else {
                $data[] = ['alert'  =>   'error:Cập nhật dự án thất bại!'];
            }

            $sql = "SELECT * FROM `duan` INNER JOIN `khachhang` ON duan.kh_ma=khachhang.kh_ma WHERE `da_ma`='$da_ma' ";
            $result = mysqli_query($conn, $sql);


            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $data[] = [
                    'alert' =>  '',
                'da_stt' =>  $i++,
                'da_id' =>  $row['da_ma'],
                'kh_ma' =>  '<div class="makhachhang" data-id="' . $row['kh_ma'] . '" >KH' . sprintf('%03d', $row['kh_ma']) . '</div>',
                'kh_ten' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_ten'] . '</div>',
                'kh_sdt' =>  '<div class="sdtkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_sdt'] . '</div>',
                'kh_email' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_email'] . '</div>',
                'kh_diachi' =>  '<div class="diachikhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_diachi'] . '</div>', 
                'da_ma' =>  '<div class="maduan" data-id="' . $row['kh_ma'] . '" >DA' . sprintf('%03d', $row['da_ma']) . '</div>',
                'da_ten' =>  '<div class="tenduan" data-id="' . $row['kh_ma'] . '" >' . $row['da_ten'] . '</div>', 
                'da_thoihan' =>  '<div class="thoihanduan" data-id="' . $row['kh_ma'] . '" >' . $row['da_thoihan'] . '</div>', 
                'da_trangthai' =>  '<div class="trangthaiduan" data-id="' . $row['kh_ma'] . '" >' . $row['da_trangthai'] . '</div>',
                ];
            }
        }
        break;
    case 3:
        $data = [];
        $sql = "DELETE FROM duan WHERE da_ma='$da_ma' ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $data[] = ['alert'  =>   'success:Xóa dự án thành công'];
        } else {
            $data[] = ['alert'  =>   'error:Xóa dự án thất bại!'];
        }
        $sql = "SELECT * FROM `duan` INNER JOIN `khachhang` ON duan.kh_ma=khachhang.kh_ma WHERE `da_ma`='$da_ma' ";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = [

                'alert' =>  '',
                'da_stt' =>  $i++,
                'da_id' =>  $row['da_ma'],
                'kh_ma' =>  '<div class="makhachhang" data-id="' . $row['kh_ma'] . '" >KH' . sprintf('%03d', $row['kh_ma']) . '</div>',
                'kh_ten' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_ten'] . '</div>',
                'kh_sdt' =>  '<div class="sdtkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_sdt'] . '</div>',
                'kh_email' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_email'] . '</div>',
                'kh_diachi' =>  '<div class="diachikhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_diachi'] . '</div>', 
                'da_ma' =>  '<div class="maduan" data-id="' . $row['kh_ma'] . '" >DA' . sprintf('%03d', $row['da_ma']) . '</div>',
                'da_ten' =>  '<div class="tenduan" data-id="' . $row['kh_ma'] . '" >' . $row['da_ten'] . '</div>', 
                'da_thoihan' =>  '<div class="thoihanduan" data-id="' . $row['kh_ma'] . '" >' . $row['da_thoihan'] . '</div>', 
                'da_trangthai' =>  '<div class="trangthaiduan" data-id="' . $row['kh_ma'] . '" >' . $row['da_trangthai'] . '</div>',
            ];
        }
        break;
    case 4:
        $sql = "SELECT * FROM `duan` INNER JOIN `khachhang` ON duan.kh_ma=khachhang.kh_ma";
        $result = mysqli_query($conn, $sql);
        $i = 1;
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = [
                'alert' =>  '',
                'da_stt' =>  $i++,
                'da_id' =>  $row['da_ma'],
                'kh_ma' =>  '<div class="makhachhang" data-id="' . $row['kh_ma'] . '" >KH' . sprintf('%03d', $row['kh_ma']) . '</div>',
                'kh_ten' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_ten'] . '</div>',
                'kh_sdt' =>  '<div class="sdtkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_sdt'] . '</div>',
                'kh_email' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_email'] . '</div>',
                'kh_diachi' =>  '<div class="diachikhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_diachi'] . '</div>', 
                'da_ma' =>  '<div class="maduan" data-id="' . $row['kh_ma'] . '" >DA' . sprintf('%03d', $row['da_ma']) . '</div>',
                'da_ten' =>  '<div class="tenduan" data-id="' . $row['kh_ma'] . '" >' . $row['da_ten'] . '</div>', 
                'da_thoihan' =>  '<div class="thoihanduan" data-id="' . $row['kh_ma'] . '" >' . $row['da_thoihan'] . '</div>', 
                'da_trangthai' =>  '<div class="trangthaiduan" data-id="' . $row['kh_ma'] . '" >' . $row['da_trangthai'] . '</div>', 
                


            ];
        }
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conn = null;
