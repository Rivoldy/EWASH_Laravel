<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
        <span class="text-primary"><?= $_SESSION['wnama'] ?></span>
        <i class="fal fa-user-circle fa-2x ml-2 text-danger"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
        <div class="dropdown-divider"></div>
        <a href="proses/logout.php" onclick="return confirm('Anda yakin ingin Log Out dari Sistem?')" class="dropdown-item dropdown-footer text-danger"><i class="far fa-power-off"></i> Log Out</a>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="dist/img/fav.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .9">
    <span class="brand-text font-weight-light">E - WASH</span>
  </a>

  <div class="sidebar">

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
        <li class="nav-header">MAIN MENU</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-file-invoice text-warning"></i>
            <p>
              Transaction
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="allocate.php" class="nav-link">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p>Allocate</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-analytics text-success"></i>
            <p>
              Report
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon text-success"></i>
                <p>Report</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">MASTER DATA</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-chalkboard-teacher text-danger"></i>
            <p>
              Trolley
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="mas_trolley.php" class="nav-link">
                <i class="far fa-circle nav-icon text-danger"></i>
                <p>Trolley Number ID</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="mas_trolley_type.php" class="nav-link">
                <i class="far fa-circle nav-icon text-danger"></i>
                <p>Trolley Type</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<script>
  var idleTime = 0;
  $(document).ready(function() {
    setTimeout(() => {
      
      alert('Ini');
    }, 1000);
      // Increment the idle time counter every minute.
      var idleInterval = setInterval(timerIncrement, 1000); // 10 second

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
      if (idleTime > 30) { // 6 minutes
        window.location="proses/logout.php";
        alert('Tidak ada aktivitas User! Logout Otomatis!');
      }
    }
</script>