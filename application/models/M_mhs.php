<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_mhs extends CI_Model
{
  // Mengambil semua data dari tabel tb_mhs
  public function get_data()
  {
    $this->db->select('tb_mhs.nim, tb_mhs.nama_mhs, tb_mhs.alamat, tb_mhs.tgl_lahir, tb_jurusan.nama_jurusan, tb_mhs.email, tb_mhs.no_telepon, tb_mhs.foto');
    $this->db->from('tb_mhs');
    $this->db->join('tb_jurusan', 'tb_mhs.id_jurusan = tb_jurusan.id_jurusan');
    return $this->db->get()->result_array();
  }

  // Menambahkan data baru ke dalam tabel tb_mhs
  public function add_data($data)
  {
    return $this->db->insert('tb_mhs', $data);
  }

  // Menambahkan data baru ke dalam tabel tb_dosen
  public function add_data_dosen($data)
  {
    return $this->db->insert('tb_dosen', $data);
  }

  // Memperbarui data yang sudah ada berdasarkan id
  public function update_data($id, $data)
  {
    $this->db->where('nim', $id);
    return $this->db->update('tb_mhs', $data);
  }

  // Menghapus data berdasarkan id
  public function hapus_data($id)
  {
    $this->db->where('nim', $id);
    return $this->db->delete('tb_mhs');
  }

  // Mengambil data untuk diedit berdasarkan id
  public function edit_data($id)
  {
    $this->db->select('tb_mhs.*, tb_jurusan.nama_jurusan');
    $this->db->from('tb_mhs');
    $this->db->join('tb_jurusan', 'tb_mhs.id_jurusan = tb_jurusan.id_jurusan');
    $this->db->where('tb_mhs.nim', $id);
    return $this->db->get()->row_array();
  }

  // Mengambil detail data berdasarkan id
  public function detail_data($id = NULL)
  {
    $this->db->select('tb_mhs.nim, tb_mhs.nama_mhs, tb_mhs.alamat, tb_mhs.tgl_lahir, tb_jurusan.nama_jurusan, tb_mhs.email, tb_mhs.no_telepon, tb_mhs.foto');
    $this->db->from('tb_mhs');
    $this->db->join('tb_jurusan', 'tb_mhs.id_jurusan = tb_jurusan.id_jurusan');
    $this->db->where('tb_mhs.nim', $id);
    return $this->db->get()->row();
  }

  public function Jum_dosen_perprodi()
{
    $this->db->select('prodi, COUNT(*) as jumlah_dosen');
    $this->db->from('tb_dosen');
    $this->db->group_by('prodi');
    return $this->db->get()->result();
}



public function get_keyword($keyword)
  {
    $this->db->select('*');
    $this->db->from('tb_mhs');
    $this->db->join('tb_jurusan', 'tb_mhs.id_jurusan = tb_jurusan.id_jurusan');
    

    // Mengelompokkan kondisi pencarian
    $this->db->group_start();
    $this->db->like('nama_mhs', $keyword);
    $this->db->or_like('nim', $keyword);
    $this->db->or_like('tgl_lahir', $keyword);
    $this->db->or_like('jurusan', $keyword);
    $this->db->or_like('alamat', $keyword);
    $this->db->or_like('email', $keyword);
    $this->db->or_like('no_telepon', $keyword);
    $this->db->group_end();

    // Eksekusi kueri dan kembalikan hasilnya
    return $this->db->get()->result_array();
  }

  public function Jum_mahasiswa_perjurusan() {
    $this->db->select('tb_jurusan.nama_jurusan, COUNT(tb_mhs.nim) as total_mahasiswa');
    $this->db->from('tb_jurusan');
    $this->db->join('tb_mhs', 'tb_jurusan.id_jurusan = tb_mhs.id_jurusan', 'left');
    $this->db->group_by('tb_jurusan.nama_jurusan');
    return $this->db->get()->result();
}

  public function countAllMahasiswa()
  {
      return $this->db->count_all('tb_mhs');  // Pastikan 'tb_mhs' adalah nama tabel yang benar
  }
  

  public function getMahasiswa($limit, $start)
  {
      $this->db->limit($limit, $start);  // Menentukan limit dan offset berdasarkan pagination
      return $this->db->get('tb_mhs')->result_array();  // Pastikan 'tb_mhs' adalah nama tabel yang benar
  }
  

  public function tampil_dosen()
  {
  return $this->db->get('tb_dosen');
  
  }

  

  public function cek_login($username, $password) {
    return $this->db->get_where('tb_users', [
    'username' => $username,
    'password' => md5($password) // Pastikan password di-hash dengan md5
    ])->row_array();
    }

  // Update invalid id_jurusan to a valid one (assuming 1 is a valid id_jurusan)
  public function update_invalid_id_jurusan()
  {
    $this->db->query("UPDATE tb_mhs SET id_jurusan = 1 WHERE id_jurusan NOT IN (SELECT id_jurusan FROM tb_jurusan)");
  }

  // Remove the invalid rows
  public function delete_invalid_id_jurusan()
  {
    $this->db->query("DELETE FROM tb_mhs WHERE id_jurusan NOT IN (SELECT id_jurusan FROM tb_jurusan)");
  }

  // Mengambil semua data dari tabel tb_jurusan
  public function get_all_jurusan()
  {
    return $this->db->get('tb_jurusan')->result(); // Fetch all jurusan data as objects
  }
 
    public function get_mahasiswa_count_by_jurusan()
    {
      $this->db->select('tb_jurusan.nama_jurusan, COUNT(tb_mhs.nim) as total_mahasiswa');
      $this->db->from('tb_jurusan');
      $this->db->join('tb_mhs', 'tb_jurusan.id_jurusan = tb_mhs.id_jurusan', 'left');
      $this->db->group_by('tb_jurusan.nama_jurusan');
      return $this->db->get()->result();
    }

    public function getAllMahasiswa() {
        return $this->db->get('tb_mhs')->result_array();
    }

    public function getAllDosen() {
      return $this->db->get('tb_dosen')->result_array();
  }

    public function getMahasiswaByJurusan($id_jurusan) {
        $this->db->select('*');
        $this->db->from('tb_mhs');
        $this->db->where('id_jurusan', $id_jurusan);
        return $this->db->get()->result_array();
    }

    public function detail_data_dosen($id)
{
    return $this->db->get_where('tb_dosen', ['nik_nidn' => $id])->row();
}

public function edit_data_dosen($id)
{
    return $this->db->get_where('tb_dosen', ['nik_nidn' => $id])->row_array();
}

public function update_data_dosen($id, $data)
{
    $this->db->where('nik_nidn', $id);
    return $this->db->update('tb_dosen', $data);
}

public function hapus_data_dosen($id)
{
    $this->db->where('nik_nidn', $id);
    return $this->db->delete('tb_dosen');
}
}
?>