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
    <!-- Datatables -->
    <link href="/huvmts/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/huvmts/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed mCustomScrollbar _mCS_1 mCS-autoHide">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/huvmts/Accounts/admin/" class="site_title"><img src="/huvmts/asset/images.jpg" alt="..." class="img-circle" width="50px" height="50px"> <span>HUTMVTS</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <?php echo '<img class="img-circle profile_img img-responsive" src="data:image/jpeg;base64,'.base64_encode( $_SESSION['profilepicture'] ).'"/>'?>
              </div>
              <div style="color: #ff8000; font-size: 32px;" class="profile_info">
                <span style="color: #ff8000; font-size: 22px;">Welcome,</span>
                <h2><?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3 style="font-size: 22px;color: #ff8000;">Administrator</h3>
                <ul class="nav side-menu">
                  <li class="<?php echo $AdminHome;?>"><a href="/huvmts/Accounts/Admin"><i class="fa fa-home"></i> Home </a></li>
                  <li class="<?php echo $AdminAdd;?>"><a href="/huvmts/Accounts/Admin/Add User"><i class="fa icon-add-user"></i> Add User</a></li>
                  <li class="<?php echo $AdminUpdate;?>"><a href="/huvmts/Accounts/Admin/Update User"><i class="fa icon-user"></i> Update user</a></li>
                  <li class="<?php echo $AdminRemove;?>"><a href="/huvmts/Accounts/Admin/Remove User"><i class="fa icon-remove-user"></i> Remove user</a></li>
                  <li class="<?php echo $AdminSee;?>"><a href="/huvmts/Accounts/Admin/See All Users"><i class="fa icon-users"></i>See all users</a></li>
                  <li class="<?php echo $AdminPost;?>">
                    <a><i class="fa icon-message"></i>Post<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/huvmts/Accounts/Admin/Post/index.php">Add post</a></li>
                      <li><a href="/huvmts/Accounts/Admin/Post/Updat post.php">See post</a></li>
                    </ul>
                  </li>
                  <li class="<?php echo $vehicle;?>">
                    <a><i class="fa icon-truck"></i>Vehicle<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/huvmts/Accounts/Admin/vehicle/index.php">Add vehicle</a></li>
                      
                    </ul>
                  </li>
                  <li class="<?php echo $driver;?>">
                    <a><i class="fa icon-users"></i>Driver<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/huvmts/Accounts/Admin/driver/index.php">Add Driver</a></li>
                    </ul>
                  </li>
                  <li class="<?php echo $passenger;?>">
                    <a><i class="fa icon-user"></i>Passenger<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/huvmts/Accounts/Admin/passenger/index.php">Add passenger</a></li>
                     
                    </ul>
                  </li>
                  <li>
                    <a><i class="fa icon-envelop"></i>Message<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/huvmts/Accounts/Admin/Message/index.php">inbox</a></li>
                      <li><a href="/huvmts/Accounts/Admin/message/outbox.php">write message</a></li>
                      <li><a href="/huvmts/Accounts/Admin/message/sented.php">outbox</a></li>
                    </ul>
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
                    <li><a href="/huvmts/accounts/admin/profile.php"> Profile</a></li>
                    <li>
                      <a href="/huvmts/Accounts/Admin/edit profile.php">
                        <i class="fa fa-cogs pull-right"></i>Settings
                      </a>
                    </li>
                    <li><a href="/huvmts/Accounts/Admin/Help.php"><i style="color:brown" class="fa fa-question-circle pull-right"></i>User Help</a></li>
                    <li><a href="/huvmts/class/PHP/distroySession.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3> <small></small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <form action = "/Huvmts/accounts/admin/search.php" method = "get">
                    <div class="input-group">
                      <input name="query" type="text" class="form-control" placeholder="Search for...">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go!</button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
            </div>