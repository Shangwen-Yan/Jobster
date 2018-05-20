<?php
    if(isset($_POST['submit'])){
        require_once('connect.php');

        $email = mysqli_real_escape_string($con,$_POST['email']);
        $cname = mysqli_real_escape_string($con,$_POST['cname']);
        $phone = mysqli_real_escape_string($con,$_POST['phone']);
        $location = mysqli_real_escape_string($con,$_POST['location']);
        $password = mysqli_real_escape_string($con,$_POST['pswd']);
        $password2= mysqli_real_escape_string($con,$_POST['pswd2']);
        $magnitude = mysqli_real_escape_string($con,$_POST['magnitude']);
        $industry = mysqli_real_escape_string($con,$_POST['industry']);
        $cid=null;



        if(empty($email)||empty($cname)||empty($password)||empty($password2)){
            header("Location:signup_company.php?signup2=empty");
        }elseif (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
            header("Location:signup_company.php?signup2=format");
        }elseif ($password!=$password2) {
            header("Location:signup_company.php?signup2=password2");
        }else{
            $sql2="SELECT count(*) from company where email='$email';";
            $result=mysqli_query($con,$sql2);
            $pass=mysqli_fetch_row($result);
            $pa=$pass[0];
            if($pa==1){
                header("Location:signup_company.php?signup2=emailtwice");
            }else{
                //begin transaction, in case of concurrency
                mysqli_begin_transaction($con);

                $sql="INSERT INTO company (cid,cname,pswd,email,phone,location,industry,magnitude) VALUES (?,?,?,?,?,?,?,?);";
                $stmt=mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo "SQL error";
                }else{
                    mysqli_stmt_bind_param($stmt, "ssssssss" , $cid,$cname,$password,$email,$phone,$location,$industry,$magnitude);
                    mysqli_stmt_execute($stmt);
                    $stmt->close();
                    //commit
                    mysqli_commit($con);

                    header("Location:signup_company.php?signup2=success");
                }
            }
        }



    }else{
        header("Location:signup_company.php?signup2=error");
        exit();
    }

        
?>
