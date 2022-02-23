$('#dsnhanvien').addClass('active');
var nv_anhdaidien, option, dong;
option = 4;

$('#nv_anhdaidien').change(function () {
    // $("#anhdaidien").html('');
    $("#anhdaidien").html('<center><img src="./assets/img/nhanvien/nhanvienkhongcohinhanh.png" class="rounded-circle mb-3 mx-auto text-center" style="height: 150px; width:150px;"/></center>');
    var file = this.files[0];
    var fileType = file["type"];
    var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
    if ($.inArray(fileType, validImageTypes) < 0) {
        Swal.fire(
            'Không phải hình ảnh!',
            'Vui lòng nhập đầy đủ thông tin cần thiết',
            'warning'
        );
        $("#anhdaidien").html('<center><img src="./assets/img/nhanvien/nhanvienkhongcohinhanh.png" class="rounded-circle mb-3 mx-auto text-center" style="height: 150px; width:150px;"/></center>');
        $('#nv_anhdaidien').val('');
    } else {

        for (var i = 0; i < $(this)[0].files.length; i++) {
            $("#anhdaidien").html('<center><img src="' + window.URL.createObjectURL(this.files[i]) + '" class="rounded-circle mb-3 mx-auto text-center" style="height: 150px; width:150px;"/></center>');
            nv_anhdaidien = $(this)[0].files[0];
        }
    }



});

$('#nv_anhdaidien_update').change(function () {
    // $("#anhdaidien").html('');
    $("#anhdaidien_update").html('<center><img src="./assets/img/nhanvien/nhanvienkhongcohinhanh.png" class="rounded-circle mb-3 mx-auto text-center" style="height: 150px; width:150px;"/></center>');
    var file = this.files[0];
    var fileType = file["type"];
    var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
    if ($.inArray(fileType, validImageTypes) < 0) {
        Swal.fire(
            'Không phải hình ảnh!',
            'Vui lòng nhập đầy đủ thông tin cần thiết',
            'warning'
        );
        $("#anhdaidien_update").html('<center><img src="./assets/img/nhanvien/nhanvienkhongcohinhanh.png" class="rounded-circle mb-3 mx-auto text-center" style="height: 150px; width:150px;"/></center>');
        $('#nv_anhdaidien_update').val('');
    } else {

        for (var i = 0; i < $(this)[0].files.length; i++) {
            $("#anhdaidien_update").html('<center><img src="' + window.URL.createObjectURL(this.files[i]) + '" class="rounded-circle mb-3 mx-auto text-center" style="height: 150px; width:150px;"/></center>');
            nv_anhdaidien = $(this)[0].files[0];
        }
    }
});

$('#showmk').on('click', function () {
    var x = document.getElementById("nv_matkhau");
    var y = document.getElementById("nv_pre_mk");

    if (x.type === "password" && y.type === "password") {
        x.type = "text";
        y.type = "text";

    } else {
        x.type = "password";
        y.type = "password";
    }
});

function showmk() {
    var a = document.getElementById("nv_oldmatkhau_update");
    var b = document.getElementById("nv_matkhau_update");
    var c = document.getElementById("nv_pre_mk_update");


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


$('#tiep').on('click', function () {
    if ($('#nv_hoten').val() == '' && $('#nv_sdt').val() == '' && $('#nv_diachi').val() == '') {
        Swal.fire(
            'Không được bỏ qua thông tin!',
            'Vui lòng nhập đầy đủ thông tin cần thiết để tiếp tục',
            'warning'
        );
        $('#baoloi').html('<div class="alert alert-danger w-100" role="alert">Thông tin không được để trống!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    } else {
        $('#step-1, #step-2, #tiep, #lui').toggleClass('d-none');
        $('#btn-save').html('<button type="submit" class="btn btnsubmit btn-primary"  >Thêm mới </button>');
    }
});
$('#lui').on('click', function () {
    $('#step-1, #step-2, #tiep, #lui').toggleClass('d-none');
    $('#btn-save').html('');
});
var nv_chucvu=$('#nvht_chucvu').val();
if(nv_chucvu=='Admin'){
tablenv = $('#quanlynhanvien').DataTable({

    "ajax": {
        "url": "./quanlynhanvien/crud.php",
        "method": "POST",
        "data": {
            option: option
        },
        "dataSrc": ""
    },
    "columns": [{
            "data": "nv_stt"
        },
        {
            "data": "nv_ma"
        },
        {
            "data": "nv_anhdaidien"
        },
        {
            "data": "nv_hoten"
        },
        {
            "data": "nv_gioitinh"
        },
        {
            "data": "nv_ngaysinh"
        },
        {
            "data": "nv_sdt"
        },

        {
            "data": "nv_email"
        },
        {
            "data": "pb_ten"
        },
        {
            "data": "nv_chucvu"
        },
        {
            "data": "nv_diachi"
        }
        ,{
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn  update'><i class='fa fa-pencil-square-o' style='font-size: 20px; font-weight: bold; color:green;' aria-hidden='true'></i></button><button class='btn delete'><i class='fa-trash fa'  style='font-size: 20px; font-weight: bold; color:brown;'></i></button></div></div>"
        }
    ],

    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
    }
});
}else {
    tablenv = $('#quanlynhanvien').DataTable({

        "ajax": {
            "url": "./quanlynhanvien/crud.php",
            "method": "POST",
            "data": {
                option: option
            },
            "dataSrc": ""
        },
        "columns": [{
                "data": "nv_stt"
            },
            {
                "data": "nv_ma"
            },
            {
                "data": "nv_anhdaidien"
            },
            {
                "data": "nv_hoten"
            },
            {
                "data": "nv_gioitinh"
            },
            {
                "data": "nv_ngaysinh"
            },
            {
                "data": "nv_sdt"
            },
    
            {
                "data": "nv_email"
            },
            {
                "data": "pb_ten"
            },
            {
                "data": "nv_chucvu"
            },
            {
                "data": "nv_diachi"
            }
           
        ],
    
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
        }
    });
}

$("#themnv").click(function () {

    option = 1;
    id_nv = null;
    $('#option').val('1');
    $("#formNV").trigger("reset");
    $('#step-1, #tiep').removeClass('d-none');
    $(' #step-2, #lui').addClass('d-none');
    $('#btn-save').html('');
    $("#anhdaidien").html('<center><img src="./assets/img/nhanvien/nhanvienkhongcohinhanh.png" class="rounded-circle mb-3 mx-auto text-center" style="height: 150px; width:150px;"/></center>');
    var x = document.getElementById("nv_matkhau");
    var y = document.getElementById("nv_pre_mk");
    x.type = "password";
    y.type = "password";
    $(".modal-header , .nutdongmodal, .btnsubmit").css("background-color", "#fdac53");
    $(".modal-header , .nutdongmodal, .btnsubmit").css("color", "white");
    $(".modal-title").text("Thêm nhân viên");
    $('#modalCRUD').modal('show');
});

$('#doimatkhau').click(function () {
    var html = '<div class="form-group">';
    html += '    <label for=""><b>Mật khẩu cũ </b>(*)</label>';
    html += '    <input type="password" name="nv_oldmatkhau" id="nv_oldmatkhau_update" class="form-control nv_oldmatkhau_update " placeholder="Nhập mật khẩu cũ" >';
    html += '</div>';
    html += '<div class="form-group">';
    html += '    <label for=""><b>Mật khẩu mới </b>(*)</label>';
    html += '    <input type="password" name="nv_matkhau" id="nv_matkhau_update" class="form-control nv_matkhau_update " placeholder="Nhập mật khẩu mới" >';
    html += '</div>';
    html += '<div class="form-group">';
    html += '    <label for=""><b>Nhập lại mật khẩu </b>(*)</label>';
    html += '    <input type="password" name="nv_pre_mk" id="nv_pre_mk_update" class="form-control nv_pre_mk_update" placeholder="Xác nhập lại mật khẩu mới" >';
    html += '</div>';
    html += '<div class="form-group">';
    html += '    <label for="showmk">';
    html += '        <input type="checkbox" class="showmk_update" onclick="showmk()">&ensp;Hiện thị mật khẩu';
    html += '    </label>';
    html += '</div>';

    $('#thaydoimk').html(html);
    $('#doimatkhau').html('');
});

$(document).on('click', '.update', function () {
    // option = 2; //editar
    dong = $(this).closest("tr");

    nv_id = dong.find('td:eq(1)').text(); // NV001
    nvma = nv_id.replace("NV", "");
    nv_ma = parseInt(nvma); // 1

    nv_hoten = dong.find('td:eq(3)').text();
    nv_gioitinh = dong.find('td:eq(4)').text();
    nv_ngaysinh = dong.find('td:eq(5)').text();
    nv_sdt = dong.find('td:eq(6)').text();
    nv_email = dong.find('td:eq(7)').text();
    pb_ma = dong.find('.tenphongban').data('id');
    nv_chucvu = dong.find('td:eq(9)').text();
    nv_diachi = dong.find('td:eq(10)').text();
    nv_anhdaidien = dong.find('.avatarnhanvien').data("img");
    $("#anhdaidien_update").html('<center><img src="./assets/img/nhanvien/' + nv_anhdaidien + '" class="rounded-circle mb-3 mx-auto text-center" style="height: 150px; width:150px;"/></center>');
    $('#nv_anhdaidien_update').val('');

    $("#option_update").val('2');
    $("#ma_nv_update").val(nv_id);
    $("#nv_ma_update").val(nv_ma);
    $("#nv_hoten_update").val(nv_hoten);
    $("input[name='nv_gioitinh'][value='" + nv_gioitinh + "']").prop('checked', true);
    $("#nv_ngaysinh_update").val(nv_ngaysinh);
    $("#nv_sdt_update").val(nv_sdt);
    $("#nv_email_update").val(nv_email);
    $("#pb_ma_update").val(pb_ma);
    $("#nv_chucvu_update").val(nv_chucvu);
    $("#nv_diachi_update").val(nv_diachi);


    $('#doimatkhau').html('Thay đổi mật khẩu');
    $('#thaydoimk').html('');


    $(".modal-header , .nutdongmodal, .btnsubmit").css("background-color", "#fdac53");
    $(".modal-header , .nutdongmodal, .btnsubmit").css("color", "white");
    $(".modal-title").text("Chỉnh sửa nhân viên");
    $('#modalUPDATE').modal('show');
});

$('#formNV').submit(function (e) {
    e.preventDefault();
    option = $.trim($('#option').val());
    nv_ma = $.trim($('#nv_ma').val());
    nv_hoten = $.trim($('#nv_hoten').val());
    nv_chucvu = $.trim($('#nv_chucvu').val());
    pb_ma = $.trim($('#pb_ma').val());
    nv_ngaysinh = $.trim($('#nv_ngaysinh').val());
    nv_email = $.trim($('#nv_email').val());
    nv_matkhau = $.trim($('#nv_matkhau').val());
    nv_pre_mk = $.trim($('#nv_pre_mk').val());
    nv_diachi = $.trim($('#nv_diachi').val());
    nv_sdt = $.trim($('#nv_sdt').val());
    nv_gioitinh = $('input[name="nv_gioitinh"]:checked').val();
    var form = $('#formNV');
    var formdata = false;
    if (window.FormData) {
        formdata = new FormData(form[0]);

    }
    if (nv_email !== '' && nv_matkhau !== '' && nv_pre_mk !== '' && nv_pre_mk === nv_matkhau) {
        $.ajax({
            url: "./quanlynhanvien/crud.php",
            type: "POST",
            datatype: "json",
            cache: false,
            contentType: false,
            processData: false,
            data: formdata ? formdata : form.serialize(),

            success: function (data) {

                if (data.search("error:Nhân viên đã tồn tại!") != -1) {
                    texticon_update = 'error';
                    texttitle_update = 'Nhân viên đã tồn tại!';
                } else {
                    texticon_update = 'success';
                    texttitle_update = 'Cập nhật nhân viên mới thành công';
                }
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: texticon_update,
                    title: texttitle_update,
                });
                tablenv.ajax.reload(null, false);
            }
        });
        $('#modalCRUD').modal('hide');
    } else {
        if (nv_pre_mk !== nv_matkhau) {
            Swal.fire(
                'Mật khẩu không trùng khớp!',
                'Vui lòng kiểm tra lại mật khẩu của bạn',
                'warning'
            );
        } else {
            Swal.fire(
                'Không được bỏ trống!',
                'Vui lòng nhập đầy đủ thông tin cần thiết',
                'warning'
            );

        }
    }
});

$('#formNV_update').submit(function (e) {
    e.preventDefault();
    option = $.trim($('#option').val());
    nv_ma = $.trim($('#nv_ma_update').val());
    nv_hoten = $.trim($('#nv_hoten_update').val());
    nv_chucvu = $.trim($('#nv_chucvu_update').val());
    pb_ma = $.trim($('#pb_ma_update').val());
    nv_ngaysinh = $.trim($('#nv_ngaysinh_update').val());
    nv_email = $.trim($('#nv_email_update').val());
    nv_matkhau = $.trim($('#nv_matkhau_update').val());
    nv_oldmatkhau = $.trim($('#nv_oldmatkhau_update').val());
    nv_pre_mk = $.trim($('#nv_pre_mk_update').val());
    nv_diachi = $.trim($('#nv_diachi_update').val());
    nv_sdt = $.trim($('#nv_sdt_update').val());
    nv_gioitinh = $('input[name="nv_gioitinh"]:checked').val();
    var form = $('#formNV_update');
    var formdata = false;
    if (window.FormData) {
        formdata = new FormData(form[0]);
        console.log(formdata)
    }
    if (nv_pre_mk === nv_matkhau) {

        $.ajax({
            url: "./quanlynhanvien/crud.php",
            type: "POST",
            datatype: "json",
            cache: false,
            contentType: false,
            processData: false,
            data: formdata ? formdata : form.serialize(),

            success: function (data) {

                if (data.search("error:Cập nhật nhân viên thất bại!") != -1) {
                    texticon_update = 'error';
                    texttitle_update = 'Cập nhật nhân viên thất bại!';
                } else if (data.search("error:Mật khẩu cũ không đúng!") != -1) {
                    texticon_update = 'error';
                    texttitle_update = 'Mật khẩu cũ không đúng!';
                } else {
                    texticon_update = 'success';
                    texttitle_update = 'Cập nhật nhân viên thành công';

                }
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: texticon_update,
                    title: texttitle_update,
                });
                tablenv.ajax.reload(null, false);
            }
        });
        $('#modalUPDATE').modal('hide');
    } else {

        Swal.fire(
            'Mật khẩu không trùng khớp!',
            'Vui lòng kiểm tra lại mật khẩu của bạn',
            'warning'
        );

    }
});

$(document).on("click", ".delete", function () {
    dong = $(this).closest("tr");
    nv_id = dong.find('td:eq(1)').text();
    nv_ten = dong.find('td:eq(3)').text();
    nvma = nv_id.replace("NV", "");
    nv_ma = parseInt(nvma);
    option = 3;
    // var respuesta = confirm("Bạn có chắc muốn xóa " + kh_ma + " không ?");
    Swal.fire({
        title: "Bạn có chắc muốn xóa " + nv_ten + " không ?",
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // if (respuesta) {
            $.ajax({
                url: "./quanlynhanvien/crud.php",
                type: "POST",
                datatype: "json",
                data: {
                    option: option,
                    nv_ma: nv_ma,
                },
                success: function (data) {
                    if (data.search("success:Xóa nhân viên thành công") != -1) {
                        texticon_update = 'success';
                        texttitle_update = 'Xóa nhân viên thành công';
                    } else {
                        texticon_update = 'error';
                        texttitle_update = 'Xóa nhân viên thất bại!';
                    }
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: texticon_update,
                        title: texttitle_update,
                    });
                    //   tablaUsuarios.row(fila.parents('tr')).remove().draw();     
                    tablenv.ajax.reload(null, false);


                }
            });
        }
    })
});