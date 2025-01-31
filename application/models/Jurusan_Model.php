<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan_Model extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('tb_jurusan')->result(); // Use result() to get an array of objects
    }

    public function tambah_data()
    {
        $data = [
            "kode_jurusan" => $this->input->post('kode_jur', true),
            "nama_jurusan" => $this->input->post('nm_jur', true)
        ];
        $this->db->insert('tb_jurusan', $data);
    }

    public function hapus_data($id)
{
    // Start with kelas_mahasiswa
    $this->db->where('nim IN (SELECT nim FROM tb_mhs WHERE id_jurusan = ' . $this->db->escape($id) . ')', null, false);
    $this->db->delete('kelas_mahasiswa');

    // Delete from jadwal_perkuliahan
    $this->db->where('id_matkul IN (SELECT id_matkul FROM tb_matkul WHERE id_jurusan = ' . $this->db->escape($id) . ')', null, false);
    $this->db->delete('jadwal_perkuliahan');

    // Delete from tb_kelas that references matkul from this jurusan
    $this->db->where('id_matkul IN (SELECT id_matkul FROM tb_matkul WHERE id_jurusan = ' . $this->db->escape($id) . ')', null, false);
    $this->db->delete('tb_kelas');

    // Delete related records in tb_mhs
    $this->db->where('id_jurusan', $id);
    $this->db->delete('tb_mhs');

    // Delete related records in tb_matkul
    $this->db->where('id_jurusan', $id);
    $this->db->delete('tb_matkul');

    // Finally delete the jurusan
    $this->db->where('id_jurusan', $id);
    return $this->db->delete('tb_jurusan');
}


    public function detail_data($id)
    {
        return $this->db->get_where('tb_jurusan', ['id_jurusan' => $id])->row_array();
    }

    public function ubah_data()
    {
        $data = [
            "nama_jurusan" => $this->input->post('nm_jur', true)
        ];
        $this->db->where('id_jurusan', $this->input->post('id_jur'));
        $this->db->update('tb_jurusan', $data);
    }

}
