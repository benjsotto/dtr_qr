<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

        function __construct() 
        {
                parent::__construct();
                $this->load->model('mdl_attendance');
                
        }
        
	function index()
	{
                $this->load->view('attendance/attendance');                
	}
        
        function scan()
        {
                if (!$this->mdl_attendance->validate_scan()) {
                    
                        $this->load->view('attendance/attendance_form');      
                
                } else {
                        $employee = $this->mdl_attendance->get_employee_byqr($this->input->post('qrcode'));
                        $exist = $this->mdl_attendance->check_dtr_exist(@$employee[0]->id_employee);
                    
                        if (!@$employee) {
                            
                                $data['qr_error'] = 'Invalid QR code!';
                                $this->load->view('attendance/attendance_form',$data);    
                                
                        }  else if($this->input->post('dtr_type')=='in' && @$exist[0]->time_in!=''){
                            
                                $data['qr_error'] = 'Employee has already TIME IN record for today!';
                                $this->load->view('attendance/attendance_form',$data);    
                            
                        } else if($this->input->post('dtr_type')=='out' && @$exist[0]->time_out!=''){
                            
                                $data['qr_error'] = 'Employee has already TIME OUT record for today!';
                                $this->load->view('attendance/attendance_form',$data);    
                            
                        } else {
                        
                                $res = $this->mdl_attendance->save_dtr();

                                if($res){
                                    $this->session->set_flashdata('success','DTR successfully saved!');
                                } else {
                                    $this->session->set_flashdata('error','Something went wrong while saving daily time record.');
                                }
                                redirect('attendance','refresh');
                                
                        }
                }
        }
        
        function load_attendance_table()
        {
                $search = trim($_POST['search']);
                $page2 = $_POST['page'];
                $limit = $_POST['limit'];
                $order_by = $_POST['order_by'];
                $sort_by = $_POST['sort_by'];
                        
		$page=1;
		if($page2!='') $page=$page2;
		$num_list=$limit;
                
		$condition="";
		if($search!=''){
			$condition="and (last_name like '%".($search)."%' or first_name like '%".($search)."%' or qrcode like '%".($search)."%'  )";
		} else {
                }

		$event_count = $this->mdl_attendance->count_attendance($condition);
		$event_list = $this->mdl_attendance->get_attendance($condition,$page,$num_list,$order_by,$sort_by);
		
                $max_page = ($num_list!='all') ? ceil($event_count/$num_list) : 0;
		$page = ($page>$max_page) ? 1 : $page;
                
                $data['records']=$event_list;
                $data['details']= array(
                    'aa'=>($num_list*$page)-$num_list,
                    'page'=>$page,
                    'num_list'=>$num_list,
                    'event_count'=>$event_count,
                    'max_page'=>$max_page,
                    'num'=>0
                );
                
                $this->load->view('attendance/attendance_table',$data);
        }
        
	function _form($employee_id='')
	{
                $data = '';
                if($employee_id!=''){
                    $data['employee_name'] = $this->mdl_attendance->get_employees_details($employee_id);
                    $data['details'] = $this->mdl_attendance->get_employees_details($employee_id);
                    $data['employee_name'] = @$data['details'][0]->first_name.' '.@$data['details'][0]->last_name;
                }
                $this->load->view('attendance/attendance_form',$data);  
	}

        
        function add()
        {
                if (!$this->mdl_attendance->validate_employee()) {
                    
                        $this->_form();
                
                } else {
                    
                        $res = $this->mdl_attendance->save_employee();
                        
                        if($res){
                            $this->session->set_flashdata('success','Employee successfully saved!');
                        } else {
                            $this->session->set_flashdata('error','Something went wrong while saving employee.');
                        }
                        redirect('employees','refresh');
                    
                }
        }
        
        function edit($employee_id)
        {
                if (!$this->mdl_attendance->validate_employee($employee_id)) {
                    
                        $this->_form($employee_id);
                
                } else {
                    
                        $res = $this->mdl_attendance->save_employee($employee_id);
                        if($res){
                            $this->session->set_flashdata('success','Employee successfully supdated!');
                        } else {
                            $this->session->set_flashdata('error','Something went wrong while updating employee.');
                        }
                        redirect('employees','refresh');
                    
                }
        }
        
        
        function delete($employee_id)
        {
                $res = $this->mdl_attendance->delete_employee($employee_id);
                if($res==1){
                    $this->session->set_flashdata('success','Employee successfully deleted!');
                } else {
                    $this->session->set_flashdata('error','Deleting employee failed!');
                }
                redirect('employees','refresh');
        }
        

}

?>