<!-- <option selected disabled>--Không chọn công việc cha--</option> -->
<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'lapkehoach');
mysqli_set_charset($conn, 'UTF8');
$duan = $_POST['duan'];
$khcv_thuoc_macha = (isset($_POST['khcv_thuoc_macha'])) ? $_POST['khcv_thuoc_macha'] : '';
$option = (isset($_POST['option'])) ? $_POST['option'] : '';



switch ($option) {
    case 1:
        $khcv_cha = "SELECT * FROM `kehoachcongviec` WHERE `da_ma`='$duan'";

        $result = mysqli_query($conn, $khcv_cha);
        if (mysqli_num_rows($result) > 0) {

            echo '<option value="" selected >--Không chọn công việc cha--</option>';
            while ($out = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $out['khcv_ma'] . "'  >CV". sprintf('%03d',$out['khcv_ma']) .' - '. $out['khcv_noidung'] . "</option>";
            }
        } else {
            echo '<option value="" selected >--Không chọn công việc cha--</option>';
        }

        break;
    case 2:
        $result = mysqli_query($conn, "SELECT * FROM `kehoachcongviec` WHERE `da_ma`='$duan' ");
        // $khcv_con =  mysqli_query($conn, "SELECT * FROM `kehoachcongviec` WHERE `khcv_ma`='$khcv_ma'");
        // $rowcon = mysqli_fetch_assoc($khcv_con);

        echo '<option value=""  >--Không chọn công việc cha--</option>';
        if (mysqli_num_rows($result) > 0) {

            while ($out = mysqli_fetch_assoc($result)) { ?>
                <option value='<?= $out['khcv_ma'] ?>' <?php if($khcv_thuoc_macha == $out['khcv_ma']){echo 'selected';} ?>> <?= 'DA'. sprintf('%03d',$out['khcv_ma']) .' - '.$out['khcv_noidung'] ?></option>;
        <?php  }
        } else {
            echo '<option value="" selected >--Không chọn công việc cha--</option>';
        }
        break;
}
