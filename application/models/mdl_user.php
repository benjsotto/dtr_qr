<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_User extends CI_Model 
{
    
	function __construct(){
		parent:: __construct();
	}
        
        
        function get_users($condition='',$page,$num_list,$order_by, $sort_by='asc')
        {
                $order_by = $order_by ? $order_by : 'user_name';
		if($num_list!='all' && $num_list!='') $limit =" limit ".($page-1)*$num_list.", ".$num_list." ";
                else $limit='';
                
		$query = $this->db->query("SELECT * FROM users
                                            LEFT JOIN user_types ON id_user_type=user_type
                                            WHERE userid!='' ".$condition." 
                                            ORDER BY ".$order_by." ".$sort_by." ".$limit."
                                            ");
		return $query->result();
        }
        
        function count_users($condition='')
        {
		$query = $this->db->query("SELECT count(*) as counts 
                                            FROM users
                                            LEFT JOIN user_types ON id_user_type=user_type
                                            WHERE userid!='' ".$condition." ");
                return $query->row('counts');
        }
        
        function get_user_types()
        {
		$query = $this->db->query("SELECT * FROM user_types
                                            ORDER BY id_user_type ASC
                                            ");
		return $query->result();
        }
        
	function validate_user_account($userid='')
	{
                $username = ($userid=='') ? '|is_unique[users.user_name]' : '' ;
                $password = ($userid=='') ? '|required' : '' ;
                
                $this->form_validation->set_rules('user_type_id', 'User Type', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[30]|trim'.$username);
                $this->form_validation->set_rules('password', 'Password', 'min_length[10]|max_length[30]|matches[confirm_password]|trim'.$password);
                $this->form_validation->set_rules('confirm_password', 'Confirm Password','trim'.$password);
                
                $this->form_validation->set_error_delimiters('<label style="font-weight:normal;">', '</label>');
		return $this->form_validation->run();
	}
        
        
	//Create strong password 
	public function valid_password($password1 = '')
	{
		$password = trim($this->input->post('password'));

		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>~]/';

		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			//$this->form_validation->set_message('valid_password', 'The  field must be at least one lowercase letter.');
			return FALSE;
		}

		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			//$this->form_validation->set_message('valid_password', 'The field must be at least one uppercase letter.');
			return FALSE;
		}

		if (preg_match_all($regex_number, $password) < 1)
		{
			//$this->form_validation->set_message('valid_password', 'The  field must have at least one number.');
			return FALSE;
		}

		if (preg_match_all($regex_special, $password) < 1)
		{
			//$this->form_validation->set_message('valid_password', 'The  field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>ยง~'));
			return FALSE;
		}

		/*if (strlen($password) < 5)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');
			return FALSE;
		}
		if (strlen($password) > 32)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');
			return FALSE;
		}*/

		return TRUE;
	}
        
        function randomPassword($len = 8) {

                //enforce min length 8
                if($len < 8)
                    $len = 8;

                //define character libraries - remove ambiguous characters like iIl|1 0oO
                $sets = array();
                $sets[] = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
                $sets[] = 'abcdefghjkmnpqrstuvwxyz';
                $sets[] = '0123456789';
                $sets[]  = '!@#$%^&*()\-_=+{};:,<.>~';

                $password = '';

                //append a character from each set - gets first 4 characters
                foreach ($sets as $set) {
                    $password .= $set[array_rand(str_split($set))];
                }

                //use all characters to fill up to $len
                while(strlen($password) < $len) {
                    //get a random set
                    $randomSet = $sets[array_rand($sets)];

                    //add a random char from the random set
                    $password .= $randomSet[array_rand(str_split($randomSet))]; 
                }

                //shuffle the password string before returning!
                return str_shuffle($password);
        }
        
        
        
        
        function get_users_details($userid)
        {
		$query = $this->db->query("SELECT * FROM users
                                            WHERE userid=".$userid." ");
                return $query->result();
        }
        
        
        function save_user_account($userid='')
        {
                $data = array(
                    'user_name' => $this->input->post('username'),
                    'user_type' => $this->input->post('user_type_id'),
                );
                if($this->input->post('password')!=''){
                    $data += array(
                        'user_password' => md5($this->input->post('password'))
                    );
                }
                
                $this->db->trans_start();
                
                if($userid==''){
                    $data += array(
                        'datetime_added' => date('Y-m-d H:i:s'),
                        'created_by' => $this->session->userdata('userid')
                    );
                    $action = 'ADD';
                    $res= $this->db->insert('users',$data);
                    $userid = $this->db->insert_id();
                } else {
                    $data += array(
                        'datetime_modified' => date('Y-m-d H:i:s')
                    );
                    $action = 'UPDATE';
                    $this->db->where('userid',$userid);
                    $res= $this->db->update('users',$data);
                }
                    
                $his_data = array(
                    'history_date'=>date('Y-m-d H:i:s'),
                    'history_name'=>$userid,
                    'history_category'=>'USER ACCOUNTS',
                    'history_action'=>$action,
                    'history_user'=>$this->session->userdata('userid'),
                );
                $this->db->insert('history',$his_data);
                $this->db->trans_complete();
                
                return $res;
        }
        
        function delete_user_account($userid)
        {
                $details = $this->get_users_details($userid);
                
                $this->db->where('userid',$userid);
                $stat = $this->db->delete('users');
                
                $his_data = array(
                    'history_date'=>date('Y-m-d H:i:s'),
                    'history_name'=>$userid,
                    'history_category'=>'USER ACCOUNTS',
                    'history_action'=>'DELETE',
                    'history_remarks'=>@$details[0]->user_name,
                    'history_user'=>$this->session->userdata('userid'),
                );
                $this->db->insert('history',$his_data);
                
                return $stat;
        }
        
        
}

?>