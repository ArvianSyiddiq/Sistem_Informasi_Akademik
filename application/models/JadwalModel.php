<?php
class JadwalModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Get paginated jadwal data
    public function getJadwal($limit, $offset) {
        return $this->db->get('tb_jurusan', $limit, $offset)->result();
    }

    // Count total rows for pagination
    public function countAll() {
        return $this->db->count_all('tb_jurusan');
    }

    // Insert new jadwal
    public function insertJadwal($data) {
        return $this->db->insert('tb_jurusan', $data);
    }

    // Get all kelas data
    public function getKelas() {
        return $this->db->get('tb_kelas')->result();
    }
}
