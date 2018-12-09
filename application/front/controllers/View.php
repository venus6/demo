<?php
class View extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model('content/type_model');
        $this->load->model('content/content_model');
    }

    /* content_list */
    public function cl($id = 0) {
        $id = intval($id);
        if ($id == 0) {
            show_404();
        }
        $data = array();
        $content_info = $this->content_model->get_info($id);
        if (!$content_info) {
            show_404();
        }
        $data['content_info'] = $content_info;

        $type_info = $this->type_model->get_info($content_info['type_id']);
        $data['type_info'] = $type_info;

        $content_list = $this->content_model->get_list_by_type_id($content_info['type_id']);
        $data['content_list'] = $content_list;

        //page title
        $data['page_title'] = $content_info['title'] . ' - ' . $type_info['name'] . ' - ';

        //update click_count
        if (!$this->content_model->add_click_count($id)) {
            show_error('DB error!');
        }

        $this->load->view('content_list', $data);
    }

    /* list_view */
    public function lv($id = 0) {
        $id = intval($id);
        if ($id == 0) {
            show_404();
        }
        $data = array();
        $content_info = $this->content_model->get_info($id);
        if (!$content_info) {
            show_404();
        }
        $data['content_info'] = $content_info;

        $sub_type_info = $this->type_model->get_info($content_info['type_id']);
        $data['sub_type_info'] = $sub_type_info;

        $type_info = $this->type_model->get_info($sub_type_info['p_id']);
        $data['type_info'] = $type_info;

        $sub_type_list = $this->type_model->get_sub_list($type_info['id']);
        $data['sub_type_list'] = $sub_type_list;
        $data['sub_type_id'] = $sub_type_info['id'];

        //page title
        $data['page_title'] = $content_info['title'] . ' - ' . $sub_type_info['name'] . ' - ' . $type_info['name'] . ' - ';

        //update click_count
        if (!$this->content_model->add_click_count($id)) {
            show_error('DB error!');
        }

        if($sub_type_info['fun_type'] == 'content_list') {
            $view_file = 'article_list_view';
        }
        if($sub_type_info['fun_type'] == 'cover_content_list') {
            $view_file = 'cover_list_view';
        }
        if($sub_type_info['fun_type'] == 'file_content_list') {
            $view_file = 'file_list_view';
        }
        $this->load->view($view_file, $data);
    }

    /* text_page */
    public function tp($id = 0) {
        $id = intval($id);
        if ($id == 0) {
            show_404();
        }
        $data = array();
        $type_info = $this->type_model->get_info($id);
        if (!$type_info) {
            show_404();
        }
        $data['type_info'] = $type_info;

        $content_info = $this->content_model->get_info_by_type_id($id);
        if (!$content_info) {
            show_404();
        }
        $data['content_info'] = $content_info;

        //page title
        $data['page_title'] = $type_info['name'] . ' - ';

        //update click_count
        if (!$this->content_model->add_click_count($content_info['id'])) {
            show_error('DB error!');
        }

        $this->load->view('text_page', $data);
    }
}