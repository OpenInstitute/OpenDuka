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
		$data_head = array('page_title' => 'Entity Search!');

		$this->load->view('header',$data_head);
		$this->load->view('tree', array('entities' => '','error' => 'Type name to search'));
		$this->load->view('footer');
	}
	
	function entitylist()
	{
		$data_head = array('page_title' => 'Search list!');
		$EntityName = $_POST['search_name'];		
		//echo $context;exit;
		$content = $this->tree->get_entry_cont('Name',$EntityName);
	//	var_dump($content[0]);
		$list = '';
		if (is_array($content)){
			for($i=0;$i< count($content);$i++)
			{
				$list .= "<p>". $content[$i]['Name'] . "<a href=" .site_url('/trees/tree/'.$content[$i]['ID']). "> View Tree</a></p>"; 
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
	
	function tree_build($branch,$stem,$node_array,$col='#6FB1FC',$alpha=1){
		//var_dump($node_array); exit;
		$fruit= array();
		$tree = array();
		$j=0;
		
		//$tree['node_arr'] = $node_array;
		
		$root = $this->tree->get_entries('ID',$stem);
		$child = empty($branch)? NULL : $this->tree->get_entries('ID',$branch);
		
		$root_Name = explode(':',$root[0]['Name']);
		
		//$nodes = "";
		$edges = "";
		
	//	echo (!in_array(array($stem), explode(',',$node_array)))?  'true - '.$stem:  'false';

 		if((sizeof($child)>0) && (!in_array(array($stem), explode(',',$node_array)))){
 		$node_array .= $stem . ',';
 		$edges .= "'" . str_replace(".","",str_replace(" ","_",$root_Name[0])) . "': {";

	 	   for($i=0; $i < sizeof($child); $i++){
	 		$child_Name = explode(':',$child[$i]['Name']);
			$edges .= "'". str_replace(".","",str_replace(" ","_",$child_Name[0])) ."':{},";
			
			$node_array .=  $child[$i]['ID'] . ',' ;
			$tree['fruit'][]= $child[$i]['ID'];
			
			if(++$j==10) break;
		    }
		    
		$edges .= "},";
		}
		//var_dump(explode(',',$node_array)); exit;
		//var_dump($tree['node_arr']); exit;
		//$tree['nodes'] = $nodes;
		$tree['node_arr'] = $node_array;
		$tree['edges'] = $edges;
		//var_dump($tree['t']);
		return $tree;
			//}//end for root loop
	}


	function tree($v0) {
		//$this->output->enable_profiler(TRUE);  
		$weed = array();
		$fruit = array();
		$node_arr = "";
		$alpha = 1;
		
		$nodes = "{";
		$edges = "{";
		$one = $this->tree_schema($v0, $node_arr,'#00a650');
		$nodetitle = $one['nodetitle'];
		//$nodes .= $one['nodes'];
		$edges .= $one['edges'];
		
		$node_arr=$one['nodearray'];
	//var_dump($node_arr); exit;
		//echo sizeof($node_arr);
		if (sizeof($one['fruit'])>0) {
			for($i=0; $i< (sizeof($one['fruit'])); $i++){
				$two = $this->tree_schema($one['fruit'][$i], $node_arr,'#00CCCC');
				$edges .= $two['edges'];
				//$nodes .= $two['fruit'];
				$node_arr = $two['nodearray'];
				
				if (sizeof($two['fruit'])>0) {
					for($j=0; $j< (sizeof($two['fruit'])); $j++){
						$three = $this->tree_schema($two['fruit'][$j],  $node_arr,'#00CCCC');
						$edges .= $three['edges'];
						//$nodes .= $three['fruit'];
						$node_arr = $three['nodearray'];
						//$weed[]= $two['weed'];
					}
		
				}			
			}
		
		}
		
		//echo $node_arr;
		$node_arr= $this->clean_array(explode(',',$node_arr)); 
		$valz=array();
		//var_dump($node_arr);exit;
		/*for($i=0; $i<sizeof($node_arr);$i++){
			foreach($node_arr[$i] as $key => $val){
				$valz[] = $val;
			}
		}
		*/
		//var_dump($valz);exit;

		$n = $this->tree->get_entries('ID',$node_arr);
		foreach($n as $nd){
			$NodeName = explode(':',$nd['Name']);
			
			if($nd['ID'] == $v0){
			$col='#00a650';
			$nodes .= "'". str_replace(".","",str_replace(" ","_",$NodeName[0])) ."':{ 'color':'".$col."', 'shape':'rectangle', 'radius':30, 'alpha': ".$alpha.", 'label': '". str_replace(" ","_",$NodeName[0])."', 'nodeid':'".$nd['ID']."'},";
			} else {
			
			$col = '#6FB1FC';
			$nodes .= "'". str_replace(".","",str_replace(" ","_",$NodeName[0])) ."':{ 'color':'".$col."', 'shape':'rectangle', 'radius':30, 'alpha': ".$alpha.", 'label': '". str_replace(" ","_",$NodeName[0])."', 'nodeid':'".$nd['ID']."'},";
			}
		}
		
		$nodes .= "}";
		$edges .= "}";
		
		$nodes = str_replace(",}","}",$nodes);
		$edges = str_replace(",}","}",$edges);
	
		$content = array('edges' => $edges,'nodes' => $nodes,'error' => 'Entity Map', 'root' => $v0, 'node_title' => $nodetitle);
		$data_head = array('page_title' => 'Tree Map');

	$this->load->view('header',$data_head);
	$this->load->view('tree',$content);
	$this->load->view('footer');
		
	}
	
	function tree_schema($v, $node_arr, $col){
		
		$node_array = $node_arr . ',';
		$nodes = "";
		$edges = "";
		//$node_arr = $this->clean_array($node_arr);
		$child0_ = $this->tree->get_entries('ID',$v);
		$nodetitle = $child0_[0]['Name'];
		$child0 = explode(',',$child0_[0]['EntityMap']);
	
		foreach($child0 as $key => $v0) {
		$child_0 = explode('||',$v0)? : $v0;
		$child_0 = $this->clean_array($child_0);
//var_dump($child_0); exit;
			if (sizeof($child_0)>0){
				$tree = $this->tree_build($child_0,$v,$node_arr,$col,"1");
				$node_array .= $tree['node_arr'];
				$edges .= $tree['edges'];
				//array_push($weed,$v);		
			}
		}
	//$node_array = $this->comb_array($node_array);
//$nodes = substr($nodes, 0, -1);
	//var_dump($node_array); exit;
	$level= array();
	$level['nodetitle']=$nodetitle;
	$level['nodearray']= $node_array;
	//$level['nodes']=$nodes;
	$level['edges']=$edges;
	$level['fruit']=$tree['fruit'];
//	$level['weed']=$weed;
	return $level;
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
	
	function node_data(){
		$this->output->enable_profiler(FALSE);  
		$n = $_POST['node'];
		
		$root_node = $this->tree->get_node($n);
		$cont = "<b>". $root_node[0]['Name'] ."</b><br/>";
		$v = ($root_node[0]['Verb']=='0')? " has " : " was ";
		$cont .= $v ;
		
		$child_nodes = explode('||',$root_node[0]['EntityMap']);
		$child_nodes = $this->clean_array($child_nodes);
		$cont .= "<ul>";
		foreach($child_nodes as $c_id){
	            $child_node = $this->tree->get_node($c_id);
	            $cont .= "<li><b>". $child_node[0]['Verb'] . "</b> ".$child_node[0]['Name']. " Effected Date - ".$child_node[0]['EffectiveDate']. "</li>";
	        }
		$cont .= "</ul>";
	    echo $cont;
	}

}

/* End of file posts.php */
/* Location: ./application/controllers/posts.php */
