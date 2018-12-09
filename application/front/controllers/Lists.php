<?php
class Lists extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model('content/type_model');
        $this->load->model('content/content_model');
    }

    public function stl($id = 0, $page = 1) {
        $id = intval($id);
        if ($id == 0) {
            show_404();
        }
        $data = array();
        $sub_type_info = $this->type_model->get_info($id);
        if (!$sub_type_info) {
            show_404();
        }
        $data['sub_type_info'] = $sub_type_info;

        $type_info = $this->type_model->get_info($sub_type_info['p_id']);
        $data['type_info'] = $type_info;

        $sub_type_list = $this->type_model->get_sub_list($type_info['id']);
        $data['sub_type_list'] = $sub_type_list;
        $data['sub_type_id'] = $id;

        /* 分页 */
        $filter = array('type_id' => $id);
        $this->load->library('pagination');
        $pagination = $this->content_model->pagination_content_list($page, $filter, $this->pagination->per_page);

        $config['base_url'] = site_url() . '/lists/stl/' . $id;
        $config['total_rows'] = $pagination['total_rows'];
        $this->pagination->initialize($config);
        $pagination['show'] = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $data['page_title'] = $sub_type_info['name'] . ' - ' . $type_info['name'] . ' - ';

        if($sub_type_info['fun_type'] == 'content_list') {
            $view_file = 'article_content_list';
        }
        if($sub_type_info['fun_type'] == 'cover_content_list') {
            $view_file = 'cover_content_list';
        }
        if($sub_type_info['fun_type'] == 'file_content_list') {
            $view_file = 'file_content_list';
        }

        $this->load->view($view_file, $data);
    }
}