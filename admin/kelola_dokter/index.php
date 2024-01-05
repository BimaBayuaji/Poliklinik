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
  if (isset($_POST['addDokter'])) {
    $namaDokter = $_POST['namaDokter'];
    $alamat = $_POST['alamat'];
    $noHP = $_POST['noHP'];
    $poli = $_POST['poli'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "INSERT INTO dokter (nama, alamat, no_hp, id_poli, password) VALUES ('$namaDokter', '$alamat', '$noHP', '$poli', '$password')");
    if ($query) {
      header('Refresh:0');
    } else {
      header('Refresh:0');
    }
  };
  if (isset($_POST["hapusDokter"])) {
    $idDokter = $_POST["hapusDokter"];
    $query = mysqli_query($conn, "DELETE FROM dokter WHERE id = $idDokter");
    if ($query) {
      header('Refresh:0');
    } else {
      header('Refresh:0');
    }
  }
  if (isset($_POST['editDokter'])) {
    $idDokter = $_POST['idDokter'];
    $editNama = $_POST['editNama'];
    $editAlamat = $_POST['editAlamat'];
    $editNoHP = $_POST['editNoHP'];
    $editPoli = $_POST['editPoli'];

    $query = mysqli_query($conn, "UPDATE dokter SET nama = '$editNama', alamat = '$editAlamat', no_hp = '$editNoHP', id_poli = '$editPoli' WHERE id = $idDokter");
    if ($query) {
      header('Refresh:0');
    } else {
      header('Refresh:0');
    }
  };
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
              <h1>Daftar Dokter</h1>
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
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nomor HP</th>
                        <th>Poli</th>
                        <th style="width: 160px;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      require_once("../../connection.php");
                      $dokter = array();
                      $poli = array();
                      $queryDokter = mysqli_query($conn, "SELECT * FROM dokter ORDER BY id ASC");
                      while ($row = mysqli_fetch_array($queryDokter)) {
                        $dokter[] = $row;
                      }
                      $queryPoli = mysqli_query($conn, "SELECT * FROM poli");
                      while ($item = mysqli_fetch_array($queryPoli)) {
                        $poli[] = $item;
                      }
                      $no = 1;
                      $idDokter = 0;
                      ?>
                      <?php foreach ($dokter as $row) : ?>
                        <tr>
                          <td><?php echo $no ?></td>
                          <td><?php echo $row['nama'] ?></td>
                          <td><?php echo $row['alamat'] ?></td>
                          <td><?php echo $row['no_hp'] ?></td>
                          <?php foreach ($poli as $item) : ?>
                            <?php if ($row['id_poli'] == $item['id']) : ?>
                              <td><?php echo $item['nama_poli'] ?></td>
                            <?php endif ?>
                          <?php endforeach ?>
                          <td>
                            <button value="<?php echo $row['id'] ?>" type="button" class="buttonEdit2 btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#modal-editDokter">
                              <i class="fa fa-pen"></i> Edit
                            </button>
                            <button value="<?php echo $row['id'] ?>" type="button" class="buttonHapus2 btn btn-danger btn-block text-nowrap" data-toggle="modal" data-target="#modal-sm">
                              <i class="fa fa-trash"></i> Hapus
                            </button>
                          </td>
                        </tr>
                        <?php $no++ ?>
                      <?php endforeach; ?>
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
                <h4 class="modal-title">Tambah Dokter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="../../admin/kelola_dokter/" method="post">
                  <div class="form-group">
                    <label for="addNamaDokter">Nama</label>
                    <input required name="namaDokter" type="text" class="form-control" id="addNamaDokter" placeholder="Nama" />
                  </div>
                  <div class="form-group">
                    <label for="addAlamatDokter">Alamat</label>
                    <input required name="alamat" type="text" class="form-control" id="addAlamatDokter" placeholder="Alamat" />
                  </div>
                  <div class="form-group">
                    <label for="addNoHPDokter">Nomor HP</label>
                    <input required name="noHP" type="text" class="form-control" id="addNoHPDokter" placeholder="Nomor HP" />
                  </div>
                  <div class="form-group">
                    <label for="addPoliDokter">Poli</label>
                    <select required name="poli" class="custom-select rounded-0" id="addPoliDokter">
                      <option value="">-------</option>
                      <?php foreach ($poli as $item) : ?>
                        <option value="<?php echo $item['id'] ?>"><?php echo $item['nama_poli'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="addPasswordDokter">Password</label>
                    <input required name="password" type="password" class="form-control" id="addPasswordDokter" placeholder="Password" />
                  </div>
                  <div class="card-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Tutup
                    </button>
                    <input type="submit" name="addDokter" value="Tambah" class="btn btn-primary float-right" />
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
                <form action="../../admin/kelola_dokter/" method="post">
                  <div class="form-group">
                    <label for="idDokter">ID</label>
                    <input name="idDokter" type="text" class="form-control" id="idDokter" placeholder="ID Dokter" readonly />
                  </div>
                  <div class="form-group">
                    <label for="editNamaDokter">Nama</label>
                    <input name="editNama" type="text" class="form-control" id="editNamaDokter" placeholder="Nama" />
                  </div>
                  <div class="form-group">
                    <label for="editAlamatDokter">Alamat</label>
                    <input name="editAlamat" type="text" class="form-control" id="editAlamatDokter" placeholder="Alamat" />
                  </div>
                  <div class="form-group">
                    <label for="editNoHPDokter">Nomor HP</label>
                    <input name="editNoHP" type="text" class="form-control" id="editNoHPDokter" placeholder="Nomor HP" />
                  </div>
                  <div class="form-group">
                    <label for="editPoliDokter">Poli</label>
                    <select required name="editPoli" class="custom-select rounded-0" id="editPoliDokter">
                      <option value="">-------</option>
                      <?php foreach ($poli as $item) : ?>
                        <option id="select_<?php echo $item['id'] ?>" <?php  ?> value="<?php echo $item['id'] ?>"><?php echo $item['nama_poli'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="card-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Tutup
                    </button>
                    <input type="submit" name="editDokter" value="Edit" class="buttonEdit btn btn-warning float-right" />
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
    var dataPoli;
    $(function() {
      $('.toastrDefaultSuccess').click(function() {
        toastr.success('Item berhasil dihapus')
      });
    });
    $('.buttonHapus2').click(function() {
      selectedId = $(this).val();
      console.log(selectedId);
    });
    $('.buttonHapus').click(function() {
      var clickBtnValue = selectedId;
      var ajaxurl = '../../admin/kelola_dokter/';
      data = {
        'hapusDokter': clickBtnValue
      };
      $.post(ajaxurl, data, function(response) {
        location.reload();
      });
    });
    $('.buttonEdit2').click(function() {
      selectedId = $(this).val();
      $.ajax({
        url: 'dokterJSON.php',
        type: 'GET',
        data: {
          id: selectedId
        },
        dataType: 'json',
        success: function(data) {
          $('#idDokter').val(data.id);
          $('#editNamaDokter').val(data.nama);
          $('#editAlamatDokter').val(data.alamat);
          $('#editNoHPDokter').val(data.no_hp);
          console.log(data);
          $.ajax({
            url: '../kelola_poli/poliJSON.php',
            type: 'GET',
            data: {
              id: data.id_poli
            },
            dataType: 'json',
            success: function(data) {
              $(document).ready(function() {
                $("#select_" + data.id).prop('selected', true);
              })
              console.log(data);
            },
            error: function(error) {
              console.log('Error fetching data: ' + error);
            },
          })
        },
        error: function(error) {
          console.log('Error fetching data: ' + error);
        },
      })
      console.log(selectedId);
    })
  </script>
</body>

</html>