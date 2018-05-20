<?php
require "connect.php";

$jid = $_POST['jid'];
$sid = $_POST['sid'];


$sql = "update application set status = 3 where sid ='$sid' and jid ='$jid ';  ";
$result= mysqli_query($con,$sql);
$arr = array();
$arr['sid'] = $sid;
$arr['jid'] = $jid ;


echo json_encode($arr);
?>