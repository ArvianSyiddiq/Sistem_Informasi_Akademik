<div class="content" id="content">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-9">
                    <h3 class="mb-0"><?= $judul ?></h3>
                </div>
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $judul ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Tampilkan pesan flashdata jika ada -->
    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header blue-card">
                    Edit Profil
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('index.php/Pengguna'); ?>" enctype="multipart/form-data">
                        <div class="form-group text-center">
                            <!-- Tampilkan gambar profil -->
                            <div class="profile-round">
                                <img src="<?= base_url('uploads/' . $pengguna['gambar']); ?>" alt="Profile Picture"
                                    class="rounded-circle" style="width: 100px; height: 100px;">
                            </div>
                            <br>
                            <input type="file" class="form-control-file mt-2" name="gambar" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="nama_pengguna">Username</label>
                            <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna"
                                placeholder="Ganti Username..." value="<?= $pengguna['nama_pengguna']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Ganti Email..." value="<?= $pengguna['email']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </form>
                    <br>
                    <a href="<?= base_url('index.php/password'); ?>"
                        class="btn btn-outline-danger btn-block">Ganti Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('menu-toggle').addEventListener('click', function () {
        var sidebar = document.getElementById('sidebar');
        var content = document.getElementById('content');
        var footer = document.querySelector('footer');

        sidebar.classList.toggle('closed');
        content.classList.toggle('shifted');

        // Toggle class full-width pada footer
        footer.classList.toggle('full-width');
    });
</script>
