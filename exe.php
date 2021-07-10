<?php
 header("Content-Type: application/json");
include 'cf.php';
$func=$_REQUEST['func'];
$met=$_REQUEST["met"];
$uadd=$_REQUEST["uname"];


$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->exec("SET NAMES \"utf8\"");

function fetchquery($sql){
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
     // var_dump($result);
    return $result;
    //return 1;
  }

  function exequery($sql){
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return 1;
  }
  //$response = array();

  switch ($func) {
        case 'adduser':
            $sql=getaddusersql($met);
        break;

        case 'registerid':
            $sql=getregister($met);
        break;

        case 'unfolusr':
            $sql=usr_unfol($met);
        break;

        case 'register_member':
            $sql=koon_bike_member($met);
        break;

        case 'booking_member':
          $sql=booking_member($met);
        break;
    }

function getaddusersql($met){
    switch ($met) {
        case 'add':
            $sql="INSERT INTO ko_on_bike(line_uid,line_name,pic_line,in_date) VALUES ('".$_REQUEST['line_id']."','".$_REQUEST['line_name']."','".$_REQUEST['line_pic']."',now())";
            exequery($sql); 
        break;
        
        case 'edit':
            $sql="UPDATE ko_on_bike SET line_name='".$_REQUEST['line_name']."',pic_line='".$_REQUEST['line_pic']."',left_date=now() WHERE line_uid='".$_REQUEST['line_id']."'";
            exequery($sql); 
        break;
      
    }

}

function getregister($met){
    switch($met){
    
        case 'ko_on_bike_register':
          $sql="INSERT INTO `ko_on_bike`( `line_uid`, `line_name`, `pic_line`, `email`, `status_mess`, `in_date`) VALUES ('".$_REQUEST['line_uid']."','".$_REQUEST['line_name']."'
          ,'".$_REQUEST['pic_line']."','".$_REQUEST['email']."','".$_REQUEST['status_mess']."',now())";
          //echo $sql;
          exequery($sql); 
        break;
      
        case 'ko_on_bike_update':
          $sql="UPDATE `ko_on_bike` SET  `line_uid`='".$_REQUEST['line_uid']."',`line_name`='".$_REQUEST['line_name']."',`pic_line`='".$_REQUEST['pic_line']."'
          ,`email`='".$_REQUEST['email']."',`status_mess`='".$_REQUEST['status_mess']."',left_date=now() WHERE line_uid='".$_REQUEST['line_uid']."' ";
          //echo $sql;
            exequery($sql); 
        break;
       
      }
}

function koon_bike_member($met){
    $k_id=$_REQUEST['k_id'];
    $f_name=$_REQUEST['f_name'];
    $l_name=$_REQUEST['l_name'];
    $email=$_REQUEST['email'];
    $phone_number=$_REQUEST['phone_number'];
    $birth_date=$_REQUEST['birth_date'];

    switch($met){
        
        case 'member_register':
          $sql="INSERT INTO koon_member (k_id, f_name,l_name, email, phone_number, birth_date,PDPA, a_date) 
          VALUES ('".$k_id."','".$f_name."','".$l_name."','".$email."','".$phone_number."','".$birth_date."','1',now())";
          //echo $sql;
          exequery($sql); 
        break;
      
        case 'ko_on_bike_update':
          $sql="";
          //echo $sql;
            exequery($sql); 
        break;
       
      }
}

function booking_member($met){
  $m_id = $_REQUEST['m_id'];

  $url="https://pimangroup.com/KO-ON_BIKE/api.php?func=get_code_booking";//// set code booking auto
  $json_string = file_get_contents($url);
  $dataarray = json_decode($json_string);
  $code_id = $dataarray[0]->b_id;
  $code_book = sprintf('%04d',$code_id);

  $date_booking = $_REQUEST['date_booking'];
  $time_booking = $_REQUEST['time_booking'];
  $unit_bike = $_REQUEST['unit_bike'];
  $phone_number_book = $_REQUEST['phone_number_book'];

  $url_u="https://pimangroup.com/KO-ON_BIKE/api.php?func=get_check_bike";////ตรวจสอบจำนวนรถ
  $json_string_u = file_get_contents($url_u);
  $dataarray_u = json_decode($json_string_u);
  $unit_d=$dataarray_u[0]->bike;

  $code_book_check=$_REQUEST['code_book'];
  $url_book="https://pimangroup.com/KO-ON_BIKE/api.php?func=get_check_booking&code_book=".$code_book_check;////ตรวจสอบ code_bookingbike
  $json_string_book = file_get_contents($url_book);
  $dataarray_book = json_decode($json_string_book);
  $unit_bike_check=$dataarray_book[0]->unit_bike;

  switch($met){
    case 'booking_add':
      $sql="INSERT INTO koon_booking( m_id, code_book, date_booking, time_booking,unit_bike,phone_number_book,a_date) 
      VALUES ('".$m_id."','B".$code_book."','".$date_booking."','".$time_booking."','".$unit_bike."','".$phone_number_book."',now())";
      exequery($sql); 

      $response = array(
          'code_book' => 'B'.$code_book.'',
          );
      echo json_encode($response);
      exit;
    break;
    
    case 'agreement':
      $sql="UPDATE koon_booking SET agreement='1' , status_booking='B' WHERE code_book='".$_REQUEST['code_book']."'";
      exequery($sql); 
    break;

    case 'inbike':
      $sql="UPDATE koon_booking SET status_booking='I' WHERE code_book='".$code_book_check."'; ";
      $sql.=" UPDATE koonbike_unit SET bike=(".$unit_d."-".$unit_bike_check.") ,edit_date=now();";
      //echo $sql;
      exequery($sql); 
    break;

    case 'outbike':
       $sql="UPDATE koon_booking SET status_booking='O' ,out_date=now() WHERE code_book='".$code_book_check."'; ";
       $sql.=" UPDATE koonbike_unit SET  bike=(".$unit_d."+".$unit_bike_check."),edit_date=now()";
       //echo $sql;
       exequery($sql); 
    break;

    case 'booking_del':
      $sql="UPDATE koon_booking SET status_booking='C' WHERE code_book='".$code_book_check."';";
      exequery($sql); 
    break;

  }

}
  
?>