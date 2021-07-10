<?
$sta_bo =$_REQUEST['status_booking'];
$set_date=date("Y-m-d");
// echo $sta_bo;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://pimangroup.com/KO-ON_BIKE/img/logo_koonbike.png">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@500&display=swap" rel="stylesheet">

    <link href="https://pimangroup.com/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="https://pimangroup.com/fontawesome/css/brands.css" rel="stylesheet">
    <link href="https://pimangroup.com/fontawesome/css/solid.css" rel="stylesheet">

    <!-- sweetalert -->
    <script src="https://pimangroup.com/KO-ON_BIKE/sweetalert/sweetalert.min.js"></script>
    <!-- sweetalert -->

     <!-- LIFF SDK -->
     <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
     <!-- <script src="https://static.line-scdn.net/liff/edge/2.1/liff.js"></script> -->

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <title>KO-ON Bike (จองรถ)</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/js/uikit.min.js"></script>
    <style>
        body{
                /* background-color: #dee9ff; */
                background-color:#fffdde;
                font-family: 'Mali', cursive;
            }

            .booking-form{
                padding: 50px 0;
            }

            .booking-form .form-div{
                background-color: #fff;
                max-width: 600px;
                margin: auto;
                padding: 50px 70px;
                border-top-left-radius: 30px;
                border-top-right-radius: 30px;
                box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
            }

            .booking-form .form-icon{
                text-align: center;
                background-color: #edc307;
                border-radius: 50%;
                font-size: 40px;
                color: white;
                width: 100px;
                height: 100px;
                margin: auto;
                margin-bottom: 50px;
                line-height: 100px;
            }

            .booking-form .item{
                border-radius: 20px;
                margin-bottom: 8px;
                padding: 8px 20px;
            }

            .booking-form .create-account{
                border-radius: 30px;
                padding: 10px 20px;
                font-size: 18px;
                font-weight: bold;
                /* background-color: #edc307; */
                border: none;
                color: white;
                margin-top: 20px;
            }

           

            @media (max-width: 576px) {
                .booking-form .form-div{
                    padding: 50px 20px;
                }

                .booking-form .form-icon{
                    width: 70px;
                    height: 70px;
                    font-size: 30px;
                    line-height: 70px;
                }
            }
    </style>
</head>
<body>
<div id="show_booking" class="booking-form" >
<!-- แสดง หน้าที่ต้องการ -->
</div>


<div class="modal fade" id="sta_camera" tabindex="-1" aria-labelledby="sta_cameraLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sta_cameraLabel">ScanQR code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container" id="decoded_value" style="display:show">
                    <div class="row">
                        <div class="col">
                            <div>
                                <video autoplay playsinline="true" style="width:100%; height: 100%; object-fit: fill;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span id="decoded-value"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- <button type="button" class="btn btn-primary" >เริ่มสแกน</button> -->
                            <button type="button" class="btn btn-outline-dark" id="test" onclick="stopReader();">ปิดกล้อง</button>
                        </div>
                    </div>
            </div>                 
      </div>

      <div class="container" id="show_detail" style="display:none">
                    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="stopReader();" data-dismiss="modal">ปิดหน้า</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jsqr@latest/dist/jsQR.min.js"></script>
<script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>

<script>

  var queryString = decodeURIComponent(window.location.search).replace("?liff.state=", "");
  var params = new URLSearchParams(queryString);
  var m_id = params.get('m_id');
  var status_booking = '<?echo $sta_bo;?>';

  //console.log(status_booking);
  
  var url = 'https://pimangroup.com/KO-ON_BIKE/api.php?func=get_profile_member&m_id='+m_id;///// ตรวจสอบลงทะเบีย
            profile_mem = $.ajax({
                        url:url,
                        async: false,
                        dataType: 'json'
                    }).responseJSON;

  var url_b = 'https://pimangroup.com/KO-ON_BIKE/api.php?func=get_booking_rec&m_id='+m_id;///// ตรวจสอบจอง
                booking = $.ajax({
                            url:url_b,
                            async: false,
                            dataType: 'json'
                        }).responseJSON;
 
if(profile_mem[0].c_member!=0){////ลงทะเบียนแล้ว

        

     if (booking[0].c_booking <= 0) {////เริ่มจอง
            swal({
            title: " คุณ : "+profile_mem[0].f_name+" "+profile_mem[0].l_name+"",
                text: "ระบบกำลังตรวจสอบสิทธิของท่าน",
                icon: "success",
                timer: 2000,
                button: false,
            }).then((value) => {
                $('#show_booking').load("booking.php?m_id="+m_id);
            });

    } else {/// แก้ไขจอง
            swal({
            title: " คุณ : "+profile_mem[0].f_name+" "+profile_mem[0].l_name+"",
                text: "ระบบกำลังตรวจสอบสิทธิของท่าน",
                icon: "success",
                timer: 2000,
                button: false,
            }).then((value) => {
                $('#show_booking').load("booking_edit.php?m_id="+m_id);
            });

        // if(status_booking=='new_booking'){
        //     swal({
        //     title: " คุณ : "+profile_mem[0].f_name+" "+profile_mem[0].l_name+"",
        //         text: "ระบบกำลังตรวจสอบสิทธิของท่าน",
        //         icon: "success",
        //         timer: 2000,
        //         button: false,
        //     }).then((value) => {
        //         $('#show_booking').load("booking.php?m_id="+m_id);
        //     });

        // }else{
        //     swal({
        //         title: " คุณ : "+profile_mem[0].f_name+" "+profile_mem[0].l_name+"",
        //             text: "ระบบกำลังตรวจสอบสิทธิของท่าน",
        //             icon: "success",
        //             timer: 2000, 
        //             button: false,
        //         }).then((value) => {
        //             $('#show_booking').load("booking_edit.php?m_id="+m_id);
        //       });
        // }
           
             liff.init({ liffId: "1655537433-PqWp78Xk" });
    }

}else{////ยังไม่ลงทะเบียน
    location.replace("https://liff.line.me/1655537433-36WM7zm0");
}
    function review(code_book){/////review
        $('#show_detail').load("booking_check_user.php?code_book="+code_book);  
        $('#decoded_value').hide();
        $('#show_detail').show();
    };

    function booking_del(code_book,m_id) {
        swal({
                title: "คุณต้องยกเลิกจองหรือไม่?",
                text: "#CODE:"+code_book+" เมื่อกดยืนยัน เพื่อยกเลิกการจอง !",
                icon: "warning",
                buttons: ["ยกเลิก", "ยืนยัน"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                     var urls = "https://pimangroup.com/KO-ON_BIKE/exe.php";
                     var para = "func=booking_member&met=booking_del&code_book="+code_book+"";
                    
                    $.ajax({
                        type: 'POST',
                        url: urls,
                        data: para,
                        async:false,
                        success: function(data) {

                        }
                   });//ajax

                   $.ajax({
                        type: 'POST',
                        url: 'https://pimangroup.com/KO-ON_BIKE/line_notify.php',
                        data: 'code_book='+code_book+'&sta_book=booking_del',
                        //async:false,
                        datatype:'json',
                        success: function(data) {  
                                                              
                            }
                        });////end ajax notify
                   
                    swal({
                        //title: " คุณ : "+profile_mem[0].f_name+" "+profile_mem[0].l_name+"",
                            text: "โปรดรอสักครู่ระบบกำลังตรวจสอบ",
                            //icon: "success",
                            timer: 2000, 
                            button: false,
                        }).then((value) => {
                            // $('#show_booking').load("booking_edit.php?m_id="+m_id);
                            liff.closeWindow();
                        });
                } else {
                    swal("ไม่ยืนยัน!");
                }
            });///swal

    };

    function scanCode(code_book,status_booking) {
        // var queryString = decodeURIComponent(window.location.search).replace("?liff.state=", "");
        // var params = new URLSearchParams(queryString);
    var url = 'https://pimangroup.com/KO-ON_BIKE/api.php?func=get_data_booking&code_book='+code_book;///// ตรวจสอบจอง
                booking_day = $.ajax({
                            url:url,
                            async: false,
                            dataType: 'json'
                        }).responseJSON;
      var date_set = '<?echo $set_date;?>';
      var set_day_booking = booking_day[0].date_booking;
      var status_book = booking_day[0].status_booking;
      if(status_book=='B'){
       var qrcode_sta = 'inbike';
      }else{
       var qrcode_sta = 'outbike';
      }
                        
           // alert(date_set+' '+set_day_booking);
        if(qrcode_sta=='inbike' && status_booking=='B' && set_day_booking==date_set){
            swal({
                title: "คุณต้องการรับรถหรือไม่?",
                text: "#CODE:"+code_book+" เมื่อกดยืนยันแล้ว โปรดนำหน้าจอยืนยันเพื่อรับรถจักยานกับพนักงาน !",
                icon: "warning",
                buttons: ["ยกเลิก", "ยืนยัน"],
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                     var urls = "https://pimangroup.com/KO-ON_BIKE/exe.php";
                     var para = "func=booking_member&met="+qrcode_sta+"&code_book="+code_book+"";
                    
                    $.ajax({
                        type: 'POST',
                        url: urls,
                        data: para,
                        async:false,
                        success: function(data) {

                        }
                   });//ajax
                   
                    swal({
                        //title: " คุณ : "+profile_mem[0].f_name+" "+profile_mem[0].l_name+"",
                            text: "โปรดรอสักครู่ระบบกำลังตรวจสอบ",
                            //icon: "success",
                            timer: 2000, 
                            button: false,
                        }).then((value) => {
                            $('#show_detail').load("booking_check_user.php?code_book="+code_book+"&sta_booking="+qrcode_sta);
                            $('#show_booking').load("booking_edit.php?m_id="+m_id);
                            // $('#sta_camera').modal('hide');
                            $('#decoded_value').hide();
                            $('#show_detail').show();
                        });
                } else {
                    swal("ไม่ยืนยันรับรถ!");
                    stopReader();
                   // $('#sta_camera').modal('hide');
                }
            });///swal

        } else if(qrcode_sta=='outbike' && status_booking=='I' && set_day_booking==date_set){
            swal({
                title: "คุณต้องการคืนรถหรือไม่?",
                text: "#CODE:"+code_book+" เมื่อกดยืนยันแล้ว โปรดนำหน้าจอยืนยันเพื่อคืนรถจักยานกับพนักงาน !",
                icon: "warning",
                buttons: ["ยกเลิก", "ยืนยัน"],
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                     var urls = "https://pimangroup.com/KO-ON_BIKE/exe.php";
                     var para = "func=booking_member&met="+qrcode_sta+"&code_book="+code_book+"";
                    
                    $.ajax({
                        type: 'POST',
                        url: urls,
                        data: para,
                        async:false,
                        success: function(data) {

                        }
                   });//ajax
                   
                    swal({
                        //title: " คุณ : "+profile_mem[0].f_name+" "+profile_mem[0].l_name+"",
                            text: "โปรดรอสักครู่ระบบกำลังตรวจสอบ",
                            //icon: "success",
                            timer: 2000, 
                            button: false,
                        }).then((value) => {
                            $('#show_detail').load("booking_check_user.php?code_book="+code_book+"&sta_booking="+qrcode_sta);
                            $('#show_booking').load("booking_edit.php?m_id="+m_id);
                            // $('#sta_camera').modal('hide');
                            $('#decoded_value').hide();
                            $('#show_detail').show();
                        });
                } else {
                    swal("ไม่ยืนยันคืนรถ!");
                    //stopReader();
                   // $('#sta_camera').modal('hide');
                }
            });///swal

        }else if(booking_day[0].date_booking!=date_set){
            swal("ยังไม่ถึงวันจอง!", "โปรดรอให้ถึงวันจองของท่าน วันที่ "+booking_day[0].date_booking+"", "error");
        }else{
            swal("QR code รถไม่ถูกต้อง!", "โปรดตรวจสอบว่าใช้ QR code สถานะที่ท่านต้องการหรือไม่!", "error");
        }////if else  outbike     



       
    }
</script>
<script>
    class QRCodeReader {
        constructor (videoElement) {
            this.video = videoElement;
            this.canvas = document.createElement("canvas");
            this.context = this.canvas.getContext("2d");
            this.decoderId;
            this.decodedValue;
        }

        // Start QR Code Reader
        start(onCompleted, stopOnComplete) {
            this.decoderId = null;
            this.decodedValue = null;

            // Start camera
            navigator.mediaDevices.getUserMedia({
                audio: false,
                video: {
                    width: 500,
                    height: 500,
                    frameRate: {
                        max: 10  // 5fps
                    },
                    facingMode : {
                        exact : "environment"
                    }
                }
            }).then((mediaStream) => {
                // Bind media stream with video
                this.video.srcObject = mediaStream;
            });

            // Start reading
            this.decoderId = setInterval(() => {
                this.decodeQRCode();
                if (this.decodedValue || this.decodedValue == 0) {
                    // if (stopOnComplete) {
                    //     this.stop();
                    // }
                    if (this.decodedValue) {
                        this.stop();
                    }
                    onCompleted(this.decodedValue);
                }
            }, 200);  // 5fps -> read every 200ms
        };

        // Stop QR Code Reader
        stop() {
            if (this.video.srcObject) {
                // Stop camera
                this.video.srcObject.getVideoTracks().forEach((track) => {
                    track.stop();
                });
                // Stop QR Code decoder
                clearInterval(this.decoderId);
            }
        };

        decodeQRCode() {
            const width = this.video.videoWidth;
            const height = this.video.videoHeight;
            if (width > 0 && height > 0) {
                // Get snapshot from video
                this.canvas.width = width;
                this.canvas.height = height;
                this.context.clearRect(0, 0, width, height);
                this.context.drawImage(this.video, 0, 0, width, height);
                const imageData = this.context.getImageData(0, 0, width, height);
                // Decode QR Code
                const code = jsQR(imageData.data, imageData.width, imageData.height);
                if (code) {
                    this.decodedValue = code.data;
                }
            }
        }
    }


// QR
const reader = new QRCodeReader(document.querySelector("video"));

// QR
const startReader = (code_book,status_booking) => {
            $('#show_detail').hide();
            $('#decoded_value').show();
    reader.start((value) => {
        // param ส่งค่าไปทำงาน
        var qrcode_sta = value;
            scanCode(code_book,status_booking);
            exit;
        
        
    }, false); 
}

// QR หยุดการทำงาน
const stopReader = () => {
    reader.stop();
}
     
</script>
</body>
</html>
