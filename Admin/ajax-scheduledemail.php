<?php





include "include/shi-config.php";

// storing  request (ie, get/post) global array to a variable  

$requestData= $_REQUEST;



                                                  

$columns = array( 

// datatable column index  => database column name

	0 =>'id', 

	1 => 'user_id',

	2 => 'package_id',

	/*3 =>'location', 

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

$sql.=" FROM bulk_email";

$query=mysqli_query($con, $sql) or die(mysqli_error($con));
echo mysqli_error($con);
$totalData = mysqli_num_rows($query);

$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.





$sql = "SELECT * ";

$sql.=" FROM bulk_email WHERE id!='' and `status` = '$requestData[show]' ";

if($requestData['action'] == 'getsearch') {
	/*$sql.=($requestData['name'] != null)?" AND name='".$requestData['name']."'":"";
	$sql.=($requestData['email'] != null)?" AND email='".$requestData['email']."'":"";
	$sql.=($requestData['mobile'] != null)?" AND mobile='".$requestData['mobile']."'":"";
	$sql.=($requestData['hr_id'] != null)?" AND hr_id='".$requestData['hr_id']."'":"";
	$sql.=($requestData['location'] != null)?" AND current_location='".$requestData['location']."'":"";
	$sql.=($requestData['company'] != null)?" AND company='".$requestData['company']."'":"";
	$sql.=($requestData['active_date'] != null)?" AND active_date='".$requestData['active_date']."'":"";*/
	
	/*$sql.=($requestData['from_date'] != null && $requestData['to_date'] != null)?" AND date_time BETWEEN '".$requestData['from_date']."' and  '".$requestData['to_date']."' ":"";*/
	
	$sql.=($requestData['from_date'] != null && $requestData['to_date'] != null)?" AND DATE(date_time) BETWEEN '".date('Y-m-d',strtotime($requestData['from_date']))."' and  '".date('Y-m-d',strtotime($requestData['to_date']))."' ":"";



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

$sql ="SELECT * FROM `hr_register` WHERE `id` ='$row[hr_id]' ";

$hrresult= mysqli_query($con, $sql) or die(mysqli_error($con));

$hrinfo = mysqli_fetch_array($hrresult);



$sql2 ="SELECT * FROM `packages` WHERE `id` ='$row[package_id]' ";

$packageresult= mysqli_query($con, $sql2) or die(mysqli_error($con));

$packageinfo = mysqli_fetch_array($packageresult);

$string = strip_tags($row['message']);
if (strlen($string) > 20) {

    // truncate string
    $stringCut = substr($string, 0, 20);
    $endPoint = strrpos($stringCut, ' ');

    //if the string doesn't contain any space then it will cut without word basis.
    $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
    $string .= '...';
}
$message = $string;


    /*$nestedData[] = $checkboxhtml;*/

    $nestedData[] = $x;

	$nestedData[] =  $hrinfo['name'];

	$nestedData[] =  $hrinfo['company'];

	$nestedData[] = $hrinfo['email'];

	$nestedData[] = $hrinfo['mobile'];

	$nestedData[] =  '<p>Subject:'.$row['subject'].'</p><a class="color-primary sms_pop_up" data-toggle="modal" data-target="#email_pop_up" onClick="return viewMessage('.$row['id'].');">'.$message.'</a>';

	$nestedData[] = '<span class="badge badge-default" data-toggle="modal" data-target="#list_pop_up" onClick="return showUserList('.$row[id].');">View</span>';

	$nestedData[] = date('d-m-y',strtotime($row['date_time']));

	
if($_REQUEST[show]=='Approved' || $_REQUEST[show]=='Rejected')
{
$nestedData[] = '';
}
else
{
	$nestedData[] = '<span class="badge badge-success"><a href="user-edit.html" onclick="return approve('.$row[id].');" title="Approve"><i class="fa fa-check color-default"></i> </a></span> <span class="badge badge-pink"><a  onclick="return disapprove('.$row[id].');" href="" title="Reject"><i class="fa fa-times color-default"></i> </a></span>';
}

	$nestedData[] = '';

	

	//$nestedData[] = '-';

	/*$nestedData[] = $row["mobile"];

    $nestedData[] = "-";

	$nestedData[] = "-";

	$nestedData[] = "-";

	$nestedData[] = '<a href="sms-sent.html" target="_blank"><span class="badge badge-warning">'.$row["sms_limit"].'</a>';

	$nestedData[] = '<a href="sms-sent.html" target="_blank"><span class="badge badge-primary">'.$row["email_limit"].'</a>';

	$nestedData[] = '<a href="sms-sent.html" target="_blank"><span class="badge badge-danger">'.$row["broadcast_limit"].'</a>';


	

	$nestedData[] = '<a href="sms-sent.html" target="_blank"><span class="badge badge-pink">'.$row["resume_limit"].'</a>';

	$nestedData[] = "-";

	$nestedData[] = '<span ><a href="#"><i class="ti-eye color-default"></i></a> </span><span><a href="tournmentedit/'.$row[hr_id].'"><i class="ti-pencil-alt color-success"></i></a></span>
<span><a href=""><i class="ti-trash color-danger"></i> </a></span>';*/

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

