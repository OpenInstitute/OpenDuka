<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	  public function __construct()
       {
            parent::__construct();
            // Your own constructor code
			if(($this->session->userdata('user_name')==""))
			{
				redirect('/user');
			}
       }
       
	public function index()
	{
			$data['page_title'] = 'Admin Dashboard';		
			$this->load->view('header_admin',$data);
			$this->load->view('admin', $data);
			$this->load->view('footer', $data);
	}
	public function manage_users(){
	
		$data['page_title'] = 'Manage Users';
		$this->load->view('header_admin', $data);
		$this->load->view('users',$data);
		$this->load->view('add_user', $data);
		$this->load->view('footer', $data);
		
	}

}