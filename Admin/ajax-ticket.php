<?php 
include 'include/shi-config.php';


if($_REQUEST['action'] == 'getticket') {

	$ticket_str  = "AND `ticket_id`='$_REQUEST[id]'  ";

	$ticket_result = mysqli_query($con,"SELECT * FROM `ticket_user` WHERE 1 $ticket_str ORDER BY `id` ASC ")or die(mysqli_error($con));
	$str = '';
	while($ticket = mysqli_fetch_array($ticket_result)){if($ticket[user_id]!=0){
        $user_result = mysqli_query($con,"SELECT * FROM `user` WHERE  `id` = '$ticket[user_id]'  ")or die(mysqli_error($con));
    $user = mysqli_fetch_array($user_result); 
     $username= $user[name];
}else{
$user_result = mysqli_query($con,"SELECT * FROM `employee` WHERE  `id` = '$ticket[agent_id]'  ")or die(mysqli_error($con));
    $user = mysqli_fetch_array($user_result); 
    $username= $user[e_name];
}

         $str .= ' <li class="left clearfix"><span class="chat-img pull-left">
                       
                                <p><b>'.$username.': </b>
                                    '.$ticket['message'].'
                                </p>
                         
                        </li>';
       
       
	}

	echo $str;

    echo ' <input type="text" class="form-control" name="message" value="">';
     echo ' <input type="hidden"  name="agent_id" value="'.$_SESSION[userfirstname].'">';
     echo ' <input type="hidden"  name="id" value="'.$_REQUEST[id].'">';

}



if($_REQUEST['action'] == 'send') {
	$datetime = date("Y-m-d h:i:s");
	mysqli_query($con,"INSERT INTO `ticket_user` (`id`, `ticket_id`, `user_id`, `agent_id`, `message`, `status`, `date_time`) VALUES (NULL, '$_REQUEST[id]', '0', '$_SESSION[userfirstname]', '$_REQUEST[message]', '1', '$datetime'); ")or die(mysqli_error($con));
	$ticket_str  = "AND `ticket_id`='$_REQUEST[id]'  ";
	$ticket_result = mysqli_query($con,"SELECT * FROM `ticket_user` WHERE 1 $ticket_str  ORDER BY `id` ASC ")or die(mysqli_error($con));

  

	$str = '';
	while($ticket = mysqli_fetch_array($ticket_result)){
if($ticket[user_id]!=0){
        $user_result = mysqli_query($con,"SELECT * FROM `user` WHERE  `id` = '$ticket[user_id]'  ")or die(mysqli_error($con));
    $user = mysqli_fetch_array($user_result); 
     $username= $user[name];
}else{
$user_result = mysqli_query($con,"SELECT * FROM `employee` WHERE  `id` = '$ticket[agent_id]'  ")or die(mysqli_error($con));
    $user = mysqli_fetch_array($user_result); 
    $username= $user[e_name];
}

		 $str .= ' <li class="left clearfix"><span class="chat-img pull-left">
                       
                                <p><b>'.$username.': </b>
                                    '.$ticket['message'].'
                                </p>
                         
                        </li>';
       

	}

        echo $str;
	 echo ' <input type="text" class="form-control" name="message" value="">';
     echo ' <input type="hidden"  name="agent_id" value="'.$_SESSION[userfirstname].'">';
     echo ' <input type="hidden"  name="id" value="'.$_REQUEST[id].'">';


}



if($_REQUEST['action'] == 'delete') {

    mysqli_query($con,"DELETE FROM `ticket_user` where `ticket_id` = '$_REQUEST[id]' ")or die(mysqli_error($con));
    mysqli_query($con,"DELETE FROM `support_ticket` where `id` = '$_REQUEST[id]' ")or die(mysqli_error($con));
}
?>