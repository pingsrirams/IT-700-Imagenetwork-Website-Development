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
<link rel="stylesheet" type="text/css" href="assets/dt/css/jquery.dataTables.css">


         <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />

        <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />   

   


    <style>
    .stat-widget-five .stat-heading {padding-left: 2px;}
    .table .badge {width: auto;}
     .table .badge a{color:#fff;}
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
    </style>
        <script type="text/javascript" language="javascript" >

        

        function select_query(){

        
sort_by = '<?=($subid3=='')?'Pending':$subid3?>';
        
show_1 = '<?php if($subid2=='approved' || $subid3=='approved'){ echo 'Approved'; }else if($subid2=='rejected' || $subid3=='rejected'){ echo 'Rejected';}else{ echo 'Pending';} ?>';
        

        var dataTable = $('#employee-grid').DataTable( {

            

        <!--    "sScrollX": "100%",-->

           "bScrollCollapse": true,

        <!--   "bJQueryUI": true,-->

         <!--  "sPaginationType": "full_numbers",-->

            "columnDefs": [

    {   "defaultContent": "-","orderable": false, "targets": 0,"targets": 1 }

  ],dom: 'lBfrtip',

        buttons: [

            'copy', 'csv', 'excel', 'pdf', 'print'

        ],

                    "processing": true,

                    "serverSide": true,

                    "ajax":{

                        url :"ajax-scheduledbroadcast.php", // json datasource

                        type: "post",

 data :{'sort_by':sort_by,'show':show_1} ,  // method  , by default get

                        error: function(){  // error handling

                            $(".employee-grid-error").html("");

                            $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');

                            $("#employee-grid_processing").css("display","none");

                            

                        }

                    }

                } );

        }

        </script>
</head>

<body  onLoad="select_query()";>
        <?php include "include/header.php";?>
  
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1> Manage User broadcast<span> </span> </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="index.html">Dashboard</a></li>
                                    <li class="active">Mange HR</li>
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
                        <form method="post" id="search-form">
                        <div class="card-body">
                            <div class="card-header m-b-20">
                                <h4>Broadcast Search Information</h4>
                                <div class="card-header-right-icon">
                                    <ul>
                                        <li class="card-close" data-dismiss="alert"><i class="ti-close"></i></li>
                                        
                                        
                                    </ul>
                                </div>
                            </div>
                            
                            <?php /*?><div class="row">
                                <div class="col-md-2">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" name="hr_id" class="form-control border-none input-flat bg-ash" placeholder="HR ID">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control border-none input-flat bg-ash" placeholder="HR Name">
                                        </div>
                                    </div>
                                </div>
                               
                                    <div class="col-md-2">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control border-none input-flat bg-ash" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md-2">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" name="mobile" class="form-control border-none input-flat bg-ash" placeholder="Mobile">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" name="company" class="form-control border-none input-flat bg-ash" placeholder="Company">
                                        </div>
                                    </div>
                                </div>  
                                <div class="col-md-2">
                                    <div class="basic-form">
                                        <div class="form-group">
                                             <input type="text" name="location" class="form-control border-none input-flat bg-ash" placeholder="Location">
                                        </div>
                                    </div>
                                </div>
                                
                                 
                                 
                               


                            </div><?php */?>

                            <div class="row">
                                
                                
                                 <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" name="from_date" class="form-control calendar bg-ash" placeholder="From Date" id="text-calendar">
                                            <span class="ti-calendar form-control-feedback booking-system-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" name="to_date" class="form-control calendar bg-ash" placeholder="To Date" id="text-calendar">
                                            <span class="ti-calendar form-control-feedback booking-system-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php /*?><div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <input type="text" class="form-control calendar bg-ash" placeholder="Active Date" name="active_date" id="text-calendar">
                                            <span class="ti-calendar form-control-feedback booking-system-feedback"></span>
                                        </div>
                                    </div>
                                </div><?php */?>
                                
                                 <input type="hidden" name="action" value="getsearch">
								 
								 
								<?php if($subid2=='approved' || $subid3=='approved'){ $use='Approved'; }else if($subid2=='rejected' || $subid3=='rejected'){ $use='Rejected';}else{ $use='Pending';} ?>								 
								 
								   <input type="hidden" name="show" value="<?php echo $use; ?>">
 
								 
        <button id="search-btn" class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit">Search</button>
                            <button class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" type="reset">Reset</button>
                            </div>
                            
                        </div>
                    </form>
                        </div>
                    </div>
                    </div><?php
    if ($subid3 == '') {
                               $sort_by_name = 'Pending';
                            }else  if ($subid3 == 'approved') {
                               $sort_by_name = 'Approved';
                            }
                            else  if ($subid3 == 'rejected') {
                               $sort_by_name = 'Rejected';
                            } ?>
                    
                        <!--- user details -->
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header pr">
                                    <h4>Broadcast Lists (<?=$sort_by_name?>)</h4>
                                   
                                    <?php /*?><div class="card-header-right-icon">



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



                                    </div><?php */?>
                                </div>
                                <div class="card-body">
                                    <div class="scrollable-auto">
                                        <div>
                                            <div>
                                                <div class="">
                                        <table id="employee-grid" class="table table-bordered student-data-table table-striped m-t-20">
                                            <thead>
                                                <tr>
                                                    <?php /*?><th><label><input type="checkbox" value=""></label></th><?php */?>
                                                    <th>SI.No</th>
                                                    <th>Name</th>
                                                    <th>Company</th>
                                                    <th>Email</th>
                                                    <th>Job ID</th>
                                                 
                                                    <th>Broadcast</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                               <!--      <th>Options</th> -->
                                                   
                                             <!--        <th>Website</th> -->
                                                 <th>&nbsp;</th>
                                                       <!-- <th>&nbsp;</th>-->

                                                </tr>
                                            </thead>
                                           
                                        </table>
                                    </div>
                                
                               
                                            </div>
                                        </div>
                                    </div>
                            <!--    <div >
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
                                </div> -->
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
<!-- Modal -->
 

<div class="modal fade" id="broadcast_pop_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered bd-example-modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" >SENT EMAIL</h5>
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



<div class="modal fade" id="list_pop_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered bd-example-modal-sm" role="document" style="width:80%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" >USER LISTS</h5>
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <div class="modal-body">
                                <div class="">
                                <div class="">
                <div class="example box1 scrollable-auto" data-options='{"direction":"auto","contentSelector":">","containerSelector":">"}'>
<!-- <div class="example box1" data-options='{"direction":"both","contentSelector":">","containerSelector":">"}' style="width:100%;height:300px;"> -->
                                        <div>
                                            <div>
                                               <div class="" >
                                        <table class="table table-bordered student-data-table table-striped m-t-20">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Location</th>
                                                    <th>Fresh/Exp</th>
                                                    <th>Qualification</th>
                                                    <th>Department</th>

                                                   
                                                
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_userlist">
                                               
                                               
                                                </tbody>
                                        </table>
                                    </div>
                               
                                            </div>
                                        </div>
                                    </div>
                                     <div >
                                  
                                </div>
                                        </div>
                            </div>
                        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="candidatejobalert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="display: none;">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLongTitle">Ref ID : JOBID00001</h5>

        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button> -->

      </div>

      <div class="modal-body">

       <ul class="careerfy-row careerfy-employer-profile-form">

                <li class="careerfy-column-12">

                    <label>Job Title / Designation </label>

                    <input value="Enter Title" onBlur="if(this.value == '') { this.value ='Enter Title'; }" onFocus="if(this.value =='Enter Title') { this.value = ''; }" type="text">

                </li>

                

                

                <li class="careerfy-column-12">

                    <label>Job Description </label>

                    <textarea>Hiring Automobile Engineers </textarea>

                </li>

                <li class="careerfy-column-6">

                    <label>Job Ref ID </label>

                    <input value="Enter Ref ID" onBlur="if(this.value == '') { this.value ='Enter Ref ID'; }" onFocus="if(this.value =='Enter Ref ID') { this.value = ''; }" type="text">

                </li>

                <li class="careerfy-column-6">

                    <label>Experience - Min / Max </label>

                    <div class="careerfy-profile-select">

                        <select>

                        <option>Fresh/Experience</option>

                        <option>0-1 Years</option>

                        <option>1-2 Years</option>

                        <option>2-3 Years</option>

                        <option>3-4 Years</option>

                        <option>4-5 Years</option>

                        <option>More than 5 Years</option>

                        

                    </select>

                    </div>

                </li>

                

                

                <li class="careerfy-column-6">

                    <label>Education </label>

                    <div class="careerfy-profile-select">

                        <select>

                            <option>School/ Diploma</option>

                            <option>Under Graduate</option>

                            <option>Post Graduate</option>

                            <option>Doctorate/Phd</option>

                        </select>

                    </div>

                </li>

                <li class="careerfy-column-6">

                    <label>Specialization</label>

                    <div class="careerfy-profile-select">

                        <select>

                            <option>Automobile</option>

                            <option>Mechanical</option>

                            <option>Electrical</option>

                            <option>Electronics</option>

                        </select>

                    </div>

                </li>

                <li class="careerfy-column-6">

                    <label>Job Location </label>

                    <div class="careerfy-profile-select">

                        <select>

                            <option>Chennai</option>

                            <option>New Delhi</option>

                        </select>

                    </div>

                </li>

                <li class="careerfy-column-6">

                    <label>CTC Details </label>

                    <input value="Enter CTC Details" onBlur="if(this.value == '') { this.value ='Enter CTC Details'; }" onFocus="if(this.value =='Enter CTC Details') { this.value = ''; }" type="text">

                </li>

                

                <li class="careerfy-column-6">

                    <label>Job Broadcast Active Date - From</label>

                    <input value="Enter Ref ID" onBlur="if(this.value == '') { this.value ='Enter Ref ID'; }" onFocus="if(this.value =='Enter Ref ID') { this.value = ''; }" type="date">

                </li>

                <li class="careerfy-column-6">

                    <label>Job Broadcast Active Date - To</label>

                    <input value="Enter Ref ID" onBlur="if(this.value == '') { this.value ='Enter Ref ID'; }" onFocus="if(this.value =='Enter Ref ID') { this.value = ''; }" type="date">

                </li>

            </ul>

      </div>

     <!--  <div class="modal-footer"> -->

        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->

      <!--   <button type="button" class="btn btn-danger" data-dismiss="modal">Not Now</button>

        <button type="button" class="btn btn-primary">Apply</button>

      </div>
 -->
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
    
    
<?php /*?><script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>  <?php */?>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>    
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>


<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>   


    <script src="assets/js/lib/scrollable/holder.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/scrollable/jquery-asScrollbar.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/scrollable/jquery-asScrollable.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/scrollable/scrollable.init.js"></script>
    <script type="text/javascript" language="javascript" src="assets/dt/js/jquery.dataTables.js"></script>
    <!-- scripit init-->
    <script src="assets/js/scripts.js"></script>
    <script type="text/javascript">
         $('#search-btn').on('click',function(){
                formdata = $('#search-form').serialize();
                if ( $.fn.dataTable.isDataTable('#employee-grid') ) {
                   table = $('#employee-grid').DataTable();   table.destroy();
                }

                table = $('#employee-grid').DataTable ( {

            

        <!--    "sScrollX": "100%",-->

           "bScrollCollapse": true,

        <!--   "bJQueryUI": true,-->

         <!--  "sPaginationType": "full_numbers",-->

            "columnDefs":  [

    { "orderable": false, "targets": 0,"targets": 1 }

  ],dom: 'lBfrtip',

        buttons: [

            'copy', 'csv', 'excel', 'pdf', 'print'

        ],

                    "processing": true,

                    "serverSide": true,

                    "ajax":{

                        url :"ajax-scheduledbroadcast.php", // json datasource

                        type: "post",

                        data :  function(d) {
       var frm_data = $('#search-form').serializeArray();
       $.each(frm_data, function(key, val) {
         d[val.name] = val.value;
       });
     }, // method  , by default get

                        error: function(){  // error handling

                            $(".employee-grid-error").html("");

                            $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');

                            $("#employee-grid_processing").css("display","none");

                            

                        }

                    }

                } );


            });
    </script>
<script type="text/javascript">
       function showUserList(bs_id){
        $.ajax({
            type : 'post',
            url : 'ajax-broadcastusers.php',
            data : 'action=getuserlist&bs_id='+bs_id,
            success : function(data){
                    $('#tbody_userlist').html(data)
             
            }
        });
    } 
    function viewMessage(bs_id){
        $.ajax({
            type : 'post',
            url : 'ajax-broadcastusers.php',
            data : 'action=bs_viewmessage&bs_id='+bs_id,
            async:false,
            beforeSend : function() {
                   $('#broadcast_pop_up').modal('show');
            },
            success : function(data){
                    $('#broadcast_pop_up .modal-body').html(data);
                       $('#broadcast_pop_up').modal('show');

             
            }
        });
      
    }


    function approve(ab_id){
        if (confirm("Are your sure you want to approve this Broadcast?")) {
            $.ajax({
                type : 'post',
                url : 'ajax-broadcastusers.php',
                data : 'action=approvebroadcast&ab_id='+ab_id,
                success : function(data){

                         if ( $.fn.dataTable.isDataTable('#employee-grid') ) {
                   table = $('#employee-grid').DataTable();   table.destroy();
                }

                table = $('#employee-grid').DataTable ( {

            

        <!--    "sScrollX": "100%",-->

           "bScrollCollapse": true,

        <!--   "bJQueryUI": true,-->

         <!--  "sPaginationType": "full_numbers",-->

            "columnDefs":  [

    { "orderable": false, "targets": 0,"targets": 1 }

  ],dom: 'lBfrtip',

        buttons: [

            'copy', 'csv', 'excel', 'pdf', 'print'

        ],

                    "processing": true,

                    "serverSide": true,

                    "ajax":{

                        url :"ajax-scheduledbroadcast.php", // json datasource

                        type: "post",

                        data :  function(d) {
       var frm_data = $('#search-form').serializeArray();
       $.each(frm_data, function(key, val) {
         d[val.name] = val.value;
       });
     }, // method  , by default get

                        error: function(){  // error handling

                            $(".employee-grid-error").html("");

                            $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');

                            $("#employee-grid_processing").css("display","none");

                            

                        }

                    }

                } );
                 
                }
            });
        } else {
          
        }
        return false;
    }
    function disapprove(db_id){
        if (confirm("Are your sure you want to reject this Broadcast?")) {
            $.ajax({
                type : 'post',
                url : 'ajax-broadcastusers.php',
                data : 'action=disapprovebroadcast&db_id='+db_id,
                success : function(data){
                        alert('Content Disapproved. Broadcast refunded.');
                         if ( $.fn.dataTable.isDataTable('#employee-grid') ) {
                   table = $('#employee-grid').DataTable();   table.destroy();
                }

                table = $('#employee-grid').DataTable ( {

            

        <!--    "sScrollX": "100%",-->

           "bScrollCollapse": true,

        <!--   "bJQueryUI": true,-->

         <!--  "sPaginationType": "full_numbers",-->

            "columnDefs":  [

    { "orderable": false, "targets": 0,"targets": 1 }

  ],dom: 'lBfrtip',

        buttons: [

            'copy', 'csv', 'excel', 'pdf', 'print'

        ],

                    "processing": true,

                    "serverSide": true,

                    "ajax":{

                        url :"ajax-scheduledbroadcast.php", // json datasource

                        type: "post",

                        data :  function(d) {
       var frm_data = $('#search-form').serializeArray();
       $.each(frm_data, function(key, val) {
         d[val.name] = val.value;
       });
     }, // method  , by default get

                        error: function(){  // error handling

                            $(".employee-grid-error").html("");

                            $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');

                            $("#employee-grid_processing").css("display","none");

                            

                        }

                    }

                } );
                 
                }
            });
        } else {
          
        }
        return false;
    }




function viewbroadcast(id) {
    hrurl = '<?=$hrurl?>';
       $.ajax({
            type : 'post',
            url : hrurl+'ajax/ajax-broadcast.php',
            async :false,
            data : 'action=view&id='+id,
            success : function (data) {
               $('#candidatejobalert .modal-body').html(data);
            }
       })

    return false;
}
</script>    
    
    
</body>

</html>