
<table class="table table-hover" id="tbl_user_type">
        <thead>
                <tr>
                        <th style="width:10%;">#</th>
                        <th style="width:20%;"><label class="sort" id="user_name" title="Sort by Username"><i class="icon-info"></i> Username</label></th>
                        <th style="width:20%;"><label class="sort" id="user_type_name" title="Sort by User Type">User Type</label></th>
                        <th style="width:20%;"><label class="sort" id="datetime_added" title="Sort by Date Added">Date Added</label></th>
                        <th style="width:20%;"><label class="sort" id="datetime_updated" title="Sort by date last updated">Last Updated</label></th>
                        <th style="width:10%;">Actions</th>
                </tr>
        </thead>

        <tbody id="family_table">                            

                <?php 
                $num = $details['aa'];
                $count = 0;
                if(@$records){
                foreach ($records as $row){
                        $count++; 
                        $num++; ?>
                        <tr class="odd gradeX">
                            <td><?php echo $num; ?></td>
                            <td><?php echo $row->user_name; ?></td>
                            <td><?php echo $row->user_type_name; ?></td>
                            <td><?php echo date('F j, Y',strtotime($row->datetime_added)).'<br>'.date('h:i A',strtotime($row->datetime_added)); ?></td>
                            <td><?php echo @$row->datetime_modified!='' ? date('F j, Y',strtotime($row->datetime_modified)).'<br>'.date('h:i A',strtotime($row->datetime_modified)) : '---'; ?></td>
                            
                            <td>
                                <a href="<?php echo site_url('users/edit/'.$row->userid); ?>" title="Edit" >
                                    <button type="button" class="btn btn-primary btn-xs edit" id="<?php echo $row->userid; ?>" ><i class="fa fa-pencil"></i> Edit</button>
                                </a>
                                <?php if($this->session->userdata('userid')!=$row->userid){ ?>
                                        <a href="<?php echo site_url('users/delete/'.$row->userid); ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this user account? This cannot be undone.')">
                                            <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</button>
                                        </a>
                                <?php } ?>
                            </td>
                        </tr>
                <?php }
                } ?>

        </tbody>

</table>

                          
<?php
$details['num'] = $count;
$this->load->view('mytable/my_table_pagination',$details); 
?>

<br>
<br>
<br>
