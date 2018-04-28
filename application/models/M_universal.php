<?php
class M_universal extends CI_Model{	 
    public function __construct()
    {
        parent::__construct();
    }

    function tambah($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function ambil_where($table, $where) {
        return $this->db->get_where($table, $where)->row();
    }

    function ubah($table, $data, $where) {
        $this->db->update($table, $data, $where);
    }

    function hapus($table, $where) {
        $this->db->delete($table, $where);
    }
 
}