<div class="app-wrapper">
    <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="bi bi-list"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">
    <a class="nav-link" href="<?= base_url('pengguna') ?>" role="button">
        <img src="<?= base_url('assets/images/profile.jpg') ?>" alt="Profile" class="img-circle" style="width: 30px; height: 30px; object-fit: cover;">
    </a>
</li>
            </ul>
        </div>
    </nav>

    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
            <a href="#" class="brand-link">
                <span class="brand-text fw-light">siAkad</span>
            </a>
        </div>

        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                    <?php 
                    $role = $this->session->userdata('role');
                    
                    // Show Dashboard for admin users only
                    if ($role == 'admin'): ?>
                        <li class="nav-item">
                            <a href="<?= base_url('dashboard') ?>" class="nav-link <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if($role == 'admin'): ?>
                        <li class="nav-item">
                            <a href="<?= base_url('DataMahasiswa') ?>" class="nav-link <?= ($this->uri->segment(1) == 'DataMahasiswa' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-person"></i>
                                <p>Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('DataMahasiswa/dosen') ?>" class="nav-link <?= ($this->uri->segment(1) == 'DataMahasiswa' && $this->uri->segment(2) == 'dosen') ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-person-badge"></i>
                                <p>Dosen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('DataJurusan') ?>" class="nav-link <?= ($this->uri->segment(1) == 'DataJurusan') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-shield-alt"></i>
                                <p>Data Jurusan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('DataKelas') ?>" class="nav-link <?= ($this->uri->segment(1) == 'DataKelas') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-school"></i>
                                <p>Data Kelas</p>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Jadwal Perkuliahan - shown for all users -->
                    <li class="nav-item">
                        <a href="<?= base_url('Jadwal_Perkuliahan') ?>" class="nav-link <?= ($this->uri->segment(1) == 'Jadwal_Perkuliahan') ? 'active' : '' ?>">
                            <i class="nav-icon bi bi-calendar-event"></i>
                            <p>Jadwal Perkuliahan</p>
                        </a>
                    </li>

                    <!-- Logout - shown for all users -->
                    <li class="nav-item">
                        <a href="<?= site_url('auth/logout'); ?>" class="nav-link">
                            <i class="nav-icon bi bi-box-arrow-in-right"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
