<title>Kế hoạch công việc chung</title>


<div class="container-fluid">
    <div class="row shadow py-3 mt-1">
        <div class="col-md-12">

            <h2 class="float-left"><b>Danh sách kế hoạch công việc</b></h2><button type="button" class="btn btn-sep btn-1  float-right ml-5 py-0 pl-0  btnadd" data-toggle="modal" data-target="#modalCRUD" id="capnhatcv">
                <span class="title-btn">&ensp;Thêm công việc mới</span>&emsp;<span class="iconadd"><i class="fa fa-plus h-100 m-0  " aria-hidden="true"></i></span>
            </button>
            <input type="hidden" name="nv_chinhsua" id="nv_chinhsua" value="<?= $rownvht['nv_ma'] ?>">
            <input type="hidden" id="manvht" value="<?= $rownvht['nv_ma'] ?>">
            <div class="table-responsive">
                <hr>
                <table id="quanlycongviecrieng" width="100%" class="table w-100 table-bordered table-striped display">
                    <thead>
                        <tr style="background-color: #212596;" id="cottieude">
                            <th style="width: 5%;" class="px-0 text-center">
                                STT
                            </th>
                            <th style="width: 5%;" class="px-0" title="">Mã CV</th>
                            <th style="width: 20%;" class="px-0" title="">Nội dung</th>
                            <th style="width: 10%;" class="px-0">Dự án</th>
                            <th style="width: 7%;" class="px-0">Thời gian bắt đầu</th>
                            <th style="width: 7%;" class="px-0">Thời hạn hoàn thành</th>
                            <th style="width: 5%;" class="px-0">Trạng thái thực hiện</th>
                            <th style="width: 9%;" class="px-0">NV lập kế hoạch</th>
                            <th style="width: 5%;" class="px-0">Mã CV Cha</th>
                            <th style="width: 15%;" class="px-0">Ghi chú</th>
                            <th style="width: 7%;" class="px-0" data-orderable="false">Tồn Tuần</th>
                            <th style="width: 10%;" class="px-0 " data-orderable="false">Nhật ký</th>
                            <th style="width: 5%;" data-orderable="false">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="modalCRUD" data-backdrop="static" aria-labelledby="modalCRUDLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal-titles" id="modalCRUDLabel">Thêm công việc mới</h5>
                <button type="button" class="close nutdongmodal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formCV" novalidate>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Dự án</b>(*)</label>
                                <select name="duan" id="duan" class="form-control myselect2 w-100" style="width:100% !important;" required>
                                    <option value="" disabled selected>---Chọn dự án---</option>
                                    <?php $da = mysqli_query($conn, "SELECT * FROM `duan`");
                                    while ($rowda = mysqli_fetch_assoc($da)) { ?>
                                        <option value="<?= $rowda['da_ma'] ?>"><?= $rowda['da_ten'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Công việc cha (Nếu có)</b></label>
                                <select name="congvieccha" id="congvieccha" class="form-control myselect2 w-100" style="width:100% !important;">
                                    <option value="" selected>---Chọn công việc cha---</option>
                                    <?php $khcv = mysqli_query($conn, "SELECT * FROM `kehoachcongviec`");

                                    while ($rowkhcv = mysqli_fetch_assoc($khcv)) { ?>
                                        <option value="<?= $rowkhcv['khcv_ma'] ?>"><?= $rowkhcv['khcv_noidung'] ?></option>
                                    <?php }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><b>Ngày bắt đầu thực hiện</b>(*)</label>
                                <input type="date" name="ngaybatdau" class="form-control" id="ngaybatdau" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><b>Thời hạn công việc</b>(*)</label>
                                <input type="date" name="ngayketthuc" class="form-control" id="ngayketthuc" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for=""><b>Tuần</b></label>
                            <input type="text" id="sotuan" class="form-control" disabled>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="trangthaicv"><b>Trạng thái</b></label>
                                <select name="trangthaicv" id="trangthaicv" class="form-control">
                                    <option value="Chưa thực hiện" selected>Chưa thực hiện</option>
                                    <option value="Đang thực hiện">Đang thực hiện</option>
                                    <option value="Hoàn thành">Hoàn thành</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ndcv"><b>Nội dung công việc</b>(*)</label>
                                <textarea name="noidung" id="ndcv" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ghichu"><b>Ghi chú</b></label>
                                <textarea name="ghichu" id="ghichu" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- <input type="hidden" name="nvlkh" id="nvlkh" value="<?= $rownvht['nv_ma'] ?>"> -->
                    <input type="hidden" name="khcv" id="khcv">
                    <div class="row d-none" id="nvthamgia" >
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nvthuchien"><b>Nhân viên lập kế hoạch </b>(*)</label>
                                <select class="form-control myselect2" name="nvlkh" id="nvlkh" disabled>
                                    <?php $nvlkh = mysqli_query($conn, "SELECT * FROM `nhanvien`");
                                    while ($rownvlkh = mysqli_fetch_assoc($nvlkh)) { ?>
                                        <option value="<?= $rownvlkh['nv_ma'] ?>"><?= 'NV' . sprintf('%03d', $rownvlkh['nv_ma']) . ' - ' . $rownvlkh['nv_hoten'] ?></option>
                                    <?php } ?>
                                </select>




                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="nvthuchien"><b>Nhân viên thực hiện </b>(*)</label>
                                <select name="nvthuchien" id="nvthuchien" class="form-control myselect2" required>
                                    <option selected disabled>----Chọn nhân viên thực hiện công việc----</option>

                                    <?php $nvth = mysqli_query($conn, "SELECT * FROM `nhanvien`");
                                    while ($rownvth = mysqli_fetch_assoc($nvth)) {
                                        if ($rownvth['nv_ma'] == $rownvht['nv_ma']) { ?>
                                            <option value="<?= $rownvht['nv_ma'] ?>" selected><?= 'NV' . sprintf('%03d', $rownvht['nv_ma']) . ' - ' . $rownvht['nv_hoten'] ?></option>
                                        <?php } else {     ?>
                                            <option value="<?= $rownvth['nv_ma'] ?>"><?= 'NV' . sprintf('%03d', $rownvth['nv_ma']) . ' - ' . $rownvth['nv_hoten'] ?></option>
                                    <?php }
                                    }
                                    ?>
                                </select>


                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btnsubmit">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCRUD_update" data-backdrop="static" aria-labelledby="modalCRUDLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal-titles" id="modalCRUDLabel">Hiệu chỉnh công việc</h5>
                <button type="button" class="close nutdongmodal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formCV_update" novalidate>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Dự án</b>(*)</label>
                                <select name="duan" id="duan_update" class="form-control myselect2 w-100" style="width:100% !important;" disabled>
                                    <option value="" disabled selected>---Chọn dự án---</option>
                                    <?php $da = mysqli_query($conn, "SELECT * FROM `duan`");
                                    while ($rowda = mysqli_fetch_assoc($da)) { ?>
                                        <option value="<?= $rowda['da_ma'] ?>"><?= $rowda['da_ten'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Công việc cha (Nếu có)</b></label>
                                <select name="congvieccha" id="congvieccha_update" class="form-control myselect2 w-100" style="width:100% !important;">
                                    <option value="" selected>---Chọn công việc cha---</option>
                                    <?php $khcv = mysqli_query($conn, "SELECT * FROM `kehoachcongviec`");

                                    while ($rowkhcv = mysqli_fetch_assoc($khcv)) { ?>
                                        <option value="<?= $rowkhcv['khcv_ma'] ?>"><?= $rowkhcv['khcv_noidung'] ?></option>
                                    <?php }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><b>Ngày bắt đầu thực hiện</b>(*)</label>
                                <input type="date" name="ngaybatdau" class="form-control" id="ngaybatdau_update" required disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><b>Thời hạn công việc</b>(*)</label>
                                <input type="date" name="ngayketthuc" class="form-control" id="ngayketthuc_update" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for=""><b>Tuần</b></label>
                            <input type="text" id="sotuan_update" class="form-control" disabled>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="trangthaicv_update"><b>Trạng thái</b></label>
                                <select name="trangthaicv" id="trangthaicv_update" class="form-control">
                                    <option value="Chưa thực hiện" selected>Chưa thực hiện</option>
                                    <option value="Đang thực hiện">Đang thực hiện</option>
                                    <option value="Hoàn thành">Hoàn thành</option>
                                    <option value="Đã hủy">Đã hủy</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ndcv_update"><b>Nội dung công việc</b>(*)</label>
                                <textarea name="noidung" id="ndcv_update" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ghichu_update"><b>Ghi chú</b></label>
                                <textarea name="ghichu" id="ghichu_update" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- <input type="hidden" name="nvlkh" id="nvlkh" value="<?= $rownvht['nv_ma'] ?>"> -->
                    <input type="hidden" name="khcv" id="khcv_update">
                    <div class="row d-none" id="nvthamgia_update" >
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nvthuchien"><b>Nhân viên lập kế hoạch </b>(*)</label>
                                <select class="form-control myselect2" name="nvlkh" id="nvlkh_update" disabled>
                                    <?php $nvlkh = mysqli_query($conn, "SELECT * FROM `nhanvien`");
                                    while ($rownvlkh = mysqli_fetch_assoc($nvlkh)) { ?>
                                        <option value="<?= $rownvlkh['nv_ma'] ?>"><?= 'NV' . sprintf('%03d', $rownvlkh['nv_ma']) . ' - ' . $rownvlkh['nv_hoten'] ?></option>
                                    <?php } ?>
                                </select>




                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="nvthuchien"><b>Nhân viên thực hiện </b>(*)</label>
                                <select name="nvthuchien" id="nvthuchien_update" class="form-control myselect2" required>
                                    <option selected disabled>----Chọn nhân viên thực hiện công việc----</option>

                                    <?php $nvth = mysqli_query($conn, "SELECT * FROM `nhanvien`");
                                    while ($rownvth = mysqli_fetch_assoc($nvth)) {
                                        if ($rownvth['nv_ma'] == $rownvht['nv_ma']) { ?>
                                            <option value="<?= $rownvht['nv_ma'] ?>" selected><?= 'NV' . sprintf('%03d', $rownvht['nv_ma']) . ' - ' . $rownvht['nv_hoten'] ?></option>
                                        <?php } else {     ?>
                                            <option value="<?= $rownvth['nv_ma'] ?>"><?= 'NV' . sprintf('%03d', $rownvth['nv_ma']) . ' - ' . $rownvth['nv_hoten'] ?></option>
                                    <?php }
                                    }
                                    ?>
                                </select>


                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btnsubmit">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>