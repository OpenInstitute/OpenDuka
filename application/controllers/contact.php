<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function index($start=0)
	{
		$data_head = array('page_title' => 'Contact Us | Open Duka');
		$this->load->view('header',$data_head);
		$this->load->view('contact');
		$this->load->view('footer');
	}
}