<?
$url = "https://pimangroup.com/KO-ON_BIKE/api.php?func=get_user_line&line_uid=".$_REQUEST['uid'];
$json_string = file_get_contents($url);
$dataarray = json_decode($json_string);
$user_id=$dataarray[0]->id;////id tb uid

$url_m = "https://pimangroup.com/KO-ON_BIKE/api.php?func=get_check_member&k_id=".$user_id;
$json_string_m = file_get_contents($url_m);
$dataarray_m = json_decode($json_string_m);
$c_member=$dataarray_m[0]->c_member;//////id tb member
$m_id = $dataarray_m[0]->m_id;

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

    <!-- sweetalert -->
    <script src="https://pimangroup.com/KO-ON_BIKE/sweetalert/sweetalert.min.js"></script>
    <!-- sweetalert -->

     <!-- LIFF SDK -->
     <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>

    <title>KO-ON Bike</title>
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

            .registration-form{
                padding: 50px 0;
            }

            .registration-form .form-div{
                background-color: #fff;
                max-width: 600px;
                margin: auto;
                padding: 50px 70px;
                border-top-left-radius: 30px;
                border-top-right-radius: 30px;
                box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
            }

            .registration-form .form-icon{
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

            .registration-form .item{
                border-radius: 20px;
                margin-bottom: 25px;
                padding: 10px 20px;
            }

            .registration-form .create-account{
                border-radius: 30px;
                padding: 10px 20px;
                font-size: 18px;
                font-weight: bold;
                background-color: #edc307;
                border: none;
                color: white;
                margin-top: 20px;
            }

           

            @media (max-width: 576px) {
                .registration-form .form-div{
                    padding: 50px 20px;
                }

                .registration-form .form-icon{
                    width: 70px;
                    height: 70px;
                    font-size: 30px;
                    line-height: 70px;
                }
            }
    </style>
</head>
<body>
<?if($c_member==0){?>
    <div class="registration-form">
        <div class="form-div">
            <div class="form-icon">
                <span><img width="90" height="90" src="https://pimangroup.com/KO-ON_BIKE/img/logo_koonbike.png" class="rounded mx-auto d-block" alt="..."></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="fname" placeholder="First Name/ชื่อ ">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="lname" placeholder="Last Name/นามสกุล">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="tel" class="form-control item" maxlength="10" id="phone_number" placeholder="Phone Number/เบอร์ติดต่อ">
            </div>
            <div class="form-group">
                <input type="tel" class="form-control item" id="birth_date" placeholder="Birth Date/วันเกิด">
                <small id="birth_date" class="form-text text-muted"># วว/ดด/ปปปป พิมพ์ต่อเนื่องไม่ต้องทับ</small>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-block create-account" id="register_member">ลงทะเบียนสมาชิก</button>
            </div>
            <div class="form-group " >
                <div class="custom-control custom-checkbox mr-sm-2" id="checkboxdiv">
                    <input type="checkbox" class="custom-control-input" id="checkboxPDPA"  name="PDPA" onclick="checkbox()" checked="checked">
                    <label class="custom-control-label" for="checkboxPDPA">ฉันยอมรับเงื่อนไขตาม <a href="https://pimangroup.com/privacy-policy/" target="_blank"  style="color:#0B92F5;">นโยบายความเป็นส่วนตัว</a></label>
                </div>
            </div> 
        </div>  
    </div>
<?}else{?>

    <div class="registration-form">
        <div class="form-div">
            <div class="form-icon">
                <span><img width="90" height="90" src="<?=$dataarray_m[0]->pic_line;?>" class="rounded mx-auto d-block" alt="..."></span>
            </div>
            <div class="form-group row">
                <input type="text" class="form-control item"  value="คุณ <?=$dataarray_m[0]->f_name;?> <?=$dataarray_m[0]->l_name;?>" disabled>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item"  value="<?=$dataarray_m[0]->email;?>" disabled placeholder="Email ไม่ระบุ" >
            </div>
            <div class="form-group">
                <input type="tel" class="form-control item" maxlength="10" id="phone_number" placeholder="Phone Number/เบอร์ติดต่อ" value="<?=$dataarray_m[0]->phone_number;?>" disabled>
            </div>
            <div class="form-group">
                <input type="tel" class="form-control item" id="birth_date" placeholder="Birth Date/วันเกิด" value="<?=$dataarray_m[0]->birth_date;?>" disabled>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-block create-account" id="booking_member">กดเพื่อเริ่มจอง</button>
            </div>
            
        </div>  
    </div>

<?}?>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- <script src="assets/js/script.js"></script> -->
    <script>
      function checkbox()
        {
            if (document.getElementById('checkboxPDPA').checked) 
            {
                document.getElementById("register_member").disabled = false;
            } else {
                swal("", "กรุณาอ่านเงื่อนไขนโยบายความเป็นส่วนตัวและกดยอมรับ", "error");
                document.getElementById('register_member').disabled = true;
            }
        }

    $(document).ready(function(){
        $('#birth_date').mask('00/00/0000');
        //$('#phone_number').mask('0000-0000');
    })

    $('#booking_member').click(function(){
        location.replace(" https://liff.line.me/1655537433-PqWp78Xk?m_id=<?echo $m_id;?>");
    });
    
    $('#register_member').click(function(){
        var allvalid=true;

        var fname = $('#fname').val();
            if(fname == ''){
            swal({
                title: "ไม่มีข้อมูลชื่อ",
                text: "กรุณากรอกข้อมูลให้ครบถ้วนสมบูรณ์!",
                icon: "error",
                buttons: "กรอกชื่อ",
            })
            .then((value) => {
                $('#fname').focus();
            });   
            allvalid=false;
        }

        var lname = $('#lname').val();
            if(lname == ''){
            swal({
                title: "ไม่มีข้อมูลนามสกุล",
                text: "กรุณากรอกข้อมูลให้ครบถ้วนสมบูรณ์!",
                icon: "error",
                buttons: "กรอกนามสกุล",
            })
            .then((value) => {
                $('#lname').focus();
            });   
            allvalid=false;
        }

        var phone_number = $('#phone_number').val();
            if(phone_number == ''){
            swal({
                title: "ไม่มีข้อมูลเบอร์ติอต่อ",
                text: "กรุณากรอกข้อมูลให้ครบถ้วนสมบูรณ์!",
                icon: "error",
                buttons: "กรอกเบอร์ติอต่อ",
            })
            .then((value) => {
                $('#phone_number').focus();
            });   
            allvalid=false;
        }

        if(phone_number.length != 10){
            swal({
                title: "เบอร์ไม่ถึง10หลัก",
                text: "กรุณากรอกข้อมูลให้ครบถ้วนสมบูรณ์!",
                icon: "error",
                buttons: "กรอกเบอร์ติดต่อ",
            })
            .then((value) => {
                $('#phone_number').focus();
            });   
            allvalid=false;
        }

        if(allvalid){

            var urls = "https://pimangroup.com/KO-ON_BIKE/exe.php";
            var para = "func=register_member&met=member_register&k_id=<?echo $user_id;?>&f_name="+$('#fname').val()+"&l_name="+$('#lname').val()+"&email="+$('#email').val()+"&phone_number="+$('#phone_number').val();
                para +="&phone_number="+$('#phone_number').val()+"&birth_date="+$('#birth_date').val()+"&PDPA=1";
                        //console.log(para);
                              $.ajax({
                                    type: 'POST',
                                    url: urls,
                                    data: para,
                                    async:false,
                                    success: function(data) {
                                     // console.log(data);
                          
                                    }
                                });/////end ajax

                                swal({
                                        title: " คุณ : "+$('#fname').val()+" "+$('#lname').val()+"",
                                        text: "ขอขอบพระคุณที่สมัครสมาชิกกับทางเรา",
                                        icon: "success",
                                        timer: 2000,
                                        button: false,
                                      })
                                      .then((value) => {
                                        liff.closeWindow();
                                      });
                                        var pam_l='lp=11&msg=register_koon&k_id=<?echo $user_id;?>';
                                            //swal("โปรดรอสักครู่เพื่อ ส่งข้อมูล!" ,{button: false,});
                                            $.ajax({
                                                type: 'POST',
                                                url: 'https://pimangroup.com/KO-ON_BIKE/send_message/send_line.php',
                                                data: pam_l,
                                                //async:false,
                                                datatype:'json',
                                                success: function(data) {  
                                                    
                                                }
                                    });////end ajax
        
        }
    });
    
    </script>
</body>
</html>
