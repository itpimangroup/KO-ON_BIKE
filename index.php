<?$source=$_REQUEST['s']; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://pimangroup.com/KO-ON_BIKE/img/logo_koonbike.png">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@500&display=swap" rel="stylesheet">

    <!-- sweetalert -->
    <script src="https://pimangroup.com/KO-ON_BIKE/sweetalert/sweetalert.min.js"></script>
    <!-- sweetalert -->

    <!-- LIFF SDK -->
    <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
  
    <!-- title -->
    <title>KO-ON Bike</title>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/js/uikit.min.js"></script>

    
</head>

<body style="font-family: 'Mali', cursive; background-color:#fffdde;">



    <script>
    //$(document).ready(function () {
  

    function runApp() {
      liff.getProfile().then(profile => {
       var pic_line = profile.pictureUrl;
       var line_uid = profile.userId;
       var line_name = profile.displayName;
       var status_mess = profile.statusMessage;
       var email = liff.getDecodedIDToken().email;
       
       var url = 'https://pimangroup.com/KO-ON_BIKE/api.php?func=check_user_bike&line_uid='+line_uid;
            check_line = $.ajax({
                        url:url,
                        async: false,
                        dataType: 'json'
                    }).responseJSON;
                
                if(check_line[0].c_id>=1){
                        
                        var urls = "https://pimangroup.com/KO-ON_BIKE/exe.php";
                        var para = "func=registerid&met=ko_on_bike_update&pic_line="+pic_line+"&line_uid="+line_uid+"&line_name="+line_name+"&status_mess="+status_mess+"&email="+email;
                        //console.log(para);
                              $.ajax({
                                    type: 'POST',
                                    url: urls,
                                    data: para,
                                    //async:false,
                                    success: function(data) {
                                      //console.log(data);
                                     

                                    }
                                });/////end ajax
                                swal({
                                        title: "สวัสดี คุณ:"+line_name+" ",
                                        text: "กรุณารอสักครู่เพื่อลงทะเบียนสมาชิก!",
                                        icon: "success",
                                        timer: 2000,
                                        button: false,
                                      })
                                      .then((value) => {
                                         location.replace("https://pimangroup.com/KO-ON_BIKE/koon_register.php?uid="+line_uid);
                                });
                               
                }else{

                  var urls = "https://pimangroup.com/KO-ON_BIKE/exe.php";
                  var para = "func=registerid&met=ko_on_bike_register&pic_line="+pic_line+"&line_uid="+line_uid+"&line_name="+line_name+"&status_mess="+status_mess+"&email="+email;
                  //console.log(para);
                              $.ajax({
                                    type: 'POST',
                                    url: urls,
                                    data: para,
                                    //async:false,
                                    success: function(data) {
                                     // console.log(data);
                                      
                                    }
                                });/////end ajax
                                swal({
                                        title: "สวัสดี คุณ:"+line_name+" ",
                                        text: "กรุณารอสักครู่เพื่อลงทะเบียนสมาชิก!",
                                        icon: "success",
                                        timer: 2000,
                                        button: false,
                                      })
                                      .then((value) => {
                                         location.replace("https://pimangroup.com/KO-ON_BIKE/koon_register.php?uid="+line_uid);
                                   });

                }
                 
                 
      
        
            

     

    
      }).catch(err => console.error(err));
    }
/////////ค้นหาไอดี liff
    var urla = 'https://pimangroup.com/KO-ON_BIKE/api.php?func=get_line_liff&liff_name=<?echo $source;?>';
                    liff_check = $.ajax({
                    url:urla,
                    async: false,
                    dataType: 'json'
                }).responseJSON;
                
    var liff_id=liff_check[0].liff_id;
    //console.log(liff_id);
   liff.init({ liffId:'1655537433-36WM7zm0'}, () => {
      if (liff.isLoggedIn()) {
        runApp()
      } else {
        liff.login();
      }
    }, err => console.error(err.code, error.message));
    
    //});
    //  $( document ).ready(function() {
    //     $('#exampleModalLong').modal('show')
    //  });
</script>

</body>

</html>
