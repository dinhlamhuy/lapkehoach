<title>Quản lý khách hàng</title>
<div class="container-fluid">
    <div class="row shadow py-3 mt-1">
        <div class="col-md-12">
            <h2 class="float-left"><b>Danh sách khách hàng</b></h2>
            <button type="button" class="btn  float-right ml-5 py-0 pl-0  btnadd" data-toggle="modal" id="btnthemkh" data-target="#modalCRUD">
                <span class="title-btn">&ensp;Thêm khách hàng</span>&emsp;<span class="iconadd"><i class="fa fa-plus h-100 m-0  " aria-hidden="true"></i></span>
            </button>
            <div class="table-responsive">
                <hr>
                <table id="quanlykhachhang" width="100%" class="table w-100 table-bordered table-striped display">
                    <thead>
                        <tr style="background-color: #361999;" id="cottieude">
                            <th class="px-0" width="5%">
                                STT
                            </th>
                            <th class="px-0" width="10%" title="Mã khách hàng">Mã khách hàng</th>
                            <th class="px-0" width="30%" title="Tên khách hàng">Tên khách hàng</th>
                            <th class="px-0" width="15%" title="Liên hệ">Liên hệ</th>
                            <th class="px-0" width="15%" title="Email">Email</th>
                            <th class="px-0" width="20%" title="Địa chỉ">Địa chỉ</th>
                            <?php if($rownvht['nv_chucvu']=='Admin'){?>
                                <th class="px-0" width="25%" data-orderable="false">Hành động </th>

                           <?php  }  ?>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="nvht_chucvu" value="<?= $rownvht['nv_chucvu'] ?>">

<!-- Modal -->
<div class="modal fade" id="modalCRUD" tabindex="-1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalCRUDLabel" aria-hidden="true" style="margin-top: 90px !important;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCRUDLabel"></h5>
                <button type="button" class="close" id="nutdongmodal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formKH">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kh_ma"><b>Mã khách hàng</b> (*)</label>
                                <input type="text" class="form-control" id="kh_ma" name="kh_ma" style="cursor: not-allowed;" disabled>
                                <input type="hidden" class="form-control" name="id_kh" id="id_kh">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kh_ten"><b>Tên khách hàng</b> (*)</label>
                                <input type="text" class="form-control" name="kh_ten" id="kh_ten" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kh_sdt"><b>Số điện thoại</b> (*)</label>
                                <input type="tel" class="form-control" id="kh_sdt" name="kh_sdt" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kh_email"><b>Email</b> (*)</label>
                                <input type="email" class="form-control" id="kh_email" name="kh_email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kh_ten"><b>Địa chỉ khách hàng</b> (*)</label>
                                <input type="text" class="form-control" name="kh_diachi" id="kh_diachi" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn" id="btnsubmit">Thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>