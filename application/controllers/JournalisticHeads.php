<?php
class JournalisticHeads extends Admin_Controller {

   public function __construct()
   {
      parent::__construct();
      $this->load->model('journalisticHead_model');
      $this->load->model('periodicityType_model');
      $this->load->model('mediaType_model');
   }

   public function index()
   {

      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->data['title'] = 'Testate giornalistiche';
      $this->data['journalistic_heads'] = $this->journalisticHead_model->get_all();
      $this->data['province'] = '';
      $this->data['periocity_types'] = $this->periodicityType_model->get_all();
      $this->data['media_types'] = $this->mediaType_model->get_all();

      $this->form_validation->set_rules('name', 'Nome', 'trim|required');
      $this->form_validation->set_rules('name', 'Notes', 'trim');
      $this->form_validation->set_rules('media_types[]', 'Categorie', 'trim|integer');

      if ($this->form_validation->run() === FALSE)
      {
         $this->load->view('templates/header', $this->data);
         print "<div class='row'>";
         $this->load->view('journalistic-heads/index', $this->data);
         $this->load->view('journalistic-heads/new');
         print "</div>";
         $this->load->view('templates/footer');
      }
      else {
         $data = array(
            "name" => $this->input->post('name'),
            "national_circulation" => $this->input->post('national_circulation'),
            "province" => $this->input->post('province'),
            "periodicity" => $this->input->post('periodicity'),
            "notes" => $this->input->post('notes'),
         );
         // save journalistic head
         $insert_id = $this->journalisticHead_model->insert($data);

         if($insert_id) {
                 // add relationships
                 $media_types = ($this->input->post('media_types')) ? $this->input->post('media_types') : array();
                 $this->journalisticHead_model->addMediaTypes($insert_id, $media_types);
         }

         $this->session->set_flashdata('success_message', 'Testata giornalistica creata');
         redirect("journalistic-heads");
      }
   }

   /**
    * Show Journalistic head details like relationships
    */

   public function show($id)
   {

      $journalistic_head = $this->journalisticHead_model->get($id);
      $this->data['journalistic_head'] = $journalistic_head;
      $this->data['journalists'] = $this->journalisticHead_model->getJournalists($id);
      $this->data['title'] = $journalistic_head->name;

      $this->load->view('templates/header', $this->data);
      $this->load->view('journalistic-heads/show', $this->data);
      $this->load->view('templates/footer');

   }

   public function edit($id)
   {

      $this->load->helper('form');
      $this->load->library('form_validation');

      $journalistic_head = $this->journalisticHead_model->get($id);
      $this->data['title'] = 'Modifica testata "' . $journalistic_head->name . '"';
      $this->data['journalistic_head'] = $journalistic_head;
      $this->data['province'] = $journalistic_head->province;
      $this->data['periocity_types'] = $this->periodicityType_model->get_all();
      $this->data['media_types'] = $this->mediaType_model->get_all();

      $this->data['journalistic_head_media_types'] = array();
      foreach($journalistic_head->media_types as $media_type) {
              $this->data['journalistic_head_media_types'][] = $media_type->id;
      }

      $this->form_validation->set_rules('name', 'Nome', 'trim|required');
      $this->form_validation->set_rules('name', 'Notes', 'trim');
      $this->form_validation->set_rules('media_types[]', 'Categorie', 'trim|integer');

      if ($this->form_validation->run() === FALSE)
      {
         $this->load->view('templates/header', $this->data);
         $this->load->view('journalistic-heads/edit', $this->data);
         $this->load->view('templates/footer');

      }
      else
      {
         $data = array(
               "name" => $this->input->post('name'),
               "national_circulation" => $this->input->post('national_circulation'),
               "province" => $this->input->post('province'),
               "periodicity" => $this->input->post('periodicity'),
               "notes" => $this->input->post('notes'),
            );
         $this->journalisticHead_model->update($id, $data);

         // update media types
         $media_types = ($this->input->post('media_types')) ? $this->input->post('media_types') : array();
         $this->journalisticHead_model->updateMediaTypes((int)$id, $media_types);

         $this->session->set_flashdata('success_message', 'Testata aggiornata');
         redirect("journalistic-heads");
      }

   }

   public function delete($id)
   {
      $this->journalisticHead_model->delete($id);
      $this->session->set_flashdata('success_message', 'Testata rimossa');
      redirect("journalistic-heads");
   }

   public function getAllperiodicities() {

      if($this->input->is_ajax_request())
      {
         header('Content-Type: application/json');
         $periocities = $this->periodicityType_model->get_all();
         echo json_encode($periocities);
         exit;
      }

   }

}
