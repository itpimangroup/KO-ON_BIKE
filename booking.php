<?$m_id = $_REQUEST['m_id'];
$url_m = "https://pimangroup.com/KO-ON_BIKE/api.php?func=get_profile_member&m_id=".$m_id;
$json_string_m = file_get_contents($url_m);
$dataarray_m = json_decode($json_string_m);
$k_id=$dataarray_m[0]->k_id;

$url_b = "https://pimangroup.com/KO-ON_BIKE/api.php?func=get_check_bike";////ตรวจสอบจำนวนรถ
$json_string_b = file_get_contents($url_b);
$dataarray_b = json_decode($json_string_b);
$unit_b=$dataarray_b[0]->bike;
?>

<div class="form-div">
         
            <div class="form-icon">
                <span><i class="fas fa-clipboard-check"></i></span>
            </div>
            <div class="text-center mb-2">
                 <h4><span class="badge badge-pill badge-primary"><i class="fas fa-bicycle fa-2x"></i> คงเหลือ <?=$dataarray_b[0]->bike;?> คัน</span></h4>
            </div>
            <div class="form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                </div>
                 
                <input type="date" class="form-control " id="date_booking" value="">
                <small id="birth_date" class="form-text text-muted"># วว/ดด/ปปปป กำหนดวันจอง (คศ เท่านั้น)</small>
            </div>
            <div class="form-group">
                <!-- <input type="tel" class="form-control item" id="time_booking" placeholder="เวลาจอง"> -->
                <!-- <label for="time_booking">ช่วงเวลาจอง</label> -->
                <select class="form-control item" id="time_booking">
                    <option value="0">เลือกช่วงเวลาจอง</option>
                    <option value="1">ช่วงเช้า 06:00 - 12:00</option>
                    <option value="2">ช่วงบ่าย 13:00 - 19:30</option>
                    <?
                        // $time_r = date("Hi");
                        // if($time_r <= '1300'){
                        //     echo '
                        //         <option value="1">ช่วงเช้า 06:00 - 12:00</option>
                        //         <option value="2">ช่วงบ่าย 13:00 - 19:30</option>
                        //     ';
                        // }else{
                        //     echo '
                        //         <option value="2">ช่วงบ่าย 13:00 - 19:30</option>
                        //     ';
                        // }
                    ?>
                   
                </select>
            </div>
            <div class="form-group">
                <select class="form-control item" id="unit_bike">
                    <option value="0">เลือกจำนวนคัน</option>
                    <!-- <option value="1">1 คัน</option>
                    <option value="2">2 คัน</option>
                    <option value="3">3 คัน</option>
                    <option value="4">4 คัน</option>
                    <option value="5">5 คัน</option>
                    <option value="6">6 คัน</option>
                    <option value="7">7 คัน</option>
                    <option value="8">8 คัน</option>
                    <option value="9">9 คัน</option>
                    <option value="10">10 คัน</option>
                    <option value="10P">มากกว่า 10 คัน</option> -->
                    <?for ($x = 1; $x <= $unit_b; $x++) {
                        echo  '<option value="'.$x.'">'.$x.' คัน</option>';
                    }?>
                </select>
            </div>
            <div class="form-group">
                <input type="tel" class="form-control item" maxlength="10" id="phone_number" value="<?=$dataarray_m[0]->phone_number;?>" placeholder="Phone Number/เบอร์ติดต่อ ">
                <small id="birth_date" class="form-text text-muted">  # เบอร์ติดต่อเพื่อให้พนักงานติดต่อกลับ</small>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-block btn-outline-warning btn-lg" id="booking_member">ลงจอง</button>
            </div>
            <!-- <div class="form-group " >
                <div class="custom-control custom-checkbox mr-sm-2" id="checkboxdiv">
                    <input type="checkbox" class="custom-control-input" id="checkboxPDPA"  name="PDPA" onclick="checkbox()" checked="checked">
                    <label class="custom-control-label" for="checkboxPDPA">ฉันยอมรับเงื่อนไขตาม <a href="https://pimangroup.com/privacy-policy/" target="_blank"  style="color:#0B92F5;">นโยบายความเป็นส่วนตัว</a></label>
                </div>
            </div>  -->
</div>  

<script>

    $(document).ready(function(){
        // $('#date_booking').mask('00/00/0000');
        //$('#time_booking').mask('00:00');
    });

    $('#booking_member').click(function(){
        var allvalid=true;    

        var date_booking = $('#date_booking').val();
            if(date_booking == ''){
            swal({
                title: "ไม่มีข้อมูลวันจอง",
                text: "กรุณากรอกข้อมูลให้ครบถ้วนสมบูรณ์!",
                icon: "error",
                buttons: "กรอกวันจอง",
            })
            .then((value) => {
                $('#date_booking').focus();
            });   
            allvalid=false;
        }

        var time_booking = $('#time_booking').val();
            if(time_booking == '0'){
            swal({
                title: "เลือกช่วงเวลาจอง",
                text: "กรุณากรอกข้อมูลให้ครบถ้วนสมบูรณ์!",
                icon: "error",
                buttons: "เลือกช่วงเวลาจอง",
            })
            .then((value) => {
                $('#time_booking').focus();
            });   
            allvalid=false;
        }

        var unit_bike = $('#unit_bike').val();
            if(unit_bike == '0'){
            swal({
                title: "เลือกจำนวนคัน",
                text: "กรุณากรอกข้อมูลให้ครบถ้วนสมบูรณ์!",
                icon: "error",
                buttons: "เลือกจำนวนคัน",
            })
            .then((value) => {
                $('#unit_bike').focus();
            });   
            allvalid=false;
        }
        
        var phone_number = $('#phone_number').val();
            if(phone_number.length != 10 || phone_number==''){
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
            var para = "func=booking_member&met=booking_add&m_id=<?echo $m_id;?>&date_booking="+$('#date_booking').val()+"&time_booking="+$('#time_booking').val();
                para +="&unit_bike="+$('#unit_bike').val()+"&phone_number_book="+$('#phone_number').val();
                //console.log(para);


                               $.ajax({
                                    type: 'POST',
                                    url: urls,
                                    data: para,
                                    async:false,
                                    success: function(data) {
                                     // console.log(data);
                                      swal({
                                        title: "ลงทะเบียนจอง",
                                        text: "ตรวจสอบข้อตกลง",
                                        icon: "success",
                                        timer: 2000,
                                        button: false,
                                      })
                                      .then((value) => {
                                        $('#show_booking').load("agreement_booking.php?code_book="+data.code_book+"&k_id=<?echo $k_id;?>");
                                      });
                                    }
                                });/////end ajax

        }
    });

</script>