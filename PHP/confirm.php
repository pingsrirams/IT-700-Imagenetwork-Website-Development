    <section class="page-header page-header-text-light bg-secondary">

      <div class="container">

        <div class="row align-items-center">

          <div class="col-md-8">

            <h1>Email Verification</h1>

          </div>

          <div class="col-md-4">

            <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">

              <li><a href="<?php echo $mainurl; ?>">Home</a></li>

              <li class="active">Email Verification</li>

            </ul>

          </div>

        </div>

      </div>

    </section><!-- Page Header end -->
    
    

    <div class="container">
    
    <div class="champion-section-area sec-spacer rs-check-out ">
	        <div class="container">
                <div class="row">
 <div class="col-md-8 col-md-offset-2">
						<h2 class="title-bg">Email Verification</h2>
						<div class="check-out-box">
							
							
								
								<?php

									if($subid !='' )
									{
										/*$e = base64_decode($_REQUEST[e]);
										$id = base64_decode($_REQUEST[id]);
										$s = base64_decode($_REQUEST[s]);*/
										$check = mysqli_query($con,"select * from  `user` where `sid`='$subid' and  `status`='Pending' ") or die(mysqli_error($con));
										
$activecheck = mysqli_query($con,"select * from  `user` where `sid`='$subid' and  `status`='Active' ") or die(mysqli_error($con));
										if(mysqli_num_rows($check)>0)
										{
										$update = mysqli_query($con,"update `user` set `status`='Active'  where `sid`='$subid' and  `status`='Pending' ") or die(mysqli_error($con));
										
										if($update){
											echo $fdgdf ="<center><span style='color:#FF0000;'>Email Id Verified Successfully.<br>Please <a href='".$weburl."/login' target='_blank'>Click Here</a> to SignIn.</span></center>";		
										}
										
										}
										else if(mysqli_num_rows($activecheck)>0)
										
										{
								

										echo $fdgdf ="<center><span style='color:#FF0000;'>Email Id verified already. <br>Please <a href='".$weburl."/login' target='_blank'>Click Here</a> to SignIn.</span></center>";

										}
										else

										{

											

										echo $fdgdf ="<center><span style='color:#FF0000;'>Email Id Verified Failed.</span>.<br>Please <a href='".$weburl."/login' target='_blank'>Click Here</a> to try again.</center>";

											

										}

										}


													?>
								
								
								
						</div>						
								
					</div>
                   
                </div>
			</div>
        </div>

      

    </div>
