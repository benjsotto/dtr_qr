<?php $this->load->view('dashboard/header'); ?>

    
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
                                </ul>
                        </div>
                        <div class="title_right">
                                <ul class="nav navbar-right panel_toolbox" style="">
                                    <?php //if(@$access->add){ ?>
                                        <li style="">
                                            <a href="<?php echo site_url('employees/add'); ?>" class="btn btn-app" title="Add Employee">
                                                <i class="glyphicon glyphicon-plus-sign" style="padding-bottom: 5px; color: #26B99A !important;"></i> <span>Add New</span>
                                            </a>
                                        </li>
                                    <?php //} ?>
                                </ul>
                        </div>
                </div>
            
                <div class="col-lg-12">
                        <?php $this->load->view('dashboard/messages'); ?>
                </div>

                <div class="clearfix"></div>
                
                <div class="row">

                        <div class="col-xs-12">

                                <div class="x_panel">
                                        <div class="x_title">
                                                <h2>Employees</h2>

                                                <div class="clearfix"></div>
                                        </div>

                                        <div class="x_content">
                                                <?php $this->load->view('mytable/my_table_body'); ?>
                                        </div>
                                    
                                </div>
                            
                        </div>
                            
                    
                </div>
        </div>
</div>
<!-- /page content -->
        
    
<?php $this->load->view('dashboard/footer'); ?>

    <!-- iCheck -->
    <!--<script src="<?php // echo assets('vendors/iCheck/icheck.min.js'); ?>"></script>-->
    

<link href="<?php echo base_url('assets/my_js/loadmask/jquery.loadmask.css'); ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('assets/my_js/loadmask/jquery.loadmask.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/my_js/myscript/my_table.js'); ?>"></script>
<!--<script src="<?php // echo base_url('assets/my_js/myscript/customers.js'); ?>"></script>-->


<script type="text/javascript">
        $(document).ready(function(){
                
                url = '<?php echo site_url('employees/load_employees_table') ?>';
                load_listevent('','');

                $('#search_event_list').on('change',function(){
                        load_listevent('','');
                });
        });
</script>