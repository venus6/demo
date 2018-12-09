<?php
class Priv_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function pagination_priv_list($page, $filter, $per_page) {
        $where = '1 ';
        if (isset($filter['name']) && $filter['name'] != '') {
            $where .= " and name like '%" . $filter['name'] . "%' ";
        }
        $back = array();
        $sql = " from {$this->db->dbprefix('priv')} where {$where} ";
        $query = $this->db->query("select count(*) as num {$sql}");
        $rs_total = $query->row_array();
        $back['total_rows'] = $rs_total['num'];

        $limit_start = ($page - 1) * $per_page;
        $query2 = $this->db->query("select * {$sql} limit {$limit_start}, {$per_page}");
        $rs_list = $query2->result_array();
        $back['list'] = $rs_list;

        return $back;
    }

    public function del($id) {
        $query = $this->db->delete('priv', array('id' => $id));
        return $query;
    }

    public function insert($arr){
        if($arr['p_id'] == 0) {
            $top_id = 0;
        } else {
            $query = $this->db->query("select id,p_id from {$this->db->dbprefix('priv')} where id={$arr['p_id']} and display='1'");
            $rs = $query->row_array();
            if($rs['p_id'] == 0) {
                $top_id = $rs['id'];
            } else {
                $top_id = $rs['p_id'];
            }
        }
        $arr['top_id'] = $top_id;
        $query = $this->db->insert('priv', $arr);
        return $query;
    }

    public function update($id, $arr) {
        if($arr['p_id'] == 0) {
            $top_id = 0;
        } else {
            $query = $this->db->query("select id,p_id from {$this->db->dbprefix('priv')} where id={$arr['p_id']} and display='1'");
            $rs = $query->row_array();
            if($rs['p_id'] == 0) {
                $top_id = $rs['id'];
            } else {
                $top_id = $rs['p_id'];
            }
        }
        $arr['top_id'] = $top_id;
        $query = $this->db->update('priv', $arr, 'id=' . $id);
        return $query;
    }

    public function get_info($id){
        $query = $this->db->query("select * from {$this->db->dbprefix('priv')} where id=" . $id);
        return $query->row_array();
    }

    public function menu_list() {
        $query = $this->db->query("select * from {$this->db->dbprefix('priv')} where p_id=0 and display='1' order by orders");
        $rs = $query->result_array();
        if(empty($rs)) {
            return $rs;
        } else {
            $rs_count = count($rs);
            for($i = 0; $i < $rs_count; $i++) {
                $menu[$i] = $rs[$i];
                $query2 = $this->db->query("select * from {$this->db->dbprefix('priv')} where p_id={$rs[$i]['id']} and display='1' order by orders");
                $rs2 = $query2->result_array();
                $menu[$i]['child'] = $rs2;
            }
            return $menu;
        }
    }

    public function get_priv($p_id) {
        $query = $this->db->query("select id,p_id,name from {$this->db->dbprefix('priv')} where id={$p_id}");
        return $query->row_array();
    }

    public function priv_list(){
        $query = $this->db->query("select * from {$this->db->dbprefix('priv')} where p_id=0 and display='1' order by orders");
        $rs = $query->result_array();
        $rs_count = count($rs);
        for($i = 0; $i < $rs_count; $i++) {
            $menu[$i] = $rs[$i];
            $query2 = $this->db->query("select * from {$this->db->dbprefix('priv')} where p_id={$rs[$i]['id']} and display='1' order by orders");
            $rs2 = $query2->result_array();
            $menu[$i]['second'] = $rs2;
        }

        return $menu;
    }
}