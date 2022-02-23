$('#khcvrieng').addClass('active');

var manvht = $('#manvht').val();

var option, dong;
option = 4;
var tablekhcv = $('#quanlycongviecrieng').DataTable({

    "ajax": {
        "url": "./quanlycongviecrieng/crud.php",
        "method": "POST",
        "data": {
            manvht: manvht,
            option: option
        },
        "dataSrc": ""
    },
    "columns": [{
        "data": "khcv_stt"
    }, {
        "data": "khcv_ma"
    }, {
        "data": "khcv_noidung"
    }, {
        "data": "da_ten"
    }, {
        "data": "khcv_ngaybatdau"
    }, {
        "data": "khcv_thoihanhoanthanh"
    }, {
        "data": "khcv_tiendo"
    }, {
        "data": "khcv_nvlkh"
    }, {
        "data": "khcv_thuoc_macha"
    }, {
        "data": "khcv_ghichu"
    }, {
        "data": "ton_tuan"
    }, {
        "data": "nhatky"
    }, {
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn  update'><i class='fa fa-pencil-square-o' style='font-size: 20px; font-weight: bold; color:green;' aria-hidden='true'></i></button><button class='btn delete'><i class='fa-trash fa'  style='font-size: 20px; font-weight: bold; color:brown;'></i></button></div></div>"
    }],
    fixedHeader: true,
    "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
    ],
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
    }
});


let editor_ndcv
let editor_ghichu
let editor_ndcv_update
let editor_ghichu_update
ClassicEditor
    .create(document.querySelector('#ndcv'), {
        toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList']
    })
    .then(editor => {
        editor_ndcv = editor;
    })
    .catch(err => {
        console.error(err.stack);
    });
ClassicEditor
    .create(document.querySelector('#ghichu'), {
        toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList']
    })
    .then(editor => {
        editor_ghichu = editor;
    })
    .catch(err => {
        console.error(err.stack);
    });
ClassicEditor
    .create(document.querySelector('#ndcv_update'), {
        toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList']
    })
    .then(editor => {
        editor_ndcv_update = editor;
    })
    .catch(err => {
        console.error(err.stack);
    });
ClassicEditor
    .create(document.querySelector('#ghichu_update'), {
        toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList']
    })
    .then(editor => {
        editor_ghichu_update = editor;
    })
    .catch(err => {
        console.error(err.stack);
    });

$("#ngayketthuc").change(function (event) {
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    console.log(date);
    ngaybatdau = $('#ngaybatdau').val();
    ngayketthuc = $('#ngayketthuc').val();
    if (ngaybatdau === '') {
        ngaybatdau = date;
    }
    if (new Date(ngaybatdau).getTime() > new Date(ngayketthuc).getTime()) {
        alert('Ngày bắt đầu thực hiện không được trước hạn thực hiện!!');
        $('#ngaybatdau').val('');
        $('#ngayketthuc').val('');
        $("#sotuan").val('');
        // console.log(ngaybatdau);
        // console.log(new Date(ngaybatdau).getTime());
        // console.log(ngayketthuc);
    } else {
        $.post('./quanlycongviecrieng/sotuan.php', {
            "ngaybatdau": ngaybatdau,
            "ngayketthuc": ngayketthuc
        }, function (data) {
            $("#sotuan").val(data);
        });

    }
});

$("#capnhatcv").click(function () {
    option = 1;
    id_nv = null;
    // $('#option').val('1');
    $("#formCV").trigger("reset");
    $("#duan").prop("disabled", false);
    $('#duan').select2().trigger('change');
    $("#ngaybatdau").prop("disabled", false);
    $('#congvieccha').select2().trigger('change');
    editor_ndcv.setData('');
    editor_ghichu.setData('');
    $('#nvthamgia').addClass('d-none');
    $(".modal-header, .nutdongmodal, .btnsubmit").css("background-color", "#fdac53");
    $(".modal-header, .nutdongmodal, .btnsubmit").css("color", "white");
    $(".modal-titles").text("Thêm kế hoạch công việc mới");
    $(".btnsubmit").text("Thêm mới");
    duan = $("#duan").val();
    $.post(
      "./quanlycongviecchung/congvieccha.php", {
        option: "1",
        duan: duan,
      },
      function (data) {
        $("#congvieccha").html(data);
      }
    );
    $('#modalCRUD').modal('show');
    $("#duan").change(function (event) {
        duan = $("#duan").val();
        $.post(
          "./quanlycongviecchung/congvieccha.php", {
            option: "1",
            duan: duan,
          },
          function (data) {
            $("#congvieccha").html(data);
          }
        );
      });
});



$(document).on('click', '.update', function () {
    option = 2;
    dong = $(this).closest("tr");
    khcv_ma = dong.find('.khcv_ma').data('id');

    ndcv = dong.find('td:eq(2)').text();
    da_ma = dong.find('.da_ten').data('id');
    // ngaybatdau = dong.find('td:eq(4)').text();
    ngaybatdau = dong.find('.khcv_ngaybatdau').data('date');
    ngayketthuc = dong.find('.khcv_thoihanhoanthanh').data('date');
    // ngayketthuc = dong.find('td:eq(5)').text();
    trangthaicv = dong.find('td:eq(6)').text();
    khcv_nvthuchien = dong.find('.khcv_nvlkh').data('nvthuchien');
    khcv_nvlapkehoach = dong.find('.khcv_nvlkh').data('id');
    khcv_thuoc_macha = dong.find('.khcv_thuoc_macha').data('id');
    if (khcv_thuoc_macha == "") {
        khcv_cha = "";
      } else {
        khcv_cha = khcv_thuoc_macha;
      }
    ghichu = dong.find('td:eq(9)').text();
    $.post(
        "./quanlycongviecchung/congvieccha.php", {
          option: "2",
          duan: da_ma,
          khcv_thuoc_macha: khcv_cha,
        },
        function (data) {
          $("#congvieccha_update").html(data);
        
        }
      );
    $('#nvthamgia_update').removeClass('d-none');
    $("#duan_update").val(da_ma);
    $('#duan_update').select2().trigger('change');
    $("#khcv_update").val(khcv_ma);
    $("#congvieccha_update").val(khcv_thuoc_macha);
    $('#congvieccha_update').select2().trigger('change');
    $("#ngaybatdau_update").val(ngaybatdau);
    $("#ngaybatdau_update").addClass('disabled');
    $("#ngayketthuc_update").val(ngayketthuc);
    $("#ndcv_update").val(ndcv);
    editor_ndcv_update.setData(ndcv);
    $("#ghichu_update").val(ghichu);
    editor_ghichu_update.setData(ghichu);
    $("#nvthuchien_update").val(khcv_nvthuchien);
    $("#nvlkh_update").val(khcv_nvlapkehoach);
    $('#nvlkh_update').select2().trigger('change');


    $("#trangthaicv_update").val(trangthaicv);

    $("#duan_update").prop("disabled", true);
    $("#ngaybatdau_update").prop("disabled", true);
    $.post(
        "./quanlycongviecchung/sotuan.php", {
          ngaybatdau: $("#ngaybatdau_update").val(),
          ngayketthuc: $("#ngayketthuc_update").val(),
        },
        function (data) {
          $("#sotuan_update").val(data);
        }
      );
      $("#ngayketthuc_update").change(function (event) {
        var today = new Date();
        var date =
          today.getFullYear() +
          "-" +
          (today.getMonth() + 1) +
          "-" +
          today.getDate();
        console.log(date);
        ngaybatdau = $("#ngaybatdau_update").val();
        ngayketthuc = $("#ngayketthuc_update").val();
        if (ngaybatdau === "") {
          ngaybatdau = date;
        }
        if (new Date(ngaybatdau).getTime() > new Date(ngayketthuc).getTime()) {
          alert("Ngày bắt đầu thực hiện không được trước hạn thực hiện!!");
          $("#ngaybatdau_update").val("");
          $("#ngayketthuc_update").val("");
          $("#sotuan_update").val("");
          // console.log(ngaybatdau);
          // console.log(new Date(ngaybatdau).getTime());
          // console.log(ngayketthuc);
        } else {
          $.post(
            "./quanlycongviecchung/sotuan.php", {
              ngaybatdau: ngaybatdau,
              ngayketthuc: ngayketthuc,
            },
            function (data) {
              $("#sotuan_update").val(data);
            }
          );
        }
      });
    

    $(".modal-header , .nutdongmodal, .btnsubmit").css("background-color", "#fdac53");
    $(".modal-header , .nutdongmodal, .btnsubmit").css("color", "white");

    $(".btnsubmit").text("Cập nhật");
    $(".modal-title").text("Hiệu chỉnh công việc");
    $('#modalCRUD_update').modal('show');
});

$('#formCV').submit(function (e) {
    e.preventDefault();
    da_ma = $.trim($('#duan').val());
    khcv_ma = $.trim($('#khcv').val());
    congvieccha = $.trim($('#congvieccha').val());
    ngaybatdau = $.trim($('#ngaybatdau').val());
    ngayketthuc = $.trim($('#ngayketthuc').val());
    // ndcv = $.trim($('#ndcv').val());
    ndcv = editor_ndcv.getData();
    // ghichu = $.trim($('#ghichu').val());
    nv_chinhsua = $.trim($('#nv_chinhsua').val());
    console.log(nv_chinhsua);
    ghichu = editor_ghichu.getData();
    nvlkh = $.trim($('#nvlkh').val());
    nvthuchien = $.trim($('#nvthuchien').val());
    trangthaicv = $.trim($('#trangthaicv').val());
    if (da_ma !== '' && ngaybatdau !== '' && ngayketthuc !== '' && nvthuchien !== '') {

        $.ajax({
            url: "./quanlycongviecrieng/crud.php",
            type: "POST",
            datatype: "json",
            data: {
                da_ma: da_ma,
                khcv_ma: khcv_ma,
                ndcv: ndcv,
                ngaybatdau: ngaybatdau,
                ngayketthuc: ngayketthuc,
                trangthaicv: trangthaicv,
                nvthuchien: nvthuchien,
                nvlkh: nvlkh,
                nv_chinhsua: nv_chinhsua,
                congvieccha: congvieccha,
                ghichu: ghichu,
                option: option,
            },
            success: function (data) {

                if (data.search("error:Công việc đã tồn tại!") != -1) {
                    texticon_update = 'error';
                    texttitle_update = 'Công việc đã tồn tại!';
                } else {
                    texticon_update = 'success';
                    texttitle_update = 'Cập nhật công việc mới thành công';
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
                tablekhcv.ajax.reload(null, false);
            }
        });
        $('#modalCRUD').modal('hide');
    } else {
        Swal.fire(
            'Thông tin không được bỏ trống',
            'Vui lòng kiểm tra lại các ô có dấu (*)',
            'warning'
        );
    }

});

$('#formCV_update').submit(function (e) {
    e.preventDefault();
    da_ma = $.trim($('#duan_update').val());
    khcv_ma = $.trim($('#khcv_update').val());
    congvieccha = $.trim($('#congvieccha_update').val());
    ngaybatdau = $.trim($('#ngaybatdau_update').val());
    ngayketthuc = $.trim($('#ngayketthuc_update').val());
    // ndcv = $.trim($('#ndcv').val());
    ndcv = editor_ndcv_update.getData();
    // ghichu = $.trim($('#ghichu').val());
    nv_chinhsua = $.trim($('#nv_chinhsua_update').val());
    console.log(nv_chinhsua);
    ghichu = editor_ghichu_update.getData();
    nvlkh = $.trim($('#nvlkh_update').val());
    nvthuchien = $.trim($('#nvthuchien_update').val());
    trangthaicv = $.trim($('#trangthaicv_update').val());
    if (da_ma !== '' && ngaybatdau !== '' && ngayketthuc !== '' && nvthuchien !== '') {

        $.ajax({
            url: "./quanlycongviecrieng/crud.php",
            type: "POST",
            datatype: "json",
            data: {
                da_ma: da_ma,
                khcv_ma: khcv_ma,
                ndcv: ndcv,
                ngaybatdau: ngaybatdau,
                ngayketthuc: ngayketthuc,
                trangthaicv: trangthaicv,
                nvthuchien: nvthuchien,
                nvlkh: nvlkh,
                nv_chinhsua: nv_chinhsua,
                congvieccha: congvieccha,
                ghichu: ghichu,
                option: option,
            },
            success: function (data) {

                if (data.search("error:Công việc đã tồn tại!") != -1) {
                    texticon_update = 'error';
                    texttitle_update = 'Công việc đã tồn tại!';
                } else {
                    texticon_update = 'success';
                    texttitle_update = 'Cập nhật công việc mới thành công';
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
                tablekhcv.ajax.reload(null, false);
            }
        });
        $('#modalCRUD_update').modal('hide');
    } else {
        Swal.fire(
            'Thông tin không được bỏ trống',
            'Vui lòng kiểm tra lại các ô có dấu (*)',
            'warning'
        );
    }

});

$(document).on("click", ".delete", function () {
    dong = $(this).closest("tr");
    khcv_id = dong.find('td:eq(1)').text();
    nv_chinhsua = $.trim($('#nv_chinhsua').val());
    console.log(nv_chinhsua);
    khcvma = khcv_id.replace("CV", "");
    khcv_ma = parseInt(khcvma);
    option = 3;
    // var respuesta = confirm("Bạn có chắc muốn xóa " + kh_ma + " không ?");
    Swal.fire({
        title: "Bạn có chắc muốn hủy công việc " + khcv_id + " không ?",
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
                url: "./quanlycongviecrieng/crud.php",
                type: "POST",
                datatype: "json",
                data: {
                    option: option,
                    khcv_ma: khcv_ma,
                    nv_chinhsua: nv_chinhsua,
                },
                success: function (data) {
                    if (data.search("success:Hủy công việc thành công") != -1) {
                        texticon_update = 'success';
                        texttitle_update = 'Hủy công việc thành công';
                    } else {
                        texticon_update = 'error';
                        texttitle_update = 'Hủy công việc thất bại!';
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
                    tablekhcv.ajax.reload(null, false);


                }
            });
        }
    })
});