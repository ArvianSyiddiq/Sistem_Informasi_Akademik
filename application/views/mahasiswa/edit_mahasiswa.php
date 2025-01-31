<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Mahasiswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Mahasiswa</li>
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
              <h3 class="card-title">Edit Mahasiswa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="<?= base_url() ?>DataMahasiswa/update/<?= $mahasiswa['nim'] ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="nama_mhs">Nama Mahasiswa</label>
                  <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" value="<?= $mahasiswa['nama_mhs'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="nim">NIM</label>
                  <input type="number" class="form-control" id="nim" name="nim" value="<?= $mahasiswa['nim'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $mahasiswa['alamat'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="tgl_lahir">Tanggal Lahir</label>
                  <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $mahasiswa['tgl_lahir'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="id_jurusan">Jurusan</label>
                  <select class="form-control" id="id_jurusan" name="id_jurusan" required>
                    <option value="">Select Jurusan</option>
                    <?php foreach ($jurusan as $jur) { ?>
                      <option value="<?= $jur->id_jurusan ?>" <?= $jur->id_jurusan == $mahasiswa['id_jurusan'] ? 'selected' : '' ?>><?= $jur->nama_jurusan ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?= $mahasiswa['email'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="no_telepon">No Telepon</label>
                  <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?= $mahasiswa['no_telepon'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="foto">Foto</label>
                  <input type="file" class="form-control" id="foto" name="foto">
                  <img src="<?= base_url('assets/foto/' . $mahasiswa['foto']) ?>" alt="Foto Mahasiswa" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
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