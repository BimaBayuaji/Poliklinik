<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dokter - Poliklinik</title>

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
        <span class="brand-text font-weight-light">Halaman Dokter</span>
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
                  Riwayat Pasien
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../dokter/profil_dokter" class="nav-link">
                <i class="nav-icon fas fa-user-doctor"></i>
                <p>
                  Profil(x)
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
            <a href="#" class="nav-link">
              <i class="fas fa-right-from-bracket"></i>
              <p>
                Logout
              </p>
            </a>
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
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Senin-Jumat</td>
                        <td>10.00</td>
                        <td>17.00</td>
                        <td>
                          <div class="margin">
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-editDokter">
                              <i class="fa fa-pen"></i> Edit
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-sm">
                              <i class="fa fa-trash"></i> Hapus
                            </button>
                          </div>
                        </td>
                      </tr>
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
                  <button type="button" class="btn btn-danger toastrDefaultSuccess" data-dismiss="modal">Hapus</button>
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
                  <form>
                    <div class="form-group">
                      <label for="addHari">Hari</label>
                      <select class="custom-select rounded-0" id="addHari">
                        <option>-------</option>
                        <option>Senin</option>
                        <option>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jumat</option>
                        <option>Sabtu</option>
                        <option>Senin-Jumat</option>
                        <!-- <option>Minggu</option> -->
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Jam Mulai</label>
                      <div class="input-group date" id="jammulai" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" id="jammulai" data-toggle="datetimepicker" data-target="#jammulai" placeholder="jj:mm" />
                        <div class="input-group-append" data-target="#jammulai" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Jam Selesai</label>
                      <div class="input-group date" id="jamselesai" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" id="jamselesai" data-toggle="datetimepicker" data-target="#jamselesai" placeholder="jj:mm" />
                        <div class="input-group-append" data-target="#jamselesai" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                        Tutup
                      </button>
                      <button type="submit" class="btn btn-primary float-right">
                        Tambah
                      </button>
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
                  <form>
                    <div class="form-group">
                      <label for="addHariEdit">Hari</label>
                      <select class="custom-select rounded-0" id="addHariEdit">
                        <option>-------</option>
                        <option>Senin</option>
                        <option selected>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jumat</option>
                        <option>Sabtu</option>
                        <!-- <option>Minggu</option> -->
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Jam Mulai</label>
                      <div class="input-group date" id="jammulaiedit" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" id="jammulaiedit" data-toggle="datetimepicker" data-target="#jammulaiedit" placeholder="jj:mm" value="10:00" />
                        <div class="input-group-append" data-target="#jammulaiedit" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Jam Selesai</label>
                      <div class="input-group date" id="jamselesaiedit" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" id="jamselesaiedit" data-toggle="datetimepicker" data-target="#jamselesaiedit" placeholder="jj:mm" value="17:00" />
                        <div class="input-group-append" data-target="#jamselesaiedit" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                        Tutup
                      </button>
                      <button type="submit" class="btn btn-warning float-right">
                        Edit
                      </button>
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
    $(function() {
      //Date picker
      $('#jammulai').datetimepicker({
        format: 'HH:mm',
        pickDate: false,
        pickSeconds: false,
        pick12HourFormat: false
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
        pick12HourFormat: false
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