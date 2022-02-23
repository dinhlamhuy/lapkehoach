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
        $data = [];
        $check = mysqli_query($conn, "SELECT * FROM `kehoachcongviec` WHERE `khcv_ma`='$khcv_ma'");

        $rowcheck = mysqli_fetch_assoc($check);
        $check_cha = mysqli_query($conn, "SELECT * FROM `kehoachcongviec` WHERE `khcv_ma`='" . $rowcheck['khcv_thuoc_ma'] . "'");
        $kt = true;
        if (mysqli_num_rows($check_cha) > 0) {
            $rowcha = mysqli_fetch_assoc($check_cha);
            if ($rowcha['khcv_tiendo'] == 'Đã hủy') {
                $kt=false;
            }
        }
        if ($kt) {

            $sql = "UPDATE `kehoachcongviec` SET `khcv_tiendo`='Đang thực hiện'WHERE `khcv_ma`='$khcv_ma'";
            
      
            $result = mysqli_query($conn, $sql);
            
            add_new_history('Khôi phục công việc', 'NV' . sprintf('%03d', $nv_chinhsua) . ' Đã khôi phục công việc CV' . sprintf('%03d', $khcv_ma) . ' do ' . $row_nvth['nv_thuchien'] . ' thực hiện', $nv_chinhsua, $khcv_ma);
            if ($result) {
                $data[] = ['alert'  =>   'success:Khôi phục công việc thành công'];
            } else {
                $data[] = ['alert'  =>   'error:Khôi phục công việc thất bại!'];
            }
        } else {
            $data[] = ['alert'  =>   'error:Cần khôi phục công việc cha trước!'];
        }
        $sql = <<<EOT
        SELECT nvth.nv_ma as nvth_ma, nvth.nv_hoten as nvth_hoten,  nvth.nv_email as nvth_email, 
        nvlkh.nv_ma as nvlkh_ma, nvlkh.nv_hoten as nvlkh_hoten, nvlkh.nv_email as nvlkh_email, 
            duan.da_ma as maduan, duan.da_ten as tenduan, duan.da_thoihan, duan.da_trangthai, 
            khcv.khcv_ma as ma_cv, khcv.khcv_thuoc_ma as khcv_thuoc_macha, khcv.khcv_noidung as noidung_cv, khcv.khcv_ghichu as ghichu_cv, khcv.khcv_ngaybatdau as ngaybatdau_cv, khcv.khcv_thoihanhoanthanh as thoihanhoanthanh_cv, khcv.khcv_tiendo as tiendo_cv, khcv.da_ma as duan_cv, khcv.nv_thuchien as nvth_cv, khcv.nv_lapkehoach as nvlkh_cv
            FROM `kehoachcongviec` khcv INNER JOIN `nhanvien` nvth ON nvth.nv_ma=khcv.nv_thuchien INNER JOIN nhanvien nvlkh ON nvlkh.nv_ma=khcv.nv_lapkehoach INNER JOIN `duan` ON khcv.da_ma=duan.da_ma  WHERE khcv.khcv_tiendo = 'Đã hủy'
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
    case 2:

        $sql = <<<EOT
        SELECT nvth.nv_ma as nvth_ma, nvth.nv_hoten as nvth_hoten,  nvth.nv_email as nvth_email, 
        nvlkh.nv_ma as nvlkh_ma, nvlkh.nv_hoten as nvlkh_hoten, nvlkh.nv_email as nvlkh_email, 
            duan.da_ma as maduan, duan.da_ten as tenduan, duan.da_thoihan, duan.da_trangthai, 
            khcv.khcv_ma as ma_cv, khcv.khcv_thuoc_ma as khcv_thuoc_macha, khcv.khcv_noidung as noidung_cv, khcv.khcv_ghichu as ghichu_cv, khcv.khcv_ngaybatdau as ngaybatdau_cv, khcv.khcv_thoihanhoanthanh as thoihanhoanthanh_cv, khcv.khcv_tiendo as tiendo_cv, khcv.da_ma as duan_cv, khcv.nv_thuchien as nvth_cv, khcv.nv_lapkehoach as nvlkh_cv
            FROM `kehoachcongviec` khcv INNER JOIN `nhanvien` nvth ON nvth.nv_ma=khcv.nv_thuchien INNER JOIN nhanvien nvlkh ON nvlkh.nv_ma=khcv.nv_lapkehoach INNER JOIN `duan` ON khcv.da_ma=duan.da_ma  WHERE khcv.khcv_tiendo = 'Đã hủy' 
EOT;
        $result = mysqli_query($conn, $sql);
        $data = [];
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
                'ton_tuan' =>   $tontuan,
                'nhatky' =>  '<div class="nhatky" data-id="' .   $row['ma_cv'] . '"  >' . $nhatky . '</div>',

            ];
        }
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conn = null;
