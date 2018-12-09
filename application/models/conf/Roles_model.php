<?php
class Roles_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function pagination_roles_list($page, $filter, $per_page) {
        $where = '1 ';
        if (isset($filter['name']) && $filter['name'] != '') {
            $where .= " and name like '%" . $filter['name'] . "%' ";
        }
        $back = array();
        $sql = " from {$this->db->dbprefix('roles')} where {$where} ";
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
        $query = $this->db->delete('roles', array('id' => $id));
        return $query;
    }

    public function insert($arr) {
        $arr['priv'] = implode(',', $arr['priv']);
        $query = $this->db->insert('roles', $arr);
        return $query;
    }

    public function update($id, $arr) {
        $arr['priv'] = implode(',', $arr['priv']);
        $query = $this->db->update('roles', $arr, 'id=' . $id);
        return $query;
    }

    public function get_info($id){
        $query = $this->db->query("select * from {$this->db->dbprefix('roles')} where id=" . $id);
        return $query->row_array();
    }

    public function get_list(){
        $query = $this->db->query("select * from {$this->db->dbprefix('roles')}");
        return $query->result_array();
    }
}