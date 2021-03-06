<?php
session_start();
require_once __DIR__ . '/database.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'daily_work';


if (isset($_SESSION['current_user']) && !empty($_SESSION['current_user'])) {
    $nhanvien = $_SESSION['current_user'];
} else {
    $_SESSION['current_user'] = '';
    header('location: ./pages/dangnhap.php');
}

$sqlnv = mysqli_query($conn, "SELECT * FROM `nhanvien` INNER JOIN `phongban` ON nhanvien.pb_ma=phongban.pb_ma WHERE `nv_ma`='" . $nhanvien['nv_ma'] . "'");
$rownvht = mysqli_fetch_assoc($sqlnv);
if (empty($rownvht['nv_anhdaidien'])) {
    $anhdaidien = 'nhanvienkhongcohinhanh.png';
} else {
    $anhdaidien = $rownvht['nv_anhdaidien'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/font-awesome-4/css/font-awesome.min.css">
    <link rel="stylesheet" href="./vendor/fontawesome-5/css/fontawesome.min.css">
    <link rel="stylesheet" href="./vendor/datatable/datatables.min.css">
    <link rel="stylesheet" href="./vendor/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="./assets/css/sidebar.css" type="text/css">

    <?php if ($page == 'daily_work') { ?>
        <link rel="stylesheet" href="./assets/css/kanban.css">

    <?php  } else if ($page == 'qlnhanvien') { ?>
        <link rel="stylesheet" href="./assets/css/qlnv.css">
    <?php  } else if ($page == 'qlnhanvien2') { ?>
        <link rel="stylesheet" href="./assets/css/qlnv.css">
    <?php } else if ($page == 'congvieccanhan') { ?>
        <link rel="stylesheet" href="./assets/css/qlcvrieng.css">
    <?php } else if ($page == 'qlphongban') { ?>
        <link rel="stylesheet" href="./assets/css/qlpb.css">
    <?php } else if ($page == 'kehoachcv') { ?>
        <link rel="stylesheet" href="./assets/css/qlcvchung.css">
    <?php } else if ($page == 'kehoachcv_dahuy') { ?>
        <link rel="stylesheet" href="./assets/css/qlcvchung_dahuy.css">
    <?php } else if ($page == 'qlkhachhang') { ?>
        <link rel="stylesheet" href="./assets/css/qlkh.css">
    <?php } else if ($page == 'qlduan') { ?>
        <link rel="stylesheet" href="./assets/css/qlda.css">
    <?php } else if ($page == 'test') { ?>
        <link rel="stylesheet" href="./assets/css/test.css">

    <?php } ?>

</head>

<body>
    <div class="wrapper">

        <nav id="sidebar">
            <div class="sidebar-header pb-0">
                <h3><span><img loading="lazy" src="./assets/img/logovnpt.png" style="width: 200px; height: 55px;" alt=""></span><br><span>&emsp; &emsp;H???u Giang</span></h3>
            </div>
            <hr style="border: 1px dotted #b1154a;" class="mt-0 pt-0">

            <div class="text-center">
                <button type="button" class="btn btnupdate" data-toggle="modal" id="update_nv" data-target="#thongtincanhan">
                    <img src="./assets/img/nhanvien/<?= $anhdaidien ?>" class="rounded-circle avatar " style="width:140px; height:140px;" alt=""><br />

                    <h4 class="text-light"><?= $rownvht['nv_hoten'] ?></h4>
                    <h6 class="text-light"><?= $rownvht['nv_chucvu'] ?> - <?= $rownvht['pb_ten'] ?></h6>
                </button>
            </div>

            <ul class="list-unstyled components" id="ulsidebar">
                <hr>
                <li id="trangchu">
                    <a href="?page=daily_work"><i class="fa fa-home" aria-hidden="true"></i> Trang ch???</a>
                </li>

                <li id="khcvrieng">
                    <a href="?page=congvieccanhan"><i class="fa fa-list-alt" aria-hidden="true"></i> C??ng vi???c c?? nh??n</a>
                </li>
                <li id="dsnhanvien">
                    <a href="?page=qlnhanvien"><i class="fa fa-list-alt" aria-hidden="true"></i> Qu???n l?? nh??n vi??n</a>
                </li>
                <li id="dsphongban">
                    <a href="?page=qlphongban"><i class="fa fa-list-alt" aria-hidden="true"></i> Qu???n l?? ph??ng ban</a>
                </li>
                <li id="all_khcv">
                    <a href="#khcvchung" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" id="modakhcv_chung"><i class="fa fa-folder-open" aria-hidden="true"></i> K??? ho???ch c??ng vi???c</a>
                    <ul class="collapse list-unstyled" id="khcvchung">
                        <li>
                            <a href="?page=kehoachcv" id="khcv"><i class="fa fa-list-alt" aria-hidden="true"></i> K??? ho???ch c??ng vi???c chung</a>
                        </li>
                        <li>
                            <a href="?page=kehoachcv_dahuy" id="khcv_dahuy"><i class="fa fa-list-alt" aria-hidden="true"></i> K??? ho???ch c??ng vi???c ???? h???y</a>
                        </li>
                    </ul>
                </li>
                <li id="da-kh">

                    <a href="#dakh" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" id="modakh"><i class="fa fa-folder-open" aria-hidden="true"></i> D??? ??n - kh??ch h??ng</a>
                    <ul class="collapse list-unstyled" id="dakh">
                        <li>
                            <a href="?page=qlkhachhang" id="qlkh"><i class="fa fa-handshake-o" aria-hidden="true"></i> Qu???n l?? kh??ch h??ng</a>
                        </li>
                        <li>
                            <a href="?page=qlduan" id="qlda"><i class="fa fa-book" aria-hidden="true"></i> Qu???n l?? D??? ??n</a>
                        </li>

                    </ul>
                </li>

                <li id="dangxuat">
                    <a href="./pages/dangxuat.php"><i class="fa fa-power-off" aria-hidden="true"></i> ????ng xu???t</a>
                </li>
            </ul>
        </nav>
        <div id="content">
            <button type="button" id="sidebarCollapse" class="btn text-light pt-4 pb-4 px-0" title="???n/Hi???n sidebar">
                <i class="fa fa-angle-double-left" id="icons" style="font-size: 30px;" aria-hidden="true"></i>
            </button>
            <?php
            if ($page == 'daily_work') {
                include('kanban/kanban.php');
            } else if ($page == 'qlnhanvien') {
                include('quanlynhanvien/index.php');
            } else if ($page == 'qlphongban') {
                include('quanlyphongban/index.php');
            } else if ($page == 'kehoachcv') {
                include('quanlycongviecchung/index.php');
            } else if ($page == 'kehoachcv_dahuy') {
                include('quanlycongviecchungdahuy/index.php');
            } else if ($page == 'congvieccanhan') {
                include('quanlycongviecrieng/index.php');
            } else if ($page == 'qlkhachhang') {
                include('quanlykhachhang/index.php');
            } else if ($page == 'qlduan') {
                include('quanlyduan/index.php');
            } else if ($page == 'test') {
                include('test/index.php');
            } else if ($page == 'dashboard') {
                include('pages/dashboard.php');
            }
            ?>





        </div>
    </div>

    <div class="modal fade " id="thongtincanhan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ch???nh s???a th??ng tin c?? nh??n</h5>
                    <button type="button" class="close nutdongmodal" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="updatethongtin" method="post" role="form" enctype="multipart/form-data">
                    <div class="modal-body w-100">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- <div class="col-md-3"> -->
                                <div class="form-group">
                                    <div id="anhdaidien_canhan">
                                        <center><img src="./assets/img/nhanvien/<?= $anhdaidien ?>" class="rounded-circle mb-3 mx-auto text-center" style="height: 150px; width:150px;" /></center>
                                    </div>
                                    <label for=""><b>???nh ?????i di???n </b>(*)</label>
                                    <input type="file" name="nv_anhdaidien" class="form-control" id="nv_anhdaidien_canhan">
                                </div>
                                <!-- </div> -->

                                <p id="doimatkhau_canhan">Thay ?????i m???t kh???u ?</p>
                                <span id="thaydoimk_canhan"></span>

                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><b>M?? nh??n vi??n </b></label>
                                            <input type="text" class="form-control" id="ma_nv_canhan" value="NV<?= sprintf('%03d', $rownvht['nv_ma']) ?>" disabled>
                                            <input type="hidden" name="nv_ma" class="form-control" id="nv_ma_canhan" value="<?= $rownvht['nv_ma'] ?>">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><b>Email </b></label>
                                            <input type="email" name="nv_email" id="nv_email_canhan" class="form-control " value="<?= $rownvht['nv_email'] ?>" placeholder="Nh???p email nh??n vi??n" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><b>Ph??ng ban </b>(*)</label>
                                            <select name="pb_ma" id="pb_ma_canhan" class="form-control " required>
                                                <?php
                                                $sqlpb = mysqli_query($conn, "SELECT * FROM `phongban`");

                                                if ($rownvht['pb_ten'] == 'Ban qu???n tr???') { ?>
                                                    <option value="<?= $rownvht['pb_ma'] ?>" selected><?= $rownvht['pb_ten'] ?></option>
                                                    <?php } else {
                                                    while ($row = mysqli_fetch_assoc($sqlpb)) {
                                                        if ($rownvht['pb_ma'] == $row['pb_ma']) { ?>
                                                            <option value="<?= $row['pb_ma'] ?>" selected><?= $row['pb_ten'] ?></option>
                                                        <?php  } else { ?>
                                                            <option value="<?= $row['pb_ma'] ?>"><?= $row['pb_ten'] ?></option>
                                                <?php }
                                                    }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><b>Ch???c v??? </b>(*)</label>
                                            <select name="nv_chucvu" id="nv_chucvu_canhan" class="form-control " required>
                                                <?php if ($rownvht['pb_ten'] == 'Ban qu???n tr???') {
                                                    echo '<option value="Admin" selected>Admin</option>';
                                                } else { ?>
                                                    <option value="<?= $rownvht['nv_chucvu'] ?>" selected><?= $rownvht['nv_chucvu'] ?></option>
                                                    <option value="Th???c t???p sinh">Th???c t???p sinh</option>
                                                    <option value="Nh??n vi??n">Nh??n vi??n</option>
                                                    <option value="Ph?? ph??ng">Ph?? ph??ng</option>
                                                    <option value="Tr?????ng ph??ng">Tr?????ng ph??ng</option>
                                                    <option value="Th?? k??">Th?? k??</option>
                                                    <option value="Ph?? gi??m ?????c">Ph?? gi??m ?????c</option>
                                                    <option value="Gi??m ?????c">Gi??m ?????c</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for=""><b>T??n nh??n vi??n </b>(*)</label>
                                            <input type="text" name="nv_hoten" class="form-control" id="nv_hoten_canhan" placeholder="Nh???p t??n nh??n vi??n" value="<?= $rownvht['nv_hoten'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><b>Ng??y sinh </b>(*)</label>
                                            <input type="date" name="nv_ngaysinh" id="nv_ngaysinh_canhan" class="form-control" value="<?= date('Y-m-d', strtotime($rownvht['nv_ngaysinh'])) ?>" max="<?= date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><b>Gi???i t??nh </b>(*)</label><br />
                                            <?php if ($rownvht['nv_gioitinh'] == 'Nam') { ?>
                                                <label for="nv_gt_nam"><input type="radio" name="nv_gioitinh" id="nv_gt_nam_canhan" class="ml-3" value="Nam" checked>&ensp;Nam</label>
                                                <label for="nv_gt_nu"><input type="radio" name="nv_gioitinh" id="nv_gt_nu_canhan" class="ml-3" value="N???">&ensp;N???</label>
                                                <label for="nv_gt_khac"><input type="radio" name="nv_gioitinh" id="nv_gt_khac_canhan" class="ml-3" value="Kh??c">&ensp;Kh??c</label>
                                            <?php } else if ($rownvht['nv_gioitinh'] == 'N???') { ?>
                                                <label for="nv_gt_nam"><input type="radio" name="nv_gioitinh" id="nv_gt_nam_canhan" class="ml-3" value="Nam">&ensp;Nam</label>
                                                <label for="nv_gt_nu"><input type="radio" name="nv_gioitinh" id="nv_gt_nu_canhan" class="ml-3" value="N???" checked>&ensp;N???</label>
                                                <label for="nv_gt_khac"><input type="radio" name="nv_gioitinh" id="nv_gt_khac_canhan" class="ml-3" value="Kh??c">&ensp;Kh??c</label>
                                            <?php } else { ?>
                                                <label for="nv_gt_nam"><input type="radio" name="nv_gioitinh" id="nv_gt_nam_canhan" class="ml-3" value="Nam">&ensp;Nam</label>
                                                <label for="nv_gt_nu"><input type="radio" name="nv_gioitinh" id="nv_gt_nu_canhan" class="ml-3" value="N???">&ensp;N???</label>
                                                <label for="nv_gt_khac"><input type="radio" name="nv_gioitinh" id="nv_gt_khac_canhan" class="ml-3" value="Kh??c" checked>&ensp;Kh??c</label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><b>S??? ??i???n tho???i </b>(*)</label>
                                            <input type="text" name="nv_sdt" id="nv_sdt_canhan" class="form-control" value="<?= $rownvht['nv_sdt'] ?>" placeholder="S??? ??i???n tho???i c???a nh??n vi??n" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><b>?????a ch??? </b>(*)</label>
                                            <input type="text" name="nv_diachi" id="nv_diachi_canhan" class="form-control" value="<?= $rownvht['nv_diachi'] ?>" placeholder="Nh???p ?????a ch??? c???a nh??n vi??n">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">H???y b???</button>
                        <button type="submit" class="btn btnsubmit">C???p nh???t </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="./vendor/jquery/jquery.min.js"></script>
    <!-- <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./vendor/datatable/datatables.min.js"></script>
    <script src="./vendor/ckeditor5/ckeditor.js"></script>
    <script src="./vendor/select2/dist/js/select2.min.js"></script>
    <script src="./vendor/sweetalert2.all.min.js"></script>
    <script src="./assets/js/scripts.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>


    <?php if ($page == 'daily_work') : ?>
        <script src="./assets/js/kanban.js"></script>

    <?php elseif ($page == 'qlnhanvien') : ?>
        <script src="./assets/js/qlnv.js"></script>
    <?php elseif ($page == 'qlphongban') : ?>
        <script src="./assets/js/qlpb.js"></script>

    <?php elseif ($page == 'kehoachcv') : ?>
        <script src="./assets/js/qlcvchung.js"></script>
    <?php elseif ($page == 'kehoachcv_dahuy') : ?>
        <script src="./assets/js/qlcvchung_dahuy.js"></script>
    <?php elseif ($page == 'congvieccanhan') : ?>
        <script src="./assets/js/qlcvrieng.js"></script>
    <?php elseif ($page == 'qlkhachhang') : ?>
        <script src="./assets/js/qlkh.js"></script>
    <?php elseif ($page == 'qlduan') : ?>
        <script src="./assets/js/qlda.js"></script>

    <?php endif ?>

    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active')
                $('#icons').toggleClass('fa-angle-double-left');
                $('#icons').toggleClass('fa-angle-double-right');
            });
            $('.myselect2').select2({
                width: 100
            });



        });
    </script>
</body>

</html>