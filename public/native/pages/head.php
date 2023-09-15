<link rel="icon" href="../../dist/img/fav.png">

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="../../plugins/sweetalert2/sweetalert2.css">
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../../plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js"></script>
<script src="../../plugins/datatables-fixedcolumns/js/fixedColumns.bootstrap4.min.js"></script>
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../../plugins/sweetalert2/sweetalert2.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script>
  var idleTime = 0;
  $(document).ready(function() {
    // Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 10000); // 10 second

    // Zero the idle timer on mouse movement.
    $(this).mousemove(function(e) {
      idleTime = 0;
    });
    $(this).keypress(function(e) {
      idleTime = 0;
    });
  });

  function timerIncrement() {
    idleTime = idleTime + 1;
    console.log(idleTime);
    if (idleTime > 80) { // 6 minutes
      window.location = "../../proses/logout.php";
      alert('Tidak ada aktivitas User! Logout Otomatis!');
    }
  }
  $(function() {
    <?php
    $uri = explode('/', $_SERVER['REQUEST_URI']);
    ?>
    $('.nav-link').removeClass('active');
    $('.nav-item').removeClass('menu-open');
    $('#<?= $uri[3] ?>').addClass('active');
    var lisclass = $('#<?= $uri[3] ?>').attr('class').split(' ');
    $('#nav' + lisclass[0]).addClass('menu-open');
  });
</script>