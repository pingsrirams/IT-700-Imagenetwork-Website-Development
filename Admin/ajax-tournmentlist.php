<?php











include "include/shi-config.php";



// storing  request (ie, get/post) global array to a variable  



$requestData= $_REQUEST;







                                                  



$columns = array( 



// datatable column index  => database column name


/*
	0 =>'name', 



	1 => 'email',



	2 => 'mobile',



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



$sql = "SELECT name, title";



$sql.=" FROM tournament";



$query=mysqli_query($con, $sql) or die("ajax-tournmentlist.php: get employees");



$totalData = mysqli_num_rows($query);



$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.











$sql = "SELECT *";



$sql.=" FROM `tournament` WHERE `id`!=''";



if($requestData['action'] == 'getsearch') {

	$sql.=($requestData['name'] != null)?" AND `name` like '%".$requestData['name']."%'":"";


	$sql.=($requestData['from_date'] != null && $requestData['to_date'] != null)?" AND `tournament_starts` BETWEEN '".$requestData['from_date']."' and  '".$requestData['to_date']."' ":"";


}



if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter



	$sql.=" AND ( name LIKE '".$requestData['search']['value']."%' ";    



}







$query=mysqli_query($con, $sql) or die("ajax-tournmentlist.php: get employees");



$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 



//$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";



/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	



$sql.=" ORDER BY `id` desc  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

//echo $sql;

$query=mysqli_query($con, $sql) or die("ajax-tournmentlist.php: get employees");







$data = array();



$x=1;



while( $row=mysqli_fetch_array($query) ) {  // preparing an array



$nestedData=array(); 

/*

$hr_access = "SELECT * FROM `hr_access` WHERE `hr_id` = '$row[id]' ";

$hr_access1 = mysqli_query($con, $hr_access) or die("ajax-userinfo.php: get employees");

$hr_access2  = mysqli_fetch_array($hr_access1);





$month = date("Y-m");

$smsusecount = "SELECT id FROM `sms_log` WHERE `hr_id` = '$row[id]' and `date_time` LIKE '$month%'  ";

$smsusecount1 = mysqli_query($con, $smsusecount) or die("ajax-userinfo.php: get employees");

$smsusecount2  = mysqli_num_rows($smsusecount1);

	



$emailusecount = "SELECT id FROM `email_log` WHERE `hr_id` = '$row[id]' and `date_time` LIKE '$month%'  ";

$emailusecount1 = mysqli_query($con, $emailusecount) or die("ajax-userinfo.php: get employees");

$emailusecount2  = mysqli_num_rows($emailusecount1);	

	

	

$broadusecount = "SELECT id FROM `job_broadcast` WHERE `hr_id` = '$row[id]' and `active_from` LIKE '$month%'  ";

$broadusecount1 = mysqli_query($con, $broadusecount) or die("ajax-userinfo.php: get employees");

$broadusecount2  = mysqli_num_rows($broadusecount1);	



$resumecount = "SELECT id FROM `viewed_log` WHERE `hr_id` = '$row[id]' ";

$resumecount1 = mysqli_query($con, $resumecount) or die("ajax-userinfo.php: get employees");

$resumecount2  = mysqli_num_rows($resumecount1);	
*/
	

/* 

if($row["current_location"]!=""){ 





	

	$sql ="SELECT * FROM `cities_preferred` WHERE `id` = '$row[current_location]' ";



    $userquery=mysqli_query($con, $sql) or die("ajax-userinfo.php: get employees");



    $userresult1  = mysqli_fetch_array($userquery);



    $current_location = $userresult1['name'];





} 









else {  





	$current_location = "-"; 



} 
*/


/*if($row["exp_type"]!=""){ $exp_type = $row["exp_type"]; } else {  $exp_type = "-";  } 



if($row["edu_degree"]!=""){ $edu_degree = $row["edu_degree"]; } else {  $edu_degree = "-";  } 



if($row["edu_spec"]!=""){ $edu_spec = $row["edu_spec"]; } else {  $edu_spec = "-";  } 



if($row["date_time"]!="0000-00-00 00:00:00"){ $date_time = $row["date_time"]; } else {  $date_time = "-";  } 
*/


if($row["status"]!=""){ $status = $row["status"]; } else {  $status = "Pending";  }







$checkboxhtml = '<label><input type="checkbox" value=""></label>';



$pack_age_type = '<span class="badge badge-pink">Premium</span>';






/*
 $nestedData[] = $checkboxhtml;*/



    $nestedData[] = $x;



	$nestedData[] = $row["name"];



	$nestedData[] = $row["price_type"];

	$nestedData[] = $row["price_amount"];

	$nestedData[] = $row["platform"];



	$nestedData[] = $row["registration_starts"];




	$nestedData[] = $row["tournament_starts"];

/*

	$nestedData[] = '<a href="javascript:void(0);" target="_blank"><span class="badge badge-warning">'.$smsusecount2.'</a>';



	$nestedData[] = '<a href="javascript:void(0);" target="_blank"><span class="badge badge-primary">'.$emailusecount2.'</a>';



	$nestedData[] = '<a href="javascript:void(0);" target="_blank"><span class="badge badge-danger">'.$broadusecount2.'</a>';



	$nestedData[] = '<a href="javascript:void(0);" target="_blank"><span class="badge badge-pink">'.$resumecount2.'</a>';

*/

	$nestedData[] = $status;



	$nestedData[] = '<span ><a href="https://www.imnet.imsriram.com/tournament/'.$row[url].'" target="blank"><i class="ti-eye color-default"></i></a> </span><span>
	<a href="tournmentedit/'.$row[id].'"><i class="ti-pencil-alt color-success"></i></a></span>

<span><a href=""><i class="ti-trash color-danger"></i> </a></span>';







	



	



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



