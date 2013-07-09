<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
       public function __construct()
       {
            parent::__construct();
            // Your own constructor code
             $this->load->helper(array('form','url'));
             $this->load->library('form_validation');
             $this->load->library(array('session'));
             $this->load->database();
             $this->load->model(array('user_model','admin_model'));
             	
		if(($this->session->userdata('user_name')==""))
		{
			redirect('/user');
		}
       }
       
	public function index()
	{
			$data['page_title'] = 'Admin Dashboard';		
			$this->load->view('header',$data);
			$this->load->view('admin', $data);
			$this->load->view('footer', $data);
	}
	public function manage_users(){
	
		$data['page_title'] = 'Manage Users';
		$this->load->view('header_admin', $data);
		$this->load->view('footer', $data);
		
	}
	
	function entityAdd()
	{
				
			$items=$this->input->post('items');
			$DocName = $this->input->post('src0');
			$Appointer = $this->input->post('appointer0');
			
			$DocID = $this->admin_model->get_document_entry($DocName) ? : $this->admin_model->insert_document($DocName);
			//echo $items; // exit;
		
			for ($i=0; $i<$items; $i++) {
			//echo $this->input->post('entity'.$i); exit;
				$data = array(
				'EntityTypeID' => $this->input->post('type'.$i),
				'Name' => $this->input->post('entity'.$i),
				'UniqueInfo' => $this->input->post('address'.$i),
				'EffectiveDate' => $this->input->post('startdate'.$i) . ' : ' . $this->input->post('enddate'.$i),
				'Verb' => $this->input->post('verb'.$i),
				
				'UserID' => $this->session->userdata('user_id')
				);
				//var_dump($data);echo 'tuko';exit;
				if ($i==0){
					$data['Appointer'] = $Appointer;
					//var_dump($data);exit;
					$rootID = $this->admin_model->insert_entity_root($data, $DocID);
					//echo $rootID; exit;
				} else {
					if ($i==1){
						$belongto = $this->input->post('belong');
						$rowID = $this->admin_model->insert_entity($data,$DocID,$rootID);
						if ($belongto=="on") {$rootID = $rowID;}
					} else {
						$this->admin_model->insert_entity($data,$DocID,$rootID);
					}
				}
			}
					
					//$this->load->view('formsuccess');
		redirect('/admin');
		
	}
	
	
    
    

}
