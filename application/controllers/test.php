<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['title'] = "Home"; 
		session_start();
		if (isset($_SESSION['id']) ) {
			$data['user_id'] = $_SESSION['id'];
			//$this->load->library('post');
			$this->load->view('modal/header',$data);
			$this->load->view('test_view',$data);
		}
		else
			header ('Location: http://localhost/Secretags/landing');
			
		
	}
	
	public function profile()
	{
		$data['title'] = "Profile"; 
		session_start();
		if (isset($_SESSION['id']) ) {
			$data['user_id'] = $_SESSION['id'];
			$id = $this->uri->segment(3);
			$data['id'] = $id;
			$this->load->view('modal/header',$data);
			$this->load->view('profile_view',$data);
		}
		else
			header ('Location: http://localhost/Secretags/landing');
		
	}
	
	public function recentposts()
	{
		$data['title'] = "Recent Posts"; 
		session_start();
		if (isset($_SESSION['id']) ) {
			$data['user_id'] = $_SESSION['id'];
			$this->load->view('modal/header',$data);
			$this->load->view('recent_view',$data);
		}
		else
			header ('Location: http://localhost/Secretags/landing');
		
	}
	
	public function _post_conff()
	{
		$time = time();	
		$conff = array(
		   'conff' => $_POST['conff'] ,
		   'user_id' => $_POST['user_id'] ,
		   'gender' => $_POST['gender'],
		   'type'	=> $_POST['type'],
		   'time' => $time,
		   'activity_time' => $time
		);
		
		$this->security->xss_clean($conff);
		
		$this->db->insert('conff', $conff); 
									
		$last_conff_id = $this->db->insert_id();
		
		if(isset($_POST['tags']))
		{
			$tags = $_POST['tags'];
			for($i=0;$i<sizeof($tags);$i++)
			{
				$tag = $tags[$i];
				$this->db->select('tag_id');
				$this->db->where('tag', $tag); 
				$check = $this->db->get('tag');
				//$check = mysql_query("SELECT * FROM tag WHERE tag = '$tag' ");

				if($check->num_rows()==0)
				{
					$tag_array = array(
					   'time' => $time,
					   'tag' => $tag ,
					   'user_id' => $_POST['user_id'] 
					);
			
					$this->db->insert('tag', $tag_array);
					// mysql_query("INSERT INTO tag (tag,user_id) 
												// VALUES ('$tag','$user_id')");
					$last_tag_id = $this->db->insert_id();
				}
				else
					{
					$last_tag_array = $check->row_array();
					$last_tag_id = $last_tag_array['tag_id'];
					}
				
				$this->db->select('id');
				$this->db->where('tag_id', $last_tag_id); 
				$this->db->where('user_id', $_POST['user_id']); 
				$check_user_tag = $this->db->get('user_tag');
				//$check_user_tag = mysql_query("SELECT * FROM user_tag WHERE user_id = '$user_id' AND tag_id = '$last_tag_id' ");
				if($check_user_tag->num_rows()==0)
				{
					$tag_array = array(
					   'tag_id' => $last_tag_id ,
					   'time' => $time,
					   'user_id' => $_POST['user_id'] 
					);
			
					$this->db->insert('user_tag', $tag_array);
					// mysql_query("INSERT INTO user_tag (tag_id,user_id) 
												// VALUES ('$last_tag_id','$user_id')");
				}
				
				$tag_array = array(
					   'tag_id' => $last_tag_id ,
					   'conff_id' => $last_conff_id 
					);
			
					$this->db->insert('conff_tag', $tag_array);
				// mysql_query("INSERT INTO conff_tag (conff_id,tag_id) 
											// VALUES ('$last_conff_id','$last_tag_id')");
			}
		
		}
		
	}
}
