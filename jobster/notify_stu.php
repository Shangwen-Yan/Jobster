<?php
require "connect.php";
session_start();
$sid = $_POST['sid'];
$jid = $_POST['jid'];
$cid = $_POST['cid'];
$sql = "select * from jobalert where sid = '$sid' and jid = '$jid' and type = 3;";
$result= mysqli_query($con,$sql);
$arr = array();
if(!$row=mysqli_fetch_assoc($result)){
    $sql2 = "insert into jobalert(sid,jid,type,sender,sendid) values('$sid','$jid',2,'".$_SESSION['cname']."','$cid');";
    $result2= mysqli_query($con,$sql2);
    $arr['msg'] = "success";
}else{
    $arr['msg'] = "fail";
}

echo json_encode($arr);
?>