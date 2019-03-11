<?php 
include '../../secure_admin/include/shi-config.php';


if($_REQUEST['action'] == 'getticket') {

	$ticket_str  = "AND `ticket_id`='$_REQUEST[id]'  ";

	$ticket_result = mysqli_query($con,"SELECT * FROM `ticket_user` WHERE 1 $ticket_str ORDER BY `id` ASC ")or die(mysqli_error($con));
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
                            <img src="http://placehold.it/50/55C1E7/fff&amp;text=U" alt="User Avatar" class="img-circle">
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">'.$username.'</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                                <p>
                                    '.$ticket['message'].'
                                </p>
                            </div>
                        </li>';
        
	}

	echo $str;
}



if($_REQUEST['action'] == 'send') {
	$datetime = date("Y-m-d h:i:s");
	mysqli_query($con,"INSERT INTO `ticket_user` (`id`, `ticket_id`, `user_id`, `agent_id`, `message`, `status`, `date_time`) VALUES (NULL, '$_REQUEST[id]', '$_SESSION[userid]', '0', '$_REQUEST[message]', '1', '$datetime'); ")or die(mysqli_error($con));
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
                            <img src="http://placehold.it/50/55C1E7/fff&amp;text=U" alt="User Avatar" class="img-circle">
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">'.$username.'</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                                <p>
                                    '.$ticket['message'].'
                                </p>
                            </div>
                        </li>';
      
	}

	echo $str;

}
?>