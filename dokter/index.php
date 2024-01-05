<?php
session_start();

// Check if the user is not authenticated
if (!isset($_SESSION['dokter_authenticated']) || !$_SESSION['dokter_authenticated']) {
  header('Location: ../login/');
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
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
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
  require_once("../connection.php");
  if (isset($_POST['addPeriksa'])) {
    $id_daftar_poli = $_POST['id_daftar_poli'];
    $tgl_periksa = $_POST['tgl_periksa'];
    $mysqlFormattedDate = date('Y-m-d', strtotime($tgl_periksa));
    $catatan = $_POST['catatan'];
    $biaya_periksa = $_POST['biaya_periksa'];
    $id_obat = $_POST['id_obat'];
    $query = mysqli_query($conn, "INSERT INTO periksa (id_daftar_poli, tgl_periksa, catatan, biaya_periksa) VALUES ('$id_daftar_poli', '$mysqlFormattedDate', '$catatan', '$biaya_periksa')");
    if ($query) {
      $lastInsertedIDPeriksa = mysqli_insert_id($conn);
      $queryUpdateDaftarPoli = mysqli_query($conn, "UPDATE daftar_poli SET sudah_periksa = 1 WHERE id = $id_daftar_poli");
      if ($queryUpdateDaftarPoli) {
        $query2 = mysqli_query($conn, "INSERT INTO detail_periksa (id_periksa, id_obat) VALUES ('$lastInsertedIDPeriksa', '$id_obat')");
      }
    }
  }
  ?>
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
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
      <a href="../dokter" class="brand-link">
        <img src="https://cdn-icons-png.flaticon.com/512/6069/6069189.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <!-- <i class="nav-icon fas fa-user-tie brand-image"></i> -->
        <?php
        require_once("../connection.php");
        $id = $_SESSION['id_dokter'];
        $queryDokter = mysqli_query($conn, "SELECT * FROM dokter WHERE id = $id");
        $dokter = mysqli_fetch_assoc($queryDokter);
        ?>
        <span class="brand-text font-weight-light">Dokter</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="jadwal_praktek" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                  Jadwal Praktek
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="riwayat_pasien" class="nav-link">
                <i class="nav-icon fas fa-notes-medical"></i>
                <p>
                  Riwayat Periksa
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="profil_dokter" class="nav-link">
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
            <form method="post" action="../login/logout.php">
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
              <h1 class="m-0">Halo <?php echo $dokter['nama'] ?></h1>
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
                <div class="card-header">
                  <h3 class="card-title">Daftar Pasien Periksa</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Nomor Antri</th>
                        <th>Nama Pasien</th>
                        <th>Jadwal Periksa</th>
                        <th>Keluhan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="table-body">
                      <?php
                      $id_dokter = $_SESSION['id_dokter'];
                      require("../connection.php");
                      $query = mysqli_query($conn, "SELECT daftar_poli.id, daftar_poli.no_antrian, daftar_poli.keluhan, pasien.nama as nama_pasien, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai FROM daftar_poli JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id JOIN dokter ON jadwal_periksa.id_dokter = dokter.id JOIN pasien ON daftar_poli.id_pasien = pasien.id WHERE jadwal_periksa.id_dokter = $id_dokter AND daftar_poli.sudah_periksa = 0;");
                      ?>
                      <?php while ($row = mysqli_fetch_array($query)) : ?>
                        <tr>
                          <td><?php echo $row['no_antrian'] ?></td>
                          <td><?php echo $row['nama_pasien'] ?></td>
                          <td><?php echo $row['hari'] . ', ' . substr($row['jam_mulai'], 0, 5) . '-' . substr($row['jam_selesai'], 0, 5) ?></td>
                          <td><?php echo $row['keluhan'] ?></td>
                          <td>
                            <div class="margin">
                              <button value="<?php echo $row['id'] ?>" type="button" class="buttonperiksa btn btn-warning" data-toggle="modal" data-target="#modal-periksa">
                                <i class="fa fa-pen"></i> Periksa
                              </button>
                            </div>
                          </td>
                        </tr>
                      <?php endwhile ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

          <div class="modal fade" id="modal-periksa">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Pasien Periksa</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="../dokter/" method="post">
                    <div class="form-group">
                      <label for="idDaftarPoli">ID Pendaftaran Poli</label>
                      <input name="id_daftar_poli" type="text" class="form-control" id="idDaftarPoli" placeholder="ID DaftarPoli" readonly />
                    </div>
                    <div class="form-group">
                      <label for="addNamaPasien">Nama</label>
                      <input type="text" class="form-control" id="addNamaPasien" placeholder="Nama" disabled />
                    </div>
                    <div class="form-group">
                      <label>Tanggal Periksa</label>
                      <div class="input-group date" id="tanggalperiksa" data-target-input="nearest">
                        <input name="tgl_periksa" type="text" class="tglan form-control datetimepicker-input" id="tanggalperiksa" data-toggle="datetimepicker" data-target="#tanggalperiksa" placeholder="dd/mm/yy" />
                        <div class="input-group-append" data-target="#tanggalperiksa" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Catatan</label>
                      <textarea name="catatan" class="form-control" rows="3" placeholder="Catatan Periksa"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Obat</label>
                      <select name="id_obat" id="pilihobat" class="custom-select rounded-0" style="width: 100%;">
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="addBiaya">Biaya Periksa</label>
                      <input type="text" class="form-control" id="addBiaya" placeholder="Nama" disabled />
                      <input name="biaya_periksa" type="hidden" class="form-control" id="addBiayaHidden" placeholder="Nama" />
                    </div>
                    <div class="card-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                        Tutup
                      </button>
                      <input type="submit" name="addPeriksa" value="Selesai" class="btn btn-warning float-right" />
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
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="../plugins/select2/js/select2.full.min.js"></script>
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
    let biayaawal = 150000
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      //Date picker
      $('#tanggalperiksa').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'id',
      });
    });
    $(document).ready(function() {
      let dataQuery = []
      let dataObat = []
      $.ajax({
        url: 'query.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          dataQuery = data
          console.log(dataQuery);
        },
        error: function(error) {
          console.log('Error fetching data: ' + error);
        },
      })
      $('.buttonperiksa').click(function() {
        var id_daftar_poli = $(this).val()
        $('#pilihobat').val("")
        biayaawal = 150000
        $('#addBiaya').val("Rp " + rpFormat(biayaawal) + ",00")
        $.each(dataQuery, function(index, item) {
          if (item.id == id_daftar_poli) {
            $('#addNamaPasien').val(item.nama_pasien)
            $('#idDaftarPoli').val(item.id)
          }
        });
        $.ajax({
          url: 'queryobat.php',
          method: 'GET',
          dataType: 'json',
          success: function(data) {
            console.log(data);
            dataObat = data
            $('#pilihobat').empty()
            $('#pilihobat').append($('<option value="">-------</option>'));
            $.each(data, function(index, option) {
              console.log(option);
              var optionElement = $('<option>', {
                value: option.id,
                text: option.nama_obat + " / Rp " + rpFormat(option.harga) + ",00"
              })
              $('#pilihobat').append(optionElement);
            });
          },
          error: function(xhr, status, error) {
            console.error('Error fetching data:', status, error);
          }
        });
      })

      function rpFormat(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
      }

      $('#addBiaya').val("Rp " + rpFormat(biayaawal) + ",00")
      $('#pilihobat').change(function() {
        console.log($('#pilihobat').val());
        biayaawal = 150000
        $.each(dataObat, function(index, option) {
          if (option.id == $('#pilihobat').val()) {
            biayaawal += parseInt(option.harga)
          }
        });
        console.log(biayaawal);
        $('#addBiaya').val("Rp " + rpFormat(biayaawal) + ",00")
        $('#addBiayaHidden').val(biayaawal)
        console.log('biaya hidden' + $('#addBiayaHidden').val());
      })
    })
    $('.tglan').change(function() {
      console.log($('.tglan').val());
    })
  </script>
</body>

</html>