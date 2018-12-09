<?php
class Message_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function pagination_message_list($page, $filter, $per_page) {
        $where = '1 ';
        $order_by = '';
        if (isset($filter['name']) && $filter['name'] != '') {
            $where .= " and name like '%" . $filter['name'] . "%' ";
        }
        if (isset($filter['finish']) && $filter['finish'] != '') {
            $where .= " and finish='" . $filter['finish'] . "' ";
        }
        $back = array();
        $sql = " from {$this->db->dbprefix('message')} where {$where} ";
        $query = $this->db->query("select count(*) as num {$sql}");
        $rs_total = $query->row_array();
        $back['total_rows'] = $rs_total['num'];

        $limit_start = ($page - 1) * $per_page;
        $query2 = $this->db->query("select * {$sql} {$order_by} limit {$limit_start}, {$per_page}");
        $rs_list = $query2->result_array();
        $back['list'] = $rs_list;

        return $back;
    }

    public function del($id) {
        $query = $this->db->delete('message', array('id' => $id));
        return $query;
    }

    public function get_info($id) {
        $query = $this->db->query("select * from {$this->db->dbprefix('message')} where id={$id}");
        return $query->row_array();
    }

    public function sign_finish($id) {
        $query = $this->db->update('message', array('finish'=>'yes'), 'id=' . $id);
        return $query;
    }

    /*---- front ----*/
    public function add_message($arr) {
        $arr['add_time'] = date('Y-m-d H:i:s');
        $query = $this->db->insert('message', $arr);
        return $query;
    }
}