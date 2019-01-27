<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
  protected $data = array();
  function __construct()
  {
    parent::__construct();
    $this->data['title'] = '';
    $this->data['before_head'] = '';
    $this->data['before_body'] ='';
    $this->data['user_is_logged_in'] = $this->ion_auth->logged_in();

    $this->data['app_logo_url'] = '/public/img/icons/target-2.svg';
    $this->data['app_name'] = 'Mediatik';
  }

  protected function render($the_view = NULL, $template = 'master')
  {
    if($template == 'json' || $this->input->is_ajax_request())
    {
      header('Content-Type: application/json');
      echo json_encode($this->data);
    }
    else
    {
      $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view,$this->data, TRUE);;
      $this->load->view('templates/'.$template.'_view', $this->data);
    }
  }
}

class Admin_Controller extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    if($this->uri->uri_string() != 'auth/login' && !$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('error_message','You are not allowed to visit this page');
      redirect('auth/login','refresh');
    }
  }

  protected function render($the_view = NULL, $template = 'admin_master')
  {
    parent::render($the_view, $template);
  }
}

class Public_Controller extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  }
}
