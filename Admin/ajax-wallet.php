<?php 
include "include/shi-config.php";
include "include/functions.php";


if($_REQUEST['action'] == 'addbalance') {
    $result = select_query($con,user,"","`id`='$_REQUEST[user_id]'");

$date_time = date("Y-m-d h:i:s");

    $sql = "INSERT INTO `wallet_history` (`id`, `amount`, `type`, `tour_id`, `user_id`,`date_time`) VALUES (NULL, '$_REQUEST[amount]', 'prize', '$_REQUEST[tour_id]', '$_REQUEST[user_id]', '$date_time');";
    $status = mysqli_query($con,$sql); 

    if($status == 1 ) {
        foreach ($result['result'] as $key => $user) {}
        $amount = $user['wallet_balance'] + $_REQUEST['amount'];
        $sql = "UPDATE `user` SET `wallet_balance` = '".$amount."' WHERE `id` = '".$_REQUEST['user_id']."'   ";
        $status = mysqli_query($con,$sql);
         echo $status;
    }

 
   


}
if($_REQUEST['action'] == 'getaddbalance') {
    $result = select_query($con,tour_join,"","`user_id`='$_REQUEST[user_id]'");
    $str = null;
    foreach ($result['result'] as $key => $user_tournament) {
        $result2 = select_query($con,tournament,"","`id`='$user_tournament[tour_id]'","","");
        $str = '<option value="">Select</option>';
        foreach ($result2['result'] as $key => $tournament) {
            $str .= '<option value="'.$tournament['id'].'">'.$tournament['name'].'</option>';
        }
    }

    $json['tournament'] = $str;
    echo json_encode($json);
}
?>