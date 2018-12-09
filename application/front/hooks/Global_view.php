<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_view {
    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function index() {
        $this->CI->load->model('conf/conf_model');
        $seo = $this->CI->conf_model->get_conf('seo');
        $seo = unserialize($seo);
        $view['seo'] = $seo;
        $footer = $this->CI->conf_model->get_conf('footer');
        $view['footer'] = $footer;

        $this->CI->load->model('content/type_model');
        $menu = $this->CI->type_model->front_get_menu();
        $view['menu'] = $menu;

        $this->CI->config->set_item('view', $view);
    }
}