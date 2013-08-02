<?php

class Admin_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $DocName    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_document_entry($DocName)
    {
		$this->db->select('ID');
		$this->db->from('DocUploaded');    
		$this->db->where('title', trim($DocName));   
        	$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
		    $row = $query->row(); 
		    return $row->ID;
		}

		return null;
    }


    function insert_document($DocName)
    {
    
    	$data = array (
    		'title' => trim($DocName),
    		'doc_id' => date("Ymd") .'-'.$DocName
    	);
        $this->db->insert('DocUploaded', $data);
        return $this->db->insert_id();
    }
    
    function update_document($data)
    {
	$this->db->where('DocID', $data['DocID']);        
        $this->db->update('DocUploaded', $data);
    }
   
    function insert_entity_root($data)
    {
	if ($data['UniqueInfo']=="") {
		$data['DocID'] = $data['DocID'] . ",";
	    	$data['Appointer'] = $data['Appointer']."||";
	    	$data['EffectiveDate'] = $data['EffectiveDate']."||";
	    	$data['Verb'] = $data['Verb']."||";
	    	//$data['EntityMap'] = ",";
	    			    	
    		$this->db->insert('Entity', $data);
    		$rowID = $this->db->insert_id();

    		return $rowID;
    	}
	else {
		$this->db->select('ID');
		$this->db->from('Entity');
	    	$this->db->where('Name', $data['Name']);
	    	$this->db->where('UniqueInfo', $data['UniqueInfo']);
	   	$Entity = $this->db->get();
	 	
	    	if ($Entity->num_rows() > 0){

	    	 	$row = $Entity->row();
	    	 	$this->db->where('ID', $row->ID);
			$this->db->set('DocID', 'CONCAT(DocID,"'.$data['DocID'].'",",")', FALSE);
	    		$this->db->set('Appointer', "CONCAT(Appointer,'".$data['Appointer']."','||')", FALSE);
	    		$this->db->set('EffectiveDate', "CONCAT(EffectiveDate,'".$data['EffectiveDate']."','||')", FALSE);
	    		$this->db->set('Verb', "CONCAT(Verb,'".$data['Verb']."','||')", FALSE);
	    		$this->db->set('EntityMap', "CONCAT(EntityMap,',')", FALSE);
	    		$this->db->update('Entity');
	    		return  $row->ID;
	    		
	    	 } else {

			$data['DocID'] = $data['DocID'] . ",";
		    	$data['Appointer'] = $data['Appointer']."||";
		    	$data['EffectiveDate'] = $data['EffectiveDate']."||";
		    	$data['Verb'] = $data['Verb']."||";
		    	//$data['EntityMap'] = ",";
	    		$this->db->insert('Entity', $data);
	    		$rowID = $this->db->insert_id();
	    		
	    		return $rowID;
	   	} 	
	} 	    	
    }
    
   function insert_entity($data,$rootID)
    {
    	//Benjamin,22
    	
    	$this->db->select();
	$this->db->from('Entity');
    	$this->db->where('ID', $rootID);
   	$EntityRoot = $this->db->get();

    	$EntityRow = $EntityRoot->row();
   	$ItemArray = explode(',',$EntityRow->DocID);
	$key = array_search($data['DocID'], $ItemArray);

	$EntityMapArray = explode(',',$EntityRow->EntityMap);
    	
    	if ($data['UniqueInfo']=="") {
	
			$data['DocID'] = $data['DocID'] . ",";
	    		$data['EffectiveDate'] = $data['EffectiveDate']."||";
	    		$data['Verb'] = $data['Verb']."||";
		    	$data['EntityMap'] =  $rootID.",";
	    		$this->db->insert('Entity',$data);
	    		$rowID = $this->db->insert_id();
	    		
	    		$EntityMapArray[$key] = $EntityMapArray[$key] . $rowID .'||';
	    			    		
	    		$this->db->where('ID', $rootID);
	    		$this->db->set('EntityMap', implode(',',$EntityMapArray));
	    		$this->db->update('Entity');
	    		
	    		return $rowID;
    	} else {
	
		
		$this->db->select('ID');
		$this->db->from('Entity');
	    	$this->db->where('Name', $data['Name']);
	    	$this->db->where('UniqueInfo', $data['UniqueInfo']);
	   	$Entity = $this->db->get();
	 
	    	if ($Entity->num_rows() > 0){
	    	
	    	 	$row = $Entity->row();
	    	 	$data['DocID'] = $data['DocID'] . ",";
	    		$data['EffectiveDate'] = $data['EffectiveDate']."||";
	    		$data['Verb'] = $data['Verb']."||";
		    	$data['EntityMap'] =  $rootID.",";
		    	
		    	$this->db->where('ID', $row->ID);
	    		$this->db->update('Entity',$data);
	    		$rowID = $row->ID;
	    		
	    		$EntityMapArray[$key] = $EntityMapArray[$key] . $rowID .'||';
	    		
	    		$this->db->where('ID', $rootID);
	    		$this->db->set('EntityMap', implode(',',$EntityMapArray));
	    		$this->db->update('Entity');
	    		
	    		return $rowID;
	    		
	    	 } else {
			$data['DocID'] = $data['DocID'] . ",";
	    		$data['EffectiveDate'] = $data['EffectiveDate']."||";
	    		$data['Verb'] = $data['Verb']."||";
		    	$data['EntityMap'] =  $rootID.",";
	    		$this->db->insert('Entity',$data);
	    		$rowID = $this->db->insert_id();
	    		
	    		$EntityMapArray[$key] = $EntityMapArray[$key] . $rowID .'||';
	    		
	    		$this->db->where('ID', $rootID);
	    		$this->db->set('EntityMap', implode(',',$EntityMapArray));
	    		$this->db->update('Entity');
	    		
	    		return $rowID;
	    	}
    	}	
    }
    
    
    function get_gazID($gazID)
    {
		$this->db->select();
		$this->db->from('DocUploaded');    
		$this->db->where('title', trim($gazID));   
        	$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
		    	$row = $query->row();
		    	$this->db->select();
			$this->db->from('Entity');    
			$this->db->like('DocID ' ,  ','. $row->ID .',');
			$this->db->or_like('DocID ' ,  $row->ID.',' , 'after');
			$this->db->order_by("ID", "desc"); 
			$query1 = $this->db->get();
			
		       return $query1->result_array();
		}

		return null;
    }

    
    function get_entity($ID)
    {
		        	
		$this->db->select();
		$this->db->from('Entity');
		$this->db->where('ID ', $ID);
	        $query = $this->db->get();
	        return $query->result_array();
	      
    }
    
    
    function update_entity($data)
    {
	$this->db->where('ID', $data['ID']);        
        $this->db->update('Entity', $data);
    }
    
    
    function get_entries($tag,$var)
    {
		$this->db->select();
		$this->db->from($tag);
		$this->db->like($tag,$var);  
		$this->db->limit(6);   
		//if($this->db->count_all_results()>0){  
	        $query = $this->db->get();
	        return $query->result_array();
	      //} else {return '';}
    }
    
    
    function search_entry($STerm)
    {
		$this->db->select();
		$this->db->from('Entity');
		$this->db->like('Name', $STerm);  
		$this->db->limit(15);
		$this->db->order_by("UniqueInfo", "desc");
        	$query = $this->db->get();
        	return $query->result_array();
    }
    
    function merge_entity($MID,$ID){
		
		$this->db->select();
		$this->db->from('Entity');
		$this->db->where('ID ', $MID);
	        $EntityRow = $this->db->get();

		$Entity = $EntityRow->row();

		$this->db->set('DocID', "CONCAT(DocID,'".$Entity->DocID.",')", FALSE);
	    	$this->db->set('Appointer', "CONCAT(Appointer,',".$Entity->Appointer."')", FALSE);
	    	$this->db->set('EffectiveDate', "CONCAT(EffectiveDate,',".$Entity->EffectiveDate."')", FALSE);
	    	$this->db->set('Verb', "CONCAT(Verb,',".$Entity->Verb."')", FALSE);
	    	$this->db->set('EntityMap', "CONCAT(EntityMap,',".$Entity->EntityMap."')", FALSE);
	    		
		$this->db->where('ID', $ID);
	    	$this->db->update('Entity');
	    	
	    /*--------reference to new field id */
	    	
	    	$this->db->query("UPDATE Entity SET EntityMap = REPLACE(EntityMap, ',".$MID.",' , ',".$ID.",'), EntityMap = REPLACE(EntityMap, ',".$MID."||' , ',".$ID."||') ,EntityMap = REPLACE(EntityMap, '||".$MID."||' , '||".$ID."||'), EntityMap = REPLACE(EntityMap, '".$MID."||' , '".$ID."||'), EntityMap = REPLACE(EntityMap, '".$MID.",' , '".$ID.",')"); 
	    	$this->db->query("UPDATE Entity SET EntityMap = REPLACE(EntityMap, ',,' , ',')"); 
	      /*--------delete to old row id */
	    	
	    	$this->db->query("DELETE FROM Entity WHERE ID = $MID"); 
    }

   function get_verbs()
    {
		        	
		$this->db->select();
		$this->db->from('Verbs');
		$this->db->where('Viewed', 1);
	        $query = $this->db->get();
	        return $query->result_array();
	      
    }
}
