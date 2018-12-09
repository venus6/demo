<?php
class Priv extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('conf/priv_model');
    }

    public function index($page = 1) {
        $data = array();

        /* 分页 */
        $filter = array('name' => $this->input->get('name'));
        $this->load->library('pagination');
        $pagination = $this->priv_model->pagination_priv_list($page, $filter, $this->pagination->per_page);
        $count_data = count($pagination['list']);
        for($i = 0; $i < $count_data; $i++) {
            if($pagination['list'][$i]['p_id'] == 0) {
                $pagination['list'][$i]['p_name'] = '无';
                $pagination['list'][$i]['m_type'] = '顶级菜单';
            } else {
                $rs = $this->priv_model->get_priv($pagination['list'][$i]['p_id']);
                $pagination['list'][$i]['p_name'] = $rs['name'];
                if($rs['p_id'] == 0) {
                    $pagination['list'][$i]['m_type'] = '二级菜单';
                } else {
                    $pagination['list'][$i]['m_type'] = '三级菜单';
                }
            }
        }

        $config['base_url'] = site_url() . '/conf/priv/index';
        $config['total_rows'] = $pagination['total_rows'];
        $this->pagination->initialize($config);
        $pagination['show'] = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $this->load->view('conf/priv_list', $data);
    }

    public function del() {
        $id = $this->input->post('id');
        $id = intval($id);
        $priv_info = $this->priv_model->get_info($id);
        if (!$priv_info) {
            v_show_tips(0, '删除失败！(url error)');
        }
        if ($this->priv_model->del($id)) {
            v_show_tips(1, '删除成功！', 'self_page');
        } else {
            v_show_tips(0, '删除失败！');
        }
    }

    public function add() {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('name', 'module', 'p_id', 'display', 'orders', 'blank_page'));
            if (trim($post_arr['name']) == '') {
                v_show_tips(0, '请填写菜单名！');
            }
            if(!is_numeric($post_arr['orders'])){
                v_show_tips(0, '排序值应为整数值！');
            }
            if ($this->priv_model->insert($post_arr)) {
                v_show_tips(1, '添加成功！', 'box');
            } else {
                v_show_tips(0, '添加失败！');
            }
        } else {
            $data = array();
            $menu_list = $this->priv_model->menu_list();
            $data['menu_list'] = $menu_list;

            $this->load->view('conf/priv_add', $data);
        }
    }

    public function edit($id = 0) {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('name', 'module', 'p_id', 'display', 'orders', 'blank_page'));
            if (trim($post_arr['name']) == '') {
                v_show_tips(0, '请填写菜单名！');
            }
            if(!is_numeric($post_arr['orders'])){
                v_show_tips(0, '排序值应为整数值！');
            }
            if ($this->priv_model->update($id, $post_arr)) {
                v_show_tips(1, '编辑成功', 'box');
            } else {
                v_show_tips(0, '编辑失败！');
            }
        } else {
            $data = array();
            $id = intval($id);
            $priv_info = $this->priv_model->get_info($id);
            if (!$priv_info) {
                $this->load->view('errors/html/error_404_box');
                return ;
            }
            $data['priv_info'] = $priv_info;

            $menu_list = $this->priv_model->menu_list();
            $data['menu_list'] = $menu_list;

            $this->load->view('conf/priv_edit', $data);
        }
    }
}