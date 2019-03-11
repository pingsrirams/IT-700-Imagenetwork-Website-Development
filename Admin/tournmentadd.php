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

if($subid=="tournmentedit"){
$alert = $subid3;
$buttonname = "Add Tournament";


} else {  $alert = $subid2;  $buttonname = "Update Tournament"; }

if($alert=="insert"){
$succAlert = "Tournament Created Sucessfully.";
} else if($alert=="updated"){
$succAlert = "Updated Successfully.";
} else if($alert=="nameexist"){

$succAlert = "SORRY! Email ID Already Exist.";
} else { $succAlert = "";}
	
$updateid = $_REQUEST['updateid'];
$upstatus = $_REQUEST['upstatus'];

if($upstatus=="1"){ $upstatus="0";} else { $upstatus="1"; }

if(isset($updateid))
{
$arr=array('status'=>$upstatus);
// $updatestatus= update($con,$maindatabase,$maindataupdateid,$arr);
	
	if($updatestatus)
	{
				divert(ADMIN_URL.$filenames.'/updated');
	}
	
}	
	$email = $_POST['email'];



if(isset($name))
{



if($editid!=""){ 

if($_FILES['banner_image']['tmp_name'])
{
$name=$_FILES['banner_image']['name'];
$name1=get_rand_id(4)."_".$name;

$path="../".$uploadFoldername."/".$name1;

$pathinsert= $uploadFoldername."/".$name1;

move_uploaded_file($_FILES['banner_image']['tmp_name'],$path);

$arr=array('banner_image'=>$pathinsert);


}

if($_FILES['small_image']['tmp_name'])
{
$name=$_FILES['small_image']['name'];
$name1=get_rand_id(4)."_".$name;

$path="../".$thumbFoldername."/".$name1;

$pathinsert1= $thumbFoldername."/".$name1;

move_uploaded_file($_FILES['small_image']['tmp_name'],$path);



mysqli_query($con,"update `$maindatabase` set `small_image`='$pathinsert1' where `id`='$editid'");

}

$title = $_REQUEST['title'];
$title=preg_replace('/[^a-z0-9]/i',' ', $title);


$title=str_replace(" ","-",$title);
$title=str_replace("---","-",$title);
$title=str_replace("--","-",$title);

$newurltitle = strtolower($title);
$url=$newurltitle;

mysqli_query($con,"update `$maindatabase` set `url`='$url' where `id`='$editid'");


	$ins= update($con,$maindatabase,"`id`='$editid'",$arr);


	
	if($ins){ 
	

	
	divert(ADMIN_URL.'tournmentedit/'.$editid.'/updated'); }


} else {

$checkemail = select_query($con, $maindatabase, "","`email`='$name'");
if($checkemail['nr']>0)
		{
		
			divert(ADMIN_URL.$filenames.'/nameexist');	
		
		} else {


if($_FILES['banner_image']['tmp_name'])
{
$name=$_FILES['banner_image']['name'];
$name1=get_rand_id(4)."_".$name;

$path="../".$uploadFoldername."/".$name1;

$pathinsert= $uploadFoldername."/".$name1;

move_uploaded_file($_FILES['banner_image']['tmp_name'],$path);

  	$arr=array('banner_image'=>$pathinsert);
}




 // $bearer_image= singlefileupload('banner_image',$uploadFoldername);
   

	$ins= insert($con, $maindatabase,"",$arr);
	
	if($ins){
	
	
	if($_FILES['small_image']['tmp_name'])
{
$name=$_FILES['small_image']['name'];
$name1=get_rand_id(4)."_".$name;

$path="../".$thumbFoldername."/".$name1;

$pathinsert1= $thumbFoldername."/".$name1;

move_uploaded_file($_FILES['small_image']['tmp_name'],$path);



mysqli_query($con,"update `$maindatabase` set `small_image`='$pathinsert1' where `id`='$ins[id]'");

}
$title = $_REQUEST['title'];
$title=preg_replace('/[^a-z0-9]/i',' ', $title);


$title=str_replace(" ","-",$title);
$title=str_replace("---","-",$title);
$title=str_replace("--","-",$title);

$newurltitle = strtolower($title);
$url=$newurltitle;

mysqli_query($con,"update `$maindatabase` set `url`='$url' where `id`='$ins[id]'");


	
	                      //  $userid =$prefix.$ins[id];
							
                          //  $arr=array('user_id'=>$userid);
							
                         //   $updatestat= update($con,$maindatabase,"`id`='$ins[id]'",$arr);
	
	
	
		divert(ADMIN_URL.$filenames.'/insert');
	}
	}
	
	
	}
	
}


;
//$edit = $_REQUEST['edit'];


if($subid = "tournmentedit" && $subid2!=""){
//$title = "Edit";

$checkadmin = select_query($con, $maindatabase, "","`id`='$subid2'");

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
                                <h1> <?php echo $title; ?> Tournament<span> </span> </h1>
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
                                                        <label class="col-sm-2 control-label">Tournament Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="name" class="form-control" placeholder="Enter your Name" required value="<?php echo $value['name']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Title</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="title" class="form-control" placeholder="Enter your title" required value="<?php echo $value['title']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Price Type</label>
                                                        <div class="col-sm-10">
                                                        
                                                         <input type="text" name="price_type" class="form-control" placeholder="Enter your title" required value="<?php echo $value['price_type']; ?>">
                                                         
                                                        </div>
                                                    </div>
                                                   <div class="form-group">
                                                        <label class="col-sm-2 control-label">Price Amount</label>
                                                        <div class="col-sm-10">
                                                          <input type="text" name="price_amount" class="form-control" placeholder="Enter Amount" value="<?php echo $value['price_amount']; ?>">
                                                        </div>
                                          </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Platform</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" name="platform" class="form-control" placeholder="Enter Amount" value="<?php echo $value['platform']; ?>">
                                                        
                                                            
                                                        </div>
                                                    </div>
													
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Number Of Player</label>
                                                        <div class="col-sm-10">
                                                             <input type="number" name="no_player"class="form-control" placeholder="Number Of Player" value="<?php echo $value['no_player']; ?>">
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Game Type</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="game_type" required="">
																<option value="">Select Price Game Type</option>
																	<option value="SOLO" <?php if($value['game_type']=="SOLO"){ echo "selected"; } else { }?>>SOLO</option>
																	<option value="DUO" <?php if($value['game_type']=="DUO"){ echo "selected"; } else { }?>>DUO</option>
																	<option value="SQUAD" <?php if($value['game_type']=="SQUAD"){ echo "selected"; } else { }?>>SQUAD</option>
																	<option value="1-MAIN SQUAD" <?php if($value['game_type']=="1-MAIN SQUAD"){ echo "selected"; } else { }?>>1-MAIN SQUAD</option>
																	
															</select>
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Players / Teams</label>
                                                        <div class="col-sm-10">
                                                             <input type="text" name="team_size"class="form-control" placeholder="Enter Team Size" value="<?php echo $value['team_size']; ?>">
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
                                                        <label class="col-sm-2 control-label">Play By</label>
                                                        
                                                        
                                                        <div class="col-sm-10">
                                                          <input type="text" name="player_by"class="form-control" placeholder="Number Of Player" value="<?php echo $value['player_by']; ?>">
                                                        </div>
                                                    </div>
                                                   <div class="form-group">
                                                        <label class="col-sm-2 control-label">Game Small Image ( 222* 272 Pixels )</label>
                                                        <div class="col-sm-8">
                                                             <input type="file" name="small_image"  class="form-control" >
                                                        </div>
                                                        
                                          </div> 
                                                    
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Game Banner Image ( 1920 * 380 Pixels ) </label>
                                                        <div class="col-sm-10">
                                                             <input type="file" name="banner_image"  class="form-control" >
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Match Type</label>
                                                        <div class="col-sm-10">
                                                        
                                                        
                                                        
                                                            <select class="form-control" name="match_type" required="">
																<option value="">Select Play By Option</option>
																	<option <?php if($value['match_type']=="Knock out"){ echo "selected"; } else { }?> value="Knock out">Knock out</option>
																	<option <?php if($value['match_type']=="Normal"){ echo "selected"; } else { }?> value="Normal">Normal</option>
																																	
															</select>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Registration Starts</label>
                                                        <div class="col-sm-10">
                                                             <input type="datetime-local" name="registration_starts" class="form-control"  value="<?php echo date('Y-m-d\TH:i', strtotime($value['registration_starts'])); ?>"  >
                                                        </div>
                                                    </div>
                                                    
                                                    
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Registration Ends</label>
                                                        <div class="col-sm-10">
                                                             <input type="datetime-local" name="registration_ends" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($value['registration_ends'])); ?>">
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Tournament Start</label>
                                                        <div class="col-sm-10">
                                                          <input type="datetime-local" name="tournament_starts" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($value['tournament_starts'])); ?>" >
                                                        </div>
                                                    </div>
                                                    
                                                    
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Rules</label>
                                                        <div class="col-sm-10">
                                                             <textarea class="form-control summernote" name="rules" id="" placeholder="Rules"><?php echo $value['rules']; ?></textarea>
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Overview</label>
                                                        <div class="col-sm-10">
                                                             <textarea class="form-control summernote" name="overview" id="" placeholder="Rules"><?php echo $value['overview']; ?></textarea>
                                                        </div>
                                                    </div>
													
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Schedules</label>
                                                        <div class="col-sm-10">
                                                             <textarea class="form-control summernote" name="schedules" id="" placeholder="Rules"><?php echo $value['schedules']; ?></textarea>
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Prize Distribution</label>
                                                        <div class="col-sm-10">
                                                          <textarea class="form-control summernote" name="prize_distribution" id="" placeholder="Rules"><?php echo $value['prize_distribution']; ?></textarea>
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Series</label>
                                                        <div class="col-sm-10">
                                                          <input type="text" name="series" class="form-control" value="<?php echo $value['series']; ?>">
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Fee Type</label>
                                                        <div class="col-sm-10">
                                                        
                                                    <select class="form-control" name="fee_type" required="">
                                                            <option value="">Select Fee Type</option>
                                                            <option value="Free" <?php if($value['fee_type']=="Free"){ echo "selected"; } else { }?> >Free</option>
                                                            <option value="Paid" <?php if($value['fee_type']=="Paid"){ echo "selected"; } else { }?>>Paid</option>
                                                          </select>  
                                                      
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Entry Amount</label>
                                                        <div class="col-sm-10">
                                                          <input type="text" value="<?php echo $value['entry_amount']; ?>" name="entry_amount" class="form-control">
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Status</label>
                                                        <div class="col-sm-10">
                                                          <select class="form-control" name="status" required="">
																<option value="">Select Status</option>
																	<option value="Active" <?php if($value['status']=="Active"){ echo "selected"; } else { }?>>Active</option>
																	<option value="InActive" <?php if($value['status']=="InActive"){ echo "selected"; } else { }?>>InActive</option>
																	<option value="Expired" <?php if($value['status']=="Expired"){ echo "selected"; } else { }?>>Expired</option>
																																	
															</select>
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Other Info</label>
                                                        <div class="col-sm-10">
                                                             <textarea class="form-control summernote" name="other_info" id="" placeholder="Rules"><?php echo $value['other_info']; ?></textarea>
                                                        </div>
                                                    </div>
													<div class="form-group">
													  <div class="col-sm-offset-2 col-sm-10">
														<button type="submit" class="btn btn-primary"><?php echo $buttonname; ?></button>
														<label for="textfield"></label>
														<input type="hidden" name="editid" id="textfield" value="<?php echo $value['id']; ?>" >
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