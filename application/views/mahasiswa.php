
<section class="content">
  <?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?php echo $this->session->flashdata('message'); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if ($this->session->flashdata('warning')): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Peringatan!</strong> <?php echo $this->session->flashdata('warning'); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <div class="container mt-5">
    <h2 class="mb-4">Data Mahasiswa</h2>
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
          <i class="fas fa-plus"></i> Tambah Data
        </button>
        <a class="btn btn-danger" href="<?php echo site_url('dashboard/print'); ?>"
          style="display: inline-flex; align-items: center;">
          <i class="fa fa-print" style="margin-right: 5px;"></i> Print
        </a>
        <a class="btn btn-info" href=" <?php echo site_url('dashboard/tampil_grafik') ?>">
          <i class="fas fa-chart-area">Grafik</i>
        </a>

        <div class="dropdown d-inline">
          <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu1" data-bs-toggle="dropdown"
            aria-expanded="true" style="color:white;">
            <i class="fa fa-download me-2"></i> Export
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <a class="dropdown-item" href="<?php echo site_url('dashboard/exportPDF'); ?>">PDF</a>
            <a class="dropdown-item" href="<?php echo site_url('dashboard/exportExcel'); ?>">Excel</a>
          </div>
        </div>
      </div>

      <div class="navbar-form">
        <?php echo form_open('dashboard/search'); ?>
        <div class="input-group">
          <input type="text" name="keyword" class="form-control" placeholder="Search" required aria-label="Search">
          <button type="submit" class="btn btn-success">Cari</button>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>

    <!-- DataTables Table -->
    <table id="example" class="table table-bordered table-striped">
      <thead class="thead-dark">
        <tr>
          <th style="text-align: center; vertical-align: middle;">NO</th>
          <th style="text-align: center; vertical-align: middle;">NAMA</th>
          <th style="text-align: center; vertical-align: middle;">NIM</th>
          <th style="text-align: center; vertical-align: middle;">TANGGAL LAHIR</th>
          <th style="text-align: center; vertical-align: middle;">JURUSAN</th>
          <th style="text-align: center; vertical-align: middle;">FOTO</th>
          <th style="text-align: center; vertical-align: middle;" colspan="3">AKSI</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = $this->uri->segment(3, 0) + 1; ?>
        <?php foreach ($mahasiswa as $mhs): ?>
          <tr>
            <td style="text-align: center;"><?php echo $no++; ?></td>
            <td><?php echo $mhs['nama_mhs']; ?></td>
            <td><?php echo $mhs['nim']; ?></td>
            <td><?php echo $mhs['tgl_lahir']; ?></td>
            <td><?php echo $mhs['jurusan']; ?></td>
            <td>
              <img src="<?php echo base_url('assets/foto/' . $mhs['foto']); ?>" alt="Foto Mahasiswa"
                style="width: 50px; height: 50px; object-fit: cover;">
            </td>
            <td>
              <?php echo anchor('dashboard/detail/' . $mhs['id_mhs'], '<div class="btn btn-success btn-sm"><i class="fa fa-search-plus"></i></div>'); ?>
            </td>
            <td onclick="return confirm('Anda yakin ingin Hapus?')">
              <a href="<?php echo site_url('dashboard/hapus/' . $mhs['id_mhs']); ?>" class="btn btn-danger btn-sm">
                <i class="fa fa-trash"></i>
              </a>
            </td>
            <td>
              <a href="<?php echo site_url('dashboard/edit/' . $mhs['id_mhs']); ?>" class="btn btn-primary btn-sm">
                <i class="fa fa-edit"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="d-flex justify-content-center" style="text-decoration:none;">
      <?php if (isset($pagination)) echo $pagination; ?>
    </div>
  </div>

  <!-- Modal for Adding Data -->
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="<?php echo site_url('dashboard/add'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="mb-3">
              <label for="nama_mhs" class="form-label">Nama</label>
              <input type="text" class="form-control" name="nama_mhs" required>
            </div>
            <div class="mb-3">
              <label for="nim" class="form-label">NIM</label>
              <input type="number" class="form-control" name="nim" required>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" class="form-control" name="alamat" required>
            </div>
            <div class="mb-3">
              <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
              <input type="date" class="form-control" name="tgl_lahir" required>
            </div>
            <div class="mb-3">
              <label for="jurusan" class="form-label">Jurusan</label>
              <input type="text" class="form-control" name="jurusan" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
              <label for="no_telepon" class="form-label">No Telepon</label>
              <input type="text" class="form-control" name="no_telepon" required>
            </div>
            <div class="mb-3">
              <label for="foto" class="form-label">Foto</label>
              <input type="file" class="form-control" name="foto" required>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>


    <!-- Bootstrap JS (via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-wXdxD1mxwR3NKY5hVA5hfO5lwPCxh3V3YmiqX2z7J8JKzj4cklmd5xD6VgxBdXlR" crossorigin="anonymous"></script>
    
    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables JS (optional, for advanced table features) -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();  // Initialize DataTable with default settings
        });
    </script>
</section>
