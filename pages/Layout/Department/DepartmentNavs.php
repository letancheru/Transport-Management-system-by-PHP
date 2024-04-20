<?php
  $conn = mysqli_connect("localhost","root","","huvmts"); 
  $notIndex = 0;
  $rprt_sql = "SELECT * FROM `request` WHERE `dept_see` = 'no' AND `username` = '".$_SESSION['username']."'"; 
  $fetch = mysqli_query($conn,$rprt_sql);
  while ($row = mysqli_fetch_array($fetch)) {
    $notIndex++;
  }
?>


<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title;?></title>

    <!-- Bootstrap -->
    <link href="/huvmts/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="/huvmts/vendors/bootstrap/dist/css/style.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/huvmts/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/huvmts/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Logo icon -->
    <link rel="icon" href="/huvmts/image/icon.jpg">

    <!-- Custom Theme Style -->
    <link href="/huvmts/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed mCustomScrollbar _mCS_1 mCS-autoHide">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/huvmts/Accounts/Department" class="site_title"><img src="/huvmts/asset/logo.jpg" alt="..." class="img-circle" width="45px"> <span>HUTMVTS</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <?php echo '<img class="img-circle profile_img img-responsive" src="data:image/jpeg;base64,'.base64_encode( $_SESSION['profilepicture'] ).'"/>'?>
              </div>
              <div class="profile_info">
                <span style="font-size: 19px;color: #ff8000">Welcome,</span>
                <h2><?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3 style="font-size: 29px;color: #ff8000">Department</h3>
                <ul class="nav side-menu">
                  <li class="<?php echo $DepartmentHome;?>"><a  href="/huvmts/Accounts/Department"><i class="fa fa-home"></i> Home </a></li>
                  <li class="<?php echo $DepartmentSend;?>"><a><i class="fa fa-envelope"></i>Request<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/huvmts/Accounts/Department/Outbox/index.php">Prepare Message</a></li></li>
                      <li><a href="/huvmts/Accounts/Department/Outbox/sent.php">sent Message</a></li></li>
                      <li><a href="/huvmts/Accounts/Department/Outbox/Request.php">Prepare Request</a></li>
                      <li><a href="/huvmts/Accounts/Department/Outbox/sentrequest.php">Sented Request</a></li>
                    </ul>
                  </li>
                  <li class="<?php echo $DepartmentInbox;?>"><a href="/huvmts/Accounts/Department/Inbox/index.php"><i class="fa icon-inbox"></i>Recieved Message</a></li>
                  <li class="<?php echo $post;?>"><a href="/huvmts/Accounts/Department/post.php"><i class="fa icon-message"></i>View post</a></li>
                   <li class="<?php echo $DepartmentReport;?>"><a href="/huvmts/Accounts/Department/Report/index.php"><i class="fa icon-file-text"></i>Report</a></li>
                  <li role="presentation" class="dropdown">
                    <a href="/huvmts/Accounts/Department/Inbox/notification.php" class="info-number" aria-expanded="false">
                      <i class="fa fa-globe"></i>
                      <?php if ($notIndex > 0) {echo '<span class="badge bg-red">'.$notIndex.'</span>';}?><span class="badge bg-red"></span>Notification
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $_SESSION['profilepicture'] ).'"/>'?>
                    <?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="/huvmts/accounts/Department/profile.php"> Profile</a></li>
                    <li>
                      <a href="/huvmts/Accounts/Department/edit profile.php">
                        <i class="fa fa-cogs pull-right"></i><span>Settings</span>
                      </a>
                    </li>
                    <li><a href="/huvmts/Accounts/Department/Help.php"><i style="color:brown" class="fa fa-question-circle pull-right"></i>User Help</a></li>
                    <li><a href="/huvmts/class/PHP/distroySession.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
