

    <section class="page-header page-header-text-light bg-secondary">

      <div class="container">

        <div class="row align-items-center">

          <div class="col-md-8">

            <h1>Login & Signup</h1>

          </div>

          <div class="col-md-4">

            <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">

              <li><a href="<?php echo $mainurl; ?>">Home</a></li>

              <li class="active">Login/Signup</li>

            </ul>

          </div>

        </div>

      </div>

    </section><!-- Page Header end -->

    <?php  if($subid=="success"){ ?>
							<div class="alert alert-success" role="alert">
							  <strong>Error : </strong> Verify your Email and Activate Account , Check your spam folder also.
							</div> 
							<?php } else if($subid=="exist"){ ?>
							<div class="alert alert-danger" role="alert">
							  <strong>Error : </strong> Email already exist
							</div> 
							<?php }  else if($subid=="invalid"){ ?>
							<div class="alert alert-danger" role="alert">
							  <strong>Error : </strong> Invalid username or password
							</div> 
							<?php } ?>

    <div class="container">

      <div id="login-signup-page" class="bg-light shadow-md rounded mx-auto p-4">

        <ul class="nav nav-tabs" role="tablist">

          <li class="nav-item"> <a id="login-page-tab" class="nav-link active text-4" data-toggle="tab" href="#loginPage" role="tab" aria-controls="login" aria-selected="true">Login</a> </li>

          <li class="nav-item"> <a id="signup-page-tab" class="nav-link text-4" data-toggle="tab" href="#signupPage" role="tab" aria-controls="signup" aria-selected="false">Sign Up</a> </li>

        </ul>

        <div class="tab-content pt-4">

          <div class="tab-pane fade show active" id="loginPage" role="tabpanel" aria-labelledby="login-page-tab">

            <form id="loginForm" method="post">

              <div class="form-group">

                <input type="email" class="form-control" id="loginMobile" name="email" required placeholder="Mobile or Email ID">

              </div>

              <div class="form-group">

                <input type="password" class="form-control" id="loginPassword" name="pass" required placeholder="Password">

              </div>

              <div class="row mb-4">

                <div class="col-sm">

                  <div class="form-check custom-control custom-checkbox">

                    <input id="remember-me" name="remember" class="custom-control-input" type="checkbox">

                    <label class="custom-control-label" for="remember-me">Remember Me</label>

                  </div>

                </div>

                <div class="col-sm text-right"> <a class="justify-content-end" href="#">Forgot Password ?</a> </div>

              </div>

              <button class="btn btn-primary btn-block" type="submit" name="login_submit">Login</button>

            </form>

          </div>

          <div class="tab-pane fade" id="signupPage" role="tabpanel" aria-labelledby="signup-page-tab">

            <form id="signupForm" method="post">

              <div class="form-group">

                <input type="text" class="form-control" data-bv-field="number" id="signupEmail" name="email" required placeholder="Email ID">

              </div>

              <div class="form-group">

                <input type="text" class="form-control" id="signupMobile" required placeholder="Mobile Number" name="mobile">

              </div>

              <div class="form-group">

                <input type="password" name="pass" class="form-control" id="signuploginPassword" required placeholder="Password">

              </div>

              <button class="btn btn-primary btn-block" type="submit" name="signup_submit">Signup</button>

            </form>

          </div>

          

        </div>

      </div>

    </div>
