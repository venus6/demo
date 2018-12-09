<?php
class Operator extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('conf/operator_model');
        $this->load->model('conf/roles_model');
    }

    public function index($page = 1) {
        $data = array();

        /* 分页 */
        $filter = array('name' => $this->input->get('name'));
        $this->load->library('pagination');
        $pagination = $this->operator_model->pagination_operator_list($page, $filter, $this->pagination->per_page);

        $config['base_url'] = site_url() . '/conf/operator/index';
        $config['total_rows'] = $pagination['total_rows'];
        $this->pagination->initialize($config);
        $pagination['show'] = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $this->load->view('conf/operator_list', $data);
    }

    public function del() {
        $id = $this->input->post('id');
        $id = intval($id);
        $operator_info = $this->operator_model->get_info($id);
        if (!$operator_info) {
            v_show_tips(0, '删除操作员失败！(url error)');
        }
        if ($this->operator_model->del($id)) {
            v_show_tips(1, '删除操作员成功！', 'self_page');
        } else {
            v_show_tips(0, '删除操作员失败！');
        }
    }

    public function add() {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('name', 'pwd', 'pwd2', 'rname', 'tel', 'email', 'roles', 'status', 'note'));
            if (trim($post_arr['name']) == '') {
                v_show_tips(0, '请填写操作员名！');
            }
            if ($post_arr['pwd'] == '') {
                v_show_tips(0, '请填写密码！');
            }
            if ($post_arr['pwd'] != $post_arr['pwd2']) {
                v_show_tips(0, '密码两次输入不匹配！');
            }
            if ($this->operator_model->check_name($post_arr['name'])) {
                v_show_tips(0, '操作员名已经被占用，请重新输入！');
            }
            if (!isset($post_arr['roles'])) {
                v_show_tips(0, '请选择角色！');
            }
            unset($post_arr['pwd2']);
            $post_arr['pwd'] = md5($post_arr['pwd']);
            $post_arr['roles'] = implode(',', $post_arr['roles']);
            $post_arr['add_time'] = date('Y-m-d H:i:s');
            if ($this->operator_model->insert($post_arr)) {
                v_show_tips(1, '添加成功！', 'box');
            } else {
                v_show_tips(0, '添加失败！');
            }
        } else {
            $data = array();

            $roles_list = $this->roles_model->get_list();
            $data['roles_list'] = $roles_list;

            $this->load->view('conf/operator_add', $data);
        }
    }

    public function edit($id = 0) {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('rname', 'tel', 'email', 'note'));
            if ($this->input->post('supper') == 0) {
                $post_arr['status'] = $this->input->post('status');
                if ($this->input->post('roles') == '') {
                    v_show_tips(0, '请选择角色！');
                } else {
                    $post_arr['roles'] = implode(',', $this->input->post('roles'));
                }
            }
            if ($this->operator_model->update($id, $post_arr)) {
                v_show_tips(1, '编辑成功', 'box');
            } else {
                v_show_tips(0, '编辑失败！');
            }
        } else {
            $data = array();
            $id = intval($id);
            $operator_info = $this->operator_model->get_info($id);
            if (!$operator_info) {
                $this->load->view('errors/html/error_404_box');
                return ;
            }
            $data['operator_info'] = $operator_info;

            $roles_list = $this->roles_model->get_list();
            $data['roles_list'] = $roles_list;

            $this->load->view('conf/operator_edit', $data);
        }
    }
}