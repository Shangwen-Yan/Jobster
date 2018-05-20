<?php
require_once('connect.php');
session_start();
if(!isset($_SESSION['logintype'])){
    header("Location: login.php");
}elseif ($_SESSION['logintype']==0){
    header("Location: index_stu.php");
}
$cid=mysqli_real_escape_string($con,$_SESSION['cid']);
$cname=mysqli_real_escape_string($con,$_SESSION['cname']);
$stu_search = mysqli_real_escape_string($con,$_POST['stu_search']);

//for header
//applications
$sql_app="select sid,sname,title from application inner join job using(jid) inner join student using (sid) where cid='$cid' and status = 0 order by appTime desc;";
$result_app= mysqli_query($con,$sql_app);
$count_app=mysqli_num_rows($result_app);


//for body
//all students
if($stu_search != ""){
    $sql_stu = "select sname,sid,university,major from student where sname like'%".$stu_search."%' or university like'%".$stu_search."%' or resumeText like'%".$stu_search."%' or major like'%".$stu_search."%';";
}else{
    $sql_stu="select sname,sid,university,major from student;";
}
$result_stu= mysqli_query($con,$sql_stu);
$count_stu=mysqli_num_rows($result_stu);


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

        });

        $(".open").click(function(){
            $("#msg_right").css("display","block");
            $("#stu_detail").html("");

            $.ajax({
                url:'get_stu_profile_fromc.php',
                data:{'sid':$(this).next().html(),'cid':<?php echo $cid?>},
                type :'POST',
                dataType:'JSON',
                success:function(msg){
                    $("#stu_detail").prev().html("<a href='comp_sblog.php?sid="+msg.sid+"'>"+msg.sname+"</a>")
                    $("#comp_sid").html(msg.sid);
                    if(msg.open == 0){
                        $("#stu_detail").html($("#stu_detail").html()+"<p style=\"text-align: left; \"><b>University: </b>"+msg.university+"</p>");
                        $("#stu_detail").html($("#stu_detail").html()+"<p style=\"text-align: left; \"><b>Major: </b>"+msg.major+"</p>");
                    }else{
                        $("#stu_detail").html($("#stu_detail").html()+"<p style=\"text-align: left; \"><b>University: </b>"+msg.university+"</p>");
                        $("#stu_detail").html($("#stu_detail").html()+"<p style=\"text-align: left; \"><b>Start Date: </b>"+msg.startDate+"</p>");
                        $("#stu_detail").html($("#stu_detail").html()+"<p style=\"text-align: left; \"><b>End Date: </b>"+msg.endDate+"</p>");
                        $("#stu_detail").html($("#stu_detail").html()+"<p style=\"text-align: left; \"><b>Major: </b>"+msg.major+"</p>");
                        $("#stu_detail").html($("#stu_detail").html()+"<p style=\"text-align: left; \"><b>Qualification: </b>"+msg.qualification+"</p>");
                        $("#stu_detail").html($("#stu_detail").html()+"<p style=\"text-align: left; \"><b>GPA: </b>"+msg.gpa+"</p>");
                        $("#stu_detail").html($("#stu_detail").html()+"<p style=\"text-align: left; \"><b>Resume: </b>"+msg.resumeText+"</p>");


                    }

                },
                error:function(msg){
                }
            });

        });


        $("#send_form>[type='button']").click(function () {
            $.ajax({
                url:'notify_stu.php',
                data:{'jid':$("#send_form>[type='button']").prev().val(),'sid':$("#comp_sid").html(),'cid':<?php echo $cid?>},
                type :'POST',
                dataType:'JSON',
                success:function(msg){
                    if(msg.msg=='success'){
                        alert("You have notified successfully!")
                    }else{
                        alert("You have notified before.")
                    }

                },
                error:function(msg){
                    alert("fail")
                }
            });

        });

    });
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
                        <form action ="index_comp.php" method="POST">
                            <input type="text" name="stu_search" placeholder="Search people..." required="">
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
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue"><?php echo $count_app?></span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have <?php echo $count_app?> new applications</h3>
                                        </div>
                                    </li>


                                    <?php
                                    if($count_app<4){
                                        $cnt = $count_app;
                                    }else{
                                        $cnt = 4;
                                    }
                                    for ($i = 0; $i < $cnt; $i++){
                                        if($row=mysqli_fetch_assoc($result_app)){
                                            $sname = $row['sname'];
                                            $sid = $row['sid'];
                                            $title = $row['title'];
                                            echo "
                                                    <li><a href=\"#\">
                                                        <div class=\"user_img\"><img src=\"images/stu/s".$sid.".jpg\" alt=\"\"></div>
                                                        <div class=\"notification_desc\">
                                                            <p>".$sname."</p>
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
                                            <a href="comp_application.php">See all applications</a>
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
                                        <span class="prfil-img"><?php echo "<img src=\"images/comp/c".$cid.".png\" alt=\"\" >"?> </span>
                                        <div class="user-name">
                                            <p><?php echo $cname?></p>
                                            <span>Company</span>
                                        </div>
                                        <i class="fa fa-angle-down lnr"></i>
                                        <i class="fa fa-angle-up lnr"></i>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu drp-mnu">
                                    <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li>
                                    <li> <a href="comp_blog.php"><i class="fa fa-user"></i> Profile</a> </li>
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
                                Students
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>University</th>
                                        <th></th>

                                        <th>Major</th>
                                        <th>Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <!--unread alerts-->

                                    <?php
                                    for ($i = 0; $i < $count_stu; $i++){
                                        if($row=mysqli_fetch_assoc($result_stu)){
                                            $sid = $row['sid'];
                                            $sname = $row['sname'];
                                            $university = $row['university'];
                                            $major = $row['major'];

                                            echo "
                                                    <tr>
                                                        <td><img src=\"images/stu/s".$sid.".jpg\" alt=\"\" height=\"25\" width=\"25\"></td>
                                                        <td >".$sname."</td>
                                                        <td colspan=\"2\">".$university."</td>
                
                                                        <td>".$major." </td>
                                                        <td ><span class=\"label label-info open\">open</span><span hidden>".$sid."</span></td>
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
                <!--main page chit chating end here-->
                <!--main page chart start here-->
                <div class="main-page-charts" >

                    <div class="col-md-6 chart-layer1-right" id = "msg_right" style="display: none; width: 40%" >
                        <div class="user-marorm">
                            <div class="malorum-top">
                            </div>
                            <div class="malorm-bottom">
                                <h2>Student name</h2>

                                <span id="stu_detail">
                                </span><hr/>
                                <span id="comp_sid" hidden></span>
                                <form id="send_form">
                                    <input type="text" value=""  placeholder="input jid...">
                                    <input type="button" value="notify" style="margin-left:250px ">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
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
            <li id="menu-home" ><a href="index_comp.php"><i class="fa fa-university"></i><span>Home</span></a></li>
            <li><a href="comp_application.php"><i class="fa fa-bell-o"></i><span>Applications</span></a></li>
            <li><a href="comp_job.php"><i class="fa fa-align-justify"></i><span>Post Job</span></a></li>
            <li><a href="comp_blog.php"><i class="fa fa-file-text-o"></i><span>Blog</span></a></li>
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