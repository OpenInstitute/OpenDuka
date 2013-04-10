<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trees extends CI_Controller {

    
       
       function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
	}

	function index($id)
	{
		//echo 'trees';exit;
		
		//$id = $_REQUEST['ID'];	
		//echo $id;exit;
		$File_Name = $_POST['filename'];		
		//echo $context;exit;
		$doc_data = array('title' => $File_Name,'DocText' => $context );
		$DocID = $this->post->insert_document($doc_data);
		
		
		$apikey = "sp3u4wvyqbpx34zauxqp7qr";
		$oc = new OpenCalais($apikey);
		
		$entities = $oc->getEntities($context);
		$entity_info = "";
		$entity_type_db = "";
		$entity_val_db = "";
		//$tree .= $File_Name;
		$tree .= '{"name": "'.$File_Name.'", "children": [';
		$size = 2000;
		foreach ($entities as $type => $values) {
			
			$entity_type_db .= $type .",";
			
			$entity_info.= "<b>" . $type . "</b>";
			$entity_info.= "<ul>";
					
			foreach ($values as $entity) {
				$entity_info.= "<li>" . $entity . "</li>";
			//	$entity_val_db .= $entity .",";
				$this->post->insert_entity($type,$entity,$DocID);
			}
			$entity_info.= "</ul>";
			
			//	$entity_val_db = "";
			//----------build tree -------	
				$growtree = array('Person','Company','Organisation');
				if (in_array($type, $growtree)) {
				
					foreach ($values as $entity) {
					  $out1 = $this->post->get_entries($type,$entity);
					  
					  if(is_array($out1)){
					  	foreach ($out1 as $tier1 ) {
					  	$tree .= '{"name": "'.$tier1[$type].'"';
					  	
						 	$out2 = $this->post->get_entry2($type,$tier1['DocID']);
						 	if(is_array($out2)){
							$tree .= ', "children": [';
						 		foreach ($out2 as $tier2 ) {
								$tree .= '{"name": "'.$tier2[$type].'"';
									$out3 = $this->post->get_entry2($type,$tier2['DocID']);
						 			if(is_array($out3)){
									$tree .= ', "children": [';
										$tree .= '{ "name":"mwisho", "size": '.$size.'}';
										$size = $size+1;
									$tree .= ']}';	
									} else {
								 	$tree .= ', "size":  '. $size.'}';
								 	$size = $size+1;
							   		}
								
							 	}
		//					 	$tree .= substr($tree,0,-1);
						 		$tree .= ']}';	
							 } else {
							 $tree .= ', "size":  '. $size.'}';
							 $size = $size+1;
							 }
							
		//					$tree .= substr($tree,0,-1);
						}	
					//	$tree .= ']}';	 
						  
					   }  else {
					   $tree .= ', "size":  '. $size.'}';
					   $size = $size+1;
					   }
					//  $tree .= ']}';
					}
						
				}
				
		}
		$tree .= ']}';
		$tree =str_replace(',]}',']}',$tree);
		$tree =str_replace('},}','}}',$tree);
		$tree =str_replace('}{','},{',$tree);
		$tree = json_encode($tree);
				$entity_data = array('DocType' => $entity_type_db);
				$this->post->update_document($entity_data,$DocID);
		$entity_type_db = "";
		
		$content=array('entities' => $entity_info,'filename' => $File_Name,'tree' => $tree,'error' => '');
		$data_head = array('page_title'     => 'Tree Map');


		$this->load->view('header',$data_head);
		$this->load->view('tree',$content);
		$this->load->view('footer');

	}
			
}

/* End of file posts.php */
/* Location: ./application/controllers/posts.php */