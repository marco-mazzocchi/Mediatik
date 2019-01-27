<?php
class MediaTypes extends Admin_Controller {

   public function __construct()
   {
      parent::__construct();
      $this->load->model('mediaType_model');
   }

   public function index()
   {

      if($this->input->is_ajax_request())
      {
         header('Content-Type: application/json');
         $media_types = $this->mediaType_model->get_all();
         echo json_encode($media_types);
         exit;
      }

      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->data['title'] = 'Tipo di media';
      $this->data['media_types'] = $this->mediaType_model->get_all();

      $this->form_validation->set_rules('name', 'Nome', 'required');

      if ($this->form_validation->run() === FALSE)
      {
         $this->load->view('templates/header', $this->data);
         print "<div class='row'>";
         $this->load->view('media-types/index', $this->data);
         $this->load->view('media-types/new');
         print "</div>";
         $this->load->view('templates/footer');
      }
      else {
         $data = array(
            "name" => $this->input->post('name'),
         );
         $this->mediaType_model->insert($data);
         $this->session->set_flashdata('success_message', 'Tipo di media creato');
         redirect("media-types");
      }
   }

   public function edit($id)
   {

      $this->load->helper('form');
      $this->load->library('form_validation');

      $media_type = $this->mediaType_model->get($id);
      $this->data['title'] = 'Modifica tipo di media "' . $media_type->name . '"';
      $this->data['media_type'] = $media_type;

      $this->form_validation->set_rules('name', 'Nome', 'required');

      if ($this->form_validation->run() === FALSE)
      {
         $this->load->view('templates/header', $this->data);
         $this->load->view('media-types/edit', $this->data);
         $this->load->view('templates/footer');

      }
      else
      {
         $data = array(
                       'name' => $this->input->post('name'),
                   );
         $this->mediaType_model->update($id, $data);
         $this->session->set_flashdata('success_message', 'Tipo di media aggiornato');
         redirect("media-types");
      }

   }

   public function delete($id)
   {
      $this->mediaType_model->delete($id);
      $this->session->set_flashdata('success_message', 'Tipo di media rimosso');
      redirect("media-types");
   }

}
