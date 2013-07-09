<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {


       
       function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','pdf2text','tesseract'));
		$this->load->database();
		//$this->load->config();
		//$this->load->library('javascript');
		$this->load->model('project');
		$dcloud_name = 'benjamin@openinstitute.com';
		$dcloud_pass = 'private123456';
	}

	function index($start=0)
	{
		$data_head = array('page_title' => 'Project list!');
		$content =$this->project->get_documents(20,$start);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url() . index_page().'/projects/index';
		$config['total_rows'] = $this->project->get_doc_count();
		$config['per_page'] = 20; 
		$this->pagination->initialize($config); 
		$pages = $this->pagination->create_links();

		$this->load->view('header',$data_head);
		$this->load->view('project', array('content' => $content,'pages'=>$pages,'error' => ''));
		$this->load->view('footer');
		
	}

	function do_retrieve()
	{
			$params = array(
               		'http'=>array(
	               		'username' => '$dcloud_name',
	               		'password' => '$dcloud_pass'
	               		)
			); 
			$context = stream_context_create($params);

			// Open the file using the HTTP headers set above
			$file = $this->processCommand('https://www.documentcloud.org/api/projects.json');
			//echo $file;
			$projects = json_decode($file,true);
			echo count($projects['projects'][0]['document_ids']);
			$content = $this->array_extract($projects['projects'][0]['document_ids']);
		/*	
			$entities = $this->processCommand('https://www.documentcloud.org/api/documents/'.$projects['projects'][0]['document_ids'][0].'/entities.json');
echo $entities;
	$representation = $this->processCommand('https://www.documentcloud.org/api/documents/'.$projects['projects'][0]['document_ids'][0].'.json');
echo $representation;*/
			$content = array('content' => $content, 'error' => $file['error'], 'filename' => '');
			$data_head = array('page_title' => 'Project list!');

			$this->load->view('header',$data_head);
			$this->load->view('project',$content);
			$this->load->view('footer');
			//	$this->load->view('upload_success', $data);
	}
	
	function processCommand($url, $method="GET", $headerType="XML", $src="") {

        $method = strtoupper($method);
        $headerType = strtoupper($headerType);
        $session = curl_init();
        curl_setopt($session, CURLOPT_USERPWD, '$dcloud_name:$dcloud_pass'); 
        curl_setopt($session, CURLOPT_URL, $url);
        if ($method == "GET") {
            curl_setopt($session, CURLOPT_HTTPGET, 1);
        } else {
            curl_setopt($session, CURLOPT_POST, 1);
            curl_setopt($session, CURLOPT_POSTFIELDS, $src);
            curl_setopt($session, CURLOPT_CUSTOMREQUEST, $method);
        }
        curl_setopt($session, CURLOPT_HEADER, false);
        if ($headerType == "XML") {
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Accept: application/xml', 'Content-Type: application/xml'));
        } else {
            curl_setopt($session, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        }
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        if (preg_match("/^(https)/i", $url))
            curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($session);
        curl_close($session);

        return $result;
    }
    
    function get_web_page( $url ) {
	    $res = array();
	    $options = array( 
	        CURLOPT_RETURNTRANSFER => true,     // return web page 
		CURLOPT_USERPWD => '$dcloud_name:$dcloud_pass',
	        CURLOPT_HEADER         => false,    // do not return headers 
	        CURLOPT_FOLLOWLOCATION => true,     // follow redirects 
	        CURLOPT_USERAGENT      => "spider", // who am i 
	        CURLOPT_AUTOREFERER    => true,     // set referer on redirect 
	        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect 
	        CURLOPT_TIMEOUT        => 120,      // timeout on response 
	        CURLOPT_MAXREDIRS      => 30,       // stop after 10 redirects 
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
	    ); 
	    $ch      = curl_init( $url ); 
	    curl_setopt_array( $ch, $options ); 
	    $content = curl_exec( $ch ); 
	    $err     = curl_errno( $ch ); 
	    $errmsg  = curl_error( $ch ); 
	    $header  = curl_getinfo( $ch );
	    curl_close( $ch ); 
	
	    //$res['content'] = $content;     
	    //$res['url'] = $header['url'];
	    //return $res;
		return $content;
	}  
	//print(get_web_page("https://www.documentcloud.org/documents/682452/test-upload-via-curl.txt"));


	function array_extract($arr){
		$str ='';
		$str =0;
		foreach ($arr as $key => $val){
		//---check if document already exists in db to avoid double entry ----
		//echo $this->project->checkDoc('0');
 
		if ($this->project->checkDoc($val)){$cnt += 1;}
		else {
		
			$str.= '<b>'.$key .':</b>';
			if(is_array($val)){
				$str.= $this->array_extract($val);
			}else{
				$str.= $val.'<br/>';
				$entities= $this->processCommand('https://www.documentcloud.org/api/documents/'.$val.'/entities.json');//entities
				$representation=$this->processCommand('https://www.documentcloud.org/api/documents/'.$val.'.json'); //representation
				//echo $representation;
				$result = json_decode($representation,true);
			//	echo $result["document"]["title"]; 

				$data = array(
				'doc_id'=>$result["document"]['id'],
				'title'=>$result["document"]['title'],
				'pages'=>$result["document"]['pages'],
				//'description' => $result['description'],
				//'source' => $result['source'],
				'created_at' => $result["document"]['created_at'],
				'updated_at' => $result["document"]['updated_at'],
				'canonical_url' => $result["document"]['canonical_url'],
				'contributor' => $result["document"]['contributor'],
				'contributor_organization' => $result["document"]['contributor_organization'],
				'pdf' => $result["document"]['resources']['pdf'],
				'text' => $result["document"]['resources']['text'],
				'thumbnail' => $result["document"]['resources']['thumbnail'],
				'search' => $result["document"]['resources']['search'],
				'pagetext' => $result["document"]['resources']['page']['text'],
				'pageimage' => $result["document"]['resources']['page']['image'],
				'DocText' => processCommand($result["document"]['resources']['text']),
				'entities' => $entities,
				'representation' => $representation 
				);
				
				$str.= $this->project->insert_document($data);

	 		}
	 	}
	 	}
	 	return $str;
	 }
	 
	 			///---------------------
	function do_doc_request($id) 
	{ 
		$context =$this->project->get_document_entry($id);
		//echo $context['DocSentence'];exit;
		$content=array();
		$content['ID']  = $context[0]['ID'];
		$content['filename']  = $context[0]['title'];
		$sentensi  = json_decode($context[0]['DocSentence'],true);
		
		$s=0;
		$w=0;
		$s = count($sentensi[$id]);

		//echo $s;
			for ($i = 0; $i < $s; ++$i){
				$wo= $sentensi[$id][$i];
				//echo $wo;
				$w += count($wo);
			}
		//	echo $w;
		$content['sentences'] = $s;
		$content['words'] = $w;
		
		if ($context[0]['DocText']==''){
			//$content['content'] = '<pre style="word-wrap: break-word; white-space: pre-wrap;">'. 	$this->get_web_page($context[0]['text']) .'</pre>';
			//echo $content['filename'].'.pdf'; exit;
			$content['content'] = $this->pdf_text($content['filename']) == "" ? $this->pdf_img($content['filename']) : $this->pdf_text($content['filename']);
			
			$content['error'] = 'text got from documentcloud';
		} else {
			$content['content'] = $context[0]['DocText'];
			$content['error'] = 'Text from local database';
		}
		$content['entities'] = '';
		$data_head = array('page_title'     => 'Entity Extraction');

		$this->load->view('header_entity',$data_head);
		$this->load->view('test',$content);
		$this->load->view('footer');
	}
	
	function pdf_text($inputVal) {
		$file_path = base_url(). 'assets/Gazettes/'.$inputVal.'.pdf';
		//echo $file_path; exit;
		$a = new PDF2Text();
		$a->setFilename($file_path);
		$a->decodePDF();
		$cont = $a->output();
		
		return $cont;
	
	}
	
	function pdf_img($inputVal) {
	//echo $inputVal; exit;
		// $image = $inputVal.'.png';
		$path_ = base_url(). 'assets/Gazettes/';
		//echo $path_;exit;
		exec('convert '. $path_.$inputVal.'.pdf '. $path_.$inputVal.'.png');
		/*$im = new imagick(base_url(). 'assets/Gazettes/'.$inputVal.'.pdf');
		$im->setResolution(300,300);

		$im->setImageFormat('jpeg');    
		$im->writeImage(base_url(). 'assets/Gazettes/'.$inputVal.'.jpg');
		
		$img = new Imagick($uploadfile);
$img->setResolution(300,300);
$img->resampleImage(150,150,imagick::FILTER_UNDEFINED,1);
$img->resizeImage(512,700,Imagick::FILTER_LANCZOS,0);
$img->setImageFormat('jpeg');
$img->setImageUnits(imagick::RESOLUTION_PIXELSPERINCH);
$img->writeImage ( "p-53.jpeg" );
		 */
		 $txt = TesseractOCR::recognize($path_.$inputVal.'.png', range(0,9), range('A','Z'));;
		 echo $txt;exit;
	}
	
	function do_doc_update() 
	{ 
		$data=array();
		$data['ID'] = $_POST['ID'];	
		$data['DocText'] = $_POST['content'];
		$data['DocSentence'] = $this->word_wrap($_POST['content'], $_POST['ID']);
		//echo $data['DocSentence'];
		
		$this->project->update_document($data);
		
		$sentensi  = json_decode($data['DocSentence'],true);
		
		
		//echo $sentensi['sentence']['S0']['W0'];
		$s=0;
		$w=0;
		$s = count($sentensi[$_POST['ID']]);

		//echo $s;
			for ($i = 0; $i < $s; ++$i){
				$wo= $sentensi[$_POST['ID']][$i];
				//echo $wo;
				$w += count($wo);
			}
		//	echo $w;
		//$content['sentensi']= $sentensi;
		
	
		$data_head = array('page_title'  => 'Content Update');
		$content=array();
		$content['sentences'] = $s;
		$content['words'] = $w;
		$content['ID']  = $_POST['ID'];
		$content['filename'] = $_POST['filename'];
		$content['content'] = $_POST['content'];
		$content['error']  = 'Content saved in database';
		$content['entities'] = '';
		//$content['sentensi']= $sentensi;
		
		$this->load->view('header_entity',$data_head);
		$this->load->view('test',$content);
		$this->load->view('footer');
	}
	
	function locate_statement($haystack,$arr){
		//echo $haystack;
		foreach ($arr as $value) {
			//echo $value;
		    if(strstr($haystack,$value, true)) {
		        return  $value;
		    }
		}
	}
	
	function entity_type_key($needle,$haystack){
		for ($i=0; $i < count($haystack); $i++) { 
			foreach($haystack[$i] as $key=>$value) {
		        $current_key=$key;
		        if($needle===$value OR (is_array($value) && entity_type_key($needle,$value) !== false)) {
		            return $haystack[$i]['EntityTypeID'];
		        }
		    }
		}
	    return false;
	}
	
	function str_extract($str, $from, $to,$settoarray=1){
		
		if (preg_match('/'.$from.'/',$str)){
			//echo strstr($str,"to be",true);
			$entity_names = substr(strstr($str,$to,true),strrpos($str,$from)+strlen($from));
			$entity_names = strip_tags($entity_names);
			$entity_names = str_replace(',','',$entity_names);
			if($settoarray){
			$entity_names = explode("\n",$entity_names);
			$entity_names = array_values(array_diff($entity_names, array('')));
			}
			return $entity_names;					
		}		
	}
	
	function do_entity_extract(){
		
		$ID  = $_POST['ID'];
		$data_head = array('page_title' => 'Entity Extraction');
		
		$entitytype =$this->project->get_entityType();
		//echo $entitytype[0]['EntityType'];exit;
		//var_dump(array_values($entitytype));
		//echo count($entitytype);
		//echo $this->entity_type_key('Person', $entitytype);exit;
		
		$context =$this->project->get_document_entry($ID);
		//echo $context[0]['DocSentence'];exit;
		$content=array();
		$content['ID']  = $context[0]['ID'];
		$content['filename']  = $context[0]['title'];
		$content['content'] = $context[0]['DocText'] ;
		$content['words']  = $_POST['words'];
		$content['sentences'] = $_POST['sentences'];
		$content['error'] = 'Extraction happened';
		$content['entities'] = array();
		//echo stripos(substr($content['content'],2057),"GAZETTE")."<br/>";
		if (preg_match("/THE KENYA GAZETTE/i", $content['content'] )) {
		 // "APPOINTMENT SCHEMA";
		    preg_match_all("/\bAPPOINTMENT\b/", $content['content'],  $out,PREG_OFFSET_CAPTURE);
		    //var_dump($out[0]);
		    $appointments = count($out[0]);
			//echo $appointments; exit;
			$data['entity_DocID']=$content['ID'];
			for ($i = 0; $i < $appointments; ++$i){
				$offset= $out[0][$i][1];
				
				$str= substr($content['content'],$offset,stripos(substr($content['content'],$offset),"\n\n")) ;
				//echo ($i+1) . str_replace("\n",'---',$str) . 'length -- '.strlen(trim($str));
				if (count($this->str_extract($str, $this->locate_statement($str,array('APPOINTMENT')), $this->locate_statement($str,array('Dated the'))))>0){
					$str = $this->str_extract($str, $this->locate_statement($str,array('APPOINTMENT')), $this->locate_statement($str,array('GAZETTE')),0);
				//echo $str;
					$data['entity_context'] = addslashes($str);
					$person_search_start=array('appoints--','appoint--','appointed--');
					$person_search_end=array('to be the','to be');
					
					$org_search_start=array('members of the', 'member of the','to be the');
					$org_search_end=array('for a`');
				//echo 
				//exit;
					$data['entity_persons'] =  $this->str_extract($str, $this->locate_statement($str,$person_search_start), $this->locate_statement($str,$person_search_end));
					$data['entity_persons_type'] = $this->entity_type_key('Person', $entitytype);
					
					$data['entity_organisation'] = $this->str_extract($str, $this->locate_statement($str,$org_search_start), $this->locate_statement($str,$org_search_end));
					$data['entity_organisation_type'] = $this->entity_type_key('Organization', $entitytype);
					//var_dump($data['entity_organisation']);exit;
					//echo $data['entity_persons'].'hapa';
					$data['effect_date'] = (is_array($this->str_extract($str, 'effect from', 'Dated the'))) ? implode(" ",$this->str_extract($str, 'effect from', 'Dated the')) : $this->str_extract($str, 'effect from', 'Dated the');
					//echo substr( $str, strrpos( $str, ' ' )+1 );	
					//echo $data['effect_date'] ;exit;
					preg_match('/[^ ]*$/',$str,$matches);
					preg_match('/[^\n]*$/',$matches[0],$matches); 
					//var_dump($matches);
					$data['entity_gazetted'] = $this->str_extract($str, 'Dated the',$matches[0],1);
					//var_dump($data['entity_gazetted']) . $matches[0] ;exit;
					if (!empty($data['entity_gazetted'])){
					$data['gazette_date']=$data['entity_gazetted'][0];
					$data['gazette_appointer']=$data['entity_gazetted'][1];
					$data['gazette_office']= isset($data['entity_gazetted'][2]) ? $data['entity_gazetted'][1]: $matches[0] ;//(array_key_exists('2',$data['entity_gazetted']))?$data['entity_gazetted'][2]:NULL;
					}
					//var_dump($data);exit;
					$content['entities'] = array_merge_recursive($content['entities'],$data['entity_persons']);
					$this->project->insert_entity($data);
				}
			}

		   // preg_match_all("/\bAPPOINTMENT\b/", $content['content'],  $out,PREG_OFFSET_CAPTURE);

		    // exit;
		}
		
		//var_dump($content['entities']);
		$this->load->view('header_entity',$data_head);
		$this->load->view('test',$content);
		$this->load->view('footer');
	
	}
	
	
	function do_doc_extract()
	{
		$data_head = array('page_title' => 'Project list!');
		$ID  = $_POST['ID'];
				
		$context =$this->project->get_document_entry($ID);
		//echo $context[0]['DocSentence'];exit;
		$content=array();
		$content['ID']  = $context[0]['ID'];
		$content['filename']  = $context[0]['title'];
		$content['content'] = $context[0]['DocText'] ;
		$content['error'] = 'text got from database';
		//$arr = $context[0]['DocSentence'];
		$sentensi  = json_decode($context[0]['DocSentence'],true);
		//var_dump($sentensi);exit;
		//var_dump($sentensi[$ID][23]); exit;
		$s=0;
		$w=0;
		$s = count($sentensi[$ID]);

		//echo $s;
			for ($i = 0; $i < $s; ++$i){
				$wo= $sentensi[$ID][$i];
				//echo $wo;
				$w += count($wo);
			}
		//	echo $w;
		$content['sentences'] = $s;
		$content['words'] = $w;
		
		
		
		$entities =$this->project->get_entities();
		var_dump($entities) .'<br/>';exit;
		//echo $entities[0]['Name'];exit;
		//echo $sentensi; exit;
		$entity = '<b>Entities found</b><br/>';
		for ($i = 0; $i < count($entities); ++$i) {
			$match=$this->array_search_recursive(strtolower($entities[$i]['Name']),$sentensi);
			var_dump($match) .'<br/>';
			if (count($match)>0){
				$data['EntityAppears'] = $match;
				$data['ID']  = $entities[$i]['ID'];
				//echo $data['DocSentence'];
				$entity .= $entities[$i]['Name'] . ' was found <br/>';
				$this->project->update_entity($data);
			}
			//print_r(json_encode($match));
		}
		$content['entities'] = $entity;
		
		$this->load->view('header',$data_head);
		$this->load->view('test', $content);
		$this->load->view('footer');
	}
	
	function word_wrap($data,$DocID)
	{
		$data_ripped = $this->rip_tags($data);
		$re = '/# Split sentences on whitespace between them.
		(?<=                # Begin positive lookbehind.
		  [.!?]             # Either an end of sentence punct,
		| [.!?][\'"]        # or end of sentence punct and quote.
		)                   # End positive lookbehind.
		(?<!                # Begin negative lookbehind.
		  Mr\.              # Skip either "Mr."
		| Mrs\.             # or "Mrs.",
		| Ms\.              # or "Ms.",
		| Jr\.              # or "Jr.",
		| Dr\.              # or "Dr.",
		| Prof\.            # or "Prof.",
		| Sr\.              # or "Sr.",
		| Cap\.		 # or "Cap. 220",
		| NO\.			 # or "Gazette NO. xxx",
		| Sh\.			 # of "Kenya currency",
		| Vol\.		 # of "Volume number",
		| \s[A-Z]\.         # or initials ex: "George W. Bush",
		                    # or... (you get the idea).
		)                   # End negative lookbehind.
		\s+                 # Split on whitespace between sentences.
		/ix';
		
		$d = '{"'.$DocID.'":{';
		$sentences = preg_split($re, $data_ripped, -1, PREG_SPLIT_NO_EMPTY);	
		
			for ($i = 0; $i < count($sentences); ++$i) {
			$fields_string='';
				//echo "Sentence[$i] = ".$sentences[$i]."\n";
				$d .= "\"$i\" : {";
				$k = preg_split('/ /',trim(preg_replace('/[^a-z0-9\']+/i', ' ', $sentences[$i])), -1, PREG_SPLIT_NO_EMPTY);
				foreach($k as $key=>$value) { $fields_string .= '"'.$key.'":"'.$value.'",'; } 
				$fields_string = rtrim($fields_string, ',');
				$d .= $fields_string. "},";
				
			}
			$d =substr($d, 0,-1) . "}}";
		return $d;
	}
		
	function rip_tags($string) 
	{ 
    
	    // ----- remove HTML TAGs ----- 
	    $string = preg_replace ('/<[^>]*>/', ' ', $string); 
	    
	    // ----- remove control characters ----- 
	    $string = str_replace("\r", '', $string);    // --- replace with empty space
	    $string = str_replace("\n", ' ', $string);   // --- replace with space
	    $string = str_replace("\t", ' ', $string);   // --- replace with space
	    
	    // ----- remove multiple spaces ----- 
	    $string = trim(preg_replace('/ {2,}/', ' ', $string));
	    
	    return $string; 

	}

	function array_search_recursive($db_array, $haystack){
	    $path=array();
	    foreach($haystack as $id => $val)
	    {
	 
	         if(array_map('strtolower',$val) === in_array($db_array))
	              $path[]=$id;
	         else if(is_array($val)){
	             $found=$this->array_search_recursive($db_array, $val);
	              if(count($found)>0){
	                  $path[$id]=$found;
	              }       
	          }
	      }
	      return $path;
	}
	
	function array_search_recursive1($needle, $haystack){
	    $path=array();
	    foreach($haystack as $id => $val)
	    {
	 
	         if(array_map('strtolower',$val) === $needle)
	              $path[]=$id;
	         else if(is_array($val)){
	             $found=$this->array_search_recursive($needle, $val);
	              if(count($found)>0){
	                  $path[$id]=$found;
	              }       
	          }
	      }
	      return $path;
	}
	
	
	function entity()
	{
		
		$context = $_POST['content'];	
		$File_Name = $_POST['filename'];		
		//echo $context;exit;
		$doc_data = array('DocName' => $File_Name,'DocText' => $context );
		$DocID = $this->post->insert_document($doc_data);
		
		
		$apikey = "sp3u4wvyqbpx34zauxqp7qr2";
		$oc = new OpenCalais($apikey);
		
		$entities = $oc->getEntities($context);
		$entity_info = "";
		$entity_type_db = "";
		$entity_val_db = "";
		//$tree .= $File_Name;

		foreach ($entities as $type => $values) {
			
			$entity_type_db .= $type .",";

			foreach ($values as $entity) {
				$this->post->insert_entity($type,$entity,$DocID);
			}
			
		}

		$entity_data = array('DocType' => $entity_type_db, 'DocID' => $DocID);
		$this->project->update_document($entity_data);
		
		$entity_type_db = "";
		
		redirect('<?php echo base_url() . index_page();?>/trees/index/'.$DocID);
		/*
		$content=array('entities' => $entity_info,'filename' => $File_Name,'tree' => $tree,'error' => '');
		$data_head = array('page_title'     => 'Entity Extraction');


		$this->load->view('header_entity',$data_head);
		$this->load->view('entity',$content);
		$this->load->view('footer');
		*/
	}
	
	
	function do_tesseract($filedata)
	{
		//
		//================================================
		//Extraction part
		//================================================
		//
	//-----------------------------IMG LOAD-----------------------------------------------------------  


		$fileName=$filedata['file_name'];
		//echo $filedata['file_type']; exit;

		if ((($filedata['file_type'] == "image/jpeg")
		|| ($filedata['file_type'] == "image/gif")
		|| ($filedata['file_type'] == "image/png"))
		&& ($filedata['file_size'] < 10000000))
		{
		//include 'tesseract.php';
		$OutPutLocation = realpath(dirname($_SERVER['DOCUMENT_ROOT'])) . '/projects/tesseract/uploads/';
		$image_path=$OutPutLocation . $fileName;	
	//	echo $image_path; exit;
			$api= new TessBaseAPI;
			$api->Init(".","eng",$mode_or_oem=OEM_DEFAULT);
			$api->SetPageSegMode(PSM_AUTO);
			
			//$mImgFile = "eurotext.jpg";
			$handle=fopen($image_path,"rb");
			//echo filesize($image_path) .'>'.$filedata['file_size'];exit;
			$mBuffer=fread($handle,filesize($image_path));
			//print strlen($mBuffer);exit;
			$content=ProcessPagesBuffer($mBuffer,strlen($mBuffer)*4,$api);
			//print "result(ProcessPagesBuffer)=";
			//print $content; exit;
			//echo strlen($content);exit;
			if(strlen($content)<=25){$context=array('content'=>'','error'=>'Sorry! Text could not be extracted from image');}
			else{$context=array('content'=>$content,'error'=>'');}
			
			return $context;
			//$result = ProcessPagesFileStream($mImgFile,$api);
			//print "result(ProcessPagesFileStream)=";
			//print $result;
	  	}
	
	}
	
			
}

/* End of file posts.php */
/* Location: ./application/controllers/posts.php */
