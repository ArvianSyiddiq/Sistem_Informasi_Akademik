<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengguna_model');
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
            redirect('login'); // Ganti dengan route login Anda
        }

        // Ambil data pengguna berdasarkan ID
        $data['pengguna'] = $this->Pengguna_model->get_pengguna_by_id($id_user);

        // Ambil gambar dan nama pengguna
        $data['profile_picture'] = $data['pengguna']['profile_picture'] ?? 'default.png'; // Gambar pengguna
        $data['username'] = $data['pengguna']['username'] ?? 'User'; // Nama pengguna

        // Set aturan validasi form
        $this->form_validation->set_rules('username', 'Username', 'required|trim');

        if ($this->form_validation->run() == false) {
            // Load view edit
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('pengguna/index', $data); // Ensure the correct view path
            $this->load->view('template/footer');
        } else {
            // Siapkan data untuk update
            $update_data = [
                'username' => $this->input->post('username'),
            ];

            // Cek apakah ada file gambar yang diupload
            if (!empty($_FILES['gambar']['name'])) {
                // Konfigurasi upload gambar
                $config['upload_path'] = './assets/foto/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048; // Maksimal 2MB
                $config['file_name'] = time() . '_' . $_FILES['gambar']['name'];

                $this->upload->initialize($config);

                if ($this->upload->do_upload('gambar')) {
                    // Jika gambar berhasil diupload
                    $upload_data = $this->upload->data();
                    $update_data['profile_picture'] = $upload_data['file_name']; // Simpan nama file gambar

                    // Update session dengan gambar baru
                    $this->session->set_userdata('profile_picture', $upload_data['file_name']);
                } else {
                    // Jika gagal upload, tampilkan pesan error
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                    redirect('pengguna'); // Redirect kembali
                }
            }

            // Update data pengguna di database
            if ($this->Pengguna_model->update_pengguna($id_user, $update_data)) {
                // Set flash message dan redirect
                $this->session->set_flashdata('message', 'Profil berhasil diperbarui!');

                // Menyimpan data ke session
                $this->session->set_userdata('username', $update_data['username']);

                redirect('pengguna'); // Redirect ke index
            } else {
                $this->session->set_flashdata('message', 'Gagal memperbarui profil!');
                redirect('pengguna'); // Redirect kembali
            }
        }
    }

    public function update_profile_picture()
    {
        // Ambil id_user dari session
        $id_user = $this->session->userdata('id_user');

        // Pastikan id_user tersedia
        if (!$id_user) {
            redirect('login'); // Ganti dengan route login Anda
        }

        // Konfigurasi upload gambar
        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // Maksimal 2MB
        $config['file_name'] = time() . '_' . $_FILES['profile_picture']['name'];

        $this->upload->initialize($config);

        if ($this->upload->do_upload('profile_picture')) {
            // Jika gambar berhasil diupload
            $upload_data = $this->upload->data();
            $profile_picture = $upload_data['file_name']; // Simpan nama file gambar

            // Update data pengguna di database
            $this->Pengguna_model->update_pengguna($id_user, ['profile_picture' => $profile_picture]);

            // Update session dengan gambar baru
            $this->session->set_userdata('profile_picture', $profile_picture);

            // Set flash message dan redirect
            $this->session->set_flashdata('message', 'Profil berhasil diperbarui!');
        } else {
            // Jika gagal upload, tampilkan pesan error
            $this->session->set_flashdata('message', $this->upload->display_errors());
        }

        redirect('pengguna'); // Redirect kembali
    }

    public function change_password()
    {
        // Ambil id_user dari session
        $id_user = $this->session->userdata('id_user');

        // Pastikan id_user tersedia
        if (!$id_user) {
            redirect('login'); // Ganti dengan route login Anda
        }

        // Redirect ke form ganti password
        redirect('password/change/' . $id_user);
    }
}
