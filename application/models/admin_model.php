<?php

class Admin_model extends CI_Model {
//update  `Entity` set EffectiveDate = replace(EffectiveDate, ',', '||')
    var $title   = '';
    var $content = '';
    var $date    = '';
    var $DocName    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_document_ref($DocName)
    {
		$this->db->select();
		$this->db->from('DocUploaded');    
		$this->db->where('title', trim($DocName));   
        	$query = $this->db->get();

	        return $query->result_array();
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



    function insert_document($DocName, $DocType=1)
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
	    	$data['EntityPosition'] = $data['EntityPosition']."||";
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
			$this->db->set('DocID', "CONCAT(DocID,'".$data['DocID']."',',')", FALSE);
	    		$this->db->set('Appointer', "CONCAT(Appointer,'".$data['Appointer']."','||')", FALSE);
	    		$this->db->set('EntityPosition',"CONCAT(EntityPosition,'".$data['EntityPosition']."','||')", FALSE);
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
		    	$this->db->set('EntityPosition',"CONCAT(EntityPosition,'".$data['EntityPosition']."','||')", FALSE);
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
	    		$data['EntityPosition'] = $data['EntityPosition']."||";
	    		$data['Verb'] = $data['Verb']."||";
	    		$data['DocTypeID'] = $data['DocTypeID'] . ",";
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
	    		$data['EntityPosition'] = $data['EntityPosition']."||";
	    		$data['DocTypeID'] = $data['DocTypeID'] . ",";
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
	    		$data['EntityPosition'] = $data['EntityPosition']."||";
	    		$data['Verb'] = $data['Verb']."||";
	    		$data['DocTypeID'] = $data['DocTypeID'] . ",";
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
		$this->db->where('Merged',0);
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

		$this->db->set('DocID', "CONCAT(DocID,'".$Entity->DocID."')", FALSE);
	    	$this->db->set('Appointer', "CONCAT(Appointer,',".$Entity->Appointer."')", FALSE);
	    	$this->db->set('EffectiveDate', "CONCAT(EffectiveDate,'".$Entity->EffectiveDate."')", FALSE);
	    	$this->db->set('EntityPosition', "CONCAT(EntityPosition,'".$Entity->EntityPosition."')", FALSE);
	    	$this->db->set('Verb', "CONCAT(Verb,'".$Entity->Verb."')", FALSE);
	    	$this->db->set('DocTypeID', "CONCAT(DocTypeID,'".$Entity->DocTypeID."')", FALSE);
	    	$this->db->set('EntityMap', "CONCAT(EntityMap,',".$Entity->EntityMap."')", FALSE);
	    		
		$this->db->where('ID', $ID);
	    	$this->db->update('Entity');
	    	
	    /*--------reference to new field id */
	    	
	    	$this->db->query("UPDATE Entity SET EntityMap = REPLACE(EntityMap, ',".$MID.",' , ',".$ID.",'), EntityMap = REPLACE(EntityMap, ',".$MID."||' , ',".$ID."||') ,EntityMap = REPLACE(EntityMap, '||".$MID."||' , '||".$ID."||'), EntityMap = REPLACE(EntityMap, '".$MID."||' , '".$ID."||'), EntityMap = REPLACE(EntityMap, '".$MID.",' , '".$ID.",')"); 
	    	$this->db->query("UPDATE Entity SET EntityMap = REPLACE(EntityMap, ',,' , ',')"); 
	      /*--------delete to old row id */
	    	
	    	$this->db->query("UPDATE Entity SET Merged = 1, MergedTo= $ID WHERE ID = $MID"); 
    }

	
   function reference_entity($MID,$ID){
		
		$this->db->select();
		$this->db->from('Entity');
		$this->db->where('ID ', $MID);
	        $EntityRow = $this->db->get();

		$Entity = $EntityRow->result_array();
		
		$docs = explode(',', $Entity[0]['DocID']);
		
		for($i=0;$i<count($docs); $i++){
		  if ($docs[$i] != ""){
	      		$this->db->select();
			$this->db->from('DocUploaded');
			$this->db->where('ID ', $docs[$i]);
			$DocRow = $this->db->get();
			$Doc = $DocRow->result_array();
			//var_dump($Doc);
			$dtable = $Doc[0]['data_table'];
			
			if ($dtable != ""){
			  $viwanja = $this->db->field_data($dtable);
			 // var_dump($viwanja);
			  foreach ($viwanja as $kiwanja) {
			    $fld = $kiwanja->name.'_E_';
			    if($this->db->field_exists($fld, $dtable)){
			   //  $fieldname = $flds[$j].'_E_';
			     $this->db->query("UPDATE $dtable SET $fld = $ID WHERE $fld = $MID");	
			    }

			  }
			}
		  }
	      	}
    }
    
   function get_verbs()
    {
		        	
		$this->db->select();
		$this->db->from('Verbs');
		$this->db->where('Viewed', 1);
	        $query = $this->db->get();
	        return $query->result_array();
	      
    }
    
     function get_sys_tables()
    {
		        	
		$this->db->select();
		$this->db->from('SysTables');
		$this->db->where('Viewed', '1');
	        $query = $this->db->get();
	        return $query->result_array();
	
    }
    
    function get_tables()
    {
		return  $this->db->list_tables();
	      
    }
    
    function field_iko($fild, $tab) 
    {
    		return $this->db->field_exists($fild, $tab);
    		 
    }
    
    function get_fields($tab)
    {
		return  $this->db->field_data($tab);
	      
    }
    

    function get_doctype()
    {        	
		$this->db->select('ID,DocTypeName');
		$this->db->from('DocumentType');
		$this->db->where('Viewed', '1');
	        $query = $this->db->get();
	        return $query->result_array();
    }
     
    function fieldcheck($fil,$tab)
    {
	if(!$this->db->field_exists($fil.'_E_',$tab)){
		$fieldname = $fil.'_E_';
		$this->db->query("ALTER TABLE $tab  ADD COLUMN $fieldname INT NOT NULL DEFAULT 0");	
	}
	      
    }
    
    function create_table($tbl, $flds)
    {
    	return $this->db->query("CREATE TABLE $tbl ($flds)");    
    }
    
    function alter_table($fild,$tbl)
    {
	if(!$this->db->field_exists($fild,$tbl)){
		$this->db->query("ALTER TABLE $tbl  ADD COLUMN $fild  VARCHAR(250)");	
	}
	      
    }
    
    function populate_table($query)
    {

	return $this->db->query($query);
    }
 
     function dataset_edit($tbl, $rep)
    {        	
		$this->db->where('data_table', $tbl);
	        $this->db->set('representation', $rep, FALSE);
	    	$this->db->update('DocUploaded');

    }
    

    function extract_entity($fild,$tab,$docid, $verb, $UID, $DocTypeID)
    {
    
    	$fieldname = $fild.'_E_';
	$this->db->select($fild);
	$this->db->distinct();
	$this->db->from($tab); 
	$this->db->where($fieldname,'0');
	$query = $this->db->get();
	$k=0;
	if ($query->num_rows() > 0)
	{
	
	$entity=$query->result_array();
	    for($i=0;$i<$query->num_rows(); $i++)
	      {
	      
	     // echo($entity[2][$fild]); exit;
		$data['DocID'] = $docid . ",";
		$data['Name'] = $entity[$i][$fild];
	    	$data['Verb'] = $verb ."||";
		$data['EntityTypeID'] = 21;
		$data['UserID'] = $UID;
		$data['DocTypeID'] = $DocTypeID .',';
		
	    	$this->db->insert('Entity',$data);
	    	$rowID = $this->db->insert_id();

	    	$dta = array($fieldname => $rowID);
	    //	$this->db->set($fieldname, 11);
	    	$this->db->where($fild, $entity[$i][$fild]);
	    	$this->db->update($tab, $dta);
	      $k++;
	      }
	}

	return $k;
	      
    }
    
}
