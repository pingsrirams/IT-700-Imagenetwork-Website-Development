  <!-- Header

  ============================================= -->

  <header id="header">

    <div class="container">

      <div class="header-row">

        <div class="header-column justify-content-start"> 

          

          <!-- Logo

          ============================================= -->

          <div class="logo">

          	<a href="<?php echo $mainurl; ?>" title="Image Network"><img src="images/logo.png" alt="Image Network" width="" height="" /></a>

          </div><!-- Logo end -->

          

        </div>

        

        <div class="header-column justify-content-end">

        

          <!-- Primary Navigation

          ============================================= -->

          <nav class="primary-menu navbar navbar-expand-lg">

            <div id="header-nav" class="collapse navbar-collapse">

              <ul class="navbar-nav">

			  <li class="active"> <a class="" href="<?php echo $mainurl; ?>">Home</a></li>

			  <li class=""> <a class="" href="<?php echo $mainurl; ?>newconnection">New Connection</a></li>

			  <li class=""> <a class="" href="<?php echo $mainurl; ?>hd">HD</a></li>

			  <!--<li class=""> <a class="" href="<?php echo $mainurl; ?>channelspacks">Packs &amp; Channels</a></li>-->



			  <li class=""> <a class="" href="<?php echo $mainurl; ?><?php if ($_SESSION['userinfo']!=""
			  ){ echo "support"; } else {  echo "profile"; }   ?>">Support</a></li>
              
              <?php if ($_SESSION['userinfo']!=""){   ?>
              
              <li class=""> <a class="" href="<?php echo $mainurl; ?>profile"> Profile&nbsp;<span class="d-none d-lg-inline-block">  <i class="fas fa-user"></i></span></a></li>
              <li class="login-signup ml-lg-2"><a class="pl-lg-4 pr-0" href="<?php echo $mainurl; ?>logout.php" title="Logout">Logout </a></li>
              <?php } else { ?>

              <li class="login-signup ml-lg-2"><a class="pl-lg-4 pr-0" href="<?php echo $mainurl; ?>login" title="Login / Sign up">Login / Sign up </a></li>
  <?php } ?>

              </ul>

            </div>

          </nav><!-- Primary Navigation end --> 

          

        </div>

        

        <!-- Collapse Button

        ============================================= -->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav"> <span></span> <span></span> <span></span> </button>

      </div>

    </div>

  </header><!-- Header end -->
