<?php

// Connect database.

include "include/shi-config.php";

//include "include/functions.php";

session_start(); 

 //if(isset($_SESSION['userfirstname'])) {} else { divert($url.'/index.php'); }

// Get data records from table.


$sql=mysqli_query($con,"select * from `user`");

// Functions for export to excel.

function xlsBOF() {

echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);

return;

}

function xlsEOF() {

echo pack("ss", 0x0A, 0x00);

return;

}

function xlsWriteNumber($Row, $Col, $Value) {

echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);

echo pack("d", $Value);

return;

}

function xlsWriteLabel($Row, $Col, $Value ) {

$L = strlen($Value);

echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);

echo $Value;

return;

}

header("Pragma: public");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("Content-Type: application/force-download");

header("Content-Type: application/octet-stream");

header("Content-Type: application/download");;

header("Content-Disposition: attachment;filename=user_register_list_".time().".xls ");

header("Content-Transfer-Encoding: binary ");



xlsBOF();









xlsWriteLabel(0,0,'SI NO.');

xlsWriteLabel(0,1,'Name');

xlsWriteLabel(0,2,'Email');

xlsWriteLabel(0,3,'Mobile');

xlsWriteLabel(0,4,'City');

xlsWriteLabel(0,5,"Country");

xlsWriteLabel(0,6,"Date & Time");

//xlsWriteLabel(0,7,'Payment Status');







$xlsRow = 1;



// Put data records from mysql by while loop.

$x=1;





 while($row=mysqli_fetch_array($sql))

												 {
													 
											
												 
 //print_r($row);
//exit;	

												 

													 

	

	



if($row["date_time"]!="0000-00-00 00:00:00"){ $date_time = $row["date_time"]; } else {  $date_time = "-";  } 



//if($row["status"]!=""){ $status = $row["status"]; } else {  $status = "Pending";  }







$checkboxhtml = '<label><input type="checkbox" value=""></label>';



$pack_age_type = '<span class="badge badge-pink">Premium</span>';



if($row["payment_type"]=='Credit')

{

$payment_status = 'Paid';

}

else

{

if($row["payment_type"]!='')

{

$payment_status = $row["payment_type"];

}

else

{

$payment_status = 'Pending';

}

}

												 

	

	

/*    $nestedData[] = $x;



	$nestedData[] = $row["name"];



	$nestedData[] = $row["email"];



	$nestedData[] = $row["mobile"];



    $nestedData[] = $current_location;



	$nestedData[] = $exp_type;



	$nestedData[] = $date_time;

	$nestedData[] = $payment_status;*/

	



xlsWriteLabel($xlsRow,0,$x);

xlsWriteLabel($xlsRow,1,$row["name"]);

xlsWriteLabel($xlsRow,2,$row["email"]);

xlsWriteLabel($xlsRow,3,$row["mobile"]);

xlsWriteLabel($xlsRow,4,$row["city"]);

xlsWriteLabel($xlsRow,5,$row["country"]);

xlsWriteLabel($xlsRow,6,$date_time);

//xlsWriteLabel($xlsRow,7,$payment_status);







$xlsRow++;

$x++;



 }













xlsEOF();

exit();



?>