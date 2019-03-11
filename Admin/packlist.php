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



if(isset($_REQUEST['walletsubmit'])){
	
	$user_id = $_REQUEST[user_id];
    $result = select_query($con,"user","","`id`='$_REQUEST[user_id]'");


	$ins= insert($con, "wallet_history","");

	

	//if($ins){ }



   /* $sql = "INSERT INTO `wallet_history` (`amount`, `type`, `tour_id`, `user_id`) VALUES ('$_REQUEST[amount]', 'prize', '$_REQUEST[tour_id]', '$_REQUEST[user_id]');";
    $status = mysqli_query($con,$sql); */

    if($ins){
        foreach ($result['result'] as $key => $user) {}
        $amount = $user['wallet_balance'] + $_REQUEST['amount'];
		
		
     /*   $sql = "UPDATE `user` SET `wallet_balance` = '".$amount."' WHERE `id` = '".$user_id."'   ";
        $status = mysqli_query($con,$sql);
         echo $status;*/
		 
		 $arr=array('wallet_balance'=>$amount);

         $updatestatus= update($con,"user","`id`='$user_id'",$arr);

    }

 
      	divert(ADMIN_URL.'/userlist/updated');


}


	

$filenames = "packlist";	

$maindatabase = packs;	

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

                        url :"ajax-packlist.php", // json datasource

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

                                <h1> Manage Packs<span> </span> </h1>

                            </div>

                        </div>

                    </div>

                    <!-- /# column -->

                    <div class="col-lg-4 p-l-0 title-margin-left">

                        <div class="page-header">

                            <div class="page-title">

                                <ol class="breadcrumb text-right">

                                    <li><a href="index.html">Dashboard</a></li>

                                    <li class="active">Manage Packs</li>

                                </ol>

                            </div>

                        </div>

                    </div>

                    <!-- /# column -->

                </div>

                <!-- /# row -->

                <div id="main-content">
                    
                </div>

					     <center><span id="result_display" style="color:#FF0000; font-size:16px;"></span></center>

						<!--- user details -->

						<div class="row">

                        <div class="col-lg-12">

                            <div class="card alert">

                                <div class="card-header pr">

                                    <h4>Pack List</h4>

             

                                </div>

                                <div class="card-body">

									<?php/*<div class="example box" data-options='{"direction":"both","contentSelector":">","containerSelector":">"}'>*/?>
									    <div class="scrollable-auto">

                                        <div>

                                            <div>

                                                <div class="">

												

                                        <table id="employee-grid" class="table table-bordered student-data-table table-striped m-t-20">

                                            <thead>

                                         

                                                    <th>SI. No. </th>

                                        

                                                    <th>Name</th>

                                                  
		
                                                    <th>Status</th>

                                                    <th>Action</th>
                                                   

                                                  

                                            </thead>

											<tbody>
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

                                 

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

<div class="modal fade" id="addwallet_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered bd-example-modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" >Add Wallet Balance</h5>
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
        <form method="post" id="add-wallet-form">
            <div class="modal-body" id="add_wallet">
              
              </div>
              <div class="modal-footer">
                <input type="submit" name="walletsubmit" class="btn btn-primary" value="Submit">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                
              </div>
        </form>
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

                        url :"ajax-userinfo.php", // json datasource

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
            url : 'ajax-pack.php?action=inactive',
            data :'id='+user_id,
            success : function (data){
                location.reload();
            }

        });

        return false;
    }

    function setActive(user_id){

        $.ajax({
            type :'post',
            url : 'ajax-pack.php?action=active',
            data :'id='+user_id,
            success : function (data){
                location.reload();
            }

        });

        return false;
    }

    function deletePack(id){
        if(confirm('Are you sure want to delete the Pack?')){
        $.ajax({
            type :'post',
            url : 'ajax-pack.php?action=delete',
            data :'id='+id,
            success : function (data){
                location.reload();
            }

        });}else{
            
        }
        return false;
    }


/*    function addWallet(id) {
        $('#addwallet_popup').find('input[name="user_id"]').val(id);
        formdata = 'user_id='+id;
        $.ajax({
                type : 'post' ,
                url : 'ajax-wallet.php',
                data: formdata+'&action=getaddbalance',
                dataType : 'json',
                success : function(res) { 
                  $('#addwallet_popup').find('select').html(res.tournament);
                }
            
        });
        return false;
    }*/

 $('#add-wallet-form').on('submit',function(){

        formdata = $('#add-wallet-form').serialize();
        $.ajax({
            type : 'post' ,
            url : 'ajax-wallet.php',
            data: formdata+'&action=addbalance',
            success : function(res) {
                alert('Amount Added to the Wallet!')
				location.reload();
               // $('#addwallet_popup').modal('hide');
            }
        
        });
        $('#add-wallet-form')[0].reset();   
    });
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

<script>
function addWallet(str) {
//alert(str);

document.getElementById("add_wallet").innerHTML ='Please wait...!!!';
   
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
                document.getElementById("add_wallet").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajax-add-wallet.php?q="+str,true);
        xmlhttp.send();
}
</script>



</body>



</html>