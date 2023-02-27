<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Attendance extends CI_Model 
{
    
	function __construct(){
		parent:: __construct();
	}
        
        
        function get_employee_byqr($qrcode)
        {
		$query = $this->db->query("SELECT * FROM employees
                                            WHERE qrcode='".$qrcode."' ");
                return $query->result();
        }
        
	function validate_scan()
	{
                $this->form_validation->set_rules('qrcode', 'QR Code', 'required|trim');
                $this->form_validation->set_rules('dtr_type', 'DTR type (in or out)', 'required|trim');
                
                $this->form_validation->set_error_delimiters('<label style="font-weight:normal;">', '</label>');
		return $this->form_validation->run();
	}
        
        
        function check_dtr_exist($employee_id)
        {
		$query = $this->db->query("SELECT * FROM dtr
                                            WHERE employee_id=".$employee_id." and date_added LIKE '".date('Y-m-d')."%' ");
                return $query->result();
	}
        
        
        function save_dtr()
        {
                $qrcode = $this->input->post('qrcode');
                $employee = $this->get_employee_byqr($qrcode);
                
                if(!$employee){
                    return false;
                }
                
                $this->db->trans_start();
                
                $data = array(
                    'employee_id' => @$employee[0]->id_employee,
                    'user_id' => $this->session->userdata('userid'),
                    'date_added' => date('Y-m-d H:i:s'),
                );
                
                if($this->input->post('dtr_type')=='in'){
                    $data += array(
                        'time_in' => date('Y-m-d H:i:s'),
                    );
                } else {
                    $data += array(
                        'time_out' => date('Y-m-d H:i:s'),
                    );
                    
                }
                
                
                
		$query = $this->db->query("SELECT * FROM dtr
                                            WHERE employee_id=".@$employee[0]->id_employee." and date_added LIKE '".date('Y-m-d')."%' ");
                $dtr_exist = $query->result();
                
                if(@$dtr_exist){
                    
                        $this->db->where('id_dtr',@$dtr_exist[0]->id_dtr);
                        $res = $this->db->update('dtr',$data);
                        
                } else {
                        $res = $this->db->insert('dtr',$data);
                }
                
                
                $this->db->trans_complete();
                
                return $res;
        }
        
        function get_attendance($condition='',$page,$num_list,$order_by, $sort_by='desc')
        {
                $order_by = $order_by ? $order_by : 'date_added';
		if($num_list!='all' && $num_list!='') $limit =" limit ".($page-1)*$num_list.", ".$num_list." ";
                else $limit='';
                
		$query = $this->db->query("SELECT  *
                                            FROM dtr
                                            LEFT JOIN employees ON id_employee=employee_id
                                            WHERE id_dtr!='' ".$condition." 
                                            ORDER BY ".$order_by." ".$sort_by." ".$limit."
                                            ");
		return $query->result();
        }
        
        function count_attendance($condition='')
        {
		$query = $this->db->query("SELECT count(*) as counts 
                                            FROM dtr
                                            LEFT JOIN employees ON id_employee=employee_id
                                            WHERE id_dtr!='' ".$condition." ");
                return $query->row('counts');
        }
        
        
        
        function save_employee($employee_id='')
        {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                );
                
                $this->db->trans_start();
                
                if($employee_id==''){
                    $data += array(
                        'datetime_added' => date('Y-m-d H:i:s'),
                        'created_by' => 1//$this->session->userdata('userid')
                    );
                    $action = 'ADD';
                    $res = $this->db->insert('employees',$data);
                    $employee_id = $this->db->insert_id();
                    
                    if($res){
                        $this->load->helper(array('phpqrcode_helper'));
                        $idno = "emp-".str_pad($employee_id,4,"0",STR_PAD_LEFT);
                        $fileName2 = phpqr($idno);
                        
                        $data2 = array(
                            'qrcode' => $idno,
                            'qrcode_file' => $fileName2
                        );
                        $this->db->where('id_employee',$employee_id);
                        $this->db->update('employees',$data2);
                    }
                
                } else {
                    $data += array(
                        'datetime_updated' => date('Y-m-d H:i:s')
                    );
                    $action = 'UPDATE';
                    $this->db->where('id_employee',$employee_id);
                    $res = $this->db->update('employees',$data);
                }
                    
                $his_data = array(
                    'history_date'=>date('Y-m-d H:i:s'),
                    'history_name'=>$employee_id,
                    'history_category'=>'EMPLOYEES',
                    'history_action'=>$action,
                    'history_user'=>1,//$this->session->userdata('userid'),
                    'history_ip_address'=>$this->session->userdata('ip_address'),
                    'history_comp'=>gethostbyaddr($_SERVER['REMOTE_ADDR']),
                );
                $this->db->insert('history',$his_data);
                
                $this->db->trans_complete();
                
                return $res;
        }
        
        function delete_employee($employee_id)
        {
                $details = $this->get_employees_details($employee_id);
                
                $this->db->where('id_employee',$employee_id);
                $res = $this->db->delete('employees');
                
                $his_data = array(
                    'history_date'=>date('Y-m-d H:i:s'),
                    'history_name'=>$employee_id,
                    'history_category'=>'EMPLOYEES',
                    'history_action'=>'DELETE',
                    'history_remarks'=>@$details[0]->first_name.' '.@$details[0]->last_name,
                    'history_user'=>1,//$this->session->userdata('userid'),
                    'history_ip_address'=>$this->session->userdata('ip_address'),
                    'history_comp'=>gethostbyaddr($_SERVER['REMOTE_ADDR']),
                );
                $this->db->insert('history',$his_data);
                
                return $res;
        }
        
        
}

?>