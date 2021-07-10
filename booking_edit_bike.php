<?
$code_book = $_REQUEST['code_book'];

$url_m = "https://pimangroup.com/KO-ON_BIKE/api.php?func=get_check_booking&code_book=".$code_book;
$json_string_m = file_get_contents($url_m);
$dataarray_m = json_decode($json_string_m);

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
                <a type="button"  href="#" id="" class="btn btn-success" ><i class="fas fa-bicycle fa-2x"></i> คงเหลือ <?=$dataarray_b[0]->bike;?> คัน</a>      
                 <!-- <a  href="#" type="button" class="btn btn-info "><i class="fas fa-hard-hat fa-2x"></i> คงเหลือ <?=$dataarray_b[0]->helmet;?> อัน</a> -->
            </div>
            <div class="form-group">
                <input type="date" class="form-control item" id="date_booking" value="">
                <small id="birth_date" class="form-text text-muted"># วว/ดด/ปปปป กำหนดวันจอง (คศ เท่านั้น)</small>
            </div>
            <div class="form-group">
                <!-- <input type="tel" class="form-control item" id="time_booking" placeholder="เวลาจอง"> -->
                <!-- <label for="time_booking">ช่วงเวลาจอง</label> -->
                <select class="form-control item" id="time_booking">
                    <option value="0">เลือกช่วงเวลาจอง</option>
                    <option value="1">ช่วงเช้า 06:00 - 12:00</option>
                    <option value="2">ช่วงบ่าย 13:00 - 19:30</option>
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
                    <?
                    for ($x = 1; $x <= $unit_b; $x++) {
                        echo  '<option value="'.$x.'">'.$x.' คัน</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="tel" class="form-control item" maxlength="10" id="phone_number" value="<?=$dataarray_m[0]->phone_number;?>" placeholder="Phone Number/เบอร์ติดต่อ ">
                <small id="birth_date" class="form-text text-muted">  # เบอร์ติดต่อเพื่อให้พนักงานติดต่อกลับ</small>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-block btn-warning create-account" id="booking_member">แก้ไขจองรถ</button>
            </div>
            
</div>  