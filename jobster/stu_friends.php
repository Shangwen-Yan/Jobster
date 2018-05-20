<?php
    require_once('connect.php');
    session_start();
    if(!isset($_SESSION['logintype'])){
        header("Location: login.php");
    }elseif ($_SESSION['logintype']==1){
        header("Location: index_comp.php");
    }
    $sid=$_SESSION['sid'];
    $sid=mysqli_real_escape_string($con,$sid);

    //for  header
    //message
    $sql_msg="SELECT sname,sid1,sid2,msg,msgTime,status from message,student where message.sid2='$sid' and status=0 and message.sid1=student.sid;";
    $result_msg= mysqli_query($con,$sql_msg);
    $count_msg=mysqli_num_rows($result_msg);

    //request

    $sql_req="SELECT * from relationrequest where sid2='$sid'and status=0 order by requestTime desc;";
    $result_req= mysqli_query($con,$sql_req);
    $count_req=mysqli_num_rows($result_req);
    //unread alerts
    $sql_alert="select jid,cid,title,cname from jobalert inner join job using (jid) inner join company using(cid) where status = 0 and sid='$sid' order by addTime desc;";
    $result_alert= mysqli_query($con,$sql_alert);
    $count_alert=mysqli_num_rows($result_alert);

    //unread friendship requests
    $sql_request="select sname,msg,sid1, university from relationrequest inner join Student on sid1 = sid where status = 0 and sid2 = '$sid';";
    $result_request= mysqli_query($con,$sql_request);
    $count_request=mysqli_num_rows($result_request);

    //for body
    //unread friendship requests
    $sql_request0="select sname,msg,sid1, university from relationrequest inner join Student on sid1 = sid where status = 0 and sid2 = '$sid';";
    $result_request0= mysqli_query($con,$sql_request0);
    $count_request0=mysqli_num_rows($result_request0);

    $sql_stu0 = "select distinct sid1 from message where sid2='$sid' and status = 0;";
    $result_stu0= mysqli_query($con,$sql_stu0);
    $count_stu0=mysqli_num_rows($result_stu0);


    //get al friends
    $sql_friends = "select sname, university, hide, sid2 from relationship inner join Student on sid2=sid where sid1 = '$sid';";
    $result_friends= mysqli_query($con,$sql_friends);
    $count_friends=mysqli_num_rows($result_friends);







?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <!-- Custom Theme files -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <!--js-->
    <script src="js/jquery-2.1.1.min.js"></script>
    <!--icons-css-->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!--Google Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
    <!--static chart-->
    <script src="js/Chart.min.js"></script>
    <!--//charts-->
    <!-- geo chart -->
    <script src="http://cdn.jsdelivr.net/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <script>window.modernizr || document.write('<script src="lib/modernizr/modernizr-custom.js"><\/script>')</script>
    <!--<script src="lib/html5shiv/html5shiv.js"></script>-->
    <!-- Chartinator  -->
    <script src="js/chartinator.js" ></script>
    <script type="text/javascript">
        jQuery(function ($) {

            var chart3 = $('#geoChart').chartinator({
                tableSel: '.geoChart',

                columns: [{role: 'tooltip', type: 'string'}],

                colIndexes: [2],

                rows: [
                    ['China - 2015'],
                    ['Colombia - 2015'],
                    ['France - 2015'],
                    ['Italy - 2015'],
                    ['Japan - 2015'],
                    ['Kazakhstan - 2015'],
                    ['Mexico - 2015'],
                    ['Poland - 2015'],
                    ['Russia - 2015'],
                    ['Spain - 2015'],
                    ['Tanzania - 2015'],
                    ['Turkey - 2015']],

                ignoreCol: [2],

                chartType: 'GeoChart',

                chartAspectRatio: 1.5,

                chartZoom: 1.75,

                chartOffset: [-12,0],

                chartOptions: {

                    width: null,

                    backgroundColor: '#fff',

                    datalessRegionColor: '#F5F5F5',

                    region: 'world',

                    resolution: 'countries',

                    legend: 'none',

                    colorAxis: {

                        colors: ['#679CCA', '#337AB7']
                    },
                    tooltip: {

                        trigger: 'focus',

                        isHtml: true
                    }
                }


            });
        });
    </script>
    <!--geo chart-->

    <!--skycons-icons-->
    <script src="js/skycons.js"></script>
    <!--//skycons-icons-->
</head>
<body>

<script type="text/javascript" language="JavaScript">
    $(function() {
        $(".open").mouseover(function(){
            $(".open").css("cursor","pointer");

        })
        $(".accept").mouseover(function(){
            $(".accept").css("cursor","pointer");

        })
        $(".hidef").mouseover(function(){
            $(".hidef").css("cursor","pointer");

        })
        $(".hidec").mouseover(function(){
            $(".hidec").css("cursor","pointer");

        })

        $(".hidef").click(function(){
            $.ajax({
                url:'hide_friend.php',
                data:{'sid2':$(this).next().html(),'sid1':<?php echo $sid?>},
                type :'POST',
                dataType:'JSON',
                success:function(msg){
                    window.location.href ="stu_friends.php";
                },
                error:function(msg){
                }
            });

        })
        $(".hidec").click(function(){
            $.ajax({
                url:'hide_cancel.php',
                data:{'sid2':$(this).next().html(),'sid1':<?php echo $sid?>},
                type :'POST',
                dataType:'JSON',
                success:function(msg){
                    window.location.href ="stu_friends.php";
                },
                error:function(msg){
                }
            });

        })

        $(".accept").click(function(){
            $.ajax({
                url:'accept_request.php',
                data:{'sid1':$(this).next().html(),'sid2':<?php echo $sid?>},
                type :'POST',
                dataType:'JSON',
                success:function(msg){
                    window.location.href ="stu_friends.php";
                },
                error:function(msg){
                }
            });

        })


        $(".open").click(function(){
            $("#msg_right").css("display","block");
            $("#msg_history").html("");

            $.ajax({
                url:'get_stu_profile.php',
                data:{'sid1':$(this).next().html(),'sid2':<?php echo $sid?>},
            type :'POST',
                dataType:'JSON',
                success:function(msg){
                    $("#msg_history").prev().prev().html("<a href='stu_sblog.php?ssid="+msg.sid1+"'>"+msg.sname+"</a>")
                    $("#send_msg_sid1").html(msg.sid1);
                    if(msg.open == 0){
                        $("#msg_history").html($("#msg_history").html()+"<p style=\"text-align: left; \"><b>University: </b>"+msg.university+"</p>");
                        $("#msg_history").html($("#msg_history").html()+"<p style=\"text-align: left; \"><b>Major: </b>"+msg.major+"</p>");
                    }else{
                        $("#msg_history").html($("#msg_history").html()+"<p style=\"text-align: left; \"><b>University: </b>"+msg.university+"</p>");
                        $("#msg_history").html($("#msg_history").html()+"<p style=\"text-align: left; \"><b>Start Date: </b>"+msg.startDate+"</p>");
                        $("#msg_history").html($("#msg_history").html()+"<p style=\"text-align: left; \"><b>End Date: </b>"+msg.endDate+"</p>");
                        $("#msg_history").html($("#msg_history").html()+"<p style=\"text-align: left; \"><b>Major: </b>"+msg.major+"</p>");
                        $("#msg_history").html($("#msg_history").html()+"<p style=\"text-align: left; \"><b>Qualification: </b>"+msg.qualification+"</p>");
                        $("#msg_history").html($("#msg_history").html()+"<p style=\"text-align: left; \"><b>GPA: </b>"+msg.gpa+"</p>");
                        $("#msg_history").html($("#msg_history").html()+"<p style=\"text-align: left; \"><b>Resume: </b>"+msg.resumeText+"</p>");


                    }

                },
                error:function(msg){
                }
            });

        })


        $("#send_form>[type='button']").click(function () {


            $.ajax({
                url:'send_msg.php',
                data:{'sid1':<?php echo $sid?>,'sid2':$("#send_msg_sid1").html(),'msg':$("#send_form>[type='text']").val()},
                type :'POST',
                dataType:'JSON',
                success:function(msg){

                    sid2 = msg['sid2'];
                    $("#send_form>[type='text']").val("")
                    $("#msg_right").css("display","block");
                    $("#msg_history").html("");

                    $.ajax({
                        url:'get_msg_history.php',
                        data:{'sid1':sid2,'sid2':<?php echo $sid?>},
                        type :'POST',
                        dataType:'JSON',
                        success:function(msg){
                            $("#msg_history").prev().prev().html(msg[0].sname1)
                            $("#send_msg_sid1").html(msg[0].sid1);
                            for (var i = 0; i < msg.length; i++){
                                if (msg[i].type == 0) {
                                    //received: on left
                                    $("#msg_history").html($("#msg_history").html()+"<p style=\"text-align: left; \">Friend: "+msg[i].msg+"</p>");
                                }else{
                                    //sent: on right
                                    $("#msg_history").html($("#msg_history").html()+"<p style=\"text-align: right;\"> You: "+msg[i].msg+"</p>");


                                }

                            }
                        },
                        error:function(msg){
                        }
                    });

                },
                error:function(msg){
                    alert("error")
                }
            });
        });

        $("#forward_form>[type='button']").click(function () {

            $.ajax({
                url:'forward_job.php',
                data:{'sid1':$("#send_msg_sid1").html(),'jid':$("#forward_form>[type='text']").val()},
                type :'POST',
                dataType:'JSON',
                success:function(msg){
                    if(msg.msg=="success"){
                        alert("forward successfully!");
                    }else{
                        alert("forward fail...");
                    }
                },
                error:function(msg){
                    alert("forward fail...");
                }
            });

        })

    })
</script>

<div class="page-container">
    <div class="left-content">
        <div class="mother-grid-inner">
            <!--header start here-->
            <div class="header-main">
                <div class="header-left">
                    <div class="logo-name">
                        <a href="index.php"> <h1>Jobster</h1>
                            <!--<img id="logo" src="" alt="Logo"/>-->
                        </a>
                    </div>
                    <!--search-box-->
                    <div class="search-box">
                        <form action ="index_stu.php" method="POST">
                            <input type="text" name="job_search" placeholder="Search Job..." required="">
                            <input type="submit" value="">
                        </form>
                    </div><!--//end-search-box-->
                    <div class="clearfix"> </div>
                </div>
                <div class="header-right">
                    <div class="profile_details_left">


                        <!--notifications of menu start -->
                        <ul class="nofitications-dropdown">
                            <li class="dropdown head-dpdn">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-commenting"></i><span class="badge"><?php echo $count_msg?></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have <?php echo $count_msg?> new messages</h3>
                                        </div>
                                    </li>

                                    <?php
                                        if($count_msg<4){
                                            $cnt = $count_msg;
                                        }else{
                                            $cnt = 4;
                                        }
                                        for ($i = 0; $i < $cnt; $i++){
                                            if($row=mysqli_fetch_assoc($result_msg)){
                                                $sid1_msg = $row['sid1'];
                                                $sname = get_stu_name($sid1_msg,$con);
                                                echo "
                                                    <li><a href=\"#\">
                                                        <div class=\"user_img\"><img src=\"images/stu/s".$sid1_msg.".jpg\" alt=\"\"></div>
                                                        <div class=\"notification_desc\">
                                                            <p>".$sname."</p>
                                                            <p><span>".$row['msg']."</span></p>
                                                        </div>
                                                        <div class=\"clearfix\"></div>
                                                    </a></li>
                                                
                                                
                                                ";
                                            }
                                        }


                                    ?>


                                    <li>
                                        <div class="notification_bottom">
                                            <a href="stu_msg.php">See all messages</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown head-dpdn">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue"><?php echo $count_alert?></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have <?php echo $count_alert?> new job alerts</h3>
                                        </div>
                                    </li>
                                    <?php
                                    if($count_alert0<4){
                                        $cnt = $count_alert;
                                    }else{
                                        $cnt = 4;
                                    }
                                    for ($i = 0; $i < $cnt; $i++){
                                        if($row=mysqli_fetch_assoc($result_alert)){
                                            $cname = $row['cname'];
                                            $cid = $row['cid'];
                                            $title = $row['title'];
                                            echo "
                                                    <li><a href=\"#\">
                                                        <div class=\"user_img\"><img src=\"images/comp/c".$cid.".png\" alt=\"\"></div>
                                                        <div class=\"notification_desc\">
                                                            <p>".$cname."</p>
                                                            <p><span>".$title."</span></p>
                                                        </div>
                                                        <div class=\"clearfix\"></div>
                                                    </a></li>
                                                
                                                
                                                ";
                                        }
                                    }


                                    ?>
                                    <li>
                                        <div class="notification_bottom">
                                            <a href="stu_job_alert.php">See all job alerts</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown head-dpdn">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-user-plus"></i><span class="badge blue1"><?php echo $count_request?></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have <?php echo $count_request?> friend requests</h3>
                                        </div>
                                    </li>
                                    <?php
                                    if($count_request<4){
                                        $cnt = $count_request;
                                    }else{
                                        $cnt = 4;
                                    }
                                    for ($i = 0; $i < $cnt; $i++){
                                        if($row=mysqli_fetch_assoc($result_request)){
                                            $sid1_request = $row['sid1'];
                                            $sname = $row['sname'];
                                            echo "
                                                    <li><a href=\"#\">
                                                        <div class=\"user_img\"><img src=\"images/stu/s".$sid1_request.".jpg\" alt=\"\"></div>
                                                        <div class=\"notification_desc\">
                                                            <p>".$sname."</p>
                                                            <p><span>".$row['msg']."</span></p>
                                                        </div>
                                                        <div class=\"clearfix\"></div>
                                                    </a></li>
                                                
                                                
                                                ";
                                        }
                                    }


                                    ?>
                                    <li>
                                        <div class="notification_bottom">
                                            <a href="stu_friends.php">See all friendship requests</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="clearfix"> </div>
                    </div>
                    <!--notification menu end -->
                    <div class="profile_details">
                        <ul>
                            <li class="dropdown profile_details_drop">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <div class="profile_img">
                                        <span class="prfil-img"><?php echo "<img src=\"images/stu/s".$sid.".jpg\" alt=\"\" >"?> </span>
                                        <div class="user-name">
                                            <p><?php echo $_SESSION['sname']?></p>
                                            <span>Student</span>
                                        </div>
                                        <i class="fa fa-angle-down lnr"></i>
                                        <i class="fa fa-angle-up lnr"></i>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu drp-mnu">
                                    <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li>
                                    <li> <a href="stu_blog.php"><i class="fa fa-user"></i> Profile</a> </li>
                                    <li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!--heder end here-->
            <!-- script-for sticky-nav -->
            <script>
                $(document).ready(function() {
                    var navoffeset=$(".header-main").offset().top;
                    $(window).scroll(function(){
                        var scrollpos=$(window).scrollTop();
                        if(scrollpos >=navoffeset){
                            $(".header-main").addClass("fixed");
                        }else{
                            $(".header-main").removeClass("fixed");
                        }
                    });

                });
            </script>
            <!-- /script-for sticky-nav -->
            <!--inner block start here-->
            <div class="inner-block">
                <!--market updates updates-->

                <!--market updates end here-->
                <!--mainpage chit-chating-->
                <div class="chit-chat-layer1">
                    <div class="col-md-6 chit-chat-layer1-left" id = " msg_left" style="width: 60%;">
                        <div class="work-progres">
                            <div class="chit-chat-heading">
                                Relationship Requests
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Student</th>
                                        <th>Message</th>
                                        <th></th>

                                        <th>Accept</th>
                                        <th>Profile</th>
                                    </tr>
                                    </thead>
                                    <tbody>



                                    <?php
                                    for ($i = 0; $i < $count_request0; $i++){
                                        if($row=mysqli_fetch_assoc($result_request0)){
                                            $sid1_request0 = $row['sid1'];

                                            $sname = $row['sname'];;

                                            $msg = $row['msg'];

                                            echo "
                                                    <tr>
                                                        <td><img src=\"images/stu/s".$sid1_request0.".jpg\" alt=\"\" height=\"25\" width=\"25\"></td>
                                                        <td >".$sname."</td>
                                                        <td colspan=\"2\">".$msg."</td>
                
                                                        <td><span class=\"label label-warning accept \" >accept</span> <span  hidden>".$sid1_request0."</span></td>
                                                        <td ><span  id='open' class=\"label label-info open\">open</span><span  hidden>".$sid1_request0."</span></td>
                                                    </tr>
                                                ";

                                        }

                                    }
                                    ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="chit-chat-layer1">
                    <div class="col-md-6 chit-chat-layer1-left" id = " msg_left" style="width: 60%;">
                        <div class="work-progres">
                            <div class="chit-chat-heading">
                                All friends
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Student</th>
                                        <th>University</th>
                                        <th></th>

                                        <th>Hide</th>
                                        <th>Profile</th>
                                    </tr>
                                    </thead>
                                    <tbody>



                                    <?php
                                    for ($i = 0; $i < $count_friends; $i++){
                                        if($row=mysqli_fetch_assoc($result_friends)){
                                            $sid2_friends = $row['sid2'];
                                            $sname = $row['sname'];
                                            $suni = $row['university'];
                                            $hide = $row['hide'];
                                            if($hide == 0){
                                                echo "
                                                    <tr>
                                                        <td><img src=\"images/stu/s".$sid2_friends.".jpg\" alt=\"\" height=\"25\" width=\"25\"></td>
                                                        <td >".$sname."</td>
                                                        <td colspan=\"2\">".$suni."</td>
                                                        <td><span class=\"label label-success hidef\">o</span><span id='sid' hidden>".$sid2_friends."</span></td>
                                                        <td ><span id='open' class=\"label label-info open\">open</span><span id='sid' hidden>".$sid2_friends."</span></td>
                                                    </tr>
                                                ";
                                            }else{
                                                //already hidden
                                                echo "
                                                    <tr>
                                                        <td><img src=\"images/stu/s".$sid2_friends.".jpg\" alt=\"\" height=\"25\" width=\"25\"></td>
                                                        <td >".$sname."</td>
                                                        <td colspan=\"2\">".$suni."</td>
                
                                                        <td><span class=\"label label-danger hidec\">-</span><span id='sid' hidden>".$sid2_friends."</span></td>
                                                        <td ><span id='open' class=\"label label-info open\">open</span><span id='sid' hidden>".$sid2_friends."</span></td>
                                                    </tr>
                                                ";

                                            }


                                        }

                                    }
                                    ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!--main page chit chating end here-->
                <!--main page chart start here-->
                <div class="main-page-charts" >

                        <div class="col-md-6 chart-layer1-right" id = "msg_right" style="display: none; width: 40%" >
                            <div class="user-marorm">
                                <div class="malorum-top">
                                </div>
                                <div class="malorm-bottom">

                                    <h2>Default User</h2><hr>

                                    <span id="msg_history">

                                    </span><hr/>
                                    <span id="send_msg_sid1" hidden></span>
                                    <form id="send_form">
                                        <input type="text" name="" value="" placeholder="send msg..."><br>
                                        <input type="button" value="send" style="margin-left:250px ">
                                    </form><hr/>

                                    <form id="forward_form">
                                        <input type="text" name="" value="" placeholder="input jid..."><br>
                                        <input type="button" value="forward" style="margin-left:250px ">
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>



                <div class="clearfix"> </div>
            </div>



            </div>
            <!--inner block end here-->
            <!--copy rights start here-->
            <div class="copyrights">
                <p>Copyright &copy; New York University CS6083: Yan Li, Shangwen Yan</p>            </div>
            <!--COPY rights end here-->
        </div>
    </div>
    <!--slider menu-->
    <div class="sidebar-menu">
        <div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span>
                <!--<img id="logo" src="" alt="Logo"/>-->
            </a> </div>
        <div class="menu">
            <ul id="menu" >
                <li id="menu-home" ><a href="index_stu.php"><i class="fa fa-university"></i><span>Home</span></a></li>


                <li><a href="stu_msg.php"><i class="fa fa-commenting"></i><span>Messages</span></a></li>
                <li><a href="stu_job_alert.php"><i class="fa fa-bell-o"></i><span>Job Alerts</span></a></li>
                <li><a href="stu_application.php"><i class="fa fa-align-justify"></i><span>Application History</span></a></li>
                <li><a href="stu_friends.php"><i class="fa fa-user"></i><span>Friends</span></a></li>
                <li><a href="stu_search.php"><i class="fa fa-search"></i><span>Search People</span></a></li>

                <li><a href="stu_companies.php"><i class="fa fa-creative-commons"></i><span>Companies</span></a></li>
                <li><a href="stu_blog.php"><i class="fa fa-file-text-o"></i><span>Blog</span></a></li>
                <li><a href="#"><i class="fa fa-cog"></i><span>System</span><span class="fa fa-angle-right" style="float: right"></span></a>
                    <ul id="menu-academico-sub" >
                        <li id="menu-academico-avaliacoes" ><a href="404.php">Settings</a></li>
                        <li id="menu-academico-boletim" ><a href="blank.php">Profile</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="clearfix"> </div>
</div>
<!--slide bar menu end here-->
<script>
    var toggle = true;

    $(".sidebar-icon").click(function() {
        if (toggle)
        {
            $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
            $("#menu span").css({"position":"absolute"});
        }
        else
        {
            $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
            setTimeout(function() {
                $("#menu span").css({"position":"relative"});
            }, 400);
        }
        toggle = !toggle;
    });
</script>
<!--scrolling js-->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>                     