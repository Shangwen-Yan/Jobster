<?php
require "connect.php";

$sid1 = $_POST['sid1'];
$sid2 = $_POST['sid2'];

//query member name
$sql = "select sid1, sid2, msg from message where sid1 in ('$sid1','$sid2') and sid2 in ('$sid1','$sid2') order by msgTime asc;";

$result= mysqli_query($con,$sql);
$cnt=mysqli_num_rows($result);
$arr = array();
for ($i = 0; $i < $cnt; $i++){
    if($row=mysqli_fetch_assoc($result)) {
        $arr[$i]['msg']=$row['msg'];
        if($row['sid1'] == $sid1){
            //receive
            $arr[$i]['type']=0;
        }else{
            //send
            $arr[$i]['type']=1;
        }
        $arr[$i]['sid1']=$sid1;
        $arr[$i]['sname1']=get_stu_name($sid1,$con);
    }
}

$sql_update = "update message set status=1 where sid1='$sid1' and sid2='$sid2';";
$result_update= mysqli_query($con,$sql_update);

echo json_encode($arr);
?>