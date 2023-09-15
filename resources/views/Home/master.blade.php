
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-WASH | Dashboard</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('native/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('native/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{asset('native/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('native/dist/img/fav.png') }}" alt="AdminLTELogo" height="200" width="200">
  </div>

  <!-- Navbar -->
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
        <span class="text-primary"><?= session('wnama') ?></span>
        <i class="fal fa-user-circle fa-2x ml-2 text-danger"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
        <div class="dropdown-divider"></div>
        <a href="{{asset('native/proses/logout.php') }}" onclick="return confirm('Anda yakin ingin Log Out dari Sistem?')" class="dropdown-item dropdown-footer text-danger"><i class="far fa-power-off"></i> Log Out</a>
      </div>
    </li>
  </ul>
</nav>
<!----> 

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
   
    @include('Home.sidebar')
    <div class="content-wrapper">
 
      <section class="content">
      @include('Home.dash')
      </section>
    </div>
    @include('Home.footer')
  </div>

  <script src="{{asset('native/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('native/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('native/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <script src="{{asset('native/dist/js/adminlte.min.js')}}"></script>
  <script src="{{asset('native/dist/js/demo.js')}}"></script>

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
</body>
</html>