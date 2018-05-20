<!DOCTYPE HTML>
<html>
<head>
<title>Signup</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="js/jquery-2.1.1.min.js"></script> 
<!--icons-css-->
<link href="css/font-awesome.css" rel="stylesheet">
<!--Google Fonts-->
<link href='https://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
<!--//charts-->
</head>
<body>	
<!--inner block start here-->
<div class="signup-page-main">
     <div class="signup-main">  	
    	 <div class="signup-head">
				<h1>Sign Up as Company</h1>
			</div>
			<div class="signup-block">
				<form action="signup_comp_db.php" method="POST">
                    <input type="text" name="email" placeholder="Email" required="">
                    <input type="text" name="cname" placeholder="Company's Name">
                    <input type="password" name="pswd" placeholder="Password">
                    <input type="password" name="pswd2" placeholder="Confirm Password">
                    <input type="text" name="phone" placeholder="Phone Number">
                    <input type="text" name="location" placeholder="Company's Address">
                    <input type="text" name="magnitude" placeholder="Company's Magnitude">
                    <input type="text" name="industry" placeholder="Industry">
					<div class="forgot-top-grids">
						<div class="forgot-grid">
							<ul>
								<li>
									<input type="checkbox" id="brand1" value="">
									<label for="brand1"><span></span>I agree to the terms</label>
								</li>
							</ul>
						</div>
						
						<div class="clearfix"> </div>
					</div>
					<input type="submit" name="submit" value="Sign up">
				</form>
				<div class="sign-down">
				<h4>Already have an account? <a href="login.php"> Login here.</a></h4>
				  <h5><a href="index.php">Go Back to Home</a></h5>
				</div>
			</div>
    </div>
</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
    <p>Copyright &copy; New York University CS6083: Yan Li, Shangwen Yan</p></div>
<!--COPY rights end here-->
<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>

<?php
    if(!isset($_GET['signup2'])){
        exit();
    }else{
        $signupCheck=$_GET['signup2'];
        if($signupCheck == "empty"){
            echo"<script language=\"JavaScript\"> alert(\" you did not fill in all fields! \")</script>";
            exit();
        }elseif($signupCheck == "format"){
            echo"<script language=\"JavaScript\"> alert(\" invalid email format! \")</script>";
            exit();
        }elseif($signupCheck == "password2"){
            echo"<script language=\"JavaScript\"> alert(\"your two passwords are not consistent! \")</script>";
            exit();
        }elseif($signupCheck == "emailtwice"){
            echo"<script language=\"JavaScript\"> alert(\" this email has been used! \")</script>";
            exit();
        }elseif($signupCheck == "success"){
            echo"<script language=\"JavaScript\"> alert(\" you have signed up successfully! \");window.location.href =\"login.php\" </script>";

            exit();
        }
    }
?>
                      
						
