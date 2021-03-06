$('#da-kh').addClass('active');
$('#dakh').toggleClass('list-unstyled collapse show');
$('#dakh').toggleClass('list-unstyled collapse');

$('#qlda').addClass('checked');
$('#modakh').toggleClass('collapsed');

var kh_ma, option, dong;
option = 4;


var nv_chucvu=$('#nvht_chucvu').val();
if(nv_chucvu=='Admin'){
tableda = $('#quanlyduan').DataTable({

    "ajax": {
        "url": "./quanlyduan/crud.php",
        "method": "POST",
        "data": {
            option: option
        },
        "dataSrc": ""
    },
    "columns": [{
            "data": "da_stt"
        },
        {
            "data": "da_ma"
        },
        {
            "data": "da_ten"
        },
        {
            "data": "kh_ten"
        },
        {
            "data": "da_thoihan"
        },
        {
            "data": "da_trangthai"
        },
        {
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn  update'><i class='fa fa-pencil-square-o' style='font-size: 20px; font-weight: bold; color:green;' aria-hidden='true'></i></button><button class='btn delete'><i class='fa-trash fa'  style='font-size: 20px; font-weight: bold; color:brown;'></i></button></div></div>"
        }
    ],

    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
    }
});
}else {
    tableda = $('#quanlyduan').DataTable({

        "ajax": {
            "url": "./quanlyduan/crud.php",
            "method": "POST",
            "data": {
                option: option
            },
            "dataSrc": ""
        },
        "columns": [{
                "data": "da_stt"
            },
            {
                "data": "da_ma"
            },
            {
                "data": "da_ten"
            },
            {
                "data": "kh_ten"
            },
            {
                "data": "da_thoihan"
            },
            {
                "data": "da_trangthai"
            }
        ],
    
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
        }
    });
}

$("#btnthemda").click(function () {
    option = 1;
    id_da = null;
    $("#formDA").trigger("reset");
    $(".modal-header , #nutdongmodal, #btnsubmit").css("background-color", "#fdac53");
    $(".modal-header , #nutdongmodal, #btnsubmit").css("color", "white");
    $(".modal-title").text("Th??m D??? ??n");
    $('#modalCRUD').modal('show');
});



$(document).on('click', '.update', function () {
    option = 2;
    dong = $(this).closest("tr");
    id_da = dong.find('td:eq(1)').text();
    dama = id_da.replace("DA", "");
    da_ma = parseInt(dama);
    da_ten = dong.find('td:eq(2)').text();
    kh_ten = dong.find('td:eq(3)').text();
    da_thoihan = dong.find('td:eq(4)').text();
    da_trangthai = dong.find('td:eq(5)').text();
    kh_makh = dong.find(".tenkhachhang").data("id");
    $("#id_da").val(da_ma);
    $("#da_ma").val(id_da);
    $("#da_ten").val(da_ten);
    $("#kh_ma").val(kh_makh);
    $("#da_thoihan").val(da_thoihan);
    $("#da_trangthai").val(da_trangthai);


    
    $(".modal-header , #nutdongmodal, #btnsubmit").css("background-color", "#fdac53");
    $(".modal-header , #nutdongmodal, #btnsubmit").css("color", "white");
    $(".modal-title").text("Ch???nh s???a th??ng tin D??? ??n");
    $('#modalCRUD').modal('show');
});

var texticon_update, texttitle_update;

$('#formDA').submit(function (e) {
    e.preventDefault();
    da_ma = $.trim($('#id_da').val());
    kh_ma = $.trim($('#kh_ma').val());
    da_ten = $.trim($('#da_ten').val());
    da_thoihan = $.trim($('#da_thoihan').val());
    da_trangthai = $.trim($('#da_trangthai').val());
 
    
    if (kh_ma !== '' && da_ten !== '' && da_thoihan !== '' && da_trangthai !== '') {

        $.ajax({
            url: "./quanlyduan/crud.php",
            type: "POST",
            datatype: "json",
            data: {
                kh_ma: kh_ma,
                da_ma: da_ma,
                da_ten: da_ten,
                da_thoihan: da_thoihan,
                da_trangthai: da_trangthai,
                option: option,
            },
            success: function (data) {

                if (data.search("error:D??? ??n ???? t???n t???i!") != -1) {
                    texticon_update = 'error';
                    texttitle_update = 'D??? ??n ???? t???n t???i!';
                } else {
                    texticon_update = 'success';
                    texttitle_update = 'C???p nh???t d??? ??n m???i th??nh c??ng';
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
                tableda.ajax.reload(null, false);
            }
        });
        $('#modalCRUD').modal('hide');
    } else {
        Swal.fire(
            'Kh??ng ???????c b??? tr???ng!',
            'Vui l??ng nh???p ?????y ????? th??ng tin c???n thi???t',
            'warning'
        );
    }
});

$(document).on("click", ".delete", function () {
    dong = $(this).closest("tr");
    id_da = dong.find('td:eq(1)').text();
    da_ten = dong.find('td:eq(2)').text();
    dama = id_da.replace("DA", "");
    da_ma = parseInt(dama);
    option = 3; //eliminar        
    // var respuesta = confirm("B???n c?? ch???c mu???n x??a " + kh_ma + " kh??ng ?");
    Swal.fire({
        title: "B???n c?? ch???c mu???n x??a " + da_ten + " kh??ng ?",
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
                url: "./quanlyduan/crud.php",
                type: "POST",
                datatype: "json",
                data: {
                    option: option,
                    da_ma: da_ma
                },
                success: function (data) {
                    if (data.search("success:X??a d??? ??n th??nh c??ng") != -1) {
                        texticon_update = 'success';
                        texttitle_update = 'X??a d??? ??n th??nh c??ng';
                    } else {
                        texticon_update = 'error';
                        texttitle_update = 'X??a d??? ??n th???t b???i!';
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
                    tableda.ajax.reload(null, false);


                }
            });
        }
    })
});