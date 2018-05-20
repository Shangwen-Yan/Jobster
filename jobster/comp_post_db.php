<?php
require "connect.php";

$cid = mysqli_real_escape_string($con,$_POST['cid']);
$msg = mysqli_real_escape_string($con,$_POST['msg']);

$arr = array();

$sql_update = "insert into companypost(cid,msg) values('$cid','$msg')";
$result_update= mysqli_query($con,$sql_update);

echo json_encode($arr);
?>