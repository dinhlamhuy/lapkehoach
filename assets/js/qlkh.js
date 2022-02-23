$('#da-kh').addClass('active');
$('#dakh').toggleClass('list-unstyled collapse show');
$('#dakh').toggleClass('list-unstyled collapse');

$('#qlkh').addClass('checked');
$('#modakh').toggleClass('collapsed');

var kh_ma, option, dong;
option = 4;


var nv_chucvu=$('#nvht_chucvu').val();
if(nv_chucvu=='Admin'){
tablekh = $('#quanlykhachhang').DataTable({

    "ajax": {
        "url": "./quanlykhachhang/crud.php",
        "method": "POST",
        "data": {
            option: option
        },
        "dataSrc": ""
    },
    "columns": [{
            "defaultContent": ""
        },
        {
            "data": "kh_ma"
        },
        {
            "data": "kh_ten"
        },
        {
            "data": "kh_sdt"
        },
        {
            "data": "kh_email"
        },
        {
            "data": "kh_diachi"
        },
        {
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn  update'><i class='fa fa-pencil-square-o' style='font-size: 20px; font-weight: bold; color:green;' aria-hidden='true'></i></button><button class='btn  delete'><i class='fa-trash fa'  style='font-size: 20px; font-weight: bold; color:brown;'></i></button></div></div>"
        }
    ],

    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
    }
});
}else {
    tablekh = $('#quanlykhachhang').DataTable({

        "ajax": {
            "url": "./quanlykhachhang/crud.php",
            "method": "POST",
            "data": {
                option: option
            },
            "dataSrc": ""
        },
        "columns": [{
                "defaultContent": ""
            },
            {
                "data": "kh_ma"
            },
            {
                "data": "kh_ten"
            },
            {
                "data": "kh_sdt"
            },
            {
                "data": "kh_email"
            },
            {
                "data": "kh_diachi"
            }
        ],
    
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
        }
    });
}


$("#btnthemkh").click(function(){
    option = 1;        
    kh_id=null;
    $("#formKH").trigger("reset");
    $(".modal-header , #nutdongmodal, #btnsubmit").css( "background-color", "#fdac53");
    $(".modal-header , #nutdongmodal, #btnsubmit").css( "color", "white");
    $(".modal-title").text("Thêm khách hàng");
    $('#modalCRUD').modal('show');	    
});



$(document).on('click', '.update', function () {
    option = 2;
    dong = $(this).closest("tr");
    kh_ma = dong.find('td:eq(1)').text();
    khma = kh_ma.replace("KH", "");
    kh_id = parseInt(khma);
    kh_ten = dong.find('td:eq(2)').text();
    kh_sdt = dong.find('td:eq(3)').text();
    kh_email = dong.find('td:eq(4)').text();
    kh_diachi = dong.find('td:eq(5)').text();
    $("#id_kh").val(kh_id);
    $("#kh_ma").val(kh_ma);
    $("#kh_ten").val(kh_ten);
    $("#kh_sdt").val(kh_sdt);
    $("#kh_email").val(kh_email);
    $("#kh_diachi").val(kh_diachi);
    $(".modal-header , #nutdongmodal, #btnsubmit").css( "background-color", "#fdac53");
    $(".modal-header , #nutdongmodal, #btnsubmit").css( "color", "white");
    $(".modal-title").text("Chỉnh sửa thông tin khách hàng");
    $('#modalCRUD').modal('show');
});

var texticon_update, texttitle_update;

$('#formKH').submit(function (e) {
    e.preventDefault();
    kh_ma = $.trim($('#id_kh').val());
    kh_ten = $.trim($('#kh_ten').val());
    kh_sdt = $.trim($('#kh_sdt').val());
    kh_email = $.trim($('#kh_email').val());
    kh_diachi = $.trim($('#kh_diachi').val());

    $.ajax({
        url: "./quanlykhachhang/crud.php",
        type: "POST",
        datatype: "json",
        data: {
            kh_ma: kh_ma,
            kh_ten: kh_ten,
            kh_sdt: kh_sdt,
            kh_email: kh_email,
            kh_diachi: kh_diachi,
            option: option,
        },
        success: function (data) {

            if (data.search("error:Khách hàng đã tồn tại!") != -1) {
                texticon_update = 'error';
                texttitle_update = 'Khách hàng đã tồn tại!';
            } else {
                texticon_update = 'success';
                texttitle_update = 'Cập nhật khách hàng mới thành công';
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
            tablekh.ajax.reload(null, false);
        }
    });

    $('#modalCRUD').modal('hide');
});

$(document).on("click", ".delete", function () {
    dong = $(this).closest("tr");
    kh_id = dong.find('td:eq(1)').text();
    kh_ten = dong.find('td:eq(2)').text();
    khma = kh_id.replace("KH", "");
    kh_ma = parseInt(khma);
    option = 3; //eliminar        
    // var respuesta = confirm("Bạn có chắc muốn xóa " + kh_ma + " không ?");
    Swal.fire({
        title: "Bạn có chắc muốn xóa " + kh_ten + " không ?",
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
            url: "./quanlykhachhang/crud.php",
            type: "POST",
            datatype: "json",
            data: {
                option: option,
                kh_ma: kh_ma
            },
            success: function (data) {
                if (data.search("success:Xóa khách hàng thành công") != -1) {
                    texticon_update = 'success';
                    texttitle_update = 'Xóa khách hàng thành công';
                } else {
                    texticon_update = 'error';
                    texttitle_update = 'Xóa khách hàng thất bại!';
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
                tablekh.ajax.reload(null, false);


            }
        });
    }
})
});
