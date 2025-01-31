<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_Model extends CI_Model
{
    public function getAllData()
    {
        $this->db->select('tb_kelas.*, tb_matkul.nama_matkul as kelas, 
                          tb_jurusan.nama_jurusan, tb_dosen.nama as nama_dosen');
        $this->db->from('tb_kelas');
        $this->db->join('tb_jurusan', 'tb_jurusan.id_jurusan = tb_kelas.id_jurusan');
        $this->db->join('tb_matkul', 'tb_matkul.id_matkul = tb_kelas.id_matkul');
        $this->db->join('tb_dosen', 'tb_dosen.nik_nidn = tb_kelas.id_dosen', 'left');
        $this->db->order_by('tb_kelas.id_jurusan', 'ASC');
        $this->db->order_by('tb_kelas.id_matkul', 'ASC');
        $this->db->order_by('tb_kelas.nama_kelas', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getKelasByJurusan($id_jurusan)
    {
        return $this->db->get_where('tb_kelas', ['id_jurusan' => $id_jurusan])->result_array();
    }

    public function tambah_data($data)
    {
        $this->db->insert('tb_kelas', $data);
    }

    public function tambah_matkul($data)
    {
        $this->db->insert('tb_matkul', $data);
        return $this->db->insert_id(); // Return the ID of the newly inserted matkul
    }

    public function getAllMatkul()
    {
        return $this->db->get('tb_matkul')->result_array();
    }

    public function getMatkulByJurusan($id_jurusan) {
        $this->db->select('tb_matkul.id_matkul, tb_matkul.nama_matkul');
        $this->db->from('tb_matkul');
        $this->db->join('tb_kelas', 'tb_kelas.id_matkul = tb_matkul.id_matkul');
        $this->db->where('tb_kelas.id_jurusan', $id_jurusan);
        return $this->db->get()->result_array();
    }

    public function hapus_data($id)
    {
        $this->db->delete('tb_kelas', ['id_kelas' => $id]);
    }

    public function detail_data($id)
    {
        return $this->db->get_where('tb_kelas', ['id_kelas' => $id])->row_array();
    }

    public function ubah_data()
    {
        $data = [
            "id_jurusan" => $this->input->post('id_jur', true),
            "nama_kelas" => $this->input->post('nm_kelas', true)
        ];
        $this->db->where('id_kelas', $this->input->post('id_kelas', true));
        $this->db->update('tb_kelas', $data);
    }

    // Get classes based on user role and ID
    public function getKelasByUser($user_id, $role)
    {
        $this->db->select('tb_kelas.*, tb_matkul.nama_matkul as kelas, 
                          tb_jurusan.nama_jurusan, tb_dosen.nama as nama_dosen');
        $this->db->from('tb_kelas');
        $this->db->join('tb_jurusan', 'tb_jurusan.id_jurusan = tb_kelas.id_jurusan');
        $this->db->join('tb_matkul', 'tb_matkul.id_matkul = tb_kelas.id_matkul');
        $this->db->join('tb_dosen', 'tb_dosen.nik_nidn = tb_kelas.id_dosen', 'left');

        if ($role === 'dosen') {
            $this->db->join('tb_dosen', 'tb_dosen.id_user = ' . $user_id, 'inner');
        } elseif ($role === 'mahasiswa') {
            $this->db->join('kelas_mahasiswa', 'kelas_mahasiswa.id_kelas = tb_kelas.id_kelas', 'inner');
            $this->db->join('tb_mhs', 'tb_mhs.nim = kelas_mahasiswa.nim AND tb_mhs.id_user = ' . $user_id, 'inner');
        }

        return $this->db->get()->result_array();
    }

    // Add students to a class
    public function addMahasiswaToKelas($id_kelas, $nim_array)
    {
        foreach ($nim_array as $nim) {
            $data = array(
                'id_kelas' => $id_kelas,
                'nim' => $nim
            );
            $this->db->insert('kelas_mahasiswa', $data);
        }
        return true;
    }

    // Remove students from a class
    public function removeMahasiswaFromKelas($id_kelas, $nim)
    {
        return $this->db->delete('kelas_mahasiswa', array('id_kelas' => $id_kelas, 'nim' => $nim));
    }

    // Get all students in a class
    public function getMahasiswaInKelas($id_kelas)
    {
        $this->db->select('tb_mhs.*, kelas_mahasiswa.id_kelas');
        $this->db->from('tb_mhs');
        $this->db->join('kelas_mahasiswa', 'kelas_mahasiswa.nim = tb_mhs.nim');
        $this->db->where('kelas_mahasiswa.id_kelas', $id_kelas);
        return $this->db->get()->result_array();
    }

    public function getMahasiswaByNim($nim) {
        $this->db->select('nim, id_jurusan, nama_mhs');
        $this->db->from('tb_mhs');
        $this->db->where('nim', $nim);
        return $this->db->get()->row();
    }

    // Assign dosen to kelas
    public function assignDosen($id_kelas, $nik_nidn)
    {
        return $this->db->update('tb_kelas', array('id_dosen' => $nik_nidn), array('id_kelas' => $id_kelas));
    }

    public function getAvailableMahasiswaByJurusan($id_jurusan) {
        $this->db->select('nim, nama_mhs');
        $this->db->from('tb_mhs');
        $this->db->where('id_jurusan', $id_jurusan);
        return $this->db->get()->result();
    }
}
