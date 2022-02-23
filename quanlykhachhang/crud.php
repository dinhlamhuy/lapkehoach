<?php
include_once __DIR__ . '/../database.php';
$kh_ma = (isset($_POST['kh_ma'])) ? $_POST['kh_ma'] : '';
$kh_ten = (isset($_POST['kh_ten'])) ? $_POST['kh_ten'] : '';
$kh_sdt = (isset($_POST['kh_sdt'])) ? $_POST['kh_sdt'] : '';
$kh_email = (isset($_POST['kh_email'])) ? $_POST['kh_email'] : '';
$kh_diachi = (isset($_POST['kh_diachi'])) ? $_POST['kh_diachi'] : '';
$option = (isset($_POST['option'])) ? $_POST['option'] : '';
$i=1;
switch ($option) {
    case 1:
        $check = mysqli_query($conn, "SELECT * FROM `khachhang` WHERE `kh_ten`='$kh_ten'");
        $data = [];

        if (mysqli_num_rows($check) > 0) {
            $data[] = ['alert'  =>   'error:Khách hàng đã tồn tại!'];
        } else {
            $sql = "INSERT INTO `khachhang`(`kh_ten`, `kh_sdt`, `kh_email`, `kh_diachi`) VALUES('$kh_ten', '$kh_sdt', '$kh_email', '$kh_diachi') ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $data[] = ['alert'  =>   'success:Thêm khách hàng mới thành công'];
            } else {
                $data[] = ['alert'  =>   'error:Thêm khách hàng thất bại!'];
            }
            $sql = "SELECT * FROM khachhang ORDER BY kh_ma DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $data[] = [
                    'alert' =>  '',
                    'kh_stt' =>  $i++,
                    'kh_id' =>  $row['kh_ma'],
                    'kh_ma' =>  '<div class="makhachhang" data-id="' . $row['kh_ma'] . '" >KH' . sprintf('%03d', $row['kh_ma']) . '</div>',
                    'kh_ten' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_ten'] . '</div>',
                    'kh_sdt' =>  '<div class="sdtkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_sdt'] . '</div>',
                    'kh_email' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_email'] . '</div>',
                    'kh_diachi' =>  '<div class="diachikhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_diachi'] . '</div>',
                ];
            }
        }
        break;
    case 2:
        // `kh_sdt`='$kh_sdt' AND `kh_email`='$kh_email' AND `kh_diachi`='$kh_diachi'
        $check = mysqli_query($conn, "SELECT * FROM `khachhang` WHERE `kh_ten`='$kh_ten' AND `kh_ma`<>'$kh_ma'");
        $data = [];
        if (mysqli_num_rows($check) > 0) {
            $data[] = ['alert'  =>   'error:Khách hàng đã tồn tại!'];
        } else {
            $sql = "UPDATE khachhang SET kh_ten='$kh_ten', `kh_sdt`='$kh_sdt',`kh_email`='$kh_email',`kh_diachi`='$kh_diachi' WHERE kh_ma='$kh_ma' ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $data[] = ['alert'  =>   'success:Cập nhật khách hàng mới thành công'];
            } else {
                $data[] = ['alert'  =>   'error:Cập nhật khách hàng thất bại!'];
            }

            $sql = "SELECT * FROM khachhang WHERE kh_ma='$kh_ma' ";
            $result = mysqli_query($conn, $sql);


            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $data[] = [
                    'alert' =>  '',
                    'kh_stt' =>  $i++,
                    'kh_id' =>  $row['kh_ma'],
                    'kh_ma' =>  '<div class="makhachhang" data-id="' . $row['kh_ma'] . '" >KH' . sprintf('%03d', $row['kh_ma']) . '</div>',
                    'kh_ten' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_ten'] . '</div>',
                    'kh_sdt' =>  '<div class="sdtkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_sdt'] . '</div>',
                    'kh_email' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_email'] . '</div>',
                    'kh_diachi' =>  '<div class="diachikhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_diachi'] . '</div>',
                ];
            }
        }
        break;
    case 3:
        $data = [];
        $sql = "DELETE FROM khachhang WHERE kh_ma='$kh_ma' ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $data[] = ['alert'  =>   'success:Xóa khách hàng thành công'];
        } else {
            $data[] = ['alert'  =>   'error:Xóa khách hàng thất bại!'];
        }
        $sql = "SELECT * FROM khachhang WHERE `kh_ma`='$kh_ma' ";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = [

                'alert' =>  '',
                'kh_stt' =>  $i++,
                'kh_id' =>  $row['kh_ma'],
                'kh_ma' =>  '<div class="makhachhang" data-id="' . $row['kh_ma'] . '" >KH' . sprintf('%03d', $row['kh_ma']) . '</div>',
                'kh_ten' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_ten'] . '</div>',
                'kh_sdt' =>  '<div class="sdtkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_sdt'] . '</div>',
                'kh_email' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_email'] . '</div>',
                'kh_diachi' =>  '<div class="diachikhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_diachi'] . '</div>',
            ];
        }
        break;
    case 4:
        $sql = "SELECT * FROM `khachhang`";
        $result = mysqli_query($conn, $sql);
        $i = 1;
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = [
                'alert' =>  '',
                'kh_stt' =>  $i++,
                'kh_id' =>  $row['kh_ma'],
                'kh_ma' =>  '<div class="makhachhang" data-id="' . $row['kh_ma'] . '" >KH' . sprintf('%03d', $row['kh_ma']) . '</div>',
                'kh_ten' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_ten'] . '</div>',
                'kh_sdt' =>  '<div class="sdtkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_sdt'] . '</div>',
                'kh_email' =>  '<div class="tenkhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_email'] . '</div>',
                'kh_diachi' =>  '<div class="diachikhachhang" data-id="' . $row['kh_ma'] . '" >' . $row['kh_diachi'] . '</div>',

            ];
        }
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conn = null;
