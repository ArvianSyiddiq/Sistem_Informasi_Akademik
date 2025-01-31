<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Dosen</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Dosen</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Add your content here -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Edit Dosen</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="<?= base_url() ?>DataMahasiswa/updateDosen/<?= $dosen['nik_nidn'] ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" value="<?= $dosen['nama'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="nik_nidn">NIK NIDN</label>
                  <input type="number" class="form-control" id="nik_nidn" name="nik_nidn" value="<?= $dosen['nik_nidn'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="prodi">Prodi</label>
                  <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $dosen['prodi'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?= $dosen['email'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="no_telp">No Telepon</label>
                  <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $dosen['no_telp'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="foto">Foto</label>
                  <input type="file" class="form-control" id="foto" name="foto">
                  <input type="hidden" name="old_foto" value="<?= $dosen['foto'] ?>">
                  <img src="<?= base_url('assets/foto/' . $dosen['foto']) ?>" alt="Foto Dosen" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo site_url('DataMahasiswa/dosen'); ?>" class="btn btn-secondary">Kembali</a>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->