<?php 

include "include/shi-config.php";

include "include/functions.php";

 

// 

 if(isset($_SESSION['userfirstname']))

	 

	 {

    

	 

	 }

	 

	 

	 else

    {

    // header('Location: '.$url.'/index.php');

   divert($url.'index.php');

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
                                <h1> <span> Welcome</span> Image Network </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="javascript:void(0);">Dashboard</a></li>
                                    <li class="active">Home</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
				<?php
				if($_SESSION['Power']=='SuperAdmin')
				{
				?>
                <!-- /# row -->
                <div id="main-content" style="display:none;">
                    <div class="row min_hght">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="ti-bag f-s-22 color-primary border-primary round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4>1278</h4>
                                        <h6>Registered User</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="ti-bar-chart f-s-22 color-warning border-warning round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4>1599</h4>
                                        <h6>Registered HR</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="ti-comment f-s-22 color-success border-success round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4>68748</h4>
                                        <h6>SMS Scheduled</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="ti-location-pin f-s-22 border-danger color-danger round-widget"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h4>689</h4>
                                        <h6>Email Scheduled</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
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
				<?php
				}
				?>
				
				
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
    <script src="assets/js/scripts.js"></script>
</body>

</html>