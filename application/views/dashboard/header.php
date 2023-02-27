
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <link rel="shortcut icon" href="<?php echo images('icon2.png'); ?>">
    <title>Daily Time Record System</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="<?php echo assets('build/css/custom.css'); ?>" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
          
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
		  
                        <?php $this->load->view('dashboard/sidebar'); ?>
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
                    <img src="<?php echo assets('images/img.jpg'); ?>" alt=""><?php echo $this->session->userdata('username'); ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <!--<li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>-->
                    <!--<li><a href="javascript:;">Change Password</a></li>-->
                    <li><a href="<?php echo site_url('login/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                    <li role="presentation" class="dropdown">
                            <!--<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                  <a>
                                    <span class="image"><img src="<?php // echo assets('images/img.jpg'); ?>" alt="Profile Image" /></span>
                                    <span>
                                      <span>John Smith</span>
                                      <span class="time">3 mins ago</span>
                                    </span>
                                    <span class="message">
                                      Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                  </a>
                                </li>
                                <li>
                                  <a>
                                    <span class="image"><img src="<?php // echo assets('images/img.jpg'); ?>" alt="Profile Image" /></span>
                                    <span>
                                      <span>John Smith</span>
                                      <span class="time">3 mins ago</span>
                                    </span>
                                    <span class="message">
                                      Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                  </a>
                                </li>
                            </ul>
                            -->
                    </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
