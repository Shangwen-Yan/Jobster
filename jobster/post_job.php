<?php
require "connect.php";
session_start();

//begin transaction, in case of concurrency
mysqli_begin_transaction($con);

$title = mysqli_real_escape_string($con,$_POST['title']);
$location = mysqli_real_escape_string($con,$_POST['location']);
$salary = mysqli_real_escape_string($con,$_POST['salary']);
$requirement = mysqli_real_escape_string($con,$_POST['requirement']);
$desc = mysqli_real_escape_string($con,$_POST['desc']);
$endTime = mysqli_real_escape_string($con,$_POST['endTime']);


$arr = array();
//insert job
$sql_update = "insert into job(cid,location,title,salary,requirement,job.desc,endTime) values(".$_SESSION['cid'].",'".$location."','".$title."','".$salary."','".$requirement."','".$desc."','".$endTime."'); ";
$result_update= mysqli_query($con,$sql_update);

//select jid
$sql_jid = "select jid from job order by jid desc limit 1";
$result_jid= mysqli_query($con,$sql_jid);
if($row=mysqli_fetch_assoc($result_jid)) {
    $jid=$row['jid'];
}

//select followers
$sql_sid = "select distinct sid from follow where cid = ".$_SESSION['cid'].";";
$result_sid= mysqli_query($con,$sql_sid);
$cnt=mysqli_num_rows($result_sid);
for($i=0;$i < $cnt;$i++) {
    if($row=mysqli_fetch_assoc($result_sid)){
        $sid_alert=$row['sid'];
        $sql_alert = "insert ignore into jobalert (sid,jid,type,sender,sendid) values(".$sid_alert.",".$jid.",0,'".$_SESSION['cname']."',".$_SESSION['cid'].");";
        $result_sid= mysqli_query($con,$sql_alert);
    }

}

//commit
mysqli_commit($con);

header("Location:comp_job.php");
echo json_encode($arr);
?>