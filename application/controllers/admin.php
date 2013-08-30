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
	$verbs= $this->verb_words();
	//echo $verbs;
			$data['page_title'] = 'Admin Dashboard';
			$this->load->view('header',$data);
			$this->load->view('admin', array('verb_word'=> $verbs));
			$this->load->view('footer');
	}
	
	public function manage_users(){
	
		$data['page_title'] = 'Manage Users';
		$this->load->view('header_admin', $data);
		$this->load->view('footer', $data);
		
	}
	
	
	function entityAdd_test()
	{
		$data = array('items' => '3', 'submit' => '1', 'errors' => 'Tuko');
		    //echo validation_errors();
		    echo json_encode($data);
	}
		
	function entityAdd()
	{
	//$this->output->enable_profiler(TRUE); 			
		$items=$this->input->post('items');
		$DocName =  str_replace("'","`",$this->input->post('src0'));
		$Appointer = ucwords(strtolower(str_replace("'","`",$this->input->post('appointer0'))));
	//alert($items);
		
		$this->form_validation->set_rules('src0', 'Source file', 'trim|required');
		for ($j=0; $j<$items; $j++) {
			$this->form_validation->set_rules('entity'.$j, 'Entity'.$j, 'trim|required');
			$this->form_validation->set_rules('startdate'.$j, 'Start Date'.$j, 'trim|required');
		}

		if ($this->form_validation->run() == FALSE) {
		
		    $data = array('errors' => validation_errors(), 'items' => $items, 'submit' => '0');
		    //echo validation_errors();
		    echo json_encode($data);
		} else {
				
			
		$DocID = $this->admin_model->get_document_entry($DocName) ? : $this->admin_model->insert_document($DocName);
			//echo $DocID;exit;
			for ($i=0; $i<$items; $i++) {
			//echo $this->input->post('entity'.$i); exit;
				$data = array(
				'DocID' => $DocID,
				'EntityTypeID' => $this->input->post('type'.$i),
				'EntityPosition' => $this->input->post('position'.$i),
				'Name' => ucwords(strtolower(str_replace("'","`",$this->input->post('entity'.$i)))),
				'UniqueInfo' => str_replace("'","`",$this->input->post('address'.$i)),
				'EffectiveDate' => str_replace("'","`",$this->input->post('startdate'.$i)) . ' : ' .  str_replace("'","`",$this->input->post('enddate'.$i)),
				'Verb' => $this->input->post('verb'.$i),				
				'UserID' => $this->session->userdata('user_id')
				);
				/*echo $data;
				echo 'tuko';//exit;*/
				if ($i==0){
					$data['Appointer'] = $Appointer;
					//var_dump($data);exit;
					$rootID = $this->admin_model->insert_entity_root($data);
					//return $rootID; //exit;
				} else {
					if ($i==1){
						$belongto = $this->input->post('belong');
						$rowID = $this->admin_model->insert_entity($data,$rootID);
						if ($belongto=="on") {$rootID = $rowID;}
					} else {
						$this->admin_model->insert_entity($data,$rootID);
					}
				}
			}
		    $data = array('items' => $items, 'submit' => '1', 'errors' => '');
		    //echo validation_errors();
		    echo json_encode($data);
		}
		
    }
    
    function entityEdit()  {
    
    //$this->output->enable_profiler(TRUE); 
    		$gazID=$this->input->post('gazID');
    		
    		$content = $this->admin_model->get_gazID($gazID);
		$list="";
		
    		if (is_array($content)){
    		$list="<form id='EntityUpdate' action='' method='post'><div class='spacer'><div class='select'>Type</div><div class='textfield'>Entity</div><div class='addrfield'>Position</div><div class='addrfield'>Unique Box <br/>'P.O. Box NNN'</div><div class='datefield'>Start:End Date</div><div class='select'>Verb</div></div>";
			for($i=0;$i< count($content);$i++)
			{
			$list .= '<div class="spacer"><select class="select" name="type'.$i.'"><option value="22"';
			
			if ($content[$i]['EntityTypeID']==22){ $list .= "selected";}
			
			$list .= '>Person</option><option value="21" ';
			if ($content[$i]['EntityTypeID']==21){ $list .= "selected";}
			
			$list .= '>Organization</option></select><input type="text" id="entity'.$i.'" name="entity'.$i.'" value="'.$content[$i]['Name'].'"  class="textfield" required /><input type="text" id="position'.$i.'" name="position'.$i.'" value="'.$content[$i]['EntityPosition'].'"  class="addrfield" /><input type="text" id="address'.$i.'" name="address'.$i.'" value="'.$content[$i]['UniqueInfo'].'"  class="addrfield" /><input type="text" id="startdate'.$i.'" name="startdate'.$i.'" value="'.$content[$i]['EffectiveDate'].'" class="datefield"/><select class="select" name="verb'.$i.'"><option selected value="' . $content[$i]['Verb'] . '">' . $content[$i]['Verb'] . '</option>'. $this->verb_words() .'</select><input type="hidden" value="'.$content[$i]['ID'].'" name="ID'.$i.'"/></div>'; 
			
			}		
		$list.='<input type="hidden" value="'.$gazID.'" name="gazID"/><input type="button" class="EntityUpdate" value="Submit" onclick="EntityUpdate()" /></form>';
		}
   		
   		$list= empty($list) ? "Sorry No Data" : $list;
   		echo $list;
    }
    
    function verb_words(){
	$verb = $this->admin_model->get_verbs();
	$v = '';
	//var_dump($verb);
	for ($j=0; $j < sizeof($verb); $j++) {
		$v .= "<option value=" . $verb[$j]['Verb'] . ">" . $verb[$j]['Verb'] ."</option>";
	}
	return $v;
    }
    
    function EntityUpdate() {
  //$this->output->enable_profiler(FALSE);  
    	$gazID=$this->input->post('gazID');
    	
    	$content = $this->admin_model->get_gazID($gazID);
	$list="";
    		if (is_array($content)){
    		$data=array();
	    		for($i=0;$i<count($content);$i++) {
			$data['ID'] = $this->input->post('ID'.$i);
			$data['EntityPosition'] = $this->input->post('position'.$i);
			$data['EntityTypeID'] = $this->input->post('type'.$i);
			$data['Name'] = trim(str_replace("'","`",$this->input->post('entity'.$i)));
			$data['UniqueInfo'] = trim(str_replace("'","`",$this->input->post('address'.$i)));
			$data['EffectiveDate'] = trim(str_replace("'","`",$this->input->post('startdate'.$i)));
			$data['Verb'] = $this->input->post('verb'.$i);
			
			$this->admin_model->update_entity($data);
			}
    	$content = $this->admin_model->get_gazID($gazID);
    		
    		$list="<form id='EntityUpdate' action='' method='post'><div class='spacer'><div class='select'>Type</div><div class='textfield'>Entity</div><div class='addrfield'>Unique Box <br/>'P.O. Box NNN'</div><div class='datefield'>Start:End Date</div><div class='select'>Verb</div></div>";
			
		for($i=0;$i< count($content);$i++) {
			$list .= '<div class="spacer"><select class="select" name="type'.$i.'"><option value="22"';
			
				if ($content[$i]['EntityTypeID']==22){ $list .= "selected";}
			
			$list .= '>Person</option><option value="21" ';
				if ($content[$i]['EntityTypeID']==21){ $list .= "selected";}
			
			$list .= '>Organization</option></select><input type="text" id="entity'.$i.'" name="entity'.$i.'" value="'.$content[$i]['Name'].'"  class="textfield" required /><input type="text" id="position'.$i.'" name="position'.$i.'" value="'.$content[$i]['EntityPosition'].'"  class="addrfield" /><input type="text" id="address'.$i.'" name="address'.$i.'" value="'.$content[$i]['UniqueInfo'].'"  class="addrfield" /><input type="text" id="startdate'.$i.'" name="startdate'.$i.'" value="'.$content[$i]['EffectiveDate'].'" class="datefield"/><select class="select" name="verb'.$i.'"><option selected value="' . $content[$i]['Verb'] . '">' . $content[$i]['Verb'] . '</option>'. $this->verb_words() .'</select><input type="hidden" value="'.$content[$i]['ID'].'" name="ID'.$i.'"/></div>'; 
			
			}
				
			$list.='<input type="hidden" value="'.$gazID.'" name="gazID"/><input type="button" class="EntityUpdate" value="Submit" onclick="EntityUpdate()"/></form>';
		}
   		
   		$list = empty($list) ? "Sorry No Data" : $list;
   		echo $list;
    
    }
    
    function EntityMergeSearch(){
   	$SearchTerm=$this->input->post('STerm');
    	
    	$content = $this->admin_model->search_entry($SearchTerm);
	$list="";
    		if (is_array($content)){
	    		
    			$list="<form id='EntityMerge' action='' method='post'><div class='spacer'><div style='width: 400px;'>Entity</div><div style='width: 200px;'>Unique Box <br/>'P.O. Box NNN'</div><div style='width: 200px;'>Start:End Date</div></div>";
			for($i=0;$i< count($content);$i++)
			{
			$list .= "<div class='spacer' style='background-color: #cccccc; border:#eee 1px solid;'><input style='width: 20px;' type='checkbox' name='Merge[]' value='".$content[$i]['ID']."'>";
			
			$list .= "<div style='width: 380px;'>" . $content[$i]['Name'] . "</div><div style='width: 200px;'>" . $content[$i]['UniqueInfo'] ."</div><div style='width: 200px;'>" .$content[$i]['EffectiveDate'] .'</div></div>'; 
			
			}		
			$list.='<input type="hidden" value="" name="EntityIDS"/><input type="button" class="EntityUpdate" value="Submit" onclick="EntityMerge()"/></form>';
		}
   		
   		$list= empty($list) ? "Sorry No Data" : $list;
   		echo $list;
    
    }
    
     function EntityMerger(){
   //  $this->output->enable_profiler(TRUE); 
   
   	$valz = $this->input->post('MergeEnt');
     
   	$MergeIds= explode(',',$valz);
   	//var_dump($MergeIds);
    	//$data=array();
    	//var $Ids;
    	$j=0;
    	for($i=0; $i<sizeof($MergeIds); $i++){
	    	if($i==0){
	    	  $RootID = $MergeIds[$i];
	    	} else {
	    				
    	     	  $this->admin_model->merge_entity($MergeIds[$i], $RootID);
    	     	 // $this->admin_model->reference_entity($MergeIds[$i], $RootID);
    	     	}
    	 ++$j;
    	}
    		
   		//$list= empty($list) ? "Sorry No Data" : $list;
   		//echo $j . " Merged";
    }
    
    
    function ListTable(){
     //$this->output->enable_profiler(TRUE); 
   	$meza = $this->admin_model->get_tables();
    	if (is_array($meza)){
    	$sys_tables = $this->admin_model->get_sys_tables();
    	
    	for($j=0;$j< count($sys_tables);$j++){ $systable[] = $sys_tables[$j]['TableName'];}
    	
    	
    	$meza = array_merge(array_diff($meza, $systable));
    	//var_dump($meza);
    		$list = "<option value='' selected>Select Table</option>";
		for($i=0;$i< count($meza);$i++){		
    	     	  $list .= "<option value='" . $meza[$i] ."'>" . $meza[$i] . "</option>";
    	     	}
    	}
    		
	$list = empty($list) ? "Sorry No Data" : $list;
	echo $list;
    }
    
    
    function ListField(){
     //$this->output->enable_profiler(TRUE); 
     	$stabs = $this->input->post('STab');
   	$list = "<form id='DatasetInsert' action='' method='post'>";
   	$list .="<div class='spacer'>Document Name <input type='text' value='' name='DocName'/> {2007_PublicAwardedTenders}</div>";
   	
   	$doctype = $this->admin_model->get_doctype();
   	//var_dump($doctype);
   	$list .= "<div class='spacer'>Document Type  <select name='DocumentType'";
   	for($j=0;$j< count($doctype);$j++){
		$list .= "<option value='". $doctype[$j]['ID']."'>". $doctype[$j]['DocTypeName'] ."</option>";
	}
   	$list .= "</select></div>";
   	$list .= "<div class='spacer'></div>";
   	$list .= "<div class='spacer'><div style='width: 300px;'>Select field to Extract Entity</div></div>";
   	$viwanja = $this->admin_model->get_fields($stabs);
    	foreach ($viwanja as $kiwanja) {
		if ($kiwanja->type == "text" || $kiwanja->type == "varchar") {
		   $iko = ($this->admin_model->field_iko($kiwanja->name.'_E_', $stabs)==1) ? "checked" : null;
			$list .= "<div class='spacer parent'><input style='width: 20px;' class='selectfield' type='checkbox' name='Extract[]' ".$iko." value='".$kiwanja->name."'>";
	   		$list .= $kiwanja->name ."  <div class='selectverb'></div></div>";
	   	}
	}	
	//  echo $kiwanja->type;
	//  echo $kiwanja->max_length;
	//  echo $kiwanja->primary_key;
	 $list .= '<div class="spacer"><input type="hidden" value="'. $stabs .'" name="tablename"/><input type="button" class="EntityExtract" value="Submit" onclick="EntityExtract()"/></div>';
	 $list .= '<div id="verbs" style="visibility:hidden;"><select name="Verb[]"><option value="" selected>No verb</option> '. $this->verb_words() .'</select></div>';
	 $list .= '</form>';
	
	$list = empty($list) ? "Sorry No Data" : $list;
	
	echo $list;
    }
    
    
    function EntityExtract(){
    $this->output->enable_profiler(TRUE); 
   
   	$table_name = $this->input->post('tablename');
   	$DocumentType = $this->input->post('DocumentType');
   	$Verb = $this->input->post('Verb');
   	$DocName = $this->input->post('DocName');
   	$viwanja = $this->input->post('Extract');
   	
   	$DocID = $this->admin_model->get_document_entry($DocName) ? : $this->admin_model->insert_document($DocName, $DocumentType);
	
	
	//var_dump($viwanja);
	//var_dump($Verb);

    	$list ="Records Submitted ";
    	$l=0;
    	for($i=0; $i<sizeof($viwanja); $i++){

		$this->admin_model->fieldcheck($viwanja[$i], $table_name);
    	     	$l .= $this->admin_model->extract_entity($viwanja[$i], $table_name, $DocID, $Verb[$i], $this->session->userdata('user_id'));
    	}
    		
	$list = empty($list) ? "Sorry No Records Submitted" : $list .$l ;
	echo $list;
    }
    
    

}
