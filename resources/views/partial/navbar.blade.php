<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars note-icon-align-outdent"></i></a>
        </li>
    </ul>  
        @if(session('fty') == 14)
        <span class="d-block">
            <span class="badge badge-primary">Klego</span>
        </span>
    @elseif(session('fty') == 15)
        <span class="d-block">
            <span class="badge badge-primary">Sambi</span>
        </span>
    @endif
    
    <!-- Center navbar content -->
    <ul class="navbar-nav ">
        <li class="nav-item">
            <div id="clock" class="nav-link"></div>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Network Indicator -->
        {{-- <div id="network-indicator" class="nav-link">
            <i class="fas fa-circle btn-xs" title="Network Status"></i>
            <span id="network-status"></span>
        </div> --}}
        
        <!-- Navbar Search -->
        {{-- <li class="nav-item">
            <form action="/logout" onclick="return confirm('Anda ingin Logout dari sistem E - WASH?')" method="post">
                @csrf
                <button class="btn btn-block btn-danger btn-sm fas fa-power-off"> Logout</button>
            </form>
        </li> --}}

        <li class="nav-item dropdown">
            <a class="nav-link text-primary" href="#" role="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ({{ session('name') }}) 
                <span class="fa-stack">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="far fa-user fa-stack-1x fa-inverse"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="navbarDropdown">
                <span class="dropdown-item dropdown-header">Account Option</span>
                <div class="dropdown-divider"></div>
                <form action="/logout" onclick="return confirm('Anda ingin Logout dari sistem E - WASH?')" method="post">
                    @csrf
                    <button class="btn btn-block btn-danger btn-sm fas fa-power-off"> Logout</button>
                </form>
                </a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="far fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
  </nav>
  

  <script>
    function updateClock() {
      const now = new Date();
      const optionsDate = {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
      };
      const optionsTime = {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        timeZoneName: 'short',
        timeZone: 'Asia/Jakarta'
      };
      const date = now.toLocaleDateString('id-ID', optionsDate);
      const time = now.toLocaleTimeString('id-ID', optionsTime);
      const clockElement = document.getElementById('clock');
      clockElement.textContent = `${date} - ${time}`;
    }
    
    setInterval(updateClock, 1000);
    updateClock();
            // Function to update network status indicator
function updateNetworkStatus() {
    const networkIndicator = document.getElementById('network-indicator');
    const networkStatus = document.getElementById('network-status');
    
    // Check the navigator's online property to determine network status
    if (navigator.onLine) {
        networkIndicator.classList.remove('text-danger'); // Remove red color
        networkIndicator.classList.add('text-success'); // Add green color
    } else {
        networkIndicator.classList.remove('text-success'); // Remove green color
        networkIndicator.classList.add('text-danger'); // Add red color
        alert('Anda sedang offline. Silakan periksa koneksi jaringan Anda.');
    }
}

// Add an event listener to update the network status indicator when the network status changes
window.addEventListener('online', updateNetworkStatus);
window.addEventListener('offline', updateNetworkStatus);

// Initial network status check
updateNetworkStatus();
</script>
    
    
  