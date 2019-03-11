<?php





include "include/shi-config.php";

// storing  request (ie, get/post) global array to a variable  

$requestData= $_REQUEST;



                                                  

$columns = array( 

// datatable column index  => database column name

	0 =>'name', 

	1 => 'mobile',

	2=> 'email'

);

// getting total number records without any search

$sql = "SELECT *";

$sql.=" FROM user_registration";

$query=mysqli_query($con, $sql) or die("ajax-userinfo.php: get employees");

$totalData = mysqli_num_rows($query);

$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.





$sql = "SELECT * ";

$sql.=" FROM user_registration WHERE id!=''";

if($requestData['action'] == 'getsearch') {
	$sql.=($requestData['username'] != null)?" AND name='".$requestData['username']."'":"";
	$sql.=($requestData['email'] != null)?" AND email='".$requestData['email']."'":"";
	$sql.=($requestData['mobile'] != null)?" AND mobile='".$requestData['mobile']."'":"";
	$sql.=($requestData['user_id'] != null)?" AND user_id='".$requestData['user_id']."'":"";
	$sql.=($requestData['location'] != null)?" AND current_location='".$requestData['location']."'":"";
	$sql.=($requestData['exp_type'] != null)?" AND exp_type='".$requestData['exp_type']."'":"";
	$sql.=($requestData['edu_degree'] != null)?" AND edu_degree='".$requestData['edu_degree']."'":"";
	$sql.=($requestData['edu_spec'] != null)?" AND edu_spec='".$requestData['edu_spec']."'":"";
	$sql.=($requestData['subscribe_type'] != null)?" AND subscribe_type='".$requestData['subscribe_type']."'":"";
	//$sql.=($requestData['subscribe_date'] != null)?" AND subscribe_date='".$requestData['subscribe_date']."'":"";
	
	$sql.=($requestData['from_date'] != null && $requestData['to_date'] != null)?" AND package_from BETWEEN '".$requestData['from_date']."' and  '".$requestData['to_date']."' ":"";



}

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter

	$sql.=" AND ( name LIKE '".$requestData['search']['value']."%' ";    

	$sql.=" OR mobile LIKE '".$requestData['search']['value']."%' ";

	$sql.=" OR email LIKE '".$requestData['search']['value']."%' )";	
	

}

if($columns[$requestData['order'][0]['column']]==""){ $vas = "id";} else { $vas = $columns[$requestData['order'][0]['column']]; }



$query=mysqli_query($con, $sql) or die("ajax-userinfo.php: get employees");

$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 

$sql.=" ORDER BY `id`  DESC  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	

$query=mysqli_query($con, $sql) or die("ajax-userinfo.php: get employees");



$data = array();

$x=$requestData['start']+1;

while( $row=mysqli_fetch_array($query) ) {  // preparing an array

	$nestedData=array(); 

	

	

if($row["current_location"]!=""){ 
	/*$sql ="SELECT * FROM `user_registration` WHERE `id` = ''  ";
	$query=mysqli_query($con, $sql) or die("ajax-userinfo.php: get employees");*/
	 $row["current_location"]; 

	$sql ="SELECT * FROM `cities_current` WHERE `id` = '$row[current_location]' ";

    $userquery=mysqli_query($con, $sql) or die("ajax-userinfo.php: get employees");

    $userresult1  = mysqli_fetch_array($userquery);

    $current_location = $userresult1['name'];



} else {  $current_location = "-";  } 

if($row["exp_type"]!=""){ $exp_type = $row["exp_type"]; } else {  $exp_type = "-";  } 

if($row["edu_degree"]!=""){ $edu_degree = $row["edu_degree"];

$sql ="SELECT * FROM `education` WHERE `id` = '$edu_degree' ";

    $eduquery=mysqli_query($con, $sql) or die("ajax-userinfo.php: get employees");

    $eduquery1  = mysqli_fetch_array($eduquery);

    $edu_degree = $eduquery1['name'];

 } else {  $edu_degree = "-";  } 

if($row["edu_spec"]!=""){ $edu_spec = $row["edu_spec"]; 

$sql ="SELECT * FROM `specialization` WHERE `id` = '$edu_spec' ";

    $eduquery=mysqli_query($con, $sql) or die("ajax-userinfo.php: get employees");

    $eduquery1  = mysqli_fetch_array($eduquery);

    $edu_spec = $eduquery1['name'];

} else {  $edu_spec = "-";  } 

if($row["date_time"]!="0000-00-00 00:00:00"){ $date_time = $row["date_time"]; } else {  $date_time = "-";  } 

/*if($row["status"]!=""){ $status = $row["status"]; } else {  $status = "Pending";  }*/


if($row["status"]=='Active')
{
$status = '<a href="javacript:void(0);" class="badge badge-success" onClick="return setInActive(`'.$row["user_id"].'`);">Active</a>';
}
else
{

$status = '<a href="javacript:void(0);" class="badge badge-danger" onClick="return setActive(`'.$row["user_id"].'`);">InActive</a>';

}



$checkboxhtml = '<label><input type="checkbox" value=""></label>';

$pack_age_type = '<span class="badge badge-pink">Premium</span>';



 $nestedData[] = $checkboxhtml;

    $nestedData[] = $x;

    $nestedData[] = $row["user_id"];

	$nestedData[] = $row["name"];

	$nestedData[] = $row["email"];

	$nestedData[] = $row["mobile"];

    $nestedData[] = $current_location;

	$nestedData[] = $exp_type;

	$nestedData[] = $edu_degree;

	$nestedData[] = $edu_spec;


	$nestedData[] = $status;

	$nestedData[] = '<span><a href="useredit/'.$row[user_id].'"><i class="ti-pencil-alt color-success"></i></a></span>
<span><a href=""><i class="ti-trash color-danger"></i> </a></span>';

	$nestedData[] = '';

	

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

