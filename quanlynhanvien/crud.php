<?php
include_once __DIR__ . '/../database.php';
include_once __DIR__ . '/../pages/functions.php';

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
$i = 1;
$nv_chinhsua = (isset($_POST['nv_chinhsua'])) ? $_POST['nv_chinhsua'] : '';

$option = (isset($_POST['option'])) ? $_POST['option'] : '';
switch ($option) {
    case 1:
        // `nv_ten`='$nv_ten' AND `nv_sdt`='$nv_sdt' AND `nv_email`='$nv_email'
        $check = mysqli_query($conn, "SELECT * FROM `nhanvien` INNER JOIN `phongban` ON phongban.pb_ma=nhanvien.pb_ma WHERE  `nv_hoten`='$nv_hoten'  AND `nv_email`='$nv_email' ");
        $data = [];

        if (mysqli_num_rows($check) > 0) {
            $data[] = ['alert'  =>   'error:Nhân viên đã tồn tại!'];
        } else {
            if(!empty($nv_anhdaidien)){
                $allowed = array("" => "nv_anhdaidien/", "jpg" => "nv_anhdaidien/jpg", "jpeg" => "nv_anhdaidien/jpeg", "gif" => "nv_anhdaidien/gif", "png" => "nv_anhdaidien/png");
                $extension = pathinfo($nv_anhdaidien, PATHINFO_EXTENSION);
                $randomno = rand(0, 100000);
                $rename = 'nhanvien' . date('Ymd') . $randomno;
                $newname = $rename . '.' . $extension;
                
            }else {
                $newname = '';

            }
            $sql = "INSERT INTO `nhanvien`(`nv_hoten`, `nv_ngaysinh`, `nv_gioitinh`, `nv_email`, `nv_matkhau`, `nv_anhdaidien`, `nv_sdt`, `nv_diachi`, `nv_chucvu`, `pb_ma`) VALUES ('$nv_hoten','$nv_ngaysinh', '$nv_gioitinh','$nv_email','$nv_matkhau','$newname','$nv_sdt','$nv_diachi','$nv_chucvu','$pb_ma')";
            $result = mysqli_query($conn, $sql);
            add_new_history('Thêm nhân viên mới', 'NV' . sprintf('%03d', $nv_chinhsua) . ' Đã thêm nhân viên mới có mã NV' . sprintf('%03d', $nv_ma) . '', $nv_chinhsua, NULL);
            if ($result) {
                move_uploaded_file($_FILES['nv_anhdaidien']['tmp_name'], '../assets/img/nhanvien/' . $newname);
                $data[] = ['alert'  =>   'success:Thêm nhân viên mới thành công'];
            } else {
                $data[] = ['alert'  =>   'error:Thêm nhân viên thất bại!'];
            }

            $sql = "SELECT * FROM `nhanvien` INNER JOIN `phongban` ON phongban.pb_ma=nhanvien.pb_ma WHERE `nv_tinhtrang`<>'Đã nghỉ việc' ORDER BY nhanvien.nv_ma DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $data[] = [
                    'alert' =>  '',
                    'nv_stt' =>  $i++,
                    'nv_ma' =>  '<div class="manhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >NV' . sprintf('%03d', $row['nv_ma']) . '</div>',
                    'nv_hoten' =>  '<div class="tennhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_hoten'] . '</div>',
                    'nv_ngaysinh' =>  '<div class="ngaysinhnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_ngaysinh'] . '</div>',
                    'nv_gioitinh' =>  '<div class="gioitinhnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_gioitinh'] . '</div>',
                    'nv_email' =>  '<div class="emailnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_email'] . '</div>',
                    'nv_sdt' =>  '<div class="sdtnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_sdt'] . '</div>',
                    'nv_diachi' =>  '<div class="diachinhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_diachi'] . '</div>',
                    'nv_chucvu' =>  '<div class="chucvunhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_chucvu'] . '</div>',
                    'nv_anhdaidien' => (!empty($row['nv_anhdaidien'])) ? '<div class="avatarnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" ><img loading="lazy" src="./assets/img/nhanvien/' . $row['nv_anhdaidien'] . '" class="avatar_nv " ></div>' : '<div class="avatarnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" ><img loading="lazy"src="./assets/img/nhanvien/nhanvienkhongcohinhanh.png" class="avatar_nv " ></div>',
                    'pb_ma' =>  '<div class="maphongban" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >PB' . sprintf('%03d', $row['pb_ma']) . '</div>',
                    'pb_ten' =>  '<div class="tenphongban" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['pb_ten'] . '</div>',

                ];
            }
        }
        break;
    case 2:


        // `kh_sdt`='$kh_sdt' AND `kh_email`='$kh_email' AND `kh_diachi`='$kh_diachi'
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
                $sql = "UPDATE `nhanvien` SET `pb_ma`='$pb_ma', `nv_hoten`='$nv_hoten', `nv_ngaysinh`='$nv_ngaysinh',`nv_gioitinh`='$nv_gioitinh',`nv_email`='$nv_email', `nv_anhdaidien`='$newname',`nv_sdt`='$nv_sdt',`nv_diachi`='$nv_diachi',`nv_chucvu`='$nv_chucvu'WHERE `nv_ma`='$nv_ma'";
            } else {
                if ($nv_oldmatkhau != $showhinh['nv_matkhau']) {
                    $data[] = [
                        'alert'  =>   'error:Mật khẩu cũ không đúng!',
                    ];
                } else {

                    $sql = "UPDATE `nhanvien` SET `pb_ma`='$pb_ma', `nv_hoten`='$nv_hoten', `nv_ngaysinh`='$nv_ngaysinh',`nv_gioitinh`='$nv_gioitinh',`nv_email`='$nv_email',`nv_matkhau`='$nv_matkhau',`nv_anhdaidien`='$newname',`nv_sdt`='$nv_sdt',`nv_diachi`='$nv_diachi',`nv_chucvu`='$nv_chucvu'WHERE `nv_ma`='$nv_ma'";
                }
            }
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $data[] = ['alert'  =>   'success:Cập nhật nhân viên thành công'];
            } else {
                $data[] = [
                    'alert'  =>   'error:Cập nhật nhân viên thất bại!',


                ];
            }


            $sql = "SELECT * FROM  `nhanvien` INNER JOIN `phongban` ON nhanvien.pb_ma=phongban.pb_ma WHERE `nv_ma`='$nv_ma' AND `nv_tinhtrang`<>'Đã nghỉ việc'";
            $result = mysqli_query($conn, $sql);


            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $data[] = [
                    'alert' =>  '',
                    'nv_stt' =>  $i++,
                    'nv_ma' =>  '<div class="manhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >NV' . sprintf('%03d', $row['nv_ma']) . '</div>',
                    'nv_hoten' =>  '<div class="tennhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_hoten'] . '</div>',
                    'nv_ngaysinh' =>  '<div class="ngaysinhnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_ngaysinh'] . '</div>',
                    'nv_gioitinh' =>  '<div class="gioitinhnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_gioitinh'] . '</div>',
                    'nv_email' =>  '<div class="emailnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_email'] . '</div>',
                    'nv_sdt' =>  '<div class="sdtnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_sdt'] . '</div>',
                    'nv_diachi' =>  '<div class="diachinhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_diachi'] . '</div>',
                    'nv_chucvu' =>  '<div class="chucvunhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_chucvu'] . '</div>',
                    'nv_anhdaidien' => (!empty($row['nv_anhdaidien'])) ? '<div class="avatarnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" ><img loading="lazy"src="./assets/img/nhanvien/' . $row['nv_anhdaidien'] . '" class="avatar_nv " ></div>' : '<div class="avatarnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" ><img loading="lazy"src="./assets/img/nhanvien/nhanvienkhongcohinhanh.png" class="avatar_nv " ></div>',
                    'pb_ma' =>  '<div class="maphongban" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >PB' . sprintf('%03d', $row['pb_ma']) . '</div>',
                    'pb_ten' =>  '<div class="tenphongban" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['pb_ten'] . '</div>',

                ];
            }
        }
        break;
    case 3:
        $data = [];
        // $hinh = mysqli_query($conn, "SELECT * FROM `nhanvien` WHERE `nv_ma`='$nv_ma'");
        // $showhinh = mysqli_fetch_assoc($hinh);
        // if (empty($showhinh['nv_anhdaidien'])) {
        // } else {

        //     unlink('../assets/img/nhanvien/' . $showhinh['nv_anhdaidien']);
        // }
        $sql = "UPDATE `nhanvien` SET `nv_tinhtrang` = 'Đã nghỉ việc'  WHERE `nv_ma`='$nv_ma' ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $data[] = ['alert'  =>   'success:Xóa nhân viên thành công'];
        } else {
            $data[] = ['alert'  =>   'error:Xóa nhân viên thất bại!'];
        }
        $sql = "SELECT * FROM `nhanvien` INNER JOIN `phongban` ON nhanvien.pb_ma=phongban.pb_ma WHERE `nv_ma`='$nv_ma' AND `nv_tinhtrang` <> 'Đã nghỉ việc' ";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = [

                'alert' =>  '',
                'nv_stt' =>  $i++,
                'nv_ma' =>  '<div class="manhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >NV' . sprintf('%03d', $row['nv_ma']) . '</div>',
                'nv_hoten' =>  '<div class="tennhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_hoten'] . '</div>',
                'nv_ngaysinh' =>  '<div class="ngaysinhnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_ngaysinh'] . '</div>',
                'nv_gioitinh' =>  '<div class="gioitinhnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_gioitinh'] . '</div>',
                'nv_email' =>  '<div class="emailnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_email'] . '</div>',
                'nv_sdt' =>  '<div class="sdtnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_sdt'] . '</div>',
                'nv_diachi' =>  '<div class="diachinhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_diachi'] . '</div>',
                'nv_chucvu' =>  '<div class="chucvunhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_chucvu'] . '</div>',
                'nv_anhdaidien' => (!empty($row['nv_anhdaidien'])) ? '<div class="avatarnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" ><img loading="lazy"src="./assets/img/nhanvien/' . $row['nv_anhdaidien'] . '" class="avatar_nv " ></div>' : '<div class="avatarnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" ><img loading="lazy"src="./assets/img/nhanvien/nhanvienkhongcohinhanh.png" class="avatar_nv " ></div>',
                'pb_ma' =>  '<div class="maphongban" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >PB' . sprintf('%03d', $row['pb_ma']) . '</div>',
                'pb_ten' =>  '<div class="tenphongban" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['pb_ten'] . '</div>',


            ];
        }
        break;
    case 4:
        $sql = "SELECT * FROM `nhanvien` INNER JOIN `phongban` ON nhanvien.pb_ma=phongban.pb_ma WHERE `nv_tinhtrang`<>'Đã nghỉ việc'";
        $result = mysqli_query($conn, $sql);
        $i = 1;
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = [
                'alert' =>  '',
                'nv_stt' =>  $i++,
                'nv_ma' =>  '<div class="manhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >NV' . sprintf('%03d', $row['nv_ma']) . '</div>',
                'nv_hoten' =>  '<div class="tennhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_hoten'] . '</div>',
                'nv_ngaysinh' =>  '<div class="ngaysinhnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_ngaysinh'] . '</div>',
                'nv_gioitinh' =>  '<div class="gioitinhnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_gioitinh'] . '</div>',
                'nv_email' =>  '<div class="emailnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_email'] . '</div>',
                'nv_sdt' =>  '<div class="sdtnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_sdt'] . '</div>',
                'nv_diachi' =>  '<div class="diachinhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_diachi'] . '</div>',
                'nv_chucvu' =>  '<div class="chucvunhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >' . $row['nv_chucvu'] . '</div>',
                'nv_anhdaidien' => (!empty($row['nv_anhdaidien'])) ? '<div class="avatarnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" ><img loading="lazy"src="./assets/img/nhanvien/' . $row['nv_anhdaidien'] . '" class="avatar_nv " ></div>' : '<div class="avatarnhanvien" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" ><img loading="lazy"src="./assets/img/nhanvien/nhanvienkhongcohinhanh.png" class="avatar_nv " ></div>',
                'pb_ma' =>  '<div class="maphongban" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '" >PB' . sprintf('%03d', $row['pb_ma']) . '</div>',
                'pb_ten' =>  '<div class="tenphongban" data-id="' . $row['pb_ma'] . '" data-img="' . $row['nv_anhdaidien'] . '"  >' . $row['pb_ten'] . '</div>',




            ];
        }
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conn = null;
