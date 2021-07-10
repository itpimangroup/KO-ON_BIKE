<?php
$func= $_REQUEST['func'];
$idstaff = $_REQUEST['staff_id'];
$id_line = $_REQUEST['id_line'];
switch ($func) {
  case 'check_idstaff':
    check_idstaff($idstaff,$id_line);
  break;
}

function send_curl($url,$post,$arrHeader,$arrPostData){
  global $myfile;
    //fwrite($myfile, print_r("เข้ามาส่ง curl" ."\n", true));
    $channel = curl_init();
    curl_setopt($channel, CURLOPT_URL, $url);
    curl_setopt($channel, CURLOPT_HEADER, false);
    curl_setopt($channel, CURLOPT_POST, $post);
    curl_setopt($channel, CURLOPT_HTTPHEADER, $arrHeader);
    if ($post == true) {
      curl_setopt($channel, CURLOPT_POSTFIELDS, json_encode($arrPostData));
    }
    curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($channel);
    curl_close($channel);
    
    // fwrite($myfile, print_r($result."\n", true));
    // fwrite($myfile, print_r($url ."\n", true));
    //fwrite($myfile, print_r($_uid ."\n", true));
    $arrJson = json_decode($result, true);
    return $arrJson;
}


function chkuser($_uid){
  $apiurl = "https://pimangroup.com/KO-ON_BIKE/api.php?func=check_user_bike";
  $pam = "&line_uid=". $_uid;
 // fwrite($myfile, print_r($pam, true));
  $json_string = file_get_contents($apiurl . $pam);
  $dataarray = json_decode($json_string);
  return $dataarray[0]->c_id;
}

function adduser($met, $_uid,$service_group){

  global $arrHeader;
  global $myfile;
  $url = 'https://api.line.me/v2/bot/profile/' . $_uid;
  $arrJson = send_curl($url, false, $arrHeader, $arrPostData);
  $jarray = '{"line_name":"' . $arrJson['displayName'] . '","line_id":"' . $_uid . '","line_pic":"' . $arrJson['pictureUrl'] . '","service_group":"' . $service_group . '"}';
  $postdata = http_build_query(json_decode($jarray));
  //fwrite($myfile, print_r($service_group . '\r', true));
  $opts = array(
    'http' =>
    array(
      'method'  => 'POST',
      'header'  => 'Content-type: application/x-www-form-urlencoded',
      'content' => $postdata
    )
  );
  $context  = stream_context_create($opts);
  $exeurl = "https://pimangroup.com/KO-ON_BIKE/exe.php?func=adduser&met=" . $met;
  $result = file_get_contents($exeurl, false, $context);
  
}

function unfol_user($_uid){
    global $arrHeader;
    global $myfile;
    /*$url='https://api.line.me/v2/bot/profile/' .$_uid;
    $arrJson=send_curl($url,false,$arrHeader,$arrPostData);*/
    $jarray = '{"line_id":"' . $_uid . '"}';
    $postdata = http_build_query(json_decode($jarray));
    //fwrite($myfile, print_r($postdata.'\r', true));
    $opts = array(
        'http' =>
        array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
        )
    );
    $context  = stream_context_create($opts);
    $exeurl = "https://pimangroup.com/HR/HRM/hrm_exe.php?func=unfolusr";
    $result = file_get_contents($exeurl, false, $context);
    }



?>