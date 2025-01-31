<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Kelas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Kelas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- NOTIFIKASI -->
        <?php if ($this->session->flashdata('flash_kelas')) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fas fa-check"></i> <?= $this->session->flashdata('flash_kelas'); ?></h6>
            </div>
        <?php } ?>

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
                                <form action="<?= base_url() ?>DataKelas/validation_form" method="post" accept-charset="utf-8">
                                    <div class="card-body"> 
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addKelasModal">
            Add New Kelas
        </button>
        <br><br>
                                        <div class="form-group">
                                            <label for="id_jur">Jurusan</label>
                                            <select class="form-control" name="id_jur" id="id_jur">
                                                <option value="">Select Jurusan</option>
                                                <?php foreach ($jurusan as $jur) { ?>
                                                    <option value="<?= $jur->id_jurusan ?>"><?= $jur->nama_jurusan ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelas">Kelas</label>
                                            <select class="form-control" name="kelas" id="kelas">
                                                <option value="">Select Kelas</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nm_kelas">Nama Kelas</label>
                                            <input type="text" class="form-control" name="nm_kelas" id="nm_kelas" placeholder="Enter Nama Kelas">
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

        <!-- Button to trigger modal -->

        <!-- Modal for adding new kelas -->
        <div class="modal fade" id="addKelasModal" tabindex="-1" role="dialog" aria-labelledby="addKelasModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addKelasModalLabel">Add New Kelas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addKelasForm" method="post" accept-charset="utf-8">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="new_id_jur">Jurusan</label>
                                <select class="form-control" name="new_id_jur" id="new_id_jur">
                                    <option value="">Select Jurusan</option>
                                    <?php foreach ($jurusan as $jur) { ?>
                                        <option value="<?= $jur->id_jurusan ?>"><?= $jur->nama_jurusan ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="new_kelas">Kelas</label>
                                <input type="text" class="form-control" name="new_kelas" id="new_kelas" placeholder="Enter Kelas">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Kelas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- list data -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="table-container">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kelas</th>
                                            <th>Jurusan</th>
                                            <th>Nama Kelas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($kelas as $row) { ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $row['kelas'] ?></td>
                                                <td><?= $row['nama_jurusan'] ?></td>
                                                <td><?= $row['nama_kelas'] ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="<?= base_url() ?>DataKelas/hapus/<?= $row['id_kelas'] ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#assignDosenModal" data-id="<?= $row['id_kelas'] ?>">Assign Dosen</button>
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#manageMahasiswaModal" data-id="<?= $row['id_kelas'] ?>">Manage Mahasiswa</button>
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
                        <!-- ./card-body -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal for assigning dosen -->
<div class="modal fade" id="assignDosenModal" tabindex="-1" role="dialog" aria-labelledby="assignDosenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignDosenModalLabel">Assign Dosen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="assignDosenForm" method="post" action="<?= base_url() ?>DataKelas/assignDosen">
                <div class="modal-body">
                    <input type="hidden" name="id_kelas" id="assign_id_kelas">
                    <div class="form-group">
                        <label for="nik_nidn">Dosen</label>
                        <select class="form-control" name="nik_nidn" id="nik_nidn">
                            <option value="">Select Dosen</option>
                            <?php foreach ($dosen as $dsn) { ?>
                                <option value="<?= $dsn->nik_nidn ?>"><?= $dsn->nama ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign Dosen</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for managing mahasiswa -->
<div class="modal fade" id="manageMahasiswaModal" tabindex="-1" role="dialog" aria-labelledby="manageMahasiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageMahasiswaModalLabel">Manage Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="manageMahasiswaForm" method="post" action="<?= base_url() ?>DataKelas/add_students">
                <div class="modal-body">
                    <input type="hidden" name="id_kelas" id="manage_id_kelas">
                    <div class="form-group">
                        <label for="students">Select Mahasiswa</label>
                        <select class="form-control select2" name="students[]" id="students" multiple="multiple" style="width: 100%;">
    <?php 
    if (isset($available_students)) {
        foreach ($available_students as $mhs) { 
            // Check if student is already enrolled
            $is_enrolled = false;
            if (isset($enrolled_students)) {
                foreach ($enrolled_students as $enrolled) {
                    if ($enrolled['nim'] == $mhs->nim) {
                        $is_enrolled = true;
                        break;
                    }
                }
            }
            // Only show if not already enrolled
            if (!$is_enrolled) {
    ?>
                <option value="<?= $mhs->nim ?>"><?= $mhs->nama_mhs ?></option>
    <?php 
            }
        }
    } 
    ?>
</select>
                    </div>
                            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Mahasiswa</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#id_jur').change(function() {
            var id_jurusan = $(this).val();
            if (id_jurusan != '') {
                $.ajax({
                    url: "<?= base_url(); ?>DataKelas/getKelasByJurusan",
                    method: "POST",
                    data: {id_jurusan: id_jurusan},
                    success: function(data) {
                        var kelasOptions = '<option value="">Select Kelas</option>';
                        var kelasList = JSON.parse(data);
                        $.each(kelasList, function(index, kelas) {
                            kelasOptions += '<option value="' + kelas.id_matkul + '">' + kelas.nama_matkul + '</option>';
                        });
                        $('#kelas').html(kelasOptions);
                    }
                });
            } else {
                $('#kelas').html('<option value="">Select Kelas</option>');
            }
        });

        $('#addKelasForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?= base_url(); ?>DataKelas/addNewKelas",
                method: "POST",
                data: $(this).serialize(),
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.status == 'success') {
                        $('#addKelasModal').modal('hide');
                        $('#kelas').append('<option value="' + response.id_matkul + '">' + response.nama_matkul + '</option>');
                        $('#addKelasForm')[0].reset(); // Reset the form fields
                        alert('Kelas berhasil ditambahkan');
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        });

        $('#assignDosenModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id_kelas = button.data('id');
            var modal = $(this);
            modal.find('#assign_id_kelas').val(id_kelas);
        });

        $('#manageMahasiswaModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id_kelas = button.data('id');
            var modal = $(this);
            modal.find('#manage_id_kelas').val(id_kelas);
        });

        $('.select2').select2();
    });
</script>