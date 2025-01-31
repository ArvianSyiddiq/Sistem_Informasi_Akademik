<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {
    public function check_admin($username, $password) {
        return $this->db->get_where('tb_users', [
            'username' => $username,
            'password' => $password,
            'role' => 'admin'
        ])->row_array();
    }
    
    public function check_dosen($username, $password) {
        $this->db->select('d.*, u.id_user as id, u.username');
        $this->db->from('tb_dosen d');
        $this->db->join('tb_users u', 'u.id_user = d.id_user');
        $this->db->where([
            'u.username' => $username,
            'u.password' => $password,
            'u.role' => 'dosen'
        ]);
        return $this->db->get()->row_array();
    }
    
    public function check_mahasiswa($nim, $password) {
        $this->db->select('m.*, u.id_user as id, u.username');
        $this->db->from('tb_mhs m');
        $this->db->join('tb_users u', 'u.id_user = m.id_user');
        $this->db->where([
            'm.nim' => $nim,
            'u.password' => $password,
            'u.role' => 'mahasiswa'
        ]);
        return $this->db->get()->row_array();
    }
}
