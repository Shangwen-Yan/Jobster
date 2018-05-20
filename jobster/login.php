<?php
session_start();
unset($_SESSION);
session_destroy();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
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
<!--static chart-->
</head>
<body>	
<div class="login-page">
    <div class="login-main">  	
    	 <div class="login-head">
				<h1>Login</h1>
			</div>
			<div class="login-block">
				<form action="login_db.php" method="POST">
                    <select name="cors"> <option value="company">Company</option> <option value="student" selected>Student</option> </select>
                    <p>&nbsp</p>
                    <span style="color: rgba(255,0,0,0.76)"></span>
                    <input type="text" name="email" placeholder="Email" required="">
                    <span></span>
                    <input type="password" name="password" class="lock" placeholder="Password">
					<div class="forgot-top-grids">
						<div class="forgot-grid">
							<ul>
								<li>
									<input type="checkbox" id="brand1" value="">
									<label for="brand1"><span></span>Remember me</label>
								</li>
							</ul>
						</div>
						<div class="forgot">
							<a href="#">Forgot password?</a>
						</div>
						<div class="clearfix"> </div>
					</div>
					<input type="submit" name="submit" value="Login">
					<h3>Not a member?<a href="signup_student.php"> Sign up as student</a> or <a href="signup_company.php"> Sign up as company</a></h3>
					<h2>or login with</h2>
					<div class="login-icons">
						<ul>
							<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>						
						</ul>
					</div>
				</form>
				<h5><a href="index.php">Go Back to Home</a></h5>
			</div>
      </div>
</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
    <p>Copyright &copy; New York University CS6083: Yan Li, Shangwen Yan</p>
</div>
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
if(!isset($_GET['login'])){
    exit();
}else{
    $loginCheck=$_GET['login'];
    if($loginCheck == "empty"){
        echo"<script language=\"JavaScript\"> alert(\" you did not fill in all fields! \")</script>";
        exit();
    }elseif($loginCheck == "error1"){
        echo"<script language=\"JavaScript\"> alert(\" no such user!did you choose student/company correctly? \")</script>";
        exit();
    }elseif($loginCheck == "error2"){
        echo"<script language=\"JavaScript\"> alert(\" wrong pssword! \")</script>";
        exit();
    }elseif($loginCheck == "success0"){
        echo"<script language=\"JavaScript\"> window.location.href =\"index_stu.php\" </script>";

    }elseif($loginCheck == "success1"){
        echo"<script language=\"JavaScript\"> window.location.href =\"index_comp.php\" </script>";

    }
}
?>

                      
						
