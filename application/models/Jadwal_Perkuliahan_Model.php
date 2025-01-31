<?php
class Jadwal_Perkuliahan_Model extends CI_Model {
    public function getAllData() {
        $this->db->select('jadwal_perkuliahan.*, tb_kelas.nama_kelas, tb_matkul.nama_matkul, tb_dosen.nama as nama_dosen, tb_jurusan.nama_jurusan');
        $this->db->from('jadwal_perkuliahan');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = jadwal_perkuliahan.id_kelas');
        $this->db->join('tb_matkul', 'tb_matkul.id_matkul = tb_kelas.id_matkul');
        $this->db->join('tb_dosen', 'tb_dosen.nik_nidn = tb_kelas.id_dosen', 'left');
        $this->db->join('tb_jurusan', 'tb_jurusan.id_jurusan = tb_kelas.id_jurusan', 'left');
        return $this->db->get()->result_array();
    }

    public function getKelas() {
        $this->db->select('k.*, m.nama_matkul');
        $this->db->from('tb_kelas k');
        $this->db->join('tb_matkul m', 'm.id_matkul = k.id_matkul');
        return $this->db->get()->result();
    }

    public function getMatkul() {
        return $this->db->get('tb_matkul')->result();
    }

    public function getJurusan() {
        return $this->db->get('tb_jurusan')->result();
    }

// In Jadwal_Perkuliahan_Model.php

    // In Jadwal_Perkuliahan_Model.php
public function tambah_data() {
    // First get the id_matkul from the selected kelas
    $id_kelas = $this->input->post('id_kelas');
    $kelas = $this->db->get_where('tb_kelas', ['id_kelas' => $id_kelas])->row();
    
    if (!$kelas) {
        return false;
    }

    $data = array(
        'id_kelas' => $id_kelas,
        'id_matkul' => $kelas->id_matkul,  // Add the id_matkul
        'hari' => $this->input->post('hari'),
        'sesi' => $this->input->post('sesi'),
        'durasi' => $this->input->post('durasi')
    );

    return $this->db->insert('jadwal_perkuliahan', $data);
}

    public function hapus_data($id) {
        $this->db->delete('jadwal_perkuliahan', ['id_jadwal' => $id]);
    }

    public function getJadwalByHari($hari) {
        $this->db->select('jp.*, k.nama_kelas, m.nama_matkul');
        $this->db->from('jadwal_perkuliahan jp');
        $this->db->join('tb_kelas k', 'k.id_kelas = jp.id_kelas');
        $this->db->join('tb_matkul m', 'm.id_matkul = jp.id_matkul');
        $this->db->where('jp.hari', $hari);
        return $this->db->get()->result();
    }

    public function getAllDataPaginated($limit, $start) {
        $this->db->select('jadwal_perkuliahan.*, tb_kelas.nama_kelas, tb_matkul.nama_matkul, tb_dosen.nama as nama_dosen, tb_jurusan.nama_jurusan');
        $this->db->from('jadwal_perkuliahan');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = jadwal_perkuliahan.id_kelas');
        $this->db->join('tb_matkul', 'tb_matkul.id_matkul = tb_kelas.id_matkul');
        $this->db->join('tb_dosen', 'tb_dosen.nik_nidn = tb_kelas.id_dosen', 'left');
        $this->db->join('tb_jurusan', 'tb_jurusan.id_jurusan = tb_kelas.id_jurusan', 'left');
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();
    }

    public function getTotalRows() {
        $this->db->from('jadwal_perkuliahan');
        return $this->db->count_all_results();
    }

    public function getJadwalPerJurusanPaginated($hari, $limit, $start) {
        $this->db->select('jadwal_perkuliahan.*, tb_kelas.nama_kelas, tb_matkul.nama_matkul, tb_dosen.nama as nama_dosen, tb_jurusan.nama_jurusan');
        $this->db->from('jadwal_perkuliahan');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = jadwal_perkuliahan.id_kelas');
        $this->db->join('tb_matkul', 'tb_matkul.id_matkul = tb_kelas.id_matkul');
        $this->db->join('tb_dosen', 'tb_dosen.nik_nidn = tb_kelas.id_dosen', 'left');
        $this->db->join('tb_jurusan', 'tb_jurusan.id_jurusan = tb_kelas.id_jurusan', 'left');
        $this->db->where('jadwal_perkuliahan.hari', $hari);
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();
    }

    public function getTotalRowsPerJurusan($hari) {
        $this->db->from('jadwal_perkuliahan');
        $this->db->where('hari', $hari);
        return $this->db->count_all_results();
    }
    

}