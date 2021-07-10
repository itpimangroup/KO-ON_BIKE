<?
  include 'line_func.php';
  header("Content-Type: application/json");
  // include 'msg_json.php';
  //echo $urlpath;
  // $content = file_get_contents('php://input');
  // $arrJson = json_decode($content, true);

  //$strUrl = "https://api.line.me/v2/bot/message/multicast";
  $strUrl = "https://api.line.me/v2/bot/message/push";

  ////////////////////// get header pl=line provider///////////////////////////
  $strAccessToken = get_header($_REQUEST['lp']);
  $arrHeader = array();
  $arrHeader[] = "Content-Type: application/json";
  $arrHeader[] = "Authorization: Bearer {$strAccessToken}";
  //////////////////////end////////////////////////////////////


  //$uid=array();

  // $_uid=fn2send($_REQUEST['linefn']);////ส่งแบบกลุ่ม
  // //var_dump($_uid);
  // for($i=0;$i<count($_uid);$i++){//////////ส่งค่า line id group
  //     array_push($uid,$_uid[$i]->line_id);
  //     send_msg_push($_uid[$i]->line_id);// for push   
  // }


  //var_dump($strAccessToken);
  //echo"<br>";


if($_REQUEST['k_id']){
  //get check_in line id
 
  $url="https://pimangroup.com/KO-ON_BIKE/api.php?func=getline_fn_to_id&k_id=".$_REQUEST['k_id'];
  $jarray=file_get_contents($url);
  $data=json_decode($jarray);

  for($i=0;$i<count($data);$i++){
      //array_push($data[$i]->line_uid);
      send_msg_push($data[$i]->line_uid);// for push
     // var_dump($data[$i]->line_uid);  
  }  
}



    function get_header($lp){//////////// check token provider
       
        $url="https://pimangroup.com/KO-ON_BIKE/api.php?func=getarrheader&line_pro=".$lp;
      //echo $url;
        $jarray=file_get_contents($url);
        $data=json_decode($jarray);
        return $data[0]->ch_token;
        
    }

  // function fn2send($func){////////// line_id group แบบกลุ่ม
  //     $url="https://pimangroup.com/KO-ON_BIKE/api.php?func=getline_fn_to_id&fid=".$func;
  //     $jarray=file_get_contents($url);
  //     $data=json_decode($jarray);

  //     $lid=$data[0]->line_user;
  //     $url="https://pimangroup.com/KO-ON_BIKE/api.php?func=getline_fn_to_list&lid=".$lid;
  //     $jarray=file_get_contents($url);
  //     $data=json_decode($jarray);
  //     return $data;
  // }


  function send_msg_push($uid){////ส่งข้อความ
      global $strUrl, $arrHeader;
      $arrPostData = array();

      include 'msg_json.php';
   
      $msg = json_decode($json_msg);
      $arrPostData['to'] = $uid;
      $arrPostData['messages'][0] = $msg;
      $arrJson = send_curl($strUrl, true, $arrHeader, $arrPostData);

      //var_dump($msg);
  }


?> 