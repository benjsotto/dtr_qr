<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?php echo images('icon.png'); ?>">
    <title>Daily Time Record System</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <!-- Custom Theme Style -->
    <link href="<?php echo assets('build/css/custom.css'); ?>" rel="stylesheet">
  </head>

<style type="text/css">
    .login_content h1:before, .login_content h1:after {
        top:100px !important;
    }

</style>

  <body class="login" style="background-color: #777777;">
    <div>
        

      <div class="login_wrapper" style="max-width: 500px !important;">
        <div class="animate form login_form">
          <section class="login_content" style="padding: 25px 10px 5px 10px !important; background-color: white; margin-right: 20px; margin-left: 20px;">
              
            <form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">
                
                    <h1 style="font-size: 35px !important; color: #780001; font-weight: bold !important; line-height: 30px !important;">
                        <!--<img src="<?php // echo base_url('assets/images/logo.png'); ?>" height="140px" style="padding: 10px; padding-left:20px;">-->
                        <br>
                        Daily Time Record System
                    </h1>
                
                    <?php if ($this->session->flashdata('error')){ ?>
                        <div class="alert alert-danger" id="error" role="alert" style="text-shadow: none;">
                            <i class="fa fa-exclamation-circle" style="font-size: large;"></i> <?php echo @$this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>
                
                
                    <div style="margin-right: 20px; margin-left: 20px;">
                        <label class="col-form-label label-align" for="user_name">Username</label>
                        <input type="text" name="user_name" class="form-control" required="" />
                    </div>
                    <div style="margin-right: 20px; margin-left: 20px;">
                        <label class="col-form-label label-align" for="user_password">Password</label>
                        <input type="password" name="user_password" class="form-control" required="" />
                    </div>
                
                    <div>
                      <button type="submit" class="btn btn-lg btn-primary">Login</button>
                      <!--<a class="reset_pass" href="#">Lost your password?</a>-->
                    </div>

                
                    <div class="clearfix"></div>

                    <div class="separator">
                      <p class="change_link"><em>For Authorized staff use only.
                          </em>
                      </p>

                      <div class="clearfix"></div>
                    </div>
            </form>
          </section>
        </div>

          
      </div>
    </div>
  </body>
</html>