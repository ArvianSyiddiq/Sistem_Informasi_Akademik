<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataKelas extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kelas_Model');
        $this->load->model('M_mhs');
        $this->load->library('form_validation');
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $user_id = $this->session->userdata('id_user');
        $role = $this->session->userdata('role');

        // Get classes based on user role
        if ($role === 'admin') {
            $data['kelas'] = $this->Kelas_Model->getAllData();
        } else {
            $data['kelas'] = $this->Kelas_Model->getKelasByUser($user_id, $role);
        }

        $data['jurusan'] = $this->db->get('tb_jurusan')->result();
        $data['matkul'] = $this->Kelas_Model->getAllMatkul();
        $data['available_students'] = $this->db->get('tb_mhs')->result();
        $data['enrolled_students'] = []; // Initialize the variable to avoid undefined variable error   
        $data['dosen'] = $this->db->get('tb_dosen')->result();
        
        
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('kelas/index', $data);
        $this->load->view('template/footer');
    }

    public function getAvailableMahasiswa() {
        $id_kelas = $this->input->post('id_kelas');
        $kelas = $this->Kelas_Model->detail_data($id_kelas);
        $mahasiswa = $this->Kelas_Model->x($kelas['id_jurusan']);
        echo json_encode($mahasiswa);
    }

    // Add mahasiswa to kelas (admin only)
    public function addMahasiswa($id_kelas) {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('dashboard');
        }

        $nim_array = $this->input->post('nim');
        if ($this->Kelas_Model->addMahasiswaToKelas($id_kelas, $nim_array)) {
            $this->session->set_flashdata('success', 'Mahasiswa berhasil ditambahkan ke kelas');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan mahasiswa ke kelas');
        }
        redirect('DataKelas');
    }

    // Assign dosen to kelas (admin only)
    public function assignDosen() {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('dashboard');
        }

        $id_kelas = $this->input->post('id_kelas');
        $nik_nidn = $this->input->post('nik_nidn');

        if ($this->Kelas_Model->assignDosen($id_kelas, $nik_nidn)) {
            $this->session->set_flashdata('success', 'Dosen berhasil ditugaskan ke kelas');
        } else {
            $this->session->set_flashdata('error', 'Gagal menugaskan dosen ke kelas');
        }
        redirect('DataKelas');
    }

    // View class details including enrolled students and assigned dosen
    public function view($id_kelas) {
        $data['kelas'] = $this->Kelas_Model->detail_data($id_kelas);
        $data['mahasiswa'] = $this->Kelas_Model->getMahasiswaInKelas($id_kelas);
        $data['dosen'] = $this->db->get_where('tb_dosen', 
            ['nik_nidn' => $data['kelas']['id_dosen']])->row();
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('kelas/view', $data);
        $this->load->view('template/footer');
    }

    public function manage_students($id_kelas)
    {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('dashboard');
        }
    
        $data['jurusan'] = $this->db->get('tb_jurusan')->result();
        $data['matkul'] = $this->Kelas_Model->getAllMatkul();
        $data['dosen'] = $this->db->get('tb_dosen')->result();
        $data['kelas'] = $this->Kelas_Model->detail_data($id_kelas);
        $data['enrolled_students'] = $this->Kelas_Model->getMahasiswaInKelas($id_kelas);
        
        // Get mahasiswa from the same jurusan as the kelas
        $data['available_students'] = $this->Kelas_Model->getAvailableMahasiswaByJurusan($data['kelas']['id_jurusan']);
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('kelas/manage_students', $data);
        $this->load->view('template/footer');
    }

    public function add_students()
    {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('dashboard');
        }

        $id_kelas = $this->input->post('id_kelas');
        $selected_students = $this->input->post('students');

        if ($selected_students) {
            $this->Kelas_Model->addMahasiswaToKelas($id_kelas, $selected_students);
            $this->session->set_flashdata('success', 'Students added successfully');
        }

        redirect('DataKelas/manage_students/' . $id_kelas);
    }

    public function remove_student($id_kelas, $nim)
    {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('dashboard');
        }

        $this->Kelas_Model->removeMahasiswaFromKelas($id_kelas, $nim);
        $this->session->set_flashdata('success', 'Student removed successfully');
        redirect('DataKelas/manage_students/' . $id_kelas);
    }

    public function assign_dosen()
    {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('dashboard');
        }

        $id_kelas = $this->input->post('id_kelas');
        $nik_nidn = $this->input->post('nik_nidn');

        $this->Kelas_Model->assignDosen($id_kelas, $nik_nidn);
        $this->session->set_flashdata('success', 'Lecturer assigned successfully');
        redirect('DataKelas');
    }

    public function tambah_matkul()
    {
        $this->form_validation->set_rules('new_id_jur', 'Jurusan', 'required');
        $this->form_validation->set_rules('new_kelas', 'Kelas', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
        } else {
            $data = [
                "id_jurusan" => $this->input->post('new_id_jur', true),
                "nama_matkul" => $this->input->post('new_kelas', true)
            ];
            $id_matkul = $this->Kelas_Model->tambah_matkul($data);
            echo json_encode(['status' => 'success', 'id_matkul' => $id_matkul, 'nama_matkul' => $data['nama_matkul']]);
        }
    }

    public function hapus($id_kelas) {
        // Delete related rows in jadwal_perkuliahan
        $this->db->where('id_kelas', $id_kelas);
        $this->db->delete('jadwal_perkuliahan');
    
        // Delete the row in tb_kelas
        $this->db->where('id_kelas', $id_kelas);
        $this->db->delete('tb_kelas');
    
        $this->session->set_flashdata('flash_kelas', 'Dihapus');
        redirect('DataKelas');
    }

    public function ubah($id)
    {
        $this->form_validation->set_rules("id_jur", "Jurusan", "required");
        $this->form_validation->set_rules("nm_kelas", "Nama Kelas", "required");

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('DataKelas');
        } else {
            $data = [
                "id_jurusan" => $this->input->post('id_jur', true),
                "nama_kelas" => $this->input->post('nm_kelas', true)
            ];
            $this->Kelas_Model->ubah_data($data, $id);
            $this->session->set_flashdata('flash_kelas', 'Diubah');
            redirect('DataKelas');
        }
    }

    public function getKelasByJurusan()
    {
        $id_jurusan = $this->input->post('id_jurusan');
        $this->db->select('id_matkul, nama_matkul');
        $this->db->from('tb_matkul');
        $this->db->where('id_jurusan', $id_jurusan);
        $query = $this->db->get();
        echo json_encode($query->result_array());
    }

    public function validation_form()
    {
        $this->form_validation->set_rules("id_jur", "Jurusan", "required");
        $this->form_validation->set_rules("kelas", "Kelas", "required");
        $this->form_validation->set_rules("nm_kelas", "Nama Kelas", "required");
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                "id_jurusan" => $this->input->post('id_jur', true),
                "id_matkul" => $this->input->post('kelas', true),
                "nama_kelas" => $this->input->post('nm_kelas', true)
            ];
            $this->Kelas_Model->tambah_data($data);
            $this->session->set_flashdata('flash_kelas', 'Disimpan');
            redirect('DataKelas');
        }
    }

    public function addNewKelas()
    {
        $this->form_validation->set_rules("new_id_jur", "Jurusan", "required");
        $this->form_validation->set_rules("new_kelas", "Kelas", "required");
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
        } else {
            $data = [
                "id_jurusan" => $this->input->post('new_id_jur', true),
                "nama_matkul" => $this->input->post('new_kelas', true)
            ];
            $id_matkul = $this->Kelas_Model->tambah_matkul($data);
            echo json_encode(['status' => 'success', 'id_matkul' => $id_matkul, 'nama_matkul' => $data['nama_matkul']]);
        }
    }
}