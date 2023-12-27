<!DOCTYPE html>
<link rel="icon" href="{{asset('native/dist/img/fav.png')}}">
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-WASH</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('native/plugins/fontawesome-free/css/all.min.css') }}">

  <!-- DataTables -->
<link rel="stylesheet" href="{{ asset('native/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('native/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('native/plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('native/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- DateRange Picker -->
<link rel="stylesheet" href="{{ asset('native/plugins/daterangepicker/daterangepicker.css') }}">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('native/plugins/sweetalert2/sweetalert2.css') }}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('native/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<!-- jQuery UI -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<!-- Summernote -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.css') }}">

</head>
<body class="hold-transition sidebar-mini">
@include('sweetalert::alert')
  
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include ('partial.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include ('partial.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('judul')</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">@yield('judul')</h3>
          {{-- <marquee>Selamat Datang di EWASH !</marquee> --}}
        </div>
        <div class="card-body">
          @yield('content')
        </div>
        <!-- /.card-body -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2023 EWASH.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('native/dist/js/demo.js')}}"></script>

  <script src="{{ asset('native/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('native/plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('native/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script src="{{ asset('native/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('native/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('native/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('native/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('native/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('native/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('native/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('native/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('native/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('native/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('native/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('native/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <script src="{{ asset('native/plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js') }}"></script>
  <script src="{{ asset('native/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script src="{{ asset('native/plugins/daterangepicker/daterangepicker.js') }}"></script>

  <!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('adminlte/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('native/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('native/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

</body>
</html>
