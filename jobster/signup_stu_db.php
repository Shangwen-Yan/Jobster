<?php
    if(isset($_POST['submit'])){
        require_once('connect.php');


        $email = mysqli_real_escape_string($con,$_POST['email']);
        $sname = mysqli_real_escape_string($con,$_POST['sname']);
        $phone = mysqli_real_escape_string($con,$_POST['phone']);
        $interest = mysqli_real_escape_string($con,$_POST['interest']);
        $password = mysqli_real_escape_string($con,$_POST['pswd']);
        $password2 = mysqli_real_escape_string($con,$_POST['pswd2']);
        $resumefile=mysqli_real_escape_string($con,$_POST['resumefile']);
        $resumetext=mysqli_real_escape_string($con,$_POST['resumetext']);
        $university = mysqli_real_escape_string($con,$_POST['university']);
        $qualification=mysqli_real_escape_string($con,$_POST['qualification']);
        $major = mysqli_real_escape_string($con,$_POST['major']);
        $gpa = mysqli_real_escape_string($con,$_POST['gpa']);
        $startdate = mysqli_real_escape_string($con,$_POST['start']);
        $enddate =mysqli_real_escape_string($con, $_POST['end']);

        if ($startdate==""){
            $startdate=null;
        }
        if ($enddate==""){
            $enddate=null;
        }



        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
            header("Location:signup_student.php?signup=format");
        }elseif ($password!=$password2) {
            header("Location:signup_student.php?signup=password2");
        }else{
            $sql2="SELECT count(*) from student where email='$email';";
            $result=mysqli_query($con,$sql2);
            $pass=mysqli_fetch_row($result);
            $pa=$pass[0];
            if($pa==1){
                header("Location:signup_student.php?signup=emailtwice");
            }else{
                
                //begin transaction, in case of concurrency
                mysqli_begin_transaction($con);


                $sql="INSERT INTO student (sname,pswd,email,phone,interest,resumefile,resumetext,university,
                              qualification,major,gpa,startdate,enddate) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
                $stmt=mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo "SQL error";
                }else{
                    mysqli_stmt_bind_param($stmt, "sssssssssssss" ,
                        $sname,$password,$email,$phone,$interest,$resumefile,$resumetext,$university,
                            $qualification,$major,$gpa,$startdate,$enddate);
                    mysqli_stmt_execute($stmt);
                    $stmt->close();


                    //commit
                    mysqli_commit($con);

                    header("Location:signup_student.php?signup=success");
                }
            }
        }


    }else{
        header("Location:signup_student.php?signup=error");
        exit();
    }
?>

