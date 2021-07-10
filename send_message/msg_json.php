<?
$msg=$_REQUEST['msg'];
$k_id=$_REQUEST['k_id'];

$url = "https://pimangroup.com/KO-ON_BIKE/api.php?func=get_profile_member&k_id=".$k_id;
$json_string = file_get_contents($url);
$dataarray = json_decode($json_string);

switch($msg){
  
 

      // case 'register_koon':
      // $json_msg='
      // {
      //   "type": "flex",
      //   "altText": "Flex Message",
      //   "contents": 
      
         
      // }
      // ';

  case 'register_koon':
       $json_msg ='{
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
  break;

  case 'booking_un_success':
    $json_msg ='{
      "type": "template",
      "altText": "this is an image carousel template",
      "template": {
        "type": "image_carousel",
        "columns": [
          {
            "imageUrl": "https://pimangroup.com/KO-ON_BIKE/img/thk_koonbiek.png",
            "action": {
              "type": "uri",
              "label": "สนใจจองกดเลย",
              "uri": "https://liff.line.me/1655537433-PqWp78Xk?m_id='.$dataarray[0]->m_id.'"
            }
          }
        ]
      }
    }';//end json
break;

case 'booking_success':
  $json_msg ='{
    "type": "template",
    "altText": "this is an image carousel template",
    "template": {
      "type": "image_carousel",
      "columns": [
        {
          "imageUrl": "https://pimangroup.com/KO-ON_BIKE/img/thk_koonbiek.png",
          "action": {
            "type": "uri",
            "label": "ประวัติการจอง",
            "uri": "https://liff.line.me/1655537433-PqWp78Xk?m_id='.$dataarray[0]->m_id.'"
          }
        }
      ]
    }
  }';//end json
break;

}

?>