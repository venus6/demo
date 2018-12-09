<?php
class Operator_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function check_priv($roles, $directory, $class, $method) {
        $roles_arr = explode(',', $roles);
        $count_roles_arr = count($roles_arr);
        for($i = 0; $i < $count_roles_arr; $i++) {
            $query = $this->db->query("select priv from {$this->db->dbprefix('roles')} where id=" . $roles_arr[$i]);
            $roles_info = $query->row_array();
            $priv_str .= $roles_info['priv'] . ',';
        }

        if($method == 'index') {
            $priv = $directory . $class;
        } else {
            $priv = $directory . $class . '/' . $method;
        }

        //echo $priv;exit;
        $query2 = $this->db->query("select * from {$this->db->dbprefix('priv')} where module='{$priv}'");
        $rs = $query2->row_array();
        if($rs) {
            if(strpos(',' . $priv_str, ',' . $rs['p_id'] . ',') === FALSE) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    function show_menu($roles, $directory, $class, $method, $supper){
        if($supper) {
            $query = $this->db->query("select id,name from {$this->db->dbprefix('priv')} where top_id=0 and display='1' order by orders");
            $rs = $query->result_array();
            $menu_top = $rs;
            $count_rs = count($rs);
            for($i = 0; $i < $count_rs; $i++) {
                $query_group = $this->db->query("select * from {$this->db->dbprefix('priv')} where p_id={$rs[$i]['id']} and top_id={$rs[$i]['id']} and display='1' order by orders");
                $rs_group = $query_group->row_array();
                if($rs_group) {
                    $query2 = $this->db->query("select * from {$this->db->dbprefix('priv')} where p_id={$rs_group['id']} and top_id={$rs[$i]['id']} and display='1' order by orders");
                    $rs2 = $query2->row_array();
                    $rs[$i]['left'][]['module'] = $rs2['module'];
                }
            }
            $menu_top = $rs;
        } else {
            $roles_arr = explode(',', $roles);
            $count_roles_arr = count($roles_arr);
            for($i = 0; $i < $count_roles_arr; $i++) {
                $query = $this->db->query("select priv from {$this->db->dbprefix('roles')} where id={$roles_arr[$i]}");
                $roles_info = $query->row_array();
                $priv_str .= $roles_info['priv'] . ',';
            }
            $priv_str = trim($priv_str, ',');
            $priv_arr = explode(',', $priv_str);
            $priv_arr = array_unique($priv_arr);
            sort($priv_arr);
            //var_dump($priv_arr);exit;
            $count_priv_arr = count($priv_arr);
            for($i = 0; $i < $count_priv_arr; $i++) {
                $rs = $this->db->query("select * from {$this->db->dbprefix('priv')} where id={$priv_arr[$i]} and display='1'")->row_array();
                $rs2 = $this->db->query("select * from {$this->db->dbprefix('priv')} where id={$rs['top_id']} and display='1'")->row_array();
                $rs3 = $this->db->query("select * from {$this->db->dbprefix('priv')} where p_id={$rs['id']} and display='1' order by orders")->row_array();
                $menu_top[$rs['top_id']]['id'] = $rs['top_id'];
                $menu_top[$rs['top_id']]['name'] = $rs2['name'];
                $menu_top[$rs['top_id']]['left'][]['module'] = $rs3['module'];
            }
            $menu_top = array_values($menu_top);
        }
        $menu_arr['menu_top'] = $menu_top;

        if($directory == '') {
        } else {
            $priv = $directory . $class;
            $rs = $this->db->query("select * from {$this->db->dbprefix('priv')} where module like '{$priv}%'")->row_array();
            $menu_top_id = $rs['top_id'];
            $menu_arr['menu_top_id'] = $menu_top_id;

            if($supper) {
                $rs = $this->db->query("select id from {$this->db->dbprefix('priv')} where p_id={$menu_top_id} and display='1' order by orders")->result_array();
                $left = v_db_get_column_arr($rs, 'id');
            } else {
                for($i = 0; $i < $count_priv_arr; $i++) {
                    $rs = $this->db->query("select * from {$this->db->dbprefix('priv')} where id={$priv_arr[$i]} and display='1'")->row_array();
                    if($rs['top_id'] == $menu_top_id) {
                        $left[] = $priv_arr[$i];
                    }
                }
            }
            $count_left = count($left);
            for($i = 0; $i < $count_left; $i++) {
                $menu_left[$i]['group']['id'] = $left[$i];
                $rs = $this->db->query("select * from {$this->db->dbprefix('priv')} where id={$left[$i]}")->row_array();
                $menu_left[$i]['group']['name'] = $rs['name'];
                $rs2 = $this->db->query("select * from {$this->db->dbprefix('priv')} where p_id={$left[$i]} order by orders")->result_array();
                $menu_left[$i]['child'] = $rs2;
            }
            $menu_arr['menu_left'] = $menu_left;
            if($method == 'index') {
                $menu_arr['menu_left_module'] = $directory . $class;
            } else {
                $menu_arr['menu_left_module'] = $directory . $class . '/' . $method;
            }

        }
        return $menu_arr;
    }

    public function check_op_status($name){
        $query = $this->db->query("select status from {$this->db->dbprefix('operators')} where name='{$name}'");
        $rs = $query->row_array();
        if ($rs['status'] == 1){
            return true;
        } else{
            return false;
        }
    }

    public function check_pwd($id, $pwd) {
        $query = $this->db->query("select pwd from {$this->db->dbprefix('operators')} where id=" . $id);
        $rs = $query->row_array();
        $current_pwd = $rs['pwd'];
        if (!$current_pwd){
            return false;
        } else{
            return ($current_pwd == md5($pwd));
        }
    }

    public function check_name($name) {
        $query = $this->db->query("select id from {$this->db->dbprefix('operators')} where name='{$name}'");
        return $query->row_array();
    }

    public function get_info($id) {
        $query = $this->db->query("select * from {$this->db->dbprefix('operators')} where id=" . $id);
        return $query->row_array();
    }

    public function get_info_by_name($name) {
        $query = $this->db->query("select * from {$this->db->dbprefix('operators')} where name='{$name}'");
        return $query->row_array();
    }

    public function update($id, $arr) {
        $query = $this->db->update('operators', $arr, 'id=' . $id);
        return $query;
    }

    public function insert($arr) {
        $query = $this->db->insert('operators', $arr);
        return $query;
    }

    public function del($id) {
        $query = $this->db->delete('operators', array('id' => $id));
        return $query;
    }

    public function pagination_operator_list($page, $filter, $per_page) {
        $where = '1 and supper!=8 ';
        if (isset($filter['name']) && $filter['name'] != '') {
            $where .= " and name like '%" . $filter['name'] . "%' ";
        }
        $back = array();
        $sql = " from {$this->db->dbprefix('operators')} where {$where} ";
        $query = $this->db->query("select count(*) as num {$sql}");
        $rs_total = $query->row_array();
        $back['total_rows'] = $rs_total['num'];

        $limit_start = ($page - 1) * $per_page;
        $query2 = $this->db->query("select * {$sql} limit {$limit_start}, {$per_page}");
        $rs_list = $query2->result_array();
        $back['list'] = $rs_list;

        return $back;
    }
}