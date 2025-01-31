<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{
    // Mengambil data pengguna berdasarkan ID
    public function get_pengguna_by_id($id)
    {
        return $this->db->get_where('tb_users', ['id_user' => $id])->row_array();
    }

    // Memperbarui data pengguna
    public function update_pengguna($id, $data)
    {
        $this->db->where('id_user', $id);
        return $this->db->update('tb_users', $data);
    }

    // Mengambil gambar pengguna berdasarkan ID
    public function get_gambar_by_id($id)
    {
        $this->db->select('profile_picture');
        $this->db->from('tb_users');
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return $query->row()->profile_picture; // Mengembalikan nama file gambar
    }
}
