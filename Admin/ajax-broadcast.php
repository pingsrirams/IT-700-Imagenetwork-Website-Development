<?php











include "include/shi-config.php";



// storing  request (ie, get/post) global array to a variable  



$requestData= $_REQUEST;





/*

                                                  



$columns = array( 



// datatable column index  => database column name



	0 =>'name', 



	1 => 'mobile',



	2=> 'email'



);

*/

// getting total number records without any search



$sql = "SELECT *";



$sql.=" FROM `job_apply` JOIN `job_broadcast` ON `job_broadcast`.`id` = `job_apply`.`job_id`";



$query=mysqli_query($con, $sql) or die("ajax-broadcast.php: get job_apply");



$totalData = mysqli_num_rows($query);



$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.











$sql = "SELECT job_broadcast.*,job_apply.id as jobapplyid ,job_apply.user_id as jobapplyuserid,job_apply.status as jobapplystatus";



$sql.=" FROM `job_apply` LEFT JOIN `job_broadcast` ON `job_broadcast`.`id` = `job_apply`.`job_id` WHERE `job_broadcast`.`id`!='' ";



if($requestData['action'] == 'getsearch') {

    $sql.=($requestData['user_id'] != null)?" AND user_id='".$requestData['user_id']."'":"";

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

/*

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter



	$sql.=" AND ( name LIKE '".$requestData['search']['value']."%' ";    



	$sql.=" OR mobile LIKE '".$requestData['search']['value']."%' ";



	$sql.=" OR email LIKE '".$requestData['search']['value']."%' )";	

	



}

*/









$query=mysqli_query($con, $sql) or die("ajax-userinfo.php: get job_apply");



$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 



//$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";



/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	



$query=mysqli_query($con, $sql) or die("ajax-userinfo.php: get job_apply");







$data = array();



$x=$requestData['start']+1;



while( $row=mysqli_fetch_array($query) ) {  // preparing an array



	$nestedData=array(); 



	

	

	

	

	

	//$row["current_location"]; 



	$sql ="SELECT * FROM `user_registration` WHERE `id` = '$row[jobapplyuserid]' ";



    $userquery=mysqli_query($con, $sql) or die("ajax-userinfo.php: get job_apply");



    $userresult1  = mysqli_fetch_array($userquery);



$userid = $userresult1['user_id'];

$username = $userresult1['name'];

$useremail = $userresult1['email'];





	$sql ="SELECT * FROM `hr_register` WHERE `id` = '$row[hr_id]' ";



    $hrinfo=mysqli_query($con, $sql) or die("ajax-userinfo.php: get job_apply");



    $hrinfo1  = mysqli_fetch_array($hrinfo);



/*	



if($row["current_location"]!=""){ 



	 $row["current_location"]; 



	$sql ="SELECT * FROM `cities_current` WHERE `id` = '$row[current_location]' ";



    $userquery=mysqli_query($con, $sql) or die("ajax-userinfo.php: get employees");



    $userresult1  = mysqli_fetch_array($userquery);



    $current_location = $userresult1['name'];







} else {  $current_location = "-";  } 



if($row["exp_type"]!=""){ $exp_type = $row["exp_type"]; } else {  $exp_type = "-";  } 



if($row["edu_degree"]!=""){ $edu_degree = $row["edu_degree"]; } else {  $edu_degree = "-";  } 



if($row["edu_spec"]!=""){ $edu_spec = $row["edu_spec"]; } else {  $edu_spec = "-";  } 



if($row["date_time"]!="0000-00-00 00:00:00"){ $date_time = $row["date_time"]; } else {  $date_time = "-";  } 







if($row["status"]=='Active')

{

$status = '<a href="javacript:void(0);" class="badge badge-success" onClick="return setInActive(`'.$row["user_id"].'`);">Active</a>';

}

else

{



$status = '<a href="javacript:void(0);" class="badge badge-danger" onClick="return setActive(`'.$row["user_id"].'`);">InActive</a>';



}



*/



$onclickss = "onclick=descview('".$row[id]."_desc')";



$description = '<input name="descinfo" id="'.$row["id"].'_desc" type="hidden" value="'.$row["description"].' " /><span class="color-primary sms_pop_up" data-toggle="modal" data-target="#sms_pop_up" '.$onclickss.'>'.substr($row["description"],0,50).' </span>';



$pack_age_type = '<span class="badge badge-pink">Premium</span>';





if($row['jobapplystatus']=="Applied"){

$jobapplystatus = '<span class="badge badge-success">Applied</span>';

} else if($row['jobapplystatus']=="Notnow"){

$jobapplystatus = '<span class="badge badge-pink">Not Now</span>';



}



 $todates = strtotime($row["active_to"]);

 

  $currents = time();

if($currents>$todates){

$status = '<span class="badge badge-danger">EXPIRED</span>';

}

else {



if($row['status']=="Active"){

$status = '<span class="badge badge-info">ACTIVE</span>';

} else if($row['status']=="Pending"){

$status = '<span class="badge badge-pink">PENDING</span>';



} 



}





















    $nestedData[] = $userid;



	$nestedData[] = $username;



	$nestedData[] = $useremail;



	$nestedData[] = $row["job_ref_no"];



    $nestedData[] = $row["title"];



	$nestedData[] = $hrinfo1["company"];



	$nestedData[] =  $description;



	$nestedData[] = date("d M Y", strtotime($row["active_from"]));





	$nestedData[] = date("d M Y", strtotime($row["active_to"]));

	$nestedData[] = $jobapplystatus;

	$nestedData[] = $status;



	$nestedData[] = '<span><a href="useredit/'.$row[id].'"><i class="ti-pencil-alt color-success"></i></a></span>

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



