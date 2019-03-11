<?php
include "include/shi-config.php";

include "include/functions.php";

$maindatabase = "user_registration";	


if(isset($_REQUEST['q']))
{

//$id_id = bease64_decode($_REQUEST['q']);

$id_id = $_REQUEST['q'];

/*
$user_entry = select_query($con, "user_entry", "","`id`='$id_id'");
if($user_entry['nr']>0)
{

foreach($user_entry['result'] as $entry_key=>$entry_value)
{
}


$user_email = $entry_value['email'];

$user_mobile = $entry_value['mobile'];*/


$check_user = select_query($con, $maindatabase, ""," `id`='$id_id' ","","");

//$sql ="SELECT * FROM `user_registration` WHERE `id`='$id_id' ";

//$query=mysqli_query($con, $sql) or die("ajax-userinfo.php: get employees");
//$userinfo = mysqli_fetch_array($query);*/

//echo $check_user['nr'];

if($check_user['nr']>0)
{

foreach($check_user['result'] as $u_key=>$user_value)
{
}

 $user_id = $user_value['user_id'];

$password = $user_value['password'];

/////////////////////////////////////////////////////////////////// SMS /////////////////////////////////////////////////////////////////

$user = 'connect2';

$pass = 'core@321';

$senderid = 'CNTCHR';

$sms_name = $user_value['name'];

$number = $user_value['mobile'];
//$number ='6380645208,9884557004';

$priority = 'ndnd';

$stype = 'normal';


$message2 = "Dear ".$sms_name.", Your CORE CONNECT Login Details are USER ID - ".$user_id." and PASSWORD - ".$password." - Login www.Image Network.com/userarea";

$sms_data = "user=".$user."&pass=".$pass."&sender=".$senderid."&phone=".$number."&text=".$message2."&priority=".$priority."&stype=".$stype;

$ch = curl_init('http://dndsms.cwd.co.in/api/sendmsg.php');



curl_setopt($ch,CURLOPT_POST,true);

curl_setopt($ch,CURLOPT_POSTFIELDS,$sms_data);

curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

curl_exec($ch);

curl_close($ch);


}


}

?>