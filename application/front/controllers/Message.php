<?php
class Message extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model('content/type_model');
        $this->load->model('message/message_model');
    }

    public function index($id = 0) {
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

        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('name', 'tel', 'email', 'content'));
            var_dump($post_arr);exit;
            if (trim($post_arr['name']) == '') {
                v_show_tips(0, '客户名/联系人不能为空！');
            }
            if (trim($post_arr['tel']) == '') {
                v_show_tips(0, '手机/电话不能为空！');
            }
            if (trim($post_arr['content']) == '') {
                v_show_tips(0, '留言不能为空！');
            }
            if($this->message_model->add_message($post_arr)){
                v_show_tips(1, '客户留言成功!', 'no_op');
            }else{
                v_show_tips(0, '客户留言失败！请检查原因后重新提交！');
            }
        }

        //page title
        $data['page_title'] = $type_info['name'] . ' - ';

        $this->load->view('message', $data);
    }
}