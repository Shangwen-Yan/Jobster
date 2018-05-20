<?php 
    require_once('config.php');
    if(!($con=mysqli_connect(HOST,USERNAME,PASSWORD))){
        echo mysqli_error();
    }
    if(!(mysqli_select_db($con,'jobster'))){
        echo mysqli_error();
    }

    function get_stu_name($sid,$con){
        $sql = "select sname from student where sid = ".$sid;
        $result= mysqli_query($con,$sql);
        if($row=mysqli_fetch_assoc($result)){
            $sname = $row['sname'];
        }
        return $sname;
    }
    function get_stu_uni($sid,$con){
        $sql = "select university from student where sid = ".$sid;
        $result= mysqli_query($con,$sql);
        if($row=mysqli_fetch_assoc($result)){
            $university = $row['university'];
        }
        return $university ;
    }
?>