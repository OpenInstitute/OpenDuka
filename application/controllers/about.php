<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	public function index($start=0)
	{
		$data_head = array('page_title' => 'About Us | Open Duka');
		$this->load->view('header',$data_head);
		$this->load->view('about');
		$this->load->view('footer');
	}
}