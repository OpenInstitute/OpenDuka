<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller{
 public function __construct()
 {
  parent::__construct();
  $this->load->helper(array('form','url'));
  $this->load->library(array('session'));
  $this->load->database();
  $this->load->model('user_model');
 }
 public function index()
 {
  if(($this->session->userdata('user_name')!=""))
  {
   redirect('/admin');
  }
  else{
   $data['page_title']= 'Home';
   $this->load->view('header',$data);
   $this->load->view("registration_view.php", $data);
   $this->load->view('footer',$data);
  }
 }
 public function login()
 {
  $email=$this->input->post('email');
  $password=md5($this->input->post('pass'));
  $result=$this->user_model->login($email,$password);
  if($result) redirect('/admin');
  else        $this->index();
 }
 public function thank()
 {
  $data['page_title']= 'Thank';
  $this->load->view('header',$data);
  $this->load->view('admin.php', $data);
  $this->load->view('footer',$data);
 }
 
 public function registration()
 {
//  $this->load->library('form_validation');
  // field name, error message, validation rules
 // $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean');
 // $this->form_validation->set_rules('email_address', 'Your Email', 'trim|required|valid_email');
//  $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
  //$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');

 /* if($this->form_validation->run() == FALSE)
  {
   //$this->index();
   redirect('/admin');
  }
  else
  {*/
  $data=array(
    'username'=>$this->input->post('user_name'),
    'email'=>$this->input->post('email_address'),
    'password'=>md5($this->input->post('password'))
  );
  //var_dump($data); exit;
   $this->user_model->add_user($data);
   $this->thank();
 // }
 }
 
 public function logout()
 {
  $newdata = array(
  'user_id'   =>'',
  'user_name'  =>'',
  'user_email'     => '',
  'logged_in' => FALSE,
  );
  $this->session->unset_userdata($newdata);
  $this->session->sess_destroy();
  $this->index();

 }
 
}
?>
