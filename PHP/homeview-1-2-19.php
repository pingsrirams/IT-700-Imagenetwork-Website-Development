

    <section class="container">

      <div class="bg-light shadow-md rounded p-4" style="margin-top: 20px;">

        <div class="row">

        

          <!-- Mobile Recharge

          ============================================= -->

          <div class="col-lg-4 mb-4 mb-lg-0">

            <h2 class="text-4 mb-3">New Subscription</h2>

            <form  method="post" action="<?=$baseurl.'newconnection'?>">

              

              <div class="form-group">

                <select class="custom-select" name="mode" required="">
                  <option value="">Select Your Mode</option>>
                        <?php 
                               $product_str = '';
                            $product_result = mysqli_query($con,"select * from `modes` ");
                         while($product = mysqli_fetch_array($product_result)) {
                        ?>
                     
                        <option value="<?=$product[id]?>"><?=$product['name']?></option>
                        <?php } ?>
                </select>

              </div>
			  
			  <div class="form-group">

                <select class="custom-select" name="pack" required="">
                  <option value="">Select Pack Details</option>
                  <?php 
                        $product_str = '';
                            $product_result = mysqli_query($con,"select * from `packs` ");
                         while($product = mysqli_fetch_array($product_result)) {
                        ?>
                     
                        <option value="<?=$product[id]?>"><?=$product['name']?></option>
                        <?php } ?>
                  
                </select>

              </div>
			  
			  <div class="form-group">

                <select class="custom-select" name="validity" required="">
                  <option value="">Select Validity</option>
                  <option value="1">1 Month</option>
                  <option value="3">6 Month</option>
                  <option value="12">1 Year</option>
                </select>

              </div>


              <button class="btn btn-primary btn-block" name="step1_submit" type="submit">Buy New Connection</button>

            </form>

          </div><!-- Mobile Recharge end -->

          

          <!-- Slideshow

          ============================================= -->

          <div class="col-lg-8">

            <div class="owl-carousel owl-theme slideshow single-slider">

              <div class="item"><a href="#"><img class="img-fluid" src="images/slider/banner-1.jpg" alt="banner 1" /></a></div>

              <div class="item"><a href="#"><img class="img-fluid" src="images/slider/banner-2.jpg" alt="banner 2" /></a></div>

            </div>

          </div><!-- Slideshow end -->

          

        </div>

      </div>

    </section>

    

    <!-- Tabs

    ============================================= -->

    <div class="section pt-4 pb-3">

      <div class="container">

	  <h2 class="text-9 font-weight-600 text-center text-primary">Value added subscriptions</h2>

        <ul class="nav nav-tabs" id="myTab" role="tablist">

          <li class="nav-item"> <a class="nav-link active" id="mobile-recharge-tab" data-toggle="tab" href="#mobile-recharge" role="tab"  aria-selected="true">SD + </a> </li>

          <li class="nav-item"> <a class="nav-link" id="billpayment-tab" data-toggle="tab" href="#billpayment" role="tab" aria-selected="false">HD + </a> </li>

          

		  <li class="nav-item"> <a class="nav-link" id="upgrade-tab" data-toggle="tab" href="#upgrad_e" role="tab" aria-selected="false">Upgrade</a> </li>

        </ul>

        <div class="tab-content my-3" id="myTabContent">

          <div class="tab-pane fade show active" id="mobile-recharge" role="tabpanel" aria-labelledby="mobile-recharge-tab">

           

			<div class="row">

          <div class="col-lg-6 text-center"> <img class="img-fluid" alt="" src="images/hd.png"> </div>

          <div class="col-lg-6 text-center text-lg-left">

            <h2 class="text-9 font-weight-600 my-4">Starts from<br class="d-none d-lg-inline-block">

              <span class="text-danger">$1990</span></h2>

            <ul class="lead">

					<li>PVR with external capacity of 32 GB</li>

					<li>MPEG 4 technology</li>

					<li>Multi Audio selection</li>

				</ul>

            

			<a href="#" class="btn btn-outline-primary">Get Now</a>

          </div>

        </div>

			

            </div>

          <div class="tab-pane fade" id="billpayment" role="tabpanel" aria-labelledby="billpayment-tab">

           <div class="row">

          <div class="col-lg-6 text-center"> <img class="img-fluid" alt="" src="images/hd.png"> </div>

          <div class="col-lg-6 text-center text-lg-left">

            <h2 class="text-9 font-weight-600 my-4">Starts from<br class="d-none d-lg-inline-block">

              <span class="text-danger">$1790</span></h2>

            <ul class="lead">

					<li>PVR with external capacity of 1 TB</li>

					<li>Digital Dolby surround sound</li>

					<li>HEVC technology</li>

					<li>1080i picture resolution</li>

					<li>16:9 wide aspect ratio</li>

				</ul>

            

			<a href="#" class="btn btn-outline-primary">Get Now</a>

          </div>

        </div>

          </div>

          <div class="tab-pane fade" id="upgrad_e" role="tabpanel" aria-labelledby="upgrade-tab">

            <div class="row">

          <div class="col-lg-6 text-center"> <img class="img-fluid" alt="" src="images/upgrade.png"> </div>

          <div class="col-lg-6 text-center text-lg-left">

            <h2 class="text-9 font-weight-600 my-4">Starts from<br class="d-none d-lg-inline-block">

              <span class="text-danger">$499</span></h2>

            <p class="lead">

					Now Image Network subscribers can upgrade old Set Top Box to latest one

				</p>

            

			<a href="#" class="btn btn-outline-primary">Get Now</a>

          </div>

        </div>

          </div>

        </div>

      </div>

    </div><!-- Tabs end -->

    

	<!-- Banner

    ============================================= -->

    <div class="bg-light shadow-md py-5">

      <div class="container">

        <div class="owl-carousel owl-theme banner">

          <div class="item"><a href="#"><img class="img-fluid rounded" src="images/slider/ezgif.com-gif-to-webp.webp" alt="banner" /></a></div>

          <div class="item"><a href="#"><img class="img-fluid rounded" src="images/slider/ezgif.com-gif-to-webp 1.webp" alt="banner" /></a></div>

          <div class="item"><a href="#"><img class="img-fluid rounded" src="images/slider/ezgif.com-gif-to-webp 2.webp" alt="banner" /></a></div>

        </div>

      </div>

    </div><!-- Banner end -->

	

	

	

	

	

   <!-- Mobile App

    ============================================= -->

    <section class="section pb-0">

      <div class="container">

        <div class="row">

          <div class="col-md-5 col-lg-6 text-center"> <img class="img-fluid" alt="" src="images/app-mobile.png"> </div>

          <div class="col-md-7 col-lg-6">

            <h2 class="text-9 font-weight-600 my-4">Download Our <span class="text-danger">Image Network</span><br class="d-none d-lg-inline-block">

              Mobile App Now</h2>

            <p class="lead">Download our app for the fastest, most convenient way to send Recharge.</p>

            

            <ul>

              <li>Recharge your account</li>

              <li>Upgrade and change packs</li>

              <li>Call centre support</li>

              

            </ul>

            <div class="d-flex flex-wrap pt-2"> <a class="mr-4" href=""><img alt="" src="images/app-store.png"></a><a href=""><img alt="" src="images/google-play-store.png"></a> </div>

          </div>

        </div>

      </div>

    </section><!-- Mobile App end -->

     

    
