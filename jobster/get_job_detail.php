<?php
require "connect.php";

$sid = $_POST['sid'];
$jid = $_POST['jid'];

//query job detail
$sql = "select jid,cid,title,cname,job.location,salary,requirement, job.desc,endTime,jobalert.type,sender from jobalert inner join job using (jid) inner join company using(cid) where sid='$sid' and jid = '$jid';";

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
    $arr['type']= $row['type'];
    if($row['type'] == 0){
        $arr['type']="following company";
    }else if($row['type'] == 1){
        $arr['type']="friend forward";
    }else{
        $arr['type']="company notification";
    }
    $arr['sender']= $row['sender'];

}


$sql_update = "update jobalert set status=1 where sid = '$sid' and jid='$jid';";
$result_update= mysqli_query($con,$sql_update);

echo json_encode($arr);
?>