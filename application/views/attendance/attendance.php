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
                                                Employee Time Record
                                            </h3>
                                        </a>
                                    </li>
                                </ul>
                        </div>
                        <div class="title_right">
                                <ul class="nav navbar-right panel_toolbox" style="">
                                        <li style="">
                                            <a href="<?php echo site_url('attendance/scan'); ?>" class="btn btn-app" title="Scan QR Code">
                                                <i class="fa fa-clock-o" style="padding-bottom: 5px; color: #26B99A !important;"></i> <span>Time In / Time Out</span>
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

                        <div class="col-xs-12">

                                <div class="x_panel">
                                        <div class="x_title">
                                                <h2>Employee Time Record</h2>

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



<script src="<?php echo base_url('assets/my_js/myscript/my_table.js'); ?>"></script>

<script type="text/javascript">
        $(document).ready(function(){
                
                url = '<?php echo site_url('attendance/load_attendance_table') ?>';
                load_listevent('','');

                $('#search_event_list').on('change',function(){
                        load_listevent('','');
                });
        });
</script>