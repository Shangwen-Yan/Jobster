<?php
require "connect.php";
//被请求的人
$sid1 = $_POST['sid1'];
//发起请求的人
$sid2 = $_POST['sid2'];


$sql_profile = " select sname,resumeText,university,qualification,major,gpa,startDate,endDate,seenbyall from Student where sid = '$sid1' ;";
$result_profile= mysqli_query($con,$sql_profile);

$arr = array();
$flag = 0;
if($row=mysqli_fetch_assoc($result_profile)) {
    $arr['sname']=$row['sname'];
    $arr['resumeText']=$row['resumeText'];
    $arr['university']=$row['university'];
    $arr['qualification']=$row['qualification'];
    $arr['major']=$row['major'];
    $arr['gpa']=$row['gpa'];
    $arr['startDate']=$row['startDate'];
    $arr['endDate']=$row['endDate'];
    $arr['sid1']=$sid1;
    if($row['seenbyall'] == 1){
        $flag = 1;
    }
}

$sql_hide = "select hide from relationship where sid1 = '$sid1' and sid2 = '$sid2';";
$result_hide= mysqli_query($con,$sql_hide);
if($row2=mysqli_fetch_assoc($result_hide)) {
    if ($row2['hide'] == 0){
        $flag = 1;
    }else{
        $flag = 0;

    }
}
//0 not open. 1 open
$arr['open'] = $flag;

echo json_encode($arr);
?>