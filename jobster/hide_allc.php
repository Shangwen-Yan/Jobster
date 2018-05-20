<?php
require "connect.php";

$sid_hideall = $_POST['sid'];

$arr = array();


$sql_update = "update student set seenbyall = 1 where sid = '$sid_hideall' ;";
$result_update= mysqli_query($con,$sql_update);


echo json_encode($arr);
?>