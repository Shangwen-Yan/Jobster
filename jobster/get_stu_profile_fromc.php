<?php
require "connect.php";
//被请求的人
$sid = $_POST['sid'];
//发起请求的人
$cid = $_POST['cid'];


$sql_profile = " select sname,resumeText,university,qualification,major,gpa,startDate,endDate,seenbyall from Student where sid = '$sid' ;";
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
    $arr['sid']=$sid;
    if($row['seenbyall'] == 1){
        $flag = 1;
    }
}

$sql_hide = "select * from follow where sid = '$sid' and cid = '$cid';";
$result_hide= mysqli_query($con,$sql_hide);
if($row2=mysqli_fetch_assoc($result_hide)) {
    $flag = 1;
}
//0 not open. 1 open
$arr['open'] = $flag;

echo json_encode($arr);
?>