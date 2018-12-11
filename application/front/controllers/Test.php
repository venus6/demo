<?php
class Test extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('test_model');
        $this->load->helper('url_helper');
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
        $this->output->enable_profiler(TRUE);
        if (is_php('7.1')) {
            echo 'one2';
        }
    }

    public function two() {
        echo base_url("test/two/2");exit;
        echo site_url("test/two/2");
    }

    /* 此功能用于 临时多版本时，又不想修改原来的方法，可以再写一个方法，把URI第二段指向这个新方法，而又不用修改页面中的链接。
    public function _remap($method) {
        if ($method === 'index') {
            $this->one();
        } else {
            $this->index();
        }
    }
    */

    public function back_json() {
        $arr = array('one', 'two', 'three');
        echo json_encode($arr);
    }

    public function redis() {
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        echo 'Connection to server sucessfully';
        $res = $redis->get('one');
        echo $res;
    }
}