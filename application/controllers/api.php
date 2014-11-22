<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class api extends CI_Controller {
	
	
	public function __construct()   {
            parent::__construct();
            // Your own constructor code
             $this->load->helper(array('form','url'));
             $this->load->library('form_validation');
             $this->load->library(array('session'));
             $this->load->database();
            
             
             date_default_timezone_set('Africa/Nairobi');
		
       }
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
				$content = $this->api_m->get_entry_cont('Name',$EntityName);
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
	//$this->output->enable_profiler(true); 
		$this->load->model('api_m');
		if((!isset($_GET['key']))||(!isset($_GET['id']))){
			$result = array("error"=>"missing key and or entity id");
			print (json_encode($result));
		}else{
			//check key validity
			if($this->api_m->valid_key($_GET['key']))
			{
				$doc = array();
			//	echo $_GET['id']; exit;
				$result = $this->api_m->get_entries('ID',$_GET['id']);
				$docmap = explode(',',$result[0]['DocID']);
				//var_dump($docmap); exit;
				foreach($docmap as $k => $d){
				
				  if(!in_array($d, $doc)){ 
				  	$doc[] = ($d != "") ? $d : null ;
				  }
				}
				
				$maps= '{"data":[';
				//var_dump($doc);
				if(sizeof($doc)>0){
					for($i=0; $i<sizeof($doc); $i++){
					$doc_ref = $doc[$i];
					if (isset($doc_ref)){
					$dataset = $this->api_m->get_doc($doc_ref);
					
				$maps.= '{"dataset_type":[{"'. $dataset[0]['DocTypeName'] .'": [{"dataset":';	
					$dt=$dataset[0]['data_table'];
					$dtID=$dataset[0]['DocTypeID'];
						if($dt!=""){
						
							$d=1; 
							$ds=$dataset[0]['representation'];
							$q = ($ds=="")? '*' : $ds;

							$dta = $this->api_m->get_dataset($dt,$q,$_GET['id']);
							var_dump($dta); 
				$maps.=			json_encode($dta);
							
						}
				$maps.= '}]}]},';
					}
					}
				}
				$maps.= "]}";
				$maps = str_replace(",]","]",$maps);
				print ($maps);
			}else{
				$result = array("error"=>"key provided is not valid");
				print (json_encode($result));
			}
		}
	}
}
?>
