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
	
	function tree_build($From,$To,$col='black'){
		
		
		$root = $this->tree->get_entries('ID',$To);
		$child = empty($From)? NULL : $this->tree->get_entries('ID',$From);
		//var_dump($child);exit;
		//for($i=0; $i < sizeof($root); $i++){
			$tree = '{"adjacencies": [';
			$nodeName = $root[0]['Name'];
		//	echo $root[$i];exit;
			//	if (in_array($root[$i],$master_array)) { echo 'true' ;} else { echo 'false';}
			 		for($i=0; $i < sizeof($child); $i++){
						//$child_2_cnt =$this->tree->get_entries('ID',$child_1[$i]);
					//	echo $child_2_cnt[0]['Name'];exit;
			              $tree .= '{';
			              $tree .= '"nodeTo": "'.$child[$i]['Name'].'",';
			              $tree .= '"nodeFrom": "'.$nodeName.'",';
				              $tree .= '"data": {';
				              $tree .= '"$color": "black"';
				              $tree .= '}';
		            	  $tree .= '},';
						  //$nodeName = $child_1_cnt[0]['Name'];
					}//for sizeof child_1

			  $tree .= '],';
			  $tree .= '"data": {';
			      $tree .= '"$color": "'.$col.'",';
			      $tree .= '"$type": "circle",';
			      $tree .= '"$dim": 5';
		      $tree .= '},';
		      $tree .= '"id": "'.$nodeName.'",';
		      $tree .= '"name": "'.$nodeName.'"';
		      $tree .= '},';
			return $tree;
			//}//end for root loop
	}

	function tree($id) {
		
		//echo $context;exit;
		$master_array = array();
		$content =$this->tree->get_entries('ID',$id);
		$root = explode('||',$content[0]['EntityMap']);
		$tree = "";
		//var_dump(array_unique($root));
		$root = $this->clean_array($root);
		//var_dump($root);
		$master_array = $this->array_push_before($master_array,array($id),0);
		//$child_1_cnt =$this->tree->get_entries('ID',$root);
		//var_dump($child_1_cnt[0]); exit;
	//	var_dump($master_array[0]); exit;
		if (sizeof($root)>0){
			//var_dump($root); exit;
			//level 1			
			$tree .= $this->tree_build($root,$id,"red");
			//level2
			foreach ($root as $key => $value) {
				//echo $value;
				$content1 =$this->tree->get_entries('ID',$value);
				$root1 = explode('||',$content1[0]['EntityMap']);
				$root1 = $this->clean_array($root1);
				$root1 = array_diff($root1, array($id));
			//	var_dump($root1);//exit;
				$tree .= $this->tree_build($root1,$value,"blue");
			}
			
			
			$tree = substr($tree, 0, -1);
			//echo $tree; exit;
			$tree = str_replace(',]}',']}',$tree);
			$tree = str_replace('},}','}}',$tree);
			$tree = str_replace('}{','},{',$tree);
			$tree = json_encode($tree);

		}// if $root size array >0
		//echo $tree;
		$content = array('tree' => $tree,'error' => 'Entity Map', 'root' => $id);
		$data_head = array('page_title' => 'Tree Map');


		$this->load->view('header_entity',$data_head);
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

}

/* End of file posts.php */
/* Location: ./application/controllers/posts.php */
