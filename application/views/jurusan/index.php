<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Jurusan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Jurusan</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Add your content here -->
      <?php if ($this->session->flashdata('flash_jurusan')): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('flash_jurusan'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Tambah Data</h5>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <?= validation_errors(); ?>
                  <form action="<?= base_url() ?>DataJurusan/tambah" method="post" accept-charset="utf-8">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="kode_jur">Kode Jurusan</label>
                        <input type="text" class="form-control" id="kode_jur" name="kode_jur">
                      </div>
                      <div class="form-group">
                        <label for="nm_jur">Nama Jurusan</label>
                        <input type="text" class="form-control" id="nm_jur" name="nm_jur">
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save">
                    </div>
                    <!-- /.card-body -->
                  </form>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- list data -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- card-body -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Jurusan</th>
                      <th>Nama Jurusan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($jurusan as $row) { ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $row->kode_jurusan ?></td>
                        <td><?= $row->nama_jurusan ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?= base_url() ?>DataJurusan/hapus/<?= $row->id_jurusan ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
                            <a href="<?= base_url() ?>DataJurusan/ubah/<?= $row->id_jurusan ?>" class="btn btn-warning">Update</a>
                          </div>
                        </td>
                      </tr>
                    <?php
                      $no++;
                    } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
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