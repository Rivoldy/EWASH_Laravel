@if (!session()->has('wnama'))
@endif

<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0 text-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link text-primary" href="#" role="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @php
                $wnama = session('wnama');
                $nem = explode(' ', $wnama);
                $prot = (isset($_SERVER['HTTPS'])) ? 'https' : 'http';
                @endphp
                ({{ $nem[0] }})
                <span class="fa-stack">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="far fa-user fa-stack-1x fa-inverse"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="navbarDropdown">
                <span class="dropdown-item dropdown-header">Account Option</span>
                <div class="dropdown-divider"></div>
                <a href="{{ $prot }}://{{ $_SERVER['HTTP_HOST'] . '/' }}"> <a href = "{{ asset('native/proses/logout.php') }}" onclick="return confirm('Anda ingin Logout dari sistem E - WASH?')" class="dropdown-item">
                    <i class="fas fa-power-off text-danger"></i> Log Out
                    <span class="float-right text-muted text-sm">end your session</span>
                </a>
            </div>
        </li>
    </ul>
</nav>
