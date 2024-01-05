<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poliklinik</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <?php
  require("../connection.php");
  if (isset($_POST['addPasien'])) {
    $nowYm = date("Ym");
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $noKTP = $_POST['no_ktp'];
    $noHP = $_POST['no_hp'];
    $query = mysqli_query($conn, "INSERT INTO pasien (nama, alamat, no_ktp, no_hp) VALUES ('$nama', '$alamat', '$noKTP', '$noHP')");
    if ($query) {
      $lastPasienQuery = mysqli_query($conn, "SELECT * FROM pasien ORDER BY id DESC LIMIT 1");
      $lastPasien = mysqli_fetch_assoc($lastPasienQuery);
      $idLastPasien = $lastPasien['id'];
      $query2 = mysqli_query($conn, "UPDATE pasien SET no_rm = '$nowYm-$idLastPasien' where id = $idLastPasien");
      if ($query2) {
        $_SESSION['add_pasien'] = array(
          'nama' => $nama,
          'alamat' => $alamat,
          'no_ktp' => $noKTP,
          'no_hp' => $noHP,
          'no_rm' => $nowYm . '-' . $idLastPasien,
        );
      }
    } else {
      header('Refresh:0');
    }
  }
  ?>
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar main-sidebar-custom sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../" class="brand-link">
        <img src="https://img.freepik.com/free-vector/hospital-building-concept-illustration_114360-8440.jpg?w=740&t=st=1703855634~exp=1703856234~hmac=5deb2bad6c59edea43525c543223f70a5f85327cd1a58e39054c03b365267b9d" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <!-- <i class="nav-icon fas fa-user-tie brand-image"></i> -->
        <span class="brand-text font-weight-light">Poliklinik</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="../daftar_baru/" class="nav-link">
                <i class="nav-icon fas fa-user-doctor"></i>
                <p>
                  Pendaftaran Baru
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../daftar_poli/" class="nav-link">
                <i class="nav-icon fas fa-house-chimney-medical"></i>
                <p>
                  Pendaftaran Poli
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Pendaftaran Pasien Baru</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <!-- Main content -->
      <section class="content">
        <?php if (isset($_SESSION['add_pasien'])) : ?>
          <div class="container-fluid">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"><b>Pendaftaran Berhasil!</b></h4>
              </div>
              <div class="card-body">
                <dl>
                  <dt>Nama</dt>
                  <dd><?php echo $_SESSION['add_pasien']['nama'] ?></dd>
                  <dt>Alamat</dt>
                  <dd><?php echo $_SESSION['add_pasien']['alamat'] ?></dd>
                  <dt>Nomor KTP</dt>
                  <dd><?php echo $_SESSION['add_pasien']['no_ktp'] ?></dd>
                  <dt>Nomor HP</dt>
                  <dd><?php echo $_SESSION['add_pasien']['no_hp'] ?></dd>
                  <dt>Nomor Rekam Medis</dt>
                  <dd><?php echo $_SESSION['add_pasien']['no_rm'] ?></dd>
                </dl>
                <p class="text-danger font-italic"><b>Simpan Nomor Rekam Medis anda!</b></p>
              </div>
            </div>
          </div>
          <?php unset($_SESSION['add_pasien']); ?>
        <?php endif ?>
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <form action="../daftar_baru/" method="post">
                <div class="form-group">
                  <label for="addNamaPasien">Nama Lengkap</label>
                  <input required name="nama" type="text" class="form-control" id="addNamaPasien" placeholder="Nama Lengkap" />
                </div>
                <div class="form-group">
                  <label for="addAlamatPasien">Alamat Tempat Tinggal</label>
                  <input required name="alamat" type="text" class="form-control" id="addAlamatPasien" placeholder="Alamat Tempat Tinggal" />
                </div>
                <div class="form-group">
                  <label for="addNoKTPPasien">Nomor KTP</label>
                  <input required name="no_ktp" type="text" class="form-control" id="addNoKTPPasien" placeholder="Nomor KTP" />
                </div>
                <div class="form-group">
                  <label for="addNoHPPasien">Nomor HP</label>
                  <input required name="no_hp" type="text" class="form-control" id="addNoHPPasien" placeholder="Nomor HP" />
                </div>
                <div class="row">
                  <div class="col">
                    <input type="submit" name="addPasien" value="Daftar" class="btn btn-primary" />
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.modal -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
  </div>
  <!-- ./wrapper -->

  <script>
    // function OpenBootstrapPopup() {
    //   $("#modal-success").modal('show');
    // }
    //
  </script>
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="../plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="../plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="../plugins/moment/moment.min.js"></script>
  <script src="../plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="../plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard.js"></script>
</body>

</html>