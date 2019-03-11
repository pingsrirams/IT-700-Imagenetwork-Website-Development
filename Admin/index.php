<?php 

include "include/shi-config.php";

include "include/functions.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $sitename; ?></title>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    
    <!-- Retina iPad Touch Icon-->
   
    <!-- Retina iPhone Touch Icon-->
    
    <!-- Standard iPad Touch Icon-->
    
    <!-- Standard iPhone Touch Icon-->
	
	<base href="<?php echo $url; ?>">
    

    <!-- Styles -->
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/unix.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-primary">

    <div class="unix-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="javascript:void(0);"><span><?php echo $sitename; ?></span></a>
                        </div>
                        <div class="login-form">
                            <h4>Dashboard Login</h4>
                                <form action="check.php" method="post">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" class="form-control" placeholder="Email" name="e_email" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="e_pass"  required>
                                </div>
                               <!--  <div class="checkbox">
                                    <label>
										<input type="checkbox"> Remember Me
									</label>
                                    <label class="pull-right">
										<a href="#">Forgotten Password?</a>
									</label>

                                </div> -->
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
                              
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>