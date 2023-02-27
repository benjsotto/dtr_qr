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
                                    <li><a href="<?php echo site_url('employees'); ?>">
                                            <h3 style="margin: 0 0 0 !important;">
                                                <i class="fa fa-address-book"></i> 
                                                Employees
                                            </h3>
                                        </a>
                                    </li>
                                    <li class="active"><?php echo @$employee_name=='' ? '(New record)' : @$employee_name.' (edit)'; ?></li>
                                </ul>
                        </div>
                        <div class="title_right">
                                <ul class="nav navbar-right panel_toolbox" style="">
                                    <li style="">
                                        <a href="<?php echo site_url('employees'); ?>" class="btn btn-app" title="Back to Employees">
                                            <i class="glyphicon glyphicon-arrow-left" style="padding-bottom: 5px; color: #337ab7 !important;"></i> <span>Back to Employees</span>
                                        </a>
                                    </li>
                                </ul>
                        </div>
             
                </div>
             
                <div class="col-lg-12">
                        <?php $this->load->view('dashboard/messages'); ?>
                </div>

                <div class="clearfix"></div>
                    
                    
                <div class="row">

                            
                        <div class="col-md-12">
                            
                                <div class="x_panel">
                                        <div class="x_title">
                                                <h2><?php echo @$employee_name=='' ? 'New record' : 'Update record'; ?></h2>

                                                <div class="clearfix"></div>
                                        </div>

                                        <div class="x_content customer_form">

                                                <form id="user_form" method="post" action="<?php echo site_url($this->uri->uri_string()); ?>" class="form-horizontal form-label-left" data-parsley-validate>

                                                        <!-------------ITEM-INFORMATION--------------------------------------------------->
                                                        <div class="x_title">
                                                                <h4>Employee Information</h4>
                                                                <div class="clearfix"></div>
                                                        </div>
                                    
                                                        <div class="col-md-6 center-margin">

                                                                <?php if(@$details){ ?>
                                                                    <div class="form-group" style="border-bottom: none; padding-bottom: 5px;">
                                                                           <label class="col-sm-3 control-label">QR Code</label>
                                                                           <div class="col-sm-8">
                                                                               <img src="<?php echo base_url('assets/images/qrcodes/'.@$details[0]->qrcode_file); ?>">
                                                                           </div>
                                                                    </div>
                                                                <?php } ?>

                                                                <div class="form-group" style="border-bottom: none; padding-bottom: 5px;">
                                                                       <label class="col-sm-3 control-label">*First name</label>
                                                                       <div class="col-sm-8 <?php echo form_error('first_name')!='' ? 'has-error has-feedback' : ''; ?>">
                                                                           <?php if(form_error('first_name')!=''){ ?><span><label class="control-label"><?php echo form_error('first_name'); ?></label><span class="glyphicon glyphicon-warning-sign form-control-feedback"></span></span><?php } ?>
                                                                           <input type="text" name="first_name" class="form-control" value="<?php echo set_value('first_name') ? set_value('first_name') : @$details[0]->first_name; ?>">
                                                                       </div>
                                                                </div>
                                                                <div class="form-group" style="border-bottom: none; padding-bottom: 5px;">
                                                                       <label class="col-sm-3 control-label">*Last name</label>
                                                                       <div class="col-sm-8 <?php echo form_error('last_name')!='' ? 'has-error has-feedback' : ''; ?>">
                                                                           <?php if(form_error('last_name')!=''){ ?><span><label class="control-label"><?php echo form_error('last_name'); ?></label><span class="glyphicon glyphicon-warning-sign form-control-feedback"></span></span><?php } ?>
                                                                           <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name') ? set_value('last_name') : @$details[0]->last_name; ?>">
                                                                       </div>
                                                                </div>
                                                            
                                                                <div class="form-group">
                                                                </div>
                                                            
                                                                <div class=" center-margin" style="text-align: center !important;">
                                                                        <button type="submit" id="save_user" class="btn btn-lg btn-success">Save</button>
                                                                        <a href="<?php echo site_url('employees'); ?>">
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
