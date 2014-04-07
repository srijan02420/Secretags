<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secretpost extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
		}

	public function post($id)
	{
		$data['id'] = $id;
		if (isset($_GET['go']) )
			$data['go'] = $_GET['go'];
		else
			$data['go'] = 1;
			//echo $data['go'];
		session_start();
		if (isset($_SESSION['id']) ) {
			$data['user_id'] = $_SESSION['id'];
			$this->load->view('post_view',$data);
		}
		else{
			$data['user_id'] = '0';
			$this->load->view('post_view',$data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */