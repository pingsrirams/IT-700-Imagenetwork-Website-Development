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

$sql.=" FROM `packages` where 1";

$query=mysqli_query($con, $sql) or die(mysqli_error($con));
echo mysqli_error($con);
$totalData = mysqli_num_rows($query);

$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.





$sql = "SELECT `packages`.`id`,`packages`.`validlity`,`packages`.`mode_id`, `packages`.`packs_id`, `packages`.`mode_id`, `packages`.`channels`, `packages`.`amount`, `packages`.`status` ";

$sql.=" FROM `packages`";

if($requestData['action'] == 'getsearch') {

	$sql.=($requestData['mode'] != null)?" JOIN `modes` ON `modes`.`id` = `packages`.`mode_id`":"";
	$sql.=($requestData['pack'] != null)?" JOIN `packs` ON `packs`.`id` = `packages`.`packs_id`":"";



	$sql.="  WHERE 1";

	
	



}else{
	$sql.=" WHERE `packages`.`id`!='' ";
}

if( $requestData['action'] == 'getsearch')  {   // if there is a search parameter, $requestData['search']['value'] contains search parameter


	
	$sql .= ($requestData['mode'] != null)?"AND (`modes`.`name` LIKE '%".$requestData['mode']."%')":"";
	$sql .= ($requestData['pack'] != null)?"OR (`packs`.`name` LIKE '%".$requestData['pack']."%')":"";
	$sql .= ($requestData['validity'] != null)?"AND (`packages`.`validlity` LIKE '%".$requestData['validity']."%')":"";


}



$query=mysqli_query($con, $sql) or die(mysqli_error($con));


$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 

//$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";


$sql.=" ORDER BY `packages`.`id` desc  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";


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




$sqld2 ="SELECT * FROM `packs` WHERE `id` ='$row[packs_id]' ";

$packresult= mysqli_query($con, $sqld2) or die(mysqli_error($con));

$pack = mysqli_fetch_array($packresult);

$sqld2 ="SELECT * FROM `modes` WHERE `id` ='$row[mode_id]' ";

$moderesult= mysqli_query($con, $sqld2) or die(mysqli_error($con));

$mode = mysqli_fetch_array($moderesult);


    /*$nestedData[] = $checkboxhtml;*/

    $nestedData[] = $x;

	$nestedData[] = $pack['name'];

	$nestedData[] = $mode['name'];



	$nestedData[] = '+'.$row['channels'];

	$nestedData[] = '$'.$row['amount'];

	$nestedData[] = $row['validlity'].' Months';

	if($row["status"]=='Active'){

		$status = '<a href="javacript:void(0);" class="badge badge-success" onClick="return setInActive(`'.$row["id"].'`);">Active</a>';
	}

	else{

		$status = '<a href="javacript:void(0);" class="badge badge-danger" onClick="return setActive(`'.$row["id"].'`);">InActive</a>';
	}


	$nestedData[] = $status;

	$nestedData[] = '<span><a href="packageedit/'.$row[id].'"><i class="ti-pencil-alt color-success"></i></a></span><span><a href="javascript:void(0);" onClick="return deletePackage('.$row['id'].');"><i class="ti-trash color-danger"></i> </a></span>';

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

