<?php
require "connect.php";

$cid = $_POST['cid'];


//query job detail
$sql = "select cid,cname,location,industry,magnitude,cdesc from company where cid = '$cid'";

$result= mysqli_query($con,$sql);
$arr = array();
if($row=mysqli_fetch_assoc($result)) {
    $arr['cid']= $row['cid'];
    $arr['cname']= $row['cname'];
    $arr['location']= $row['location'];
    $arr['industry']= $row['industry'];

    $arr['magnitude']= $row['magnitude'];
    $arr['cdesc']= $row['cdesc'];

}


echo json_encode($arr);
?>