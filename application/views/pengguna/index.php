<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <?php
                    // Cek apakah gambar profil tersedia atau gunakan placeholder default
                    $profile_picture = !empty($profile_picture) && file_exists('./assets/foto/' . $profile_picture) 
                        ? base_url('assets/foto/' . $profile_picture) 
                        : base_url('assets/foto/default.png');
                    ?>
                    <img src="<?= $profile_picture ?>" class="rounded-circle img-thumbnail mb-3" alt="Profile Picture" style="width: 150px; height: 150px; object-fit: cover;">
                    
                    <?= form_open_multipart('pengguna/update_profile_picture', ['class' => 'mb-3']) ?>
                        <div class="form-group">
                            <label for="profile_picture" class="btn btn-outline-primary btn-sm">
                                Change Profile Picture
                            </label>
                            <input type="file" name="profile_picture" id="profile_picture" class="d-none" onchange="this.form.submit()">
                        </div>
                    <?= form_close() ?>
                    
                    <?php if ($this->session->flashdata('message')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('message'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                            <td><?= htmlspecialchars($username) ?></td>
                        </tr>   
                        <tr>
                            <th>Role</th>
                            <td><span class="badge bg-primary"><?= ucfirst(htmlspecialchars($pengguna['role'])) ?></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
