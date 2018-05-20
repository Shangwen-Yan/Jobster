<?php
require "connect.php";

$sid = $_POST['sid'];
$jid = $_POST['jid'];

$sql = "select * from application where sid = '$sid' and jid = '$jid'";
$result= mysqli_query($con,$sql);
$arr = array();
if(!$row=mysqli_fetch_assoc($result)){
    $sql_update = "insert into application(sid,jid) values('$sid','$jid');";
    $result_update= mysqli_query($con,$sql_update);
    $arr['msg'] = "success";
}else{
    $arr['msg'] = "fail";
}

echo json_encode($arr);
?>