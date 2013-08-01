<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trees extends CI_Controller {

    
       
       function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model('tree');
	}
	
	function index($start=0)
	{
		$data_head = array('page_title' => 'Open Duka');

		$this->load->view('header',$data_head);
		$this->load->view('tree', array('entities' => '','error' => ''));
		$this->load->view('footer');
	}
	
	function entitylist()
	{
		$data_head = array('page_title' => 'Search results');
		$EntityName = $_POST['search_name'];		
		//echo $context;exit;
		$content = $this->tree->get_entry_cont('Name',$EntityName);
	//	var_dump($content[0]);
		$list = '';
		if (is_array($content)){
			for($i=0;$i< count($content);$i++)
			{
				$list .= "<li><a href=" .site_url('/trees/tree/'.$content[$i]['ID']). ">". $content[$i]['Name'] . "</a></li>"; 
			}		
		}
		$this->load->view('header',$data_head);
		$this->load->view('tree', array('entities' => '','list' =>$list, 'error' => 'List of names found'));
		$this->load->view('footer');
	}
	
	function clean_array($arr){
	//var_dump($arr);
		if(is_array($arr)){
			$arr = array_unique($arr);
			$arr = array_filter($arr);
			$new_arr = array();
			 foreach ($arr as $val){
			 	$new_arr[] = $val;
			 }	
		}
		return $new_arr;
	}
	

	function tree($v0) {
		//$this->output->enable_profiler(TRUE);  

		$weed = array();
		$fruit = array();
		$node_arr = "";
		$alpha = 1;
		
		$nodes = "{";
		$edges = "{";
		$one = $this->tree_schema($v0, $weed);
		$nodetitle = $one['nodetitle'];
		//$weed = $one['weed'];
		array_push($weed,$v0);		
		$edges .= $one['edges'];
		$node_arr=$one['nodearray'];
	//echo 'fruits ---';
	//var_dump($node_arr);
	// exit;
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
		
		//echo $node_arr;
		$node_arr= $this->clean_array(explode(',',$node_arr)); 
		
		$n = $this->tree->get_entries('ID',$node_arr);
		$col = array();
		$col['21']='#00CCCC';
		$col['22']='#00a650';
		
		foreach($n as $nd){
			$NodeName = explode(':',$nd['Name']);
			$cid=(int)$nd['EntityTypeID'];
			//echo $col[$cid] . ' - '. $nd['ID'] .'  ';
			if ($cid==21){$col='#00CCCC'; $shape='dot';} else {$col='#00a650'; $shape='rectangle';}
			
			if($nd['ID'] == $v0){
			$col='#FF0000';
			$nodes .= "'". str_replace(".","",str_replace(" ","_",$NodeName[0])) . "_".$nd['ID'] ."':{ 'color':'".$col."', 'shape':'".$shape."', 'radius':30, 'alpha': ".$alpha.", 'label': '". str_replace(" ","_",$NodeName[0])."', 'nodeid':'".$nd['ID']."'},";
			} else {
			//exit;
			//$c=$col[$cid];
			//$col = '#6FB1FC';
			$nodes .= "'". str_replace(".","",str_replace(" ","_",$NodeName[0])) . "_".$nd['ID']  ."':{ 'color':'". $col ."', 'shape':'".$shape."', 'radius':30, 'alpha': ".$alpha.", 'label': '". str_replace(" ","_",$NodeName[0])."', 'nodeid':'".$nd['ID']."'},";
			}
			
		}
		
		$nodes .= "}";
		$edges .= "}";
		
		$nodes = str_replace(",}","}",$nodes);
		$edges = str_replace(",}","}",$edges);
		
		$timeline = $this->timeline_data($v0);
		
		$vis_filter = $this->filter_data($node_arr);
	
		$content = array('edges' => $edges,'nodes' => $nodes,'error' => 'Entity Map', 'root' => $v0, 'node_title' => $nodetitle, 'events' => $timeline['events'], 'sections' => $timeline['sections'], 'filter_form'=> $vis_filter);
		
		$data_head = array('page_title' => 'Visualisation');

	$this->load->view('header',$data_head);
	$this->load->view('tree',$content);
	$this->load->view('footer');
		
	}
	
	function tree_schema($v, $weed){
		$fruit= array();
		$valz = array();
		$node_array = "";//$node_arr . ',';
		$nodes = "";
		$edges = "";
		//$node_arr = $this->clean_array($node_arr);
		$child0_ = $this->tree->get_entries('ID',$v);
		$nodetitle = $child0_[0]['Name'];
		$child0 = explode(',',$child0_[0]['EntityMap']);
	//var_dump($child0);
		foreach($child0 as $key => $v0) {
		$child_0 = explode('||',$v0)? : $v0;
		$child_0 = $this->clean_array($child_0);
		$child_0 = sizeof($weed)>0 ? array_merge(array_diff($child_0,$weed)) : $child_0;
		//var_dump($child_0);	
			if (sizeof($child_0)>0){

				for($i=0; $i< (sizeof($child_0)); $i++){
				$valz[]= $child_0[$i];

				}
			}
		}
		//var_dump($valz); exit;
		$tree = $this->tree_build($valz,$v,"1");
		$node_array = $tree['node_arr'];
		$edges = $tree['edges'];
		$fruit = $tree['fruit'];
		//var_dump($fruit); exit;
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
		//var_dump($branch); //exit;
		$fruit= array();
		$tree = array();
		$j=0;
		
		//$tree['node_arr'] = $node_array;
		
		$root = $this->tree->get_entries('ID',$stem);
		$child = empty($branch)? NULL : $this->tree->get_entries('ID',$branch);
		
		$root_Name = explode(':',$root[0]['Name']);
		
		//$nodes = "";
		$edges = "";
		//echo sizeof($child);
	//	echo (!in_array(array($stem), explode(',',$node_array)))?  'true - '.$stem:  'false';
		$node_array = $stem . ',';
 		if(sizeof($child)>0){
 		
 		$edges .= "'" . str_replace(".","",str_replace(" ","_",$root_Name[0]))."_".$root[0]['ID'] . "': {";

	 	   for($i=0; $i < sizeof($child); $i++){
	 		$child_Name = explode(':',$child[$i]['Name']);
			$edges .= "'". str_replace(".","",str_replace(" ","_",$child_Name[0])) ."_". $child[$i]['ID']."':{},";
			
			$node_array .=  $child[$i]['ID'] . ',' ;
			$fruit[] = $child[$i]['ID'];
			
			if(++$j==10) break;
		    }

		$edges .= "},";
		}
		//var_dump(explode(',',$node_array)); 
		//$tree['nodes'] = $nodes;
		$tree['node_arr'] = $node_array;
		$tree['edges'] = $edges;
		$tree['fruit'] = $fruit;
		//var_dump($tree['fruit']);
		return $tree;

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
		$this->output->enable_profiler(false); 
		$j=0; 
		$n = $_POST['node'];
		
		$root_node = $this->tree->get_node($n);
		$cont = "<h3><a href=" . site_url('/trees/tree/'.$root_node[0]['ID']). ">". $root_node[0]['Name'] ."</a></h3>";
		 
		
		$child_nodes = explode('||',$root_node[0]['EntityMap']);
		$child_nodes = $this->clean_array($child_nodes);
		$cont .= "<ul class='status'>";
		//var_dump($child_nodes);
		foreach($child_nodes as $c_id){
		
		$child_node = $this->tree->get_node($c_id);
		
		$v = ($root_node[0]['Verb']=='0')?  $child_node[0]['Verb'] : 'Was '. $root_node[0]['Verb'] .' by ' ;
			            
	            $cont .= "<li><p><span class='st-verb'>". $v."</span> <span class='st-name'>".$child_node[0]['Name']. "</span></p><p><span class='st-date'>Effected Date - ".$child_node[0]['EffectiveDate']. "</span></p></li>";
	            //if(++$j==10) break;
	        }
		$cont .= "</ul>";
	    echo $cont;
	}
	
	
	function timeline_data($n){
		$this->output->enable_profiler(false);  
		$events="";
		$node = $this->tree->get_node($n);
		//var_dump($node); exit;
		//echo $node[0]['DocID']; exit;
		$DocIDs = explode(',', $node[0]['DocID']);
		$Dates = explode(',', $node[0]['EffectiveDate']);
		

		if (is_array($DocIDs)){
		   for($i=0;$i<sizeof($DocIDs);$i++) {

			$docs = $this->tree->get_doc($DocIDs[$i]);
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
	return $chrono;
	}
	
	function filter_data($var){
	
	//var_dump($var);
	$this->output->enable_profiler(false); 
		$form_filter = $this->tree->get_mapped_entries($var);
		$form_f ="";
		
		for($j=0; $j<count($form_filter);$j++){
		
		$form_f .= "<input style='width: 20px;' type='checkbox' checked name='Filter[]' value='". $form_filter[$j]['EntityTypeID'] ."' class='FilterForm'> ". $form_filter[$j]['EntityType'] ;
		
		}
		
	return $form_f;	
	}
}

/* End of file posts.php */
/* Location: ./application/controllers/posts.php */
