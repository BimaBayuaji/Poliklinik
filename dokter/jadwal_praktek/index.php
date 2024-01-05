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
  if (isset($_POST['addJadwal'])) {
    $hari = $_POST['hari'];
    $jammulai = $_POST['jammulai'];
    $jamselesai = $_POST['jamselesai'];
    $id_dokter = $_SESSION['id_dokter'];

    $query = mysqli_query($conn, "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) VALUES ('$id_dokter', '$hari', '$jammulai', '$jamselesai')");
    if ($query) {
      header('Refresh:0');
    } else {
      header('Refresh:0');
    }
  }
  if (isset($_POST["hapusJadwal"])) {
    $idJadwal = $_POST["hapusJadwal"];
    $query = mysqli_query($conn, "DELETE FROM jadwal_periksa WHERE id = $idJadwal");
    if ($query) {
      header('Refresh:0');
    } else {
      header('Refresh:0');
    }
  }
  if (isset($_POST['editJadwal'])) {
    $idJadwal = $_POST['idJadwal'];
    $hari = $_POST['hari'];
    $jammulai = $_POST['jammulai'];
    $jamselesai = $_POST['jamselesai'];
    $query = mysqli_query($conn, "UPDATE jadwal_periksa SET hari = '$hari', jam_mulai = '$jammulai', jam_selesai = '$jamselesai' WHERE id = $idJadwal");
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
              <h1 class="m-0">Jadwal Praktek</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th style="width: 160px;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $id_dokter = $_SESSION['id_dokter'];
                      require("../../connection.php");
                      $query = mysqli_query($conn, "SELECT * FROM jadwal_periksa WHERE id_dokter = $id_dokter");
                      $jumlah = mysqli_num_rows($query);
                      ?>
                      <?php while ($row = mysqli_fetch_array($query)) : ?>
                        <tr>
                          <td>1</td>
                          <td><?php echo $row['hari'] ?></td>
                          <td><?php echo substr($row['jam_mulai'], 0, 5) ?></td>
                          <td><?php echo substr($row['jam_selesai'], 0, 5) ?></td>
                          <td>
                            <button type="button" value="<?php echo $row['id'] ?>" class="buttonEdit2 btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#modal-editDokter">
                              <i class="fa fa-pen"></i> Edit
                            </button>
                            <button type="button" value="<?php echo $row['id'] ?>" class="buttonHapus2 btn btn-danger btn-block text-nowrap" data-toggle="modal" data-target="#modal-sm">
                              <i class="fa fa-trash"></i> Hapus
                            </button>
                          </td>
                        </tr>
                      <?php endwhile ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <?php if ($jumlah == 0) : ?>
                  <div class="card-footer clearfix">
                    <dic class="m-0 float-right">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-addDokter">
                        <i class="fa fa-plus"></i> Tambah
                      </button>
                    </dic>
                  </div>
                <?php endif ?>
              </div>
              <!-- /.card -->
            </div>
          </div>

          <div class="modal fade" id="modal-sm">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Hapus item?</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Item yang dihapus tidak dapat dipulihkan</p>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  <button type="button" class="buttonHapus btn btn-danger toastrDefaultSuccess" data-dismiss="modal">Hapus</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

          <div class="modal fade" id="modal-addDokter">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Jadwal</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="../../dokter/jadwal_praktek/" method="post">
                    <div class="form-group">
                      <label for="addHari">Hari</label>
                      <select onchange="console.log(this.value)" required name="hari" class="custom-select rounded-0" id="addHari">
                        <option value="">-------</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Jam Mulai</label>
                      <div class="input-group date" id="jammulai" data-target-input="nearest">
                        <input required name="jammulai" type="text" class="form-control datetimepicker-input" id="jammulai" data-toggle="datetimepicker" data-target="#jammulai" placeholder="jj:mm" />
                        <div class="input-group-append" data-target="#jammulai" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Jam Selesai</label>
                      <div class="input-group date" id="jamselesai" data-target-input="nearest">
                        <input required name="jamselesai" type="text" class="form-control datetimepicker-input" id="jamselesai" data-toggle="datetimepicker" data-target="#jamselesai" placeholder="jj:mm" />
                        <div class="input-group-append" data-target="#jamselesai" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                        Tutup
                      </button>
                      <input type="submit" name="addJadwal" value="Tambah" class="btn btn-primary float-right" />
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

          <div class="modal fade" id="modal-editDokter">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Data Dokter</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="../../dokter/jadwal_praktek/" method="post">
                    <div class="form-group">
                      <label for="idJadwal">ID</label>
                      <input name="idJadwal" type="text" class="form-control" id="idJadwal" placeholder="ID Jadwal" readonly />
                    </div>
                    <div class="form-group">
                      <label for="addHariEdit">Hari</label>
                      <select required name="hari" class="custom-select rounded-0" id="hariEdit">
                        <option value="">-------</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Jam Mulai</label>
                      <div class="input-group date" data-target-input="nearest">
                        <input required name="jammulai" type="text" class="form-control datetimepicker-input" id="jammulaiedit" data-toggle="datetimepicker" data-target="#jammulaiedit" placeholder="jj:mm" />
                        <div class="input-group-append" data-target="#jammulaiedit" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Jam Selesai</label>
                      <div class="input-group date" data-target-input="nearest">
                        <input required name="jamselesai" type="text" class="form-control datetimepicker-input" id="jamselesaiedit" data-toggle="datetimepicker" data-target="#jamselesaiedit" placeholder="jj:mm" />
                        <div class="input-group-append" data-target="#jamselesaiedit" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                        Tutup
                      </button>
                      <input type="submit" name="editJadwal" value="Edit" class="btn btn-warning float-right" />
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

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
  <script>
    $("#jammulai").on("input", function() {
      // Print entered value in a div box
      console.log($(this).val())
    });
    $('.buttonHapus2').click(function() {
      selectedId = $(this).val();
      console.log(selectedId);
    })
    $('.buttonHapus').click(function() {
      var clickBtnValue = selectedId;
      var ajaxurl = '../../dokter/jadwal_praktek/';
      data = {
        'hapusJadwal': clickBtnValue
      };
      $.post(ajaxurl, data, function(response) {
        location.reload();
      });
    })
    $('.buttonEdit2').click(function() {
      selectedId = $(this).val();
      $.ajax({
        url: 'jadwalJSON.php',
        type: 'GET',
        data: {
          id: selectedId
        },
        dataType: 'json',
        success: function(data) {
          let jammulai = data.jam_mulai.slice(0, -3);
          let jamselesai = data.jam_selesai.slice(0, -3);
          console.log(jammulai, jamselesai);
          $('#idJadwal').val(data.id);
          $('#hariEdit').val(data.hari);
          $('#jammulaiedit').val(jammulai);
          $('#jamselesaiedit').val(jamselesai);
          console.log(data);
        },
        error: function(error) {
          console.log('Error fetching data: ' + error);
        },
      })
      console.log(selectedId);
    })
    $(function() {
      //Date picker
      $('#jammulai').datetimepicker({
        format: 'HH:mm',
        pickDate: false,
        pickSeconds: false,
        pick12HourFormat: false,
        // disabledTimeIntervals: [
        //   [moment({
        //     h: 0
        //   }), moment({
        //     h: 8
        //   })],
        //   [moment({
        //     h: 18
        //   }), moment({
        //     h: 24
        //   })]
        // ],
      });
      $('#jammulaiedit').datetimepicker({
        format: 'HH:mm',
        pickDate: false,
        pickSeconds: false,
        pick12HourFormat: false
      });
      $('#jamselesai').datetimepicker({
        format: 'HH:mm',
        pickDate: false,
        pickSeconds: false,
        pick12HourFormat: false,
      });
      $('#jamselesaiedit').datetimepicker({
        format: 'HH:mm',
        pickDate: false,
        pickSeconds: false,
        pick12HourFormat: false
      });
    });
  </script>
</body>

</html>