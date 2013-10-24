<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homes extends CI_Controller {

    
       
       function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model('home');

	}
	
	function index($start=0)
	{
		$data_head = array('page_title' => 'Open Duka');
		$docs=array();
		$organisations = $this->home->get_number_entity_group('21');
		$persons = $this->home->get_number_entity_group(22);
		$docTypes = $this->home->get_dataset_count();
		
		//echo serialize($docs); exit;
		
		$latestlist = $this->home->get_lastest_entry();
		$list="";
		if (is_array($latestlist)){
			for($i=0;$i< count($latestlist);$i++)
			{
				$list .= "<li><a href=" .site_url('/homes/tree/'.$latestlist[$i]['ID']). ">". $latestlist[$i]['Name'] . "</a></li>"; 
			}		
		}

		for($i=0;$i< count($docTypes);$i++)
		{
		 $docs= array_merge(array($docTypes[$i]['DocType'] =>  $docTypes[$i]['CatTot'], $docTypes[$i]['DocType'].'ID' =>  $docTypes[$i]['DocTypeID'] ), $docs);
		}
		$docs = array_merge(array('organisations' => $organisations, 'persons' => $persons,'latest_list' => $list,'error' => ''), $docs);
//var_dump($docs); exit;
		$this->load->view('header',$data_head);
		$this->load->view('home', $docs);
		$this->load->view('footer');
	}
	
	function entityTypelist($ent="",$page_num=1)
	{
	//echo $ent;
	//$this->output->enable_profiler(TRUE);
		$data_head = array('page_title' => 'Search results');
<<<<<<< HEAD
		$Type = isset($_GET['TypeID']) ? $_GET['TypeID'] : $ent ;
		//$Type_ = str_replace('D','',$Type);	
		//echo $context;exit;
		$results_per_page=25;
		$content = $this->home->get_entry_cont3('EntityTypeID',$Type,$page_num, $results_per_page);
		
=======
		$Type = isset($_GET['TypeID']) ? $_GET['TypeID'] : $ent ;		
		//echo $context;exit;
		$results_per_page=15;
		$content = $this->home->get_entry_cont('EntityTypeID',$Type,$page_num, $results_per_page);
		
		$this->load->library('pagination');
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = base_url() . index_page().'/homes/entityTypelist/'.$Type ;
		$config['total_rows'] = $this->home->get_entry_count('EntityTypeID',$Type);
		$config['per_page'] = $results_per_page; 
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		/*
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		*/
		$config['next_link'] = '';
		//$config['next_tag_open'] = '<li>';
		//$config['next_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li><a href="1">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['num_links'] = 10;
       		$config['uri_segment'] = 3;
		$this->pagination->initialize($config); 
		$pages = $this->pagination->create_links();

>>>>>>> 4d4edbc405106159b2b0dd28217a570536676f76
	//	var_dump($content[0]);
		$list = '';
		if (is_array($content)){
			for($i=0;$i< count($content);$i++)
			{
<<<<<<< HEAD
				$list .= "<div class='post'><a href=" .site_url('/homes/tree/'.$content[$i]['ID']). ">". $content[$i]['Name'] . "</a></div>"; 
			}		
		}
		$this->load->view('header',$data_head);
		$this->load->view('home', array('entities' => '','list' =>$list,'term'=>$Type,'error' => 'List of names found','func' => 'entityTypelist'));
=======
				$list .= "<li><a href=" .site_url('/homes/tree/'.$content[$i]['ID']). ">". $content[$i]['Name'] . "</a></li>"; 
			}		
		}
		$this->load->view('header',$data_head);
		$this->load->view('home', array('entities' => '','list' =>$list,'pages'=>$pages,'error' => 'List of names found'));
>>>>>>> 4d4edbc405106159b2b0dd28217a570536676f76
		$this->load->view('footer');
	}
	
	function entityDoclist($ent="",$page_num=1)
	{
	//echo $ent;
	//$this->output->enable_profiler(TRUE);
		$data_head = array('page_title' => 'Search results');
<<<<<<< HEAD
		$DocType = isset($_GET['docID']) ? $_GET['docID'] : $ent ;
		//echo $DocType;
		//$DocType_ = str_replace('D','',$DocType);		
		//echo $context;exit;
		$results_per_page=25;
		$content = $this->home->get_entry_cont2('DocTypeID',$DocType,$page_num, $results_per_page);
	
=======
		$DocType = isset($_GET['docID']) ? $_GET['docID'] : $ent ;		
		//echo $context;exit;
		$results_per_page=15;
		$content = $this->home->get_entry_cont('DocTypeID',$DocType,$page_num, $results_per_page);
		
		$this->load->library('pagination');
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = base_url() . index_page().'/homes/entityDoclist/'.$DocType ;
		$config['total_rows'] = $this->home->get_entry_count('DocTypeID',$DocType);
		$config['per_page'] = $results_per_page; 
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		/*
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		*/
		$config['next_link'] = '';
		//$config['next_tag_open'] = '<li>';
		//$config['next_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li><a href="1">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['num_links'] = 10;
       		$config['uri_segment'] = 3;
		$this->pagination->initialize($config); 
		$pages = $this->pagination->create_links();

>>>>>>> 4d4edbc405106159b2b0dd28217a570536676f76
	//	var_dump($content[0]);
		$list = '';
		if (is_array($content)){
			for($i=0;$i< count($content);$i++)
			{
<<<<<<< HEAD
				$list .= "<div class='post'><a href=" .site_url('/homes/tree/'.$content[$i]['ID']). ">". $content[$i]['Name'] . "</a></div>"; 
			}		
		}
		$this->load->view('header',$data_head);
		$this->load->view('home', array('entities' => '','list' =>$list,'term'=>$DocType,'error' => 'List of names found','func' => 'entityDoclist'));
=======
				$list .= "<li><a href=" .site_url('/homes/tree/'.$content[$i]['ID']). ">". $content[$i]['Name'] . "</a></li>"; 
			}		
		}
		$this->load->view('header',$data_head);
		$this->load->view('home', array('entities' => '','list' =>$list,'pages'=>$pages,'error' => 'List of names found'));
>>>>>>> 4d4edbc405106159b2b0dd28217a570536676f76
		$this->load->view('footer');
	}
	
	function entitylist($ent="",$page_num=1)
	{
	//echo $ent;
<<<<<<< HEAD
	//$this->output->enable_profiler(TRUE);
		$data_head = array('page_title' => 'Search results');
		$EntityName = isset($_POST['search_name']) ? $_POST['search_name'] : $ent ;		
	//	$EntityName = str_replace(' ','',$EntityName);
	//	echo $page_num;
		$results_per_page=25;
=======
	$this->output->enable_profiler(TRUE);
		$data_head = array('page_title' => 'Search results');
		$EntityName = isset($_POST['search_name']) ? $_POST['search_name'] : $ent ;		
		$EntityName = str_replace(' ','',$EntityName);
		echo $page_num;
		$results_per_page=20;
>>>>>>> 4d4edbc405106159b2b0dd28217a570536676f76
		$content = $this->home->get_entry_cont('Name',$EntityName,$page_num, $results_per_page);
	/*	
		$this->load->library('pagination');
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = base_url() . index_page().'/homes/entitylist/'.$EntityName ;
		$config['total_rows'] = $this->home->get_entry_count('Name',$EntityName);
		$config['per_page'] = $results_per_page; 
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		/*
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['next_link'] = '';
		//$config['next_tag_open'] = '<li>';
		//$config['next_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li><a href="1">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['num_links'] = 10;
       		$config['uri_segment'] = 3;
		$this->pagination->initialize($config); 
		$pages = $this->pagination->create_links();
*/
	//	var_dump($content[0]);
		$list = '';
		if (is_array($content)){
			for($i=0;$i< count($content);$i++)
			{
			  $list .= "<div class='post'><a href=" .site_url('/homes/tree/'.$content[$i]['ID']). ">". $content[$i]['Name'] . "</a></div>"; 
			}		
		}
		$this->load->view('header',$data_head);
<<<<<<< HEAD
		$this->load->view('home', array('entities' => '','list' =>$list,'term' => $EntityName, 'error' => 'List of names found','func' => 'entitylist'));
=======
		$this->load->view('home', array('entities' => '','list' =>$list,'term' => $EntityName, 'error' => 'List of names found'));
>>>>>>> 4d4edbc405106159b2b0dd28217a570536676f76
		$this->load->view('footer');
	}
	
	function clean_array($arr){
	//var_dump($arr);
	$new_arr = array();
		if(is_array($arr)){
			$arr = array_unique($arr);
			$arr = array_filter($arr);
			
			 foreach ($arr as $val){
			 	$new_arr[] = $val;
			 }	
		}
		return $new_arr;
	}
	

	function tree($v0) {
		//$this->output->enable_profiler(TRUE);  
		
		$noMerge = $this->home->get_entries('ID',$v0);
		$v0 = ($noMerge[0]['Merged']==1)? $noMerge[0]['MergedTo'] : $v0;
		$weed = array();
		$fruit = array();
		$node_arr = "";
		$alpha = 1;
		$nodes = "{";
		$edges = "{";
		
		
		$dta = $this->home->get_entries('ID',$v0);
		$docs = explode(',', $dta[0]['DocID']);
		//var_dump($docs); exit;
		
		foreach($docs as $d){
			$doc = $this->home->get_doc($d);
			
			foreach($doc as $row){
			$dt=$row['data_table'];
			$q=$row['representation'];
			
			  $tree_data = ($dt == "") ? $this->tree_init($v0,$weed) : $this->dataset_extract($dt,$v0);
			
			}
			//var_dump($tree_data);
		}
		
		//exit;
		
		//var_dump($tree_data); exit;
		$nodetitle = $tree_data['nodeTitle'];
		$node_arr = $tree_data['nodes'];
		$edges .= $tree_data['edges'];
		
		$cid[22]= array('col'=>'#00CCCC', 'shape'=>'dot', 'img'=>'people.png','selectedimg'=>'people-dark.png');
		$cid[21]= array('col'=>'#00a650', 'shape'=>'rectangle', 'img'=> 'organisations.png', 'selectedimg'=> 'organisations-dark.png');
		$node_arr= $this->clean_array(explode(',',$node_arr)); 
//var_dump($node_arr);
		for($k=0; $k<count($node_arr); $k++){
			$nDetail = explode('|',$node_arr[$k]);
		//	var_dump($nDetail);
			$id = $nDetail[0];
			$dataset = $nDetail[1];
			//echo $dataset;
			$n = $this->home->get_entries('ID',$id);
			//$nID[$id] = $id;
			$nd = explode('||',$n[0]['EffectiveDate']);
			//var_dump($nd);
			if ( !isset($nDate[$id]) ) {
			  $nDate[$id] = array();
			}
<<<<<<< HEAD
			$nDate[$id][] = (isset($nd[$dataset]))? $nd[$dataset] : '' ;
=======
			$nDate[$id][] = $nd[$dataset];
>>>>>>> 4d4edbc405106159b2b0dd28217a570536676f76
			
			$NodeName = explode(':',$n[0]['Name']);
			$ne=(int)$n[0]['EntityTypeID'];
			//echo $col[$cid] . ' - '. $nd['ID'] .'  ';
			
			if(!isset($nID[$id])){
				$nID[$id] = array();
				$nodeid[]=$id;
				if($id == $v0){
				//$col='#FF0000';
				$node[$id][] = "'". str_replace(".","",str_replace(" ","_",$NodeName[0])) . "_".$id ."':{'color':'#FF0000','shape':'".$cid[$ne]['shape']."', 'radius':30, 'alpha': ".$alpha.",'nodeid':'".$id."','image':'".$cid[$ne]['selectedimg']."','image_h':30,'image_w':30, 'label': '". $NodeName[0] ."'}";
				 } else {
				$node[$id][] = "'". str_replace(".","",str_replace(" ","_",$NodeName[0])) . "_". $id  ."':{'color':'". $cid[$ne]['col'] ."','shape':'".$cid[$ne]['shape']."', 'radius':30, 'alpha': ".$alpha.", 'nodeid':'".$id."','image':'".$cid[$ne]['img']."','image_h':30,'image_w':30, 'label': '". $NodeName[0] ."'}";
				 }				
				
			}
			
		}	
		//var_dump($nodeid);	
		
		
		for($k=0; $k<count($nodeid); $k++){
		$nid = $nodeid[$k];
		//var_dump($nDate[$nid]);
		$Ed="";
		$nd=explode(',',$nDate[$nid][0]);
		//var_dump($nd);
			for($j=0; $j<count($nd); $j++){ $Ed.= ' ['. $nd[$j] . ']'; }
		 $nodes .= str_replace("'}", $Ed ."'}", $node[$nid][0]) . ',';
		}
		

		$nodes .= "}";
		$edges .= "}";
		
		$nodes = str_replace(",}","}",$nodes);
		$edges = str_replace(",}","}",$edges);
		//echo $nodes .'<br>'; 
		//echo $edges;
		//exit;
		//$timeline = $this->timeline_data($v0);
		
		$vis_filter = $this->filter_data($node_arr);
	//'events' => $timeline['events'], 'sections' => $timeline['sections'],
		$content = array('edges' => $edges,'nodes' => $nodes,'error' => 'Entity Map', 'root' => $v0, 'node_title' => $nodetitle,  'filter_form'=> $vis_filter);
		
		$data_head = array('page_title' => 'Visualisation');

	$this->load->view('header',$data_head);
	$this->load->view('home',$content);
	$this->load->view('footer');
		
	}
	
	function tree_init($v0,$weed){
	
	$edges = "";
		$one = $this->tree_schema($v0, $weed);
		
		$nodetitle = $one['nodetitle'];
		//$weed = $one['weed'];
		array_push($weed,$v0);		
		$edges .= $one['edges'];
		$node_arr=$one['nodearray'];
	//echo 'edges ---' . $edges;
	//var_dump($node_arr); exit;
		//echo sizeof($one['fruit']);
		if (sizeof($one['fruit'])>0) {
			for($i=0; $i< (sizeof($one['fruit'])); $i++){
				$two = $this->tree_schema($one['fruit'][$i],$weed);
				array_push($weed, $one['fruit'][$i]);
				//var_dump($two); exit;
				$edges .= $two['edges'];
				$node_arr .= $two['nodearray'];
				if (sizeof($two['fruit'])>0) {
				  //echo 'tuko '. var_dump($weed) .'second array';exit;
					for($j=0; $j< (sizeof($two['fruit'])); $j++){
					
						$three = $this->tree_schema($two['fruit'][$j], $weed);
						//array_push($weed, $two['fruit'][$i]);
						$edges .= $three['edges'];
						//$nodes .= $three['fruit'];
						$node_arr .= $three['nodearray'];
						//$weed[]= $two['weed'];
						//$weed = array_merge(array_diff($weed,array($two['fruit'][$i])));
					}
				
				} 
				//var_dump($weed);
				$weed = array_merge(array_diff($weed,array($one['fruit'][$i])));
			}
		
		}
		
		$tr = array('nodes'=>$node_arr, 'edges'=>$edges, 'nodeTitle' => $nodetitle);
		return $tr;
		
	}
	
	
	function tree_schema($v, $weed){
		$fruit= array();
		$valz = array();
		$node_array = "";//$node_arr . ',';
		$nodes = "";
		$edges = "";
		//$node_arr = $this->clean_array($node_arr);
		$child0_ = $this->home->get_entries('ID',$v);
		$nodetitle = $child0_[0]['Name'];
		$child0 = explode(',',$child0_[0]['EntityMap']);
	//var_dump($v);
	//$k=0;
		foreach($child0 as $key => $v0) {
		
		$child_0 = explode('||',$v0)? : $v0;
		$child_0 = $this->clean_array($child_0);
		$child_0 = sizeof($weed)>0 ? array_merge(array_diff($child_0,$weed)) : $child_0;
		//var_dump($child_0);//exit;
			if (sizeof($child_0)>0){

				for($i=0; $i< (sizeof($child_0)); $i++){
				//$valz['ID'][]= $child_0[$i];
				//$valz['dataset'][]= $i;
				$valz[]=array('ID'=>$child_0[$i],'dataset'=>$key);
				}
			}
			//++$k;
		}
	//	var_dump($valz); 
		//echo count($valz);//exit;
		$tree = $this->tree_build($valz,$v,"1");
		$node_array = $tree['node_arr'];
		$edges = $tree['edges'];
		$fruit = $tree['fruit'];
		//var_dump($tree); exit;
		//$fruit = $this->compress_array($fruit);
		//$fruit = $this->clean_array($fruit);
		
		$level= array();
		$level['nodetitle']=$nodetitle;
		$level['nodearray']= $node_array;
		//$level['nodes']=$nodes;
		$level['edges']=$edges;
		$level['fruit']=$fruit;
		$level['weed']=$weed;
		return $level;
	}
	
	
	function tree_build($branch,$stem,$alpha=1){
	//var_dump($branch);// exit;
		//echo $stem; exit;
		$fruit= array();
		$tree = array();
		$j=0;
		
		//$tree['node_arr'] = $node_array;
		
		$root = $this->home->get_entries('ID',$stem);
		$root_Name = explode(':',$root[0]['Name']);
		//$nodes = "";
		$edges = "";
		//echo sizeof($branch);
	//	echo (!in_array(array($stem), explode(',',$node_array)))?  'true - '.$stem:  'false';
		$node_array = $stem . '|0,';
		if ( !isset($stm) ) {
		$stm[] = $stem;
 		$edges .= "'" . str_replace(".","",str_replace(" ","_",$root_Name[0]))."_". $stm[0] . "':{";

		}
		//	echo sizeof($branch). ',';
		for($k=0;$k<count($branch); $k++){
			$child = empty($branch[$k]['ID'])? NULL : $this->home->get_entries('ID',$branch[$k]['ID']);
			
			//var_dump($branch[$k]['ID']);
	 		if(sizeof($child)>0){
	 			
		 	   for($i=0; $i < sizeof($child); $i++){
		 		$child_Name = explode(':',$child[$i]['Name']);
				$edges .= "'". str_replace(".","",str_replace(" ","_",$child_Name[0])) ."_". $child[$i]['ID']."':{},";
			
				$node_array .=  $child[$i]['ID'] .'|'. $branch[$k]['dataset'] . ',' ;
				$fruit[] = $child[$i]['ID'];
			
				
			    }
			}
			if($k==10) break;
		}		
		
		if ( isset($stm) ) {
		$edges .= "},";
		unset($stm);			
		}
		//var_dump(explode(',',$node_array)); 
		//$tree['nodes'] = $nodes;
		$tree['node_arr'] = $node_array;
		$tree['edges'] = $edges;
		$tree['fruit'] = $fruit;
		//var_dump($tree['fruit']);
		return $tree;

	}
	
	
	function dataset_extract($dt,$v0){
	
	//echo $v0 . ' - ' . $dt; exit;
	//$this->output->enable_profiler(TRUE);
<<<<<<< HEAD
	 $flds= array();
	 $ids = array();
	 $valz = array();
=======
>>>>>>> 4d4edbc405106159b2b0dd28217a570536676f76
		$dta = $this->home->get_dataset_map($dt,$v0);
//var_dump($dta); exit;
		foreach($dta as $k => $d){
			foreach($d as $j => $f){ $flds[]= $j; }
			break;
		}
		
		foreach($flds as $f){
			for($i=0; $i<sizeof($dta); $i++){
				$ids[] = $dta[$i][$f];
			}
		}
		$ids = $this->clean_array($ids);
		
		foreach ($ids as $i){
			if($i != $v0){
		 	$valz[] = array('ID'=>$i,'dataset'=>'0');
		 	}
		}
		
		$one = $this->tree_build($valz,$v0,1);
		//var_dump($one); exit;
		$nt = $this->home->get_entries('ID',$v0);
		$nodetitle = $nt[0]['Name'];
		$tr = array('nodes'=>$one['node_arr'], 'edges'=>$one['edges'], 'nodeTitle' => $nodetitle);
		return $tr;	
	}

	
	function array_push_before($src,$in,$pos=1){
	    if(is_int($pos)) $R=array_merge(array_slice($src,0,$pos), $in, array_slice($src,$pos));
	    else{
	        foreach($src as $k=>$v){
	            if($k==$pos)$R=array_merge($R,$in);
	            $R[$k]=$v;
	        }
	    }return $R;
	}
	
	//-------------------- compress array values to keys in same level  -----------//
	function comb_array($arr){
	//echo  '<br>'.sizeof($arr);
		$t_ = array();
		
		foreach($arr as $data) {
		  if($data != NULL){
		    for($i=0; $i<sizeof($data);$i++){
		   // var_dump($data[$i]); exit;
			foreach($data[$i] as $key => $value) {
				if ( !isset($t_[$key]) ) {
				  $t_[$key] = array();
				//$t_[$key][] = "{";
				}
			// var_dump($value);	
			$t_[$key][] .=   "'". $value ."':{}";
			
			}
			//$t_[$key][] = "}";
		    }
		  }
		}
		return $t_ ;
	}
	
	/* --------------- format edge array to visualisation needs --------- */	
	function clean_tree($arr){
	$tree_ = array();
	$i = 0;
	$string="";
		foreach ($arr as $index => $value ){
	//echo sizeof($value);
			if($i != count($arr)-1){
		//$string .= '{';	
			$value = is_array($value[0]) ? $this->clean_tree($value[0]) : $value[0];
			      $string .= "{'$index': { $value,";
			}else {
				$string .= "'$index': {";
				for($j=0; $j<count($value);$j++){
					//$value[$j] = is_array($value[$j]) ? $this->clean_tree($value[$j]) : $value[$j];
					//if ($j==count($value)-1) {$string .= "{";}
					$string .= "$value[$j]";
					if ($j==count($value)-1) {$string .= "}";} else { $string .= ",";}
				}	 
				$string .= '}';
			}
			if ($i==count($arr)-1) {$string .= "}";} else { $string .= "},";}
			$i++;
		}
		//$string .= '}';
	return  $string;
	}
	
	function compress_array($arr){
		$valz=array();
		for($i=0; $i<sizeof($arr);$i++){
			foreach($arr[$i] as $key => $val){
				$valz[] = $val;
			}
		}
		return $valz;
	}
	
	function node_data(){
		//$this->output->enable_profiler(true); 

		$n = $_POST['node'];
		//$cont="";
		
		//$cont = "<h3><a href=" . site_url('/homes/tree/'.$root_node[0]['ID']). ">". $root_node[0]['Name'] ."</a>&nbsp;&nbsp;<span id='connections' class='badge pull-right'>1</span></h3>";
		$v=array();
		$child_node = $this->home->get_node($n);
		for($j=0; $j<sizeof($child_node); $j++){
		$arraymap = explode(',',$child_node[$j]['EntityMap']);
			foreach($arraymap as $key => $val){
				$valz = explode('||',$val);
				if(in_array($n, $valz)){ 
					$v[] = array('ID' => $child_node[$j]['ID'], 'arraypoint' => $key );
				}
				
			}
		}
		
		//alert($v);
		$maps= '{"data":[{"posts":[';
		//var_dump($root_node);
		if(sizeof($v)>0){
			for($i=0; $i<sizeof($v); $i++){
			$id = $v[$i]['ID'];
			$c_node = $this->home->get_entries('ID',$id);
			$arraypoint = $v[$i]['arraypoint'];
			
				
			$entMaps = explode(',',$c_node[0]['EntityMap']);
			$entMap_ref = $entMaps[$arraypoint];
			$entPos = explode('||',$c_node[0]['EntityPosition']);
			$entPos_ref = $entPos[$arraypoint];
			$entVerb = explode('||',$c_node[0]['Verb']);
			$entVerb_ref = $entVerb[$arraypoint];
			$entDate = explode('||',$c_node[0]['EffectiveDate']);
			$entDate_ref = $entDate[$arraypoint];
		
		
			$maps .= ' {"ID":"'. $c_node[0]['ID'] .'", "Name":"'. $c_node[0]['Name'] . '", "EntMap":"'. $entMap_ref. '","EntPos":"'. $entPos_ref. '", "Verb":"'. $entVerb_ref .'", "EffectiveDate":"'. $entDate_ref .'"},';	
						
			} 
		} else {
		$maps .= ' {"ID":"", "Name":"", "EntMap":"", "EntPos":"", "Verb":"", "EffectiveDate":""},';
		}
		$maps .= ']}';
		
		$root_node = $this->home->get_entries('ID',$n);
		$doc_ids = explode(',',$root_node[0]['DocID']);
		$d=0;
		$extraData="";
		
		for($i=0; $i<sizeof($doc_ids); $i++){
		$doc_ref = $doc_ids[$i];
		
		$dataset = $this->home->get_doc($doc_ref);
		foreach($dataset as $row){
		$dt=$row['data_table'];
		//echo $dt;
		   if($dt!=""){
				$d=1; 
				$ds=$row['representation'];
				$q = ($ds=="")? '*' : $ds;
			
				$dta = $this->home->get_dataset($dt,$q,$n);
				//var_dump($dta[0]);

				//echo sizeof($dta);
				for($j=0; $j<sizeof($dta); $j++){
					$extraData .= '<div class="row_head">';
					foreach($dta[$j] as  $key => $val){
						//foreach($cont as $key => $val){
					  $extraData .= '<div class="col_head">';
						$extraData .= '<div class="col1_head">'. $key .'</div>';
						$extraData .= '<div class="col2_head">'. $val .'</div>';
					  $extraData .= '</div>';
						//}
					}
					$extraData .= '</div>';
				}
				//echo $extraData;
			}
		    }
		}
		$maps .=', {"header":[{"ID":"'. $root_node[0]['ID'] .'", "Name":"'. $root_node[0]['Name'] . '", "EntMap":"'. $root_node[0]['EntityMap'] . '","EntPos":"'. $root_node[0]['EntityPosition']. '", "Verb":"'. $root_node[0]['Verb'] .'", "EffectiveDate":"'. $root_node[0]['EffectiveDate'] .'", "Link":"' . site_url('/homes/tree/'.$n) . '", "ExtraData":"'. htmlspecialchars($extraData) .'", "E_D":"'. $d .'"}]}';

		$rd = explode('||',$root_node[0]['EffectiveDate']);
		$rv = explode('||',$root_node[0]['Verb']);
		$rm = explode(',', $root_node[0]['EntityMap']);
		for($k=0; $k<sizeof($rm); $k++){
			$v = $rv[$k];
<<<<<<< HEAD
			$d =  (isset($rd[$k])) ? $rd[$k] : '';
=======
			$d = $rd[$k];
>>>>>>> 4d4edbc405106159b2b0dd28217a570536676f76
			$m = $rm[$k];
			$rmap = explode('||',$m);
			if(sizeof($rmap)>0){
				for($l=0; $l<sizeof($rmap); $l++){
					$nid = $rmap[$l];
					//if ( !isset($r[$nid]) ) {
					  $r[$nid][] = array('Verb'=>$v, 'Dated'=>$d);
					//}
					//$r[$nid]['Verb'][] = $v;
					//$r[$nid]['Dated'][] = $d;
				}
			} else {
				//if ( !isset($r[$m]) ) {
				  $r[$m][] = array('Verb'=>$v, 'Dated'=>$d);
				//}
				//$r[$m]['Verb'][] = $v;
				//$r[$m]['Dated'][] = $d;
			}
		}
		
		$vb = "";
		foreach($r as $key => $val){
			if ($key!=""){
				$vb .= '{"_'.$key .'":[';
				if (is_array($val)){
				
					foreach($val as $vk => $v){
					$vb .= '{"Verb":"'. $v['Verb'].'","Dated":"'. $v['Dated']. '"},';
					}
				} 
				
				$vb .= ']},';
			}	
		}
		
		
		
		$maps .=', {"arraymap":['.$vb.']}'; 
		$maps .=']}';
		$maps = str_replace(",]","]",$maps);
		$maps = str_replace(",}","}",$maps);

		echo json_encode($maps);

	    
	}	
	
	function timeline_data($n){
		$this->output->enable_profiler(false);  
		$events="";
		$chrono="";
		$node = $this->home->get_node($n);
		if(count($node) > 0){
		//var_dump($node); exit;
		//echo $node[0]['DocID']; exit;
		$DocIDs = explode(',', $node[0]['DocID']);
		$Dates = explode(',', $node[0]['EffectiveDate']);
		

		if (is_array($DocIDs)){
		   for($i=0;$i<sizeof($DocIDs);$i++) {

			$docs = $this->home->get_doc($DocIDs[$i]);
			//var_dump($docs); 
			if (sizeof($docs)>0){
					
				$dates = explode(':',$Dates[$i]);
				//echo $dates[0]; exit;
				$StartDate = date('Y,m,d' ,strtotime($dates[0]));
				
				$EndDate = date('Y,m,d' ,strtotime($dates[1]));
				$events .= '{dates: [new Date('.$StartDate.'),new Date('.$EndDate.')], title: "Was Mentioned in '. $docs[0]['title']. '", section: 0},'; 
				
			}		
		    }		
		}
		 $StartDate = (!isset($StartDate))? : date('Y,m,d');
		 $sections = '{"dates": [new Date('.$StartDate.')], "title": "Gazette Entries", "section": 0, "attrs": {"fill": "#d4e3fd"}}';
		// echo $events; exit;
	$chrono = array('events' => $events,'sections' => $sections);
		}
	return $chrono;
	}
	
	function filter_data($var){
	
	//var_dump($var);
	$this->output->enable_profiler(false); 
		$form_filter = $this->home->get_mapped_entries($var);
		$form_f ="";
		
		for($j=0; $j<count($form_filter);$j++){
		
		$form_f .= "<input style='width: 20px;' type='checkbox' checked name='Filter[]' value='". $form_filter[$j]['EntityTypeID'] ."' class='FilterForm'> ". $form_filter[$j]['EntityType'] ;
		
		}
		
	return $form_f;	
	}
}

/* End of file posts.php */
/* Location: ./application/controllers/posts.php */
