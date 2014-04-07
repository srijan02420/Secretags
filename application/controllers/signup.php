<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
		}

	public function register()
	{
		if (!$this->input->is_ajax_request()) {
		   redirect('404');
		}
		$gender = $_POST['gender'];
		
		if($gender=="male")
			$gender = 1;
		else
			$gender = 2;
		
		$time = time();
		
		$user = array(
		   'name' => $_POST['name'] ,
		   'user_id' => $_POST['id'] ,
		   'time' => $time,
		   'email' => $_POST['email'],
		   'gender' => $gender,
		   'country' => $_POST['location'],
		   's_pic' => $_POST['pic']
		);
		
		$this->security->xss_clean($user);
		
		$this->db->select('user_id');
		$this->db->where('email', $user['email']); 
		$check = $this->db->get('users');
		
		if($check->num_rows()==0)
				{			
					$this->db->insert('users', $user);
				}	
				
		$friends = $_POST['friends'];
		$fbs = explode(",",$friends);
		for($i=0;$i<sizeof($fbs);$i++)
		{
			$fb = $fbs[$i];
			$this->db->select('user_id');
			$this->db->where('user_id', $fb); 
			$check1 = $this->db->get('users');
			
			if($check1->num_rows()>0)
				{			
					$this->db->select('user_id');
					$this->db->where('friend_id', $fb); 
					$this->db->where('user_id', $user['user_id']); 
					$check2 = $this->db->get('user_friend');
					if($check2->num_rows()==0)
						{
							$user_friend = array(
							   'user_id' => $_POST['id'] ,
							   'friend_id' => $fb 
							);
							$this->db->insert('user_friend', $user_friend);
						}
					
					$this->db->select('user_id');
					$this->db->where('friend_id', $user['user_id']); 
					$this->db->where('user_id', $fb); 
					$check3 = $this->db->get('user_friend');
					if($check3->num_rows()==0)
						{
							$user_friend = array(
							   'user_id' => $fb ,
							   'friend_id' => $_POST['id'] 
							);
							$this->db->insert('user_friend', $user_friend);
						}
				}	
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */