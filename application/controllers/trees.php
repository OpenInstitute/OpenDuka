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
	
	function tree_build($branch,$stem,$weed,$col='#6FB1FC',$alpha=1){
		
		//$t = array();
		$tree = array();
		$tree['t'] = array();
		$root = $this->tree->get_entries('ID',$stem);
		$child = empty($branch)? NULL : $this->tree->get_entries('ID',$branch);
		
		$root_Name = explode(':',$root[0]['Name']);
		//var_dump($weed); echo "<br>";
		$nodes = "";
		if(!in_array($stem, $weed)){
		$nodes = "'".str_replace(" ","_",$root_Name[0]) ."':{ 'color':'".$col."', 'shape':'rectangle', 'radius':30, 'alpha': ".$alpha.", 'label': '".str_replace(" ","_",$root_Name[0])."', 'nodeid':'".$stem."'},\n";
		}
		$edges = "";

 		if(sizeof($child)>0){
 		$edges .= "'" . str_replace(" ","_",$root_Name[0]) . "': {";
	 		for($i=0; $i < sizeof($child); $i++){
	 		$child_Name = explode(':',$child[$i]['Name']);
			$edges .= "'". str_replace(" ","_",$child_Name[0])."':{},";
			
			//$tree['t'][] = array("'".str_replace(" ","_",$root_Name[0])."'" => "'".str_replace(" ","_",$child_Name[0])."'");
			$tree['t'][] = array($root_Name[0] => $child_Name[0]);
			}
		$edges .= "},";
		
		}
		
		$tree['nodes'] = $nodes;
		$tree['edges'] = $edges;
		//$tree['t'] = $t;
		return $tree;
			//}//end for root loop
	}

	function tree($v0_) {
		//	$this->output->enable_profiler(TRUE);  
		//echo $context;exit;
		$weed = array();
		$one=array();
		$two=array();
		$three=array();
		$four=array();
		$five=array();
		$child0_ =$this->tree->get_entries('ID',$v0_);
		$nodetitle = $child0_[0]['Name'];
		$child0 = explode(',',$child0_[0]['EntityMap']);
		$nodes = "{";
		$edges = "{";
		foreach($child0 as $key => $v0) {
		$child_0 = explode('||',$v0)? : $v0;
		$child_0 = $this->clean_array($child_0);
//var_dump($child_0);
		//$child_0 = array_diff(array($id),$v0);
			if (sizeof($child_0)>0){
				//level 1	
				$tree = $this->tree_build($child_0,$v0_,$weed,"#00a650","1"); //color green
				$nodes .= $tree['nodes'];
				$edges .= $tree['edges'];
				$one[] = isset($tree['t'][0]) ? $tree['t'][0] : NULL;
				array_push($weed,$v0_);
				$i =0;
				foreach ($child_0 as $key => $v1_) {
				  $child1_ = $this->tree->get_entries('ID',$v1_);
				  $child1 = explode(',',$child1_[0]['EntityMap']);
				  $child1 = $this->clean_array($child1);
//var_dump($child1);
				    if (sizeof($child1)>0) {
				    
				     foreach ($child1 as $key => $v1){
				       $child_1 = explode('||',$v1)? : $v1;
				       $child_1 = $this->clean_array($child_1);

//var_dump($child_1); echo " - ".$v0_;	echo "<br>";			       				       
				       $child_1 = array_diff($child_1,array($v0_));
//var_dump($child_1); 				       
					$tree = $this->tree_build($child_1,$v1_,$weed,"#00a650","1"); //color green
					$nodes .= $tree['nodes'];
					$edges .= $tree['edges'];
					$two[] = isset($tree['t'][0]) ? $tree['t'][0] : NULL;
					array_push($weed,$v1_);
					
					foreach($child_1 as $key => $v2_){
					$child2_ = $this->tree->get_entries('ID',$v2_);
				        $child2 = explode(',',$child2_[0]['EntityMap']);
				        $child2 = $this->clean_array($child2);

				        if (sizeof($child2)>0) {
				          foreach($child2 as $key => $v2){
				         $child_2 = explode('||',$v2)? : $v2;
					 $child_2 = $this->clean_array($child_2);
					 $child_2 = array_diff(array($v1_),$child_2);
					 
					 $tree = $this->tree_build($child_2,$v2_,$weed,"#00a650","1"); //color green
					
					 $nodes .= $tree['nodes'];
					 $edges .= $tree['edges'];
					 $three[] = isset($tree['t'][0]) ? $tree['t'][0] : NULL;
					 array_push($weed,$v2_);
					   foreach($child_2 as $key => $v3_){
					   
					   	$child3_ = $this->tree->get_entries('ID',$v3_);
				        	$child3 = explode(',',$child3_[0]['EntityMap']);
				        	$child3 = $this->clean_array($child3);
				        	
						if (sizeof($child3)>0){
						foreach($child3 as $key => $v3){
						$child_3 = explode('||',$v3)? : $v3;
					 	$child_3 = $this->clean_array($child_3);
					 	$child_3 = array_diff(array($v2_),$child_3);
					 	
					 	$tree = $this->tree_build($child_3,$v3_,$weed,"#00a650","1"); //color green
					 	$nodes .= $tree['nodes'];
					 	$edges .= $tree['edges'];
					 	$four[] = isset($tree['t'][0]) ? $tree['t'][0] : NULL;
					 	array_push($weed,$v3_);
						$j =0;
						 foreach ($child_3 as $key => $v4_) {
						   $child4_ = $this->tree->get_entries('ID',$v4_);
						   $child4 = explode(',',$child4_[0]['EntityMap']);
						   $child4 = $this->clean_array($child4);
						   
						   if (sizeof($child4)>0){
							foreach($child4 as $key => $v4){
							$child_4 = explode('||',$v4)? : $v4;
						 	$child_4 = $this->clean_array($child_4);
						 	$child_4 = array_diff(array($v3_),$child_4);
						 	
						 	$tree = $this->tree_build($child_4,$v4_,$weed,"#00a650","1"); //color green
						 	$nodes .= $tree['nodes'];
						 	$edges .= $tree['edges'];
						 	$five[] = isset($tree['t'][0]) ? $tree['t'][0] : NULL;
							array_push($weed,$v4_);
							if (++$j == 10) break;
							}
						      }
						   }
						}
					      }
					   }
					  }
					   
					}
				      }
				    }
				  }
				if (++$i == 10) break;
			    }
			}
			
		}
			$nodes .= "}";
			$edges .= "}";
	//echo is_array($one);		

$one = (sizeof($one)>0)? $this->comb_array($one): NULL;
$two = (sizeof($two)>0)? $this->comb_array($two): NULL;
$three = (sizeof($three)>0)? $this->comb_array($three): NULL;
$four = (sizeof($four)>0)? $this->comb_array($four): NULL;
$five = (sizeof($five)>0)? $this->comb_array($five): NULL;
array_push($one, $two);
echo sizeof($one);
//var_dump($two);
$tree_= $this->clean_tree($one);

$edges = $tree_;
//$edges = str_replace(array("{","}",":"), array("array(","}","=>"), $edges);
   // echo phpStringArray;
		
		$nodes = str_replace(",}","}",$nodes);
		//$edges = str_replace(",}","}",$edges);
		$content = array('edges' => $edges,'nodes' => $nodes,'error' => 'Entity Map', 'root' => $v0_, 'node_title' => $nodetitle);
		$data_head = array('page_title' => 'Tree Map');


		$this->load->view('header',$data_head);
		$this->load->view('tree',$content);
		$this->load->view('footer');
		
	}
			
	function array_push_before($src,$in,$pos){
	    if(is_int($pos)) $R=array_merge(array_slice($src,0,$pos), $in, array_slice($src,$pos));
	    else{
	        foreach($src as $k=>$v){
	            if($k==$pos)$R=array_merge($R,$in);
	            $R[$k]=$v;
	        }
	    }return $R;
	}
	
	function comb_array($arr){
		$t_ = array();
		foreach ( $arr as $data ) {
		  if($data != NULL){
			foreach ( $data as $key => $value ) {
				if ( !isset($t_[$key]) ) {
				$t_[$key] = array();
				}
			$t_[$key][] = "{'" . $value . "': {}}";
			}
		  }
		}
		return $t_;
	}
	
	function clean_tree($arr){
	$tree_ = array();
	
		 // if($arr != NULL){
	/*		while (list($key, $val) = each($arr)) {
			$tree_ .=  $key ." : {'" . is_array($val) ? $this->clean_tree($val) : $val ."' : {}}";
			}
		 // }
	*/	 
		//foreach ($arr as $v) {
		//
	  // foreach ($arr as $key => $val) {
	/*	var_dump($arr);
		for ($i=0; $i<sizeof($arr); $i++){
		  foreach ($arr[$i] as $key => $val) {
		   $tree_ .= "'". $key ."' : {'". is_array($val[$i]) ? $this->clean_tree($val[$i]) : $val[$i] ."' : {}},";
		 }
	   }
		//}*/
		
	$i = 0;
	//$string = '';
	
	foreach ($arr as $index => $value ){
		if($i != count($arr)-1){
		var_dump($value); 
		//$value = is_array($value[0]) ? $this->clean_tree($value[0]) : $value[0];
		      $string .= "'$index'- : ".$this->clean_tree($value).",";
		}else {
		//$value = is_array($value[0]) ? $this->clean_tree($value[0]) : $value[0];
			$string .= "'$index' :$value";}
		$i++;
	}
	
	$string = '{'.$string.'}';
	
	return  $string;

	//return $tree_;
		
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
