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
	public function documentation(){
		$data['title'] = "Documentation";
		$this->load->view('api/header', $data);
		$this->load->view('api/documentation', $data);
		$this->load->view('api/footer', $data);
	}
	public function confirm(){
		$this->load->model('api_m');
		$data['title'] = 'Confirmation';
		
		$data['result'] =$this->api_m->confirm($_GET['code'], $_GET['email'], $_GET['app']);
				
		$this->load->view('api/header', $data);
		$this->load->view('api/request_key', $data);
		$this->load->view('api/footer');
	}
	public function search(){
		$this->load->model('api_m');
		$this->load->model('tree');
		if((!isset($_GET['key']))||(!isset($_GET['term']))){
			$result = array("error"=>"missing key and or search term");
			print (json_encode($result));
		}else{
			//check key validity
			if($this->api_m->valid_key($_GET['key']))
			{
				//return result
				$EntityName = $_GET['term'];		
				//echo $context;exit;
				$content = $this->tree->get_entry_cont('Name',$EntityName);
				//var_dump($content[0]);
				$list = array();
				if (is_array($content)){
					for($i=0;$i< count($content);$i++)
					{
						$list = array("name"=>$content[$i]['Name'], "id"=>$content[$i]['ID'])+$list; 
					}		
				}
				print (json_encode($content));
			}else{
				$result = array("error"=>"key provided is not valid");
				print (json_encode($result));
			}
		}
	}
	public function entity(){
		$this->load->model('api_m');
		$this->load->model('tree');
		if((!isset($_GET['key']))||(!isset($_GET['id']))){
			$result = array("error"=>"missing key and or entity id");
			print (json_encode($result));
		}else{
			//check key validity
			if($this->api_m->valid_key($_GET['key']))
			{
				$result = $this->tree->get_entries('ID',$_GET['id']);
				print (json_encode($result));
			}else{
				$result = array("error"=>"key provided is not valid");
				print (json_encode($result));
			}
		}
	}
}
?>
