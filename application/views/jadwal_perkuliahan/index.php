<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jadwal Perkuliahan</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('flash_jadwal')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fas fa-check"></i>Data Berhasil <?= $this->session->flashdata('flash_jadwal'); ?></h6>
            </div>
        <?php endif; ?>

        <!-- Flash message for errors -->
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fas fa-ban"></i>Error</h6>
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?php if ($is_admin): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Tambah Jadwal</h5>
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
                                    <form action="<?= base_url('Jadwal_Perkuliahan/validation_form') ?>" method="post" id="jadwalForm">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Hari</label>
                                                    <select name="hari" class="form-control select2">
                                                        <?php foreach ($hari as $h): ?>
                                                            <option value="<?= $h ?>"><?= $h ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Kelas</label>
                                                    <select name="id_kelas" class="form-control select2">
                                                        <?php foreach ($kelas as $k): ?>
                                                            <option value="<?= $k->id_kelas ?>"><?= $k->nama_kelas ?> - <?= $k->nama_matkul ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Sesi</label>
                                                    <input type="number" name="sesi" class="form-control" min="0" max="10">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Durasi</label>
                                                    <input type="number" name="durasi" class="form-control" min="1" max="4">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" onclick="console.log('Form submitted')">Simpan</button>
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
        <?php endif; ?>

 <!-- Update the first table section in index.php -->
<div class="card">
    <div class="card-body">
        <table id="jadwalTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Hari</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Keterangan</th>
                    <th>Sesi Ke</th>
                    <th>Durasi</th>
                    <th>Dosen</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($jadwal as $j): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $j['hari'] ?></td>
                    <td><?= $j['nama_kelas'] ?></td>
                    <td><?= $j['nama_jurusan'] ?></td>
                    <td><?= $j['nama_matkul'] ?></td>
                    <td><?= $j['sesi'] ?></td>
                    <td><?= $j['durasi'] ?></td>
                    <td><?= $j['nama_dosen'] ?></td>
                    <td>
                        <?php if ($is_admin): ?>
                            <a href="<?= base_url('Jadwal_Perkuliahan/hapus/'.$j['id_jadwal']) ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="mt-3">
            <?= $pagination ?>
        </div>
    </div>
</div>

<!-- Update the Per Jurusan section -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Jadwal Per Jurusan</h3>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="jadwalTab" role="tablist">
            <?php foreach ($hari as $index => $h): ?>
            <li class="nav-item">
                <a class="nav-link <?= $index === 0 ? 'active' : '' ?>" 
                   id="<?= strtolower($h) ?>-tab" 
                   data-toggle="tab" 
                   href="#<?= strtolower($h) ?>" 
                   role="tab"
                   data-hari="<?= $h ?>"><?= $h ?></a>
            </li>
            <?php endforeach; ?>
        </ul>

        <div class="tab-content mt-3" id="jadwalTabContent">
    <?php foreach ($hari as $index => $h): ?>
    <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?>" 
         id="<?= strtolower($h) ?>" 
         role="tabpanel">
        <div class="table-responsive jadwal-container">
            <!-- Content will be loaded via AJAX -->
        </div>
        <div class="pagination-container mt-3 d-flex justify-content-end">
            <!-- Pagination will be loaded via AJAX -->
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Add this JavaScript to handle the per-jurusan pagination -->
<script>
$(document).ready(function() {
    function loadJadwalPerJurusan(hari, page = 0) {
        $.ajax({
            url: '<?= base_url("Jadwal_Perkuliahan/get_jadwal_per_jurusan/") ?>' + hari + '/' + page,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var container = $('#' + hari.toLowerCase() + ' .jadwal-container');
                var paginationContainer = $('#' + hari.toLowerCase() + ' .pagination-container');
                
                // Build table
                var tableHtml = buildJadwalTable(data.jadwal);
                container.html(tableHtml);
                
                // Set pagination HTML
                paginationContainer.html(data.pagination);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    function buildJadwalTable(jadwal) {
        if (!jadwal || jadwal.length === 0) {
            return '<p>No data available for this day.</p>';
        }

        var html = '<table class="table table-bordered table-schedule">';
        html += '<thead><tr><th width="15%">Jurusan</th><th>Kelas</th><th>Mata Kuliah</th><th width="10%">Waktu</th><th>Dosen</th></tr></thead><tbody>';
        
        // Group jadwal by jurusan
        var groupedJadwal = {};
        jadwal.forEach(function(item) {
            if (!groupedJadwal[item.nama_jurusan]) {
                groupedJadwal[item.nama_jurusan] = [];
            }
            groupedJadwal[item.nama_jurusan].push(item);
        });

        // Build rows for each jurusan
        Object.keys(groupedJadwal).forEach(function(jurusan) {
            var jadwalList = groupedJadwal[jurusan];
            jadwalList.forEach(function(item, index) {
                html += '<tr>';
                // Only add jurusan cell for first row of each group
                if (index === 0) {
                    html += '<td rowspan="' + jadwalList.length + '">' + jurusan + '</td>';
                }
                html += '<td>' + item.nama_kelas + '</td>';
                html += '<td>' + item.nama_matkul + '</td>';
                html += '<td>Sesi ' + item.sesi + ' (' + item.durasi + ' jam)</td>';
                html += '<td>' + (item.nama_dosen || '-') + '</td>';
                html += '</tr>';
            });
        });

        html += '</tbody></table>';
        return html;
    }

    // Load initial data for the first tab
    loadJadwalPerJurusan('Senin');

    // Handle tab changes
    $('#jadwalTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var hari = $(e.target).data('hari');
        loadJadwalPerJurusan(hari);
    });

    // Handle pagination clicks
    $(document).on('click', '.pagination-container .pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var hari = $(this).closest('.tab-pane').attr('id');
        // Extract page number from URL
        var page = url.split('/').pop();
        loadJadwalPerJurusan(
            hari.charAt(0).toUpperCase() + hari.slice(1), 
            page
        );
    });
});
</script>

<style>
.table-schedule {
    font-size: 0.9rem;
}

.table-schedule td {
    vertical-align: middle !important;
}

.tab-content {
    padding: 20px 0;
}

.select2-container {
    width: 100% !important;
}
</style>