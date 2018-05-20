<?php
require "connect.php";
session_start();
$sid1 = mysqli_real_escape_string($con,$_POST['sid1']);
$jid = mysqli_real_escape_string($con,$_POST['jid']);

$arr = array();

$sql_alert = "insert ignore into jobalert (sid,jid,type,sender,sendid) values(".$sid1.",".$jid.",1,'".$_SESSION['sname']."',".$_SESSION['sid'].");";
if($result_sid= mysqli_query($con,$sql_alert)){
    $arr['msg']="success";
}
echo json_encode($arr);
?>