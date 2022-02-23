<?php
include_once __DIR__ . '/../database.php';
$pb_ten = (isset($_POST['pb_ten'])) ? $_POST['pb_ten'] : '';
$option = (isset($_POST['option'])) ? $_POST['option'] : '';
$pb_ma = (isset($_POST['pb_ma'])) ? $_POST['pb_ma'] : '';
$i=1;
switch ($option) {
    case 1:
        $check = mysqli_query($conn, "SELECT * FROM `phongban` WHERE `pb_ten`='$pb_ten'");
        $data = [];

        if (mysqli_num_rows($check) > 0) {
            $data[] = ['alert'  =>   'error:Phòng ban đã tồn tại!'];
        } else {
            if(!empty($pb_ten)){
                $sql = "INSERT INTO phongban (pb_ten) VALUES('$pb_ten') ";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $data[] = ['alert'  =>   'success:Thêm phòng ban mới thành công'];
                } else {
                    $data[] = ['alert'  =>   'error:Thêm phòng ban thất bại!'];
                }
                $sql = "SELECT * FROM phongban ORDER BY pb_ma DESC LIMIT 1";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = [
                        'alert' =>  '',
                        'pb_stt' =>  $i++,
                        'pb_id' =>  $row['pb_ma'],
                        'pb_ma' =>  '<div class="maphongban" data-id="' . $row['pb_ma'] . '" >PB' . sprintf('%03d', $row['pb_ma']) . '</div>',
                        'pb_ten' =>  '<div class="tenphongban" data-id="' . $row['pb_ma'] . '" >' . $row['pb_ten'] . '</div>',
    
                    ];
                }

            }else {
                $data[] = ['alert'  =>   'error:Thêm phòng ban thất bại!'];
            }
        }
        break;
    case 2:
        $check = mysqli_query($conn, "SELECT * FROM `phongban` WHERE `pb_ten`='$pb_ten'");
        $data = [];
        if (mysqli_num_rows($check) > 0) {
            $data[] = ['alert'  =>   'error:Phòng ban đã tồn tại!'];
        } else {
            $sql = "UPDATE phongban SET pb_ten='$pb_ten' WHERE pb_ma='$pb_ma' ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $data[] = ['alert'  =>   'success:Cập nhật phòng ban mới thành công'];
            } else {
                $data[] = ['alert'  =>   'error:Cập nhật phòng ban thất bại!'];
            }

            $sql = "SELECT * FROM phongban WHERE pb_ma='$pb_ma' ";
            $result = mysqli_query($conn, $sql);


            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $data[] = [
                    'alert' =>  '',
                    'pb_stt' =>  $i++,
                    'pb_id' =>  $row['pb_ma'],
                    'pb_ma' =>  '<div class="maphongban" data-id="' . $row['pb_ma'] . '" >PB' . sprintf('%03d', $row['pb_ma']) . '</div>',
                    'pb_ten' =>  '<div class="tenphongban" data-id="' . $row['pb_ma'] . '" >' . $row['pb_ten'] . '</div>',

                ];
            }
        }
        break;
    case 3:
        $data = [];
        $sql = "DELETE FROM phongban WHERE pb_ma='$pb_ma' ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $data[] = ['alert'  =>   'success:Xóa phòng ban mới thành công'];
        } else {
            $data[] = ['alert'  =>   'error:Xóa phòng ban thất bại!'];
        }
        $sql = "SELECT * FROM phongban WHERE `pb_ma`='$pb_ma' ";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = [

                'alert' =>  '',
                'pb_stt' =>  $i++,
                'pb_id' =>  $row['pb_ma'],
                'pb_ma' =>  '<div class="maphongban" data-id="' . $row['pb_ma'] . '" >PB' . sprintf('%03d', $row['pb_ma']) . '</div>',
                'pb_ten' =>  '<div class="tenphongban" data-id="' . $row['pb_ma'] . '" >' . $row['pb_ten'] . '</div>',

            ];
        }
        break;
    case 4:
        $sql = "SELECT * FROM `phongban`";
        $result = mysqli_query($conn, $sql);
        $i = 1;
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = [
                'alert' =>  '',
                'pb_stt' =>  $i++,
                'pb_id' =>  $row['pb_ma'],
                'pb_ma' =>  '<div class="maphongban" data-id="' . $row['pb_ma'] . '" >PB' . sprintf('%03d', $row['pb_ma']) . '</div>',
                'pb_ten' =>  '<div class="tenphongban" data-id="' . $row['pb_ma'] . '" >' . $row['pb_ten'] . '</div>',

            ];
        }
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE); //envio el array final el formato json a AJAX
$conn = null;
