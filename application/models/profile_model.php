<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends CI_Model {

    // Mengambil data pengguna berdasarkan ID
    public function get_user_data($id_user) {
        $this->db->select('u.*, COALESCE(m.nama, d.nama) as nama, COALESCE(m.nim, d.nik_nidn) as identifier');
        $this->db->from('tb_users u');
        $this->db->join('tb_mhs m', 'u.id_user = m.id_user', 'left');
        $this->db->join('tb_dosen d', 'u.id_user = d.id_user', 'left');
        $this->db->where('u.id_user', $id_user);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Memperbarui data pengguna
    public function update_user($id_user, $data) {
        $this->db->where('id_user', $id_user);
        return $this->db->update('tb_users', $data);
    }

    // Mengambil gambar pengguna berdasarkan ID
    public function get_profile_picture_by_id($id_user) {
        $this->db->select('profile_picture');
        $this->db->from('tb_users');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();
        return $query->row()->profile_picture; // Mengembalikan nama file gambar
    }

    // Memperbarui gambar pengguna
    public function update_profile_picture($id_user, $profile_picture) {
        $this->db->set('profile_picture', $profile_picture);
        $this->db->where('id_user', $id_user);
        return $this->db->update('tb_users');
    }
}   