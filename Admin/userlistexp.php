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

	<base href="<?php echo $url; ?>" >

    <!-- ================= Favicon ================== -->

    <!-- Standard -->

    

  <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">

    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">

        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
	    <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />

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

	</style>

	<link rel="stylesheet" type="text/css" href="assets/dt/css/jquery.dataTables.css">

	<script type="text/javascript" language="javascript" >

        

        function select_query(){

        

        

        

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

                        url :"ajax-userinfo-exp.php", // json datasource

                        type: "post",  // method  , by default get

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



<body  onLoad="select_query()"; >

		<?php include "include/header.php";?>

  

    <div class="content-wrap">

        <div class="main">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-8 p-r-0 title-margin-right">

                        <div class="page-header">

                            <div class="page-title">

                                <h1> Manage Expired User<span> </span> </h1>

                            </div>

                        </div>

                    </div>

                    <!-- /# column -->

                    <div class="col-lg-4 p-l-0 title-margin-left">

                        <div class="page-header">

                            <div class="page-title">

                                <ol class="breadcrumb text-right">

                                    <li><a href="index.html">Dashboard</a></li>

                                    <li class="active">Mange Expired User</li>

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

                                <h4>User Search Information</h4>

                              <div class="card-header-right-icon">



       <a href="<?php echo $baseurl; ?>download_user.php" class="btn btn-primary btn-lg m-b-10 m-l-5 sbmt-btn" target="_blank">Download All</a>			



                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-2">

                                    <div class="basic-form">

                                        <div class="form-group">

                                            <input type="text" class="form-control border-none input-flat bg-ash" placeholder="User ID" name="user_id">

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-2">

                                    <div class="basic-form">

                                        <div class="form-group">

                                            <input type="text" class="form-control border-none input-flat bg-ash" placeholder="Name" name="username">

                                        </div>

                                    </div>

                                </div>

                               

									<div class="col-md-2">

                                    <div class="basic-form">

                                        <div class="form-group">

                                            <input type="text" class="form-control border-none input-flat bg-ash" placeholder="Email" name="email">

                                        </div>

                                    </div>

                                </div>

									<div class="col-md-2">

                                    <div class="basic-form">

                                        <div class="form-group">

                                            <input type="text" class="form-control border-none input-flat bg-ash" placeholder="Mobile" name="mobile">

                                        </div>

                                    </div>

                                </div>

								<div class="col-md-2">

                                    <div class="basic-form">

                                        <div class="form-group">
								 
								 
								 <select class="form-control bg-ash border-none" placeholder="Location" name="location">

												<option value="">Location</option>
												
												
		<?php 
		$packagelist = select_query($con, "cities_current", "","`id`!='' and `status`='Active' ");														
		if($packagelist['nr'])
		{
		foreach($packagelist['result'] as $key=>$locationv)
		{
		?>
		<option value="<?php echo $locationv['id']; ?>"><?php echo $locationv['name']; ?></option>
		<?php 
		} 
		}
		?>
											
											</select>

                                        </div>

                                    </div>

                                </div>	

								 <div class="col-md-2">

                                    <div class="basic-form">

                                        <div class="form-group">

                                            <select class="form-control bg-ash border-none" name="exp_type">



                                                        <option value="">Fresh/Exp</option>

                                                        <option value="Fresher">Fresher</option>

														<option value="Experience">Experience</option>


														

                                                    </select>

                                        </div>

                                    </div>

                                </div>

								 

                               





                            </div>



                            <div class="row">

                                

                                <div class="col-md-2">

                                    <div class="basic-form">

                                        <div class="form-group">

                                            <select class="form-control bg-ash border-none" name="edu_degree">

												<option value="">Qualification</option>	
								 <?php
								 $sql ="SELECT * FROM `education` order by `id` asc";
                                 $eduquery=mysqli_query($con, $sql);
                                 while($eduquery1  = mysqli_fetch_array($eduquery))
								 {
								 ?>
								 <option value="<?php echo $eduquery1[id]; ?>"> <?php echo $eduquery1[name]; ?> </option>	
								 <?php
								 }
								 ?>									
											</select>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-2">

                                    <div class="basic-form">

                                        <div class="form-group">

                                            <select class="form-control bg-ash border-none" name="edu_spec">

												<option value="">Specialization</option>
												
												<?php
								 $spec_sql ="SELECT * FROM `specialization` order by `id` asc";
                                 $spec_query=mysqli_query($con, $spec_sql);
                                 while($spec_query1  = mysqli_fetch_array($spec_query))
								 {
								 ?>
								 <option value="<?php echo $spec_query1[id]; ?>"> <?php echo $spec_query1[name]; ?> </option>	
								 <?php
								 }
								 ?>	

											</select>

                                        </div>

                                    </div>

                                </div>

								<div class="col-md-2">

                                    <div class="basic-form">

                                        <div class="form-group">

                  <input type="text" class="form-control calendar bg-ash" placeholder="From Date" id="text-calendar" name="from_date">

                                            <span class="ti-calendar form-control-feedback booking-system-feedback"></span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-2">

                                    <div class="basic-form">

                                        <div class="form-group">

                      <input type="text" class="form-control calendar bg-ash" placeholder="To Date" id="text-calendar" name="to_date">

                                            <span class="ti-calendar form-control-feedback booking-system-feedback"></span>

                                        </div>

                                    </div>

                                </div>
                            <input type="hidden" name="action" value="getsearch">
		<button type="submit" class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn"  id="search-btn">Search</button>

                            <button class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" type="reset">Reset</button>

                            </div>

                            

                        </div>

                    </form>

						</div>

					</div>

					</div>

					   <center><span id="result_display" style="color:#FF0000; font-size:16px;"></span></center>

						<!--- user details -->

						<div class="row">

                        <div class="col-lg-12">

                            <div class="card alert">

                                <div class="card-header pr">

                                    <h4>Expired User Lists</h4>

                                   

                                    <!--<div class="card-header-right-icon">

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

                                    </div>-->

                                </div>

                                <div class="card-body">

									<?php /*<div class="example box" data-options='{"direction":"both","contentSelector":">","containerSelector":">"}'>*/?>
									    <div class="scrollable-auto">

                                        <div>

                                            <div>

                                                <div class="">

												

                                        <table id="employee-grid" class="table table-bordered student-data-table table-striped m-t-20">

                                            <thead>

                                               <?php /*?> <th><label><input type="checkbox" value="" id="checkAll"></label></th><?php */?>

                                                    <th>SI. No. </th>

                                                    <th>User ID</th>

                                                    <th>Name</th>

                                                    <th>Email</th>

                                                    <th>Mobile</th>

                                                    <th>Location</th>

                                                    <th>Fresh/Exp</th>

                                                    <th>Qualification</th>

                                                    <th>Department</th>
													
													<th>Reg Date</th>
	<th>Expired on</th>
                                                    <th>Status</th>

                                                    <th>Action</th>
                                                    <th>&nbsp;</th>

                                                  

                                            </thead>

											  <tbody>

                                            <!--  <tr>

                                                    <td><label><input type="checkbox" value=""></label></td>

                                                    <td>PR0001</td>

                                                    <td>Rajkumar D</td>

                                                    <td>rajkumar@cwd.co.in</td>

                                                    <td>9876543210</td>

                                                    <td>Chennai</td>

                                                    <td class="color-primary">Fresher</td>

                                                    <td>B.Tech</td>

                                                    <td>Mechanical</td>

                                                    <td>10/08/2018</td>

													<td><span class="badge badge-warning">Professional</span></td>

                                                    <td><span class="badge badge-success">Active</span></td>

                                                    

                                                    <td class="no_wrp">

                                                        <span ><a href="#"><i class="ti-eye color-default"></i></a> </span>

                                                        <span><a href="user-edit.html"><i class="ti-pencil-alt color-success"></i></a></span>

                                                        <span><a href=""><i class="ti-trash color-danger"></i> </a></span>

                                                    </td>

												

                                                </tr>
 -->
												

													</tbody>

                                        </table>

                                    </div>

                               

                                            </div>

                                        </div>

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
	
	
<?php /*?><script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>	<?php */?>
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

                        url :"ajax-userinfo-exp.php", // json datasource

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
	function setInActive(user_id){

		$.ajax({
			type :'post',
			url : 'ajax-userstatus.php?action=inactive',
			data :'user_id='+user_id,
			success : function (data){
				location.reload();
			}

		});

		return false;
	}

	function setActive(user_id){

		$.ajax({
			type :'post',
			url : 'ajax-userstatus.php?action=active',
			data :'user_id='+user_id,
			success : function (data){
				location.reload();
			}

		});

		return false;
	}
</script>

<script>
function sms_sent(str) {
//alert(str);
document.getElementById("result_display").innerHTML ='Please wait...!!!';

    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
			  // alert(this.responseText);
                document.getElementById("result_display").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","sms_sent.php?q="+str,true);
        xmlhttp.send();
}
</script>
<script>
function email_sent(str) {
//alert(str);

document.getElementById("result_display").innerHTML ='Please wait...!!!';
   
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
			   // alert(this.responseText);
                document.getElementById("result_display").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","email_sent.php?q="+str,true);
        xmlhttp.send();
}
</script>

</body>



</html>