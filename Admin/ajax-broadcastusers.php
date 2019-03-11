<?php 
include "../connect_admin/include/shi-config.php";



include "../connect_admin/include/functions.php";

$maindatabase = job_broadcast;

if($_REQUEST['action'] == 'getuserlist') {

$result = select_query($con, $maindatabase, "","`id`='$_REQUEST[bs_id]'");
$str = null;
foreach ($result['result'] as $key => $bulk_sms) {}	
$unser_userlist =  unserialize($bulk_sms['user_id']);

foreach ($unser_userlist as $key => $user_id) {
 	$user_result = select_query($con, user_registration, "","`id`='$user_id'");
 	foreach ($user_result['result'] as $key => $user) {}

 	$location_result = select_query($con, cities_current, "","`id`='$user[current_location]'");
 	foreach ($location_result['result'] as $key => $location) {}

 	$edu_result = select_query($con, user_education, "","`user_id`='$user_id' order by `pass_out_year` desc limit 1" );
 	foreach ($edu_result['result'] as $key => $education) {}

 	

 	$degree_result  = select_query($con, education, "","`id`='$education[edu_degree]' ");
 	foreach ($degree_result['result'] as $key => $degree) {}



 	$spec_result  = select_query($con, specialization, "","`id`='$education[edu_spec]'" );
 	foreach ($spec_result['result'] as $key => $spec) {}

 	$str .= '<tr>
  
    
                <td>'.$user['name'].'</td>
                <td>'.$user['email'].'</td>
                <td>'.$user['mobile'].'</td>
                <td>'.$location['name'].'</td>
                <td class="color-primary">'.$user['exp_type'].'</td>
                <td>'.$degree['name'].'</td>
                <td>'.$spec['name'].'</td>            
		
            </tr>';
} 

echo $str;


}

if($_REQUEST['action'] == 'approvebroadcast') {


	$sql = "UPDATE `job_broadcast` SET `status` = 'Approved' WHERE `id` = '$_REQUEST[ab_id]'";

	mysqli_query($con,$sql) or die(mysqli_error($con));


	$year = date('Y');
	$month = date('m');
	
	/*$access_result =  select_query($con, hr_access, "","`hr_id` = '$hrinfo[id]' and YEAR(`up_month`) = '$year' and MONTH(`up_month`) = '$month' ");
    foreach ($access_result['result'] as $key => $access) {}
    $remaining = $access['broadcast'] - 1;

	 $sql ="UPDATE `hr_access` SET  `broadcast` = '$remaining' WHERE `hr_id` = '$hrinfo[id]' and YEAR(`up_month`) = '$year' and MONTH(`up_month`) = '$month' ";

	if (!mysqli_query($con,$sql)){
		echo("Error description: " . mysqli_error($con));
	}
	*/
	
	
}


if($_REQUEST['action'] == 'disapprovebroadcast') {

	
	$sql = "UPDATE `job_broadcast` SET `status` = 'Rejected' WHERE `id` = '$_REQUEST[db_id]'";

	mysqli_query($con,$sql) or die(mysqli_error($con));

$result = select_query($con, "job_broadcast", "","`id`='$_REQUEST[db_id]'");
	foreach ($result['result'] as $key => $bulk_broad) {}	


	$year = date('Y');
	$month = date('m');
	
	
	
	$access_result =  select_query($con, hr_access, "","`hr_id` = '$bulk_broad[hr_id]' and YEAR(`up_month`) = '$year' and MONTH(`up_month`) = '$month' ");
    foreach ($access_result['result'] as $key => $access) {}
    $remaining = $access['broadcast'] + 1;

	 $sql ="UPDATE `hr_access` SET  `broadcast` = '$remaining' WHERE `hr_id` = '$bulk_broad[hr_id]' and YEAR(`up_month`) = '$year' and MONTH(`up_month`) = '$month' ";

	if (!mysqli_query($con,$sql)){
		echo("Error description: " . mysqli_error($con));
	}

}

if($_REQUEST['action'] == 'bs_viewmessage') {

	$result = select_query($con, bulk_sms, "","`id`='$_REQUEST[bs_id]'");
	foreach ($result['result'] as $key => $bulk_sms) {}

	echo  $bulk_sms['message'];

}

if($_REQUEST['action'] == 'log_viewmessage') {

	$result = select_query($con, sms_log, "","`id`='$_REQUEST[log_id]'");
	foreach ($result['result'] as $key => $sms_log) {}

	echo  $sms_log['message'];

}

?>