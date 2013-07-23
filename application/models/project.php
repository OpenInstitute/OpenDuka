<?php

class Project extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_documents($num=20,$start=0)
    {
		$this->db->select();
		$this->db->from('DocUploaded');  
		$this->db->order_by('doc_id','desc');  
		$this->db->limit($num, $start);
		$query = $this->db->get();
        
        return $query->result_array();
    }
    
    function get_document_entry($id)
    {
		$this->db->select();
		$this->db->from('DocUploaded');    
		$this->db->where('ID', $id);   
        	$query = $this->db->get();
        return $query->row_array();
    }
    
    function get_doc_count(){
    		$this->db->select('doc_id');
		$this->db->from('DocUploaded');
		$query = $this->db->get();
     
     return $query->num_rows();
   }
    
    function checkDoc($val){
	$this->db->where('doc_id',$val);    
      return $this->db->count_all_results('DocUploaded');
    }
    
    function insert_document($data)
    {
        $this->db->insert('DocUploaded', $data);
        return $this->db->insert_id();
    }
    
    function update_document($data)
    {
	  $this->db->where('ID', $data['ID']);        
        $this->db->update('DocUploaded', $data);
    }
   
    function insert_entity($tag, $data,$docid)
    {
    	//Person,Benjamin,12

    	$this->db->where($tag, $data);
    	$this->db->set('DocID', 'CONCAT(DocID,",",'.$docid.')', FALSE);
    	$this->db->update($tag);

    	if ($this->db->affected_rows()==0){
	    	 $entity_data = array($tag => $data, 'DocID' => ','.$docid);
	    	 $this->db->insert($tag, $entity_data);
    	$EntityID =  $this->db->insert_id();
    	} else {
	    	$this->db->select();
		$this->db->from($tag);
	    	$this->db->where($tag, $data);
	    	$this->db->get();
    	$EntityID =  $this->db->row()->$tag.'ID';
    	}
    	
	$entity_data = array('EntityType' => $tag, 'EntityID' => $EntityID, 'DocID' => $docid);
	 $this->db->insert('SubTexts', $entity_data);
    	//$entity_data = array($tag => $data, 'DocID' => $docid);
      //  $this->db->insert($tag, $entity_data);
       // return $this->db->insert_id();
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