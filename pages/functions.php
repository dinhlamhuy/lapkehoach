<?php
function kt_trehan($ma_cv)
{
    $conn = mysqli_connect("localhost", "root", "", "lapkehoach");
    mysqli_set_charset($conn, 'UTF8');
    $kt = mysqli_query($conn, "SELECT * FROM `chitiet_khcv` INNER JOIN `kehoachcongviec` ON chitiet_khcv.khcv_ma=kehoachcongviec.khcv_ma WHERE (kehoachcongviec.khcv_ma='$ma_cv' AND `khcv_tiendo` ='Chưa thực hiện') OR (kehoachcongviec.khcv_ma='$ma_cv' AND `khcv_tiendo` ='Đang thực hiện') ");
    if (mysqli_num_rows($kt) > 0) {

        $tuancuoi = 0;
        $cactuan = '';
        while ($rowkt = mysqli_fetch_assoc($kt)) {

            if ($tuancuoi < intval($rowkt['t_ma'])) {
                $tuancuoi = $rowkt['t_ma'];
            }
        }
        // $cactuan = substr($cactuan, 0, -2);
        $tuanhientai = date('W', strtotime(date('Y-m-d')));
        if (intval($tuancuoi) < intval($tuanhientai)) {
            $tuanmoi = $tuancuoi;
            for ($i = 0; $i < (intval($tuanhientai) - intval($tuancuoi)); $i++) {
                $tuanmoi = $tuanmoi + 1;
                $themtuan = mysqli_query($conn, "INSERT INTO `chitiet_khcv`(`khcv_ma`, `t_ma`, `ctkhcv_giahan`) VALUES ('" . $ma_cv . "','$tuanmoi','1')");
            }
        }
    }
    mysqli_close($conn);
}

function timtontuan($ma_cv)
{
    $conn = mysqli_connect("localhost", "root", "", "lapkehoach");
    mysqli_set_charset($conn, 'UTF8');
    $sql = mysqli_query($conn, "SELECT * FROM `chitiet_khcv` INNER JOIN `kehoachcongviec` ON kehoachcongviec.khcv_ma=chitiet_khcv.khcv_ma WHERE (`kehoachcongviec`.`khcv_ma`='$ma_cv' AND `khcv_tiendo` ='Chưa thực hiện') OR (`kehoachcongviec`.`khcv_ma`='$ma_cv' AND `khcv_tiendo`='Đang thực hiện') ");
    $tuanton = '<div class="ton_tuan text-center w-100 h-100 m-0" style="background-color:red; color:white;" data-id="' . $ma_cv . '">';
    while ($row = mysqli_fetch_assoc($sql)) {
        if ($row['ctkhcv_giahan'] == 1) {
            $tuanton .= 'T' . $row['t_ma'] . ', ';
        }
    }
    $cactuan = substr($tuanton, 0, -2);
    $cactuan .= '</div>';
    mysqli_close($conn);
    return $cactuan;
}


function trehan($ma_cv)
{
    $conn = mysqli_connect("localhost", "root", "", "lapkehoach");
    mysqli_set_charset($conn, 'UTF8');
    $sqlkhcv = mysqli_query($conn,  "SELECT * FROM `kehoachcongviec` WHERE `kehoachcongviec`.`khcv_ma`='$ma_cv' AND `khcv_tiendo`<>'Đã hủy'");
    $rowkhcv = mysqli_fetch_assoc($sqlkhcv);
    $tongngaytrehan = '';
    $ngayhoanthanh = '';
    $tongngay=0;
    if (!empty($rowkhcv['khcv_hoanthanhcv'])) {

        $ngayhoanthanh = $rowkhcv['khcv_hoanthanhcv'];
    } else {
        $ngayhoanthanh = date('Y-m-d');
    }
    if ($rowkhcv['khcv_tiendo'] != 'Đã hủy' ) {

        if (strtotime($rowkhcv['khcv_thoihanhoanthanh']) < strtotime($ngayhoanthanh)) {
            $tongngay = (strtotime($ngayhoanthanh) - strtotime($rowkhcv['khcv_thoihanhoanthanh'])) * 0.000011574074074074;
            $tongngaytrehan = '<div class="text-muted"> Trễ hạn ' . intval($tongngay) . ' ngày<div>';
        }
    }

    return $tongngaytrehan;
}

function trehan_khcvcon($ma_cv)
{
    $conn = mysqli_connect("localhost", "root", "", "lapkehoach");
    mysqli_set_charset($conn, 'UTF8');
    $sqlkhcv = mysqli_query($conn,  "SELECT * FROM `kehoachcongviec` WHERE `kehoachcongviec`.`khcv_ma`='$ma_cv'");
    $tongngaytrehan = '';
    $tongngay = 0;
    $rowkhcv = mysqli_fetch_assoc($sqlkhcv);
    $ngayhoanthanh = '';
    if (!empty(strtotime($rowkhcv['khcv_hoanthanhcv']))) {

        $ngayhoanthanh = $rowkhcv['khcv_hoanthanhcv'];
    } else {
        $ngayhoanthanh = date('Y-m-d');
    }
    if ($rowkhcv['khcv_tiendo'] != 'Đã hủy' ) {

        if (strtotime($rowkhcv['khcv_thoihanhoanthanh']) < strtotime($ngayhoanthanh)) {
            $tongngay = (strtotime($ngayhoanthanh) - strtotime($rowkhcv['khcv_thoihanhoanthanh'])) * 0.000011574074074074;
            $tongngaytrehan = '<div class="text-muted"> Trễ hạn ' . intval($tongngay) . ' ngày<div>';
        }
    }

    return $tongngaytrehan;
}

function themtuan($ma_cv, $ngaybatdau, $ngayketthuc, $ctkhcv_giahan)
{
    $conn = mysqli_connect("localhost", "root", "", "lapkehoach");
    mysqli_set_charset($conn, 'UTF8');
    $tuandau = date('W', strtotime($ngaybatdau));
    $namcuatuandau = date('Y', strtotime($ngaybatdau));
    $tuancuoi = date('W', strtotime($ngayketthuc));
    $namcuatuancuoi = date('Y', strtotime($ngayketthuc));
    $firstmonth = 0;
    $lastmonth = 0;
    $check = mysqli_query($conn, "SELECT * FROM  tuan INNER JOIN nam ON nam.nam_id=tuan.nam_id ");

    while ($row = mysqli_fetch_assoc($check)) {
        if ($tuandau == intval($row['t_sotuan'])) {
            $firstmonth = $row['t_sotuan'];
        }

        if ($tuancuoi == $row['t_sotuan']) {
            $lastmonth = $row['t_sotuan'];
        }
    }
    $tuan = $lastmonth - $firstmonth;
    for ($i = 0; $i <= $tuan; $i++) {
        $t_ma = $firstmonth + $i;
        $themchitiet = mysqli_query($conn, "INSERT INTO `chitiet_khcv`(`khcv_ma`, `t_ma`, `ctkhcv_giahan`) VALUES ('$ma_cv','$t_ma','$ctkhcv_giahan')");
    }
    mysqli_close($conn);
}

function add_new_history($ls_tieude, $ls_noidung, $nv_ma, $khcv_ma)
{
    $conn = mysqli_connect("localhost", "root", "", "lapkehoach");
    $sql = "INSERT INTO `lichsu`(`ls_tieude`, `ls_noidung`,`nv_ma`, `khcv_ma`) VALUES ('$ls_tieude', '$ls_noidung', '$nv_ma', '$khcv_ma')";

    $add = mysqli_query($conn, $sql);
    mysqli_close($conn);
}

function timidtuan($ngay)
{
    $conn = mysqli_connect("localhost", "root", "", "lapkehoach");
    mysqli_set_charset($conn, 'UTF8');

    $tuan = date('W', strtotime($ngay));
    $nam = date('Y', strtotime($ngay));
    $sql = mysqli_query($conn, "SELECT * FROM `tuan` INNER JOIN `nam` ON tuan.nam_id=nam.nam_id WHERE `t_sotuan`='$tuan' AND `n_nam`='$nam'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $output = $row['t_ma'];
    } else {
        $output = 'Không tìm thấy id tuần';
    }
    mysqli_close($conn);

    return $output;
}

function giahancongviec($ma_cv,  $ngay)
{
    $conn = mysqli_connect("localhost", "root", "", "lapkehoach");
    mysqli_set_charset($conn, 'UTF8');

    $sql = mysqli_query($conn, "SELECT * FROM `chitiet_khcv` INNER JOIN `tuan` ON chitiet_khcv.t_ma=tuan.t_ma INNER JOIN `nam` ON nam.nam_id=tuan.nam_id WHERE `khcv_ma`='$ma_cv'");
    $idtuancuoi = 0;
    $idtuan = timidtuan($ngay);
    while ($row = mysqli_fetch_assoc($sql)) {
        if (intval($idtuancuoi) < intval($row['t_ma'])) {
            $idtuancuoi = intval($row['t_ma']);
        }
    }
    for ($i = 1; $i < $idtuan - $idtuancuoi; $i++) {
        $add = intval($idtuancuoi + $i);
        $output = mysqli_query($conn, "INSERT INTO `chitiet_khcv`(`khcv_ma`, `t_ma`, `ctkhcv_giahan`) VALUES ('$ma_cv','$add','2')");
    }
    mysqli_close($conn);
}

function rutnganthoihancongviec($ma_cv,  $ngay)
{
    $conn = mysqli_connect("localhost", "root", "", "lapkehoach");
    $sql = mysqli_query($conn, "SELECT * FROM `chitiet_khcv` INNER JOIN `tuan` ON chitiet_khcv.t_ma=tuan.t_ma INNER JOIN `nam` ON nam.nam_id=tuan.nam_id WHERE `khcv_ma`='$ma_cv'");

    $idtuan = timidtuan($ngay);
    $output = '';
    while ($row = mysqli_fetch_assoc($sql)) {
        if (intval($idtuan) < intval($row['t_ma'])) {
            $output = mysqli_query($conn, "DELETE `chitiet_khcv` WHERE `khcv_ma`='$ma_cv' AND `t_ma`='" . $row['t_ma'] . "' ");
        }
    }
    mysqli_close($conn);
}

function shownhatky($ma_cv)
{
    $conn = mysqli_connect("localhost", "root", "", "lapkehoach");
    mysqli_set_charset($conn, 'UTF8');


    $ngay = '1999-07-12';
    $modal = '';
    $ls = mysqli_query($conn, "SELECT * FROM `lichsu` WHERE `khcv_ma` = '$ma_cv' GROUP BY `ls_ngay` ORDER BY `lichsu`.`ls_ngay` DESC");
    $lstieude = mysqli_query($conn, "SELECT * FROM `lichsu` WHERE `khcv_ma` = '$ma_cv' GROUP BY `ls_ngay` ORDER BY `lichsu`.`ls_ngay` DESC LIMIT 1");
    $nhatky = '';
    if (mysqli_num_rows($lstieude) > 0) {
        $rowlstd = mysqli_fetch_assoc($lstieude);
        $tieude = $rowlstd['ls_noidung'];
        $tieude = substr($tieude, 0, 35) . '...';
    }
    if (mysqli_num_rows($ls) > 0) {

        while ($rowls = mysqli_fetch_assoc($ls)) {

            $ngayls = date('Y-m-d', strtotime($rowls['ls_ngay']));
            if (strtotime($ngay) != strtotime($ngayls)) {
                $nhatky .= '<li><b>' .  $ngayls . '</b></li>';
                $ngay = $ngayls;
            }

            $nhatky .= '<ul><li>' . $rowls['ls_noidung'] . ' <sup><small>' . date('H:i:s', strtotime($rowls['ls_ngay'])) . '</small>
            </sup></li></ul>';
        }


        $modal = '<button type="button" class="btn p-0 m-0" style="font-size:14px;" data-toggle="modal" data-target="#nhatky' . $ma_cv . '">' . $tieude . '</button>';
        $modal .= '<div class="modal fade" id="nhatky' . $ma_cv . '" data-backdrop="static" aria-labelledby="nhatky' . $ma_cv . 'Label" aria-hidden="true">';
        $modal .= '<div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content"><div class="modal-header " style="background-color:#fdac53; color:white;"><h5 class="modal-title"  id="nhatky' . $ma_cv . 'Label">Nhật ký lịch sử công việc </h5>';
        $modal .= '<button type="button" class="close nutdongmodal" style="background-color:#fdac53; color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:white;">&times;</span></button></div>';
        $modal .= '<div class="modal-body"><div class="row"><div class="col-md-12"><ul>';
        $modal .= '' . $nhatky;
        $modal .= '</ul></div></div></div><!-- <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button></div>--></div></div></div>';
    }
    mysqli_close($conn);
    return $modal;
}

// Kiểm tra các cv con đã hoàn thành thì cv cha tự động chuyển sang hoàn thành
function xulykhcvchacon($ma_cv)
{
    $conn = mysqli_connect("localhost", "root", "", "lapkehoach");
    mysqli_set_charset($conn, 'UTF8');

    $sql = mysqli_query($conn, "SELECT * FROM `kehoachcongviec` WHERE `khcv_thuoc_ma`='$ma_cv' AND `khcv_tiendo`<>'Đã hủy'");
    $noidung = '';
    // $sqlcha=mysqli_query($conn, "SELECT * FROM `kehoachcongviec` WHERE (`khcv_ma`='$ma_cv' AND `khcv_thuoc_ma`= NULL) OR (`khcv_ma`='$ma_cv' AND `khcv_thuoc_ma` ='0')");
    if (mysqli_num_rows($sql) > 0) {
        $ht = 'nó là khcv cha';
        while ($row = mysqli_fetch_assoc($sql)) {

            if ($row['khcv_tiendo'] != 'Hoàn thành') {
                $noidung .= $row['khcv_ma'] . '-' . $row['khcv_tiendo'];
            }
        }
        if (empty($noidung)) {
            $nd = mysqli_query($conn, "UPDATE `kehoachcongviec` SET `khcv_tiendo`='Hoàn thành' WHERE `khcv_ma`='$ma_cv'");
        } else {
            $nd = mysqli_query($conn, "UPDATE `kehoachcongviec` SET `khcv_tiendo`='Đang thực hiện' WHERE `khcv_ma`='$ma_cv'");
        }
    } else {
        $ht = 'nó là khcv con';
    }
    mysqli_close($conn);
}

//kiểm tra công việc có cv con hay không?
function ktcv_cvcon($ma_cv)
{
    $conn = mysqli_connect("localhost", "root", "", "lapkehoach");
    mysqli_set_charset($conn, 'UTF8');
    $sql = mysqli_query($conn, "SELECT * FROM `kehoachcongviec` WHERE `khcv_thuoc_ma`='$ma_cv' AND `khcv_tiendo`<>'Đã hủy'");
    while ($row = mysqli_fetch_assoc($sql)) {
        if ($row['khcv_tiendo'] != 'Hoàn thành') {
            return false;
        }
    }
    mysqli_close($conn);
    return true;
}

function huy_khcv_cha($ma_cv, $nv_chinhsua)
{
    $conn = mysqli_connect("localhost", "root", "", "lapkehoach");
    mysqli_set_charset($conn, 'UTF8');
    $sql = mysqli_query($conn, "UPDATE `kehoachcongviec` SET `khcv_tiendo`='Đã hủy' WHERE `khcv_thuoc_ma`='$ma_cv'");
    $sqlcon = mysqli_query($conn, "SELECT * FROM `kehoachcongviec` WHERE `khcv_thuoc_ma`='$ma_cv'");
    while ($rowsqlcon = mysqli_fetch_assoc($sqlcon)) {
        add_new_history('Hủy bỏ công việc', 'NV' . sprintf('%03d', $nv_chinhsua) . ' Đã hủy công việc CV' . sprintf('%03d', $rowsqlcon['khcv_ma']) . ' do công việc cha có mã CV' . sprintf('%03d',  $ma_cv) . ' thực hiện', $nv_chinhsua, $rowsqlcon['khcv_ma']);
    }
}
