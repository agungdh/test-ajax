<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_welcome');
	}

	function ambil_limbah() {
		$data_limbah = "[";
		foreach ($this->db->get('limbah')->result() as $item) {
			$data_limbah .= '"' . $item->limbah . '"' . ", ";
		}
		$data_limbah .= "]";
		// echo json_encode($data);
		echo $data_limbah;
	}

	function index() {
		$halaman_utama = $this->session->level == 1 ? "template/halaman_utama_admin" : "template/halaman_utama_user";
		// $data['tahun'] = $this->input->get('tahun') ?: date('Y');
		$data['tahun_masuk'] = $this->input->get('tahun_masuk') ?: date('Y');
		$data['tahun_keluar'] = $this->input->get('tahun_keluar') ?: date('Y');
	
		$data['limbah'] = "[";
		foreach ($this->db->get('limbah')->result() as $item) {
			$data['limbah'] .= '"' . $item->limbah . '"' . ", ";
		}
		$data['limbah'] .= "]";

		$this->session->login != true ? $this->load->view("template/halaman_login") : $this->load->view('template/template',array("isi" => $halaman_utama, "data" => $data));
	}

	function aksi_login() {
		$data_user = $this->m_welcome->cek_login($this->input->post('username'), hash('sha512', $this->input->post('password')));
		if ($data_user != null) {
			
			$array_data_user = array(
				'id'  => $data_user->id,
				'username'  => $data_user->username,
				'nama'  => $data_user->nama,
				'level'  => $data_user->level,
				'login'  => true
			);

			if ($data_user->id_unit != null) {
				$array_data_user['id_unit'] = $data_user->id_unit;
				$array_data_user['unit'] = $this->m_welcome->ambil_unit_id($data_user->id_unit)->unit;			
			}

			$this->session->set_userdata($array_data_user);

			redirect(base_url());
		} else {
			redirect(base_url('?error=1'));
		}
	}
}
