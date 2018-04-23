<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->model('m_mahasiswa');
	}

	function index() {
		$data['isi'] = "mahasiswa/index";

		$this->load->view("template/template", $data);
	}

    function tambah() {
        $npm = $this->input->post('npm');
        $nama = $this->input->post('nama');
        $tanggal_lahir = $this->input->post('tanggal_lahir');

        if ($npm == '') {
            $result['pesan'] = "NPM Harus Diisi !!!";
        } elseif ($nama == '') {
            $result['pesan'] = "Nama Harus Diisi !!!";
        } elseif ($tanggal_lahir == '') {
            $result['pesan'] = "Tanggal Lahir Harus Diisi !!!";
        } else {
            $result['pesan'] = "";

            $data['npm'] = $npm;
            $data['nama'] = $nama;
            $data['tanggal_lahir'] = $tanggal_lahir;

            $last_id = $this->m_mahasiswa->tambah($data);

            if (!empty($_FILES['file'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/mahasiswa/' . $last_id);
            }
        }

        echo json_encode($result);
    }

    function ubah() {
        $id = $this->input->post('id');
        $npm = $this->input->post('npm');
        $nama = $this->input->post('nama');
        $tanggal_lahir = $this->input->post('tanggal_lahir');

        if ($id == '') {
            $result['pesan'] = "ID Kosong !!!";
        } elseif ($npm == '') {
            $result['pesan'] = "NPM Harus Diisi !!!";
        } elseif ($nama == '') {
            $result['pesan'] = "Nama Harus Diisi !!!";
        } elseif ($tanggal_lahir == '') {
            $result['pesan'] = "Tanggal Lahir Harus Diisi !!!";
        } else {
            $result['pesan'] = "";

            $data['npm'] = $npm;
            $data['nama'] = $nama;
            $data['tanggal_lahir'] = $tanggal_lahir;

            $where['id'] = $id;

            $this->m_mahasiswa->ubah($data, $where);

            if (!empty($_FILES['file'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/mahasiswa/' . $id);
            }
        }

        echo json_encode($result);
    }

    function hapus() {
        $id = $this->input->post('id');

        $where['id'] = $id;

        $this->m_mahasiswa->hapus($where);
        
        $result['pesan'] = "";
        echo json_encode($result);
    }

    function ambil_id() {
        $id = $this->input->post('id');
        echo json_encode($this->m_mahasiswa->ambil_id($id));
    }

	function ajax() {
		$var['table'] = 'mahasiswa';
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
            $img = 'uploads/mahasiswa/' . $item->id;
            $row[] = '<img src="' . $img . '" width="100px" height="100px">';
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
