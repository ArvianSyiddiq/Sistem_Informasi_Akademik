<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataJurusan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); // Call the CI_Controller constructor
        $this->load->model('Jurusan_Model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['jurusan'] = $this->Jurusan_Model->getAllData();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('jurusan/index', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules("kode_jur", "Kode Jurusan", "required|max_length[20]|is_unique[tb_jurusan.kode_jurusan]");
        $this->form_validation->set_rules("nm_jur", "Nama Jurusan", "required|is_unique[tb_jurusan.nama_jurusan]");
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $this->Jurusan_Model->tambah_data();
            $this->session->set_flashdata('flash_jurusan', 'Disimpan');
            redirect('DataJurusan');
        }
    }

    public function hapus($id)
    {
        $this->Jurusan_Model->hapus_data($id);
        $this->session->set_flashdata('flash_jurusan', 'Dihapus');
        redirect('DataJurusan');
    }

    public function ubah($id)
    {
        $this->form_validation->set_rules("kode_jur", "Kode Jurusan");
        $this->form_validation->set_rules("nm_jur", "Nama Jurusan", "required");
        if ($this->form_validation->run() == FALSE) {
            $data['ubah'] = $this->Jurusan_Model->detail_data($id);
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('jurusan/ubah', $data);
            $this->load->view('template/footer');
        } else {
            $this->Jurusan_Model->ubah_data();
            $this->session->set_flashdata('flash_jurusan', 'DiUbah');
            redirect('DataJurusan');
        }
    }
}
