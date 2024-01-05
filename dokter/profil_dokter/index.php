<?php
session_start();

// Check if the user is not authenticated
if (!isset($_SESSION['dokter_authenticated']) || !$_SESSION['dokter_authenticated']) {
  header('Location: ../../login/');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poliklinik</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <?php
  require_once("../../connection.php");
  if (isset($_POST['editDokter'])) {
    $idDokter = $_SESSION['id_dokter'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $id_poli = $_POST['id_poli'];
    $password = $_POST['password'];
    $query = mysqli_query($conn, "UPDATE dokter SET nama = '$nama', alamat = '$alamat', no_hp = '$no_hp', id_poli = '$id_poli', password = '$password' WHERE id = $idDokter");
    if ($query) {
      header('Refresh:0');
    } else {
      header('Refresh:0');
    }
  };
  ?>
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div> -->

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
      <a href="../../dokter" class="brand-link">
        <img src="https://cdn-icons-png.flaticon.com/512/6069/6069189.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <!-- <i class="nav-icon fas fa-user-tie brand-image"></i> -->
        <span class="brand-text font-weight-light">Dokter</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="../../dokter/jadwal_praktek" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                  Jadwal Praktek
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../dokter/riwayat_pasien" class="nav-link">
                <i class="nav-icon fas fa-notes-medical"></i>
                <p>
                  Riwayat Periksa
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../dokter/profil_dokter" class="nav-link">
                <i class="nav-icon fas fa-user-doctor"></i>
                <p>
                  Profil
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
      <div class="sidebar sidebar-custom">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <form method="post" action="../../login/logout.php">
              <button class="btn nav-link btn-link text-dark d-flex justify-content-start align-items-center">
                <i class="fas fa-right-from-bracket mr-1"></i>
                <p>Logout</p>
              </button>
            </form>
          </li>
        </ul>
      </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Profil Dokter</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <?php
              require_once("../../connection.php");
              $id_dokter = $_SESSION['id_dokter'];
              $queryDokter = mysqli_query($conn, "SELECT * FROM dokter WHERE id = $id_dokter");
              $dataDokter = mysqli_fetch_assoc($queryDokter);
              $queryPoli = mysqli_query($conn, "SELECT * FROM poli");
              while ($item = mysqli_fetch_array($queryPoli)) {
                $poli[] = $item;
              }
              ?>
              <form action="../profil_dokter/" method="post">
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input required value="<?php echo $dataDokter['nama'] ?>" name="nama" type="text" class="form-control" id="nama" placeholder="Nama Lengkap" />
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat Tempat Tinggal</label>
                  <input required value="<?php echo $dataDokter['alamat'] ?>" name="alamat" type="text" class="form-control" id="alamat" placeholder="Alamat Tempat Tinggal" />
                </div>
                <div class="form-group">
                  <label for="no_hp">Nomor HP</label>
                  <input required value="<?php echo $dataDokter['no_hp'] ?>" name="no_hp" type="text" class="form-control" id="no_hp" placeholder="Nomor KTP" />
                </div>
                <div class="form-group">
                  <label for="id_poli">Poli</label>
                  <select required name="id_poli" class="custom-select rounded-0" id="id_poli">
                    <option value="">-------</option>
                    <?php foreach ($poli as $item) : ?>
                      <?php if ($item['id'] == $dataDokter['id_poli']) : ?>
                        <option selected <?php  ?> value="<?php echo $item['id'] ?>"><?php echo $item['nama_poli'] ?></option>
                      <?php else : ?>
                        <option <?php  ?> value="<?php echo $item['id'] ?>"><?php echo $item['nama_poli'] ?></option>
                      <?php endif ?>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input required name="password" value="<?php echo $dataDokter['password'] ?>" type="password" class="form-control" id="password" placeholder="Password" />
                </div>
                <div class="row">
                  <div class="col">
                    <input type="submit" name="editDokter" value="Edit" class="btn btn-primary" />
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="../../plugins/select2/js/select2.full.min.js"></script>
  <!-- ChartJS -->
  <script src="../../plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="../../plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="../../plugins/moment/moment.min.js"></script>
  <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../../dist/js/pages/dashboard.js"></script>
</body>

</html>