
<table class="table table-hover" id="tbl_user_type">
        <thead>
                <tr>
                        <th style="width:5%;">#</th>
                        <th style="width:10%;"><label class="sort" id="qrcode" title="Sort by ID #">ID #</label></th>
                        <th style="width:20%;"><label class="sort" id="last_name" title="Sort by Last name">Last Name</label></th>
                        <th style="width:20%;"><label class="sort" id="first_name" title="Sort by First Name">First Name</label></th>
                        <th style="width:20%;"><label class="sort" id="time_in" title="Sort by Time IN">Time IN</label></th>
                        <th style="width:20%;"><label class="sort" id="time_out" title="Sort by Time Out">Time OUT</label></th>
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
                            <td><?php echo $row->qrcode; ?></td>
                            <td><?php echo $row->last_name; ?></td>
                            <td><?php echo $row->first_name; ?></td>
                            <td><?php echo date('F j, Y',strtotime($row->time_in)).'<br>'.date('h:i A',strtotime($row->time_in)); ?></td>
                            <td><?php echo $row->time_out!='' ? date('F j, Y',strtotime($row->time_out)).'<br>'.date('h:i A',strtotime($row->time_out)) : '---'; ?></td>
                            
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
