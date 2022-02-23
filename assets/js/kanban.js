$("#hoanthanh").load('./kanban/kb_hoanthanh.php');
$("#chuathuchien").load('./kanban/kb_chuathuchien.php');
$("#dangthuchien").load('./kanban/kb_dangthuchien.php');

function dragStart(event) {
    event.dataTransfer.setData("Text", event.target.id);
}


function allowDrop(event) {
    event.preventDefault();

}

function dropcth(event) {
    event.preventDefault();
    var data = event.dataTransfer.getData("Text");
    event.target.appendChild(document.getElementById(data));

    var request = $.ajax({
        url: "./kanban/kb_chuathuchien.php",
        method: "POST",
        data: {
            id: data,
            trangthai: "Chưa thực hiện",
        }

    });

    request.done(function (msg) {
        $("#hoanthanh").load('./kanban/kb_hoanthanh.php');
        $("#chuathuchien").load('./kanban/kb_chuathuchien.php');
        $("#dangthuchien").load('./kanban/kb_dangthuchien.php');
        // $("#chuathuchien").load('./kanban/kb_chuathuchien.php');
    });

    request.fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function dropdth(event) {
    event.preventDefault();
    var data = event.dataTransfer.getData("Text");
    event.target.appendChild(document.getElementById(data));

    var request = $.ajax({
        url: "./kanban/kb_dangthuchien.php",
        method: "POST",
        data: {
            id: data,
            trangthai: "Đang thực hiện",
        }

    });

    request.done(function (msg) {
        $("#hoanthanh").load('./kanban/kb_hoanthanh.php');
        $("#chuathuchien").load('./kanban/kb_chuathuchien.php');
        $("#dangthuchien").load('./kanban/kb_dangthuchien.php');
        // $("#dangthuchien").load('./kanban/kb_dangthuchien.php');
    });

    request.fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });

}


function dropht(event) {
    event.preventDefault();
    var datas = event.dataTransfer.getData("Text");
    event.target.appendChild(document.getElementById(datas));

    var request = $.ajax({
        url: "./kanban/kb_hoanthanh.php",
        method: "POST",
        data: {
            id: datas,
            trangthai: "Hoàn thành",

        }

    });

    request.done(function (msg) {
        Swal.fire({
            // position: 'top-start',
            icon: 'success',
            title: 'Chúc mừng bạn đã hoàn thành công việc',
            showConfirmButton: false,
            // button:false,
            timer: 1500
        })
        $("#hoanthanh").load('./kanban/kb_hoanthanh.php');
        $("#chuathuchien").load('./kanban/kb_chuathuchien.php');
        $("#dangthuchien").load('./kanban/kb_dangthuchien.php');
        // $("#hoanthanh").load('./kanban/kb_hoanthanh.php');
    });

    request.fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}
$('#trangchu').addClass('active');


function Dong_ho() {
    var gio = document.getElementById("gio");
    var phut = document.getElementById("phut");
    var giay = document.getElementById("giay");
    var ngaythangnam = document.getElementById("ngaythangnam");

    var monthNames = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];

    var dayNames = ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"];
    var ngay_hien_tai = new Date().getDate();
    var ngays = new Date().getDay();
    var thang_hien_tai = new Date().getMonth();

    var thu = dayNames[ngays];
    var thang = monthNames[thang_hien_tai];

    var today = new Date();
    var nam_hien_tai = new Date().getFullYear();
    var Gio_hien_tai = new Date().getHours();
    var Phut_hien_tai = new Date().getMinutes();
    var Giay_hien_tai = new Date().getSeconds();
    // var date = today.getDate() + '-' + (today.getMonth() + 1) + '-' + today.getFullYear();
    var result = getWeekNumber(today);
    ngaythangnam.innerHTML = "Tuần <b>"+result+ "</b>, "+thu + " Ngày <b>" + ngay_hien_tai + "</b> Tháng  <b>  " + thang + "</b>  Năm <b>" + nam_hien_tai + "</b>";
    gio.innerHTML = Gio_hien_tai;
    phut.innerHTML = Phut_hien_tai;
    giay.innerHTML = Giay_hien_tai;


}
var Dem_gio = setInterval(Dong_ho, 1000);
function getWeekNumber(d) {
    // Copy date so don't modify original
    d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
    // Set to nearest Thursday: current date + 4 - current day number
    // Make Sunday's day number 7
    d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay()||7));
    // Get first day of year
    var yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
    // Calculate full weeks to nearest Thursday
    var weekNo = Math.ceil(( ( (d - yearStart) / 86400000) + 1)/7);
    // Return array of year and week number
    return weekNo;
}
