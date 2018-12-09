<?php
class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        //$this->load->model('test_model');
        //$this->load->helper('url_helper');
    }

    public function index() {
        //$data['news'] = $this->test_model->get_news(5);
        //$data['news_arr'] = $this->test_model->get_news();
        //echo $this->benchmark->elapsed_time('start', 'end');exit;
        //$this->test_model->insert_data();
        //var_dump($this->config->item('view'));exit;
       // var_dump(site_url('view/cl/12'));exit;
        $this->load->view('home');
    }
}