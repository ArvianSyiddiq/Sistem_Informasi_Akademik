<div class="content-wrapper">
  <section class="content">
    <div class="container mt-5">
      <h4 class="mb-4"><strong>DETAIL DATA MAHASISWA</strong></h4>
      <table class="table table-bordered table-striped">
        <tr>
          <th>Nama Lengkap</th>
          <td><?php echo $mahasiswa->nama_mhs; ?></td>
        </tr>
        <tr>
          <th>NIM</th>
          <td><?php echo $mahasiswa->nim; ?></td>
        </tr>
        <tr>
          <th>Alamat</th>
          <td><?php echo $mahasiswa->alamat; ?></td>
        </tr>
        <tr>
          <th>Tanggal Lahir</th>
          <td><?php echo $mahasiswa->tgl_lahir; ?></td>
        </tr>
        <tr>
          <th>Jurusan</th>
          <td><?php echo $mahasiswa->jurusan; ?></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><?php echo $mahasiswa->email; ?></td>
        </tr>
        <tr>
          <th>No Telpon</th>
          <td><?php echo $mahasiswa->no_telepon; ?></td>
        </tr>
        <tr>
          <th>Foto</th>
          <td>
            <?php if (!empty($mahasiswa->foto)): ?>
              <img src="<?php echo base_url('assets/foto/' . $mahasiswa->foto); ?>" width="100" alt="Foto Mahasiswa">
            <?php else: ?>
              <p>Foto tidak tersedia</p>
            <?php endif; ?>
          </td>
        </tr>
      </table>
      <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-secondary">Kembali</a>
    </div>
  </section>
</div>
