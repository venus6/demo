<?php
class Test_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_news($id = 0) {
        $query = $this->db->get('ce_content_type');

        if ($id == 0) {
            $query = $this->db->get('ce_content_type');
            return $query->result_array();
        }

        $query = $this->db->get_where('ce_content_type', array('id' => $id));
        return $query->row_array();
    }

    public function view($slug = NULL) {
        $data['news_item'] = $this->news_model->get_news($slug);
    }

    public function insert_data() {
        $arr = array('name'=>'test', 'value'=>'content');
        $rs = $this->db->insert('ce_conf', $arr);
    }
}