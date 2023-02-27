<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Employee extends CI_Model 
{
    
	function __construct(){
		parent:: __construct();
	}
        
        
        function get_employees($condition='',$page,$num_list,$order_by, $sort_by='asc')
        {
                $order_by = $order_by ? $order_by : 'last_name';
		if($num_list!='all' && $num_list!='') $limit =" limit ".($page-1)*$num_list.", ".$num_list." ";
                else $limit='';
                
		$query = $this->db->query("SELECT  *
                                            FROM employees
                                            WHERE id_employee!='' ".$condition." 
                                            ORDER BY ".$order_by." ".$sort_by." ".$limit."
                                            ");
		return $query->result();
        }
        
        function count_employees($condition='')
        {
		$query = $this->db->query("SELECT count(*) as counts 
                                            FROM employees
                                            WHERE id_employee!='' ".$condition." ");
                return $query->row('counts');
        }
        
        
        
        function get_employees_details($employee_id)
        {
		$query = $this->db->query("SELECT * FROM employees
                                            WHERE id_employee=".$employee_id." ");
                return $query->result();
        }
        
	function validate_employee()
	{
                $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
                $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
                
                $this->form_validation->set_error_delimiters('<label style="font-weight:normal;">', '</label>');
		return $this->form_validation->run();
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
                        'created_by' => $this->session->userdata('userid')
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
                    'history_user'=>$this->session->userdata('userid'),
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
                    'history_user'=>$this->session->userdata('userid'),
                    'history_ip_address'=>$this->session->userdata('ip_address'),
                    'history_comp'=>gethostbyaddr($_SERVER['REMOTE_ADDR']),
                );
                $this->db->insert('history',$his_data);
                
                return $res;
        }
        
        
}

?>