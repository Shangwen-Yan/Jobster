<?php
require "connect.php";

$sid = $_POST['sid'];
$cid = $_POST['cid'];


$arr = array();


$sql_update = "insert into follow(sid,cid) values('$sid','$cid');";
$result_update= mysqli_query($con,$sql_update);


echo json_encode($arr);
?>