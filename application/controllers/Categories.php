<?php
class Categories extends Admin_Controller {

   public function __construct()
   {
      parent::__construct();
      $this->load->model('category_model');
   }

   public function index()
   {

      if($this->input->is_ajax_request())
      {
         header('Content-Type: application/json');
         $categories = $this->category_model->get_all();
         echo json_encode($categories);
         exit;
      }

      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->data['title'] = 'Categorie notizie';
      $this->data['categories'] = $this->category_model->get_all();

      $this->form_validation->set_rules('name', 'Nome', 'required');

      if ($this->form_validation->run() === FALSE)
      {
         $this->load->view('templates/header', $this->data);
         print "<div class='row'>";
         $this->load->view('categories/index', $this->data);
         $this->load->view('categories/new');
         print "</div>";
         $this->load->view('templates/footer');
      }
      else {
         $data = array(
            "name" => $this->input->post('name'),
         );
         $this->category_model->insert($data);
         $this->session->set_flashdata('success_message', 'Categoria creata');
         redirect("categories/index");
      }
   }

   public function edit($id)
   {

      $this->load->helper('form');
      $this->load->library('form_validation');

      $category = $this->category_model->get($id);
      $this->data['title'] = 'Modifica categoria "' . $category->name . '"';
      $this->data['category'] = $category;

      $this->form_validation->set_rules('name', 'Nome', 'required');

      if ($this->form_validation->run() === FALSE)
      {
         $this->load->view('templates/header', $this->data);
         $this->load->view('categories/edit', $this->data);
         $this->load->view('templates/footer');

      }
      else
      {
         $data = array(
                       'name' => $this->input->post('name'),
                   );
         $this->category_model->update($id, $data);
         $this->session->set_flashdata('success_message', 'Categoria aggiornata');
         redirect("categories/index");
      }

   }

   public function delete($id)
   {
      $this->category_model->delete($id);
      $this->session->set_flashdata('success_message', 'Categoria rimossa');
      redirect("categories/index");
   }

}
