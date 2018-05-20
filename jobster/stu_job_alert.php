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
    //for header
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
    $sql_request="select sname,msg,sid1 from relationrequest inner join Student on sid1 = sid where status = 0 and sid2 = '$sid';";
    $result_request= mysqli_query($con,$sql_request);
    $count_request=mysqli_num_rows($result_request);


    //for body
    //unread alerts
    $sql_alert0="select jid,cid,title,cname from jobalert inner join job using (jid) inner join company using(cid) where status = 0 and sid='$sid' order by addTime desc;";
    $result_alert0= mysqli_query($con,$sql_alert0);
    $count_alert0=mysqli_num_rows($result_alert0);

    //read alerts
    $sql_alert1="select jid,cid,title,cname from jobalert inner join job using (jid) inner join company using(cid) where status = 1 and sid='$sid' order by addTime desc;";
    $result_alert1= mysqli_query($con,$sql_alert1);
    $count_alert1=mysqli_num_rows($result_alert1);







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

        $(".open").click(function(){
            $("#msg_right").css("display","block");
            $("#job_detail").html("");
            $.ajax({
                url:'get_job_detail.php',
                data:{'jid':$(this).next().html(),'sid':<?php echo $sid?>},
                type :'POST',
                dataType:'JSON',
                success:function(msg){
                    $("#job_detail").prev().html(msg.title);
                    $("#job_detail").prev().prev().html("<a href='stu_cblog.php?cid="+msg.cid+"'>"+msg.cname+"</a>");
                    $("#jid_apply").html(msg.jid);
                    $("#job_detail").html($("#job_detail").html()+"<p style=\"text-align: left; \"><b>Location: </b>"+msg.location+"</p>");
                    $("#job_detail").html($("#job_detail").html()+"<p style=\"text-align: left; \"><b>Salary: </b>"+msg.salary+"k/month</p>");
                    $("#job_detail").html($("#job_detail").html()+"<p style=\"text-align: left; \"><b>Requirement: </b>"+msg.requirement+"</p>");

                    $("#job_detail").html($("#job_detail").html()+"<p style=\"text-align: left; \"><b>endTime: </b>"+msg.endTime+"</p>");
                    $("#job_detail").html($("#job_detail").html()+"<p style=\"text-align: left; \"><b>Source: </b>"+msg.type+"-"+msg.sender+"</p>");
                    $("#job_detail").html($("#job_detail").html()+"<p style=\"text-align: left; \"><b>Description: </b>"+msg.desc+"</p>");


                },
                error:function(msg){
                }
            });

        });


        $("#send_form>[type='button']").click(function () {
            $.ajax({
                url:'apply_job.php',
                data:{'jid':$("#jid_apply").html(),'sid':<?php echo $sid?>},
                type :'POST',
                dataType:'JSON',
                success:function(msg){
                    if(msg.msg=='success'){
                        alert("You have applied successfully!")
                    }else{
                        alert("You have already applied.")
                    }

                },
                error:function(msg){
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
                                Job Alerts
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Company</th>
                                        <th>Title</th>
                                        <th></th>

                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <!--unread alerts-->

                                    <?php
                                        for ($i = 0; $i < $count_alert0; $i++){
                                            if($row=mysqli_fetch_assoc($result_alert0)){
                                                $cid = $row['cid'];
                                                $cname = $row['cname'];
                                                $title = $row['title'];
                                                $jid = $row['jid'];
                                                echo "
                                                    <tr>
                                                        <td><img src=\"images/comp/c".$cid.".png\" alt=\"\" height=\"25\" width=\"25\"></td>
                                                        <td >".$cname."</td>
                                                        <td colspan=\"2\">".$title."</td>
                
                                                        <td><span class=\"label label-danger\">unread</span></td>
                                                        <td ><span  id='open' class=\"label label-info open\">open</span><span id='jid' hidden>".$jid."</span></td>
                                                    </tr>
                                                ";

                                            }

                                        }
                                    ?>
                                    <!--have read alerts-->

                                    <?php
                                    for ($i = 0; $i < $count_alert1; $i++){
                                        if($row=mysqli_fetch_assoc($result_alert1)){
                                            $cid = $row['cid'];
                                            $cname = $row['cname'];
                                            $title = $row['title'];
                                            $jid = $row['jid'];
                                            echo "
                                                    <tr>
                                                        <td><img src=\"images/comp/c".$cid.".png\" alt=\"\" height=\"25\" width=\"25\"></td>
                                                        <td >".$cname."</td>
                                                        <td colspan=\"2\">".$title."</td>
                
                                                        <td><span class=\"label label-success\"> read </span></td>
                                                        <td ><span id='open' class=\"label label-info open\">open</span><span  hidden>".$jid."</span></td>
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
                                    <h4>Company's name: </h4>
                                    <h2>Title</h2>

                                    <span id="job_detail">
                                    </span><hr/>
                                    <span id="jid_apply" hidden></span>
                                    <form id="send_form">
                                        <input type="button" value="apply" style="margin-left:250px ">
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
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