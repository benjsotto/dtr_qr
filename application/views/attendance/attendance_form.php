<?php $this->load->view('dashboard/header'); ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    
        <!-- page content -->
<div class="right_col" role="main">
        <div class="">

                <div class="page-title">
                        <div class="title_left" style="">
                                <!--breadcrumbs start -->
                                <ul class="breadcrumb" style="">
                                    <li><a href="<?php echo site_url('attendance'); ?>">
                                            <h3 style="margin: 0 0 0 !important;">
                                                <i class="fa fa-address-book"></i> 
                                                Employee Time Record
                                            </h3>
                                        </a>
                                    </li>
                                    <li class="active">Time In / Time Out</li>
                                </ul>
                        </div>
                        <div class="title_right">
                                <ul class="nav navbar-right panel_toolbox" style="">
                                    <?php //if(@$access->add){ ?>
                                        <li style="">
                                            <a href="<?php echo site_url('attendance'); ?>" class="btn btn-app" title="View Employees Time In & Out">
                                                <i class="glyphicon glyphicon-calendar" style="padding-bottom: 5px; color: #26B99A !important;"></i> <span>View DTR List</span>
                                            </a>
                                        </li>
                                    <?php //} ?>
                                </ul>
                        </div>
                </div>
            
                <div class="col-lg-12">
                        <?php $this->load->view('dashboard/messages'); 
                        if(@$qr_error!=''){ ?>
                            <div class="alert alert-danger" id="error" role="alert">
                                    <?php echo @$qr_error; ?>
                            </div>
                        <?php }
                        if(validation_errors()){ ?>
                            <div class="alert alert-danger" id="error" role="alert">
                                    <?php echo validation_errors(); ?>
                            </div>
                        <?php } ?>
                </div>

                <div class="clearfix"></div>
                
                <div class="row">

                        <div class="col-xs-12">

                                <div class="x_panel">
                                        <div class="x_title">
                                                <h2>Time In / Time Out</h2>

                                                <div class="clearfix"></div>
                                        </div>
                                    
                                        <div class="x_content">
                                            <div class="col-md-6 center-margin">
                                                    <div class="row center-margin">
                                                        <div class="col-md-12">
                                                            <div class="col-md-6">
                                                                <button type="button" dtr_type="in" id="btn_in" class="btn_dtr_type btn btn-block <?php echo set_value('dtr_type')=='in' || set_value('dtr_type')=='' ? 'btn-lg btn-success' : ''; ?>">Time In</button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button type="button" dtr_type="out" id="btn_out" class="btn_dtr_type btn btn-block <?php echo set_value('dtr_type')=='out' ? 'btn-lg btn-danger' : ''; ?>">Time Out</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            
                                            <div class="col-md-6 center-margin">
                                                
                                                    <form id="scan_form" method="post" action="<?php echo site_url('attendance/scan'); ?>" class="form-horizontal form-label-left" data-parsley-validate>

                                                        <div class="row center-margin">
                                                            <div class="col-md-12">
                                                                <video id="preview" width="100%"></video>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="col-md-12">
                                                                    <label class="control-label">SCAN QR CODE</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="qrcode" id="text" placeholder="QR Code" class="form-control input-lg" maxlength="20">
                                                                    <input type="hidden" name="dtr_type" id="dtr_type" value="in">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <button type="submit" id="save_user" class="btn btn-lg btn-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                                        
                                                        </div>
                                                        
                                                    </form>
                                            </div>
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
                
                $('.btn_dtr_type').on('click',function(){
                        var dtr_type = $(this).attr('dtr_type');
                        $('#dtr_type').val(dtr_type);
                        if(dtr_type=='in'){
                            $('#btn_out').removeClass( "btn-danger btn-lg" );
                            $('#btn_in').addClass( "btn-success btn-lg" );
                        } else {
                            $('#btn_out').addClass( "btn-danger btn-lg" );
                            $('#btn_in').removeClass( "btn-success btn-lg" );
                        }
                });
                
        });
        
        
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0 ){
                scanner.start(cameras[0]);
            } else{
                alert('No cameras found');
            }

        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan',function(c){
            document.getElementById('text').value=c;
        });

</script>