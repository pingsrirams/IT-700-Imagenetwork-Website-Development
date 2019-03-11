<?php 
include "include/shi-config.php";
include "include/functions.php";


// 
 if(isset($_SESSION['userfirstname']))
	 
	 {
    
	 
	 }
	 
	 
	 else
    {
      divert($url.'/index.php');
   
    }
	
$filenames = "tournmentadd";	
$maindatabase = "tournament";	
$uploadFoldername = "tournmentphoto";
$thumbFoldername = "smallphoto";
	
$name = $_REQUEST['name'];
$editid = $_REQUEST['editid'];
	$withsubmit = $_POST['withsubmit'];


if($subid=="tournmentedit"){
$alert = $subid3;


} else {  $alert = $subid2;  }

if($alert=="insert"){
$succAlert = "Tournament Created Sucessfully.";
} else if($alert=="updated"){
$succAlert = "Updated Successfully.";
} else if($alert=="nameexist"){

$succAlert = "SORRY! Email ID Already Exist.";
} else { $succAlert = "";}
	
$updateid = $_REQUEST['updateid'];
$userid = $_REQUEST['userid'];
	

$checkadmin = select_query($con, "wallet_withdraw", "","`id`='$subid2'");

	foreach($checkadmin['result'] as $key=>$value){	}
	
	$user_id = $value['user_id'];
	
$userinfo = select_query($con, "user", "","`id`='$user_id'");

	foreach($userinfo['result'] as $key=>$uservalue){	}
	
	$wallet_balance = $uservalue['wallet_balance'];	


if(isset($withsubmit))
{



if($editid!=""){ 


//echo $_REQUEST['status'];



if($_REQUEST['status']=="Transferred"){
	
	 $amount = $_REQUEST['amount'];
	
	$netbalance = $wallet_balance - $amount;
	
	//$arr=array('wallet_balance'=>$netbalance);
	
$ins= mysqli_query($con,"update `wallet_withdraw` set `status`='Transferred' where `id`='$editid'");	
$ins1= mysqli_query($con,"update `user` set `wallet_balance`='$netbalance' where `id`='$userid'");	

//echo "sssssssssssssssssssssssssssss"."update `user` set `wallet_balance`='$netbalance' where `id`='$userid'";

//exit;
	
	//$ins= update($con,"user","`id`='$userid'",$arr);
	
} else {

	$ins= update($con,"wallet_withdraw","`id`='$editid'");

}
	
	if($ins){ 
	

	
	divert(ADMIN_URL.'withdrawview/'.$editid.'/updated'); }


} 
	
}


;
//$edit = $_REQUEST['edit'];



	


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Image Network :  Admin Dashboard</title>
	<base href="<?php echo $url; ?>" >
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    
    <!-- Retina iPad Touch Icon-->
   
    <!-- Retina iPhone Touch Icon-->
    
    <!-- Standard iPad Touch Icon-->
    
    <!-- Standard iPhone Touch Icon-->
    
    <!-- Styles -->
    <link href="assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/unix.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
	<!--<link href="assets/css/summernote.css" rel="stylesheet">-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">

	<style>
	.stat-widget-five .stat-heading {padding-left: 2px;}
	
	</style>
</head>

<body>
		<?php include "include/header.php";?>
  
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
            <div class="row">
           <h2> <?php echo $succAlert; ?></h2>
            </div>
            
            
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1> <?php echo $title; ?> Withdraw Request<span> </span> </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="index.html">Dashboard</a></li>
                                    <li class="active"><?php echo $title; ?> Tournament</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                     <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                
                                <div class="card-body">
                                    <div class="horizontal-form-elements">
                                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label"> Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" readonly required value="<?php echo $uservalue['name']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">User id</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" readonly required value="<?php echo $uservalue['userid']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                      <label class="col-sm-2 control-label">Mobile</label>
                                                        <div class="col-sm-10">
                                                          <input type="text" class="form-control" readonly required value="<?php echo $uservalue['mobile']; ?>">
                                                        </div>
                                                    </div>
                                                   <div class="form-group">
                                                     <label class="col-sm-2 control-label">Email</label>
                                                        <div class="col-sm-10">
                                                          <input type="text"  class="form-control" readonly value="<?php echo $uservalue['email']; ?>">
                                                        </div>
                                          </div>
													<div class="form-group">
													  <label class="col-sm-2 control-label">Account Name</label>
                                                        <div class="col-sm-10">
                                                          <input type="text" class="form-control" readonly required value="<?php echo $value['account_name']; ?>">
                                                        </div>
                                                    </div>
													<div class="form-group">
													  <label class="col-sm-2 control-label">Account No.</label>
                                                        <div class="col-sm-10">
                                                             <input type="text" class="form-control" readonly value="<?php echo $value['account_no']; ?>">
                                                        </div>
                                                    </div>
													<div class="form-group">
													  <label class="col-sm-2 control-label">Bank Name</label>
                                                        <div class="col-sm-10">
                                                             <input type="text" class="form-control"  readonly value="<?php echo $value['bank_name']; ?>">
                                                        </div>
                                                    </div>
													<div class="form-group">
													  <label class="col-sm-2 control-label">Branch</label>
                                                        <div class="col-sm-10">
                                                          <input type="text" class="form-control"  readonly value="<?php echo $value['branch']; ?>">
                                                        </div>
                                                    </div>
													<!--<div class="form-group">
                                                        <label class="col-sm-2 control-label">Venue</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="venue" required="">
																<option value="">Select Price Game Type</option>
																	<option value="Online">Online</option>
																	<option value="Offlice">Offlice</option>
																	
																	
															</select>
                                                        </div>
                                                    </div>-->
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">IFSC CODE</label>
                                                        <div class="col-sm-10">
                                                          <input type="text" class="form-control"  readonly value="<?php echo $value['ifsc_code']; ?>">
                                                        </div>
                                                    </div>
                                                    
                                                    
													
												  <div class="form-group">
												    <label class="col-sm-2 control-label">Amount</label>
                                                        <div class="col-sm-10">
                                                          <input type="text" class="form-control"  readonly value="<?php echo $value['amount']; ?>">
                                                       <input type="hidden" class="form-control" name="amount"   value="<?php echo $value['amount']; ?>">
                                                      </div>
                                                    </div>
                                                    
                                                    
                                                    
													
                                                    
                                                    
													
													
                                                    
                                                    
													
													
													
													
													<?php if($value['status']!="Transferred"){?>
													
													<div class="form-group">
													  <label class="col-sm-2 control-label">Status</label>
                                                        <div class="col-sm-10">
                                                          <select class="form-control" name="status" required="">
                                                            <option value="">Select Status</option>
                                                            <option value="pending" <?php if($value['status']=="pending"){ echo "selected";} else { } ?> >Pending</option>
                                                            <option value="Transferred" <?php if($value['status']=="Transferred"){ echo "selected";} else { } ?> >Transferred</option>
                                                            <option value="Cancelled" <?php if($value['status']=="Cancelled"){ echo "selected";} else { } ?> >Cancelled</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    
													<div class="form-group">
													  <label class="col-sm-2 control-label">Available</label>
                                                        <div class="col-sm-10">
                                    <input type="text" value="<?php echo $uservalue['wallet_balance']; ?>" class="form-control">
                                                        </div>
                                                    </div>
													
													
													<div class="form-group">
													  <div class="col-sm-offset-2 col-sm-10">
                                                      
                                                      <?php if($value['wallet_balance']<$value['amount']){ ?>  <?php } else { echo "<h3>Sorry Available is Low</h3>";}?>
														<button type="submit" class="btn btn-primary" name="withsubmit">Update</button>
                                                      
														<label for="textfield"></label>
														<input type="hidden" name="editid" id="textfield" value="<?php echo $value['id']; ?>" >
                                               <input type="hidden" name="userid" id="textfield" value="<?php echo $value['user_id']; ?>" >
                                                    
														</div>
													</div>
                                                </div>
                                                <!-- /# column -->
                                                <!-- /# column -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                        <!-- /# column -->
                    </div>
                <!-- /# row --></div>
            </div>
        </div>
    </div>

   
		<?php include "include/footer.php";?>


    <script src="assets/js/lib/jquery.min.js"></script>
    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>

    <!-- sidebar -->
    <script src="assets/js/lib/bootstrap.min.js"></script>
	<!--<script src="assets/js/summernote.js"></script>-->
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
  $('.summernote').summernote();
});
	</script>
	
    <!-- bootstrap -->
  <!-- 
    <script src="assets/js/scripts.js"></script>
      <script src="assets/js/lib/preloader/pace.min.js"></script>
  
   <script src="assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/lib/weather/weather-init.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="assets/js/lib/circle-progress/circle-progress-init.js"></script>
    <script src="assets/js/lib/chartist/chartist.min.js"></script>
    <script src="assets/js/lib/chartist/chartist-init.js"></script>
    <script src="assets/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="assets/js/lib/sparklinechart/sparkline.init.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
  -->
</body>

</html>