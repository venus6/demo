<?php
class Type extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('content/type_model');
        $this->load->model('content/content_model');
    }

    public function column_list($page = 1) {
        $data = array();

        /* 分页 */
        $filter = array('name' => $this->input->get('name'));
        $this->load->library('pagination');
        $pagination = $this->type_model->pagination_column_list($page, $filter, $this->pagination->per_page);
        $count_data = count($pagination['list']);
        for($i = 0; $i < $count_data; $i++) {
            $pagination['list'][$i]['fun_type_name'] = $this->config->item('fun_type')[$pagination['list'][$i]['fun_type']];
        }

        $config['base_url'] = site_url() . '/content/type/column_list';
        $config['total_rows'] = $pagination['total_rows'];
        $this->pagination->initialize($config);
        $pagination['show'] = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $this->load->view('content/column_list', $data);
    }

    public function add_column() {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('name', 'fun_type', 'display', 'sort'));
            if (trim($post_arr['name']) == '') {
                v_show_tips(0, '请填写栏目名！');
            }
            if(!is_numeric($post_arr['sort'])){
                v_show_tips(0, '排序值应为整数值！');
            }
            if ($this->type_model->add_type($post_arr)) {
                v_show_tips(1, '添加成功！', 'box');
            } else {
                v_show_tips(0, '添加失败！');
            }
        } else {
            $data = array();

            $data['fun_type_list'] = $this->config->item('fun_type');

            $this->load->view('content/column_add', $data);
        }
    }

    public function edit_column($id = 0) {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('name', 'fun_type', 'display', 'sort'));
            if (trim($post_arr['name']) == '') {
                v_show_tips(0, '请填写栏目名！');
            }
            if(!is_numeric($post_arr['sort'])){
                v_show_tips(0, '排序值应为整数值！');
            }
            if ($this->type_model->edit_type($id, $post_arr)) {
                v_show_tips(1, '编辑成功！', 'box');
            } else {
                v_show_tips(0, '编辑失败！');
            }
        } else {
            $data = array();
            $id = intval($id);
            $type_info = $this->type_model->get_info($id);
            if (!$type_info) {
                $this->load->view('errors/html/error_404_box');
                return ;
            }
            $data['type_info'] = $type_info;

            $data['fun_type_list'] = $this->config->item('fun_type');

            $this->load->view('content/column_edit', $data);
        }
    }

    public function into_column($id = 0) {
        $type_info = $this->type_model->get_info($id);
        switch($type_info['fun_type']) {
        case 'text_page':
            $this->edit_content($id);
            break;
        case 'content_list':
            $this->content_list($id);
            break;
        case 'cover_content_list':
            $this->content_list($id);
            break;
        case 'file_content_list':
            $this->content_list($id);
            break;
        case 'url_link_list':
            redirect('conf-conf/url_link_list');
            break;
        case 'type_list':
            $this->type_list($id);
            break;
        case 'message':
            redirect('message/message/message_list');
            break;
        }
    }

    public function edit_content($type_id) {
        $type_info = $this->type_model->get_info($type_id);
        $data['type_info'] = $type_info;
        $content_info = $this->content_model->get_info_by_type_id($type_id);
        if(!$content_info) {
            $data['form_action'] = site_url('content/type/do_add_content');
            $op = 'add';
        } else {
            $data['form_action'] = site_url('content/type/do_edit_content');
            $data['content_info'] = $content_info;
            $op = 'edit';
        }

        $this->load->view('content/' . $op . '_content', $data);
    }

    public function do_add_content() {
        $post_arr = $this->input->post(array('type_id', 'title', 'content'));
        if($this->input->post('sort')) {
            $post_arr['sort'] = $this->input->post('sort');
        }
        if($this->input->post('cover')) {
            $post_arr['cover'] = $this->input->post('cover');
        }
        if($this->input->post('file_url')) {
            $post_arr['file_url'] = $this->input->post('file_url');
        }
        if ($this->content_model->do_add_content($post_arr)) {
            v_show_tips(1, '添加成功！', 'self_page');
        } else {
            v_show_tips(0, '添加失败！');
        }
    }

    public function do_edit_content() {
        $id = $this->input->post('id');
        $post_arr = $this->input->post(array('title', 'content'));
        if($this->input->post('sort')) {
            $post_arr['sort'] = $this->input->post('sort');
        }
        if($this->input->post('cover')) {
            $post_arr['cover'] = $this->input->post('cover');
        }
        if($this->input->post('file_url')) {
            $post_arr['file_url'] = $this->input->post('file_url');
        }
        if ($this->content_model->do_edit_content($id, $post_arr)) {
            v_show_tips(1, '编辑成功！', 'self_page');
        } else {
            v_show_tips(0, '编辑失败！');
        }
    }

    public function content_list($type_id, $page = 1) {
        $data = array();
        $type_info = $this->type_model->get_info($type_id);
        $data['type_info'] = $type_info;
        if($type_info['p_id'] != 0) {
            $p_type_info = $this->type_model->get_info($type_info['p_id']);
            $data['p_type_info'] = $p_type_info;
        }

        /* 分页 */
        $filter = array('type_id' => $type_id);
        $this->load->library('pagination');
        $pagination = $this->content_model->pagination_content_list($page, $filter, $this->pagination->per_page);
        $count_data = count($pagination['list']);
        for($i = 0; $i < $count_data; $i++) {
            $type_info = $this->type_model->get_info($pagination['list'][$i]['type_id']);
            $pagination['list'][$i]['type_name'] = $type_info['name'];
        }

        $config['base_url'] = site_url() . '/content/type/content_list/' . $type_id;
        $config['total_rows'] = $pagination['total_rows'];
        $this->pagination->initialize($config);
        $pagination['show'] = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $this->load->view('content/content_list', $data);
    }

    public function add_content_title($type_id) {
        $type_info = $this->type_model->get_info($type_id);
        $data['type_info'] = $type_info;
        if($type_info['p_id'] != 0) {
            $p_type_info = $this->type_model->get_info($type_info['p_id']);
            $data['p_type_info'] = $p_type_info;
        }

        $this->load->view('content/add_content_title', $data);
    }

    public function edit_content_title($id) {
        $content_info = $this->content_model->get_info($id);
        $data['content_info'] = $content_info;
        $type_info = $this->type_model->get_info($content_info['type_id']);
        $data['type_info'] = $type_info;
        if($type_info['p_id'] != 0) {
            $p_type_info = $this->type_model->get_info($type_info['p_id']);
            $data['p_type_info'] = $p_type_info;
        }

        $this->load->view('content/edit_content_title', $data);
    }

    public function add_content_file($type_id) {
        $type_info = $this->type_model->get_info($type_id);
        $data['type_info'] = $type_info;
        if($type_info['p_id'] != 0) {
            $p_type_info = $this->type_model->get_info($type_info['p_id']);
            $data['p_type_info'] = $p_type_info;
        }

        $this->load->view('content/add_content_file', $data);
    }

    public function edit_content_file($id) {
        $content_info = $this->content_model->get_info($id);
        $data['content_info'] = $content_info;
        $type_info = $this->type_model->get_info($content_info['type_id']);
        $data['type_info'] = $type_info;
        if($type_info['p_id'] != 0) {
            $p_type_info = $this->type_model->get_info($type_info['p_id']);
            $data['p_type_info'] = $p_type_info;
        }

        $this->load->view('content/edit_content_file', $data);
    }

    public function del_content() {
        $id = $this->input->post('id');
        $id = intval($id);
        $content_info = $this->content_model->get_info($id);
        if (!$content_info) {
            v_show_tips(0, '删除失败！(url error)');
        }
        if ($this->content_model->del_content($id)) {
            v_show_tips(1, '删除成功！', 'self_page');
        } else {
            v_show_tips(0, '删除失败！');
        }
    }

    public function del_type() {
        $id = $this->input->post('id');
        $id = intval($id);
        $type_info = $this->type_model->get_info($id);
        if (!$type_info) {
            v_show_tips(0, '删除失败！(url error)');
        }
        if ($this->type_model->del_type($id)) {
            v_show_tips(1, '删除成功！', 'self_page');
        } else {
            v_show_tips(0, '删除失败！');
        }
    }

    public function ajax_edit_content_sort() {
        $id = intval($this->input->post('id'));
        $sort = $this->input->post('num');
        if($this->content_model->edit_sort($id, $sort)) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

    public function ajax_edit_type_sort() {
        $id = intval($this->input->post('id'));
        $sort = $this->input->post('num');
        if($this->type_model->edit_sort($id, $sort)) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

    public function type_list($type_id, $page = 1) {
        $data = array();
        $type_info = $this->type_model->get_info($type_id);
        $data['type_info'] = $type_info;

        /* 分页 */
        $filter = array('type_id' => $type_id);
        $this->load->library('pagination');
        $pagination = $this->type_model->pagination_type_list($page, $filter, $this->pagination->per_page);
        $count_data = count($pagination['list']);
        for($i = 0; $i < $count_data; $i++) {
            $pagination['list'][$i]['fun_type_name'] = $this->config->item('fun_type')[$pagination['list'][$i]['fun_type']];
        }

        $config['base_url'] = site_url() . '/content/type/type_list/' . $type_id;
        $config['total_rows'] = $pagination['total_rows'];
        $this->pagination->initialize($config);
        $pagination['show'] = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $this->load->view('content/type_list', $data);
    }

    public function add_type($id = 0) {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('name', 'fun_type', 'display', 'sort', 'p_id'));
            if (trim($post_arr['name']) == '') {
                v_show_tips(0, '请填写类别名！');
            }
            if(!is_numeric($post_arr['sort'])){
                v_show_tips(0, '排序值应为整数值！');
            }
            if ($this->type_model->add_type($post_arr)) {
                v_show_tips(1, '添加成功！', 'box');
            } else {
                v_show_tips(0, '添加失败！');
            }
        } else {
            $data = array();

            $data['fun_type_list'] = $this->config->item('fun_type');
            $data['p_id'] = $id;

            $this->load->view('content/type_add', $data);
        }
    }

    public function edit_type($id = 0) {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('name', 'fun_type', 'display', 'sort'));
            if (trim($post_arr['name']) == '') {
                v_show_tips(0, '请填写类别名！');
            }
            if(!is_numeric($post_arr['sort'])){
                v_show_tips(0, '排序值应为整数值！');
            }
            if ($this->type_model->edit_type($id, $post_arr)) {
                v_show_tips(1, '编辑成功！', 'box');
            } else {
                v_show_tips(0, '编辑失败！');
            }
        } else {
            $data = array();
            $id = intval($id);
            $type_info = $this->type_model->get_info($id);
            if (!$type_info) {
                $this->load->view('errors/html/error_404_box');
                return ;
            }
            $data['type_info'] = $type_info;

            $data['fun_type_list'] = $this->config->item('fun_type');

            $this->load->view('content/type_edit', $data);
        }
    }

    public function add_content_cover($type_id) {
        $type_info = $this->type_model->get_info($type_id);
        $data['type_info'] = $type_info;
        if($type_info['p_id'] != 0) {
            $p_type_info = $this->type_model->get_info($type_info['p_id']);
            $data['p_type_info'] = $p_type_info;
        }

        $this->load->view('content/add_content_cover', $data);
    }

    public function edit_content_cover($id) {
        $content_info = $this->content_model->get_info($id);
        $data['content_info'] = $content_info;
        $type_info = $this->type_model->get_info($content_info['type_id']);
        $data['type_info'] = $type_info;
        if($type_info['p_id'] != 0) {
            $p_type_info = $this->type_model->get_info($type_info['p_id']);
            $data['p_type_info'] = $p_type_info;
        }

        $this->load->view('content/edit_content_cover', $data);
    }
}