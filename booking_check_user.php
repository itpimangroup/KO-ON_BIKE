<?
$code_book = $_REQUEST['code_book'];
$sta_booking = $_REQUEST['sta_booking'];

$url_m = "https://pimangroup.com/KO-ON_BIKE/api.php?func=get_check_booking&code_book=".$code_book;
$json_string_m = file_get_contents($url_m);
$dataarray_m = json_decode($json_string_m);
$m_id=$dataarray_m[0]->m_id;

$unit_bike=$dataarray_m[0]->unit_bike;
if($unit_bike>=9){
    $u_bick = '10';
}else{
    $u_bick = $unit_bike;
}

?>
<?if($sta_booking=='inbike'){?>
<div class="alert alert-warning" role="alert">
    # หมายเหตุ: ลูกค้ากรุณานำหน้าจอนี้แสดงกับพนักงาน ทุกครั้งก่อนรับรถ และแลกบัตร
</div>
<div class="card text-center" style="">
  <img src="https://pimangroup.com/KO-ON_BIKE/img/<?=$u_bick;?>B.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h4 class="card-title"><span class="badge badge-warning">รับรถ <?=$dataarray_m[0]->unit_bike;?> คัน</span></h4>
    <!-- <p class="card-text">รับรถ</p> -->
    <p class="card-text">CODE: <?=$dataarray_m[0]->code_book;?></p>
    <p class="card-text">ผู้จอง: <?=$dataarray_m[0]->f_name;?> <?=$dataarray_m[0]->l_name;?></p>
    <p class="card-text">วันที่จอง: <?=$dataarray_m[0]->date_booking_s;?></p>
    <p class="card-text">จองในช่วงเวลา: <?=$dataarray_m[0]->time_booking_text;?></p>
    <p class="card-text">เวลาลงทะเบียนจอง: <?=$dataarray_m[0]->a_date;?></p>
    <!-- <a type="button"  href="#" id="report_booking" class="btn btn-success btn-lg" ><i class="fas fa-file-contract"></i> รายการจอง</a> -->
  </div>
</div>
<?} else if($sta_booking=='outbike'){?>
<div class="alert alert-warning" role="alert">
    # หมายเหตุ: ลูกค้ากรุณานำหน้าจอนี้แสดงกับพนักงาน ทุกครั้งก่อนคืนรถ เพื่อรับบัตรคืน
</div>
<div class="card text-center" style="">
  <img src="https://pimangroup.com/KO-ON_BIKE/img/<?=$u_bick;?>B.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h4 class="card-title"><span class="badge badge-danger">คืนรถ <?=$dataarray_m[0]->unit_bike;?> คัน</span></h4>
    <!-- <p class="card-text">คืนรถ</p> -->
    <p class="card-text">CODE: <?=$dataarray_m[0]->code_book;?></p>
    <p class="card-text">ผู้จอง: <?=$dataarray_m[0]->f_name;?> <?=$dataarray_m[0]->l_name;?></p>
    <p class="card-text">วันที่จอง: <?=$dataarray_m[0]->date_booking_s;?></p>
    <p class="card-text">จองในช่วงเวลา: <?=$dataarray_m[0]->time_booking_text;?></p>
    <p class="card-text">เวลาลงทะเบียนจอง: <?=$dataarray_m[0]->a_date;?></p>
    <!-- <a type="button"  href="#" id="report_booking" class="btn btn-success btn-lg" ><i class="fas fa-file-contract"></i> รายการจอง</a> -->
  </div>
</div>
<?}else{?>
<div class="alert alert-warning" role="alert">
    # หมายเหตุ: ลูกค้าสามารถนำไปแสดงย้อนหลังได้ เพื่อรับ หรือคืนรถ และแลกบัตร
</div>
<div class="card text-center" style="">
  <img src="https://pimangroup.com/KO-ON_BIKE/img/<?=$u_bick;?>B.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h4 class="card-title"><span class="badge badge-success">จำนวนรถ <?=$dataarray_m[0]->unit_bike;?> คัน</span></h4>
    <!-- <p class="card-text">คืนรถ</p> -->
    <p class="card-text">CODE: <?=$dataarray_m[0]->code_book;?></p>
    <p class="card-text">ผู้จอง: <?=$dataarray_m[0]->f_name;?> <?=$dataarray_m[0]->l_name;?></p>
    <p class="card-text">วันที่จอง: <?=$dataarray_m[0]->date_booking_s;?></p>
    <p class="card-text">จองในช่วงเวลา: <?=$dataarray_m[0]->time_booking_text;?></p>
    <p class="card-text">เวลาลงทะเบียนจอง: <?=$dataarray_m[0]->a_date;?></p>
    <!-- <a type="button"  href="#" id="report_booking" class="btn btn-outline-success btn-lg" ><i class="fas fa-file-contract"></i> รายการจอง</a> -->
  </div>
</div>
<?}?>
<!-- <script>
    $('#report_booking').click(function(){
        $('#show_booking').load("booking_edit.php?m_id=<?echo $m_id;?>");
    });
    
</script> -->