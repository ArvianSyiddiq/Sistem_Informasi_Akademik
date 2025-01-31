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

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <?php
                        $profile_picture = base_url('uploads/profile_pictures/' . ($user['profile_picture'] ?? 'default.png'));
                        ?>
                        <img src="<?= $profile_picture ?>" class="rounded-circle img-thumbnail mb-3" alt="Profile Picture" style="width: 150px; height: 150px; object-fit: cover;">
                        
                        <?= form_open_multipart('profile/update_profile_picture', ['class' => 'mb-3']) ?>
                            <div class="form-group">
                                <label for="profile_picture" class="btn btn-outline-primary btn-sm">
                                    Change Profile Picture
                                </label>
                                <input type="file" name="profile_picture" id="profile_picture" class="d-none" onchange="this.form.submit()">
                            </div>
                        <?= form_close() ?>
                        
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= $this->session->flashdata('success') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Information</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Name</th>
                                <td><?= htmlspecialchars($user['nama']) ?></td>
                            </tr>
                            <tr>
                                <th><?= $user['role'] == 'mahasiswa' ? 'NIM' : 'NIK/NIDN' ?></th>
                                <td><?= htmlspecialchars($user['identifier']) ?></td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td><?= htmlspecialchars($user['username']) ?></td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td><span class="badge bg-primary"><?= ucfirst(htmlspecialchars($user['role'])) ?></span></td>
                            </tr>
                        </table>
                    </div>
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