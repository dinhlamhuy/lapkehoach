$('#dsphongban').addClass('active');
var pb_ma, option, dong;
option = 4;

var nv_chucvu=$('#nvht_chucvu').val();
if(nv_chucvu=='Admin'){

    tablepb = $('#quanlyphongban').DataTable({
    
        "ajax": {
            "url": "./quanlyphongban/crud.php",
            "method": "POST",
            "data": {
                option: option
            },
            "dataSrc": ""
        },
        "columns": [{
                "data": "pb_id"
            },
            {
                "data": "pb_ma"
            },
            {
                "data": "pb_ten"
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
    tablepb = $('#quanlyphongban').DataTable({
    
        "ajax": {
            "url": "./quanlyphongban/crud.php",
            "method": "POST",
            "data": {
                option: option
            },
            "dataSrc": ""
        },
        "columns": [{
                "data": "pb_id"
            },
            {
                "data": "pb_ma"
            },
            {
                "data": "pb_ten"
            }
           
        ],
    
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
        }
    });
}
//tablepb.ajax.reload(null, false);


$('#add').click(function () {
    var html = '<tr id="formthempb" style="background-color:#EBEBEB">';
    html += '<td  style="cursor: not-allowed; background-color:#4C606B; " id="stt"></td>';
    html += '<td  style="cursor: not-allowed; background-color:#4C606B; " id="mapb"></td>';
    html += '<td contenteditable class="tenphongban" id="tenphongban"></td>';
    
    html += '<td class="text-center"><div class="btn-group"><button type="button" name="insert" id="insert" class="btn btn-success ">';
    html +='<i class="fa fa-check" aria-hidden="true"></i> Th??m</button><button type="button" name="huy" id="huy" class="btn btn-secondary ">';
    html+='<i class="fa fa-times" aria-hidden="true"></i> H???y</button></div></td>';
    html += '</tr>';
    if ($('#formthempb').length < 1) {
        $('#quanlyphongban tbody').prepend(html);
    }
});

$(document).on('click', '#insert', function () {
    var pb_ten = $('#tenphongban').text();
    option = 1;
    if (tenphongban != '') {
        $.ajax({
            url: "./quanlyphongban/crud.php",
            method: "POST",
            data: {
                pb_ten: pb_ten,
                option: option,
            },
            success: function (data) {
                if (data.search("error:Ph??ng ban ???? t???n t???i!") != -1) {
                    texticon_update = 'error';
                    texttitle_update = 'Ph??ng ban ???? t???n t???i!';
                } else if (data.search("success:Th??m ph??ng ban m???i th??nh c??ng") != -1) {
                    texticon_update = 'success';
                    texttitle_update = 'C???p nh???t ph??ng ban m???i th??nh c??ng';
                }else {
                    texticon_update = 'error';
                    texttitle_update = 'C???p nh???t ph??ng ban th???t b???i';
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
                tablepb.ajax.reload(null, false);
            }
        });

    } else {
        alert("Ph??ng ban kh??ng ???????c ????? tr???ng");
    }
});

$(document).on('click', '.update', function () {
    option = 2; //editar
    dong = $(this).closest("tr");
    pb_id = dong.find('td:eq(1)').text();
    pbma = pb_id.replace("PB", "");
    pb_ma = parseInt(pbma);
    pb_ten = dong.find('td:eq(2)').text();
    $("#ma_pb").val(pb_ma);
    $("#ten_pb").val(pb_ten);

    $(".modal-header , .nutdongmodal, .btnsubmit").css("background-color", "#fdac53");
    $(".modal-header , .nutdongmodal, .btnsubmit").css("color", "white");
    $(".modal-title").text("Ch???nh s???a ph??ng ban");
    $('#modalCRUD').modal('show');
});

var texticon_update, texttitle_update;

$('#formPB').submit(function (e) {
    e.preventDefault();
    ma_pb = $.trim($('#ma_pb').val());
    ten_pb = $.trim($('#ten_pb').val());

    $.ajax({
        url: "./quanlyphongban/crud.php",
        type: "POST",
        datatype: "json",
        data: {
            pb_ma: ma_pb,
            pb_ten: ten_pb,
            option: '2',
        },
        success: function (data) {

            if (data.search("error:Ph??ng ban ???? t???n t???i!") != -1) {
                texticon_update = 'error';
                texttitle_update = 'Ph??ng ban ???? t???n t???i!';
            } else {
                texticon_update = 'success';
                texttitle_update = 'C???p nh???t ph??ng ban m???i th??nh c??ng';
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
            tablepb.ajax.reload(null, false);
        }
    });

    $('#modalCRUD').modal('hide');
});

$(document).on("click", ".delete", function () {
    dong = $(this).closest("tr");
    pb_id = dong.find('td:eq(1)').text();
    pbma = pb_id.replace("PB", "");
    pb_ma = parseInt(pbma);
    option = 3;

    Swal.fire({
        title: "B???n c?? ch???c mu???n x??a " + pb_ma + " kh??ng ?",
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: "./quanlyphongban/crud.php",
                type: "POST",
                datatype: "json",
                data: {
                    option: option,
                    pb_ma: pb_ma
                },
                success: function (data) {
                    if (data.search("success:X??a ph??ng ban m???i th??nh c??ng") != -1) {
                        texticon_update = 'success';
                        texttitle_update = 'X??a ph??ng ban th??nh c??ng';
                    } else {
                        texticon_update = 'error';
                        texttitle_update = 'X??a ph??ng ban th???t b???i!';
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
                    tablepb.ajax.reload(null, false);


                }
            });
        }
    })
});


$(document).on('click', '#huy', function () {
    $('#formthempb').remove();
});

function listenForDoubleClick(element) {
    element.contentEditable = true;
    setTimeout(function () {
        if (document.activeElement !== element) {
            element.contentEditable = false;
        }
    }, 300);
}