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
	
$filenames = "useredit";	
$maindatabase = USER;	
$uploadFoldername = "userphoto";

	
$name = $_REQUEST['name'];
$editid = $_REQUEST['editid'];
$alert = $subid2;

if($alert=="insert"){
$succAlert = "User Created Sucessfully.";
} else if($alert=="updated"){
$succAlert = "Updated Successfully.";
} else if($alert=="emailexist"){

$succAlert = "SORRY! Email ID Already Exist.";
} else { $succAlert = "";}
	
$updateid = $_REQUEST['updateid'];
$upstatus = $_REQUEST['upstatus'];

if($upstatus=="1"){ $upstatus="0";} else { $upstatus="1"; }

if(isset($updateid))
{


$arr=array('status'=>$upstatus);
$updatestatus= update($con,$maindatabase,"`id`='$updateid'",$arr);
	
	if($updatestatus)
	{
				divert(ADMIN_URL.'/'.$filenames.'/updated');
	}
	
}	
	$email = $_POST['email'];



if(isset($name))
{



if($editid!=""){ 

if($_FILES['image_link']['tmp_name'])
{
$name=$_FILES['image_link']['name'];
$name1=get_rand_id(4)."_".$name;

$path="../".$uploadFoldername."/".$name1;

$pathinsert= $uploadFoldername."/".$name1;

move_uploaded_file($_FILES['image_link']['tmp_name'],$path);

$arr=array('image_link'=>$pathinsert);
}



	$ins= update($con,$maindatabase,"`id`='$editid'",$arr);
	
	if($ins){ divert(ADMIN_URL.'/'.$filenames.'?edit='.$editid.'&alert=updated'); }


} else {

$checkemail = select_query($con, $maindatabase, "","`email`='$email'");
if($checkemail['nr']>0)
		{
		
			divert(ADMIN_URL.'/'.$filenames.'/emailexist');	
		
		} else {


if($_FILES['image_link']['tmp_name'])
{
$name=$_FILES['image_link']['name'];
$name1=get_rand_id(4)."_".$name;

$path="../".$uploadFoldername."/".$name1;

$pathinsert= $uploadFoldername."/".$name1;

move_uploaded_file($_FILES['image_link']['tmp_name'],$path);

  	$arr=array('image_link'=>$pathinsert);
}

 // $bearer_image= singlefileupload('image_link',$uploadFoldername);
   

	$ins= insert($con, $maindatabase,"",$arr);
	
	if($ins){
	
	
	                        $userid =$prefix.$ins[id];
							
                            $arr=array('user_id'=>$userid);
							
                            $updatestat= update($con,$maindatabase,"`id`='$ins[id]'",$arr);
	
	
	
		divert(ADMIN_URL.'/'.$filenames.'/insert');
	}
	}
	
	
	}
	
}



$edit = $_REQUEST['edit'];
if($edit){
$title = "Edit";

$checkadmin = select_query($con, $maindatabase, "","`id`='$edit'");

	foreach($checkadmin['result'] as $key=>$value){
	
	}
	} else {
	
$title = "Add";	
	}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Image Network :  Admin Dashboard</title>
	<base href="<?php echo $url; ?>/" >
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
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1> Edit User<span> </span> </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="index.html">Dashboard</a></li>
                                    <li class="active">Edit User</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
				<?php if($succAlert!=""){ ?>
				
				<div class="row">
                    <div class="col-lg-12 p-r-0 title-margin-right">
                      <div class="page-header">
                            <div class="page-title">
                               <h1 style="text-align:center"><?php echo $succAlert; ?><span> </span> </h1>
                            </div>
                        </div>
                               
                          
                      
                    </div>
                    <!-- /# column -->
                    
                    <!-- /# column -->
                </div>
				
				<?php } ?>
                <!-- /# row -->
                <div id="main-content">
                     <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                
                                <div class="card-body">
                                    <div class="horizontal-form-elements">
                                        <form class="form-horizontal" method="post" action="">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <?php
                                                        $result = select_query($con, user_registration, "","`user_id` = '$subid3' ");
                                                        foreach ($result['result'] as $key => $userinfo) {}
                                                    ?>
											<!-- 	<div class="form-group">
                                                        <label class="col-sm-2 control-label">User ID</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value="<?=$userinfo[user_id]?>" name="user_id" disabled="">
                                                        </div>
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Name *</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="name" class="form-control" placeholder="Enter your Name" value="<?=$userinfo[name]?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Email *</label>
                                                        <div class="col-sm-10">
                                                            <input type="email" name="email" class="form-control" placeholder="Enter your Email" value="<?=$userinfo[email]?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Mobile *</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" name="mobile" type="number" placeholder="Enter your Mobile" required value="<?=$userinfo[mobile]?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Location</label>
                                                        <div class="col-sm-10">
                                                           
																<select class="form-control" name="city_id" required>
																<option value="">Select City</option>
																<?php 
																
		$locationlist = select_query($con, LOCATION, "","`id`!='' and `status`='Active' order by `orderwise` ASC");														
																
											if($locationlist['nr'])
		{
		foreach($locationlist['result'] as $key=>$locationv){ 


            ?>
		<option value="<?php echo $locationv['id']; ?>" <?php if($userinfo['city_id']==$locationv['id']){ echo "selected";} else {} ?>><?php echo $locationv['name']; ?></option>
																
																<?php } } ?>
															</select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Membership Type</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control"  Required name="package_id">
															
																<option value="">Select Membership</option>
																<?php 
																
		$packagelist = select_query($con, PACKAGES, "","`id`!='' and `status`='Active' order by `orderwise` ASC");														
																
											if($packagelist['nr'])
		{
		foreach($packagelist['result'] as $key=>$locationv){ ?>
		<option value="<?php echo $locationv['id']; ?>" <?php if($userinfo['package_id']==$locationv['id']){ echo "selected";} else {} ?>><?php echo $locationv['name']; ?></option>
																
																<?php } } ?>
															</select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Amount</label>
                                                        <div class="col-sm-10">
                                                            <select name="payment_type" class="form-control" required>
																<option value="" >Select Payment Type</option>
																	<option <?php if($userinfo['payment_type']=='Paid'){ echo "selected";} else {} ?> value="Paid" >Paid</option>
																			<option <?php if($userinfo['payment_type']=='Pending'){ echo "selected";} else {} ?> value="Pending" >Pending</option>		
															</select>
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <input type="hidden" name="updateid" value="<?=$userinfo[id]?>">
                                                    <button type="submit" class="btn btn-primary">Update User</button>
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
                   <!-- /# row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>Time is <span id="date-time">.</span> Developed by <a href="#" >Sri Hema Infotech</a></p>
                            </div>
                        </div>
                    </div>
                </div>
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