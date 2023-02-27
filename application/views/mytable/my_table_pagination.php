
<?php 
if($event_count>$num_list) {
    echo 'Showing '.(($aa)+1).' to '.(($aa)+$num).' of '.$event_count.' entries'; 
} else if($event_count==1) {
    echo 'Showing only '.$event_count.' entry'; 
} else if($event_count<=10) {
    echo 'Showing '.$event_count.' entries'; 
} else {
    echo 'Showing no entries';
} ?>

<div id="pagination" class="btn-toolbar" role="toolbar" style="float:right; margin-top: -20px;">
        <div class="btn-group">

            <input type="hidden" id="max_page" value="<?php echo $max_page; ?>">
            <input type="hidden" id="cur_page" value="<?php echo $page; ?>">

            <ul class="pagination pagination-sm">

                <?php for($i=1; $i<=$max_page; $i++){ ?>

                    <li class="<?php if($page==1) echo 'disabled'; ?>"><a class='page_button'>First</a></li>
                    <li class="<?php if($page==1) echo 'disabled'; ?>"><a class='page_button'>Previous</a></li>


                    <?php 
                    for($i=1; $i<=$max_page; $i++){
                        if($page<=3 && $i<=5){ ?>
                            <li class="<?php if($page==$i) echo 'active'; ?>">
                                <a class='page_button'><?php echo $i; ?></a>
                            </li>
                        <?php } else if(($page==$max_page || $page>=$max_page-2) && $i>($max_page-5)){ ?>
                            <li class="<?php if($page==$i) echo 'active'; ?>">
                                <a class='page_button'><?php echo $i; ?></a>
                            </li>
                        <?php } else if($page>3){
                            if($i>=($page-2) && $i<=($page+2)){ ?>
                            <li class="<?php if($page==$i) echo 'active'; ?>">
                                <a class='page_button'><?php echo $i; ?></a>
                            </li>
                        <?php }
                        }
                    } ?>

                    <li class="<?php if($page==$i) echo 'active'; else if($page==$max_page) echo 'disabled'; ?>"><a class='page_button'>Next</a></li>
                    <li class="<?php if($page==$i) echo 'active'; else if($page==$max_page) echo 'disabled'; ?>"><a class='page_button'>Last</a></li>       

                <?php } ?>

            </ul>
        </div>
</div>

<script src="<?php echo base_url('assets/my_js/myscript/my_table.js'); ?>"></script>