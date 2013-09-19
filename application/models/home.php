<?php

class Home extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_number_entity_group($var)
    {
    	
		$this->db->select();
		$this->db->from('Entity');
		$this->db->where('EntityTypeID', $var);
	       // $query = $this->db->get();
	        return $this->db->count_all_results();
	      //} else {return '';}
    }
    
    function get_dataset_count()
    {
    $ar=array();
    	$this->db->select();
	$this->db->from('DocumentType');
	$this->db->where('Viewed', '1');
	$query = $this->db->get();
    	$cats = $query->result_array();
    	//var_dump($cats);
	    for($f=0; $f<count($cats); $f++) {
	    
	    	$this->db->select();
		$this->db->from('Entity');
		$this->db->like('DocTypeID', $cats[$f]['ID'].',');
		$catCount =  $this->db->count_all_results();
		
		$ar[] = array('DocType'=>$cats[$f]['DocTypeName'], 'CatTot' => $catCount, 'DocTypeID' => $cats[$f]['ID']);
	    	
    	    }
    	return $ar;
    }
    
    
    function get_lastest_entry()
    {
		$this->db->select();
		$this->db->from('Entity');  
		$this->db->order_by('ID','desc'); 
		$this->db->limit(10); 
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_last_ten_entries($Tag,$Var)
    {
		$this->db->select();
		$this->db->from('DocUploaded');  
		$this->db->order_by('date_added','desc');  
		$this->db->limit('DocUploaded');     
        $query = $this->db->get(10,0);
        return $query->result_array();
    }

    function insert_document($data)
    {
        $this->db->insert('DocUploaded', $data);
        return $this->db->insert_id();
    }
    
    function update_document($data)
    {
	  $this->db->where('DocID', $data['DocID']);        
        $this->db->update('DocUploaded', $data);
    }
   
    function insert_entity($tag, $data,$docid)
    {
    	

    	$this->db->where($tag, $data);
    	$this->db->set('DocID', 'CONCAT(DocID,",",'.$docid.')', FALSE);
    	$this->db->update($tag);
    	if ($this->db->affected_rows()==0){
    	 $entity_data = array($tag => $data, 'DocID' => ','.$docid);
    	 $this->db->insert($tag, $entity_data);	
    	}
    	

    	//$entity_data = array($tag => $data, 'DocID' => $docid);
      //  $this->db->insert($tag, $entity_data);
       // return $this->db->insert_id();
    }

    function get_entries($field,$var)
    {
    	is_array($var) ? $this->db->where_in($field,$var) : $this->db->where($field,$var); 
		$this->db->select();
		$this->db->from('Entity');
		//$this->db->limit(10);   
		//if($this->db->count_all_results()>0){  
	        $query = $this->db->get();
	        return $query->result_array();
	      //} else {return '';}
    }
    
     function get_mapped_entries($var)
    	{
    	is_array($var) ? $this->db->where_in('Entity.ID',$var) : $this->db->where('Entity.ID',$var); 
		$this->db->select('EntityType.EntityTypeID, EntityType.EntityType');
		$this->db->distinct();
		$this->db->from('Entity');
		$this->db->join('EntityType','Entity.EntityTypeID = EntityType.EntityTypeID');
	        $query = $this->db->get();
	        return $query->result_array();

    }
    
    function get_node($nodeid)
    {
    	//is_array($nodeid) ? $this->db->where_in('ID',$nodeid) : $this->db->where('ID',$nodeid); 
		$this->db->select();
		$this->db->from('Entity');
		$this->db->like('EntityMap', $nodeid .'|', 'after');
		$this->db->or_like('EntityMap ',  $nodeid .',' , 'after');
		$this->db->or_like('EntityMap ', ','. $nodeid .',' , 'match');
		$this->db->or_like('EntityMap ', '|'. $nodeid .',' , 'match');
		$this->db->or_like('EntityMap ', '|'. $nodeid .'|' , 'match');
		$this->db->or_like('EntityMap ', ','. $nodeid .'|' , 'match');
		$this->db->or_like('EntityMap ', '|'. $nodeid  , 'before');
		//if($this->db->count_all_results()>0){  
	        $query = $this->db->get();
	        return $query->result_array();
	      //} else {return '';}
	      
	   //   "SELECT `ID`,EntityMap, Verb FROM `Entity` where `EntityMap`  like '2717,%' or `EntityMap`  like '%,2717,%' or `EntityMap`  like ',2717|%' or `EntityMap`  like '%|2717|%' or `EntityMap`  like  '%|2717' or `EntityMap`  like '2717|%'"
    }

    function get_entry_cont($tag,$entityname,$page_num=1, $results_per_page=15)
    {
    	if ($page_num < 1)
        {
            $page_num = 1;
        }
		$this->db->select();
		$this->db->from('Entity');
		$this->db->where('Merged',0);
		$this->db->order_by('Name'); 
		$this->db->like($tag, $entityname);  
		$this->db->limit($results_per_page, ($page_num - 1) * $results_per_page);     
        	$query = $this->db->get();
        return $query->result_array();
    }
    
    function get_entry_count($tag,$entityname){
    		$this->db->select();
		$this->db->from('Entity');
		$this->db->like($tag,$entityname); 
		$query = $this->db->get();
     		return $query->num_rows();
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
    
    function get_doc($docid)
    {
    
    	//is_array($var) ? $this->db->where_in($field,$var) : $this->db->where($field,$var); 
		$this->db->select();
		$this->db->from('DocUploaded');
		$this->db->where('ID', $docid);
		//if($this->db->count_all_results()>0){  
	        $query = $this->db->get();
	        return $query->result_array();
	      //} else {return '';}
    }
    
    function get_dataset($tbl,$q,$id)
    {
    $ar=array();
    $ra=array();
    $flds = $this->db->field_data($tbl);
	    foreach($flds as $f ) {
	    	if (substr($f->name,-3,3)=='_E_') {
	   	 $Entity_id[]= $f->name;
	  	} else {
	  	 $Entity_field[]= $f->name;
	  	}
    	    }
    	$qu = ($q=='*') ? $Entity_field : $q;
    
		$this->db->select($qu);
		$this->db->from($tbl);
			foreach($Entity_id as $r){		
			$this->db->or_where($r,$id); 
			}     
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_dataset_map($tbl, $id)
    {
    $Entity_id=array();
    $Entity_name=array();
    $flds = $this->db->field_data($tbl);
	    foreach($flds as $f ) {
	    	if (substr($f->name,-3,3)=='_E_') {
	   	 $Entity_name[]= $f->name;
	  	}
    	    }
	$this->db->select($Entity_name);
	$this->db->from($tbl);
		foreach($Entity_name as $r){		
		$this->db->or_where($r, $id); 
		}     
        $query = $this->db->get();
        return $query->result_array();
    }

}
