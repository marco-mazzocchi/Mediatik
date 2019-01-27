<?php
class Journalists extends Admin_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('journalist_model');
                $this->load->model('category_model');
                $this->load->model('journalisticHead_model');
        }

        public function index()
        {

                if($this->input->is_ajax_request())
                {
                        header('Content-Type: application/json');
                        $this->load->library('form_validation');

                        $this->form_validation->set_rules('ranking', 'Ranking', 'trim|integer|less_than[11]');
                        $this->form_validation->set_rules('categories[]', 'Categorie', 'trim|integer');
                        $this->form_validation->set_rules('periodicities[]', 'Periodicità', 'trim|integer');
                        $this->form_validation->set_rules('blackList[]', 'Giornalisti da escludere', 'trim|integer');
                        $this->form_validation->set_rules('whiteList[]', 'Giornalisti da includere', 'trim|integer');

                        if ($this->form_validation->run()) {
                                $ranking = $this->input->post('ranking');
                                $categories = $this->input->post('categories');
                                $periodicities = $this->input->post('periodicities');
                                $media_types = $this->input->post('mediaTypes');
                                $provinces = $this->input->post('provinces');
                                $national_circulation = $this->input->post('nationalCirculation');
                                $black_list = $this->input->post('blackList');
                                $white_list = $this->input->post('whiteList');
                                $journalists = $this->journalist_model->get_all($ranking, $categories, $periodicities, $media_types, $provinces, $national_circulation, $white_list, $black_list);
                                echo json_encode($journalists);
                        }
                        else {
                           echo validation_errors();
                        }
                        exit;

                }

                $this->data['title'] = 'Archivio giornalisti';

                $this->load->view('templates/header', $this->data);
                $this->load->view('journalists/index', $this->data);
                $this->load->view('templates/footer');
        }

        public function view($slug = NULL)
        {

        }

        public function create()
        {

                $this->load->helper('form');
                $this->load->library('form_validation');

                $this->data['title'] = 'Crea un giornalista';
                $this->data['categories'] = $this->category_model->get_all();
                $this->data['journalistic_heads'] = $this->journalisticHead_model->get_all();
                $this->data['province'] = '';

                $this->form_validation->set_rules('name', 'Nome', 'trim|required');
                $this->form_validation->set_rules('surname', 'Cognome', 'trim|required');
                $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
                $this->form_validation->set_rules('ranking', 'Ranking', 'trim|required|integer|less_than[11]');
                $this->form_validation->set_rules('categories[]', 'Categorie', 'trim|integer');
                $this->form_validation->set_rules('journalistic_heads[]', 'Testate giornalistiche', 'trim|integer');

                if ($this->form_validation->run() === false)
                {
                        $this->load->view('templates/header', $this->data);
                        $this->load->view('journalists/create', $this->data);
                        $this->load->view('templates/footer');
                }
                else {
                        $data = array(
                                'name' => $this->input->post('name'),
                                'surname' => $this->input->post('surname'),
                                'email' => $this->input->post('email'),
                                'ranking' => $this->input->post('ranking'),
                                'address' => $this->input->post('address'),
                                'city' => $this->input->post('city'),
                                'province' => $this->input->post('province'),
                                'postal_code' => $this->input->post('postal_code'),
                                'phone' => $this->input->post('phone'),
                                'mobile' => $this->input->post('mobile'),
                                'fax' => $this->input->post('fax'),
                                'notes' => $this->input->post('notes'),
                        );

                        // save journalist
                        $insert_result = $this->journalist_model->insert($data);
                        if($insert_result) {
                                // get created journalist info
                                $journalist = $this->journalist_model->getByMail($data['email']);
                                $journalist_id = (int) $journalist->id;
                                // add categories relationship
                                $categories = ($this->input->post('categories')) ? $this->input->post('categories') : array();
                                $this->journalist_model->addCategories($journalist_id, $categories);
                                // add journalistic heads relationship
                                $journalistic_heads = ($this->input->post('journalistic_heads')) ? $this->input->post('journalistic_heads') : array();
                                $this->journalist_model->addJournalisticHeads($journalist_id, $journalistic_heads);
                        }

                        $this->session->set_flashdata('success_message', 'Giornalista creato');
                        redirect("journalists/{$journalist->id}/edit");
                }
        }

        public function edit($id)
        {

                $this->load->helper('form');
                $this->load->library('form_validation');

                $journalist = $this->journalist_model->get($id);
                $this->data['title'] = 'Modifica giornalista "' . $journalist->name ." " . $journalist->surname . '"';
                $this->data['journalist'] = $journalist;
                $this->data['province'] = $journalist->province;
                $this->data['journalistic_heads'] = $this->journalisticHead_model->get_all();

                $this->data['journalist_categories'] = array();
                foreach($journalist->categories as $category) {
                        $this->data['journalist_categories'][] = $category->id;
                }

                $this->data['journalist_journalistic_heads'] = array();
                foreach($journalist->journalistic_heads as $journalistic_head) {
                        $this->data['journalist_journalistic_heads'][] = $journalistic_head->id;
                }

                $this->data['all_categories'] = $this->category_model->get_all();

                $this->form_validation->set_rules('name', 'Nome', 'trim|required');
                $this->form_validation->set_rules('surname', 'Cognome', 'trim|required');
                $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
                $this->form_validation->set_rules('ranking', 'Ranking', 'trim|required|integer|less_than[11]');
                $this->form_validation->set_rules('categories[]', 'Categorie', 'trim|integer');
                $this->form_validation->set_rules('journalistic_heads[]', 'Testate giornalistiche', 'trim|integer');

                if ($this->form_validation->run() === FALSE)
                {
                        $this->load->view('templates/header', $this->data);
                        $this->load->view('journalists/edit', $this->data);
                        $this->load->view('templates/footer');

                }
                else
                {
                        // update journalist
                        $data = array(
                                'name' => $this->input->post('name'),
                                'surname' => $this->input->post('surname'),
                                'email' => $this->input->post('email'),
                                'ranking' => $this->input->post('ranking'),
                                'address' => $this->input->post('address'),
                                'city' => $this->input->post('city'),
                                'province' => $this->input->post('province'),
                                'postal_code' => $this->input->post('postal_code'),
                                'phone' => $this->input->post('phone'),
                                'mobile' => $this->input->post('mobile'),
                                'fax' => $this->input->post('fax'),
                                'notes' => $this->input->post('notes'),
                        );
                        $this->journalist_model->update($id, $data);

                        // update categories
                        $categories = ($this->input->post('categories')) ? $this->input->post('categories') : array();
                        $this->journalist_model->updateCategories((int)$id, $categories);

                        // update journalistic heads
                        $journalistic_heads = ($this->input->post('journalistic_heads')) ? $this->input->post('journalistic_heads') : array();
                        $this->journalist_model->updateJournalisticHeads((int)$id, $journalistic_heads);

                        $this->session->set_flashdata('success_message', 'Giornalista aggiornato');
                        redirect("journalists/{$journalist->id}/edit");
                }
        }

        public function delete($id)
        {
                $this->journalist_model->delete($id);
                $this->session->set_flashdata('success_message', 'Giornalista rimosso');
                redirect("journalists/index");
        }

        public function updateField()
        {

                $success = $this->journalist_model->update(
                        $this->input->post('id'),
                        array($this->input->post('fieldName') => $this->input->post('fieldValue'))
                );

                $response = array(
                        "success" => $success,
                        "query" => $this->db->last_query()
                );

                echo json_encode($response);
        }
}
