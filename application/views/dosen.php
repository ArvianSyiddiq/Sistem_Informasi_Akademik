<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title -->
    <title>Data Tabel</title>

    <!-- Bootstrap CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ6H1fGg9zT5G13Fc/0r1+nnzQ5FgsFGvhDzF2d76ePY5s5EZkS9IEmhAwr6" crossorigin="anonymous">

    <!-- Optional: Bootstrap Icons for better UI (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- DataTables CSS (optional, for advanced table features) -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

</head>


<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DATA TABEL</h1>
                    </div>
                    
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Table with Bootstrap classes -->
                                <table id="example" class="table table-bordered table-striped">

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
      <br>
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Nama</th>
                                            <th>NIK/NIDN</th>
                                            <th>Prodi</th>
                                            <th>Email</th>
                                            <th>No. Telepon</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    <?php foreach ($dosen as $mhs): ?>
        <tr>
            <td> <?php echo $mhs->nama; ?> </td>
            <td> <?php echo $mhs->nik_nidn; ?> </td>
            <td> <?php echo $mhs->prodi; ?> </td>
            <td> <?php echo $mhs->email; ?> </td>
            <td> <?php echo $mhs->no_telp; ?> </td>
            <td>
                <img src="<?php echo base_url('assets/foto/' . $mhs->foto); ?>" alt="Foto Dosen"
                    style="width: 100px; height: 100px; object-fit: cover;">
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
                                </table>
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="<?php echo site_url('dashboard/addDosen'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="nik_nidn" class="form-label">NIK/NIDN</label>
              <input type="number" class="form-control" name="nik_nidn" required>
            </div>
            <div class="mb-3">
              <label for="prodi" class="form-label">Prodi</label>
              <input type="text" class="form-control" name="prodi" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
              <label for="no_telp" class="form-label">No Telepon</label>
              <input type="text" class="form-control" name="no_telp" required>
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

</body>
</html>
