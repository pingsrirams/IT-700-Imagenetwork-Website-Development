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



?>







<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Image Network :  Admin Dashboard</title>

	<base href="<?php echo $url; ?>" >

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

    height: 600px;

}

.table thead {background: #3f51b5;color:#fff;}

.table>thead>tr>td, .table>thead>tr>th {color:#fff;}

	</style>

        <script type="text/javascript" language="javascript" >



        



        function select_query(){



        



        



        



        var dataTable = $('#employee-grid').DataTable( {



            



        <!--    "sScrollX": "100%",-->



           "bScrollCollapse": true,



        <!--   "bJQueryUI": true,-->



         <!--  "sPaginationType": "full_numbers",-->



            "columnDefs": [



    {   "defaultContent": "-","orderable": false, "targets": 0,"targets": 1 }



  ],



                    "processing": true,



                    "serverSide": true,



                    "ajax":{



                        url :"ajax-historylist.php", // json datasource



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



<body  onLoad="select_query()";>

		<?php include "include/header.php";?>

  

    <div class="content-wrap">

        <div class="main">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-8 p-r-0 title-margin-right">

                        <div class="page-header">

                            <div class="page-title">

                                <h1> Wallet Added History list</h1>

                            </div>

                        </div>

                    </div>

                    <!-- /# column -->

                    <div class="col-lg-4 p-l-0 title-margin-left">

                        <div class="page-header">

                            <div class="page-title">

                                <ol class="breadcrumb text-right">

                                    <li><a href="index.html">Dashboard</a></li>

                                    <li class="active">Wallet Added History list</li>

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

                                <h4>Wallet Added History list Search Information</h4>

                                <div class="card-header-right-icon">

                                    <ul>

                                        <li class="card-close" data-dismiss="alert"><i class="ti-close"></i></li>

                                        

                                        

                                    </ul>

                                </div>

                            </div>

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

                                

                                 <input type="hidden" name="action" value="getsearch">

							<button id="search-btn" class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="button">Search</button>

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

                                    <h4>WALLET ADDED LISTS</h4>

                                   

                                    

                                </div>

                                <div class="card-body">

									<div class="scrollable-auto">

                                        <div>

                                            <div>

                                                <div class="">

                                        <table id="employee-grid" class="table table-bordered student-data-table table-striped m-t-20">

                                            <thead>

                                                <tr>

                                                   

                                                    <th> ID</th>
<th>USER ID</th>
                                                    <th>NAME</th>
  <th>MOBILE</th>
                                                  
   <th>TOURNAMENT</th>
													  <th>ADDED AMOUNT</th>

													   

                                                   <th> ADDED ON</th>
                                               
                                                 

                                                </tr>

                                            </thead>

                                           

                                        </table>

                                    </div>

								

                               

                                            </div>

                                        </div>

                                    </div>

							<!-- 	<div >

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



            "columnDefs": [



    { "orderable": false, "targets": 0,"targets": 1 }



  ],



                    "processing": true,



                    "serverSide": true,



                    "ajax":{



                        url :"ajax-historylist.php", // json datasource



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

</body>



</html>