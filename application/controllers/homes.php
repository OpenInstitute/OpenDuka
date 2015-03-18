<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homes extends CI_Controller {
       
       function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->library('pagination');
		$this->load->model('home');
		$this->load->helper('form');

	}
	
	function index($start=0)
	{
		$data_head = array('page_title' => 'Open Duka');
		$docs=array();
		$organisations = $this->home->get_number_entity_group('21');
		$persons = $this->home->get_number_entity_group(22);
		$docTypes = $this->home->get_dataset_count();
		
		//echo serialize($docs); exit;
		
		$latestlist = $this->home->get_latest_entry();
		$list="";
		if (is_array($latestlist)){
			for($i=0;$i< count($latestlist);$i++)
			{
				$list .= "<li><a href=" .site_url('/homes/tree/'.$latestlist[$i]['ID']). ">". $latestlist[$i]['Name'] . "</a></li>"; 
			}		
		}
		
		$popularlist = $this->home->get_popular_entry();
		$Plist="";
		if (is_array($popularlist)){
			for($i=0;$i< count($popularlist);$i++)
			{
				$Plist .= "<li><a href=" .site_url('/homes/tree/'.$popularlist[$i]['ID']). ">". $popularlist[$i]['Name'] . "</a></li>"; 
			}		
		}

		for($i=0;$i< count($docTypes);$i++)
		{
		 $docs= array_merge(array($docTypes[$i]['DocType'] =>  $docTypes[$i]['CatTot'], $docTypes[$i]['DocType'].'ID' =>  $docTypes[$i]['DocTypeID'] ), $docs);
		}
		$docs = array_merge(array('organisations' => $organisations, 'persons' => $persons,'latest_list' => $list,'popular_list' => $Plist,'error' => ''), $docs);
//var_dump($docs); exit;
		$this->load->view('header',$data_head);
		$this->load->view('home', $docs);
		$this->load->view('footer');
	}
	
	function entityTypelist($ent="",$page_num=1)
	{
	//$this->output->enable_profiler(TRUE);

	//echo(parse_url("http://foo?bar#fizzbuzz",PHP_URL_FRAGMENT));
	$page_num=($this->uri->segment(5)!="") ? $this->uri->segment(5) : '1';
	$sortment = ($this->uri->segment(4)!="") ? $this->uri->segment(4) : "A";
		$data_head = array('page_title' => 'Search results');

		$Type = isset($_GET['TypeID']) ? $_GET['TypeID'] : $ent ;
		//$Type_ = str_replace('D','',$Type);	
		//echo $this->uri->segment(5);exit;
		$results_per_page=25;
		
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = base_url() . index_page().'/homes/entityTypelist/'.$Type.'/'.$sortment ;
		$config['total_rows'] = $this->home->get_entry_count_b('EntityTypeID',$Type,'Name' ,$sortment);
		$config['per_page'] = $results_per_page; 
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<div>';
		$config['first_tag_close'] = '</div>';
		/*
		$config['next_link'] = '';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		*/
		$config['cur_tag_open'] = '<li><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['num_links'] = 20; 
       		$config['uri_segment'] = 5;
		$this->pagination->initialize($config); 
		$pages = $this->pagination->create_links();
		//echo $config['total_rows']; exit;
		
		$content = $this->home->get_entry_cont3('EntityTypeID',$Type,$page_num, $results_per_page, $sortment);

		$list = '';
		if (is_array($content)){
			for($i=0;$i< count($content);$i++)
			{
				$list .= "<div class='post'><a href=" .site_url('/homes/tree/'.$content[$i]['ID']). ">". $content[$i]['Name'] . "</a></div>"; 
			}		
		}
		$this->load->view('header',$data_head);
		$this->load->view('home', array('entities' => '','list' =>$list,'term'=>$Type,'sortment'=>$sortment,'error' => 'List of names found','func' => 'entityTypelist', 'pages' => $pages));

		$this->load->view('footer');
	}
	
	function entityDoclist($ent="",$page_num=1)
	{
	//echo $ent;
	//$this->output->enable_profiler(TRUE);
 	$page_num=($this->uri->segment(5)!="") ? $this->uri->segment(5) : '1';
	$sortment = ($this->uri->segment(4)!="") ? $this->uri->segment(4) : "A";
		$data_head = array('page_title' => 'Search results');

		$DocType = isset($_GET['docID']) ? $_GET['docID'] : $ent ;
		//echo $DocType;
		//$DocType_ = str_replace('D','',$DocType);		
		//echo $context;exit;

		$results_per_page=25;
		
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = base_url() . index_page().'/homes/entityDoclist/'.$DocType.'/'.$sortment ;
		$config['total_rows'] = $this->home->get_entry_count_b('DocTypeID',$DocType.',','Name' ,$sortment);
		$config['per_page'] = $results_per_page; 
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<div>';
		$config['first_tag_close'] = '</div>';
		/*
		$config['next_link'] = '';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		*/
		$config['cur_tag_open'] = '<li><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['num_links'] = 20; 
       		$config['uri_segment'] = 5;
		$this->pagination->initialize($config); 
		$pages = $this->pagination->create_links();
		//echo $config['total_rows']; exit;
		$content = $this->home->get_entry_cont2('DocTypeID',$DocType,$page_num, $results_per_page, $sortment);
	

	//	var_dump($content[0]);
		$list = '';
		if (is_array($content)){
			for($i=0;$i< count($content);$i++)
			{

				$list .= "<div class='post'><a href=" .site_url('/homes/tree/'.$content[$i]['ID']). ">". $content[$i]['Name'] . "</a></div>"; 
			}		
		}
		$this->load->view('header',$data_head);
		$this->load->view('home', array('entities' => '','list' =>$list,'term'=>$DocType,'sortment'=>$sortment,'error' => 'List of names found','func' => 'entityDoclist', 'pages' => $pages));

		$this->load->view('footer');
	}
	
	function entitylist($ent="",$page_num=1)
	{
	$page_num=($this->uri->segment(4)!="") ? $this->uri->segment(4) : '1';
	$ent = ($this->uri->segment(3)!="") ? $this->uri->segment(3) : "~";
	$sortment = ($this->uri->segment(5)!="") ? $this->uri->segment(5) : "";
	$countryid = 1;
//echo $ent;// exit;
	//$this->output->enable_profiler(TRUE);
		$data_head = array('page_title' => 'Search results');
		$EntityName = isset($_POST['search_name']) && ($_POST['search_name']!="") ? $_POST['search_name'] : $ent ;		
		//echo $EntityName;
		//
	//	echo $page_num;
		$results_per_page=27;
		
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = base_url() . index_page().'/homes/entitylist/'. $EntityName .'/' ;
		
		$EntityName = str_replace('~','',$EntityName);
		
		$config['total_rows'] = $this->home->get_entry_count('Name',$EntityName);
		$config['per_page'] = $results_per_page; 
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_link'] = 'FIRST';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link'] = 'LAST';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['prev_link'] = 'PREV';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$config['next_link'] = 'NEXT';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li><a href="#"><b>';
		$config['cur_tag_close'] = '</b></a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['num_links'] = 5; 
       	$config['uri_segment'] = 4;
       	
		$this->pagination->initialize($config); 
		$pages = $this->pagination->create_links();
		
		$content = $this->home->get_entry_cont('Name', $EntityName, $countryid, $page_num, $results_per_page, $sortment);
//echo $this->uri->segment(4); exit;
		
		$list = '';
		if (is_array($content)){
			/*if ((count($content))<15){
				for($i=0;$i<count($content);$i++){ 
				if ($k==3){$k=0;}
					$list .= "<div class='post search-card'><a href=" .site_url('/homes/tree/'.$content[$i]['ID']). ">". $content[$i]['Name'] . "</a></div>";
					$k++; 
				}
					 
			} else { */
			$k=0;
				for($i=0;$i < count($content);$i++)	{	
				if ($k==3){$k=0;}
				$countryid = explode(',', $content[$i]['CountryID']);
				//echo $countryid; exit;
				$countries = $this->home->get_country($countryid);
				//var_dump($countries);exit;
					$list .= "<div class='post col-md-4 col-lg-4'>
								<div class='search-card'><a href=" . site_url('/homes/tree/'.$content[$i]['ID']). ">". $content[$i]['Name'] . "</a>";
								
						foreach($countries as $country){		
						$list .= "<img src='". base_url() . "assets/img/". $country['CountryFlag'] . "'/>";
								}
					$list .= "		</div>
							  </div>";
					$k++; 
				}
				if ($k!=3) {
				$list .= "<div class='col-md-". (3-$k)*4 ." col-lg-". (3-$k)*4 ."' style='min-height: 30px'>&nbsp;</div>";
				}
			//}
					
		}
		$this->load->view('header',$data_head);

		$this->load->view('home', array('entities' => '','list' =>$list,'term' => $EntityName,'sortment'=>$sortment, 'error' => 'List of names found','func' => 'entitylist', 'pages' => $pages));

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
		 //echo sizeof($noMerge); exit;
		
		if(sizeof($noMerge)>=1){
			$v0 = ($noMerge[0]['Merged']==1)? $noMerge[0]['MergedTo'] : $v0;
		
			$this->home->mostvisited($v0);
		
			$weed = array();
			$fruit = array();
			$tree_n = array();
			$tree_e = array();
			$tree_d = array();
			$nFilter = "";
			$node_arr = "";
			$tree_ee = "";
			$tree_nn = "";
			$core_node="";
			$alpha = 1;
			$nodes = "{";
			$edges = "{";
		
		
			$dta = $this->home->get_entries('ID',$v0);
			$docs = explode(',', $dta[0]['DocID']);
			$docs = $this->clean_array($docs);
			$docexist = $this->home->get_doc($docs);
			//var_dump($docexist); exit;
			$e=0;
				foreach($docexist as $doc){
					//$doc = $this->home->get_doc($d);
					//var_dump($doc); exit;
				//	foreach($doc as $row){
					$dt = $doc['data_table'];
					$q = $doc['representation'];
						//$tree_data = ($dt == "") ? $this->tree_init($v0,$weed) : $this->dataset_extract($dt,$v0);
					//	echo $dt; //exit;
					  $tree_data = $this->dataset_extract($dt,$v0);
					 // var_dump($tree_data); exit;
						//array_push($tree_d,$tree_data);
						if(!empty($tree_data)){
								$tree_n[] = $tree_data['nodes'];
						
						//	} 
								if ($e==0){
									$tree_e[] = $tree_data['edges'];
									$pos = strpos($tree_data['edges'],"{");
									$phrase = substr($tree_data['edges'], 0, $pos+1);
									//echo $phrase;
									$core_node = '\''. str_replace(' ','_',str_replace('/','',$tree_data['nodeTitle'])) . '_' .$v0 . '\'';
									$nodetitle = $tree_data['nodeTitle'];
								} else {
							
								$tree_e[] = str_replace($phrase,",",$tree_data['edges']);
								}
							$e++;
							
							
						}
					//$tree_n = array_merge_recursive($tree_n);
					//$tree_e=array_merge_recursive($tree_e);
					 
				}
				
				if (!empty($tree_e)){
						//var_dump($tree_e); exit;
					//$pos = strpos($tree_e[0],"{");
						//$phrase = substr($tree_e[0], 0, $pos+1);
						//echo $phrase; exit;
			
					//$tree_n = $this->flatten($tree_n);
		
						foreach ($tree_n as $value)	{
							if (!$tree_n)
							{
							$tree_nn = $value;
							}
							else
							{
							$tree_nn .=  $value;
							//echo $value;
							}
						}
			
						foreach ($tree_e as $value)	{
							if (!$tree_e)
							{
							$tree_ee = $value;
							}
							else
							{
							$tree_ee .=  $value;
							//echo $value;
							}
						}
						//
		
					///$core_node = '\''. str_replace(' ','_',str_replace('/','',$tree_data['nodeTitle'])) . '_' .$v0 . '\'';
					//echo $core_node; exit;
					$tree_ee =  str_replace('},'.$core_node.':{','',$tree_ee);
					$tree_ee =  str_replace('},,', '', $tree_ee);
					$tree_ee =  str_replace(',},', '}', $tree_ee);
					//echo $core_node;
					//echo($tree_ee);
					//exit;
			//echo $tree_ee; exit;
		
					//var_dump($tree_data); exit;
		
			
					$node_arr .= $tree_nn;//$tree_data['nodes'];
		
					$edges .= $tree_ee;//$tree_data['edges'];
					//echo $edges;
					$cid[22]= array('col'=>'#808f5a', 'shape'=>'rectangle', 'img'=>'people.png','selectedimg'=>'people-dark.png');
					$cid[21]= array('col'=>'#ff5000', 'shape'=>'dot', 'img'=> 'organisations.png', 'selectedimg'=> 'organisations-dark.png');
					$node_arr= $this->clean_array(explode(',',$node_arr)); 
				//var_dump($node_arr); exit;
					for($k=0; $k<count($node_arr); $k++){
						$nDetail = explode('|',$node_arr[$k]);
						//var_dump($nDetail); exit;
						$id = $nDetail[0];
						$dataset = $nDetail[1];
						$alpha = $nDetail[2];
						$filter = $nDetail[3];
						$shape = ($alpha == 1 ) ? 'dot' : 'rectangle';

						//echo $dataset;
						$n = $this->home->get_entries('ID',$id);
						//$nID[$id] = $id;
						//var_dump($n); exit;
						if ( !isset($nDate[$id]) ) {
						  $nDate[$id] = array();
						}

						$nDate[$id][] = (isset($nd[$dataset]))? $nd[$dataset] : '' ;
			
						$NodeName = explode(':',$n[0]['Name']);			
						$nFilter .= ($shape == 'dot' ) ?  str_replace(",","",str_replace(".","", str_replace(" ","_", str_replace("  ","",str_replace("/","_",$NodeName[0]))))) . "_".$id ."," : null;
						//echo($nFilter);
						$ne=((int)$n[0]['EntityTypeID']==0) ? '22': (int)$n[0]['EntityTypeID'];
						//echo $col[$cid] . ' - '. $nd['ID'] .'  ';
			
						if(!isset($nID[$id])){
							$nID[$id] = array();
							$node[$id] = array();
							$nodeid[]=$id;
							//str_replace(",","",str_replace(".","",str_replace(" ","_",$NodeName[0])))
							$node_name = preg_replace('/[^a-z\d ]/i', '', $NodeName[0]);
							$node_name = str_replace(' ','_',$node_name);
							if($id == $v0){
							//$col='#FF0000';
							$node[$id][] = "'". $node_name . "_".$id ."':{'color':'#FF0000','shape':'".$shape ."', 'radius':30, 'alpha': ".$alpha.",'nodeid':'".$id."','image':'".$cid[$ne]['selectedimg']."','image_h':30,'link':'', 'label': '". $NodeName[0] ."'}";
							 } else {
							$node[$id][] = "'". $node_name . "_". $id  ."':{'color':'". $cid[$ne]['col'] ."','shape':'". $shape ."', 'radius':30, 'alpha': ".$alpha.", 'nodeid':'".$id."','image':'".$cid[$ne]['img']."','image_h':30,'link':'','image_w':30, 'label': '". $NodeName[0] ."'}";
							 }
							// var_dump($node[$id]);				
				
						}
			
					}	
					//var_dump($nodeid);	
		
		
					for($k=0; $k<count($nodeid); $k++){
					$nid = $nodeid[$k];
					//var_dump($nDate[$nid]);
					$Ed="";
					$nd=explode(',',$nDate[$nid][0]);
					//var_dump($nd);
						//for($j=0; $j<count($nd); $j++){ $Ed.= ' ['. $nd[$j] . ']'; }
					 $nodes .= str_replace("'}", $Ed ."'}", $node[$nid][0]) . ',';
					}
		

					$nodes .= "}";
					$edges .= "}";
					$nFilter.= "}";
					$nodes = str_replace(",}","}",$nodes);
					$edges = str_replace(",}","}",$edges);
					$nFilter = str_replace(",}","",$nFilter);
					//echo $nodes .'<br>'; 
					//echo $edges;
					//exit;
					//$timeline = $this->timeline_data($v0);
		
					$vis_filter = $this->filter_data($node_arr);
				//'events' => $timeline['events'], 'sections' => $timeline['sections'],
					$content = array('edges' => $edges,'nodes' => $nodes,'error' => 'Entity Map', 'root' => $v0, 'node_title' => $nodetitle, 'filter_form'=> $vis_filter, 'hidden_nodes'=> $nFilter, 'nodeid'=> $v0);
	
				$data_head = array('page_title' => 'Visualisation');
	
				$this->load->view('header',$data_head);
				$this->load->view('home',$content);
				$this->load->view('footer');
				} else {
					$this->home->disable_entity($v0);
					$this->index();
					//echo "no data";
				}
	 //-----end of size of v0 ---------	
		} 	else  {
			$this->index();
		}
	}
	
	function tree_init($v0,$weed){
	
	$edges = "";
		$one = $this->tree_schema($v0, $weed,"1","1");
		
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
				$two = $this->tree_schema($one['fruit'][$i],$weed,"1","1");
				array_push($weed, $one['fruit'][$i]);
				//var_dump($two); exit;
				$edges .= $two['edges'];
				$node_arr .= $two['nodearray'];
				if (sizeof($two['fruit'])>0) {
				  //echo 'tuko '. var_dump($weed) .'second array';exit;
					for($j=0; $j< (sizeof($two['fruit'])); $j++){
					
						$three = $this->tree_schema($two['fruit'][$j], $weed,"0","1");
						//array_push($weed, $two['fruit'][$i]);
						$edges .= $three['edges'];
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
	
	
	function tree_schema($v, $weed,$alpha, $filter){
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
		$tree = $this->tree_build($valz,$v,$alpha,$filter);
		$node_array = $tree['node_arr'];
		$edges = $tree['edges'];
		$fruit = $tree['fruit'];
		//var_dump($tree); exit;
		//$fruit = $this->compress_array($fruit);
		//$fruit = $this->clean_array($fruit);
		
		$level= array();
		$level['nodetitle']=$nodetitle;
		$level['nodearray']= $node_array;
		$level['filter']=$filter;
		$level['alpha']=$alpha;
		$level['edges']=$edges;
		$level['fruit']=$fruit;
		$level['weed']=$weed;
		return $level;
	}
	
	
	function tree_build($branch,$stem,$alpha, $filter){
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
		$node_array = $stem . '|0|' . $alpha.'|0,';
		if ( !isset($stm) ) {
		$stm[] = $stem;
		//$edge_name = str_replace(".","",str_replace(" ","_",$root_Name[0]));
		$edge_name = preg_replace('/[^a-z\d ]/i', '', $root_Name[0]);
		$edge_name = str_replace(' ','_',str_replace('/','_',str_replace('\r','',$edge_name)));
 		$edges .= "'" . $edge_name ."_". $stm[0] . "':{";
		}
		//	echo sizeof($branch). ',';
		for($k=0;$k<count($branch); $k++){
			$child = empty($branch[$k]['ID'])? NULL : $this->home->get_entries('ID',$branch[$k]['ID']);
			
			//var_dump($branch[$k]['ID']);
	 		if(sizeof($child)>0){
	 			
		 	   for($i=0; $i < sizeof($child); $i++){
		 		$child_Name = explode(':',$child[$i]['Name']);
		 		//str_replace(".","",str_replace(" ","_",$child_Name[0]))
		 		$edge_name = preg_replace('/[^a-z\d ]/i', '', $child_Name[0]);
				$edge_name = str_replace(' ','_',$edge_name);
				$edges .= "'". $edge_name ."_". $child[$i]['ID']."':{},";
				$node_array .= ($child[$i]['ID']>1) ? $child[$i]['ID'] .'|'. $branch[$k]['dataset'] .'|' . $alpha . '|1,' :'' ;
				
				$fruit[] = $child[$i]['ID'];
			    }
			}
			if($k==20) break;
		}		
		
		if ( isset($stm) ) {
		$edges .= "},";
		unset($stm);			
		}
		$node_array = substr($node_array,0,-1);
		if (sizeof(explode(',',$node_array))<2) {
		
		echo "Sorry for the inconvinience. The entity in question seems to have a disconnect. 
			An Emaill has been disptched to the adminstrator. Please check later.";
				
				$emailTo = 'bugs@openinstitute.com'; // Put your own email address here
				$subject = 'Open Duka Entity Error';
				$headers = 'From: bugs@openinstitute.com' ;
				$headers .='Reply-To: bugs@openinstitute.com';
				$body = 'Entity ID: '.$stem .' has issues. Please check';
		
				mail($emailTo, $subject, $body, $headers);
				sleep(5);
		redirect('/');
		}
		//var_dump(explode(',',$node_array)); 
		$tree['filter'] = $filter;
		$tree['node_arr'] = $node_array;
		$tree['edges'] = $edges;
		$tree['fruit'] = $fruit;
		//var_dump($tree['fruit']);
		return $tree;

	}
	
	
	function dataset_extract($dt,$v0){
	
	//echo $v0 . ' - ' . $dt; exit;
	//$this->output->enable_profiler(TRUE);

	 $flds= array();
	 $ids = array();
	 $valz = array();
	 $tr = array();
		$dta = $this->home->get_dataset_map($dt,$v0);
		
		if (!empty($dta)){
	//var_dump($dta); exit;
			foreach($dta as $k => $d){
		
				foreach($d as $j => $f){ $flds[]= $j; }
			
				break;
			}
		
			foreach($flds as $f){
			 
				for($i=0; $i<sizeof($dta); $i++){
				$e = explode(',', $dta[$i][$f]);
					for($j=0; $j<sizeof($e); $j++){
					$ids[] = $e[$j];
					}
					//var_dump($dta);
					//$ids[] = $dta[$i][$f];
				
					//array_push($weed,$v0);
				} 
			}
		
			$ids = $this->clean_array($ids);
			//var_dump($ids); exit;
			foreach ($ids as $i){
				if($i != $v0){
			 	$valz[] = array('ID'=>$i,'dataset'=>'0');
			 	}
			}
		
			$one = $this->tree_build($valz,$v0,1,0);
			//var_dump($one); exit;
			$nt = $this->home->get_entries('ID',$v0);
			$nodetitle = $nt[0]['Name'];
			$tr = array('nodes'=>$one['node_arr'], 'edges'=>$one['edges'], 'nodeTitle' => $nodetitle, 'alpha'=>1, 'filter'=>$one['filter']);
			//var_dump($tr); exit;
		}
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
		$doc = array();
		$Entity_id = array();
		//$cont="";
//echo $n;
		//$cont = "<h3><a href=" . site_url('/homes/tree/'.$root_node[0]['ID']). ">". $root_node[0]['Name'] ."</a>&nbsp;&nbsp;<span id='connections' class='badge pull-right'>1</span></h3>";
		$v=array();
		$child_node = $this->home->get_node($n);
		//var_dump($child_node); exit;
		//for($j=0; $j<sizeof($child_node); $j++){
			$docmap = explode(',',$child_node[0]['DocID']);
		//	$arraymap = explode(',',$child_node[0]['EntityMap']);
			
			foreach($docmap as $k => $d){
		//		echo $d; exit;
			  if(!in_array($d, $doc)){ 
			  $doc[] = ($d != "") ? $d : null ;
			 
			  }
			}
		//}
		//var_dump($doc); exit;
		//var_dump($doc); echo sizeof($doc); exit;
		$extraData="";
		$extraNav="";
		$maps= '{"data":[{"posts":[';
		//var_dump($root_node);

		if(sizeof($doc)>0){
			$extraNav .= '<div id="static"><ol class="breadcrumb pnav ">';
			for($j=0; $j<sizeof($doc); $j++){

				$doc_ref = $doc[$j];
				if ($doc_ref!= null){

				$dataset = $this->home->get_doc($doc_ref);

				$getCat="";
				$cat="";

				

				foreach($dataset as $val){				
					$dID=$val['DocTypeID'];
					$dcat= $this->home->get_docType($dID);
					$cat.=$dcat[0]['DocTypeName'].',';	
			    }			    

			    $getCat = explode(",", $cat);
			    

				foreach ($getCat as $value) {
					if ($value!="") {
						$c=str_replace(' ', '',$value);
						$extraNav .= '<li><a href ="#'.$c.'" class="scroll">'.$value.'</a></li>';
					}
					
				}			    
			}
			
			}
			$extraNav .='</ol></div>';

			for($i=0; $i<sizeof($doc); $i++){
			$id = $n;
			//$c_node = $this->home->get_entries('ID',$id);
			//var_dump($c_node); exit;
			$doc_ref = $doc[$i];
			//$doc_ids = explode(',',$c_node[0]['DocID']);
			$d=0;
				
			if ($doc_ref!= null){

				$dataset = $this->home->get_doc($doc_ref);
				
				foreach($dataset as $row){
				$dt=$row['data_table'];
				//echo $dt;
				$dtID=$row['DocTypeID'];
				$dataCat = $this->home->get_docType($dtID);


				//var_dump($dataCat);
				//echo $n;
				   if($dt!=""){
						$d=1; 
						$ds=$row['representation'];
						$q = ($ds=="")? '*' : $ds;
						//echo $dt;
						$dta = $this->home->get_dataset($dt,$q,$n);
						//var_dump($dta); exit;
						//$k = (sizeof($dta[0])>11) ? 1 : (int)(12/sizeof($dta[0])) ;
						//$i=1;
						//echo sizeof($dta); exit;

						if (sizeof($dta)!= 0){
						//$extraData .= '<br id="'.$dataCat[0]['DocTypeName'].'" class="listed">';
						$dtype=	str_replace(' ', '',$dataCat[0]['DocTypeName']);
						$extraData .= '<div id="'.$dtype.'" class="category"><a><span class="label" style="background-color: '.$dataCat[0]['IconColor'].';">'.$dataCat[0]['DocTypeName'].'</span></a></div>';
						$extraData .= '<table class="table table-hover table-condensed relationships">';
						$extraData .= '<thead>';	
							foreach($dta[0] as  $key => $val){
								if (substr($key,-3,3)=='_E_') {
								
						   	  		$Entity_id[]= $key;
						   	  		
						  		} else {
						  		
									$extraData .= '<th>'. str_replace("_"," ", $key) .'</th>';
									
								}
							}
						$extraData .= '</thead>';
						//echo($extraData); exit;
						for($j=0; $j<sizeof($dta); $j++){
						//$i=1;
						//$extraData .= '<br>';
						$extraData .= '<tr>';
						
							foreach($dta[$j] as  $key => $val){
								$fieldname = $key .'_E_';
								if (substr($key,-3,3)=='_E_') {
								//$kd=$key;
							//	 $extraData .= '<td><a href="'. $dta[$j][$key].'">'. $val .'</a></td>' ;
								}
								else
								{
									//if ($this->home->fieldcheck($fieldname,$dt)){
									//$extraData .= '<td><a href="'. $dta[$j][$key].'">'. str_replace("\r","", $val)  .'</a></td>' ;
					  				//} else {
								 	$extraData .= '<td>'. str_replace("\r","", $val) .'</td>' ;
								 	//}
								}
							//if($i==12){break;}
							//++$i;
							}
						$extraData .= '</tr>';	
						}
						$extraData .= '</table>';	
						//echo $extraData;
					}
				}
			}
			//$maps .= ' {"ID":"'. $c_node[0]['ID'] .'", "ExtraData":"'. htmlspecialchars($extraData) .'"},';	
						
			}
			} 
			$maps .= ' { "ExtraData":"'. htmlspecialchars(str_replace( "\n", "<br/>",str_replace( "\t", "",$extraData))) .'"},';	
			$maps .= ' { "ExtraNav":"'. htmlspecialchars(str_replace( "\n", "<br/>",str_replace( "\t", "",$extraNav))) .'"}';
			
		} 
		//else {
		//$maps .= ' {"ID":"", "Name":"", "EntMap":"", "EntPos":"", "Verb":"", "EffectiveDate":""},';
		//}
		$maps .= ']}';
		$d=1;
		$root_node = $this->home->get_entries('ID',$n);
		
		$maps .=', {"header":[{"ID":"'. $root_node[0]['ID'] .'", "Name":"'. $root_node[0]['Name'] . '", "EntMap":"'. $root_node[0]['EntityMap'] . '", "Link":"' . site_url('/homes/tree/'.$n) . '", "E_D":"'. $d .'"}]}';
		
		
		$maps .=']}';
		$maps = str_replace(",]","]",$maps);
		$maps = str_replace(",}","}",$maps);
//echo $maps; exit;
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
	//$this->output->enable_profiler(false); 
		$form_filter = $this->home->get_mapped_entries($var);
		$form_f ="";
		
		for($j=0; $j<count($form_filter);$j++){
		
		$form_f .= "<input style='width: 20px;' type='checkbox' checked name='Filter[]' value='". $form_filter[$j]['EntityTypeID'] ."' class='FilterForm'> ". $form_filter[$j]['EntityType'] ;
		
		}
		
	return $form_f;	
	}
	
	function excelDownload($n) {
	//$this->output->enable_profiler(true); 
		
		$child_node = $this->home->get_node($n);

		$docmap = explode(',',$child_node[0]['DocID']);
		
		$docmap = $this->clean_array($docmap);
		
//var_dump($docmap); exit; 
        // Starting the PHPExcel library
				$this->load->library('PHPExcel');
				$this->load->library('PHPExcel/IOFactory');
		 		 
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
		 		
		 		
		if(sizeof($docmap)>0){
		
			for($i=0; $i<sizeof($docmap); $i++){
			//echo $docmap[$i];exit;			
			// Add new sheet
			$objPHPExcel->createSheet($i); //Setting index when creating
		 	//$objWorkSheet = $objPHPExcel->getActiveSheet();//$objPHPExcel->getSheet($i);
		 	$objPHPExcel->setActiveSheetIndex($i);
			$table_name = $this->home->get_doc($docmap[$i]);
			//var_dump($table_name);
			$tbl = $table_name[0]['data_table'];
			$objPHPExcel->getActiveSheet()->setTitle($tbl);
			//	echo $table_name[0]['representation']; exit;
			$q   = ($table_name[0]['representation'] == "") ? "*" : $table_name[0]['representation'];
			//echo $n;
		 	$query = $this->home->get_dataset($tbl,$q,$n);
		 	//var_dump($query);exit;
		 	// echo sizeof($query); exit;
		 	
			 	//if (sizeof($query)>0) {
			 	for($j=0; $j<sizeof($query); $j++){
				//echo sizeof($qu); exit;	
			
 			 		if ($j==0) {
 			 		$Entity_id =[];
	 				$fields = [];
						foreach($query[0] as  $key => $val){
							if (substr($key,-3,3)=='_E_') {
					   	  		$Entity_id[]= $key;
					  		}
					  		else{
								$fields[] =  $key;//str_replace("_"," ", $key)  ;
							}
						}
					//var_dump($fields); exit;	
						// Field names in the first row
						$col = 0;
						foreach ($fields as $field)
						{
							$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
							$col++;
						}
					
					}
					
					// Fetching the table data
					$row = 2;
					//foreach($query[$j] as $key => $data){
					for($k=0; $k<sizeof($query); $k++){
					 //var_dump($query[$k]); exit;
						$col = 0;
						foreach($query[$k] as $field => $fdata)
						{
						// echo $fdata; exit;
							if (substr($field,-3,3)!='_E_') {
						    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $fdata);
						    }
						    $col++;
						}
						$row++;
					}
					// Create a new worksheet, after the default sheet
					//$objPHPExcel->createSheet($i);
				}
		 	}
		}
		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5'); 
		// Sending headers to force the user to download the file
		$filename='OpenDuka_'. $n .'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
 
		$objWriter->save('php://output');
	
	}
}

/* End of file posts.php */
/* Location: ./application/controllers/posts.php */
