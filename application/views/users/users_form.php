<?php $this->load->view('dashboard/header'); ?>

<style type="text/css">

    label.required {
        color: #a94442;
    }
  article, aside, figure, footer, header, hgroup, 
  menu, nav, section { display: block; }

</style>
        <!-- page content -->
<div class="right_col" role="main">
        <div class="">

                <div class="page-title">
                        <div class="title_left" style="">
                                <!--breadcrumbs start -->
                                <ul class="breadcrumb" style="">
                                    <li><a href="<?php echo site_url('users'); ?>">
                                            <h3 style="margin: 0 0 0 !important;">
                                                <i class="fa fa-user"></i> 
                                                Users
                                            </h3>
                                        </a>
                                    </li>
                                    <li class="active"><?php echo @$details=='' ? '(New record)' : @$details[0]->user_name.' (edit)'; ?></li>
                                </ul>
                        </div>
                        <div class="title_right">
                                <ul class="nav navbar-right panel_toolbox" style="">
                                    <li style="">
                                        <a href="<?php echo site_url('users'); ?>" class="btn btn-app" title="Back to Users">
                                            <i class="glyphicon glyphicon-arrow-left" style="padding-bottom: 5px; color: #337ab7 !important;"></i> <span>Back to Users</span>
                                        </a>
                                    </li>
                                </ul>
                        </div>
             
                </div>
             
                <div class="col-lg-12">
                        <?php $this->load->view('dashboard/messages'); ?>
                    <?php echo validation_errors(); ?>
                </div>

                <div class="clearfix"></div>
                    
                    
                <div class="row">

                            
                        <div class="col-md-12">
                            
                                <div class="x_panel">
                                        <div class="x_title">
                                                <h2>New record</h2>

                                                <div class="clearfix"></div>
                                        </div>

                                        <div class="x_content customer_form">

                                                <form id="user_form" method="post" action="<?php echo site_url($this->uri->uri_string()); ?>" class="form-horizontal form-label-left" data-parsley-validate>

                                                        <!-------------ITEM-INFORMATION--------------------------------------------------->
                                                        <div class="x_title">
                                                                <h4>User Information</h4>
                                                                <div class="clearfix"></div>
                                                        </div>
                                    
                                                        <div class="col-md-6 center-margin">

                                                                <div class="form-group" style="border-bottom: none; padding-bottom: 5px;">
                                                                    <label class="col-sm-3 control-label">*User Type</label>
                                                                    <div class="col-sm-8 <?php echo form_error('user_type_id') ? 'has-error has-feedback' : ''; ?>">
                                                                        <?php if(form_error('user_type_id')){ ?><span><label class="control-label"><?php echo form_error('user_type_id'); ?></label><span class="glyphicon glyphicon-warning-sign form-control-feedback"></span></span><?php } ?>
                                                                           <select name="user_type_id" class="form-control">
                                                                            <option value="">Select...</option>
                                                                            <?php 
                                                                            $user_type_post = set_value('user_type_id') ? set_value('user_type_id') : @$details[0]->user_type;
                                                                            foreach($user_types as $user_type){ ?>
                                                                                    <option value="<?php echo $user_type->id_user_type; ?>" <?php echo $user_type_post==$user_type->id_user_type ? 'selected' : ''; ?>><?php echo $user_type->user_type_name; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            
                                                                <div class="form-group" style="border-bottom: none; padding-bottom: 5px;">
                                                                    <label class="col-sm-3 control-label">*Username</label>
                                                                    <div class="col-sm-8 <?php echo form_error('username') ? 'has-error has-feedback' : ''; ?>">
                                                                        <?php if(form_error('username')){ ?><span><label class="control-label"><?php echo form_error('username'); ?></label><span class="glyphicon glyphicon-warning-sign form-control-feedback"></span></span><?php } ?>
                                                                           <input type="text" name="username" class="form-control" value="<?php echo set_value('username') ? set_value('username') : @$details[0]->user_name; ?>" maxlength="30">
                                                                    </div>
                                                                </div>
                                                            
                                                    
                                                            <div class="form-group" style="border-bottom: none; padding-bottom: 5px; margin-bottom: 0px;">
                                                                <label class="col-sm-3 control-label">* <?php echo @$details ? ' Change ' : ''; ?>Password</label>
                                                                <div id="div_password" class="col-sm-8 <?php echo form_error('password')!='' || @$pass_error ? 'has-error has-feedback' : ''; ?>">
                                                                    <?php if(form_error('password')!='' || @$pass_error){ ?><span id="err_password"><label class="control-label"><?php echo form_error('password').$pass_error; ?></label><span class="glyphicon glyphicon-warning-sign form-control-feedback"></span></span><?php } ?>
                                                                    <input type="password" name="password" id="password" class="form-control" maxlength="50">
                                                                </div>
                                                            </div>


                                                            <div class="form-group" style="border-bottom: none; padding-bottom: 5px;">
                                                                <label class="col-sm-3 control-label">*Confirm Password</label>
                                                                <div id="div_confirm_password" class="col-sm-8 <?php echo form_error('confirm_password')!='' ? 'has-error has-feedback' : ''; ?>">
                                                                    <?php if(form_error('confirm_password')!=''){ ?><span id="err_confirm_password"><label class="control-label"><?php echo form_error('confirm_password'); ?></label><span class="glyphicon glyphicon-warning-sign form-control-feedback"></span></span><?php } ?>
                                                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" maxlength="50">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group" style="border-bottom: none; padding-bottom: 5px;">
                                                                <label class="col-sm-3 control-label"></label>
                                                                <div class="col-sm-8">
                                                                    <button type="button" id="generate_pass" class="btn btn-default btn-xs" style="display: inline-block; width: 30%;">Generate password</button>
                                                                    <input type="text" name="generated_password" id="generated_password" class="form-control" maxlength="50"  style="display: inline-block; width: 60%;">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="min-height: 30px;">
                                                                <label class="col-sm-3 control-label"></label>
                                                                <div class="col-sm-8" id="generate_pass_div"></div>
                                                            </div>
                                                            
                                                            
                                                                <div class="form-group">
                                                                </div>
                                                            
                                                                <div class=" center-margin" style="text-align: center !important;">
                                                                        <button type="submit" id="save_user" class="btn btn-lg btn-success">Save</button>
                                                                        <a href="<?php echo site_url('users'); ?>">
                                                                            <button class="btn btn-primary" type="button" onclick="return confirm('Are you sure you want to cancel?')">Cancel</button>
                                                                        </a>
                                                                </div>
                                                         
                                                        </div>

                                                </form>

                                        </div>
                                </div>
                        </div>
                    
                </div>
        </div>
</div>
<!-- /page content -->
        
    
<?php $this->load->view('dashboard/footer'); ?>


<script type="text/javascript">
        $(document).ready(function(){
                
                $("#generate_pass").on('click',function(){
                    
                            //$('#generate_pass_div').html('Generating password... Please wait.');
                            $.ajax({
                                    url: '<?php echo site_url('users/generate_password'); ?>',
                                    success:function(result){
                                            $('#generated_password').val(result);
                                            $('#confirm_password').val(result);
                                            $('#password').val(result);
                                            
                                            $('#div_password').attr('class','col-sm-8');
                                            $('#err_password').hide();
                                            $('#div_confirm_password').attr('class','col-sm-8');
                                            $('#err_confirm_password').hide();
                                            
                                            //$('#generate_pass_div').html('');
                                    }
                            });
                });
        });
</script>