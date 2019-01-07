<?php
class Passport extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('conf/operator_model');
        $this->load->helper('auth');
    }

    public function login() {
        $data = array();

        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('name', 'pwd'));
            if ($post_arr['name'] == '') {
                redirect('passport/login?flag=2');
            }
            if ($post_arr['pwd'] == '') {
                redirect('passport/login?flag=3');
            }
            if(!$this->operator_model->check_op_status($post_arr['name'])){
                redirect('passport/login?flag=5');
            }
            if($this->set_login($post_arr['name'], md5($post_arr['pwd']))){
                redirect($this->router->default_controller);
            } else{
                redirect('passport/login?flag=4');
            }
        } else {
            $data['flag'] = $this->input->get('flag') ? $this->input->get('flag') : 0;
            $this->load->view('passport/login', $data);
        }
    }

    public function set_login($name, $pwd) {
        $user_info = $this->operator_model->get_info_by_name($name);
        if ($user_info['pwd'] == $pwd) {
            $this->config->set_item('auth_login', true);
            $this->config->set_item('auth_user_info', $user_info);
            $my_auth = auth_code($pwd . "\t" . $user_info['id'], 'ENCODE', md5($this->config->item('auth_key')));

            //update operators update_time
            if (!$this->operator_model->update($user_info['id'], array('update_time'=>date('Y-m-d H:i:s')))) {
                return false;
            }
            $cookie_name = $this->config->item('cookie_prefix') . 'auth';
            setcookie($cookie_name, $my_auth, time() + 1800, $this->config->item('cookie_path'), $this->config->item('cookie_domain'), false, true);

            return true;
        } else {
            return false;
        }
    }

    public function logout(){
        $cookie_name = $this->config->item('cookie_prefix') . 'auth';
        setcookie($cookie_name, '', - 86400, $this->config->item('cookie_path'), $this->config->item('cookie_domain'), false, true);

        redirect('passport/login?flag=1');
    }

    public function modify_pwd() {
        if ($this->input->method() == 'post') {
            $post_arr = $this->input->post(array('o_pwd', 'pwd', 'pwd2'));
            if ($post_arr['o_pwd'] == '') {
                v_show_tips(0, '请填写原始密码！');
            }
            if ($post_arr['pwd'] == '') {
                v_show_tips(0, '请填写新密码！');
            }
            if ($post_arr['pwd'] != $post_arr['pwd2']) {
                v_show_tips(0, '新密码两次输入不匹配！');
            }
            if($this->operator_model->check_pwd($this->config->item('auth_user_info')['id'], $post_arr['o_pwd'])){
                if ($this->operator_model->update($this->config->item('auth_user_info')['id'], array('pwd'=>md5($post_arr['pwd'])))) {
                    $this->set_login($this->config->item('auth_user_info')['name'], md5($post_arr['pwd']));

                    v_show_tips(1, '修改密码成功!', 'box');
                }
            }else{
                v_show_tips(0, '修改密码失败！原因：旧密码不正确!');
            }
        } else {
            $this->load->view('passport/modify_pwd');
        }
    }
}