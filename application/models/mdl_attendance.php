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
        
        
        
}

?>