<?php
$phongban = mysqli_query($conn, "SELECT * FROM `phongban`");
$dspb = [];
while ($rowpb = mysqli_fetch_array($phongban, MYSQLI_ASSOC)) {
    $dspb[] = [
        'pb_ma'  =>  $rowpb['pb_ma'],
        'pb_ten'  =>  $rowpb['pb_ten']
    ];
}
?>
<title>Quản lý nhân viên</title>
<div class="container-fluid">
    <div class="row shadow py-3 mt-1">
        <div class="col-md-12">

            <h2 class="float-left"><b>Danh sách nhân viên</b></h2>
            <?php if ($rownvht['nv_chucvu'] == 'Admin') {?>
            <button type="button" class="btn  float-right ml-5 py-0 pl-0  btnadd" data-toggle="modal" data-target="#modalCRUD" id="themnv">
                <span class="title-btn">&ensp;Thêm nhân viên</span>&emsp;<span class="iconadd"><i class="fa fa-plus h-100 m-0  " aria-hidden="true"></i></span>
            </button>
            <?php } ?>
            <!-- <div id="userstable_filter" class="mb-3">
            </div>
            
            <div id="alert_message"></div> -->
            <input type="hidden" id="nvht_chucvu" value="<?= $rownvht['nv_chucvu'] ?>">
            <div class="table-responsive">
                <hr>
                <table id="quanlynhanvien" width="100%" class="table w-100 table-bordered table-striped display">
                    <thead>
                        <tr style="background-color: #212596;" id="cottieude">
                            <th width="5%" class="px-0" title="Thêm thành viên">STT</th>
                            <th width="" class="px-0">Mã NV</th>
                            <th width="" data-orderable="false" class="px-0">Ảnh</th>
                            <th width="" class="px-0">Họ tên</th>
                            <th width="" class="px-0">Giới tính</th>
                            <th width="" class="px-0">Ngày sinh</th>
                            <th width="" class="px-0">SĐT</th>
                            <th width="" class="px-0">Email</th>
                            <th width="" class="px-0">Phòng Ban</th>
                            <th width="" class="px-0">Chức vụ</th>
                            <th width="" class="px-0">Địa chỉ</th>
                            <?php if ($rownvht['nv_chucvu'] == 'Admin') {?>
                            <th width="" class="px-0" data-orderable="false">Hành động</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody></tbody>


                </table>
            </div>
        </div>
    </div>
</div>



<div class="modal fade " id="modalCRUD" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " style="border-radius: 24px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Thêm nhân viên</h5>
                <button type="button" class="close nutdongmodal" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <form id="formNV" method="post" role="form" enctype="multipart/form-data">
                <div class="modal-body w-100">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row " id="step-1">
                                <div class="col-md-12">
                                    <span id="baoloi" class="w-100"></span>
                                    <div class="form-group">
                                        <div id="anhdaidien">
                                            <center><img src="./assets/img/nhanvien/nhanvienkhongcohinhanh.png" class="rounded-circle mb-3 mx-auto text-center" style="height: 150px; width:150px;" /></center>
                                        </div>
                                        <label for=""><b>Ảnh đại diện </b>(*)</label>
                                        <input type="file" name="nv_anhdaidien" class="form-control" id="nv_anhdaidien">
                                        <input type="hidden" name="option" class="form-control"  id="option">
                                        <input type="hidden" name="nv_chinhsua" class="form-control"   value="<?= $rownvht['nv_ma'] ?>">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""><b>Tên nhân viên </b>(*)</label>
                                                <input type="text" name="nv_hoten" class="form-control" id="nv_hoten" placeholder="Nhập tên nhân viên" required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b>Phòng ban </b>(*)</label>
                                                <select name="pb_ma" id="pb_ma" class="form-control " required>
                                                    <option class="text-center" selected disabled>-----------------Chọn phòng ban-----------------</option>
                                                    <?php foreach ($dspb as $row) :
                                                        if ($row['pb_ma'] == '1') {
                                                            if ($rownvht['pb_ma'] == '1' && $rownvht['pb_ten'] == 'Ban quản trị') { ?>
                                                                <option value="<?= $row['pb_ma'] ?>"><?= $row['pb_ten'] ?></option>
                                                            <?php } else {
                                                            } ?>

                                                        <?php  } else { ?>
                                                            <option value="<?= $row['pb_ma'] ?>"><?= $row['pb_ten'] ?></option>
                                                    <?php }
                                                    endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b>Chức vụ </b>(*)</label>
                                                <select name="nv_chucvu" id="nv_chucvu" class="form-control " required>
                                                    <option class="text-center" selected disabled>-----------------Chọn chức vụ-----------------</option>
                                                    <option value="Thực tập sinh">Thực tập sinh</option>
                                                    <option value="Nhân viên">Nhân viên</option>
                                                    <option value="Phó phòng">Phó phòng</option>
                                                    <option value="Trưởng phòng">Trưởng phòng</option>
                                                    <option value="Thư ký">Thư ký</option>
                                                    <option value="Phó giám đốc">Phó giám đốc</option>
                                                    <option value="Giám đốc">Giám đốc</option>
                                                    <?php if ($rownvht['pb_ma'] == '1' && $rownvht['pb_ten'] == 'Ban quản trị') { ?>
                                                        <option value="Admin">Admin</option>
                                                    <?php } ?>


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b>Ngày sinh </b>(*)</label>
                                                <input type="date" name="nv_ngaysinh" id="nv_ngaysinh" class="form-control" value="2000-01-01" max="<?= date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><b>Giới tính </b>(*)</label><br />
                                                <label for="nv_gt_nam">
                                                    <input type="radio" name="nv_gioitinh" id="nv_gt_nam" class="ml-3" value="Nam">&ensp;Nam
                                                </label>
                                                <label for="nv_gt_nu">
                                                    <input type="radio" name="nv_gioitinh" id="nv_gt_nu" class="ml-3" value="Nữ">&ensp;Nữ
                                                </label>
                                                <label for="nv_gt_khac">
                                                    <input type="radio" name="nv_gioitinh" id="nv_gt_khac" class="ml-3" value="Khác" checked>&ensp;Khác
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b>Số điện thoại </b>(*)</label>
                                                <input type="text" name="nv_sdt" id="nv_sdt" class="form-control" placeholder="Số điện thoại của nhân viên" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b>Địa chỉ </b>(*)</label>
                                                <input type="text" name="nv_diachi" id="nv_diachi" class="form-control " placeholder="Nhập địa chỉ của nhân viên">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-none" id="step-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for=""><b>Email </b>(*)</label>
                                        <input type="email" name="nv_email" id="nv_email" class="form-control " placeholder="Nhập email nhân viên">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Mật khẩu </b>(*)</label>
                                        <input type="password" name="nv_matkhau" id="nv_matkhau" class="form-control " placeholder="Nhập mật khẩu" required>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b>Nhập lại mật khẩu </b>(*)</label>
                                        <input type="password" name="nv_pre_mk" id="nv_pre_mk" class="form-control " placeholder="Xác nhập lại mật khẩu" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="showmk">
                                            <input type="checkbox" id="showmk">&ensp;Hiện thị mật khẩu
                                        </label>
                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="button" class="btn btn-warning d-none" id="lui">Trở về</button>
                    <button type="button" class="btn btn-success" id="tiep">Tiếp</button>
                    <span id="btn-save"></span>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade " id="modalUPDATE" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Thêm nhân viên</h5>
                <button type="button" class="close nutdongmodal" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <form id="formNV_update" method="post" role="form" enctype="multipart/form-data">
                <div class="modal-body w-100">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- <div class="col-md-3"> -->
                            <div class="form-group">
                                <div id="anhdaidien_update">
                                    <center><img src="./assets/img/nhanvien/nhanvienkhongcohinhanh.png" class="rounded-circle mb-3 mx-auto text-center" style="height: 150px; width:150px;" /></center>
                                </div>
                                <label for=""><b>Ảnh đại diện </b>(*)</label>
                                <input type="file" name="nv_anhdaidien" class="form-control" id="nv_anhdaidien_update">
                            </div>
                            <!-- </div> -->
                            <?php if ($rownvht['nv_chucvu'] == 'Admin') { ?>
                                <p id="doimatkhau">Thay đổi mật khẩu ?</p>
                                <span id="thaydoimk"></span>
                            <?php }  ?>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><b>Mã nhân viên </b></label>
                                        <input type="text" class="form-control" id="ma_nv_update" disabled>
                                        <input type="hidden" name="nv_ma" class="form-control" id="nv_ma_update">
                                        <input type="hidden" name="option" class="form-control" id="option_update">
                                        <input type="hidden" name="nv_chinhsua" class="form-control"   value="<?= $rownvht['nv_ma'] ?>">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><b>Email </b></label>
                                        <input type="email" name="nv_email" id="nv_email_update" class="form-control " placeholder="Nhập email nhân viên" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><b>Phòng ban </b>(*)</label>
                                        <select name="pb_ma" id="pb_ma_update" class="form-control " required>
                                            <option class="text-center" selected disabled>-----------------Chọn phòng ban-----------------</option>
                                            <?php foreach ($dspb as $row) : ?>
                                                <option value="<?= $row['pb_ma'] ?>"><?= $row['pb_ten'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><b>Chức vụ </b>(*)</label>
                                        <select name="nv_chucvu" id="nv_chucvu_update" class="form-control " required>
                                            <option class="text-center" selected disabled>-----------------Chọn chức vụ-----------------</option>
                                            <option value="Thực tập sinh">Thực tập sinh</option>
                                            <option value="Nhân viên">Nhân viên</option>
                                            <option value="Phó phòng">Phó phòng</option>
                                            <option value="Trưởng phòng">Trưởng phòng</option>
                                            <option value="Thư ký">Thư ký</option>
                                            <option value="Phó giám đốc">Phó giám đốc</option>
                                            
                                            <option value="Giám đốc">Giám đốc</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for=""><b>Tên nhân viên </b>(*)</label>
                                        <input type="text" name="nv_hoten" class="form-control" id="nv_hoten_update" placeholder="Nhập tên nhân viên" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><b>Ngày sinh </b>(*)</label>
                                        <input type="date" name="nv_ngaysinh" id="nv_ngaysinh_update" class="form-control" value="2000-01-01" max="<?= date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>Giới tính </b>(*)</label><br />
                                        <label for="nv_gt_nam">
                                            <input type="radio" name="nv_gioitinh" id="nv_gt_nam_update" class="ml-3" value="Nam">&ensp;Nam
                                        </label>
                                        <label for="nv_gt_nu">
                                            <input type="radio" name="nv_gioitinh" id="nv_gt_nu_update" class="ml-3" value="Nữ">&ensp;Nữ
                                        </label>
                                        <label for="nv_gt_khac">
                                            <input type="radio" name="nv_gioitinh" id="nv_gt_khac_update" class="ml-3" value="Khác" checked>&ensp;Khác
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><b>Số điện thoại </b>(*)</label>
                                        <input type="text" name="nv_sdt" id="nv_sdt_update" class="form-control" placeholder="Số điện thoại của nhân viên" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><b>Địa chỉ </b>(*)</label>
                                        <input type="text" name="nv_diachi" id="nv_diachi_update" class="form-control " placeholder="Nhập địa chỉ của nhân viên">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btnsubmit">Cập nhật </button>
                </div>
            </form>
        </div>
    </div>
</div>