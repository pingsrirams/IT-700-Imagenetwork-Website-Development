	<!-- Page Header

    ============================================= -->

    <section class="page-header page-header-text-light bg-secondary">

      <div class="container">

        <div class="row align-items-center">

          <div class="col-md-8">

            <h1>My Profile</h1>

          </div>

          <div class="col-md-4">

            <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">

              <li><a href="<?php echo $mainurl; ?>">Home</a></li>

              <li class="active">My Profile</li>

            </ul>

          </div>

        </div>

      </div>

    </section><!-- Page Header end -->

    <?php  if($subid=="success"){ ?>
							<div class="alert alert-success" role="alert">
							  <strong>Success : </strong> Welcome to Profile.
							</div> 
	<?php } else if($subid=="updated"){ ?>
							<div class="alert alert-success" role="alert">
							  <strong>Success : </strong> Updated Succesfully
							</div> 
	<?php }  else if($subid=="failed"){ ?>
							<div class="alert alert-danger" role="alert">
							  <strong>Error : </strong> Failed Invalid Details, Try again
							</div> 
	<?php } ?>

  <!-- Content

  ============================================= -->

  <div id="content">

    <div class="container">

      <div class="bg-light shadow-md rounded p-4">

        <div class="row">

          <div class="col-md-3">

            <ul class="nav nav-tabs flex-column" id="myTab" role="tablist">

              <li class="nav-item"> <a class="nav-link active" id="first-tab" data-toggle="tab" href="#firstTab" role="tab" aria-controls="firstTab" aria-selected="true">Personal Information</a> </li>

              <li class="nav-item"> <a class="nav-link" id="second-tab" data-toggle="tab" href="#secondTab" role="tab" aria-controls="secondTab" aria-selected="false">Change Password</a> </li>

              <li class="nav-item"> <a class="nav-link" id="third-tab" data-toggle="tab" href="#thirdTab" role="tab" aria-controls="thirdTab" aria-selected="false">Order</a> </li>

              <li class="nav-item"> <a class="nav-link" id="fourth-tab" data-toggle="tab" href="#fourthTab" role="tab" aria-controls="fourthTab" aria-selected="false">Support</a> </li>

            </ul>

          </div>

          <div class="col-md-9">

            <div class="tab-content my-3" id="myTabContentVertical">

              <div class="tab-pane fade show active" id="firstTab" role="tabpanel" aria-labelledby="first-tab">

                <div class="row">

                  <div class="col-lg-12">

                    <h4 class="mb-4">Personal Information</h4>

                    <form id="personalInformation" method="post">

                      <div class="mb-3">

                        <div class="custom-control custom-radio custom-control-inline">

                          <input id="male" name="gender" class="custom-control-input" <?php if($userinfo['gender']=="Male"){ echo "checked"; } else {}?> required type="radio" value="Male">

                          <label class="custom-control-label" for="male">Male</label>

                        </div>

                        <div class="custom-control custom-radio custom-control-inline">

                          <input id="female" name="gender" class="custom-control-input" <?php if($userinfo['gender']=="Female"){ echo "checked"; } else {}?> required value="Female" type="radio">

                          <label class="custom-control-label" for="female">Female</label>

                        </div>

                      </div>

                      <div class="form-group">

                        <label for="fullName">Full Name</label>

                        <input type="text" value="<?php echo $userinfo['name']; ?>" class="form-control" data-bv-field="fullName" id="fullName" name="name" required placeholder="Full Name">

                      </div>

                      <div class="form-group">

                        <label for="mobileNumber">Mobile Number</label>

                        <input type="text" value="<?php echo $userinfo['mobile']; ?>" class="form-control" data-bv-field="mobilenumber" id="mobileNumber" name="mobile" required placeholder="Mobile Number">

                      </div>

                      <div class="form-group">

                        <label for="emailID">Email ID</label>

                        <input type="text" value="<?php echo $userinfo['email']; ?>" class="form-control" data-bv-field="emailid" id="emailID" name="email" required placeholder="Email ID">

                      </div>

                      <div class="form-group">

                        <label for="birthDate">Date of Birth</label>

                        <input id="birthDate" type="date" value="<?php echo $userinfo['dob']; ?>"  class="form-control" required placeholder="Date of Birth" name="dob">

                      </div>

                      <div class="form-group">

                        <label for="inputCountry">Country</label>

                        
                        <input id="country" value="<?php echo $userinfo['country']; ?>" type="text" class="form-control" required placeholder="Country Name" name="country">
   <input id="editid" value="<?php echo $userinfo['id']; ?>" type="hidden" class="form-control" required  name="editid">
                      </div>


                      <div class="form-group">

                        <label for="inputCountry">Address</label>
                        <input id="address" value="<?php echo $userinfo['address']; ?>" type="text" class="form-control" required placeholder="Address" name="address">
                      </div>

                      <button class="btn btn-primary" type="submit" name="update_profile" >Update Now</button>

                    </form>

                  </div>

                 

                </div>

              </div>

              <div class="tab-pane fade" id="secondTab" role="tabpanel" aria-labelledby="second-tab">

                <div class="row">

                  <div class="col-lg-8">

                    <h4 class="mb-4">Change Password</h4>

                    <form id="changePassword" method="post">

                      <div class="form-group">

                        <input type="text"  class="form-control" data-bv-field="existingpassword" id="existingPassword" name="expass" required placeholder="Existing Password">

                      </div>

                      <div class="form-group">

                        <input type="text" class="form-control"  data-bv-field="newpassword" id="newPassword" name="pass" required placeholder="New Password">

                      </div>

                      <div class="form-group">

                        <input type="text" class="form-control"   data-bv-field="confirmgpassword" id="confirmPassword" required placeholder="Confirm Password" name="cpass">

                        <input id="editid" value="<?php echo $userinfo['id']; ?>" type="hidden" class="form-control" required="required"  name="editid_c" />
                      </div>

                      <button class="btn btn-primary" type="submit" name="change_pass">Update Password</button>

                    </form>

                  </div>

                  <div class="col-lg-4 mt-4 mt-lg-0 ">

                    <div class="card bg-light-3 p-3">

                      <p class="mb-2">We value your Privacy.</p>

                      <p class="text-1 mb-0">We will not sell or distribute your contact information. Read our <a href="#">Privacy Policy</a>.</p>

                      <hr>

                      <p class="mb-2">Billing Enquiries</p>

                      <p class="text-1 mb-0">Do not hesitate to reach our <a href="#">support team</a> if you have any queries.</p>

                    </div>

                  </div>

                </div>

              </div>

              <div class="tab-pane fade" id="thirdTab" role="tabpanel" aria-labelledby="third-tab">

                <h4 class="mb-4">Your Order Status</h4>

                <div class="table-responsive-md">

              <table class="table table-hover border">

                <thead class="thead-light">

                  <tr>

                    <th>Date</th>
                    <th>Mode</th>

                    <th>Pack</th>

                     <th>Channels</th>

                    <th>Order ID</th>

                    <th class="text-center">Status</th>

                    <th class="text-right">Amount</th>

                    

                  </tr>

                </thead>

                <tbody>
                    <?php $result  = select_query($con, user_package, "","`user_id`='$_SESSION[userid]' ","","");
                            foreach($result['result'] as $user_package){
                               $result =  select_query($con, packages, "","`id`='$user_package[package_id]' ","","");
                                foreach($result['result'] as $package){}

                                $result = select_query($con, packs, "","`id`='$package[packs_id]' ","","");
                                foreach($result['result'] as $pack){}

                                	 $result = select_query($con, modes, "","`id`='$package[mode_id]' ","","");
                                foreach($result['result'] as $mode){}
    ?>

                  <tr>

                    <td class="align-middle"><?=date('d/m/Y',strtotime($user_package['date_time']))?></td>

                       <td class="align-middle"><span class="text-1 d-inline-flex"><?=$pack['name']?></span></td>

                    <td class="align-middle"><span class="text-1 d-inline-flex"><?=$mode['name']?></span></td>

                     <td class="align-middle"><span class="text-1 d-inline-flex"><?='+'.$package['channels']?></span></td>

                    <td class="align-middle"><?=$user_package['order_id']?></td>

                    <td class="align-middle text-center"><i class="fas fa-check-circle text-4 <?=($user_package[status] == 'Active' )?'text-success':'text-danger'?>" data-toggle="tooltip" data-original-title="<?=($user_package[status] == 'InActive' )?'Your order is Successful':'Your order is Expired'?>"></i></td>

                    <td class="align-middle text-right">$<?=$package['amount']?></td>

                    

                  </tr>
              <?php 
                } ?>


               

                </table>

                </div>

            </div>
                          <div class="tab-pane fade" id="fourthTab" role="tabpanel" aria-labelledby="fourth-tab">

                <h4 class="mb-4">Support Tickets</h4>

                <div class="table-responsive-md">

              <table class="table table-hover border">

                <thead class="thead-light">

                  <tr>

                    <th>Date</th>

                    <th>Order ID</th>

                    <th>Description</th>

                    <th class="text-center">Status</th>

                    <th class="text-right">Action</th>

                    

                  </tr>

                </thead>

                <tbody>
                    <?php $result  = select_query($con, support_ticket, "","`user_id`='$_SESSION[userid]' ","","");
                            foreach($result['result'] as $ticket){
                              
    ?>

                  <tr>

                    <td class="align-middle"><?=date('d/m/Y',strtotime($ticket['date_time']))?></td>

                    <td class="align-middle"><?=$ticket['id']?></td>

                     <td class="align-middle text-right"><?=$ticket['descp']?></td>

                    <td class="align-middle text-center"><i class="fas fa-check-circle text-4 <?=($ticket[status] == 1 )?'text-success':'text-danger'?>" data-toggle="tooltip" data-original-title="<?=($ticket[status] == 1 )?'Your Request is Processed':'Your Request is not Processed'?>"></i></td>
                     <td class="align-middle text-right"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ticket_status_action" onclick="ticket(<?=$ticket['id']?>);"><i class="fa fa-edit"></i></button>
                   

                    

                  </tr>
              <?php 
                } ?>


               

              </table>

            </div>

          </div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div><!-- Content end -->
  <script type="text/javascript">
    function ticket(id) {
        $.ajax({
            type : 'post',
            url: 'includes/ajax/ajax-ticket.php',
            data : 'action=getticket&&id='+id,
            success:function(res){
               $('#ticket_status_action .modal-title').text('Ticket Id - '+id)
               $('#ticket_status_action input[name="ticket_id"]').val(id)
               $('#ticket_status_action .chat').html(res);
            }
        })
    }
     function send() {
        id = $('input[name="ticket_id"]').val();
        message = $('input[name="message"]').val();

        $.ajax({
            type : 'post',
            url: 'includes/ajax/ajax-ticket.php',
            data : 'action=send&id='+id+'&message='+message,
            success:function(res){
                  $('#ticket_status_action .chat').html(res);
                  $('input[name="message"]').val('');
            }
        })
    }
  </script>

