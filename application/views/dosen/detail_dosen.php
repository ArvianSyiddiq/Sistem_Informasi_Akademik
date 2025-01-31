<div class="content-wrapper">
  <section class="content">
    <div class="container mt-5">
      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0"><strong>DETAIL DATA DOSEN</strong></h4>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <tr>
              <th>Nama Lengkap</th>
              <td><?php echo $dosen->nama; ?></td>
            </tr>
            <tr>
              <th>NIK NIDN</th>
              <td><?php echo $dosen->nik_nidn; ?></td>
            </tr>
            <tr>
              <th>Prodi</th>
              <td><?php echo $dosen->prodi; ?></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><?php echo $dosen->email; ?></td>
            </tr>
            <tr>
              <th>No Telepon</th>
              <td><?php echo $dosen->no_telp; ?></td>
            </tr>
            <tr>
              <th>Foto</th>
              <td>
                <?php if (!empty($dosen->foto)): ?>
                  <img src="<?php echo base_url('assets/foto/' . $dosen->foto); ?>" class="img-thumbnail" width="100" alt="Foto Dosen">
                <?php else: ?>
                  <p class="text-muted">Foto tidak tersedia</p>
                <?php endif; ?>
              </td>
            </tr>
          </table>
          <a href="<?php echo site_url('DataMahasiswa/dosen'); ?>" class="btn btn-secondary mt-3">
            <i class="fas fa-arrow-left"></i> Kembali
          </a>
        </div>
      </div>
    </div>
  </section>
</div>  