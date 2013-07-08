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
		$this->db->where('title', $DocName);   
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
    		'title' => $DocName,
    		'doc_id' => $DocName
    	);
        $this->db->insert('DocUploaded', $data);
        return $this->db->insert_id();
    }
    
    function update_document($data)
    {
	$this->db->where('DocID', $data['DocID']);        
        $this->db->update('DocUploaded', $data);
    }
   
    function insert_entity_root($data,$DocID)
    {

	$this->db->select('ID');
	$this->db->from('Entity');
    	$this->db->where('Name', $data['Name']);
    	$this->db->where('UniqueInfo', $data['UniqueInfo']);
   	$Entity = $this->db->get();
 
    	if ($Entity->num_rows() > 0){

    	 	$row = $Entity->row();
    	 	$this->db->where('ID', $row->ID);
    		$this->db->set('DocID', 'CONCAT(DocID,"||",'. $DocID .')', FALSE);
    		$this->db->set('EntityMap', 'CONCAT(EntityMap,"||",'. $row->ID .')', FALSE);
    		$this->db->update('Entity');
    		return  $row->ID;
    		
    	 } else {
    	 	//$data = array_push("DocID" , "CONCAT(DocID,'||',". $DocID .")");
	    	$this->db->set('DocID', "CONCAT(DocID,'||','".$DocID."')", FALSE);
    		$this->db->insert('Entity', $data);
    		$rowID = $this->db->insert_id();
    		
    		return $rowID;
    	} 	    	
    }
    
     function insert_entity($data,$DocID,$rootID)
    {
    	//Benjamin,22
	$this->db->select('ID');
	$this->db->from('Entity');
    	$this->db->where('Name', $data['Name']);
    	$this->db->where('UniqueInfo', $data['UniqueInfo']);
   	$Entity = $this->db->get();
 
    	if ($Entity->num_rows() > 0){
    	 $row = $Entity->row();
    	 	$this->db->where('ID', $row->ID);
    		$this->db->set('DocID', 'CONCAT(DocID,"||",'. $DocID .')', FALSE);
    		$this->db->set('EntityMap', 'CONCAT(EntityMap,"||",'. $rootID.')', FALSE);

    		$this->db->update('Entity');
    		$rowID = $row->ID;
    		
    		$this->db->where('ID', $rootID);
    		$this->db->set('EntityMap', 'CONCAT(EntityMap,"||",'. $rowID .')', FALSE);
    		$this->db->update('Entity');
    		
    	 } else {
	    	$this->db->set('DocID', "CONCAT(DocID,'||','".$DocID."')", FALSE);
	    	$this->db->set('EntityMap', 'CONCAT(EntityMap,"||",'. $rootID.')', FALSE);
    		$this->db->insert('Entity',$data);
    		$rowID = $this->db->insert_id();
    		
    		$this->db->where('ID', $rootID);
    		$this->db->set('EntityMap', 'CONCAT(EntityMap,"||",'. $rowID .')', FALSE);
    		$this->db->update('Entity');
    	}
    		
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
    
    
    function get_entry2($tag,$docid)
    {
		$this->db->select();
		$this->db->from($tag);
		$this->db->where('DocID',$docid);  
		$this->db->limit(6);     
        $query = $this->db->get();
        return $query->result_array();
    }

}
