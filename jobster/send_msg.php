<?php
require "connect.php";

$sid1 = mysqli_real_escape_string($con,$_POST['sid1']);
$sid2 = mysqli_real_escape_string($con,$_POST['sid2']);
$msg = mysqli_real_escape_string($con,$_POST['msg']);

if($msg != ""){
    //query member name
    $sql = "insert into message(sid1,sid2,msg) values(".$sid1.",".$sid2.",'".$msg."');";

    $result= mysqli_query($con,$sql);
}

$arr = array();
$arr['sid2']=$sid2;
echo json_encode($arr);
?>