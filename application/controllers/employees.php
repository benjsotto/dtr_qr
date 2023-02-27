<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Employees extends CI_Controller {

        function __construct() 
        {
                parent::__construct();
                
                if($this->session->userdata('user_type_id')!=1){
                    $this->session->set_flashdata('error','You don\'t have access to Employees module.');
                    redirect('attendance','refresh');
                }
                
                $this->load->model('mdl_employee');
                
        }
        
	function index()
	{
                $data['access'] = '';//json_decode(modules::run('settings/user_types/get_class_access'));
                $this->load->view('employees/employees',$data);                
	}
        
        function load_employees_table()
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

		$event_count = $this->mdl_employee->count_employees($condition);
		$event_list = $this->mdl_employee->get_employees($condition,$page,$num_list,$order_by,$sort_by);
		
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
                
                $this->load->view('employees/employees_table',$data);
        }
        
	function _form($employee_id='')
	{
                $data = '';
                if($employee_id!=''){
                    $data['employee_name'] = $this->mdl_employee->get_employees_details($employee_id);
                    $data['details'] = $this->mdl_employee->get_employees_details($employee_id);
                    $data['employee_name'] = @$data['details'][0]->first_name.' '.@$data['details'][0]->last_name;
                }
                $this->load->view('employees/employees_form',$data);  
	}

        
        function add()
        {
                if (!$this->mdl_employee->validate_employee()) {
                    
                        $this->_form();
                
                } else {
                    
                        $res = $this->mdl_employee->save_employee();
                        
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
                if (!$this->mdl_employee->validate_employee($employee_id)) {
                    
                        $this->_form($employee_id);
                
                } else {
                    
                        $res = $this->mdl_employee->save_employee($employee_id);
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
                $res = $this->mdl_employee->delete_employee($employee_id);
                if($res==1){
                    $this->session->set_flashdata('success','Employee successfully deleted!');
                } else {
                    $this->session->set_flashdata('error','Deleting employee failed!');
                }
                redirect('employees','refresh');
        }
        

}

?>