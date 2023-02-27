
<table class="table table-hover" id="tbl_user_type">
        <thead>
                <tr>
                        <th style="width:5%;">#</th>
                        <th style="width:10%;"><label class="sort" id="qrcode" title="Sort by ID #">ID #</label></th>
                        <th style="width:20%;"><label class="sort" id="last_name" title="Sort by Last name">Last Name</label></th>
                        <th style="width:20%;"><label class="sort" id="first_name" title="Sort by First Name">First Name</label></th>
                        <th style="width:20%;"><label class="sort" id="datetime_added" title="Sort by Date Added">Date Added</label></th>
                        <th style="width:20%;"><label class="sort" id="datetime_updated" title="Sort by date last updated">Last Updated</label></th>
                        <th style="width:5%;">Actions</th>
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
                        <tr class="odd gradeX" >
                            <td><?php echo $num; ?></td>
                            <td><a href="<?php echo base_url('assets/images/qrcodes/'.$row->qrcode_file); ?>" target="_blank" title="View QR Code">
                                    <b style="text-decoration: underline;"><?php echo $row->qrcode; ?></b>
                                </a>
                            </td>
                            <td><?php echo $row->last_name; ?></td>
                            <td><?php echo $row->first_name; ?></td>
                            <td><?php echo date('F j, Y',strtotime($row->datetime_added)).'<br>'.date('h:i A',strtotime($row->datetime_added)); ?></td>
                            <td><?php echo $row->datetime_updated!='' ? date('F j, Y',strtotime($row->datetime_updated)).'<br>'.date('h:i A',strtotime($row->datetime_updated)) : '---'; ?></td>
                            
                            <td>
                                    <a href="<?php echo site_url('employees/edit/'.@$row->id_employee); ?>" title="Edit" >
                                        <button type="button" class="btn btn-primary btn-xs edit" id="<?php echo @$row->userid; ?>" ><i class="fa fa-pencil"></i> Edit</button>
                                    </a>
                                    <a href="<?php echo site_url('employees/delete/'.@$row->id_employee); ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this employee? This cannot be undone.')">
                                        <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</button>
                                    </a>
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
