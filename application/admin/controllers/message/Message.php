<?php
class Message extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('message/message_model');
    }

    public function message_list($page = 1) {
        $data = array();

        /* 分页 */
        $filter = array('name' => $this->input->get('name'), 'finish' => $this->input->get('finish'));
        $this->load->library('pagination');
        $pagination = $this->message_model->pagination_message_list($page, $filter, $this->pagination->per_page);

        $config['base_url'] = site_url() . '/message/message/message_list';
        $config['total_rows'] = $pagination['total_rows'];
        $this->pagination->initialize($config);
        $pagination['show'] = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $this->load->view('message/message_list', $data);
    }

    public function del() {
        $id = $this->input->post('id');
        $id = intval($id);
        $message_info = $this->message_model->get_info($id);
        if (!$message_info) {
            v_show_tips(0, '删除失败！(url error)');
        }
        if ($this->message_model->del($id)) {
            v_show_tips(1, '删除成功！', 'self_page');
        } else {
            v_show_tips(0, '删除失败！');
        }
    }

    public function view_message($id = 0) {
        $message_info = $this->message_model->get_info($id);
        $data['message_info'] = $message_info;

        $this->load->view('message/view_message', $data);
    }

    public function sign_finish() {
        $id = $this->input->post('id');
        if ($this->message_model->sign_finish($id)) {
            v_show_tips(1, '操作成功！', 'box');
        } else {
            v_show_tips(0, '操作失败！');
        }
    }
}