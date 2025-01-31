<?php
class Jadwal_Perkuliahan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }
        $this->load->model('Jadwal_Perkuliahan_Model');
        $this->load->library('form_validation');
        $this->load->library('pagination'); // Make sure this is loaded
    }


    public function index($page = 0) {
        $user_id = $this->session->userdata('id_user');
        $role = $this->session->userdata('role');

        // Configuration for first table pagination
        $config['base_url'] = base_url('Jadwal_Perkuliahan/index');
        $config['total_rows'] = $this->Jadwal_Perkuliahan_Model->getTotalRows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        
        // Bootstrap 4 pagination styles
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        // Get paginated data
        $data['jadwal'] = $this->Jadwal_Perkuliahan_Model->getAllDataPaginated($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        
        // Get other required data
        $data['kelas'] = $this->Jadwal_Perkuliahan_Model->getKelas();
        $data['matkul'] = $this->Jadwal_Perkuliahan_Model->getMatkul();
        $data['hari'] = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum`at', 'Sabtu'];
        $data['is_admin'] = ($role === 'admin');

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('jadwal_perkuliahan/index', $data);
        $this->load->view('template/footer');
    }

    // Other methods remain the same but add role checks
    public function validation_form() {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('sesi', 'Sesi', 'required|numeric');
        $this->form_validation->set_rules('durasi', 'Durasi', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Jadwal_Perkuliahan');
        } else {
            $result = $this->Jadwal_Perkuliahan_Model->tambah_data();
            if ($result) {
                $this->session->set_flashdata('flash_jadwal', 'Disimpan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data');
            }
            redirect('Jadwal_Perkuliahan');
        }
    }

    public function hapus($id) {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('dashboard');
        }

        $this->db->where('id_jadwal', $id);
        $this->db->delete('jadwal_perkuliahan');
        $this->session->set_flashdata('flash_jadwal', 'Dihapus');
        redirect('Jadwal_Perkuliahan');
    }

    public function get_jadwal_per_jurusan($hari, $page = 0) {
        // Pagination configuration
        $config['base_url'] = base_url("Jadwal_Perkuliahan/get_jadwal_per_jurusan/$hari");
        $config['total_rows'] = $this->Jadwal_Perkuliahan_Model->getTotalRowsPerJurusan($hari);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        
        // Bootstrap 4 Pagination Style
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';
        
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        
        $config['attributes'] = array('class' => 'page-link');
        
        $this->pagination->initialize($config);
    
        // Get paginated data
        $data = array(
            'jadwal' => $this->Jadwal_Perkuliahan_Model->getJadwalPerJurusanPaginated($hari, $config['per_page'], $page),
            'pagination' => $this->pagination->create_links()
        );
    
        // Set proper JSON header
        header('Content-Type: application/json');
        echo json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        exit;
    }
}
