$('#nv_anhdaidien_canhan').change(function () {
    // $("#anhdaidien").html('');
    $("#anhdaidien_canhan").html('<center><img src="./assets/img/nhanvien/nhanvienkhongcohinhanh.png" class="rounded-circle mb-3 mx-auto text-center" style="height: 150px; width:150px;"/></center>');
    var file = this.files[0];
    var fileType = file["type"];
    var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
    if ($.inArray(fileType, validImageTypes) < 0) {
        Swal.fire(
            'Không phải hình ảnh!',
            'Vui lòng nhập đầy đủ thông tin cần thiết',
            'warning'
        );
        $("#anhdaidien_canhan").html('<center><img src="./assets/img/nhanvien/nhanvienkhongcohinhanh.png" class="rounded-circle mb-3 mx-auto text-center" style="height: 150px; width:150px;"/></center>');
        $('#nv_anhdaidien_canhan').val('');
    } else {

        for (var i = 0; i < $(this)[0].files.length; i++) {
            $("#anhdaidien_canhan").html('<center><img src="' + window.URL.createObjectURL(this.files[i]) + '" class="rounded-circle mb-3 mx-auto text-center" style="height: 150px; width:150px;"/></center>');
            nv_anhdaidien = $(this)[0].files[0];
        }
    }
});
function showmk() {
    var a = document.getElementById("nv_oldmatkhau_canhan");
    var b = document.getElementById("nv_matkhau_canhan");
    var c = document.getElementById("nv_pre_mk_canhan");


    if (a.type === "password" && b.type === "password" && a.type === "password") {
        a.type = "text";
        b.type = "text";
        c.type = "text";

    } else {
        a.type = "password";
        b.type = "password";
        c.type = "password";
    }
};

$('#doimatkhau_canhan').click(function () {
    var html = '<div class="form-group">';
    html += '    <label for=""><b>Mật khẩu cũ </b>(*)</label>';
    html += '    <input type="password" name="nv_oldmatkhau" id="nv_oldmatkhau_canhan" class="form-control nv_oldmatkhau_canhan " placeholder="Nhập mật khẩu cũ" >';
    html += '</div>';
    html += '<div class="form-group">';
    html += '    <label for=""><b>Mật khẩu mới </b>(*)</label>';
    html += '    <input type="password" name="nv_matkhau" id="nv_matkhau_canhan" class="form-control nv_matkhau_canhan " placeholder="Nhập mật khẩu mới" >';
    html += '</div>';
    html += '<div class="form-group">';
    html += '    <label for=""><b>Nhập lại mật khẩu </b>(*)</label>';
    html += '    <input type="password" name="nv_pre_mk" id="nv_pre_mk_canhan" class="form-control nv_pre_mk_canhan" placeholder="Xác nhập lại mật khẩu mới" >';
    html += '</div>';
    html += '<div class="form-group">';
    html += '    <label for="showmk">';
    html += '        <input type="checkbox" class="showmk_canhan" onclick="showmk()">&ensp;Hiện thị mật khẩu';
    html += '    </label>';
    html += '</div>';

    $('#thaydoimk_canhan').html(html);
    $('#doimatkhau_canhan').html('');
});

$("#update_nv").click(function () {
    option = 1;
    // var x = document.getElementById("nv_oldmatkhau_canhan");
    // var y = document.getElementById("nv_matkhau_canhan");
    // var z = document.getElementById("nv_pre_mk_canhan");
    // x.type = "password";
    // y.type = "password";
    // z.type = "password";
    $('#doimatkhau_canhan').html('Thay đổi mật khẩu ?');
    $('#thaydoimk_canhan').html('');
    $("#updatethongtin").trigger("reset");
    $(".modal-header , .nutdongmodal, .btnsubmit").css("background-color", "#fdac53");
    $(".modal-header , .nutdongmodal, .btnsubmit").css("color", "white");
    // $('#thongtincanhan').modal('show');
});

$('#updatethongtin').submit(function (e) {
    e.preventDefault();
    nv_ma = $.trim($('#nv_ma_canhan').val());
    nv_hoten = $.trim($('#nv_hoten_canhan').val());
    nv_chucvu = $.trim($('#nv_chucvu_canhan').val());
    pb_ma = $.trim($('#pb_ma_canhan').val());
    nv_ngaysinh = $.trim($('#nv_ngaysinh_canhan').val());

    nv_matkhau = $.trim($('#nv_matkhau_canhan').val());
    nv_oldmatkhau = $.trim($('#nv_oldmatkhau_canhan').val());
    nv_pre_mk = $.trim($('#nv_pre_mk_canhan').val());
    nv_diachi = $.trim($('#nv_diachi_canhan').val());
    nv_sdt = $.trim($('#nv_sdt_canhan').val());
    nv_gioitinh = $('input[name="nv_gioitinh"]:checked').val();
 
    var form = $('#updatethongtin');
    var formdata = false;

    if (window.FormData) {
        formdata = new FormData(form[0]);
        console.log(formdata)
    }
    if (nv_pre_mk === nv_matkhau) {

        $.ajax({
            url: "./pages/crud.php",
            type: "POST",
            datatype: "json",
            cache: false,
            contentType: false,
            processData: false,
            data: formdata ? formdata : form.serialize(),

            success: function (data) {

                if (data.search("error:Cập nhật nhân viên thất bại!") != -1) {
                    texticon_canhan = 'error';
                    texttitle_canhan = 'Cập nhật nhân viên thất bại!';
                } else if (data.search("error:Mật khẩu cũ không đúng!") != -1) {
                    texticon_canhan = 'error';
                    texttitle_canhan = 'Mật khẩu cũ không đúng!';
                } else {
                    texticon_canhan = 'success';
                    texttitle_canhan = 'Cập nhật nhân viên thành công';

                }
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: texticon_canhan,
                    title: texttitle_canhan,
                });
             
            }
        });
        $('#thongtincanhan').modal('hide');
        setTimeout(function(){ location.reload(); }, 2000);
    } else {

        Swal.fire(
            'Mật khẩu không trùng khớp!',
            'Vui lòng kiểm tra lại mật khẩu của bạn',
            'warning'
        );

    }
});