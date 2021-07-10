<?
$code_book = $_REQUEST['code_book'];
$sta_book = $_REQUEST['sta_book'];
$url = "https://pimangroup.com/KO-ON_BIKE/api.php?func=get_check_booking&code_book=".$code_book;////ตรวจสอบจำนวนรถ
$json_string = file_get_contents($url);
$dataarray = json_decode($json_string);

define('LINE_API', "https://notify-api.line.me/api/notify");
$token = "Od6VoyVIYGj3B2LwQvexUX4NqNfR3JnUhoBFsW4BTnl"; //ใส่Token ที่copy เอาไว้

switch($sta_book){
    case 'booking_del':
        $params = array(
            "message"        => " ยกเลิกการจอง \r\nผู้จอง: ".$dataarray[0]->f_name." ".$dataarray[0]->l_name."\r\nช่วงเวลา: ".$dataarray[0]->time_booking_text." \r\nวันที่จอง: ".$dataarray[0]->date_booking_s." \r\nจำนวนคัน: ".$dataarray[0]->unit_bike." คัน \r\nเบอร์ติดต่อ: ".$dataarray[0]->phone_number_book."", //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
        //   "stickerPkg"     => 2, //stickerPackageId
        //   "stickerId"      => 34, //stickerId
        //   "imageThumbnail" => "https://c1.staticflickr.com/9/8220/8292155879_bd917986b4_m.jpg", // max size 240x240px JPEG
        //   "imageFullsize"  => "https://c1.staticflickr.com/9/8220/8292155879_bd917986b4_m.jpg", //max size 1024x1024px JPEG
        );
    break;

    case 'booking':
        $params = array(
            "message"        => " จองขอใช้รถ \r\nผู้จอง: ".$dataarray[0]->f_name." ".$dataarray[0]->l_name."\r\nช่วงเวลา: ".$dataarray[0]->time_booking_text." \r\nวันที่จอง: ".$dataarray[0]->date_booking_s." \r\nจำนวนคัน: ".$dataarray[0]->unit_bike." คัน \r\nเบอร์ติดต่อ: ".$dataarray[0]->phone_number_book."", //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
        //   "stickerPkg"     => 2, //stickerPackageId
        //   "stickerId"      => 34, //stickerId
        //   "imageThumbnail" => "https://c1.staticflickr.com/9/8220/8292155879_bd917986b4_m.jpg", // max size 240x240px JPEG
        //   "imageFullsize"  => "https://c1.staticflickr.com/9/8220/8292155879_bd917986b4_m.jpg", //max size 1024x1024px JPEG
        );
    break;
}


$res = notify_message($params, $token);
// print_r($res);
 
function notify_message($params, $token) {
  $queryData = array(
    'message'          => $params["message"],
    'stickerPackageId' => $params["stickerPkg"],
    'stickerId'        => $params["stickerId"],
    'imageThumbnail'   => $params["imageThumbnail"],
    'imageFullsize'    => $params["imageFullsize"],
  );

  $queryData = http_build_query($queryData, '', '&');

  $headerOptions = array(
    'http' => array(
      'method'  => 'POST',
      'header'  => "Content-Type: application/x-www-form-urlencoded\r\n"
      . "Authorization: Bearer " . $token . "\r\n"
      . "Content-Length: " . strlen($queryData) . "\r\n",
      'content' => $queryData,
    ),
  );

  $context = stream_context_create($headerOptions);
  $result = file_get_contents(LINE_API, FALSE, $context);
  $res = json_decode($result);
  return $res;
}
?>