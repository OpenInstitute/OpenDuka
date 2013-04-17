<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	  public function __construct()
       {
            parent::__construct();
            // Your own constructor code
       }
       
	public function index()
	{
		if(($this->session->userdata('user_name')!=""))
		{	
			$data['page_title'] = 'Admin Dashboard';		
			$this->load->view('header',$data);
			$this->load->view('admin', $data);
			$this->load->view('footer', $data);
			
		}
		else
		{
			redirect('/user');
		}
	}

}