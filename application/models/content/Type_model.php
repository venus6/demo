<?php
class Type_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function pagination_column_list($page, $filter, $per_page) {
        $where = '1 and p_id=0 ';
        $order_by = ' order by sort ';
        $back = array();
        $sql = " from {$this->db->dbprefix('content_type')} where {$where} ";
        $query = $this->db->query("select count(*) as num {$sql}");
        $rs_total = $query->row_array();
        $back['total_rows'] = $rs_total['num'];

        $limit_start = ($page - 1) * $per_page;
        $query2 = $this->db->query("select * {$sql} {$order_by} limit {$limit_start}, {$per_page}");
        $rs_list = $query2->result_array();
        $back['list'] = $rs_list;

        return $back;
    }

    public function add_type($arr){
        $query = $this->db->insert('content_type', $arr);
        return $query;
    }

    public function edit_type($id, $arr){
        $query = $this->db->update('content_type', $arr, 'id=' . $id);
        return $query;
    }

    public function get_info($id){
        $query = $this->db->query("select * from {$this->db->dbprefix('content_type')} where id={$id}");
        return $query->row_array();
    }

    public function pagination_type_list($page, $filter, $per_page) {
        $where = '1 and p_id=' . $filter['type_id'];
        $order_by = ' order by sort ';
        $back = array();
        $sql = " from {$this->db->dbprefix('content_type')} where {$where} ";
        $query = $this->db->query("select count(*) as num {$sql}");
        $rs_total = $query->row_array();
        $back['total_rows'] = $rs_total['num'];

        $limit_start = ($page - 1) * $per_page;
        $query2 = $this->db->query("select * {$sql} {$order_by} limit {$limit_start}, {$per_page}");
        $rs_list = $query2->result_array();
        $back['list'] = $rs_list;

        return $back;
    }

    public function edit_sort($id, $sort) {
        $query = $this->db->update('content_type', array('sort'=>$sort), 'id=' . $id);
        return $query;
    }

    public function del_type($id) {
        $this->db->trans_begin();

        $query = $this->db->delete('content_type', array('id' => $id));
        if(!$query) {
            $this->db->trans_rollback();
            return false;
        }
        $query2 = $this->db->delete('content', array('type_id' => $id));
        if(!$query2) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return true;
    }

    public function get_sub_list($p_id) {
        $query = $this->db->query("select * from {$this->db->dbprefix('content_type')} where p_id='{$p_id}' order by sort");
        $rs = $query->result_array();
        return $rs;
    }

    public function get_url_link_list_type_id() {
        $query = $this->db->query("select id from {$this->db->dbprefix('content_type')} where fun_type='url_link_list'");
        $rs = $query->row_array();
        return $rs['id'];
    }

    /*---- front ----*/
    public function front_get_menu() {
        $this->load->model('content/content_model');

        $query = $this->db->query("select * from {$this->db->dbprefix('content_type')} where p_id=0 and display='show' order by sort");
        $top_arr = $query->result_array();
        $count_top_arr = count($top_arr);
        for($i = 0; $i < $count_top_arr; $i++) {
            $query2 = $this->db->query("select * from {$this->db->dbprefix('content_type')} where p_id={$top_arr[$i]['id']} and display='show' order by sort");
            $sub_arr = $query2->result_array();
            $top_arr[$i]['sub_menu'] = $sub_arr;
            if($top_arr[$i]['fun_type'] == 'content_list') {
                $content_list = $this->content_model->get_list_by_type_id($top_arr[$i]['id']);
                $top_arr[$i]['default_content_id'] = $content_list[0]['id'];
            }
            if($top_arr[$i]['fun_type'] == 'type_list') {
                $sub_type_list = $this->get_sub_list($top_arr[$i]['id']);
                $top_arr[$i]['default_type_id'] = $sub_type_list[0]['id'];
            }
        }
        return $top_arr;
    }
}