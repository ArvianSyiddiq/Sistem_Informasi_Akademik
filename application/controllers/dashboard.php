<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('id_user')) {
			redirect('Login');
		}
		$this->load->model('M_mhs');
		$this->load->model('Jurusan_Model');
		$this->load->model('Kelas_Model');
		$this->load->model('Jadwal_Perkuliahan_Model');
	}
	public function index()
	{
		$data = [
			'Mahasiswa' => count($this->M_mhs->getAllMahasiswa()),
            'Dosen' => count($this->M_mhs->getAllDosen()),
			'Jurusan' => count($this->Jurusan_Model->getAllData(true)),
			'Kelas' => count($this->Kelas_Model->getAllData()),
			'Jadwal' => count($this->Jadwal_Perkuliahan_Model->getAllData())
            
		];
		$this->load->view("template/header");
		$this->load->view("template/sidebar");
		$this->load->view("index", $data);
		$this->load->view("template/footer");
	}
}
