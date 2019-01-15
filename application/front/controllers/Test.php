<?php
class Test extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('test_model');
        //$this->load->helper('common');
    }

    public function index() {
        $this->benchmark->mark('start');
        $data['news'] = $this->test_model->get_news(5);
        $data['news_arr'] = $this->test_model->get_news();
        $this->benchmark->mark('end');
        //echo $this->benchmark->elapsed_time('start', 'end');exit;
        //$this->test_model->insert_data();
        //var_dump($data);exit;
        $this->load->view('test/home', $data);
    }

    public function view($page = 'home') {
        if (!file_exists(APPPATH . 'views/test/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('test/' . $page, $data);
    }

    public function test_cli($id, $name) {
        if (is_cli()) {
            echo $id . '+venus!' . $name;
            //var_dump($argv);
        } else {
            echo "It's not run in CLI!";
        }
    }

    public function one() {
        $data = array();
        $this->load->view('test/layui', $data);
    }

    public function two() {

        var_dump(4 & 1);
        exit;
        $this->load->view('test/two', $data);
    }

    public function do_two() {
        echo 12;exit;
        var_dump($_POST);exit;
        $something = $this->input->get('f');
        $something = $this->security->xss_clean($something);
        echo $something;exit;
    }

    public function redis() {
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $list = $redis->keys("*");
        var_dump($list);
    }
}