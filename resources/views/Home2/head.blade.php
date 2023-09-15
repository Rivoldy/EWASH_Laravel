<link rel="icon" href="{{asset('native/dist/img/fav.png')}}">

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('native/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('native/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('native/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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

<script src="{{ asset('native/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('native/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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
<script src="{{ asset('native/plugins/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('native/dist/js/adminlte.min.js') }}"></script>

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
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script>
    $(document).ready(function() {
      $("ul.nav-sidebar a").each(function() {
        var navItem = $(this);
        if ('/ewash/' + navItem.attr("href") == location.pathname) {
          navItem.addClass("bg-white");
          navItem.parentsUntil(".nav-sidebar > .nav-treeview")
        .css({'display': 'block'})
        .addClass('menu-open').prev('a')
        .addClass('active');
        }
      });
     
    });
  </script>