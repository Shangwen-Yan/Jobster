<?php
require "connect.php";

$sid = $_POST['sid'];
$jid = $_POST['jid'];

//query job detail
$sql = "select jid,cid,title,cname,job.location,salary,requirement, job.desc,endTime from  job  inner join company using(cid) where  jid = '$jid';";

$result= mysqli_query($con,$sql);
$arr = array();
if($row=mysqli_fetch_assoc($result)) {
    $arr['jid']= $row['jid'];
    $arr['cid']= $row['cid'];
    $arr['title']= $row['title'];
    $arr['cname']= $row['cname'];
    $arr['location']= $row['location'];
    $arr['salary']= $row['salary'];
    $arr['requirement']= $row['requirement'];
    $arr['desc']= $row['desc'];
    $arr['endTime']= $row['endTime'];


}



echo json_encode($arr);
?>