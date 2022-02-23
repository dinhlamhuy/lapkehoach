<?php

require_once __DIR__ . '/../database.php';
function lastmonth($month = '', $year = '')
{
   if (empty($month)) {
      $month = date('m');
   }
   if (empty($year)) {
      $year = date('Y');
   }
   $result = strtotime("{$year}-{$month}-01");
   $result = strtotime('-1 second', strtotime('+1 month', $result));
   return date('d', $result);
}
$chuoi = 'INSERT INTO `tuan`(`t_sotuan`, `nam_id`, `t_ngaydau`, `t_ngaycuoi`) VALUES ';
$bienss = 0;
for ($thang = 1; $thang <= 12; $thang++) {

   for ($ngay = 4; $ngay <= lastmonth($thang); $ngay++) {
      $date = '2021-' . $thang . '-' . $ngay;

      $week = date('W', strtotime($date));
      if ($week != $bienss) {
         $chuoi .= "('" . $week . "', '1', '" . $date . "', '" . date('Y-m-d', strtotime('+6 day', strtotime($date))) . "'),";
         $bienss = $week;
      }
   }
}
$chuoimoi = substr($chuoi, 0, -1);
// mysqli_query($conn, $chuoimoi);
// echo $chuoimoi;

