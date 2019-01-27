<?php
class News extends Admin_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('news_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $this->data['news'] = $this->news_model->get_news();
                $this->data['title'] = 'News archive';

                $this->load->view('templates/header', $this->data);
                $this->load->view('news/index', $this->data);
                $this->load->view('templates/footer');
        }

        public function view($slug = NULL)
        {
                $this->data['news_item'] = $this->news_model->get_news($slug);

                if (empty($this->data['news_item']))
                {
                        show_404();
                }

                $this->data['title'] = $this->data['news_item']['title'];

                $this->load->view('templates/header', $this->data);
                $this->load->view('news/view', $this->data);
                $this->load->view('templates/footer');
        }

        public function create()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->data['title'] = 'Create a news item';

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('text', 'Text', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header', $this->data);
                $this->load->view('news/create');
                $this->load->view('templates/footer');

            }
            else
            {
                $this->news_model->set_news();
                $this->session->set_flashdata('success_message', 'News created');
                redirect('news');
            }
        }
}
