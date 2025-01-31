  <div class="content-wrapper">
    <style>
      /* Custom Styles for Dashboard */
.content-header {
    background-color: #f4f6f9;
    padding: 20px;
    border-bottom: 1px solid #dee2e6;
}

.small-box {
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.small-box:hover {
    transform: scale(1.05);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
}

.small-box .inner h3 {
    font-size: 28px;
    font-weight: bold;
}

.small-box .inner p {
    font-size: 16px;
    color: #ffffffd9;
}

.small-box .icon {
    font-size: 50px;
    opacity: 0.7;
    position: absolute;
    right: 20px;
    top: 10px;
    color: rgba(255, 255, 255, 0.8);
}

.small-box-footer {
    background-color: rgba(0, 0, 0, 0.1);
    text-decoration: none;
    color: white;
    padding: 10px;
    font-size: 14px;
}

.small-box-footer:hover {
    background-color: rgba(0, 0, 0, 0.2);
    text-decoration: underline;
}

.breadcrumb {
    background: none;
    margin-bottom: 0;
    padding: 0;
}

.breadcrumb-item a {
    color: #6c757d;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    color: #007bff;
}

    </style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <br>
        <!-- Info boxes -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $Mahasiswa ?></h3>

                <p>Mahasiswa</p>
              </div>
              <div class="icon">
                <i class="fas fa-shield-alt"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $Jurusan ?></h3>

                <p>Jurusan</p>
              </div>
              <div class="icon">
                <i class="fas fa-school"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $Kelas ?></h3>

                <p>Kelas</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $Jadwal ?></h3>
                <p>Jadwal</p>
              </div>
              <div class="icon">
                <i class="fas fa-book-open"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $Dosen ?></h3>

                <p>Dosen</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->