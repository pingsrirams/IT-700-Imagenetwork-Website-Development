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
	
$filenames = "employeeedit";	
$maindatabase = EMPLOYEE;	
$uploadFoldername = "employeephoto";

	
$name = $_REQUEST['e_name'];
$editid = $_REQUEST['editid'];
$alert = $subid2;

if($alert=="insert"){
$succAlert = "Employee Created Sucessfully.";
} else if($alert=="updated"){
$succAlert = "Updated Successfully.";
} else if($alert=="emailexist"){

$succAlert = "SORRY! Email ID Already Exist.";
} else { $succAlert = "";}
	
$updateid = $_REQUEST['updateid'];
$upstatus = $_REQUEST['upstatus'];

/*if($upstatus=="1"){ $upstatus="0";} else { $upstatus="1"; }

if(isset($updateid))
{
$arr=array('status'=>$upstatus);
$updatestatus= update($con,$maindatabase,"`id`='$updateid'",$arr);
	
	if($updatestatus)
	{
				divert(ADMIN_URL.'/'.$filenames.'/updated');
	}
	
}	*/

	$email = $_POST['email'];



if(isset($name))
{



if($updateid!=""){ 

if($_FILES['image_link']['tmp_name'])
{
$name=$_FILES['image_link']['name'];
$name1=get_rand_id(4)."_".$name;

$path="../".$uploadFoldername."/".$name1;

$pathinsert= $uploadFoldername."/".$name1;

move_uploaded_file($_FILES['image_link']['tmp_name'],$path);

$arr=array('image_link'=>$pathinsert);
}



	$ins= update($con,$maindatabase,"`id`='$updateid'",$arr);
	
	if($ins){ divert(ADMIN_URL.'/'.$filenames.'/'.$updateid.'?alert=updated'); }


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
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    
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
                                <h1> Edit Employee<span> </span> </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="<?php $url; ?>dashboard">Dashboard</a></li>
                                    <li class="active">Edit HR</li>
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
							
						
							
							  <?php
							   if(!empty($_REQUEST[alert])) { ?>
                                <div class="alert alert-info">
                                  Updated Successfully
                                </div>
                                <?php } ?>
                                
                                <div class="card-body">
                                    <div class="horizontal-form-elements">
                                        <form class="form-horizontal" method="post">
                                            <div class="row">
                                                <div class="col-lg-12">

                                                <?php
                                                $result = select_query($con, $maindatabase, "","`id` = '$subid3' ");
                                                foreach ($result['result'] as $key => $eminfo) {}
                                                ?>    
												
												<div class="form-group">
                                                        <label class="col-sm-2 control-label">Company</label>
                                                        <div class="col-sm-10">
                                                             <input type="text" class="form-control" name="e_en" placeholder="Enter Company Name" value="<?=$eminfo[e_en]?>">
                                                        </div>
                                                    </div>
												
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Employee Name *</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control"  name="e_name" placeholder="Enter your Name" value="<?=$eminfo[e_name]?>">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Mobile *</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="number" name="e_ph" placeholder="Enter your Mobile" value="<?=$eminfo[e_ph]?>" required>
                                                        </div>
                                                    </div>
													
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Email *</label>
                                                        <div class="col-sm-10">
                                                            <input type="email" class="form-control" name="e_email" placeholder="Enter your Email" value="<?=$eminfo[e_email]?>" required>
                                                        </div>
                                                    </div>
                                                   
												   
												   <div class="form-group">
                                                        <label class="col-sm-2 control-label">Password *</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" class="form-control" name="e_pass" placeholder="Enter your Email" value="<?=$eminfo[e_pass]?>" required>
                                                        </div>
                                                    </div>
													
													
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Employee Role</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="Power" required disabled="disabled">
																<option value="">Select Employee Role</option>
							<option value="SuperAdmin" <?php if($eminfo[Power]=='SuperAdmin'){?> selected="selected" <?php } ?>>SuperAdmin</option>
									<option value="Employee" <?php if($eminfo[Power]=='Employee'){?> selected="selected" <?php } ?>>Employee</option>	
															</select>
                                                        </div>
                                                    </div>
													
													
													<div class="form-group">
														<div class="col-sm-offset-2 col-sm-10">
                                                        <input type="hidden" name="updateid" value="<?=$eminfo[id]?>">
														<button type="submit" class="btn btn-primary">Update Employee</button>
														
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
	
	<!--<script src="assets/js/scripts.js"></script>-->
	
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