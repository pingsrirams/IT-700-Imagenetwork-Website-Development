<?php
if(isset($_SESSION['userid'])) {

}else{
    divert($mainurl.'login');
}



if(isset($_REQUEST['support_ticket_submit'])) {
    $datetime = date("Y-m-d h:i:s");
    mysqli_query($con,"INSERT INTO `support_ticket` (`id`, `user_id`, `order_id`, `subject`,  `descp`,  `status`, `date_time`) VALUES (NULL, '$_SESSION[userid]', '$_REQUEST[order_id]','$_REQUEST[subject]','$_REQUEST[descp]', '1','$datetime');")or die(mysqli_error($con));
    $ticket_id = mysqli_insert_id($con);
    mysqli_query($con,"INSERT INTO `ticket_user` (`id`, `user_id`, `ticket_id`, `message`, `status`, `date_time`) VALUES (NULL, '$_SESSION[userid]', '$ticket_id','$_REQUEST[descp]', '1','$datetime');")or die(mysqli_error($con));

    divert($mainurl.'support/submitted');

}


?>

	<!-- Page Header

    ============================================= -->

    <section class="page-header page-header-text-light bg-secondary">

      <div class="container">

        <div class="row align-items-center">

          <div class="col-md-8">

            <h1>Support</h1>

          </div>

          <div class="col-md-4">

            <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">

              <li><a href="<?php echo $mainurl; ?>">Home</a></li>

              <li class="active">Support</li>

            </ul>

          </div>

        </div>

      </div>

    </section><!-- Page Header end -->

    

  <!-- Content

  ============================================= -->
  <?php  if($subid=="submitted"){ ?>
                            <div class="alert alert-success" role="alert">
                              <strong>Success : </strong>Request sent Successfully.
                            </div> 
    <?php } ?>

  <div id="content">

    <div class="container">

      <div class="row">

        <div class="col-lg-12">

          <div class="bg-light shadow-md rounded p-4">

            <h2 class="text-6">Send a Request</h2>

            <p>Please fill out the form below and we promise you to get back to you within a couple of hours.</p>

            <form id="recharge-bill" method="post">

              <div class="row">

              

            <!--   <div class="form-group  col-md-6">

                <input type="text" class="form-control" id="yourName" value="<?php echo $userinfo['name']; ?>" required placeholder="Enter Your Name" name="name">

              </div>

              <div class="form-group  col-md-6">

                <input type="email" name="email" class="form-control" id="yourEmail" required placeholder="Enter Email Id">

              </div> -->

              <div class="form-group  col-md-6">

                <input type="text" name="subject" class="form-control" data-bv-field="text" id="subject" required placeholder="Enter Subject">

              </div>

			  <div class="form-group  col-md-6">

                <input type="text" name="order_id" class="form-control" data-bv-field="number" id="" required placeholder="Enter Order Number">

              </div>

              <div class="form-group  col-md-12">

                <textarea class="form-control" rows="5" name="descp" id="yourProblem" required placeholder="Specify your problem"></textarea>

              </div>

              </div>

              <button class="btn btn-primary" type="submit" name="support_ticket_submit" >Submit</button>

            </form>

          </div>

        </div>

        

      </div>

    </div>

  </div><!-- Content end -->
