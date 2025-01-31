<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_mhs');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function login() {
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password')); // Using MD5 as per your database

            // Check user credentials in tb_users
            $user = $this->db->get_where('tb_users', [
                'username' => $username,
                'password' => $password
            ])->row_array();

            if ($user) {
                // Set basic session data
                $session_data = [
                    'id_user' => $user['id_user'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'logged_in' => true
                ];

                // Add additional data based on role
                if ($user['role'] == 'mahasiswa') {
                    $mahasiswa = $this->db->get_where('tb_mhs', ['id_user' => $user['id_user']])->row_array();
                    if ($mahasiswa) {
                        $session_data['nim'] = $mahasiswa['nim'];
                        $session_data['id_jurusan'] = $mahasiswa['id_jurusan'];
                    }
                } elseif ($user['role'] == 'dosen') {
                    $dosen = $this->db->get_where('tb_dosen', ['id_user' => $user['id_user']])->row_array();
                    if ($dosen) {
                        $session_data['nik_nidn'] = $dosen['nik_nidn'];
                    }
                }

                $this->session->set_userdata($session_data);

                // Redirect based on role
                switch ($user['role']) {
                    case 'admin':
                        redirect('dashboard');
                        break;
                    case 'dosen':
                        redirect('Jadwal_Perkuliahan');
                        break;
                    case 'mahasiswa':
                        redirect('Jadwal_Perkuliahan');
                        break;
                    default:
                        redirect('Jadwal_Perkuliahan');
                }
            } else {
                $this->session->set_flashdata('error', 'Username atau Password salah!');
                redirect('auth/login');
            }
        } else {
            $this->load->view('auth/login');
        }
    }

    public function check_access() {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $allowed_roles = func_get_args();
        if (!empty($allowed_roles) && !in_array($this->session->userdata('role'), $allowed_roles)) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini');
            redirect('dashboard');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}