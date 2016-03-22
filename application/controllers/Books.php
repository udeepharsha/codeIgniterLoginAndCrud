<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Books extends CI_Controller {


  public function __construct() {
    
    parent::__construct();
    $this->load->library(array('session'));
    $this->load->helper(array('url'));
    $this->load->model('books_model');
    $this->load->helper('form');
    
  }
  
 
 public function index()
 {
  $data['data_get'] = $this->books_model->view();
  $this->load->view('book/header');
  $this->load->view('book/vcrud', $data);
  $this->load->view('book/footer');
 }
 function add() {
  $this->load->view('book/header');
  $this->load->view('book/vcrudnew');
  $this->load->view('book/footer');
 }
 function edit() {
  $kd = $this->uri->segment(3);
  if ($kd == NULL) {
   redirect('books');
  }
  $dt = $this->books_model->edit($kd);
  $data['fn'] = $dt->firstname;
  $data['ln'] = $dt->lastname;
  $data['ag'] = $dt->age;
  $data['ad'] = $dt->address;
  $data['id'] = $kd;
  $this->load->view('book/header');
  $this->load->view('book/vcrudedit', $data);
  $this->load->view('book/footer');
 }
 function delete() {
  $u = $this->uri->segment(3);
  $this->books_model->delete($u);
  redirect('books');
 }
 function save() {
  if ($this->input->post('mit')) {
   $this->books_model->add();
   redirect('books');
  } else{
   redirect('books/tambah');
  }
 }
 function update() {
  if ($this->input->post('mit')) {
   $id = $this->input->post('id');
   $this->books_model->update($id);
   redirect('books');
  } else{
   redirect('books/edit/'.$id);
  }
 }
}
 
/* End of file welcome.php */
/* Location: ./application/controllers/ccrud.php */