<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session extends CI_Controller {

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
		
		session_start();
		if (isset($_GET['id']) ) {
		
			if (isset($_GET['url']) ) {
				$id = $_GET['id'];
				$_SESSION['id'] = $id;
				header ('Location: '.$_GET['url']);
			}
			else{
				$id = $_GET['id'];
				$_SESSION['id'] = $id;
				header ('Location: http://localhost/Secretags/home');
			}
		}
		
		else
			header ('Location: http://localhost/Secretags/landing');
	//$this->load->view('test_view');
	}
	
	public function logout()
	{
		session_start();
		session_destroy();
		header ('Location: http://localhost/Secretags/landing');
	}
}