<?
function send_curl($url, $post, $arrHeader, $arrPostData)
{
  global $fp;
  //fwrite($fp, print_r("เข้ามาส่ง curl" ."\n", true));
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
  //fwrite($fp, print_r($_uid ."\n", true));
  //fwrite($fp, print_r($result."\n", true));
  var_dump($result);
  $arrJson = json_decode($result, true);
  return $arrJson;
}

function chkuser($_uid){
  global $fp;
  $apiurl = "https://pimangroup.com/crm/LINE/line_api.php?func=chkuser";
  $pam = "&luid=" . $_uid;
  $json_string = file_get_contents($apiurl . $pam);
  $dataarray = json_decode($json_string);
  return $dataarray;
}

function adduser($met, $_uid){
  global $arrHeader;
  global $fp;
  $url = 'https://api.line.me/v2/bot/profile/' . $_uid;
  $arrJson = send_curl($url, false, $arrHeader, $arrPostData);
  $jarray = '{"line_name":"' . $arrJson['displayName'] . '","line_id":"' . $_uid . '","line_pic":"' . $arrJson['pictureUrl'] . '"}';
  $postdata = http_build_query(json_decode($jarray));
  fwrite($fp, print_r($postdata . '\r', true));
  $opts = array(
    'http' =>
    array(
      'method'  => 'POST',
      'header'  => 'Content-type: application/x-www-form-urlencoded',
      'content' => $postdata
    )
  );
  $context  = stream_context_create($opts);
  $exeurl = "https://pimangroup.com/crm/LINE/line_exe.php?func=adduser&met=" . $met;
  $result = file_get_contents($exeurl, false, $context);
}

function unfol_user($_uid){
  global $arrHeader;
  global $fp;
  /*$url='https://api.line.me/v2/bot/profile/' .$_uid;
  $arrJson=send_curl($url,false,$arrHeader,$arrPostData);*/
  $jarray = '{"line_id":"' . $_uid . '"}';
  $postdata = http_build_query(json_decode($jarray));
  //fwrite($fp, print_r($postdata.'\r', true));
  $opts = array(
    'http' =>
    array(
      'method'  => 'POST',
      'header'  => 'Content-type: application/x-www-form-urlencoded',
      'content' => $postdata
    )
  );
  $context  = stream_context_create($opts);
  $exeurl = "https://pimangroup.com/crm/LINE/line_exe.php?func=unfolusr";
  $result = file_get_contents($exeurl, false, $context);
}



  function addlog($_uid, $_token, $_sms){
    global $fp;
    $_sms = preg_replace("!\r?\n!", "", $_sms);
    //fwrite($fp, print_r('addlog', true));
    $jarray = '{"line_id":"' . $_uid . '","token":"' . $_token . '","sms":"' . $_sms . '"}';
    $postdata = http_build_query(json_decode($jarray));
    //fwrite($fp, print_r($postdata.'\r', true));
    $opts = array('http' =>
    array(
      'method'  => 'POST',
      'header'  => 'Content-type: application/x-www-form-urlencoded',
      'content' => $postdata
    ));
    $context  = stream_context_create($opts);
    $exeurl = "https://pimangroup.com/crm/LINE/line_exe.php?func=addchatlog";
    $result = file_get_contents($exeurl, false, $context);
  }

  function addbotlog($_uid, $_sms){
    global $fp;
    $_sms = preg_replace("!\r?\n!", "", $_sms);
    //fwrite($fp, print_r('addbotlog' .$_uid.$_sms , true));
    $jarray = '{"line_id":"' . $_uid . '","sms":"' . $_sms . '"}';
    //fwrite($fp, print_r($jarray.'\r', true));
    $postdata = http_build_query(json_decode($jarray));
    //fwrite($fp, print_r($postdata.'\r', true));
    $opts = array('http' =>
    array(
      'method'  => 'POST',
      'header'  => 'Content-type: application/x-www-form-urlencoded',
      'content' => $postdata
    ));
    $context  = stream_context_create($opts);
    $exeurl = "https://pimangroup.com/crm/LINE/line_exe.php?func=addbotlog";
    $result = file_get_contents($exeurl, false, $context);
  }

   