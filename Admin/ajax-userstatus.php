<?php 

include "include/shi-config.php";

$user_id = $_REQUEST['user_id'];

if($_REQUEST['action'] == 'active') {
	$user_id = $_REQUEST['user_id'];
	

$sql ="UPDATE `user_registration` SET `status` = 'Active' WHERE `user_id` = '$_REQUEST[user_id]' ";



}else if($_REQUEST['action'] == 'inactive') {
	
	$sql ="UPDATE `user_registration` SET `status` = 'InActive' WHERE `user_id` = '$_REQUEST[user_id]' ";
	
}

$query=mysqli_query($con, $sql) or die("ajax-userinfo.php: get employees");


/*$sql ="SELECT * FROM `user_registration` WHERE `user_id` = '$_REQUEST[user_id]' ";

$query=mysqli_query($con, $sql) or die("ajax-userinfo.php: get employees");

$userinfo = mysqli_fetch_array($query);*/



?>