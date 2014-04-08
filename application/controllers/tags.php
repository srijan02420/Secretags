<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
		}
	
	public function index()
	{
		
		
	}
	function tag(){
		$data['title'] = "Tag"; 
		session_start();
		if (isset($_SESSION['id']) ) {
			$data['user_id'] = $_SESSION['id'];
			$id = $this->uri->segment(3);
			$data['tag_id'] = $id;
			$this->load->view('modal/header',$data);
			$this->load->view('tag_view',$data);
		}
		else
			header ('Location: http://localhost/Secretags/landing');
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */