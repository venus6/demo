<?php
class Content_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_info_by_type_id($type_id){
        $query = $this->db->query("select * from {$this->db->dbprefix('content')} where type_id={$type_id}");
        return $query->row_array();
    }

    public function get_info($id) {
        $query = $this->db->query("select * from {$this->db->dbprefix('content')} where id={$id}");
        return $query->row_array();
    }

    public function do_add_content($arr) {
        $arr['add_time'] = date('Y-m-d H:i:s');
        $arr['update_time'] = $arr['add_time'];
        $query = $this->db->insert('content', $arr);
        return $query;
    }

    public function do_edit_content($id, $arr) {
        $arr['update_time'] = date('Y-m-d H:i:s');
        $query = $this->db->update('content', $arr, 'id=' . $id);
        return $query;
    }

    public function pagination_content_list($page, $filter, $per_page) {
        $where = '1 ';
        if (isset($filter['type_id'])) {
            $where .= " and type_id={$filter['type_id']} ";
        }
        $back = array();
        $sql = " from {$this->db->dbprefix('content')} where {$where} order by sort,add_time desc ";
        $query = $this->db->query("select count(*) as num {$sql}");
        $rs_total = $query->row_array();
        $back['total_rows'] = $rs_total['num'];

        $limit_start = ($page - 1) * $per_page;
        $query2 = $this->db->query("select * {$sql} limit {$limit_start}, {$per_page}");
        $rs_list = $query2->result_array();
        $back['list'] = $rs_list;

        return $back;
    }

    public function del_content($id) {
        $query = $this->db->delete('content', array('id' => $id));
        return $query;
    }

    public function edit_sort($id, $sort) {
        $query = $this->db->update('content', array('sort'=>$sort), 'id=' . $id);
        return $query;
    }

    public function get_list_by_type_id($type_id) {
        $query = $this->db->query("select * from {$this->db->dbprefix('content')} where type_id='{$type_id}' order by sort");
        $rs = $query->result_array();
        return $rs;
    }

    public function add_click_count($id) {
        $query = $this->db->query("update {$this->db->dbprefix('content')} set click_count=click_count+1 where id={$id}");
        return $query;
    }
}