<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_nofile extends CI_Controller {
    var $table;
    var $result;

	function __construct(){
		parent::__construct();
        $this->load->model('m_universal');

        $this->table = "mahasiswa_nofile";
        $this->result['status'] = "ok";
	}

	function index() {
		$data['isi'] = "mahasiswa_nofile/index";

		$this->load->view("template/template", $data);
	}

    function tambah() {
        foreach ($this->input->post('data') as $key => $value) {
            $data[$key] = $value;
        }

        $last_id = $this->m_universal->tambah($this->table, $data);

        echo json_encode($this->result);
    }

    function ubah() {
        foreach ($this->input->post('data') as $key => $value) {
            $data[$key] = $value;
        }

        foreach ($this->input->post('where') as $key => $value) {
            $where[$key] = $value;
        }

        $this->m_universal->ubah($this->table, $data, $where);

        echo json_encode($this->result);
    }

    function hapus() {
        $id = $this->input->post('id');

        $where['id'] = $id;

        $this->m_universal->hapus($this->table, $where);
        
        $result['pesan'] = "";
        echo json_encode($result);
    }

    function ambil_id() {
        foreach ($this->input->post('where') as $key => $value) {
            $where[$key] = $value;
        }

        echo json_encode($this->m_universal->ambil_where($this->table, $where));
    }

	function ajax() {
		$var['table'] = $this->table;
	    $var['column_order'] = array(null, 'npm', 'nama', 'tanggal_lahir');
	    $var['column_search'] = array('npm', 'nama', 'tanggal_lahir');
	    $var['order'] = array('id' => 'asc');
		
		$list = $this->m_ajax->get_datatables($var);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->npm;
            $row[] = $item->nama;
            $row[] = $this->pustaka->tanggal_indo_string($item->tanggal_lahir);
            $ubah = 'submit("' . "ubah" . '", "' . $item->id . '")';
            $hapus = 'hapus("' . $item->id . '")';
            $row[] = "<a class='btn btn-info' data-toggle='modal' data-target='#form' onclick='" . $ubah . "'><i class='fa fa-pencil'></i></a>
                      <a class='btn btn-danger' onclick='" . $hapus . "'><i class='fa fa-trash'></i></a>";
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_ajax->count_all($var),
                        "recordsFiltered" => $this->m_ajax->count_filtered($var),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}


}
