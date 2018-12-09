<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {
    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('conf/operator_model');
        $this->CI->load->helper('auth');
    }

    public function index() {
        //check cookie
        $cookie_name = $this->CI->config->item('cookie_prefix') . 'auth';
        if ($this->CI->input->cookie($cookie_name) !== NULL) {
            $auth = auth_code($this->CI->input->cookie($cookie_name), 'DECODE', md5($this->CI->config->item('auth_key')));
            $auth = explode("\t", $auth);
            $user_id = isset($auth[1]) ? $auth[1] : 0;
            $user_pwd = isset($auth[0]) ? $auth[0] : '';
            $user_info = $this->CI->operator_model->get_info($user_id);
            if (empty($user_info)) {
                $this->CI->config->set_item('auth_login', false);
            } else {
                if ($user_info['pwd'] == $user_pwd) {
                    $this->CI->config->set_item('auth_login', true);
                    $this->CI->config->set_item('auth_user_info', $user_info);
                } else {
                    $this->CI->config->set_item('auth_login', false);
                }
            }
        } else {
            $this->CI->config->set_item('auth_login', false);
        }

        //check is_login
        if ($this->CI->config->item('auth_login')) {
            if ($this->CI->router->directory == '' && $this->CI->router->class == 'passport' && $this->CI->router->method == 'login') {
                redirect($this->CI->router->default_controller);
            } else {
                //check priv
                if (!$user_info['supper']) {
                    $has_priv = $this->CI->operator_model->check_priv($user_info['roles'], $this->CI->router->directory, $this->CI->router->class, $this->CI->router->method);
                    if (!$has_priv) {
                        show_error('您没有权限访问本页!');
                    }
                }

                //show menu
                $menu_arr = $this->CI->operator_model->show_menu($user_info['roles'], $this->CI->router->directory, $this->CI->router->class, $this->CI->router->method, $user_info['supper']);
                $this->CI->config->set_item('menu_arr', $menu_arr);
            }
        } else {
            if (!($this->CI->router->directory == '' && $this->CI->router->class == 'passport' && $this->CI->router->method == 'login')) {
                redirect('passport/login');
            }
        }
    }
}