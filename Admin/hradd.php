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

	

$filenames = "hradd";	

$maindatabase = HR;	

$uploadFoldername = "userphoto";



	

$name = $_REQUEST['name'];

$editid = $_REQUEST['editid'];

$alert = $subid3;



if($alert=="insert"){

$succAlert = "<strong>HR</strong> Created Sucessfully.";

} else if($alert=="updated"){

$succAlert = "Updated Successfully.";

} else if($alert=="emailexist"){



echo $succAlert = "<strong>SORRY!</strong> Email ID Already Exist.";

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

   $arr=array('date_time'=>date('Y-m-d h:i:s'));



	$ins= insert($con, $maindatabase,"",$arr);

	

	if($ins){

	

	

	                        $hr_id = $prefix.$ins[id];

							

							$company = str_replace(" ","",$_REQUEST[company]);

							$company = trim($company);

							

							$cc = substr($company,0,3);

							

							$cc = strtoupper($cc);

							

							$hr_id = 'C2H'.$cc.rand('1001',9999);

							

							$password = get_rand_id('8');

							

                            $arr=array('hr_id'=>$hr_id,'password'=>$password);

							

                            $updatestat= update($con,$maindatabase,"`id`='$ins[id]'",$arr);

							

							

							$package_id = $_REQUEST[package_id];

							

							$hr_package = select_query($con, "hr_package", "","`id`='$package_id'","","");

		if($hr_package['nr'])

		{

		$y='1';

		foreach($hr_package['result'] as $hr_key=>$hr_value)

		{

		}

		}

		

		$resume_acc = $hr_value['resume'];

		$sms_acc = $hr_value['sms'];

		$email_acc = $hr_value['email'];

		$broadcast_acc = $hr_value['broadcast'];

		

		$dt_date_time = date('Y-m-d h:i:s');

		

		$up_month  = date('Y-m');

		

		$up_month = $up_month.'-01';

							



$arr_acc=array('hr_id'=>$ins[id],'package_id'=>$package_id,'resume'=>$resume_acc,'sms'=>$sms_acc,'email'=>$email_acc,'broadcast'=>$broadcast_acc,'date_time'=>$dt_date_time,'up_month'=>$up_month);

							

							$ins_acc = insert($con, 'hr_access',"",$arr_acc);

							

							

							

$arr_acc_his_resume=array('hr_id'=>$ins[id],'package_id'=>$package_id,'package_name'=>'RESUME','access_count'=>$resume_acc,'date_time'=>$dt_date_time,'up_month'=>$up_month);

							$ins_acc_his = insert($con, 'hr_access_history',"",$arr_acc_his_resume);

							

							

							$arr_acc_his_sms=array('hr_id'=>$ins[id],'package_id'=>$package_id,'package_name'=>'SMS','access_count'=>$sms_acc,'date_time'=>$dt_date_time,'up_month'=>$up_month);

							$ins_acc_his = insert($con, 'hr_access_history',"",$arr_acc_his_sms);







$arr_acc_his_email=array('hr_id'=>$ins[id],'package_id'=>$package_id,'package_name'=>'EMAIL','access_count'=>$email_acc,'date_time'=>$dt_date_time,'up_month'=>$up_month);

							$ins_acc_his = insert($con, 'hr_access_history',"",$arr_acc_his_email);







$arr_acc_his_broadcast=array('hr_id'=>$ins[id],'package_id'=>$package_id,'package_name'=>'BROADCAST','access_count'=>$broadcast_acc,'date_time'=>$dt_date_time,'up_month'=>$up_month);

							$ins_acc_his = insert($con, 'hr_access_history',"",$arr_acc_his_broadcast);

	

	

	

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

                                <h1> Add HR<span> </span> </h1>

                            </div>

                        </div>

                    </div>

                    <!-- /# column -->

                    <div class="col-lg-4 p-l-0 title-margin-left">

                        <div class="page-header">

                            <div class="page-title">

                                <ol class="breadcrumb text-right">

                                    <li><a href="javascript:void(0);">Dashboard</a></li>

                                    <li class="active">Add HR</li>

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

                                <?php if(!empty($succAlert)) { ?>

                                <div class="alert alert-info">

                                   <?=$succAlert?>

                                </div>

                                <?php } ?>

                                <div class="card-body">

                                    <div class="horizontal-form-elements">

                                        <form class="form-horizontal" method="post">

                                            <div class="row">

                                                <div class="col-lg-12">

                                                    <div class="form-group">

                                                        <label class="col-sm-2 control-label">HR Name *</label>

                                                        <div class="col-sm-10">

                                                  <input type="text" class="form-control" name="name" placeholder="Enter your Name" required>

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="col-sm-2 control-label">Email *</label>

                                                        <div class="col-sm-10">

                                             <input type="email"  name="email"  class="form-control" placeholder="Enter your Email" required>

                                                        </div>

                                                    </div>

													

                                                    <div class="form-group">

                                                        <label class="col-sm-2 control-label">Mobile *</label>

                                                        <div class="col-sm-10">

                                            <input class="form-control" name="mobile"  type="number" placeholder="Enter your Mobile" required>

                                                        </div>

                                                    </div>

													

													<div class="form-group">

                                                        <label class="col-sm-2 control-label">Land Line No</label>

                                                        <div class="col-sm-10">

                                             <input class="form-control" name="land_line"  type="text" placeholder="Enter your Comapny Land Line No" >

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="col-sm-2 control-label">Company*</label>

                                                        <div class="col-sm-10">

                                            <input type="text" name="company"  class="form-control" placeholder="Enter Company Name" required>

                                                        </div>

                                                    </div>

													

                                                    <div class="form-group">

                                                        <label class="col-sm-2 control-label">Industry Type</label>

                                                        <div class="col-sm-10">

                              <select class="form-control" name="indus_id" required="" onChange="return sel_val(this.value);">

														  

                                                                 <?php 

                                $packagelist = select_query($con, "industry", "","`id`!='' and `status`='Active' order by `orderwise` ASC");                                                        

                                                                if($packagelist['nr'])

                                                                {



                                                                foreach($packagelist['result'] as $key=>$locationv)

																{ 

                                                                    //if($locationv['name']=='Others') {



                                                                   // }else{



                                                                    ?>



                                                                <option value="<?php echo $locationv['id']; ?>" <?php if($value['package_id']==$locationv['id']){ echo "selected";} else {} ?>><?=$locationv['name']?></option>



                                

                                                            <?php //} 

															

															} } ?>    

                                                            </select>

                                                        </div>

                                                    </div>

													

													<div class="form-group" id="indus_other" style="display:none;">

                                                        <label class="col-sm-2 control-label">Other Industry(Please Specify)</label>

                                                        <div class="col-sm-10">

                                            <input type="text" name="indus_other"   class="form-control" placeholder="Industry Type">

                                                        </div>

                                                    </div>

													

													

													

													<div class="form-group">

                                                        <label class="col-sm-2 control-label">HR Access Package</label>

                                                        <div class="col-sm-10">

                                              <select class="form-control" name="package_id" required="" onChange="showpacklimit(this.value)">

																<option value="">Select Access Plan</option>

																

																										

		<?php

		$hr_package = select_query($con, "hr_package", "","","","");

		if($hr_package['nr'])

		{

		$y='1';

		foreach($hr_package['result'] as $hr_key=>$hr_value)

		{

		?>

																

											<option value="<?php echo $hr_value['id']; ?>"><?php echo $hr_value['name']; ?></option>

																	

																	<?php

																	}

																	}

																	?>

																	

																	

															</select>

                                                        </div>

                                                    </div>

													

													<div id="result_display">

													

													</div>

													

													

													<div class="form-group">

														<div class="col-sm-offset-2 col-sm-10">

														<button type="submit" class="btn btn-primary">Add HR</button>

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

                  <p><!--Time is <span id="date-time">.</span>--> Design & Developed by <a href="javascript:void(0);" >Image Network</a></p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

	

	

	

	<script>

	

	

	function sel_val(str) 

	{

	

	 if(str == "11") {

     document.getElementById("indus_other").style.display = "block";

     return;

     } 

	 else 

	{

	 document.getElementById("indus_other").style.display = "none";

     return;

	} 

	

	}



	

	///////////////////////////////////////////////////////////////////

	

	

function showpacklimit(str) {

    if (str == "") {

        document.getElementById("result_display").innerHTML = "";

        return;

    } else { 

	 document.getElementById("result_display").innerHTML = "<center>Please wait...!!!</cenetr>";

        if (window.XMLHttpRequest) {

            // code for IE7+, Firefox, Chrome, Opera, Safari

            xmlhttp = new XMLHttpRequest();

        } else {

            // code for IE6, IE5

            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

        }

        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {

                document.getElementById("result_display").innerHTML = this.responseText;

            }

        };

        xmlhttp.open("GET","hr_ajax_access_package.php?id="+str,true);

        xmlhttp.send();

    }

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