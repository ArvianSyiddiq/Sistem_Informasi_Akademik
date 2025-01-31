<!-- filepath: /c:/xampp/htdocs/WEB_ENTERPRISE/application/views/kelas/manage_students.php -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Students for <?= $kelas['nama_kelas'] ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Students</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
  
                    <!-- /.card-header -->
    
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Enrolled Students in <?= $kelas['nama_kelas'] ?></h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <ul id="enrolled_students" class="list-group">
                            <?php foreach ($enrolled_students as $mhs): ?>
                                <li class="list-group-item"><?= $mhs['nama_mhs'] ?> 
                                    <a href="<?= base_url() ?>DataKelas/remove_student/<?= $mhs['id_kelas'] ?>/<?= $mhs['nim'] ?>" class="btn btn-danger btn-sm float-right">Remove</a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
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

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>