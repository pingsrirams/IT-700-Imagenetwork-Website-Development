<?php 
include "include/shi-config.php";
include "include/functions.php";

$maindatabase = bulk_email;

if($_REQUEST['action'] == 'getuserlist') {

$result = select_query($con, $maindatabase, "","`id`='$_REQUEST[be_id]'");
$str = null;
foreach ($result['result'] as $key => $bulk_email) {}	
$unser_userlist =  unserialize($bulk_email['user_id']);

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

if($_REQUEST['action'] == 'approveemail') {


	$result = select_query($con, $maindatabase, "","`id`='$_REQUEST[ae_id]'");
	$str = null;
	$user_numbers = null;
	foreach ($result['result'] as $key => $bulk_email) {}	
	$unser_userlist =  unserialize($bulk_email['user_id']);

	$hr_result = select_query($con, user_registration, "","`id`='$bulk_email[hr_id]'");	
	foreach ($hr_result['result'] as $key => $hr) {}		




		



	foreach ($unser_userlist as $key => $user_id) {

	 	$user_result = select_query($con, user_registration, "","`id`='$user_id'");



	 	//Mail process starts

		 		foreach ($user_result['result'] as $key => $user) {
		 		/*$user_numbers[] = $user['mobile'];*/

		 		$date_time = date('Y-m-d h:i:s');

		 		//Seding sms



				$username = 'connect2';

				$password = 'core@321';

				$senderid = 'CNTCHR';

				$sms_name = $user_value['name'];

				$number   = $user_value['mobile'];

				$priority = 'ndnd';

				$stype    = 'normal';

					$email_message = "Dear User, You‘ve received new Email job alerts on your profile, Login to view and apply direct to HR Email.";

				$sms_data = "user=".$username."&pass=".$password."&sender=".$senderid."&phone=".$user['mobile']."&text=".$email_message."&priority=".$priority."&stype=".$stype;

			


				$ch = curl_init('http://dndsms.cwd.co.in/api/sendmsg.php');



				curl_setopt($ch,CURLOPT_POST,true);

				curl_setopt($ch,CURLOPT_POSTFIELDS,$sms_data);

				curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

				$response = curl_exec($ch);

				curl_close($ch);






		 		$sql = "INSERT INTO `email_log` (`sender_type`, `reason`, `hr_id`, `user_id`, `from_email`,`to_email`, `message`, `status`, `date_time`,`message_id`,`bulk_email_id`) VALUES ('hr', 'search email', '$bulk_email[hr_id]', '$user_id', '$hr[email]', '$user[email]', '$email_message', '1', '$date_time','$response','$bulk_email[id]');";

	 			mysqli_query($con,$sql) or die(mysqli_error($con));

		
		 		

		 	}

	 	//Mail process ends
	 
/*
	 		$sql = "INSERT INTO `email_log` (`id`, `sender_type`, `reason`, `hr_id`, `user_id`, `to_mobile`, `message`, `status`, `date_time`,`message_id`) VALUES (NULL, 'hr', 'search email', '$bulk_email[hr_id]', '$user_id', '$user[mobile]', '$bulk_email[message]', '1', '$date_time','$response');";

	 		mysqli_query($con,$sql) or die(mysqli_error($con));
	 		*/

	 	}



$sql = "UPDATE `bulk_email` SET `status` = 'Approved' WHERE `id` = '$bulk_email[id]'";

	mysqli_query($con,$sql) or die(mysqli_error($con));






	// Account details
/*	$apiKey = urlencode('Z2Fu7nXC6hg-BMkxx9LeSHZ6x310frvCAj60GN0YDv');*/



	
	// Message details
	//$numbers = $user_numbers;

/*	$message = 'Dear User,
Your GST Invoice for subscription has been sent to Your Registered Email, also a copy of the same is available in your user Profile - Subscription Menu';
	$numbers =  $user_numbers;
	$sender = urlencode('COREHR');*/

	
/*	$message = rawurlencode($message);*/

  /*  $message = rawurlencode($bulk_email['message']);*/
 
/*	$numbers = implode(',', $numbers);*/
 
	// Prepare data for POST request
/*	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);*/
 
	// Send the POST request with cURL
/*	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);*/
	
	// Process your response here
	/*echo $response;*/
}


if($_REQUEST['action'] == 'disapproveemail') {


	$result = select_query($con, $maindatabase, "","`id`='$_REQUEST[de_id]'");
	$str = null;
	$user_numbers = null;
	foreach ($result['result'] as $key => $bulk_email) {}	
	$unser_userlist =  unserialize($bulk_email['user_id']);

	$sql = "UPDATE `bulk_email` SET `status` = 'Rejected' WHERE `id` = '$bulk_email[id]'";

	mysqli_query($con,$sql) or die(mysqli_error($con));

	

	$year = date('Y');
	$month = date('m');
	$access_result =  select_query($con, hr_access, "","`hr_id` = '$bulk_email[hr_id]' and YEAR(`up_month`) = '$year' and MONTH(`up_month`) = '$month' ");
    foreach ($access_result['result'] as $key => $access) {}
    $remaining = $access['email'] + $bulk_email['total_email_count'];

	 $sql ="UPDATE `hr_access` SET  `email` = '$remaining' WHERE `hr_id` = '$bulk_email[hr_id]' and YEAR(`up_month`) = '$year' and MONTH(`up_month`) = '$month' ";

	if (!mysqli_query($con,$sql)){
		echo("Error description: " . mysqli_error($con));
	}	




	// Account details
/*	$apiKey = urlencode('Z2Fu7nXC6hg-BMkxx9LeSHZ6x310frvCAj60GN0YDv');*/



	
	// Message details
	//$numbers = $user_numbers;

/*	$message = 'Dear User,
Your GST Invoice for subscription has been sent to Your Registered Email, also a copy of the same is available in your user Profile - Subscription Menu';
	$numbers =  $user_numbers;
	$sender = urlencode('COREHR');*/

	
/*	$message = rawurlencode($message);*/

  /*  $message = rawurlencode($bulk_email['message']);*/
 
/*	$numbers = implode(',', $numbers);*/
 
	// Prepare data for POST request
/*	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);*/
 
	// Send the POST request with cURL
/*	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);*/
	
	// Process your response here
	/*echo $response;*/
}

if($_REQUEST['action'] == 'be_viewmessage') {

	$result = select_query($con, bulk_email, "","`id`='$_REQUEST[be_id]'");
	foreach ($result['result'] as $key => $bulk_email) {}
		echo  '<strong>Subject:</strong> '.$bulk_email['subject'].'<br>';

	echo  '<strong>Description:</strong> '.$bulk_email['message'];

}

if($_REQUEST['action'] == 'log_viewmessage') {

	$result = select_query($con, email_log, "","`id`='$_REQUEST[log_id]'");
	foreach ($result['result'] as $key => $email_log) {}

	echo  $email_log['message'];

}
?>