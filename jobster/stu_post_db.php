<?php
require "connect.php";

$sid = mysqli_real_escape_string($con,$_POST['sid']);
$msg = mysqli_real_escape_string($con,$_POST['msg']);

$arr = array();

$sql_update = "insert into studentpost(sid,msg) values('$sid','$msg')";
$result_update= mysqli_query($con,$sql_update);

echo json_encode($arr);
?>