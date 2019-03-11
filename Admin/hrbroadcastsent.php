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
	
$filenames = "user";	
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
  <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    
    <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/unix.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
 <link href="assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
<link href="assets/css/lib/scrollable/scrollable.min.css" rel="stylesheet">

	<style>
	.stat-widget-five .stat-heading {padding-left: 2px;}
	.table .badge {width: 100%;}
    .no_wrp{white-space: nowrap;}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
   
    white-space: nowrap;
vertical-align: middle;
line-height:24px;

}
.student-data-table label {
       margin: 1px 3px;
}

.box, .simple {
    height: 350px;
}
.table thead {background: #3f51b5;color:#fff;}
.table>thead>tr>td, .table>thead>tr>th {color:#fff;}
.modal-dialog h5{text-align:center;}
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
                                <h1> Broadcast Sent<span> </span> </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="index.html">Dashboard</a></li>
                                    <li><a href="hr-manage.html">Manage HR</a></li>
                                    <li class="active">HR Broadcast Sent</li>
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
						<form>
                        <div class="card-body">
                            <div class="card-header m-b-20">
                                <h4>Broadcast Sent Search</h4>
                                <div class="card-header-right-icon">
                                    <ul>
                                        <li class="card-close" data-dismiss="alert"><i class="ti-close"></i></li>
                                        
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" class="form-control border-none input-flat bg-ash" placeholder="User ID">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" class="form-control border-none input-flat bg-ash" placeholder="User Name">
                                        </div>
                                    </div>
                                </div>
                               
									<div class="col-md-2">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" class="form-control border-none input-flat bg-ash" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
									<div class="col-md-2">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" class="form-control border-none input-flat bg-ash" placeholder="Mobile">
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-2">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" class="form-control border-none input-flat bg-ash" placeholder="Location">
                                        </div>
                                    </div>
                                </div>	
                                <div class="col-md-2">
                                    <div class="basic-form">
                                        <div class="form-group">
                                             <input type="text" class="form-control border-none input-flat bg-ash" placeholder="Message">
                                        </div>
                                    </div>
                                </div>
								
								 
								 
                               


                            </div>

                            <div class="row">
                                
                                
								 <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" class="form-control calendar bg-ash" placeholder="From Date" id="text-calendar">
                                            <span class="ti-calendar form-control-feedback booking-system-feedback"></span>
                                        </div>
                                    </div>
                                </div>
								 <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" class="form-control calendar bg-ash" placeholder="To Date" id="text-calendar">
                                            <span class="ti-calendar form-control-feedback booking-system-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="time" class="form-control bg-ash" value="current_now" >
                                            <!-- <span class="ti-time form-control-feedback booking-system-feedback"></span> -->
                                        </div>
                                    </div>
                                </div>
							<button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit">Search</button>
                            <button class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" type="reset">Reset</button>
                            </div>
                            
                        </div>
                    </form>
						</div>
					</div>
					</div>
					
						<!--- user details -->
						<div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header pr">
                                   <h4>Broadcast Sent Users Information</h4>
                                   
                                    <div class="card-header-right-icon">
                                        <ul>
                                            <li class="card-option drop-menu"><i class="ti-settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                            <ul class="card-option-dropdown dropdown-menu">
                                                <li><a href="#"><i class="fa fa-file-pdf-o"></i> Download PDF</a></li>
                                                <li><a href="#"><i class="fa fa-file-excel-o"></i> Download Excel</a></li>
                                                <li><a href="#"><i class="ti-trash"></i> Delete</a></li>
                                                <li><a href="#"><i class="ti-printer"></i> Print </a></li>
                                            </ul>
                                        </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
									<div class="example box" data-options='{"direction":"both","contentSelector":">","containerSelector":">"}'>
                                        <div>
                                            <div>
                                                <div class="">
                                        <table class="table table-bordered student-data-table table-striped m-t-20">
                                            <thead>
                                                <tr>
                                                    <th><label><input type="checkbox" value=""></label></th>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Location</th>
                                                    <th>Email</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
													
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <tr>
                                                    <td><label><input type="checkbox" value=""></label></td>
                                                    <td>PR0001</td>
                                                    <td>Rajkumar D</td>
                                                    <td>rajkumar@cwd.co.in</td>
                                                    <td>9876543210</td>
                                                    <td>Chennai</td>
                                                    <td class="color-primary sms_pop_up" data-toggle="modal" data-target="#sms_pop_up">We are shortlisted you</td>
                                                    <td>10/08/2018</td>
                                                    <td>10:08 AM</td>
													
                                                    
													
                                                </tr>
												<tr>
                                                    <td><label><input type="checkbox" value=""></label></td>
                                                    <td>PR0001</td>
                                                    <td>Rajkumar D</td>
                                                    <td>rajkumar@cwd.co.in</td>
                                                    <td>9876543210</td>
                                                    <td>Chennai</td>
                                                  <td class="color-danger sms_pop_up" data-toggle="modal" data-target="#sms_pop_up">We are shortlisted you</td>
                                                    <td>10/08/2018</td>
                                                    <td>10:08 AM</td>
                                                </tr>
                                               <tr>
                                                    <td><label><input type="checkbox" value=""></label></td>
                                                    <td>PR0001</td>
                                                    <td>Rajkumar D</td>
                                                    <td>rajkumar@cwd.co.in</td>
                                                    <td>9876543210</td>
                                                    <td>Chennai</td>
                                                    <td class="color-primary sms_pop_up" data-toggle="modal" data-target="#sms_pop_up">We are shortlisted you</td>
                                                    <td>10/08/2018</td>
                                                    <td>10:08 AM</td>
													
                                                    
													
                                                </tr>
												<tr>
                                                    <td><label><input type="checkbox" value=""></label></td>
                                                    <td>PR0001</td>
                                                    <td>Rajkumar D</td>
                                                    <td>rajkumar@cwd.co.in</td>
                                                    <td>9876543210</td>
                                                    <td>Chennai</td>
                                                  <td class="color-danger sms_pop_up" data-toggle="modal" data-target="#sms_pop_up">We are shortlisted you</td>
                                                    <td>10/08/2018</td>
                                                    <td>10:08 AM</td>
                                                </tr>
                                               <tr>
                                                    <td><label><input type="checkbox" value=""></label></td>
                                                    <td>PR0001</td>
                                                    <td>Rajkumar D</td>
                                                    <td>rajkumar@cwd.co.in</td>
                                                    <td>9876543210</td>
                                                    <td>Chennai</td>
                                                    <td class="color-primary sms_pop_up" data-toggle="modal" data-target="#sms_pop_up">We are shortlisted you</td>
                                                    <td>10/08/2018</td>
                                                    <td>10:08 AM</td>
													
                                                    
													
                                                </tr>
												<tr>
                                                    <td><label><input type="checkbox" value=""></label></td>
                                                    <td>PR0001</td>
                                                    <td>Rajkumar D</td>
                                                    <td>rajkumar@cwd.co.in</td>
                                                    <td>9876543210</td>
                                                    <td>Chennai</td>
                                                  <td class="color-danger sms_pop_up" data-toggle="modal" data-target="#sms_pop_up">We are shortlisted you</td>
                                                    <td>10/08/2018</td>
                                                    <td>10:08 AM</td>
                                                </tr>
                                               <tr>
                                                    <td><label><input type="checkbox" value=""></label></td>
                                                    <td>PR0001</td>
                                                    <td>Rajkumar D</td>
                                                    <td>rajkumar@cwd.co.in</td>
                                                    <td>9876543210</td>
                                                    <td>Chennai</td>
                                                    <td class="color-primary sms_pop_up" data-toggle="modal" data-target="#sms_pop_up">We are shortlisted you</td>
                                                    <td>10/08/2018</td>
                                                    <td>10:08 AM</td>
													
                                                    
													
                                                </tr>
												<tr>
                                                    <td><label><input type="checkbox" value=""></label></td>
                                                    <td>PR0001</td>
                                                    <td>Rajkumar D</td>
                                                    <td>rajkumar@cwd.co.in</td>
                                                    <td>9876543210</td>
                                                    <td>Chennai</td>
                                                  <td class="color-danger sms_pop_up" data-toggle="modal" data-target="#sms_pop_up">We are shortlisted you</td>
                                                    <td>10/08/2018</td>
                                                    <td>10:08 AM</td>
                                                </tr>
                                               <tr>
                                                    <td><label><input type="checkbox" value=""></label></td>
                                                    <td>PR0001</td>
                                                    <td>Rajkumar D</td>
                                                    <td>rajkumar@cwd.co.in</td>
                                                    <td>9876543210</td>
                                                    <td>Chennai</td>
                                                    <td class="color-primary sms_pop_up" data-toggle="modal" data-target="#sms_pop_up">We are shortlisted you</td>
                                                    <td>10/08/2018</td>
                                                    <td>10:08 AM</td>
													
                                                    
													
                                                </tr>
												<tr>
                                                    <td><label><input type="checkbox" value=""></label></td>
                                                    <td>PR0001</td>
                                                    <td>Rajkumar D</td>
                                                    <td>rajkumar@cwd.co.in</td>
                                                    <td>9876543210</td>
                                                    <td>Chennai</td>
                                                  <td class="color-danger sms_pop_up" data-toggle="modal" data-target="#sms_pop_up">We are shortlisted you</td>
                                                    <td>10/08/2018</td>
                                                    <td>10:08 AM</td>
                                                </tr>
                                               <tr>
                                                    <td><label><input type="checkbox" value=""></label></td>
                                                    <td>PR0001</td>
                                                    <td>Rajkumar D</td>
                                                    <td>rajkumar@cwd.co.in</td>
                                                    <td>9876543210</td>
                                                    <td>Chennai</td>
                                                    <td class="color-primary sms_pop_up" data-toggle="modal" data-target="#sms_pop_up">We are shortlisted you</td>
                                                    <td>10/08/2018</td>
                                                    <td>10:08 AM</td>
													
                                                    
													
                                                </tr>
												<tr>
                                                    <td><label><input type="checkbox" value=""></label></td>
                                                    <td>PR0001</td>
                                                    <td>Rajkumar D</td>
                                                    <td>rajkumar@cwd.co.in</td>
                                                    <td>9876543210</td>
                                                    <td>Chennai</td>
                                                  <td class="color-danger" data-toggle="modal" data-target="#sms_pop_up">We are shortlisted you</td>
                                                    <td>10/08/2018</td>
                                                    <td>10:08 AM</td>
                                                </tr>
                                               
												</tbody>
                                        </table>
                                    </div>
                               
                                            </div>
                                        </div>
                                    </div>
                                     <div >
								  <ul class="pagination justify-content-end">
									<li class="page-item disabled">
									  <a class="page-link" href="#" tabindex="-1"><span class="ti-angle-left"></span></a>
									</li>
									<li class="page-item"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item active">
									  <a class="page-link" href="#">4 <span class="sr-only">(current)</span></a>
									</li>
									<li class="page-item"><a class="page-link" href="#">5</a></li>
									<li class="page-item"><a class="page-link" href="#">6</a></li>
									<li class="page-item"><a class="page-link" href="#">7</a></li>
									<li class="page-item">
									  <a class="page-link" href="#"><span class="ti-angle-right"></span></a>
									</li>
								  </ul>
								</div>
										</div>
                            </div>
                        </div>
                        <!-- /# column -->

                    </div>
						<!--- user details -->
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
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
       <script src="assets/js/lib/calendar-2/moment.latest.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/semantic.ui.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/prism.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/pignose.init.js"></script>

    <script src="assets/js/lib/scrollable/holder.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/scrollable/jquery-asScrollbar.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/scrollable/jquery-asScrollable.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/scrollable/scrollable.init.js"></script>
    <!-- scripit init-->
    <script src="assets/js/scripts.js"></script>
<!-- Modal -->
  <div class="modal fade" id="sms_pop_up1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">SENT MESSAGE</h4>
        </div>
        <div class="modal-body">
          <p>You are shortlist for the Electrical Engineering Job at Hyundai</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<div class="modal fade" id="sms_pop_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered bd-example-modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" >SENT MAIL</h5>
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <div class="modal-body">
       <p>You are shortlist for the Electrical Engineering Job at Hyundai</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


</body>

</html>