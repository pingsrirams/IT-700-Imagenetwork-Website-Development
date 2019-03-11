<?php





include "include/shi-config.php";

// storing  request (ie, get/post) global array to a variable  

$requestData= $_REQUEST;



                                                  

$columns = array( 

// datatable column index  => database column name

	0 =>'id', 

	/*1 => 'user_id',

	2 => 'package_id',

	3 =>'location', 

	4 => 'company',

	5 => 'sms_limit',

	6 =>'email_limit', 

	7 => 'broadcast_limit',

	8 => 'resume_limit',

	9 => 'status',

	10 => 'sms_limit'*/

);

// getting total number records without any search

$sql = "SELECT *";

$sql.=" FROM `user_package` where 1";

$query=mysqli_query($con, $sql) or die(mysqli_error($con));
echo mysqli_error($con);
$totalData = mysqli_num_rows($query);

$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.





$sql = "SELECT * ";

$sql.=" FROM `support_ticket` WHERE `id`!='' ";

if($requestData['action'] == 'getsearch') {
	/*$sql.=($requestData['name'] != null)?" AND name='".$requestData['name']."'":"";
	$sql.=($requestData['email'] != null)?" AND email='".$requestData['email']."'":"";
	$sql.=($requestData['mobile'] != null)?" AND mobile='".$requestData['mobile']."'":"";
	$sql.=($requestData['hr_id'] != null)?" AND hr_id='".$requestData['hr_id']."'":"";
	$sql.=($requestData['location'] != null)?" AND current_location='".$requestData['location']."'":"";
	$sql.=($requestData['company'] != null)?" AND company='".$requestData['company']."'":"";
	$sql.=($requestData['active_date'] != null)?" AND active_date='".$requestData['active_date']."'":"";*/
	
	/*$sql.=($requestData['from_date'] != null && $requestData['to_date'] != null)?" AND date_time BETWEEN '".$requestData['from_date']."' and  '".$requestData['to_date']."' ":"";*/
	
	$sql.=($requestData['from_date'] != null && $requestData['to_date'] != null)?" AND date_time BETWEEN '".date('Y-m-d',strtotime($requestData['from_date']))."' and  '".date('Y-m-d',strtotime($requestData['to_date']))."' ":"";



}

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter

	$sql.=" AND ( id LIKE '".$requestData['search']['value']."%' ";    

/*	$sql.=" OR mobile LIKE '".$requestData['search']['value']."%' ";



	$sql.=" OR email LIKE '".$requestData['search']['value']."%' )";*/

}



$query=mysqli_query($con, $sql) or die(mysqli_error($con));


$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 

//$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";


$sql.=" ORDER BY `id` desc  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";


/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
//echo $sql;
$query=mysqli_query($con, $sql) or die(mysqli_error($con));
echo mysqli_error($con);


$data = array();

$x=1;

while( $row=mysqli_fetch_array($query) ) {  // preparing an array

	$nestedData=array(); 

	

	
/*
if($row["current_location"]!=""){ $current_location = $row["current_location"]; } else {  $current_location = "-";  } 

if($row["exp_type"]!=""){ $exp_type = $row["exp_type"]; } else {  $exp_type = "-";  } 

if($row["edu_degree"]!=""){ $edu_degree = $row["edu_degree"]; } else {  $edu_degree = "-";  } 

if($row["edu_spec"]!=""){ $edu_spec = $row["edu_spec"]; } else {  $edu_spec = "-";  } 

if($row["date_time"]!="0000-00-00 00:00:00"){ $date_time = $row["date_time"]; } else {  $date_time = "-";  } 

if($row["status"]!=""){ $status = $row["status"]; } else {  $status = "Pending";  }*/



$checkboxhtml = '<label><input type="checkbox" value=""></label>';

$pack_age_type = '<span class="badge badge-pink">Premium</span>';

$sql ="SELECT * FROM `user` WHERE `id` ='$row[user_id]' ";

$userresult= mysqli_query($con, $sql) or die(mysqli_error($con));

$userinfo = mysqli_fetch_array($userresult);

$sqld ="SELECT * FROM `packages` WHERE `id` ='$row[package_id]' ";

$packageresult= mysqli_query($con, $sqld) or die(mysqli_error($con));

$package = mysqli_fetch_array($packageresult);

$sqld2 ="SELECT * FROM `packs` WHERE `id` ='$package[packs_id]' ";

$packresult= mysqli_query($con, $sqld2) or die(mysqli_error($con));

$pack = mysqli_fetch_array($packresult);

$sqld2 ="SELECT * FROM `modes` WHERE `id` ='$package[mode_id]' ";

$moderesult= mysqli_query($con, $sqld2) or die(mysqli_error($con));

$mode = mysqli_fetch_array($moderesult);


    /*$nestedData[] = $checkboxhtml;*/

    $nestedData[] = $x;

	$nestedData[] = $userinfo['name'];

	$nestedData[] = $userinfo['email'];

	$nestedData[] = $userinfo['mobile'];

	$nestedData[] = $userinfo['city'];

	$nestedData[] = $row['order_id'];

	$nestedData[] = $row['subject'];

	$nestedData[] = $row['descp'];




	$nestedData[] = date('d-m-y',strtotime($row['date_time']));

	$nestedData[] = '<span><a data-toggle="modal" data-target="#addwallet_popup"  href="javascript:void(0);" onclick="reply('.$row[id].');"><i class="ti-comment-alt color-success"  ></i></a></span><span><a href="javascript:void(0);"  onclick="deleteTicket('.$row[id].');"><i class="ti-trash color-danger"></i> </a></span>';

	$nestedData[] = "-";

	

	

	$data[] = $nestedData;

	

	$x++;

}







                                             







$json_data = array(

			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 

			"recordsTotal"    => intval( $totalData ),  // total number of records

			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData

			"data"            => $data   // total data array

			);



echo json_encode($json_data);  // send data as json format



?>

