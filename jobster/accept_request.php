<?php
require "connect.php";

$sid1 = $_POST['sid1'];
$sid2 = $_POST['sid2'];


$arr = array();


$sql_update = "update relationrequest set status = 1 where sid1 = '$sid1' and sid2 = '$sid2';";
$result_update= mysqli_query($con,$sql_update);

$sql_insert1 = "insert ignore into relationship(sid1,sid2) values('$sid1','$sid2');";
mysqli_query($con,$sql_insert1);
$sql_insert2 = "insert ignore into relationship(sid1,sid2) values('$sid2','$sid1');";
mysqli_query($con,$sql_insert2);
echo json_encode($arr);
?>