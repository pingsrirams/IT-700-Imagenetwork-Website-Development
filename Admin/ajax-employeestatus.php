<?php 

include "include/shi-config.php";


if($_REQUEST['action'] == 'active') {
	

$sql ="UPDATE `employee` SET `status` = 'active' WHERE `id` = '$_REQUEST[id]' ";



}else if($_REQUEST['action'] == 'inactive') {
	
	$sql ="UPDATE `employee` SET `status` = 'inactive' WHERE `id` = '$_REQUEST[id]' ";
	
}

$query=mysqli_query($con, $sql) or die("ajax-employeestatus.php: get employees");


/*$sql ="SELECT * FROM `user_registration` WHERE `user_id` = '$_REQUEST[user_id]' ";

$query=mysqli_query($con, $sql) or die("ajax-userinfo.php: get employees");

$userinfo = mysqli_fetch_array($query);*/



?>