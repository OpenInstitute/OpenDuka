<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class api extends CI_Controller {
	public function index(){
		$data['title'] = "API Home";
		$this->load->view('api/header', $data);
		$this->load->view('api/api', $data);
		$this->load->view('api/footer');
	}
	public function request_key(){
		$data['title'] = "Request API Key";
		
		$this->load->model('api_m');
		
		$data['result'] = $this->api_m->request_key($_POST);
		
		$this->load->view('api/header', $data);
		$this->load->view('api/request_key', $data);
		$this->load->view('api/footer');
	}
	public function confirm(){
		$this->load->model('api_m');
		$data['title'] = 'Confirmation';
		
		$data['result'] =$this->api_m->confirm($_GET['code'], $_GET['email'], $_GET['app']);
				
		$this->load->view('api/header', $data);
		$this->load->view('api/request_key', $data);
		$this->load->view('api/footer');
	}
}
?>
