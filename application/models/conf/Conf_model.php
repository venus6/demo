<?php
class Conf_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_conf($name) {
        $query = $this->db->query("select value from {$this->db->dbprefix('conf')} where name='{$name}'");
        $rs = $query->row_array();

        return $rs['value'];
    }

    public function set_conf($name, $value) {
        $query = $this->db->update('conf', array('value'=>$value), "name='" . $name . "'");
        return $query;
    }

    public function pagination_url_link_list($page, $filter, $per_page) {
        $where = "1 and type_id={$filter['type_id']} ";
        $order_by = ' order by sort ';
        $back = array();
        $sql = " from {$this->db->dbprefix('content')} where {$where} ";
        $query = $this->db->query("select count(*) as num {$sql}");
        $rs_total = $query->row_array();
        $back['total_rows'] = $rs_total['num'];

        $limit_start = ($page - 1) * $per_page;
        $query2 = $this->db->query("select * {$sql} {$order_by} limit {$limit_start}, {$per_page}");
        $rs_list = $query2->result_array();
        $back['list'] = $rs_list;

        return $back;
    }

    public function add_url_link($arr) {
        $arr['add_time'] = date('Y-m-d H:i:s');
        $arr['update_time'] = $arr['add_time'];
        $query = $this->db->insert('content', $arr);
        return $query;
    }

    public function edit_url_link($id, $arr) {
        $arr['update_time'] = date('Y-m-d H:i:s');
        $query = $this->db->update('content', $arr, 'id=' . $id);
        return $query;
    }
}