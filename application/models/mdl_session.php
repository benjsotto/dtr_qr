<?php 

class Mdl_Session extends CI_Model{
        
	function __construct(){
		parent:: __construct();
	}
        
        function login_validation()
        {
                $query = $this->db->query("SELECT *
                                            FROM users
                                            LEFT JOIN user_types ON id_user_type=user_type
                                            WHERE binary user_name ='" . ($this->input->post('user_name') ). "' 
                                                 and binary user_password ='". md5($this->input->post('user_password')) . "'");
		return $query->result();
        }
        
        
        function save_login()
        {
                $data = array(
                    'last_login'=>date('Y-m-d H:i:s')
                );
                $this->db->where('userid',$this->session->userdata('userid'));
                $this->db->update('users',$data);
                
                $data2 = array(
                    'logs_date'=>date('Y-m-d H:i:s'),
                    'logs_user'=>$this->session->userdata('userid'),
                    'logs_action'=>'LOGIN',
                    'logs_ip_address'=>$this->session->userdata('ip_address'),
                    'logs_comp'=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
                );
                $this->db->insert('logs',$data2);
        }
	
	function userid_login_attempt()
	{
		$user = $this->input->post('user_name');
		$query = $this->db->query("SELECT userid from users where binary user_name ='" . ($user) . "'");
		return $query->row('userid');
	}
        
        function save_login_attempt($userid)
        {
                $data2 = array(
                    'logs_date'=>date('Y-m-d H:i:s'),
                    'logs_user'=>$userid,
                    'logs_action'=>'LOGIN ATTEMPT',
                    'logs_ip_address'=>$this->session->userdata('ip_address'),
                    'logs_comp'=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
                );
                $this->db->insert('logs',$data2);
        }
        
        function save_logout()
        {
                $data2 = array(
                    'logs_date'=>date('Y-m-d H:i:s'),
                    'logs_user'=>$this->session->userdata('userid'),
                    'logs_action'=>'LOGOUT',
                    'logs_ip_address'=>$this->session->userdata('ip_address'),
                    'logs_comp'=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
                );
                $this->db->insert('logs',$data2);
        }
        
        function save_user_password($user_password)
        {
                $data = array(
                    'user_password' => md5($user_password),
                    'user_password_expired' => 0,
                    'date_updated' => date('Y-m-d H:i:s')
                );
                $this->db->where('userid',$this->session->userdata('userid'));
                $this->db->update('users',$data);
            

                $his_data = array(
                    'history_date'=>date('Y-m-d H:i:s'),
                    'history_name'=>$this->session->userdata('userid'),
                    'history_category'=>'ACCOUNTS',
                    'history_action'=>'UPDATE',
                    'history_user'=>$this->session->userdata('userid'),
                    'history_ip_address'=>$this->session->userdata('ip_address'),
                    'history_comp'=>gethostbyaddr($_SERVER['REMOTE_ADDR']),
                );
                $this->db->insert('history',$his_data);
        }
        
        
}
?>
