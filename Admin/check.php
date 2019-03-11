<?php

include "include/shi-config.php";

include "include/functions.php";





session_start();







$e_email = $_REQUEST[e_email];

$e_pass = $_REQUEST[e_pass];

print_r($_REQUEST);





//$checkadmin = select_query($con, EMPLOYEE, "e_email,e_pass,Power,e_id","`e_email`='$e_email' and  `e_pass`='$e_pass' and `Power`='SuperAdmin' and`status`='active'");

$checkadmin = select_query($con, EMPLOYEE, "e_email,e_pass,Power,id","`e_email`='$e_email' and  `e_pass`='$e_pass' and`status`='active'","","");


//print_r($checkadmin['result']);







		if($checkadmin['nr'])

		{

		foreach($checkadmin['result'] as $key=>$value){

		

		

		   $_SESSION['userfirstname'] = $value['id'];
		   
		    $_SESSION['Power'] = $value['Power'];

		divert($url.'dashboard');

		//	header('Location:'.$url.'/dashboard.php');

		

		}

		

		}else

		{ 

			//$msg = "Invalid username or password.";

			 	 header('Location: index.php?err=5');

			

		}









?>





