<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profile_model');
        $this->load->model('M_mhs');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function index()
    {
        // Ambil id_user dari session
        $id_user = $this->session->userdata('id_user');
        $data['judul'] = 'Data Pengguna';

        // Pastikan id_user tersedia
        if (!$id_user) {
            redirect('auth/login'); // Ganti dengan route login Anda
        }

        // Ambil data pengguna berdasarkan ID
        $data['user'] = $this->Profile_model->get_user_data($id_user);

        // Ambil gambar dan nama pengguna
        $data['profile_picture'] = $data['user']['profile_picture'] ?? 'default.png'; // Gambar pengguna
        $data['nama'] = $data['user']['nama'] ?? 'User'; // Nama pengguna

        // Set aturan validasi form
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            // Load view edit
            $this->load->view('templates/header', $data);
            $this->load->view('profile/index', $data);
            $this->load->view('templates/footer');
        } else {
            // Siapkan data untuk update
            $update_data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email')
            ];

            // Cek apakah ada file gambar yang diupload
            if (!empty($_FILES['profile_picture']['name'])) {
                // Konfigurasi upload gambar
                $config['upload_path'] = './uploads/profile_pictures/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048; // Maksimal 2MB
                $config['file_name'] = 'profile_' . $id_user;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('profile_picture')) {
                    // Jika gambar berhasil diupload
                    $upload_data = $this->upload->data();
                    $update_data['profile_picture'] = $upload_data['file_name']; // Simpan nama file gambar

                    // Update session dengan gambar baru
                    $this->session->set_userdata('profile_picture', $upload_data['file_name']);
                } else {
                    // Jika gagal upload, tampilkan pesan error
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                    redirect('profile'); // Redirect kembali
                }
            }

            // Update data pengguna di database
            if ($this->Profile_model->update_user($id_user, $update_data)) {
                // Set flash message dan redirect
                $this->session->set_flashdata('message', 'Profil berhasil diperbarui!');

                // Menyimpan data ke session
                $this->session->set_userdata('nama', $update_data['nama']);

                redirect('profile'); // Redirect ke index
            } else {
                $this->session->set_flashdata('message', 'Gagal memperbarui profil!');
                redirect('profile'); // Redirect kembali
            }
        }
    }

    public function change_password()
    {
        // Ambil id_user dari session
        $id_user = $this->session->userdata('id_user');

        // Pastikan id_user tersedia
        if (!$id_user) {
            redirect('auth/login'); // Ganti dengan route login Anda
        }

        // Redirect ke form ganti password
        redirect('password/change/' . $id_user);
    }
}