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

    <div class="registration-form">
        <div class="form-div">
        <p> คู่สัญญาทั้งสองฝ่ายตกลงกันทำสัญญากันโดยมีเงื่อนไขและรายละเอียดสำคัญ ดังต่อไปนี้</p>

<p> ข้อ 1. ผู้ให้เช่ตกลงให้เช่า และผู้เช่าตกลงเช่ทรัพย์สิน คือ รถจักรยานโดย Koon Bike
หมายเลข...........</p>

<p> ข้ 2.ผู้เช่าจะต้องแสดงบัตรประชาชนที่ถูกต้อง และบัตรประชาชนจะถูกเก็บโดยผู้ให้เช่าในระหว่าง
ระยะเวลาการเช่า</p>

<p> ข้อ 3. ผู้เช่าจะไม่นำเอาทรัพย์สินที่เช่าไปจำนำ ขายฝาก หรือจำหน่ายโอนด้วยประการใด หรือโดยวิธี
ใด ๆ หรือนำไปเป็นหลักค้ำประกันหรือทำนิติกรรมใด ๆ อันก่อให้เกิดภาระติดพันในทรัพย์สินที่เช่า
เป็นอันขาด</p>

<p> ข้อ 4. ผู้เช่าจะดูแลรักษาหรือสงวนทรัพย์สินที่เซด้วยความระมัดระวัง สมือนเป็นทรัพย์สินของตนเอง
เยี่ยงผู้ประกอบกิจการถืปฏิบัติ จะไม่ยอมปล่อยปละละเลยให้ทรัพย์สินที่เช่ทรุดโทรมไปจากสภาพที่
เป็นอยู่ในขณะที่ทำสัญญนี้ เว้นแต่เป็นการชำรุดทรุดโทรมตามสภาพของการใช้งานตามปกติ</p>

<p> ข้อ 5. ผู้เช่ต้องใช้รถจักรยานเพื่คารท่องเที่ยวเท่นั้น ผู้ช่ตกลงจะไม่นำจักรยานที่เช่าไปใช้ในเชิง
พาณิชย์ หรือไปกระทำความผิด และไม่บรรทุกหรืมีสิ่งของผิดกฎหมายในรถจักรยาน หรือกระทำการ
อื่นใดอันเป็นการฝ้ฝืนกฎหมายแห่งรัฐ หากการกระทำความผิดเกิดขึ้น ผู้เช่าจะเป็นผู้รับผิดชอบแต่
เพียงผู้เดียว</p>

<p> ข้อ 6. ผู้เช่ต้องใช้รถจักรยานเฉพาะในพื้นที่ที่ได้แจ้งไว้กับผู้ให้เช่ตามที่ระบุไว้ในสัญญา หากผู้เช่
ฝ้าฝืนและผู้ให้เช่ไม่สามารถติดต่อผู้เช่ได้ภายใน 2 ชั่วโมง ผู้ให้เช่ามีสิทธิแจ้งให้เจ้าหน้าที่ดำเนิน
การทางกฎหมายกับผู้เช่ได้ทันที่ โดยระยะเวลาการเปิดบริการให้เช่าจะเริ่มรอบเช้า ในเวลา
06.00-1200 น. และรอบบ่ายในเวลา 13.00-19.30 น.</p>

<p> ข้อ 7. อัตรค่าเช่าและการชำระค่าเซ่าคู่สัญญาตกลงคิดอัตราค่าเช่ารถจักรยาน จำนวนเงินคันละ
50 บาท (-ห้สิบบาทถ้วน-) โดยให้บริกรเป็นรอบ ในเวลา 06.00-12.00 น. และรอบบ่ายในเวลา
13.00-19.30 น.</p>

<p> ข้อ 8. ในกรณีที่ผู้เช่ กระทำนอกเหนือข้อตกลง ทำให้ผู้ให้เช่ต้องนำรถจักรยานกลับคืน ผู้เช่ายินดีจะ
รับผิดชอบค่ใช้จยในการนำรถกลับตามที่ผู้ให้เช่าผู้ให้ยืมขอเรียกเก็บ</p>

<p> ข้อ 9. ในกรณีที่รถที่เช่เกิดความเสียหายหรืออุบัติเหตุ ผู้เช่าจะต้องแจ้งให้ผู้ให้เช่ายืมทราบถึงเหตุ
ทันที และ ผู้เช่าตกลงที่จะจ่ายคปรับค่าเสียหายส่วนแร่ก โดยอัตราค่าปรับ/ค่าเสียหายส่วนแรก นั้น
ให้เป็นไปตามแต่เหตุและกรณี</p>

<p> ข้อ 10. การนับเวลในการเช่ารถจักรยาน จะนับจกเวลาที่รับรถจักรยานไปอีก 24 ชั่วโมง จึงนับเป็น
1 วัน ผู้เช่ต้องส่งคืนรถจักรยานตรงเวลาตามที่ตกลง ณ สถานที่ที่ระบุไว้ โดยหากไม่สามารถคืนรถ
จักรยานได้ตมเวลาและ/หรืสถานที่ที่ระบุไว้ ผู้เช่าจะต้องแจ้งให้ผู้ให้เช่าทราบอย่างน้อย 3 ชั่วโมง
ก่อนถึงกำหนดคืนรถ ซึ่งผู้ให้เช่มีสิทธิปฏิเสธการขยายเวลาเช่าดังกล่าวได้โดยมิถือว่าผิดสัญญา โดย
ในกรณีที่ผู้ให้เช่ตกลงที่จะให้มีการขยายเวลาการคืนรถจักรยาน ผู้เช่าตกลงที่จะชำระค่าบริการเพิ่ม
เติม</p>

<p> ข้อ 11. ผู้เช่ยินยอมว่าผู้เช่มีความสามารถในการขับขี่ และเข้าใจถึงกฎจราจร และมีสติสัมปชัญญะ
ครบถ้วนขณะทำการเช่ารถจักรยาน</p>

<p> ข้อ 12. หากผู้เช่มีการละเมิดสัญญาในส่วนใด ส่วนหนึ่ง ผู้ให้เช่าขอสงวนสิทธิ์ที่จะบอกเลิกสัญญานี้ได้
ทันทีโดยไม่ต้องแจ้งให้ทราบล่วงหนและมีสิทธิ์ที่จะเรียกร้องค่ใช้จ่ายในเงินเต็มจำนวน ตามความ
ขัดแย้งของสัญญาใด ๆ นี้และจะถูกดำเนินการตามกฎหมาย </p>
        </div>  
    </div>



</body>
</html>
