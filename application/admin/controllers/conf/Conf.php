<?php
class Conf extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('conf/conf_model');
        $this->load->model('content/type_model');
        $this->load->model('content/content_model');
    }

    public function seo_conf() {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('title', 'key', 'desc'));
            $value = serialize($post_arr);
            if ($this->conf_model->set_conf('seo', $value)) {
                v_show_tips(1, '配置成功！', 'self_page');
            } else {
                v_show_tips(0, '配置失败！');
            }
        } else {
            $seo_conf = $this->conf_model->get_conf('seo');
            $seo_info = unserialize($seo_conf);
            $data['seo_info'] = $seo_info;

            $this->load->view('conf/seo_conf', $data);
        }
    }

    public function footer_conf() {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('content'));
            $value = $post_arr['content'];
            if ($this->conf_model->set_conf('footer', $value)) {
                v_show_tips(1, '配置成功！', 'self_page');
            } else {
                v_show_tips(0, '配置失败！');
            }
        } else {
            $footer_conf = $this->conf_model->get_conf('footer');
            $data['footer_info'] = $footer_conf;

            $this->load->view('conf/footer_conf', $data);
        }
    }

    public function url_link_list($page = 1) {
        $data = array();
        $type_id = $this->type_model->get_url_link_list_type_id();
        $data['type_id'] = $type_id;

        /* 分页 */
        $filter = array('name' => $this->input->get('name'), 'type_id' => $type_id);
        $this->load->library('pagination');
        $pagination = $this->conf_model->pagination_url_link_list($page, $filter, $this->pagination->per_page);

        $config['base_url'] = site_url() . '/conf/conf/url_link_list';
        $config['total_rows'] = $pagination['total_rows'];
        $this->pagination->initialize($config);
        $pagination['show'] = $this->pagination->create_links();
        $data['pagination'] = $pagination;

        $this->load->view('conf/url_link_list', $data);
    }

    public function add_url_link($id = 0) {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('title', 'url_link', 'sort', 'type_id'));
            if (trim($post_arr['title']) == '') {
                v_show_tips(0, '请填写名称！');
            }
            if (trim($post_arr['url_link']) == '') {
                v_show_tips(0, '请填写链接！');
            }
            if(!is_numeric($post_arr['sort'])){
                v_show_tips(0, '排序值应为整数值！');
            }
            if ($this->conf_model->add_url_link($post_arr)) {
                v_show_tips(1, '添加成功！', 'box');
            } else {
                v_show_tips(0, '添加失败！');
            }
        } else {
            $data['type_id'] = $id;

            $this->load->view('conf/add_url_link', $data);
        }
    }

    public function edit_url_link($id = 0) {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('title', 'url_link', 'sort', 'type_id'));
            if (trim($post_arr['title']) == '') {
                v_show_tips(0, '请填写名称！');
            }
            if (trim($post_arr['url_link']) == '') {
                v_show_tips(0, '请填写链接！');
            }
            if(!is_numeric($post_arr['sort'])){
                v_show_tips(0, '排序值应为整数值！');
            }
            if ($this->conf_model->edit_url_link($id, $post_arr)) {
                v_show_tips(1, '编辑成功', 'box');
            } else {
                v_show_tips(0, '编辑失败！');
            }
        } else {
            $content_info = $this->content_model->get_info($id);
            $data['content_info'] = $content_info;
            $data['type_id'] = $id;

            $this->load->view('conf/edit_url_link', $data);
        }
    }
}