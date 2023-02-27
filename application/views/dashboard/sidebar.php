
            <div class="navbar nav_title" style="border: 0; text-align: center">
              <a href="" class="">
                  <!--<img src="<?php // echo base_url('assets/images/logo.png'); ?>" height="55px" >-->
                  LOGO
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo assets('images/img.jpg'); ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $this->session->userdata('username'); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <!--<h3>General</h3>-->
                <ul class="nav side-menu">
                    
                    <?php if($this->session->userdata('user_type_id')==1){ ?>
                        <li class="side_menu <?php echo ($this->uri->segment(1)=='employees') ? 'active' : ''; ?>">
                            <a href="<?php echo site_url('employees'); ?>">
                                <i class="fa fa-address-book"></i> 
                                Employees
                            </a>
                        </li>
                    <?php } ?>
                    
                    <li class="side_menu <?php echo ($this->uri->segment(1)=='attendance') ? 'active' : ''; ?>">
                        <a href="<?php echo site_url('attendance/scan'); ?>">
                            <i class="fa fa-clock-o"></i> 
                            Time Record
                        </a>
                    </li>
                    
                    <?php if($this->session->userdata('user_type_id')==1){ ?>
                        <li class="side_menu <?php echo ($this->uri->segment(1)=='users') ? 'active' : ''; ?>">
                            <a href="<?php echo site_url('users'); ?>">
                                <i class="fa fa-user"></i> 
                                Users
                            </a>
                        </li>
                    <?php } ?>
                            
                </ul>
              </div>
                

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <!--<a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>-->
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo site_url('login/logout'); ?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
            