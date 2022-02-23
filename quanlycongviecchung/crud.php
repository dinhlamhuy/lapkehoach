<?php
include_once __DIR__ . '/../database.php';
include_once __DIR__ . '/../pages/functions.php';


$da_ma = (isset($_POST['da_ma'])) ? $_POST['da_ma'] : '';
$khcv_ma = (isset($_POST['khcv_ma'])) ? $_POST['khcv_ma'] : '';
$ndcv = (isset($_POST['ndcv'])) ? $_POST['ndcv'] : '';
$ngaybatdau = (isset($_POST['ngaybatdau'])) ? $_POST['ngaybatdau'] : '';
$ngayketthuc = (isset($_POST['ngayketthuc'])) ? $_POST['ngayketthuc'] : '';
$trangthaicv = (isset($_POST['trangthaicv'])) ? $_POST['trangthaicv'] : '';
$nvlkh = (isset($_POST['nvlkh'])) ? $_POST['nvlkh'] : '';
$nvthuchien = (isset($_POST['nvthuchien'])) ? $_POST['nvthuchien'] : '';
$congvieccha = (isset($_POST['congvieccha'])) ? $_POST['congvieccha'] : '';
$ghichu = (isset($_POST['ghichu'])) ? $_POST['ghichu'] : '';

$i = 1;
$nv_chinhsua = (isset($_POST['nv_chinhsua'])) ? $_POST['nv_chinhsua'] : '';
$option = (isset($_POST['option'])) ? $_POST['option'] : '';
switch ($option) {
    case 1:

        $check = mysqli_query($conn, "SELECT * FROM `kehoachcongviec` INNER JOIN duan ON duan.da_ma= kehoachcongviec.da_ma INNER JOIN nhanvien ON nhanvien.nv_ma=kehoachcongviec.nv_thuchien WHERE  `nv_thuchien`='$nvthuchien' AND kehoachcongviec.da_ma='$da_ma' AND  `khcv_ma` = '$khcv_ma'");
        $data = [];

        if (mysqli_num_rows($check) > 0) {
            $data[] = ['alert'  =>   'error:Công việc đã tồn tại!'];
        } else {
            $sql = "INSERT INTO `kehoachcongviec`(`khcv_thuoc_ma`, `khcv_noidung`, `khcv_ghichu`, `khcv_ngaybatdau`, `khcv_thoihanhoanthanh`, `khcv_tiendo`, `da_ma`, `nv_thuchien`, `nv_lapkehoach`) VALUES ('$congvieccha','$ndcv','$ghichu','$ngaybatdau','$ngayketthuc','$trangthaicv','$da_ma','$nvthuchien','$nvlkh')";

            $result = mysqli_query($conn, $sql);
            $idkhcv = mysqli_insert_id($conn);
            
            $updateda = mysqli_query($conn, "UPDATE `duan` SET `da_trangthai`='Chưa hoàn thành' WHERE `da_ma`='$da_ma'");
            themtuan($idkhcv, $ngaybatdau, $ngayketthuc, '');
            $ls_tieude = 'Thêm công việc mới';
            $ls_noidung = 'NV' . sprintf('%03d', $nvlkh) . ' Lập công việc mới có mã CV' . sprintf('%03d', $idkhcv) . ' cho NV' . sprintf('%03d', $nvthuchien) . ' Thực hiện từ ' . $ngaybatdau . ' Đến ' . $ngayketthuc;
            $taolao="INSERT INTO `lichsu`(`ls_tieude`, `ls_noidung`,`nv_ma`, `khcv_ma`) VALUES ('$ls_tieude', '$ls_noidung', '$nv_chinhsua', '$idkhcv')";
            $data[]=['sql' =>   $taolao];
            
            if ($result) {
                add_new_history($ls_tieude, $ls_noidung, $nvlkh, $idkhcv);

                $data[] = ['alert'  =>   'success:Cập nhật công việc thành công'];
            } else {
                $data[] = ['alert'  =>   'error:Thêm công việc thất bại!'];
            }
            $sql = <<<EOT
            SELECT nvth.nv_ma as nvth_ma, nvth.nv_hoten as nvth_hoten,  nvth.nv_email as nvth_email, 
            nvlkh.nv_ma as nvlkh_ma, nvlkh.nv_hoten as nvlkh_hoten, nvlkh.nv_email as nvlkh_email, 
                duan.da_ma as maduan, duan.da_ten as tenduan, duan.da_thoihan, duan.da_trangthai, 
                khcv.khcv_ma as ma_cv, khcv.khcv_thuoc_ma as khcv_thuoc_macha, khcv.khcv_noidung as noidung_cv, khcv.khcv_ghichu as ghichu_cv, khcv.khcv_ngaybatdau as ngaybatdau_cv, khcv.khcv_thoihanhoanthanh as thoihanhoanthanh_cv, khcv.khcv_tiendo as tiendo_cv, khcv.da_ma as duan_cv, khcv.nv_thuchien as nvth_cv, khcv.nv_lapkehoach as nvlkh_cv
                FROM `kehoachcongviec` khcv INNER JOIN `nhanvien` nvth ON nvth.nv_ma=khcv.nv_thuchien INNER JOIN nhanvien nvlkh ON nvlkh.nv_ma=khcv.nv_lapkehoach INNER JOIN `duan` ON khcv.da_ma=duan.da_ma WHERE khcv.khcv_tiendo <> 'Đã hủy' ORDER BY ma_cv DESC LIMIT 1
    EOT;

            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $nhatky = shownhatky($row['ma_cv']);
                kt_trehan($row['ma_cv']);
                $tontuan = timtontuan($row['ma_cv']);
                // xulykhcvchacon($row['ma_cv']);
                $data[] = [
                    'alert' =>  '',
                    'khcv_stt' =>  $i++,
                    'khcv_ma' =>  '<div class="khcv_ma" data-id="' . $row['ma_cv'] . '" >CV' . sprintf("%03d", $row['ma_cv']) . '</div>',
                    'khcv_noidung' =>  '<div class="khcv_noidung" data-id="' . $row['ma_cv'] . '" >' . $row['noidung_cv'] . '</div>',
                    'khcv_ghichu' =>  '<div class="khcv_ghichu" data-id="' . $row['ma_cv'] . '" >' . $row['ghichu_cv'] . '</div>',
                    'khcv_ngaybatdau' =>  '<div class="khcv_ngaybatdau" data-date="' . $row['ngaybatdau_cv'] . '" >' . date('d-m-Y', strtotime($row['ngaybatdau_cv'])) . '</div>',
                    'khcv_thoihanhoanthanh' =>  '<div class="khcv_thoihanhoanthanh" data-date="' . $row['thoihanhoanthanh_cv'] . '" >' . date('d-m-Y', strtotime($row['thoihanhoanthanh_cv'])) . '</div>',
                    'khcv_tiendo' =>  '<div class="khcv_tiendo" data-id="' . $row['tiendo_cv'] . '" >' . $row['tiendo_cv'] . '</div>',
                    'da_ten' =>  '<div class="da_ten" data-id="' . $row['maduan'] . '" title="' . $row['tenduan'] . '" >PB' . sprintf("%03d", $row['maduan']) . '</div>',
                    'khcv_nvthuchien' =>  '<div class="khcv_nvthuchien" data-nvlkh="' . $row['nvlkh_ma'] . '" data-id="' . $row['nvth_ma'] . '" >' . $row['nvth_hoten'] . '</div>',
                    'khcv_nvlkh' =>  '<div class="khcv_nvlkh" data-id="' . $row['nvlkh_ma'] . '" >' . $row['nvlkh_hoten'] . '</div>',
                    'khcv_thuoc_macha' =>  !empty($row['khcv_thuoc_macha']) ? '<div class="khcv_thuoc_macha" data-id="' . $row['khcv_thuoc_macha'] . '">' . $row['khcv_thuoc_macha'] . '</div>' : '<div class="khcv_thuoc_macha"></div>',
                    'ton_tuan' =>  '<div class="ton_tuan" data-id="' .  $tontuan . '" >' .  $tontuan . '</div>',
                    'nhatky' =>  '<div class="nhatky" data-id="' .   $row['ma_cv'] . '"  >' . $nhatky . '</div>',

                ];
            }
        }
        break;
    case 2:


        // `kh_sdt`='$kh_sdt' AND `kh_email`='$kh_email' AND `kh_diachi`='$kh_diachi'
        $check = mysqli_query($conn, "SELECT * FROM `kehoachcongviec` INNER JOIN duan ON duan.da_ma= kehoachcongviec.da_ma INNER JOIN nhanvien ON nhanvien.nv_ma=kehoachcongviec.nv_thuchien WHERE `khcv_ma`<>'$khcv_ma' AND `nv_thuchien`='$nvthuchien' AND kehoachcongviec.da_ma='$da_ma' AND  `khcv_ma` = '$khcv_ma' ");
        $data = [];
        if (mysqli_num_rows($check) > 0) {
            $data[] = ['alert'  =>   'error:Công việc đã tồn tại!'];
        } else {
            $kt_nvth = mysqli_query($conn, "SELECT * FROM `kehoachcongviec` WHERE `khcv_ma`='$khcv_ma'");
            $row_nvth = mysqli_fetch_assoc($kt_nvth);

            $sql = "UPDATE `kehoachcongviec` SET `khcv_thuoc_ma`='$congvieccha',`khcv_noidung`='$ndcv',`khcv_ghichu`='$ghichu', `khcv_thoihanhoanthanh`='$ngayketthuc', `nv_thuchien`='$nvthuchien' , `khcv_tiendo`='$trangthaicv',`da_ma`='$da_ma' WHERE `khcv_ma`='$khcv_ma'";

            // Sự thay đổi của thời hạn
            if (timidtuan($row_nvth['khcv_thoihanhoanthanh']) < timidtuan($ngayketthuc)) {
                giahancongviec($khcv_ma,  $ngayketthuc);
                add_new_history('Gia hạn', 'NV' . sprintf('%03d', $nv_chinhsua) . ' Đã gia hạn thêm cho công việc có mã CV' . sprintf('%03d', $khcv_ma) . ' từ <b>' . date('d/m/Y', strtotime($row_nvth['khcv_thoihanhoanthanh'])) . '</b> Đến <b>' . date('d/m/Y', strtotime($ngayketthuc)) . '</b>', $nv_chinhsua, $khcv_ma);
            } else  if (timidtuan($row_nvth['khcv_thoihanhoanthanh']) > timidtuan($ngayketthuc)) {
                rutnganthoihancongviec($khcv_ma,  $ngayketthuc);

                add_new_history('Rút ngắn thời gian hoàn thành', 'NV' . sprintf('%03d', $nv_chinhsua) . ' Đã rút ngắn thời gian hoàn thành của công việc có mã CV' . sprintf('%03d', $khcv_ma) . ' từ <b>' . date('d/m/Y', strtotime($row_nvth['khcv_thoihanhoanthanh'])) . '</b> Đến <b>' . date('d/m/Y', strtotime($ngayketthuc)) . '</b>', $nv_chinhsua, $khcv_ma);
            }
            //thay đổi nhân viên
            if ($row_nvth['nv_thuchien'] != $nvthuchien) {
                add_new_history('Chuyển giao nhiệm vụ', 'NV' . sprintf('%03d', $nv_chinhsua) . ' Đã bàn giao lại công việc có mã CV' . sprintf('%03d', $khcv_ma) . ' do NV' . sprintf('%03d', $row_nvth['nv_thuchien']) . ' thực hiện trước đó và chuyển đến cho NV' . sprintf('%03d', $nvthuchien) . ' thực hiện tiếp', $nv_chinhsua, $khcv_ma);
            }
            // Thay đổi nội dung
            if ($row_nvth['khcv_noidung'] != $ndcv) {
                add_new_history('Thay đổi nội dung công việc', 'NV' . sprintf('%03d', $nv_chinhsua) . ' Đã thay đổi nội dung công việc CV' . sprintf('%03d', $khcv_ma) . ' có nội dung "<b>' . $row_nvth['khcv_noidung'] . '</b>" thành nội dung mới "<b>' . $ndcv . '</b>"', $nv_chinhsua, $khcv_ma);
            }
            // Thiết lập trạng thái
            if (strcasecmp($row_nvth['khcv_tiendo'], $trangthaicv) != 0) {
                if (strcasecmp($trangthaicv, 'Hoàn thành') == 0) {
                    $sqlhoanthanhcv = mysqli_query($conn, "UPDATE `kehoachcongviec` SET `khcv_hoanthanhcv`='".date('Y-m-d')."' WHERE `khcv_ma`='$khcv_ma'");
                    add_new_history('Hoàn thành công việc', 'NV' . sprintf('%03d', $nv_chinhsua) . ' Đã hoàn thành công việc có mã CV' . sprintf('%03d', $khcv_ma) . '', $nv_chinhsua, $khcv_ma);
                } else {
                    add_new_history('Thay đổi trạng thái công việc', 'NV' . sprintf('%03d', $nv_chinhsua) . ' Đã thay đổi trạng thái công việc có mã CV' . sprintf('%03d', $khcv_ma) . ' từ trạng thái <b>"' . $row_nvth['khcv_tiendo'] . '"</b> sang trạng thái <b>' . $trangthaicv . '</b>', $nv_chinhsua, $khcv_ma);
                }
            }
            if (strcasecmp($trangthaicv, 'Hoàn thành') == 0) {
                if (ktcv_cvcon($khcv_ma) == true) {
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $data[] = ['alert'  =>   'success:Cập nhật công việc thành công'];
                    } else {
                        $data[] = ['alert'  =>   'error:Cập nhật công việc thất bại!', ];
                    }
                } else {
                    $data[] = ['alert'  =>   'error:Cập nhật công việc thất bại!', ];
                }
            }else {
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $data[] = ['alert'  =>   'success:Cập nhật công việc thành công'];
                } else {
                    $data[] = ['alert'  =>   'error:Cập nhật công việc thất bại!', ];
                }
            }

            $sql = <<<EOT
            SELECT nvth.nv_ma as nvth_ma, nvth.nv_hoten as nvth_hoten,  nvth.nv_email as nvth_email, 
            nvlkh.nv_ma as nvlkh_ma, nvlkh.nv_hoten as nvlkh_hoten, nvlkh.nv_email as nvlkh_email, 
                duan.da_ma as maduan, duan.da_ten as tenduan, duan.da_thoihan, duan.da_trangthai, 
                khcv.khcv_ma as ma_cv, khcv.khcv_thuoc_ma as khcv_thuoc_macha, khcv.khcv_noidung as noidung_cv, khcv.khcv_ghichu as ghichu_cv, khcv.khcv_ngaybatdau as ngaybatdau_cv, khcv.khcv_thoihanhoanthanh as thoihanhoanthanh_cv, khcv.khcv_tiendo as tiendo_cv, khcv.da_ma as duan_cv, khcv.nv_thuchien as nvth_cv, khcv.nv_lapkehoach as nvlkh_cv
                FROM `kehoachcongviec` khcv INNER JOIN `nhanvien` nvth ON nvth.nv_ma=khcv.nv_thuchien INNER JOIN nhanvien nvlkh ON nvlkh.nv_ma=khcv.nv_lapkehoach INNER JOIN `duan` ON khcv.da_ma=duan.da_ma  WHERE khcv.khcv_tiendo <> 'Đã hủy'
    EOT;
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $nhatky = shownhatky($row['ma_cv']);
           
                $tontuan = timtontuan($row['ma_cv']);
                xulykhcvchacon($row['ma_cv']);
                $data[] = [
                    'alert' =>  '',
                    'khcv_stt' =>  $i++,
                    'khcv_ma' =>  '<div class="khcv_ma" data-id="' . $row['ma_cv'] . '" >CV' . sprintf("%03d", $row['ma_cv']) . '</div>',
                    'khcv_noidung' =>  '<div class="khcv_noidung" data-id="' . $row['ma_cv'] . '" >' . $row['noidung_cv'] . '</div>',
                    'khcv_ghichu' =>  '<div class="khcv_ghichu" data-id="' . $row['ma_cv'] . '" >' . $row['ghichu_cv'] . '</div>',
                    'khcv_ngaybatdau' =>  '<div class="khcv_ngaybatdau" data-date="' . $row['ngaybatdau_cv'] . '" >' . date('d-m-Y', strtotime($row['ngaybatdau_cv'])) . '</div>',
                    'khcv_thoihanhoanthanh' =>  '<div class="khcv_thoihanhoanthanh" data-date="' . $row['thoihanhoanthanh_cv'] . '" >' . date('d-m-Y', strtotime($row['thoihanhoanthanh_cv'])) . '</div>',
                    'khcv_tiendo' =>  '<div class="khcv_tiendo" data-id="' . $row['tiendo_cv'] . '" >' . $row['tiendo_cv'] . '</div>',
                    'da_ten' =>  '<div class="da_ten" data-id="' . $row['maduan'] . '" title="' . $row['tenduan'] . '" >PB' . sprintf("%03d", $row['maduan']) . '</div>',
                    'khcv_nvthuchien' =>  '<div class="khcv_nvthuchien" data-nvlkh="' . $row['nvlkh_ma'] . '" data-id="' . $row['nvth_ma'] . '" >' . $row['nvth_hoten'] . '</div>',
                    'khcv_nvlkh' =>  '<div class="khcv_nvlkh" data-id="' . $row['nvlkh_ma'] . '" >' . $row['nvlkh_hoten'] . '</div>',
                    'khcv_thuoc_macha' =>  !empty($row['khcv_thuoc_macha']) ? '<div class="khcv_thuoc_macha" data-id="' . $row['khcv_thuoc_macha'] . '">' . $row['khcv_thuoc_macha'] . '</div>' : '<div class="khcv_thuoc_macha"></div>',
                    'ton_tuan' =>  '<div class="ton_tuan" data-id="' .  $tontuan . '" >' .  $tontuan . '</div>',
                    'nhatky' =>  '<div class="nhatky" data-id="' .   $row['ma_cv'] . '"  >' . $nhatky . '</div>',


                ];
            }
        }
        break;
    case 3:
        $data = [];

        $sql = "UPDATE `kehoachcongviec` SET `khcv_tiendo`='Đã hủy'WHERE `khcv_ma`='$khcv_ma'";
        add_new_history('Hủy bỏ công việc', 'NV' . sprintf('%03d', $nv_chinhsua) . ' Đã hủy công việc CV' . sprintf('%03d', $khcv_ma) . ' do ' . $row_nvth['nv_thuchien'] . ' thực hiện', $nv_chinhsua, $khcv_ma);

        huy_khcv_cha($khcv_ma, $nv_chinhsua);
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $data[] = ['alert'  =>   'success:Hủy công việc thành công'];
        } else {
            $data[] = ['alert'  =>   'error:Hủy công việc thất bại!'];
        }
        $sql = <<<EOT
        SELECT nvth.nv_ma as nvth_ma, nvth.nv_hoten as nvth_hoten,  nvth.nv_email as nvth_email, 
        nvlkh.nv_ma as nvlkh_ma, nvlkh.nv_hoten as nvlkh_hoten, nvlkh.nv_email as nvlkh_email, 
            duan.da_ma as maduan, duan.da_ten as tenduan, duan.da_thoihan, duan.da_trangthai, 
            khcv.khcv_ma as ma_cv, khcv.khcv_thuoc_ma as khcv_thuoc_macha, khcv.khcv_noidung as noidung_cv, khcv.khcv_ghichu as ghichu_cv, khcv.khcv_ngaybatdau as ngaybatdau_cv, khcv.khcv_thoihanhoanthanh as thoihanhoanthanh_cv, khcv.khcv_tiendo as tiendo_cv, khcv.da_ma as duan_cv, khcv.nv_thuchien as nvth_cv, khcv.nv_lapkehoach as nvlkh_cv
            FROM `kehoachcongviec` khcv INNER JOIN `nhanvien` nvth ON nvth.nv_ma=khcv.nv_thuchien INNER JOIN nhanvien nvlkh ON nvlkh.nv_ma=khcv.nv_lapkehoach INNER JOIN `duan` ON khcv.da_ma=duan.da_ma  WHERE khcv.khcv_tiendo <> 'Đã hủy'
EOT;
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $nhatky = shownhatky($row['ma_cv']);
            kt_trehan($row['ma_cv']);
            $tontuan = timtontuan($row['ma_cv']);
            xulykhcvchacon($row['ma_cv']);
            $data[] = [
                'alert' =>  '',
                'khcv_stt' =>  $i++,
                'khcv_ma' =>  '<div class="khcv_ma" data-id="' . $row['ma_cv'] . '" >CV' . sprintf("%03d", $row['ma_cv']) . '</div>',
                'khcv_noidung' =>  '<div class="khcv_noidung" data-id="' . $row['ma_cv'] . '" >' . $row['noidung_cv'] . '</div>',
                'khcv_ghichu' =>  '<div class="khcv_ghichu" data-id="' . $row['ma_cv'] . '" >' . $row['ghichu_cv'] . '</div>',
                'khcv_ngaybatdau' =>  '<div class="khcv_ngaybatdau" data-date="' . $row['ngaybatdau_cv'] . '" >' . date('d-m-Y', strtotime($row['ngaybatdau_cv'])) . '</div>',
                'khcv_thoihanhoanthanh' =>  '<div class="khcv_thoihanhoanthanh" data-date="' . $row['thoihanhoanthanh_cv'] . '" >' . date('d-m-Y', strtotime($row['thoihanhoanthanh_cv'])) . '</div>',
                'khcv_tiendo' =>  '<div class="khcv_tiendo" data-id="' . $row['tiendo_cv'] . '" >' . $row['tiendo_cv'] . '</div>',
                'da_ten' =>  '<div class="da_ten" data-id="' . $row['maduan'] . '" title="' . $row['tenduan'] . '" >PB' . sprintf("%03d", $row['maduan']) . '</div>',
                'khcv_nvthuchien' =>  '<div class="khcv_nvthuchien" data-nvlkh="' . $row['nvlkh_ma'] . '" data-id="' . $row['nvth_ma'] . '" >' . $row['nvth_hoten'] . '</div>',
                'khcv_nvlkh' =>  '<div class="khcv_nvlkh" data-id="' . $row['nvlkh_ma'] . '" >' . $row['nvlkh_hoten'] . '</div>',
                'khcv_thuoc_macha' =>  !empty($row['khcv_thuoc_macha']) ? '<div class="khcv_thuoc_macha"   data-id="' . $row['khcv_thuoc_macha'] . '">CV' . sprintf('%03d', $row['khcv_thuoc_macha']) . '</div>' : '<div class="khcv_thuoc_macha"></div>',
                'ton_tuan' =>  '<div class="ton_tuan" data-id="' .  $tontuan . '" >' .  $tontuan . '</div>',
                'nhatky' =>  '<div class="nhatky" data-id="' .   $row['ma_cv'] . '"  >' . $nhatky . '</div>',
            ];
        }
        break;
    case 4:

        $sql = <<<EOT
        SELECT nvth.nv_ma as nvth_ma, nvth.nv_hoten as nvth_hoten,  nvth.nv_email as nvth_email, 
        nvlkh.nv_ma as nvlkh_ma, nvlkh.nv_hoten as nvlkh_hoten, nvlkh.nv_email as nvlkh_email, 
            duan.da_ma as maduan, duan.da_ten as tenduan, duan.da_thoihan, duan.da_trangthai, 
            khcv.khcv_ma as ma_cv, khcv.khcv_thuoc_ma as khcv_thuoc_macha, khcv.khcv_noidung as noidung_cv, khcv.khcv_ghichu as ghichu_cv, khcv.khcv_ngaybatdau as ngaybatdau_cv, khcv.khcv_thoihanhoanthanh as thoihanhoanthanh_cv, khcv.khcv_tiendo as tiendo_cv, khcv.da_ma as duan_cv, khcv.nv_thuchien as nvth_cv, khcv.nv_lapkehoach as nvlkh_cv
            FROM `kehoachcongviec` khcv INNER JOIN `nhanvien` nvth ON nvth.nv_ma=khcv.nv_thuchien INNER JOIN nhanvien nvlkh ON nvlkh.nv_ma=khcv.nv_lapkehoach INNER JOIN `duan` ON khcv.da_ma=duan.da_ma  WHERE khcv.khcv_tiendo <> 'Đã hủy' 
EOT;
        $result = mysqli_query($conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $nhatky = shownhatky($row['ma_cv']);
            kt_trehan($row['ma_cv']);
            $tontuan = timtontuan($row['ma_cv']);
            xulykhcvchacon($row['ma_cv']);
            $trehan= trehan($row['ma_cv']);
            $data[] = [
                'alert' =>  '',
                'khcv_stt' =>  $i++,
                'khcv_ma' =>  '<div class="khcv_ma" data-id="' . $row['ma_cv'] . '" >CV' . sprintf("%03d", $row['ma_cv']) . '</div>',
                'khcv_noidung' =>  '<div class="khcv_noidung" data-id="' . $row['ma_cv'] . '" >' . $row['noidung_cv'] . '</div>',
                'khcv_ghichu' =>  '<div class="khcv_ghichu" data-id="' . $row['ma_cv'] . '" >' . $row['ghichu_cv'] . '</div>',
                'khcv_ngaybatdau' =>  '<div class="khcv_ngaybatdau" data-date="' . $row['ngaybatdau_cv'] . '" >' . date('d-m-Y', strtotime($row['ngaybatdau_cv'])) . '</div>',
                'khcv_thoihanhoanthanh' =>  '<div class="khcv_thoihanhoanthanh" data-date="' . $row['thoihanhoanthanh_cv'] . '" >' . date('d-m-Y', strtotime($row['thoihanhoanthanh_cv'])) . '</div>',
                'khcv_tiendo' =>  '<div class="khcv_tiendo" data-id="' . $row['tiendo_cv'] . '" >' . $row['tiendo_cv'] . '</div>',
                'da_ten' =>  '<div class="da_ten" data-id="' . $row['maduan'] . '" title="' . $row['tenduan'] . '" >PB' . sprintf("%03d", $row['maduan']) . '</div>',
                'khcv_nvthuchien' =>  '<div class="khcv_nvthuchien" data-nvlkh="' . $row['nvlkh_ma'] . '" data-id="' . $row['nvth_ma'] . '" >' . $row['nvth_hoten'] . '</div>',
                'khcv_nvlkh' =>  '<div class="khcv_nvlkh" data-id="' . $row['nvlkh_ma'] . '" >' . $row['nvlkh_hoten'] . '</div>',
                'khcv_thuoc_macha' =>  !empty($row['khcv_thuoc_macha']) ? '<div class="khcv_thuoc_macha"   data-id="' . $row['khcv_thuoc_macha'] . '">CV' . sprintf('%03d', $row['khcv_thuoc_macha']) . '</div>' : '<div class="khcv_thuoc_macha"></div>',
                'ton_tuan' =>   $tontuan.$trehan,
                'nhatky' =>  '<div class="nhatky" data-id="' .   $row['ma_cv'] . '"  >' . $nhatky . '</div>',

            ];
        }
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conn = null;
