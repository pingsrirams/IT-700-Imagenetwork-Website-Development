<?php 
include 'include/shi-config.php';



if($_REQUEST['action'] == 'delete') {

    mysqli_query($con,"DELETE FROM `packs` where `id` = '$_REQUEST[id]' ")or die(mysqli_error($con));
    
}

if($_REQUEST['action'] == 'active') {

    mysqli_query($con,"UPDATE  `packs` SET `status`  = 'Active' where `id` = '$_REQUEST[id]' ")or die(mysqli_error($con));
    
}

if($_REQUEST['action'] == 'inactive') {

    mysqli_query($con,"UPDATE  `packs` SET `status`  = 'InActive' where `id` = '$_REQUEST[id]' ")or die(mysqli_error($con));
    
}

?>