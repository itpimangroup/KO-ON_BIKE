<?$code_book = $_REQUEST['code_book'];
  $m_id = $_REQUEST['m_id'];
 //echo $m_id;
$set_date_detail=date("Y-m-d");
$url_m = "https://pimangroup.com/KO-ON_BIKE/api.php?func=get_detail_booking&m_id=".$m_id."&date_set=".$set_date_detail;
$json_string_m = file_get_contents($url_m);
$dataarray_m = json_decode($json_string_m);



$url_b = "https://pimangroup.com/KO-ON_BIKE/api.php?func=get_check_bike";////ตรวจสอบจำนวนรถ
$json_string_b = file_get_contents($url_b);
$dataarray_b = json_decode($json_string_b);
?>

<div class="form-div">
    <div class="text-center mb-2">
        <!-- <a type="button"  href="#" id="booking_bike" class="btn btn-outline-success" ><i class="fas fa-file-contract"></i> booking</a>        -->
        <a  href="https://liff.line.me/1655537433-36WM7zm0" type="button" class="btn btn-outline-info"><i class="fas fa-id-card"></i> Profile</a>
    </div>
    <div class="text-center mb-2">
        <h4><span class="badge badge-pill badge-primary"><i class="fas fa-bicycle fa-2x"></i> คงเหลือ <?=$dataarray_b[0]->bike;?> คัน</span></h4>
    </div>

    

    <div class="form-icon">
        <span><i class="fas fa-clipboard"></i></span>
    </div>

    <div class="alert alert-warning mb-1" role="alert">
      ** ขอสงวนสิทธิการจอง 1 รอบไม่สามารถจองซ้ำได้ ถ้าต้องการจองใหม่ หรือแก้ไขการจอง ให้กดปุ่ม <a href="#" class="alert-link">ยกเลิกการจอง</a> เพื่อเริ่มการจองใหม่เท่านั้น
    </div>
        <!-- <table class="table">
            <thead class="table-warning">
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">#จอง</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>

        <table class="table">
            <thead class="table-primary ">
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">#รับรถ</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
              
            </tbody>
        </table>

        <table class="table">
            <thead class="table-success ">
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">#คืนรถ</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                 
            </tbody>
        </table> -->


<div class="accordion" id="accordionExample">
    <div class="card  ">
        <div class="card-header" id="heading1">
        <h2 class="mb-0">
            <button class="btn btn-primary  btn-block text-white " id="c1" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            ยืนยันจอง/ยกเลิกจอง #1 <i id="icon_1" class="fas fa-arrow-circle-up"></i>
            </button>
        </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="heading1" data-parent="#accordionExample">
            <div class="card-body ">
                <?
                $url_be = "https://pimangroup.com/KO-ON_BIKE/api.php?func=get_detail_booking_b&m_id=".$m_id."&date_set=".$set_date_detail;
                $json_string_be = file_get_contents($url_be);
                $dataarray_be = json_decode($json_string_be);

                for($be=0;$be<count($dataarray_be);$be++){?>
                    <p>ช่วงเวลารับรถ : <?=$dataarray_be[$be]->time_booking_text;?></p>
                    <p>วันที่รับรถ : <?=$dataarray_be[$be]->date_booking_s;?></p>
                    <p>จำนวนรถ : <?=$dataarray_be[$be]->unit_bike;?> คัน</p>
                    <p><a type="button"  href="#" class="btn btn-outline-danger" onclick="booking_del('<?=$dataarray_be[$be]->code_book;?>','<?=$m_id;?>');" ><i class="fas fa-window-close"></i> ยกเลิกการจอง</a> </p>
                <? } ?>           
                    
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="heading2">
        <h2 class="mb-0">
            <button class="btn btn-success  btn-block text-white" id="c1" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            รับ/คืนรถ #2 <i id="icon_2" class="fas fa-arrow-circle-up"></i>
            </button>
        </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="heading2" data-parent="#accordionExample">
        <div class="card-body ">
                    <?for($b=0;$b<count($dataarray_m);$b++){?>
                        
                            <?if($dataarray_m[$b]->status_booking=='B'){?>
                                <p scope="row"><a type="button"  href="#" class="btn btn-outline-warning" onclick="startReader('<?=$dataarray_m[$b]->code_book;?>','B');"  data-toggle="modal" data-target="#sta_camera"><i class="fas fa-qrcode"></i> กด ScanQR รับรถ</a></p>
                                <p>ช่วงเวลารับรถ : <?=$dataarray_m[$b]->time_booking_text;?></p>
                                <p>วันที่รับรถ : <?=$dataarray_m[$b]->date_booking_s;?></p>
                                <p>จำนวนรถ <?=$dataarray_m[$b]->unit_bike;?> คัน</p>
                            <?}?>  
                            <?if($dataarray_m[$b]->status_booking=='I'){?>
                                <p scope="row"><a type="button"  href="#" class="btn btn-outline-primary" onclick="startReader('<?=$dataarray_m[$b]->code_book;?>','I');" data-toggle="modal" data-target="#sta_camera"><i class="fas fa-qrcode"></i>กด ScanQR กดคืน</a></p>
                                <p>ช่วงเวลารับรถ : <?=$dataarray_m[$b]->time_booking_text;?></p>
                                <p>วันที่รับรถ : <?=$dataarray_m[$b]->date_booking_s;?></p>
                                <p>จำนวนรถ <?=$dataarray_m[$b]->unit_bike;?> คัน</p>
                            <?}?>       
                                
                            <?if($dataarray_m[$b]->status_booking=='B'){?>   
                                <p><a type="button"  href="#" class="btn btn-outline-danger" onclick="booking_del('<?=$dataarray_m[$b]->code_book;?>','<?=$m_id;?>');" ><i class="fas fa-window-close"></i> ยกเลิกการจอง</a> </p>
                            <?}?>  
                        
                <? }?>

                
        </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="heading3">
        <h2 class="mb-0">
            <button class="btn btn-warning  btn-block text-white collapsed" id="c2" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
            ประวัติการจองรถวันนี้ # 3 <i id="icon_3" class="fas fa-arrow-circle-down"></i>
            </button>
        </h2>
        </div>
        <div id="collapse3" class="collapse " aria-labelledby="heading3" data-parent="#accordionExample">
        <div class="card-body border-success">

        <?
        $url_o = "https://pimangroup.com/KO-ON_BIKE/api.php?func=get_detail_booking_o&m_id=".$m_id."&date_set=".$set_date_detail;
        $json_string_o = file_get_contents($url_o);
        $dataarray_o = json_decode($json_string_o);

        for($o=0;$o<count($dataarray_o);$o++){?>
         
            <p>ช่วงเวลารับรถ: <?=$dataarray_o[$o]->time_booking_text;?> วันที่รับรถ: <?=$dataarray_o[$b]->date_booking_s;?> จำนวนรถ: <?=$dataarray_o[$o]->unit_bike;?> คัน
             <a type="button"  href="#" class="btn btn-outline-success" onclick="review('<?=$dataarray_o[$o]->code_book;?>');" data-toggle="modal" data-target="#sta_camera"><i class="fas fa-check-circle"></i> ยืนยันคืนรถแล้ว</a></p>
            <p class="border-bottom"></p>
        <? } ?>     
        </div>
        </div>
    </div>
</div>
    
</div>





  <script>

// $('#test').click(function(){
//     $('#sta_camera').modal('hide');
//     //$('#sta_camera').modal('toggle');
// });

$('#booking_bike').click(function(){
    swal({
        title: "ลงจองเพิ่ม",
        text: "กำลังพาท่านไปหน้าลงจองเพิ่ม",
        icon: "success",
        timer: 2000,
        button: false,
        }).then((value) => {
            $('#show_booking').load("booking_bike.php?m_id=<?echo $m_id;?>&status_booking=new_booking");
        });
    });
    

    $('#c1').click(function(){
        // do something...
        $( "#icon_1" ).toggleClass( "fas fa-arrow-circle-down" );
        $( "#icon_2" ).toggleClass( "fas fa-arrow-circle-down" );
        $( "#icon_1" ).toggleClass( "fas fa-arrow-circle-up" );
        $( "#icon_2" ).toggleClass( "fas fa-arrow-circle-up" );
        
    });

   
    $('#c2').click(function(){
        $( "#icon_3" ).toggleClass( "fas fa-arrow-circle-down" );
        $( "#icon_3" ).toggleClass( "fas fa-arrow-circle-up" );
    });


</script>

