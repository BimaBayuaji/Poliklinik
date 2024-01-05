<?php
session_start();

// Check if the user is not authenticated
if (!isset($_SESSION['admin_authenticated']) || !$_SESSION['admin_authenticated']) {
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
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <?php
  require_once("../../connection.php");
  if (isset($_POST['addObat'])) {
    $nama = $_POST['nama'];
    $kemasan = $_POST['kemasan'];
    $harga = $_POST['harga'];

    $query = mysqli_query($conn, "INSERT INTO obat (nama_obat, kemasan, harga) VALUES ('$nama', '$kemasan', '$harga')");
    if ($query) {
      header('Refresh:0');
    } else {
      header('Refresh:0');
    }
  };
  if (isset($_POST['editObat'])) {
    $idObat = $_POST['idObat'];
    $nama = $_POST['nama'];
    $kemasan = $_POST['kemasan'];
    $harga = $_POST['harga'];

    $query = mysqli_query($conn, "UPDATE obat SET nama_obat = '$nama', kemasan = '$kemasan', harga = '$harga' WHERE id = $idObat");
    if ($query) {
      header('Refresh:0');
    } else {
      header('Refresh:0');
    }
  };
  if (isset($_POST["hapusObat"])) {
    $idObat = $_POST["hapusObat"];
    $query = mysqli_query($conn, "DELETE FROM obat WHERE id = $idObat");
    if ($query) {
      header('Refresh:0');
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
      <a href="../../admin" class="brand-link">
        <img src="https://w7.pngwing.com/pngs/429/434/png-transparent-computer-icons-icon-design-business-administration-admin-icon-hand-monochrome-silhouette.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <!-- <i class="nav-icon fas fa-user-tie brand-image"></i> -->
        <span class="brand-text font-weight-light">Admin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="../../admin/kelola_dokter/" class="nav-link">
                <i class="nav-icon fas fa-user-doctor"></i>
                <p>
                  Dokter
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../admin/kelola_poli/" class="nav-link">
                <i class="nav-icon fas fa-house-chimney-medical"></i>
                <p>
                  Poli
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../admin/kelola_obat/" class="nav-link">
                <i class="nav-icon fas fa-capsules"></i>
                <p>
                  Obat
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../admin/kelola_pasien/" class="nav-link">
                <i class="nav-icon fas fa-hospital-user"></i>
                <p>
                  Pasien
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
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Daftar Obat</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Obat</th>
                        <th>Kemasan</th>
                        <th>Harga</th>
                        <th style="width: 160px;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      require_once("../../connection.php");
                      $query = mysqli_query($conn, "SELECT * FROM obat ORDER BY id ASC");
                      $no = 1;
                      ?>
                      <?php while ($row = mysqli_fetch_array($query)) : ?>
                        <tr>
                          <td><?php echo $no ?></td>
                          <td><?php echo $row['nama_obat'] ?></td>
                          <td><?php echo $row['kemasan'] ?></td>
                          <td><?php echo 'Rp ', number_format($row['harga'], 2, ",", ".") ?></span></td>
                          <td>
                            <button type="button" value="<?php echo $row['id'] ?>" class="buttonEdit2 btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#modal-editDokter">
                              <i class="fa fa-pen"></i> Edit
                            </button>
                            <button type="button" value="<?php echo $row['id'] ?>" class="buttonHapus2 btn btn-danger btn-block text-nowrap" data-toggle="modal" data-target="#modal-sm">
                              <i class="fa fa-trash"></i> Hapus
                            </button>
                          </td>
                        </tr>
                        <?php $no++ ?>
                      <?php endwhile ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <dic class="m-0 float-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-addDokter">
                      <i class="fa fa-plus"></i> Tambah
                    </button>
                  </dic>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div><!-- /.container-fluid -->

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
                <h4 class="modal-title">Tambah Obat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="../../admin/kelola_obat/" method="post">
                  <div class="form-group">
                    <label for="addNamaObat">Nama Obat</label>
                    <input name="nama" type="text" class="form-control" id="addNamaObat" placeholder="Nama Obat" />
                  </div>
                  <div class="form-group">
                    <label for="addKemasanObat">Kemasan</label>
                    <input name="kemasan" type="text" class="form-control" id="addKemasanObat" placeholder="Kemasan" />
                  </div>
                  <div class="form-group">
                    <label for="addHargaObat">Harga</label>
                    <input name="harga" type="number" class="form-control" id="addHargaObat" placeholder="Harga" />
                  </div>
                  <div class="card-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Tutup
                    </button>
                    <input type="submit" name="addObat" value="Tambah" class="btn btn-primary float-right" />
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
                <h4 class="modal-title">Edit Data Obat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="../../admin/kelola_obat/" method="post">
                  <div class="form-group">
                    <label for="idObat">ID</label>
                    <input name="idObat" type="text" class="form-control" id="idObat" placeholder="ID Obat" readonly />
                  </div>
                  <div class="form-group">
                    <label for="editNamaObat">Nama Obat</label>
                    <input name="nama" type="text" class="form-control" id="editNamaObat" placeholder="Nama Obat" />
                  </div>
                  <div class="form-group">
                    <label for="editKemasanObat">Kemasan</label>
                    <input name="kemasan" type="text" class="form-control" id="editKemasanObat" placeholder="Kemasan" />
                  </div>
                  <div class="form-group">
                    <label for="editHargaObat">Harga</label>
                    <input name="harga" type="number" class="form-control" id="editHargaObat" placeholder="Harga" />
                  </div>
                  <div class="card-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Tutup
                    </button>
                    <input type="submit" name="editObat" value="Edit" class="buttonEdit btn btn-warning float-right" />
                  </div>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

      </section>
      <!-- /.content -->
    </div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- Toastr -->
  <script src="../../plugins/toastr/toastr.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
  <script>
    var selectedId = 0;
    $(function() {
      $('.toastrDefaultSuccess').click(function() {
        toastr.success('Item berhasil dihapus')
      });
    });
    $('.buttonHapus2').click(function() {
      selectedId = $(this).val();
      console.log(selectedId);
    })
    $('.buttonEdit2').click(function() {
      selectedId = $(this).val();
      $.ajax({
        url: 'obatJSON.php',
        type: 'GET',
        data: {
          id: selectedId
        },
        dataType: 'json',
        success: function(data) {
          $('#idObat').val(data.id);
          $('#editNamaObat').val(data.nama_obat);
          $('#editKemasanObat').val(data.kemasan);
          $('#editHargaObat').val(data.harga);
          console.log(data);
        },
        error: function(error) {
          console.log('Error fetching data: ' + error);
        },
      })
      console.log(selectedId);
    })
    $('.buttonHapus').click(function() {
      var clickBtnValue = selectedId;
      var ajaxurl = '../../admin/kelola_obat/';
      data = {
        'hapusObat': clickBtnValue
      };
      $.post(ajaxurl, data, function(response) {
        location.reload();
      });
    })
  </script>
</body>

</html>