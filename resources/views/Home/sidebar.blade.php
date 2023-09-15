  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{ asset('native/dist/img/fav.png') }}" alt="AdminLTE Logo" height="50" width="50">
    <span class="brand-text font-weight-light">E - WASH</span>
  </a>
  <!-- SidebarSearch Form -->
  <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
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
              <a class="nav-link" 
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
              <a href="{{ asset('native/mas_trolley.php') }}" class="nav-link">
                <i class="far fa-circle nav-icon text-danger"></i>
                <p>Trolley Number ID</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ asset('native/mas_trolley_type.php') }}" class="nav-link">
                <i class="far fa-circle nav-icon text-danger"></i>
                <p>Trolley Type</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  <!--allocate-->

  <!-- /.card-header -->
  <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>
</html>
