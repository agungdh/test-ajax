<?php
class M_mahasiswa_nofile extends CI_Model{	 
    public function __construct()
    {
        parent::__construct();
    }

    function tambah($data) {
        $this->db->insert('mahasiswa', $data);
        return $this->db->insert_id();
    }

    function ambil_id($id) {
        $where['id'] = $id;
        return $this->db->get_where('mahasiswa', $where)->row();
    }

    function ubah($data, $where) {
        $this->db->update('mahasiswa', $data, $where);
    }

    function hapus($where) {
        $this->db->delete('mahasiswa', $where);
    }
 
}