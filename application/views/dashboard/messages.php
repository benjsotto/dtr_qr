<?php if ($this->session->flashdata('login_error')){ ?>
    <div class="alert alert-danger" id="error" role="alert">
        <?php echo $this->session->flashdata('login_error'); ?>
    </div>
<?php } ?>

<?php if ($this->session->flashdata('login_success')){ ?>
    <div id="login_success">
        <?php echo $this->session->flashdata('login_success'); ?>
    </div>
<?php } ?>


<?php

if ($this->session->flashdata('success')){ ?>
    
    <div class="alert alert-success" id="success" role="alert">
            <?php echo $this->session->flashdata('success');?>
    </div>
    
<?php }

if ($this->session->flashdata('error')){ ?>
    
    <div class="alert alert-danger" id="error" role="alert">
            <?php echo $this->session->flashdata('error');?>
    </div>
    
<?php }

if ($this->session->flashdata('failed')){ ?>
    
    <div class="alert alert-danger" id="error" role="alert">
            <?php echo $this->session->flashdata('failed');?>
    </div>
    
<?php }

if ($this->session->flashdata('warning')){ ?>
    
    <div class="alert alert-warning" id="warning" role="alert">
            <?php echo $this->session->flashdata('warning');?>
    </div>
    
<?php }

if (@$warning){ ?>
    
    <div class="alert alert-warning" id="warning" role="alert">
            <b>Warning!</b> <?php echo $warning;?>
    </div>
    
<?php } ?>

<!--<div class="alert alert-danger" id="error2" role="alert">
        
            The system will be down for system update @ 3:00-3:15 PM (15 minutes only).
</div>-->