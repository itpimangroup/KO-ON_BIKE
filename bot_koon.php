<?php
    include 'cf.php'; //DB
    include 'func_koon.php';

    date_default_timezone_set("Asia/Bangkok");
    $date = date("Y-m-d");
    $time = date("H:i:s");

    $url = "https://pimangroup.com/LINE/line_api.php?svg=11&func=gettoken";
    $json_string = file_get_contents($url);
    $dataarray = json_decode($json_string);
    $strtoken = $dataarray[0]->ch_token;
    $service_group = $dataarray[0]->service_group;
    $arrHeader = array();
    $arrHeader[] = "Content-Type: application/json";
    $arrHeader[] = "Authorization: Bearer {'$strtoken'}";

    $content = file_get_contents('php://input');
    $arrJson = json_decode($content, true);
    $_uid = $arrJson['events'][0]['source']['userId'];
    $_reply_token = $arrJson['events'][0]['replyToken'];
    $_type = $arrJson['events'][0]['type'];
    $strUrl = "https://api.line.me/v2/bot/message/push";

    $url_profile = 'https://api.line.me/v2/bot/profile/'. $_uid;
    $dataJson = send_curl($url_profile, false, $arrHeader, $arrPostData);
    $disname = $dataJson['displayName'];
 
    // $url_profile = "https://pimangroup.com/HR/bot_api.php?func=chkuser&line_id=".$_uid."&service_group=".$service_group;
    // $json_string_profile = file_get_contents($url_profile);
    // $dataarray_profile = json_decode($json_string_profile);
    // $name_profile =  $dataarray_profile[0]->name_id;
    //var_dump($service_group);
    $myfile = fopen("log.txt", "a")or die("Unable to open file!");
    //fwrite($myfile, print_r($_type, true));  

    $url = "https://pimangroup.com/KO-ON_BIKE/api.php?func=get_id_member&uid=".$_uid;
    $json_string = file_get_contents($url);
    $dataarray = json_decode($json_string);/////ค้นหา ไอดีที่มีอยู่
    
switch ($_type) {

      case 'follow':
              $isnewusr = chkuser($_uid); //check new userI
              // adduser('add',$_uid, $service_group); //add display name
              // fwrite($myfile, print_r($isnewusr, true));  
            
      if ($isnewusr==1) {
          adduser('edit',$_uid, $service_group); //update display name
          $jsonBooking = '{
            "type": "template",
            "altText": "this is an image carousel template",
            "template": {
              "type": "image_carousel",
              "columns": [
                {
                  "imageUrl": "https://pimangroup.com/KO-ON_BIKE/img/booking.png",
                  "action": {
                    "type": "uri",
                    "label": "จองเลย",
                    "uri": "https://liff.line.me/1655537433-PqWp78Xk?m_id='.$dataarray[0]->m_id.'"
                  }
                }
              ]
            }
          }';//end json

            $Booking = json_decode($jsonBooking);
            $arrPostData['to'] = $_uid;
            $arrPostData['messages'][0] = $Booking;
            $arrJson = send_curl($strUrl, true, $arrHeader, $arrPostData); 
            //fwrite($myfile, print_r($jsonRegister , true));       

          }else{
            $jsonRegister = '
            {
              "type": "template",
              "altText": "this is an image carousel template",
              "template": {
                "type": "image_carousel",
                "columns": [
                  {
                    "imageUrl": "https://pimangroup.com/KO-ON_BIKE/img/register_logo.png",
                    "action": {
                      "type": "uri",
                      "label": "กดเลย",
                      "uri": "https://liff.line.me/1655537433-36WM7zm0"
                    }
                  }
                ]
              }
            }
           
           ';//end json
            // fwrite($myfile, print_r($isnewusr.$arrPostData, true));  
             adduser('add', $_uid, $service_group);   //insert usr
              $register = json_decode($jsonRegister);
              $arrPostData['to'] = $_uid;
              $arrPostData['messages'][0] = $register;
              $arrJson = send_curl($strUrl, true, $arrHeader, $arrPostData);      
            //  fwrite($myfile, print_r($jsonRegister , true));  
        }
  break; //endfollow
          
  case 'unfollow': //unfollow
          unfol_user($_uid); // update left_date
  break; //endunfollow
    
  

  case 'message': //message
    $_msg = $arrJson['events'][0]['message']['text'];///รับ ข้อความ

    $check_register = $dataarray[0]->check_register;//// เช็คลงทะเบียน
    if ($check_register==1) {
      adduser('edit',$_uid, $service_group); //update display name
      
      if($_msg=="จองรถ"){
        $jsonBooking = '{
          "type": "template",
          "altText": "this is an image carousel template",
          "template": {
            "type": "image_carousel",
            "columns": [
              {
                "imageUrl": "https://pimangroup.com/KO-ON_BIKE/img/booking.png",
                "action": {
                  "type": "uri",
                  "label": "จองเลย",
                  "uri": "https://liff.line.me/1655537433-PqWp78Xk?m_id='.$dataarray[0]->m_id.'"
                }
              }
            ]
          }
        }';//end json
      }/// end booking bike 

     else if($_msg=="ข้อตกลง"){
        $jsonBooking = '{
          "type": "template",
          "altText": "this is an image carousel template",
          "template": {
            "type": "image_carousel",
            "columns": [
              {
                "imageUrl": "https://pimangroup.com/KO-ON_BIKE/img/agreement.jpg",
                "action": {
                  "type": "uri",
                  "label": "รายละเอียด",
                  "uri": "https://liff.line.me/1655537433-wgqRWM2A"
                }
              }
            ]
          }
        }';//end json
      }////ข้อตกลง


      else{
        $jsonBooking = '{
            "type": "text",
            "text": "ไม่สามารถตอบคำถามที่ลูกค้าต้องการได้ ถ้าท่านสนใจจองรถ กรุณาพิมพ์ จองรถ "
          }';//end json
      }////นอกเหนือจากเงื่อนไข
      //fwrite($myfile, print_r($jsonBooking , true));       


      $Booking = json_decode($jsonBooking);
      $arrPostData['to'] = $_uid;
      $arrPostData['messages'][0] = $Booking;
      $arrJson = send_curl($strUrl, true, $arrHeader, $arrPostData);         
    }else{
      adduser('add', $_uid, $service_group);   //insert usr

        $jsonRegister = '
        {
          "type": "template",
          "altText": "this is an image carousel template",
          "template": {
            "type": "image_carousel",
            "columns": [
              {
                "imageUrl": "https://pimangroup.com/KO-ON_BIKE/img/register_logo.png",
                "action": {
                  "type": "uri",
                  "label": "กดเลย",
                  "uri": "https://liff.line.me/1655537433-36WM7zm0"
                }
              }
            ]
          }
        }
      
      ';//end json

      $register = json_decode($jsonRegister);
      $arrPostData['to'] = $_uid;
      $arrPostData['messages'][0] = $register;
      $arrJson = send_curl($strUrl, true, $arrHeader, $arrPostData);     
    }

         
      
  break;
    
}
    
 
   fclose($myfile);

?>