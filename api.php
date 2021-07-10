<?php
	include 'cf.php';
	//header('Content-Type: application/json');
	//echo $servername;
	$func=$_REQUEST["func"];
	switch ($func) {
        case 'check_user_bike':
			$sql="SELECT COUNT(id) as c_id FROM ko_on_bike WHERE line_uid='".$_REQUEST['line_uid']."' ";
		break;

		case 'get_line_liff':
            $sql="SELECT * FROM line_liff WHERE liff_name='".$_REQUEST['liff_name']."'";
        break;

		case 'get_user_line':
			$sql="SELECT * FROM ko_on_bike WHERE line_uid='".$_REQUEST['line_uid']."'";
		break;	

		case 'get_check_member':
			$sql="SELECT COUNT(koon_member.m_id) as c_member,ko_on_bike.*,koon_member.* FROM koon_member,ko_on_bike WHERE ko_on_bike.id=koon_member.k_id and koon_member.k_id='".$_REQUEST['k_id']."'";
		break;

		// send_messags
			// case 'getline_fn_to_id':
			// 	$sql = "select line_user from line_func where id=".$_REQUEST['fid'];
			// break;
			// case 'getline_fn_to_list':
			// 	$sql = "select line_id from ko_on_bike where id in(".$_REQUEST['lid'].")";
			// break;
			case 'getarrheader':
				$sql = "select ch_token from line_provider where id=" .$_REQUEST['line_pro'];
			break;
			case 'getline_fn_to_id':
				$sql = "select line_uid from ko_on_bike where id=".$_REQUEST['k_id'];
			break;
			case 'get_profile_member':
				$sql="SELECT koon_member.*,COUNT(koon_member.m_id) as c_member FROM koon_member,ko_on_bike WHERE ko_on_bike.id=koon_member.k_id ";
				if($_REQUEST['k_id']){
					$sql.=" and  k_id='".$_REQUEST['k_id']."' ";
				}
				if($_REQUEST['m_id']){
					$sql.=" and  m_id='".$_REQUEST['m_id']."' ";
				}
			break;
			case 'get_id_member':
				$sql="SELECT (ko_on_bike.id) as k_id,koon_member.m_id ,COUNT(koon_member.m_id) as check_register
				FROM koon_member 
				LEFT JOIN  ko_on_bike 
				on ko_on_bike.id=koon_member.k_id WHERE ko_on_bike.line_uid='".$_REQUEST['uid']."'";
			break;
	// end send_messags

	// booking biek	
			case 'get_code_booking':
				$sql="SELECT b_id FROM koon_booking WHERE b_id ORDER BY b_id DESC LIMIT 1";
			break;

			case 'get_detail_booking_b':
				$sql="SELECT koon_booking.*,koon_member.* 
				,CASE koon_booking.time_booking WHEN 1 THEN 'ช่วงเช้า' WHEN 2 THEN 'ช่วงบ่าย' END AS time_booking_text,DATE_FORMAT(koon_booking.date_booking, '%d/%m/%Y') as  date_booking_s
				FROM koon_booking,koon_member WHERE koon_booking.m_id=koon_member.m_id and koon_booking.m_id='".$_REQUEST['m_id']."' and koon_booking.date_booking > '".$_REQUEST['date_set']."' 
				and koon_booking.agreement!='0' and koon_booking.status_booking in ('B') 
				";
				//echo $sql;
			break;
			
			case 'get_detail_booking':
				//$set_date_detail=date("Y-m-d");
				$time_r = date("Hi");
				//echo $time_r;
				if($time_r <= '1300'){
					$set_time='(1,2)';
				}else{
					$set_time='(2)';
				}
				$sql="SELECT koon_booking.*,koon_member.* 
				,CASE koon_booking.time_booking WHEN 1 THEN 'ช่วงเช้า' WHEN 2 THEN 'ช่วงบ่าย' END AS time_booking_text,DATE_FORMAT(koon_booking.date_booking, '%d/%m/%Y') as  date_booking_s
				FROM koon_booking,koon_member WHERE koon_booking.m_id=koon_member.m_id and koon_booking.m_id='".$_REQUEST['m_id']."' and koon_booking.date_booking = '".$_REQUEST['date_set']."' 
				and koon_booking.agreement!='0' and koon_booking.status_booking in ('B','I','O') and koon_booking.time_booking in (1,2)
				";
				//echo $sql; ".$set_time." 
			break;

			case 'get_detail_booking_o':
				$sql="SELECT koon_booking.*,koon_member.* 
				,CASE koon_booking.time_booking WHEN 1 THEN 'ช่วงเช้า' WHEN 2 THEN 'ช่วงบ่าย' END AS time_booking_text,DATE_FORMAT(koon_booking.date_booking, '%d/%m/%Y') as  date_booking_s
				FROM koon_booking,koon_member WHERE koon_booking.m_id=koon_member.m_id and koon_booking.m_id='".$_REQUEST['m_id']."' and koon_booking.date_booking <= '".$_REQUEST['date_set']."' 
				and koon_booking.agreement!='0' and koon_booking.status_booking in ('O') 
				";
				//echo $sql;
			break;
			
			case 'get_check_booking':
				$set_date=date("Y-m-d");
				$sql="SELECT COUNT(koon_booking.b_id) as c_booking,koon_booking.*,koon_member.* 
				,CASE koon_booking.time_booking WHEN 1 THEN 'ช่วงเช้า' WHEN 2 THEN 'ช่วงบ่าย' END AS time_booking_text,DATE_FORMAT(koon_booking.date_booking, '%d/%m/%Y') as  date_booking_s
				FROM koon_booking,koon_member WHERE koon_booking.m_id=koon_member.m_id ";
				if($_REQUEST['m_id']){
					$sql.=" and koon_booking.m_id='".$_REQUEST['m_id']."' and koon_booking.date_booking >= '".$set_date."'";
				}
				if($_REQUEST['code_book']){
					$sql.=" and koon_booking.code_book='".$_REQUEST['code_book']."' ";
				}
				$sql.=" ORDER BY b_id DESC  ";			
			break;	

			case 'get_check_bike':
				$sql="SELECT * FROM koonbike_unit ";
			break;

			case 'get_booking_rec':	
				$set_date=date("Y-m-d");
				$sql="SELECT COUNT(b_id) as c_booking FROM `koon_booking` WHERE m_id='".$_REQUEST['m_id']."' and koon_booking.date_booking >='".$set_date."' and `status_booking` in ('I','B')";
			break;
			
			case 'get_data_booking':
				$sql="SELECT * FROM `koon_booking` WHERE code_book='".$_REQUEST['code_book']."' ";
			break;
	// end booknig

	}

	//echo $sql;
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->exec("SET NAMES \"utf8\"");
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	 //print_r($result);
	$j=json_encode($result);
	//print_r($j);
	$conn=null;
	echo $j;
?>