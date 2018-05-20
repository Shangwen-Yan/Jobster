<?php

session_start();

if(isset($_POST['submit'])){
	include 'connect.php';

	$email=mysqli_real_escape_string($con,$_POST['email']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$cors=mysqli_real_escape_string($con,$_POST['cors']);

	if(empty($email) || empty($password) ||empty($cors)){
		header("Location: login.php?login=empty");
		exit();
	}elseif ($cors=="student") {
		
		$sql="SELECT * FROM student WHERE email='".$email."'";
		$result=mysqli_query($con,$sql);
		$resultcheck=mysqli_num_rows($result);
		if($resultcheck<1){
			header("Location: login.php?login=error1");
			exit();
		}else{
			if($row=mysqli_fetch_assoc($result)){
				if($password!=$row['pswd']){
					header("Location:login.php?login=error2");
					exit();
				}elseif ($password==$row['pswd']){
					$_SESSION['email']=$row['email'];
					$_SESSION['phone']=$row['phone'];
					$_SESSION['sname']=$row['sname'];
					$_SESSION['sid']=$row['sid'];
                    $_SESSION['logintype']=0;
					//header("Location: login.php?login=success0");
                    header("Location: index_stu.php");
					exit();
				}
			}
		}
	}elseif ($cors=="company") {

		$sql="SELECT * FROM company WHERE email='$email'";
		$result=mysqli_query($con,$sql);
		$resultcheck=mysqli_num_rows($result);
		if($resultcheck<1){
			header("Location: login.php?login=error1");
			exit();
		}else{
			if($row=mysqli_fetch_assoc($result)){
				if($password!=$row['pswd']){
					header("Location: login.php?login=error2");
					exit();
				}elseif ($password==$row['pswd']){
					$_SESSION['email']=$row['email'];
					$_SESSION['phone']=$row['phone'];
					$_SESSION['cname']=$row['cname'];
					$_SESSION['cid']=$row['cid'];
                    $_SESSION['logintype']=1;
					//header("Location: login.php?login=success1");
                    header("Location: index_comp.php");
					exit();
				}
			}
		}
	}
}else{
	header("Location: login.php?login=error1");
	exit();
}