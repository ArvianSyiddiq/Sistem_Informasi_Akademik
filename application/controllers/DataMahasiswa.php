<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataMahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_mhs');
        $this->load->library('form_validation');
        require_once(APPPATH . 'third_party/fpdf/fpdf.php');
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->load->library('pagination');
    
        // Menentukan jumlah data per halaman
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
    
        // Menentukan base URL
        $config['base_url'] = site_url('mahasiswa/index');
    
        // Menghitung jumlah total data mahasiswa
        $config['total_rows'] = $this->M_mhs->countAllMahasiswa();
    
        // Konfigurasi pagination
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
    
        // Inisialisasi pagination
        $this->pagination->initialize($config);
    
        // Menentukan halaman yang sedang aktif, jika tidak ada maka default ke 0
        $start = $this->uri->segment(3, 0);
    
        // Ambil data mahasiswa untuk halaman yang aktif
        $data['mahasiswa'] = $this->M_mhs->getMahasiswa($config['per_page'], $start);
    
        // Kirim data pagination ke view
        $data['pagination'] = $this->pagination->create_links();
        
        $data['mahasiswa'] = $this->M_mhs->get_data(); // Fetch all mahasiswa data
        
        $data['mahasiswa_count'] = $this->M_mhs->get_mahasiswa_count_by_jurusan(); // Fetch mahasiswa count data
        $data['jurusan'] = $this->M_mhs->get_all_jurusan(); // Fetch all jurusan data
        // Muat view
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('mahasiswa/mahasiswa', $data);  // Pastikan data dikirimkan ke view
        $this->load->view('template/footer');
    }
    
    

    public function indexing()
    {
        $data['mahasiswa'] = $this->M_mhs->get_data(); // Ambil semua data mahasiswa
        $this->load->view('template/header'); // Load header
        $this->load->view('template/sidebar'); // Load sidebar
        $this->load->view('mahasiswa/mahasiswa', $data); // Tampilkan view mahasiswa
        $this->load->view('template/footer'); // Load footer

        
    }

    function tampil_grafik()
    {
    $this->load->model('M_mhs');
    $data['hasil']=$this->M_mhs->Jum_mahasiswa_perjurusan();
    $this->load->view('mahasiswa/v_grafik', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('nama_mhs', 'Nama Mahasiswa', 'required');
        $this->form_validation->set_rules('nim', 'NIM', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            // Handle file upload
            $config['upload_path'] = './assets/foto/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB

            $this->load->library('upload', $config);

            // Initialize the foto variable with a default value
            $foto = 'default.jpg';

            // Check if a file is uploaded
            if ($_FILES['foto']['name']) {
                if ($this->upload->do_upload('foto')) {
                    $foto = $this->upload->data('file_name'); // Get the uploaded file name
                } else {
                    log_message('error', $this->upload->display_errors()); // Log error if upload fails
                }
            }

            $data = [
                'nama_mhs' => $this->input->post('nama_mhs'),
                'nim' => $this->input->post('nim'),
                'alamat' => $this->input->post('alamat'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'id_jurusan' => $this->input->post('id_jurusan'),
                'email' => $this->input->post('email'),
                'no_telepon' => $this->input->post('no_telepon'),
                'foto' => $foto // Ensure this is not null
            ];

            $this->M_mhs->add_data($data);
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('DataMahasiswa');
        }
    }

    public function edit($id)
    {
        $data['mahasiswa'] = $this->M_mhs->edit_data($id); // Fetch data for a specific mahasiswa
        $data['jurusan'] = $this->M_mhs->get_all_jurusan(); // Fetch all jurusan data
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('mahasiswa/edit_mahasiswa', $data); // Pass the mahasiswa and jurusan data to the view
        $this->load->view('template/footer');
    }   

    public function update($id)
    {
        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        // Ambil foto saat ini dari database
        $mahasiswa = $this->M_mhs->edit_data($id);
        $current_foto = $mahasiswa['foto']; // Ambil nama foto saat ini

        // Cek apakah ada file yang diupload
        if ($_FILES['foto']['name']) {
            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name');
            } else {
                $error = $this->upload->display_errors();
                $foto = $current_foto;
            }
        } else {
            $foto = $current_foto;
        }

        $data = [
            'nama_mhs' => $this->input->post('nama_mhs'),
            'nim' => $this->input->post('nim'),
            'alamat' => $this->input->post('alamat'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'id_jurusan' => $this->input->post('id_jurusan'),
            'email' => $this->input->post('email'),
            'no_telepon' => $this->input->post('no_telepon'),
            'foto' => $foto // Ensure this is not null
        ];

        $this->M_mhs->update_data($id, $data);
        $this->session->set_flashdata('message', 'Data Berhasil di Edit');
        redirect('DataMahasiswa');
    }


    public function hapus($id)
    {
        // Get the mahasiswa data to retrieve the nim
        $mahasiswa = $this->M_mhs->edit_data($id);
        $nim = $mahasiswa['nim'];
    
        // Delete related rows in kelas_mahasiswa table
        $this->db->where('nim', $nim);
        $this->db->delete('kelas_mahasiswa');
    
        // Delete the mahasiswa data
        $this->M_mhs->hapus_data($id);
    
        $this->session->set_flashdata('warning', 'Data Berhasil di Hapus!');
        redirect('DataMahasiswa'); // Kembali ke halaman mahasiswa
    }

    public function detail($id)
    {
        
        $data['mahasiswa'] = $this->M_mhs->detail_data($id); // Ambil detail mahasiswa
        $this->load->view('template/header'); // Load header
        $this->load->view('template/sidebar'); // Load sidebar
        $this->load->view('mahasiswa/detail', $data); // Tampilkan view detail
        $this->load->view('template/footer'); // Load footer
    }

    public function print()
    {
        $data['mahasiswa'] = $this->M_mhs->get_data();
        $this->load->view('mahasiswa/print', $data);
    }

    public function search()
    {
        $keyword = $this->input->post('keyword'); // Ambil keyword dari form pencarian
        $data['mahasiswa'] = $this->M_mhs->get_keyword($keyword); // Panggil model untuk mendapatkan hasil pencarian

        // Muat view setelah pencarian
        $this->load->view('template/header'); // Muat header
        $this->load->view('template/sidebar'); // Muat sidebar
        $this->load->view('mahasiswa/mahasiswa', $data); // Muat view mahasiswa dengan hasil pencarian
        $this->load->view('template/footer'); // Muat footer
    }

    public function exportPDF()
{
    error_reporting(0);  // Suppress warnings
    $pdf = new FPDF('P', 'mm', 'Letter');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 8); // Set smaller font size
    $pdf->Cell(0, 7, 'DAFTAR MAHASISWA', 0, 1, 'C');
    $pdf->Ln(5); // Smaller space between title and table

    // Header of the table with smaller font size
    $pdf->SetFont('Arial', 'B', 6);  // Smaller header font
    $pdf->Cell(8, 8, 'No', 1, 0, 'C');  // Reduced column width and height
    $pdf->Cell(40, 8, 'Nama Mahasiswa', 1, 0, 'C');
    $pdf->Cell(25, 8, 'NIM', 1, 0, 'C');
    $pdf->Cell(40, 8, 'Tanggal Lahir', 1, 0, 'C');
    $pdf->Cell(30, 8, 'Jurusan', 1, 0, 'C');
    $pdf->Cell(25, 8, 'Email', 1, 0, 'C');
    $pdf->Cell(25, 8, 'No Telepon', 1, 0, 'C');
    $pdf->Cell(15, 8, 'Foto', 1, 0, 'C');  // Reduced column width for photo
    $pdf->Ln();  // Line break after header

    // Data rows with smaller font size
    $pdf->SetFont('Arial', '', 6); // Set smaller font for data
    $this->db->select('tb_mhs.*, tb_jurusan.nama_jurusan');
    $this->db->from('tb_mhs');
    $this->db->join('tb_jurusan', 'tb_mhs.id_jurusan = tb_jurusan.id_jurusan', 'left');
    $mahasiswa = $this->db->get()->result();
    $no = 0;

    foreach ($mahasiswa as $data) {
        $no++;
        $pdf->Cell(8, 10, $no, 1, 0, 'C');  // '10' for height, '8' for width
        $pdf->Cell(40, 10, $data->nama_mhs, 1, 0, 'L');
        $pdf->Cell(25, 10, $data->nim, 1, 0, 'L');
        $pdf->Cell(40, 10, $data->tgl_lahir, 1, 0, 'L');
        $pdf->Cell(30, 10, $data->nama_jurusan, 1, 0, 'L');  // Use nama_jurusan from tb_jurusan
        $pdf->Cell(25, 10, $data->email, 1, 0, 'L');
        $pdf->Cell(25, 10, $data->no_telepon, 1, 0, 'L');

        // Column for photo with adjusted smaller size
        $photoPath = './assets/foto/' . $data->foto;  // Ensure path is correct
        if (file_exists($photoPath)) {
            $pdf->Cell(15, 10, '', 1, 0, 'C');  // Border for photo cell
            // Adjust image size to a much smaller size (e.g., 6x6)
            $pdf->Image($photoPath, $pdf->GetX() - 15, $pdf->GetY() + 2, 6, 6);  // Smaller image size
        } else {
            $pdf->Cell(15, 10, 'Tidak Ada', 1, 0, 'C');  // Display 'Tidak Ada' if no photo exists
        }

        $pdf->Ln();  // Line break for the next row
    }

    $pdf->Output('D', 'Daftar_Mahasiswa.pdf');  // Output PDF file
}

    

public function exportExcel()
{
    $this->db->select('tb_mhs.*, tb_jurusan.nama_jurusan');
    $this->db->from('tb_mhs');
    $this->db->join('tb_jurusan', 'tb_mhs.id_jurusan = tb_jurusan.id_jurusan', 'left');
    $data = $this->db->get()->result_array();

    include_once APPPATH . 'third_party/xlsxwriter.class.php';
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE);

    $filename = "report-" . date('d-m-Y-H-i-s') . ".xlsx";
    header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('pragma: public');

    $styles = array(
        'widths' => [3, 20, 30, 40, 30, 30, 25, 25, 15],
        'font' => 'Arial',
        'font-size' => 10,
        'font-style' => 'bold',
        'fill' => '#eee',
        'halign' => 'center',
        'border' => 'left, right, top, bottom'
    );

    $styles2 = array(
        ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'bold', 'fill' => '#eee', 'halign' => 'left', 'border' => 'left, right, top, bottom'],
        ['fill' => '#ffc'],
        ['fill' => '#fcf'],
        ['fill' => '#ccf'],
        ['fill' => '#cff'],
        ['fill' => '#cff']
    );

    $header = array(
        'No' => 'integer',
        'Nama Mahasiswa' => 'string',
        'NIM' => 'string',
        'Alamat' => 'string',
        'Tanggal Lahir' => 'string',
        'Jurusan' => 'string',
        'Email' => 'string',
        'No Telepon' => 'string',
        'Foto' => 'string'
    );

    $writer = new XLSXWriter();
    $writer->setAuthor('Susanoo');
    $writer->writeSheetHeader('Sheet1', $header, $styles);
    $no = 1;

    foreach ($data as $row) {
        $writer->writeSheetRow('Sheet1', [
            $no,
            $row['nama_mhs'],
            $row['nim'],
            $row['alamat'],
            $row['tgl_lahir'],
            $row['nama_jurusan'],
            $row['email'],
            $row['no_telepon'],
            $row['foto']
        ], $styles2);
        $no++;
    }

    $writer->writeToStdout();
}
    public function dosen ()
    {
    $data['dosen']=$this-> M_mhs->tampil_dosen()-> result();


            // Muat view setelah pencarian
            $this->load->view('template/header'); // Muat header
            $this->load->view('template/sidebar'); // Muat sidebar
            $this->load->view('dosen/dosen', $data); // Muat view mahasiswa dengan hasil pencarian
            $this->load->view('template/footer'); // Muat footer
    }

    public function addDosen()
    {
        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config); // Load library upload

        // Inisialisasi variabel foto dengan gambar default
        $foto = 'default.jpg'; // Gambar default jika tidak ada upload

        // Cek apakah ada file yang diupload
        if ($_FILES['foto']['name']) {
            // Check if the file upload is successful
            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name'); // Ambil nama file foto baru
            } else {
                log_message('error', $this->upload->display_errors()); // Log error jika upload gagal
                // Anda dapat mengatur error message untuk ditampilkan kepada pengguna
            }
        }

        // Ambil data dari form
        $data = [
            'nama' => $this->input->post('nama'),
            'nik_nidn' => $this->input->post('nik_nidn'),
            'prodi' => $this->input->post('prodi'),
            'email' => $this->input->post('email'),
            'no_telp' => $this->input->post('no_telp'),
            'foto' => $foto // Pastikan ini tidak null
        ];

        $this->session->set_flashdata('message', 'Data Berhasil di Tambah!');
        $this->M_mhs->add_data_dosen($data); // Tambahkan data ke model
        redirect('DataMahasiswa/dosen'); // Kembali ke halaman mahasiswa
    }

    public function printDosen()
    {
        $data['dosen'] = $this->M_mhs->tampil_dosen()->result();
        $this->load->view('dosen/print', $data);
    }

    public function grafikDosen()
    {
        $data['hasil'] = $this->M_mhs->Jum_dosen_perprodi();
        $this->load->view('dosen/v_grafik', $data);
    }

    public function exportPDFDosen()
    {
        error_reporting(0);  // Suppress warnings
        $pdf = new FPDF('P', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 8); // Set smaller font size
        $pdf->Cell(0, 7, 'DAFTAR DOSEN', 0, 1, 'C');
        $pdf->Ln(5); // Smaller space between title and table

        // Header of the table with smaller font size
        $pdf->SetFont('Arial', 'B', 6);  // Smaller header font
        $pdf->Cell(8, 8, 'No', 1, 0, 'C');  // Reduced column width and height
        $pdf->Cell(40, 8, 'Nama Dosen', 1, 0, 'C');
        $pdf->Cell(25, 8, 'NIK/NIDN', 1, 0, 'C');
        $pdf->Cell(40, 8, 'Prodi', 1, 0, 'C');
        $pdf->Cell(30, 8, 'Email', 1, 0, 'C');
        $pdf->Cell(25, 8, 'No Telepon', 1, 0, 'C');
        $pdf->Cell(15, 8, 'Foto', 1, 0, 'C');  // Reduced column width for photo
        $pdf->Ln();  // Line break after header

        // Data rows with smaller font size
        $pdf->SetFont('Arial', '', 6); // Set smaller font for data
        $dosen = $this->M_mhs->tampil_dosen()->result();
        $no = 0;

        foreach ($dosen as $data) {
            $no++;
            $pdf->Cell(8, 10, $no, 1, 0, 'C');  // '10' for height, '8' for width
            $pdf->Cell(40, 10, $data->nama, 1, 0, 'L');
            $pdf->Cell(25, 10, $data->nik_nidn, 1, 0, 'L');
            $pdf->Cell(40, 10, $data->prodi, 1, 0, 'L');
            $pdf->Cell(30, 10, $data->email, 1, 0, 'L');
            $pdf->Cell(25, 10, $data->no_telp, 1, 0, 'L');

            // Column for photo with adjusted smaller size
            $photoPath = './assets/foto/' . $data->foto;  // Ensure path is correct
            if (file_exists($photoPath)) {
                $pdf->Cell(15, 10, '', 1, 0, 'C');  // Border for photo cell
                // Adjust image size to a much smaller size (e.g., 6x6)
                $pdf->Image($photoPath, $pdf->GetX() - 15, $pdf->GetY() + 2, 6, 6);  // Smaller image size
            } else {
                $pdf->Cell(15, 10, 'Tidak Ada', 1, 0, 'C');  // Display 'Tidak Ada' if no photo exists
            }

            $pdf->Ln();  // Line break for the next row
        }

        $pdf->Output('D', 'Daftar_Dosen.pdf');  // Output PDF file
    }

    public function exportCSVDosen()
    {
        $this->db->select('nama, nik_nidn, prodi, email, no_telp, foto');
        $this->db->from('tb_dosen');
        $data = $this->db->get()->result_array();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=dosen.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('Nama', 'NIK/NIDN', 'Prodi', 'Email', 'No Telepon', 'Foto'));

        foreach ($data as $row) {
            fputcsv($output, $row);
        }

        fclose($output);
    }   

    public function detailDosen($id)
{
    $data['dosen'] = $this->M_mhs->detail_data_dosen($id);
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('dosen/detail_dosen', $data);
    $this->load->view('template/footer');
}

public function editDosen($id)
{
    $data['dosen'] = $this->M_mhs->edit_data_dosen($id);
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('dosen/edit_dosen', $data);
    $this->load->view('template/footer');
}

public function updateDosen($nik_nidn)
{
    $this->load->library('upload');

    $config['upload_path'] = './assets/foto/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = 2048; // 2MB
    $config['file_name'] = $nik_nidn;

    $this->upload->initialize($config);

    if ($this->upload->do_upload('foto')) {
        $fileData = $this->upload->data();
        $foto = $fileData['file_name'];
    } else {
        $foto = $this->input->post('old_foto');
    }

    $data = [
        'nama' => $this->input->post('nama'),
        'nik_nidn' => $this->input->post('nik_nidn'),
        'prodi' => $this->input->post('prodi'),
        'email' => $this->input->post('email'),
        'no_telp' => $this->input->post('no_telp'),
        'foto' => $foto
    ];

    $this->db->where('nik_nidn', $nik_nidn);
    $this->db->update('tb_dosen', $data);

    $this->session->set_flashdata('message', 'Data dosen berhasil diupdate');
    redirect('DataMahasiswa/dosen');
}
public function hapusDosen($id)
{
    $this->M_mhs->hapus_data_dosen($id);
    $this->session->set_flashdata('warning', 'Data Berhasil di Hapus!');
    redirect('DataMahasiswa/dosen');
}   

    

}
