<title>Quản lý phòng ban</title>
<div class="container-fluid">
    <div class="row shadow py-3 mt-1">
        <div class="col-md-12">
            <h2 class="float-left"><b>Danh sách phòng ban</b></h2>
            <?php if ($rownvht['nv_chucvu'] == 'Admin') {?>
                <button type="button" class="btn  float-right ml-5 py-0 pl-0  btnadd" id="add">
                <span class="title-btn">&ensp;Thêm phòng ban</span>&emsp;<span class="iconadd"><i class="fa fa-plus h-100 m-0  " aria-hidden="true"></i></span>
            </button>
            <?php } ?>
            <input type="hidden" id="nvht_chucvu" value="<?= $rownvht['nv_chucvu'] ?>">
            <div class="table-responsive">
                <hr>
                <table id="quanlyphongban" width="100%" class="table w-100 table-bordered display">
                    <thead>
                        <tr style="background-color: #212596;" id="cottieude">
                            <th class="px-0" width="15%">
                                STT
                            </th>
                            <th class="px-0" width="20%" title="Mã Ban">Mã Ban</th>
                            <th class="px-0" width="45%" title="Phòng Ban">Phòng ban</th>
                            <?php if ($rownvht['nv_chucvu'] == 'Admin') {

                                echo '<th class="px-0" width="20%" data-orderable="false">Hành động </th>';
                            }  ?>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCRUD" tabindex="-1" aria-labelledby="modalCRUDLabel" aria-hidden="true" style="margin-top: 90px !important;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCRUDLabel"></h5>
                <button type="button" class="close nutdongmodal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formPB">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ma_pb">Mã phòng ban</label>
                                <input type="text" class="form-control" id="ma_pb" style="cursor: not-allowed;" disabled>
                                <input type="hidden" class="form-control" id="id_pb">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pb_ten">Tên phòng ban</label>
                                <input type="text" class="form-control" id="ten_pb">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btnsubmit">Thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>