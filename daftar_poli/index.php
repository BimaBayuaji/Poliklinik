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
  if (isset($_POST['addDaftarPoli'])) {
    $queryPasien = mysqli_query($conn, "SELECT * FROM pasien ORDER BY id ASC");
    $no_rm = $_POST['no_rm'];
    $keluhan = $_POST['keluhan'];
    $poli = $_POST['poli'];
    $id_jadwal = $_POST['id_jadwal'];
    $nothing = false;
    if (!$nothing) {
      while ($row = mysqli_fetch_array($queryPasien)) {
        if ($no_rm == $row['no_rm']) {
          $id_pasien = $row['id'];
          $query = mysqli_query($conn, "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan) VALUES ('$id_pasien', '$id_jadwal', '$keluhan')");
          if ($query) {
            $lastInsertedID = mysqli_insert_id($conn);
            $query2 = mysqli_query($conn, "SELECT * FROM daftar_poli WHERE id = $lastInsertedID");
            if ($query2) {
              $item = mysqli_fetch_assoc($query2);
              $_SESSION['add_daftar_poli'] = array(
                'no_antrian' => $item['no_antrian']
              );
            }
          }
          $error = null;
          break;
        } else {
          $error = "Invalid credentials";
        }
      }
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
              <h1 class="m-0">Pendaftaran Poli</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <!-- Main content -->
      <section class="content">
        <?php if (isset($_SESSION['add_daftar_poli'])) : ?>
          <div class="container-fluid">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"><b>Pendaftaran Poli Berhasil!</b></h4>
              </div>
              <div class="card-body">
                <dl>
                  <dt>Nomor antrian anda</dt>
                  <dd><?php echo $_SESSION['add_daftar_poli']['no_antrian'] ?></dd>
                </dl>
                <p class="text-danger font-italic"><b>Simpan Nomor Antrian anda!</b></p>
              </div>
            </div>
          </div>
          <?php unset($_SESSION['add_daftar_poli']); ?>
        <?php endif ?>
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title text-danger"><b>Notice</b></h4>
            </div>
            <div class="card-body">
              <p class="card-text">Untuk mendapatkan nomor rekam medis, harap untuk melakukan pendaftaran baru</p>
              <a href="../daftar_baru/" class="btn btn-primary">Pendaftaran Baru</a>
            </div>
          </div>
        </div>
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <form action="../daftar_poli/" method="post">
                <div class="form-group">
                  <label for="addRMPasien">Nomor Rekam Medis</label>
                  <input required name="no_rm" type="text" class="form-control" id="addRMPasien" placeholder="ex: 202313-79" />
                  <?php if (isset($error)) : ?>
                    <p class="text-danger mt-2"><?php echo 'Nomor Rekam Medis salah' ?></p>
                    <?php unset($error) ?>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label>Keluhan</label>
                  <textarea name="keluhan" class="form-control" rows="3" placeholder="Keluhan"></textarea>
                </div>
                <div class="form-group">
                  <label for="addPoli">Pilih Poli</label>
                  <?php
                  require_once("../connection.php");
                  $queryPoli = mysqli_query($conn, "SELECT * FROM poli");
                  ?>
                  <select required name="poli" class="custom-select rounded-0" id="addPoli">
                    <option value="">-------</option>
                    <?php while ($item = mysqli_fetch_array($queryPoli)) : ?>
                      <option value="<?php echo $item['id'] ?>"><?php echo $item['nama_poli'] ?></option>
                    <?php endwhile ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="addJadwal">Pilih Jadwal</label>
                  <select required name="id_jadwal" class="custom-select rounded-0" id="addJadwal">
                    <option value="">-------</option>
                  </select>
                </div>
                <div class="row">
                  <div class="col">
                    <input type="submit" name="addDaftarPoli" value="Daftar" class="btn btn-primary" />
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
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
  <script>
    $(document).ready(function() {
      $('#addPoli').change(function() {
        var clickBtnValue = $(this).val();
        $.ajax({
          url: 'selectjadwal.php',
          type: 'GET',
          data: {
            id: clickBtnValue
          },
          dataType: 'json',
          success: function(data) {
            console.log(data);
            $('#addJadwal').empty()
            $('#addJadwal').append($('<option value="">-------</option>'));
            $.each(data, function(index, option) {
              var optionElement = $('<option>', {
                value: option.id,
                text: option.hari + ', ' + option.jam_mulai.slice(0, 5) + '-' + option.jam_selesai.slice(0, 5) + ' / ' + option.nama
              });
              $('#addJadwal').append(optionElement);
            });
          },
          error: function(error) {
            console.log('Error fetching data: ' + error);
          },
        })
      })
    })
  </script>
</body>

</html>