<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Universal extends CI_Controller {
    var $result;

	function __construct(){
		parent::__construct();
        $this->load->model('m_universal');

        $this->result['status'] = "ok";
	}

	function index($table) {
		$data['isi'] = "universal/index";
        $data['data']['table'] = $table;

		$this->load->view("template/template", $data);
	}

    function tambah($table) {
        foreach ($this->input->post('data') as $key => $value) {
            $data[$key] = $value;
        }

        $last_id = $this->m_universal->tambah($table, $data);

        echo json_encode($this->result);
    }

    function ubah($table) {
        foreach ($this->input->post('data') as $key => $value) {
            $data[$key] = $value;
        }

        foreach ($this->input->post('where') as $key => $value) {
            $where[$key] = $value;
        }

        $this->m_universal->ubah($table, $data, $where);

        echo json_encode($this->result);
    }

    function hapus($table) {
        foreach ($this->input->post('where') as $key => $value) {
            $where[$key] = $value;
        }

        $this->m_universal->hapus($table, $where);
        
        echo json_encode($this->result);
    }

    function ambil_where($table) {
        foreach ($this->input->post('where') as $key => $value) {
            $where[$key] = $value;
        }

        echo json_encode($this->m_universal->ambil_where($table, $where));
    }

	function ajax($table) {
		$var['table'] = $table;

        $var['column_order'][] = null;
        foreach ($this->db->query("SHOW COLUMNS FROM " . $table . " WHERE Field != 'id'")->result() as $item) {
           $var['column_order'][] = $item->Field;  
           $var['column_search'][] = $item->Field;  
         }
	    
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

    function test($table) {
        var_dump($this->db->query("SHOW COLUMNS FROM " . $table . " WHERE Field != 'id'")->result());
    }

}
