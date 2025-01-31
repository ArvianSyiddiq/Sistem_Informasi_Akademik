<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Jurusan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Jurusan</li>
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
              <h3 class="card-title">Edit Jurusan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="<?= base_url() ?>DataJurusan/update/<?= $jurusan['id_jurusan'] ?>" method="post">
                <div class="form-group">
                  <label for="kode_jur">Kode Jurusan</label>
                  <input type="text" class="form-control" id="kode_jur" name="kode_jur" value="<?= $jurusan['kode_jurusan'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="nm_jur">Nama Jurusan</label>
                  <input type="text" class="form-control" id="nm_jur" name="nm_jur" value="<?= $jurusan['nama_jurusan'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo site_url('DataJurusan'); ?>" class="btn btn-secondary">Kembali</a>
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