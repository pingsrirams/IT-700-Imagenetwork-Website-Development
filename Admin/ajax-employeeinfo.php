<?php





include "include/shi-config.php";

// storing  request (ie, get/post) global array to a variable  

$requestData= $_REQUEST;



                                                  

$columns = array( 

// datatable column index  => database column name

	0 =>'e_name', 

	1 => 'e_email',

	2 => 'e_ph',

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

$sql = "SELECT * ";

$sql.=" FROM employee";

$query=mysqli_query($con, $sql) or die("ajax-employeeinfo.php: get employees");

$totalData = mysqli_num_rows($query);

$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.





$sql = "SELECT * ";

$sql.=" FROM employee WHERE id!=''";

if($requestData['action'] == 'getsearch') {
	$sql.=($requestData['name'] != null)?" AND e_name='".$requestData['name']."'":"";
	$sql.=($requestData['email'] != null)?" AND e_email='".$requestData['email']."'":"";
	$sql.=($requestData['mobile'] != null)?" AND e_ph='".$requestData['mobile']."'":"";
	$sql.=($requestData['hr_id'] != null)?" AND hr_id='".$requestData['hr_id']."'":"";
	$sql.=($requestData['location'] != null)?" AND current_location='".$requestData['location']."'":"";
	$sql.=($requestData['company'] != null)?" AND e_en='".$requestData['company']."'":"";
	$sql.=($requestData['active_date'] != null)?" AND active_date='".$requestData['active_date']."'":"";



}

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter

	$sql.=" AND ( name LIKE '".$requestData['search']['value']."%' ";    

	$sql.=" OR mobile LIKE '".$requestData['search']['value']."%' ";



	$sql.=" OR email LIKE '".$requestData['search']['value']."%' )";

}



$query=mysqli_query($con, $sql) or die("ajax-employeeinfo.php: get employees");

$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	

$query=mysqli_query($con, $sql) or die("ajax-employeeinfo.php: get employees");



$data = array();

$x=1;

while( $row=mysqli_fetch_array($query) ) {  // preparing an array

	$nestedData=array(); 

	






	

if($row["current_location"]!=""){ 


	
	$sql ="SELECT * FROM `cities_current` WHERE `id` = '$row[current_location]' ";

    $userquery=mysqli_query($con, $sql) or die("ajax-employeeinfo.php: get employees");

    $userresult1  = mysqli_fetch_array($userquery);

    $current_location = $userresult1['name'];


} 




else {  


	$current_location = "-"; 

} 

//if($row["exp_type"]!=""){ $exp_type = $row["exp_type"]; } else {  $exp_type = "-";  } 

//if($row["edu_degree"]!=""){ $edu_degree = $row["edu_degree"]; } else {  $edu_degree = "-";  } 

//if($row["edu_spec"]!=""){ $edu_spec = $row["edu_spec"]; } else {  $edu_spec = "-";  } 

//if($row["date_time"]!="0000-00-00 00:00:00"){ $date_time = $row["date_time"]; } else {  $date_time = "-";  } 

//if($row["status"]!=""){ $status = $row["status"]; } else {  $status = "Pending";  }



$checkboxhtml = '<label><input type="checkbox" value=""></label>';

$pack_age_type = '<span class="badge badge-pink">Premium</span>';

if($row["status"]=='active')
{
$status = '<a href="javacript:void(0);" class="badge badge-success" onClick="return setInActive(`'.$row["id"].'`);">Active</a>';
}
else
{

$status = '<a href="javacript:void(0);" class="badge badge-danger" onClick="return setActive(`'.$row["id"].'`);">InActive</a>';

}



 $nestedData[] = $checkboxhtml;

    //$nestedData[] = $x;
	$nestedData[] = $row["e_en"];

	$nestedData[] = $row["e_name"];

	$nestedData[] = $row["e_ph"];
	
	$nestedData[] = $row["e_email"];
	
    $nestedData[] = $row["e_pass"];
	
	 $nestedData[] = $row["Power"];
	 
	  $nestedData[] = $status;
	  
	  

    //$nestedData[] = $current_location;

	//$nestedData[] = "-";

	//$nestedData[] = "-";

	//$nestedData[] = '<a href="sms-sent.html" target="_blank"><span class="badge badge-warning">'.$row["sms_limit"].'</a>';

	//$nestedData[] = '<a href="sms-sent.html" target="_blank"><span class="badge badge-primary">'.$row["email_limit"].'</a>';

	//$nestedData[] = '<a href="sms-sent.html" target="_blank"><span class="badge badge-danger">'.$row["broadcast_limit"].'</a>';


	

	//$nestedData[] = '<a href="sms-sent.html" target="_blank"><span class="badge badge-pink">'.$row["resume_limit"].'</a>';

	//$nestedData[] = "-";

	//$nestedData[] = '<span ><a href="#"><i class="ti-eye color-default"></i></a> </span><span><a href="tournmentedit/'.$row[hr_id].'"><i class="ti-pencil-alt color-success"></i></a></span><span><a href=""><i class="ti-trash color-danger"></i> </a></span>';


$nestedData[] = '<span ><a href="javascript:void(0);"><i class="ti-eye color-default"></i></a> </span><span><a href="employeeedit/'.$row[id].'"><i class="ti-pencil-alt color-success"></i></a></span>';

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

