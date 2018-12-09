<?php
class Roles extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('conf/roles_model');
        $this->load->model('conf/priv_model');
    }

    public function index($page = 1) {
        $data = array();

        /* 分页 */
        $filter = array('name' => $this->input->get('name'));
        $this->load->library('pagination');
        $pagination = $this->roles_model->pagination_roles_list($page, $filter, $this->pagination->per_page);

        $config['base_url'] = site_url() . '/conf/roles/index';
        $config['total_rows'] = $pagination['total_rows'];
        $this->pagination->initialize($config);
        $pagination['show'] = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $this->load->view('conf/roles_list', $data);
    }

    public function del() {
        $id = $this->input->post('id');
        $id = intval($id);
        $roles_info = $this->roles_model->get_info($id);
        if (!$roles_info) {
            v_show_tips(0, '删除失败！(url error)');
        }
        if ($this->roles_model->del($id)) {
            v_show_tips(1, '删除成功！', 'self_page');
        } else {
            v_show_tips(0, '删除失败！');
        }
    }

    public function add() {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('name', 'priv'));
            if (trim($post_arr['name']) == '') {
                v_show_tips(0, '请填写角色名！');
            }
            if (!isset($post_arr['priv'])) {
                v_show_tips(0, '请选择权限！');
            }
            if ($this->roles_model->insert($post_arr)) {
                v_show_tips(1, '添加成功！', 'box');
            } else {
                v_show_tips(0, '添加失败！');
            }
        } else {
            $data = array();
            $priv_list = $this->priv_model->priv_list();
            $data['priv_list'] = $priv_list;

            $this->load->view('conf/roles_add', $data);
        }
    }

    public function edit($id = 0) {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('name', 'priv'));
            if (trim($post_arr['name']) == '') {
                v_show_tips(0, '请填写角色名！');
            }
            if (!isset($post_arr['priv'])) {
                v_show_tips(0, '请选择权限！');
            }
            if ($this->roles_model->update($id, $post_arr)) {
                v_show_tips(1, '编辑成功', 'box');
            } else {
                v_show_tips(0, '编辑失败！');
            }
        } else {
            $data = array();
            $id = intval($id);
            $roles_info = $this->roles_model->get_info($id);
            if (!$roles_info) {
                $this->load->view('errors/html/error_404_box');
                return ;
            }
            $data['roles_info'] = $roles_info;

            $priv_list = $this->priv_model->priv_list();
            $data['priv_list'] = $priv_list;

            $this->load->view('conf/roles_edit', $data);
        }
    }
}