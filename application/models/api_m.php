<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api_m extends CI_Model {
	public function confirm($code, $email, $app){
		$result = $this->db->query("select * from api_users where au_email='$email' and au_url='$app'");
		if($result->num_rows()<1){
			return "An API key request for this app has not been made!";
		}else{
			$result = $result->result_array();
			$result = $result['0'];
				if($result['au_confirmed']!='0'){
					return "The confirmation token has already been used. Please check your email for you API key";
				}else{
					$key = md5($email.$app);
					$this->load->library('encrypt');
					if($key!=$this->encrypt->decode($code)){
						return "Wrong confirmation code! Please check your confirmation message for the correct confirmation url.";
					}else{
						$api_key = $result['au_email'].$result['au_url'].str_replace(' ', '', $result['au_joined']);
						
						$api_key = hash($this->encrypt->encode($api_key));
						//now we have a key
						$this->db->query("update api_users set au_key='$api_key', au_confirmed='1' where au_email='$email' and au_url='$app'");
						mail($email, 'OpenDuka API key', 'Your API key is :'.$api_key);
						//print $api_key;
						return "API key sent to your email address!";
					}
				}
		}
	}
	public function request_key($post){
		if(isset($post['email'])){	
			if(($post['email']=='')||($post['organization']=='')||($post['name']=='')||($post['url']=='')||($post['desc']=='')){
				return "All fields are required!";
			}else{
				//check if there's already an API key for this app
				$result = $this->db->query("select * from api_users where au_email='$post[email]' and au_url='$post[url]'");
				if($result->num_rows()>0){
					//check if key is assigned or not
					$result = $result->result_array();
					$result = $result[0];
					if($result['au_key']==''){
						return "You have already made a request for an API key, please check email for confirmation message";
					}else{
						return "An API key request has already been given to your app. Check your email for details.";
					}
				}else{
					$this->db->query("insert into api_users(`au_email`, `au_organization`, `au_url`, `au_name`, `au_description`)values('$post[email]', '$post[organization]', '$post[url]', '$post[name]', '$post[desc]')");
					
					$key = md5($post['email'].$post['url']);
					$this->load->library('encrypt');
					$code = $this->encrypt->encode($key);
					//print $code;
					mail($post['email'], 'OpenDuka API Confirmation', 'Click on this link to confirm your email address: '.base_url().'index.php/api/confirm?code='.$code.'&email='.$post['email'].'&app='.$post['url']);
					return "Check email address for confirmation!";
				}
		
			}
		}else{
			redirect(base_url().'index.php/api');
		}
	}
	public function valid_key($key){
		$query = $this->db->query("select * from api_users where au_key='$key'");
		$query = $query->result_array();
		if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
}
