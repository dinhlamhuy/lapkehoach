<title>Quản lý dự án</title>
<div class="container-fluid">
    <div class="row shadow py-3 mt-5">
        <div class="col-md-12">
        <h2 class="float-left"><b>Danh sách dự án</b></h2>
            <div class="text-right">
            <button type="button" class="btn  float-right ml-5 py-0 pl-0  btnadd" data-toggle="modal" id="btnthemda" data-target="#modalCRUD">
                     <span class="title-btn">&ensp;Thêm dự án</span>&emsp;<span class="iconadd"><i class="fa fa-plus h-100 m-0  " aria-hidden="true" ></i></span>
                </button>
            </div>
            <div class="table-responsive">
                <hr>
                <table id="quanlyduan" width="100%" class="table w-100 table-bordered display">
                    <thead>
                        <tr style="background-color: #361999;" id="cottieude">
                            <th class="px-0" width="5%">
                                STT
                            </th>
                            <th class="px-0" width="10%" title="Mã dự án">Mã dự án</th>
                            <th class="px-0" width="30%" title="Dự án">Dự án</th>
                            <th class="px-0" width="20%" title="Khách hàng">Khách hàng</th>
                            <th class="px-0" width="15%" title="Hạn hoàn thành">Hạn hoàn thành</th>
                            <th class="px-0" width="10%" title="Trạng thái">Trạng thái</th>
                            <?php if($rownvht['nv_chucvu']=='Admin'){?>
                                <th class="px-0" width="10%" data-orderable="false">Hành động </th>

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
<div class="modal fade" id="modalCRUD" tabindex="-1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalCRUDLabel" aria-hidden="true" style="margin-top: 60px !important;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCRUDLabel"></h5>
                <button type="button" class="close" id="nutdongmodal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formDA">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="da_ma"><b>Mã dự án</b> (*)</label>
                                <input type="text" class="form-control" id="da_ma" name="da_ma" style="cursor: not-allowed;" disabled>
                                <input type="hidden" class="form-control" name="id_da" id="id_da">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="da_ten"><b>Tên Dự án</b> (*)</label>
                                <input type="text" class="form-control" name="da_ten" id="da_ten" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kh_ma"><b>Khách hàng</b> (*)</label>
                                <select class="form-control" name="kh_ma" id="kh_ma" required>
                                    <option class="text-center" disabled selected>---Chọn khách hàng---</option>
                                    <?php $kh = mysqli_query($conn, "SELECT `kh_ma`, `kh_ten` FROM `khachhang`");
                                    while ($rowkh = mysqli_fetch_assoc($kh)) { ?>
                                        <option value="<?= $rowkh['kh_ma'] ?>"><?= $rowkh['kh_ten'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="da_thoihan"><b>Hạn hoàn thành</b> (*)</label>
                                <input type="date" class="form-control" id="da_thoihan" name="da_thoihan" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="da_trangthai"><b>Trạng thái</b> (*)</label>
                                <select class="form-control" id="da_trangthai" name="da_trangthai" required>

                                    <option value="Chưa hoàn thành" selected>Chưa hoàn thành</option>
                                    <option value="Hoàn thành">Hoàn thành</option>
                                </select>
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