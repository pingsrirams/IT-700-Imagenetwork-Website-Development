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
	
$filenames = "hredit";	
$maindatabase = 'hr_register';	
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

$checkadmin = select_query($con, $maindatabase, "","`id`='$editid'");
foreach($checkadmin['result'] as $key=>$value)
{
}



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
	
#resume#sms#email#broadcast	
$this_month = date('m');

$arr_new=array('resume'=>$_REQUEST[resume],'sms'=>$_REQUEST[sms],'email'=>$_REQUEST[email_email],'broadcast'=>$_REQUEST[broadcast]);
$updatestat= update($con,"hr_access","`hr_id`='$editid' and Month(up_month)='$this_month' ",$arr_new);

$dt_date_time = date('Y-m-d h:i:s');

$up_month = date('Y-m').'-01';

#resume
if($_REQUEST[resume1]!='')
{
$arr_acc_his_resume=array('hr_id'=>$editid,'package_name'=>'RESUME','access_count'=>$_REQUEST[resume1],'date_time'=>$dt_date_time,'up_month'=>$up_month);
$ins_acc_his = insert($con, 'hr_access_history',"",$arr_acc_his_resume);
}

#sms	
if($_REQUEST[sms1]!='')
{							
$arr_acc_his_sms=array('hr_id'=>$editid,'package_name'=>'SMS','access_count'=>$_REQUEST[sms1],'date_time'=>$dt_date_time,'up_month'=>$up_month);
$ins_acc_his = insert($con, 'hr_access_history',"",$arr_acc_his_sms);
}

#email	
if($_REQUEST[email1]!='')
{
$arr_acc_his_email=array('hr_id'=>$editid,'package_name'=>'EMAIL','access_count'=>$_REQUEST[email1],'date_time'=>$dt_date_time,'up_month'=>$up_month);
$ins_acc_his = insert($con, 'hr_access_history',"",$arr_acc_his_email);
}

#broadcast	
if($_REQUEST[broadcast1]!='')
{
$arr_acc_his_broadcast=array('hr_id'=>$editid,'package_name'=>'BROADCAST','access_count'=>$_REQUEST[broadcast1],'date_time'=>$dt_date_time,'up_month'=>$up_month);
$ins_acc_his = insert($con, 'hr_access_history',"",$arr_acc_his_broadcast);
}	
?>
<script>
alert('successfully updated');
</script>	
<?php	
if($ins){ divert(ADMIN_URL.'/'.$filenames.'/'.$value[hr_id].''); }


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
    <title>Coonect2CoreHR :  Admin Dashboard</title>
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
                                <h1> Edit HR<span> </span> </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="index.html">Dashboard</a></li>
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
                                
                                <div class="card-body">
                                    <div class="horizontal-form-elements">
                                        <form class="form-horizontal" method="post" action="">
                                            <div class="row">
                                                <div class="col-lg-12">

                                                <?php
                                                $result = select_query($con, hr_register, "","`hr_id` = '$subid3' ");
                                                foreach ($result['result'] as $key => $hrinfo) {}
												
												
												$this_month = date('m');	
													
										$hr_access = select_query($con, "hr_access", "","`hr_id` = '$hrinfo[id]' and Month(up_month)='$this_month' ");
                                                foreach ($hr_access['result'] as $key_hr_access => $value_hr_access) {}
                                                ?>    
												<div class="form-group">
                                                        <label class="col-sm-2 control-label">HR ID</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value="<?=$hrinfo[hr_id]?>" disabled="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">HR Name *</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="name" class="form-control" placeholder="Enter your Name" value="<?=$hrinfo[name]?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Email *</label>
                                                        <div class="col-sm-10">
                                                            <input type="email" name="email" class="form-control" placeholder="Enter your Email" value="<?=$hrinfo[email]?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Mobile *</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" name="mobile" type="number" placeholder="Enter your Mobile" value="<?=$hrinfo[mobile]?>" required>
                                                        </div>
                                                    </div>
                                                   <div class="form-group">
                                                        <label class="col-sm-2 control-label">Company</label>
                                                        <div class="col-sm-10">
                                                             <input type="text" name="company" class="form-control" placeholder="Enter Company Name" value="<?=$hrinfo[company]?>">
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Resume Access Limit (Month)</label>
                                                        <div class="col-sm-4">
														<label>Add New Resume Access Limit</label>
                                                        <input type="number"  id="resume1" name="resume1" class="form-control" onBlur="limit_access(this.value,'resume2','resume3');" onChange="limit_access(this.value,'resume2','resume3');">
                                                        </div>
														
														<div class="col-sm-3">
														<label>Existing Resume Access Balance</label>
                                                 <input type="number" id="resume2" disabled class="form-control" Value="<?=$value_hr_access[resume]?>">
                                                        </div>
														
														<div class="col-sm-3">
														<label>Total</label>
                                                   <input type="number" id="resume3" name="resume" readonly class="form-control" Value="<?=$value_hr_access[resume]?>">
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">SMS Send Limit (Month)</label>
                                                        <div class="col-sm-4">
														<label>Add New SMS Limit</label>
                                                             <input type="number" id="sms1" name="sms1" class="form-control"  onBlur="limit_access(this.value,'sms2','sms3');" onChange="limit_access(this.value,'sms2','sms3');">
                                                        </div>
														<div class="col-sm-3">
														<label>Existing SMS Balance</label>
                                          <input type="number" id="sms2" name="sms2" disabled class="form-control" Value="<?=$value_hr_access[sms]?>">
                                                        </div>
														<div class="col-sm-3">
														<label>Total</label>
                                           <input type="number" id="sms3" name="sms" readonly class="form-control" Value="<?=$value_hr_access[sms]?>">
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Email Send Limit (Month)</label>
                                                        <div class="col-sm-4">
														<label>Add New Email Limit</label>
                                                             <input type="number" id="email1" name="email1" class="form-control" onBlur="limit_access(this.value,'email2','email3');" onChange="limit_access(this.value,'email2','email3');">
                                                        </div>
														<div class="col-sm-3">
														<label>Existing Email Balance</label>
                                            <input type="number" id="email2" disabled class="form-control" Value="<?=$value_hr_access[email]?>">
                                                        </div>
														<div class="col-sm-3">
														<label>Total </label>
                               <input type="number" id="email3" name="email_email" readonly class="form-control" Value="<?=$value_hr_access[email]?>">
                                                        </div>
                                                    </div>
													<div class="form-group">
                                                        <label class="col-sm-2 control-label">Broadcast Send Limit (Month)</label>
                                                        <div class="col-sm-4">
														<label>Add Broadcast SMS Limit</label>
                                                             <input type="number" id="broadcast1" name="broadcast1" class="form-control" onBlur="limit_access(this.value,'broadcast2','broadcast3');" onChange="limit_access(this.value,'broadcast2','broadcast3');">
                                                        </div>
														<div class="col-sm-3">
														<label>Existing Broadcast Balance</label>
                                        <input type="number" id="broadcast2" disabled class="form-control" Value="<?=$value_hr_access[broadcast]?>">
                                                        </div>
														<div class="col-sm-3">
														<label>Total </label>
                        <input type="number" id="broadcast3" name="broadcast" readonly class="form-control" Value="<?=$value_hr_access[broadcast]?>">
                                                        </div>
                                                    </div>
													<div class="form-group">
														<div class="col-sm-offset-2 col-sm-10">
                                                        <input type="hidden" name="editid" value="<?=$hrinfo[id]?>">
														<button type="submit" class="btn btn-primary">Update HR</button>
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
                                <p>Time is <span id="date-time">.</span> Developed by <a href="#!" >Sri Hema Infotech</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script>
function limit_access(str1,str2,str3)
{

if(str1=='')
{
var str1 ='0';
}

var sub_total =  $('#'+str2).val();

var total = parseInt(str1)+parseInt(sub_total);

$('#'+str3).val(total);

}
</script>
   
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