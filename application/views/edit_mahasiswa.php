<div class="content-wrapper">
  <section class="content">
    <div class="container mt-5">
      <h2>Edit Data Mahasiswa</h2>
      <form action="<?php echo site_url('dashboard/update/' . $mahasiswa['id_mhs']); ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="nama_mhs" class="form-label">Nama</label>
          <input type="text" class="form-control" name="nama_mhs" value="<?php echo $mahasiswa['nama_mhs']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="nim" class="form-label">NIM</label>
          <input type="number" class="form-control" name="nim" value="<?php echo $mahasiswa['nim']; ?>" required>
        </div>
        
        <div class="form-group">
    <label for="alamat">Alamat</label>
    <input type="text" class="form-control" name="alamat" value="<?php echo $mahasiswa['alamat']; ?>" required>
    </div>
        <div class="mb-3">
          <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
          <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $mahasiswa['tgl_lahir']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="jurusan" class="form-label">Jurusan</label>
          <input type="text" class="form-control" name="jurusan" value="<?php echo $mahasiswa['jurusan']; ?>" required>
        </div>


<div class="form-group">
    <label for="email">E-mail</label>
    <input type="text" class="form-control" name="email" value="<?php echo $mahasiswa['email']; ?>" required>
    </div>

    <div class="form-group">
            <label for="no_telepon">No. Telepon</label>
            <input type="text" name="no_telepon" class="form-control" value="<?php echo $mahasiswa['no_telepon']; ?>">
          </div>
          <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" name="foto" class="form-control">
            <!-- Menampilkan foto saat ini -->
            <?php if ($mahasiswa['foto']): ?>
              <div class="mt-2">
                <img src="<?php echo base_url('assets/foto/' . $mahasiswa['foto']); ?>" alt="Current Photo"
                  style="max-width: 150px; max-height: 150px;">
                <p>Foto saat ini</p>
              </div>
            <?php endif; ?>
          </div>

        <button type="submit" class="btn btn-primary">Update Data</button>
        
      </form>
    </div>
    
  </section>
</div>