<?php
require "connect.php";
session_start();
$sid1 = mysqli_real_escape_string($con,$_POST['sid1']);
$sid2 = mysqli_real_escape_string($con,$_POST['sid2']);
$msg = mysqli_real_escape_string($con,$_POST['msg']);

$sql_friendship="select * from relationship where sid1 = '$sid1' and sid2 = '$sid2'";
$result_friendship= mysqli_query($con,$sql_friendship);
$cnt =mysqli_num_rows($result_friendship);
$arr = array();
if($cnt>0){
    $arr['msg']="exist";
}else{
    $sql = "insert into relationrequest(sid1,sid2,msg) values(".$sid1.",".$sid2.",'".$msg."');;";
    if($result= mysqli_query($con,$sql)){
        $arr['msg']="success";
    }
}

echo json_encode($arr);
?>