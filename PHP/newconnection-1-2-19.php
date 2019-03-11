<?php 
session_start();

if(isset($_REQUEST['step1_submit'])) {
    $_SESSION['mode'] = $_REQUEST['mode'];
    $_SESSION['pack'] = $_REQUEST['pack'];
    $_SESSION['validity'] = $_REQUEST['validity'];

}
?>
  <!-- Header end -->

  <!-- Page Header

    ============================================= -->

    <section class="page-header page-header-text-light bg-secondary">

      <div class="container">

        <div class="row align-items-center">

          <div class="col-md-8">

            <h1>New Connection</h1>

          </div>

          <div class="col-md-4">

            <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">

              <li><a href="<?php echo $mainurl; ?>">Home</a></li>

              <li class="active">New Connection</li>

            </ul>

          </div>

        </div>

      </div>

    </section><!-- Page Header end -->

    

<div class="container">

      <div class="bg-light shadow-md rounded p-4">

        <h2 class="text-9 font-weight-600 my-4 text-center">Get Your Connection in<br class="d-none d-lg-inline-block" />

              <span class="text-danger ">3 Simple Steps</span></h2>

			  <section>

        <form class="form cf">

                    <div class="wizard">

                        <div class="wizard-inner">

                            <div class="connecting-line"></div>

                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="nav-item">

                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Choose your Subscription" class="nav-link <?=(isset($_SESSION[mode]))?'':'active'?>"><span class="round-tab">1</span></a>
								</li>

                                <li role="presentation" class="nav-item">

                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Select Package" class="nav-link <?=(isset($_SESSION[mode]))?'active':''?>">

                                <span class="round-tab">2</span>

                            </a>

                                </li>

                                <li role="presentation" class="nav-item">

                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Fill your Details" class="nav-link ">

                               <span class="round-tab">3</span>

                            </a>

                                </li>
								

                                

                            </ul>

                        </div>



                        <div class="tab-content text-center">

                            <div class="tab-pane <?=(isset($_SESSION[mode]))?'':'active'?> text-center" role="tabpanel" id="step1">

                                <h3 class="text-md-center text-primary">Choose your Connection Mode</h3>

                                <div class="">

								
								<form method="post ">

								  <div class="mb-4 mt-4 ">
            

									

								  

								  


     <?php 
                               $product_str = '';
                            $product_result = mysqli_query($con,"select * from `modes` ");
                         while($product = mysqli_fetch_array($product_result)) {
                        ?>
                    
                       
                                    <div class="custom-control custom-radio custom-control-inline">

                                      <input id="mode_<?=$product[id]?>" name="mode" class="custom-control-input" required type="radio" <?=($_SESSION[mode] == $product[id] )?'checked':''?>/>

                                      <label class="custom-control-label" for="mode_<?=$product[id]?>"><?=$product['name']?></label>

                                    </div>
                         <?php } ?>




</div>



								  

								  

								</form>



                                </div>

                                <ul class="list-inline text-md-center">

                                    <li><button type="button" style="" class="btn btn-primary next-step next-button">Get Started Now</button></li>

                                </ul>

                            </div>

                            <div class="tab-pane <?=(isset($_SESSION[mode]))?'active':''?>" role="tabpanel" id="step2">

                                <h3 class="text-md-center text-primary">Select Package</h3>

                                <div class="">

                                   <form class="form-row mb-4 mb-sm-2" method="post">

          

         

		  <div class="col-12 col-sm-6 col-lg-4">

            <div class="form-group">

              <select class="custom-select" required="">

                <option value="">Select Your Pack</option>

                 <?php 
                               $product_str = '';
                            $product_result = mysqli_query($con,"select * from `packs` ");
                         while($product = mysqli_fetch_array($product_result)) {
                        ?>
                     
                        <option <?=($_SESSION[mode] == $product[id] )?'selected':''?> value="<?=$product[id]?>"><?=$product['name']?></option>
                        <?php } ?>

                

              </select>

            </div>

          </div>

          <div class="col-12 col-sm-6 col-lg-4">

            <div class="form-group">

              <select class="custom-select" name="validity" required="">

                <option value="">Validity</option>

               <option value="1">1 Month</option>
                  <option value="3">6 Month</option>
                  <option value="12">1 Year</option>

                

              </select>

            </div>

          </div>

          <div class="col-12 col-sm-6 col-lg-4">

            <button class="btn btn-primary btn-block" type="submit">View Plans</button>

          </div>

        </form>

		<div class="plans page">

           <div class="table-responsive-md">

            <table class="table table-hover border">

              <tbody>



 <?php 
                               $product_str = '';
                            $product_result = mysqli_query($con,"select * from `packs` ");
                         while($product = mysqli_fetch_array($product_result)) {


                             $product2_result = mysqli_query($con,"select * from `packages`  where   `packs_id` = '$product[id]' ");
                             $product2 = mysqli_fetch_array($product2_result);
                             if(mysqli_num_rows($product2_result)>0) {
                        ?>
                    
                       
                <tr>

                  <td class="text-5 text-primary text-center align-middle">$<?=$product2['amount']?> <span class="text-1 text-muted d-block">Amount</span></td>

                  <td class="text-3 text-center align-middle"><?=$product2['channels']?>+ <span class="text-1 text-muted d-block">Channels</span></td>

                  <td class="text-3 text-center align-middle"><?=$product2['validlity']?> Month <span class="text-1 text-muted d-block">Validity</span></td>

                  <td class="align-middle"><button class="btn btn-sm btn-outline-primary shadow-none" type="submit">Select</button></td>

                </tr>

                
                 <?php } } ?>

              </tbody>

            </table>

          </div>

        </div>

      



                                </div>

                                <ul class="list-inline text-md-center">

                                    <li><button type="button" class="btn btn-primary next-step next-button">Next Step</button></li>

                                </ul>

                            </div>

                            <div class="tab-pane" role="tabpanel" id="step3">

                                <h3 class="text-md-center text-primary" >Fill your Details</h3>

                                <div class="row">

                                    <form id="recharge-bill" method="post">

              <div class="row">

              

              <div class="form-group  col-md-6">

                <input type="text" class="form-control"  required="" placeholder="Enter Your Name" />

              </div>

              <div class="form-group  col-md-6">

                <input type="email" class="form-control"  required="" placeholder="Enter Email Id" />

              </div>

              <div class="form-group  col-md-6">

                <input type="text" class="form-control" required placeholder="Enter Mobile Number" />

              </div>

			  <div class="form-group  col-md-6">

                <input type="date" class="form-control" required placeholder="Date to Install" />

				<small class="calender_info">

                                                    Preferred date - Mention ideal date for SunDirect DTH installation in your home.                                                    

                                            </small>

              </div>

			  

              <div class="form-group  col-md-12">

                <textarea class="form-control" rows="2" id="yourProblem" required placeholder="Full Address"></textarea>

              </div>

			  <div class="form-group  col-md-12">

			  <label for="agree" class="checkbox-custom-label"><input name="agree" type="checkbox" tabindex="12" checked="" />I agree to the SunDirect Terms of Services</label>

              </div>

              </div>

              <button class="btn btn-primary" type="submit">Submit</button>

            </form>

                                </div>

                                

                            </div>

                            


                            

                            <div class="clearfix"></div>

                        </div>



                    </div>

                

	</section>

	  </div>

    </div>
    
    <script src="vendor/jquery/jquery.min.js"></script>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="vendor/owl.carousel/owl.carousel.min.js"></script> 

<script src="js/theme.js"></script> 

<script type="text/javascript">

 //Initialize tooltips

 $('.nav-tabs > li a[title]').tooltip();



 //Wizard

 $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {



     var $target = $(e.target);



     if ($target.hasClass('disabled')) {

         return false;

     }

 });



 $(".next-step").click(function (e) {

     var $active = $('.wizard .nav-tabs .nav-item .active');

     var $activeli = $active.parent("li");



     $($activeli).next().find('a[data-toggle="tab"]').removeClass("disabled");

     $($activeli).next().find('a[data-toggle="tab"]').click();

 });





 $(".prev-step").click(function (e) {



     var $active = $('.wizard .nav-tabs .nav-item .active');

     var $activeli = $active.parent("li");



     $($activeli).prev().find('a[data-toggle="tab"]').removeClass("disabled");

     $($activeli).prev().find('a[data-toggle="tab"]').click();



 });



</script>