<?php
require "connect.php";

$sid1 = $_POST['sid1'];
$sid2 = $_POST['sid2'];


$arr = array();


$sql_update = "update relationship set hide = 1 where sid1 = '$sid1' and sid2 = '$sid2';";
$result_update= mysqli_query($con,$sql_update);


echo json_encode($arr);
?>