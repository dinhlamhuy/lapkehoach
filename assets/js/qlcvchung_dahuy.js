// $("#khcv").addClass("active");
$('#all_khcv').addClass('active');
$('#khcvchung').toggleClass('list-unstyled collapse show');
$('#khcvchung').toggleClass('list-unstyled collapse');

$('#khcv_dahuy').addClass('checked');
$('#modakhcv_chung').toggleClass('collapsed');
var option, dong;
option = 2;

// $('.dt-button, .buttons-excel, .buttons-html5').text('<i class="fa fa-file-excel-o" aria-hidden="true"></i>ex');

var tablekhcv = $("#quanlycongviecchungdahuy").DataTable({
  ajax: {
    url: "./quanlycongviecchungdahuy/crud.php",
    method: "POST",
    data: {
      option: option,
    },
    dataSrc: "",
  },
  columns: [{
      data: "khcv_stt",
    },
    {
      data: "khcv_ma",
    },
    {
      data: "khcv_noidung",
    },
    {
      data: "da_ten",
    },
    {
      data: "khcv_ngaybatdau",
    },
    {
      data: "khcv_thoihanhoanthanh",
    },
    {
      data: "khcv_tiendo",
    },
    {
      data: "khcv_nvthuchien",
    },
    {
      data: "khcv_thuoc_macha",
    },
    {
      data: "khcv_ghichu",
    },
    {
      data: "ton_tuan",
    },
    {
      data: "nhatky",
    },
    {
      defaultContent: "<div class='text-center'><div class='btn-group'><button class='btn read' title='Xem chi tiết'><i class='fa fa-eye' style='font-size: 20px; font-weight: bold; color:red;' aria-hidden='true'></i></button><button class='btn delete' title='Khôi phục công việc'><i class='fa-history fa'  style='font-size: 20px; font-weight: bold; color:brown;'></i></button></div></div>",
    },
  ],
 
  fixedHeader: true,
  lengthMenu: [
    [10, 25, 50, -1],
    [10, 25, 50, "All"],
  ],
  language: {
    url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json",
  },
});

$("#ngayketthuc").change(function (event) {
  var today = new Date();
  var date =
    today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
  console.log(date);
  ngaybatdau = $("#ngaybatdau").val();
  ngayketthuc = $("#ngayketthuc").val();
  if (ngaybatdau === "") {
    ngaybatdau = date;
  }
  if (new Date(ngaybatdau).getTime() > new Date(ngayketthuc).getTime()) {
    alert("Ngày bắt đầu thực hiện không được trước hạn thực hiện!!");
    $("#ngaybatdau").val("");
    $("#ngayketthuc").val("");
    $("#sotuan").val("");
    // console.log(ngaybatdau);
    // console.log(new Date(ngaybatdau).getTime());
    // console.log(ngayketthuc);
  } else {
    $.post(
      "./quanlycongviecchungdahuy/sotuan.php", {
        ngaybatdau: ngaybatdau,
        ngayketthuc: ngayketthuc,
      },
      function (data) {
        $("#sotuan").val(data);
      }
    );
  }
});


$(document).on("click", ".read", function () {

  dong = $(this).closest("tr");
  khcv_ma = dong.find(".khcv_ma").data("id");
  da_ma = dong.find(".da_ten").data("id");
  ndcv = dong.find("td:eq(2)").text();
  ngaybatdau = dong.find(".khcv_ngaybatdau").data("date");
  ngayketthuc = dong.find(".khcv_thoihanhoanthanh").data("date");
  trangthaicv = dong.find("td:eq(6)").text();
  khcv_nvthuchien = dong.find(".khcv_nvthuchien").data("id");
  khcv_nvlapkehoach = dong.find(".khcv_nvthuchien").data("nvlkh");
  khcv_thuoc_macha = dong.find(".khcv_thuoc_macha").data("id");
  if (khcv_thuoc_macha == "") {
    khcv_cha = "";
  } else {
    khcv_cha = khcv_thuoc_macha;
  }
  ghichu = dong.find("td:eq(9)").text();
  $.post(
    "./quanlycongviecchungdahuy/congvieccha.php", {
      option: "2",
      duan: da_ma,
      khcv_thuoc_macha: khcv_cha,
    },
    function (data) {
      $("#congvieccha_update").html(data);
      tablekhcv.ajax.reload(null, false);
    }
  );

  $("#duan_update").val(da_ma);
  $("#duan_update").select2().trigger("change");
  $("#khcv_update").val(khcv_ma);
  $("#congvieccha_update").val(khcv_thuoc_macha);
  $("#congvieccha_update").select2().trigger("change");
  $("#ngaybatdau_update").val(ngaybatdau);
  $("#ngaybatdau_update").addClass("disabled");
  $("#ngayketthuc_update").val(ngayketthuc);
  $("#ndcv_update").val(ndcv);
//   editor_ndcv_update.setData(ndcv);
  $("#ghichu_update").val(ghichu);
//   editor_ghichu_update.setData(ghichu);
  $("#nvthuchien_update").val(khcv_nvthuchien);
  $("#nvlkh_update").val(khcv_nvlapkehoach);
  $("#nvthuchien_update").select2().trigger("change");

  $("#trangthaicv_update").val(trangthaicv);

  $("#ndcv_update").prop("disabled", true);
  $("#duan_update").prop("disabled", true);
  $("#ngaybatdau_update").prop("disabled", true);
  $.post(
    "./quanlycongviecchungdahuy/sotuan.php", {
      ngaybatdau: $("#ngaybatdau_update").val(),
      ngayketthuc: $("#ngayketthuc_update").val(),
    },
    function (data) {
      $("#sotuan_update").val(data);
    }
  );


  $(".modal-header , .nutdongmodal, .btnsubmit").css(
    "background-color",
    "#fdac53"
  );
  $(".modal-header , .nutdongmodal, .btnsubmit").css("color", "white");

  $(".btnsubmit").text("Cập nhật");
  $(".modal-title").text("Chỉnh sửa công việc");

  $("#modalCRUD_update").modal("show");
});

$(document).on("click", ".delete", function () {
  dong = $(this).closest("tr");
  khcv_id = dong.find("td:eq(1)").text();
  nv_chinhsua = $.trim($("#nv_chinhsua_update").val());
  khcvma = khcv_id.replace("CV", "");
  khcv_ma = parseInt(khcvma);
  option = 1;
  Swal.fire({
    title: "Bạn có chắc muốn khôi phục lại công việc " + khcv_id + " không ?",
    // text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Đồng ý!",
  }).then((result) => {
    if (result.isConfirmed) {
      // if (respuesta) {
      $.ajax({
        url: "./quanlycongviecchungdahuy/crud.php",
        type: "POST",
        datatype: "json",
        data: {
          option: option,
          khcv_ma: khcv_ma,
          nv_chinhsua: nv_chinhsua,
        },
        success: function (data) {
          if (data.search("success:Khôi phục công việc thành công") != -1) {
              texticon_update = "success";
              texttitle_update = "Khôi phục công việc thành công";
            } else if (data.search("error:Cần khôi phục công việc cha trước!") != -1) {
            texticon_update = "error";
            texttitle_update = "Cần khôi phục công việc cha trước!";
        }else {
              texticon_update = "error";
              texttitle_update = "Khôi phục công việc thất bại!";

          }
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });
          Toast.fire({
            icon: texticon_update,
            title: texttitle_update,
          });
          //   tablaUsuarios.row(fila.parents('tr')).remove().draw();
          tablekhcv.ajax.reload(null, false);
        },
      });
    }
  });
});