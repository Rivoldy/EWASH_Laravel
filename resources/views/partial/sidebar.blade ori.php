<aside class="main-sidebar sidebar-dark-primary bg-black elevation-4">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-2 d-flex">
        <div class="image">
        <img src="{{asset('native/dist/img/fav.png')}}" alt="EWASH logo" height="50" width="50" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">E-WASH</a>
        </div>
      </div> 
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar btn-primary">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
        @php
        $ra = App\Models\role_access::get();
        $prv = App\Models\privilege::where('privilege_user_nik', session('nik'))->first();
        $ga = App\Models\group_access::get(); 
        @endphp
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               
          <li class="nav-item sidebar-menu-item">
            <a href="/home" class="nav-link">
              <i class="nav-icon far fa-tachometer-alt text-primary"></i>
              <p> 
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item sidebar-menu-item">
            <a href="" class="nav-link">
              <i class="nav-icon far fa-tools text-info"></i>
              <p>
                Tools
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              @foreach ($ra as $item)
              @if ($item->role_access_group_access_id == $prv->privilege_group_access_id)

              <li class="nav-item sidebar-menu-item">
                @if ($item->selected==1 && $item->role_access_menu_id==17)
                <a href="/GroupAccess" class="nav-link">
                  <i class="far fa-users nav-icon text-info"></i>
                  <p>Group Access</p>
                </a>
                @endif
              </li>

              <li class="nav-item sidebar-menu-item"> 
                @if ($item->selected==1 && $item->role_access_menu_id==18)
                <a href="/menu" class="nav-link">
                  <i class="far fa-book nav-icon text-info"></i>
                  <p>Menu</p>
                </a>
                @endif
              </li>
              <li class="nav-item sidebar-menu-item">
                @if ($item->selected==1 && $item->role_access_menu_id==19)
                <a href="/privilegeKlegoSambi" class="nav-link">
                  <i class="far fa-user-plus nav-icon text-danger"></i>
                  <p>User Management</p>
                </a>
                @endif
              </li>
              @endif
              @endforeach
          </li>
        </ul>
      </nav>

          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-header text-warning">Transaction</li>
              <li class="nav-item sidebar-menu-item">
                
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-light fa-credit-card-front text-warning"></i>
                  <p>
                    Data Style
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>

                @foreach ($ra as $item)
                  @if ($item->role_access_group_access_id == $prv->privilege_group_access_id)
                <ul class="nav nav-treeview">
                    @if ($item->selected==1 && $item->role_access_menu_id==1)
                  <li class="nav-item sidebar-menu-item">
                    <a href="/MasterGramasi" class="transstyle nav-link">
                      <i class="far fa-circle nav-icon text-warning"></i>
                      <p>Master Gramasi</p>
                    </a>
                    @endif
                  </li>
                </ul>
                @endif
                @endforeach
              </li>
              @foreach ($ra as $item)
              @if ($item->role_access_group_access_id == $prv->privilege_group_access_id)
              <li class="nav-item sidebar-menu-item">
                @if ($item->selected==1 && $item->role_access_menu_id==2)
                <a href="/SendOut" class="sendout nav-link">
                  <i class="fal fa-truck-container nav-icon text-warning"></i>
                  <p>Send Out Scale</p>
                </a>
                @endif
              </li>
              @endif
              @endforeach
              @foreach ($ra as $item)
              @if ($item->role_access_group_access_id == $prv->privilege_group_access_id)
              <li class="nav-item sidebar-menu-item">
                @if ($item->selected==1 && $item->role_access_menu_id==3)
                <a href="/tra_send_rfid" class="sendrfid nav-link">
                  <i class="fal fa-truck-container nav-icon text-warning"></i>
                  <p>Send Out RFID</p>
                </a>
                @endif
              </li>
              @endif
              @endforeach
              @foreach ($ra as $item)
              @if ($item->role_access_group_access_id == $prv->privilege_group_access_id)
              <li class="nav-item sidebar-menu-item">
                @if ($item->selected==1 && $item->role_access_menu_id==4)
                <a href="/UnPack" class="unpack nav-link">
                  <i class="fal fa-box-open nav-icon text-warning"></i>
                  <p>Unpack</p>
                </a>
                @endif
              </li>
              @endif
              @endforeach
              
              <li class="nav-header text-success">Data Report</li>
              <li class="nav-item" >
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-light fa-box-full text-success"></i>
                  <p>
                    Data Order
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                @foreach ($ra as $item)
                  @if ($item->role_access_group_access_id == $prv->privilege_group_access_id)
                <ul class="nav nav-treeview">
                  <li class="nav-item sidebar-menu-item">
                    @if ($item->selected==1 && $item->role_access_menu_id==5)
                    <a href="/ReportOrderStat" class="dataorder nav-link">
                      <i class="far fa-circle nav-icon text-success"></i>
                      <p>Order Status</p>
                    </a>
                  @endif
                  </li>
                </ul>
              @endif
              @endforeach

              @foreach ($ra as $item)
                  @if ($item->role_access_group_access_id == $prv->privilege_group_access_id)
              <li class="nav-item" id="navpacklist">
                @if ($item->selected==1 && $item->role_access_menu_id==6)
                <a href="/report" class="packlist nav-link">
                  <i class="nav-icon fa-light fa-box-full text-success"></i>
                  <p>Packing List</p>
                </a>
                @endif
              </li>
              @endif
              @endforeach

              
              <li class="nav-item" >
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-light fa-box-full text-success"></i>
                  <p>
                    Before Wash Scale
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                
                @foreach ($ra as $item)
                  @if ($item->role_access_group_access_id == $prv->privilege_group_access_id)
                <ul class="nav nav-treeview">
                  <li class="nav-item sidebar-menu-item">
                    @if ($item->selected==1 && $item->role_access_menu_id==7)
                    <a href="/Scanpl" class="beforewash nav-link" >
                      <i class="far fa-circle nav-icon text-success"></i>
                      <p>Actual Scanned Packing List</p>
                    </a>
                    @endif
                    @if ($item->selected==1 && $item->role_access_menu_id==8)
                    <a href="/Detailpl" class="beforewash nav-link">
                      <i class="far fa-circle nav-icon text-success"></i>
                      <p>Detail Scanned Packing List</p>
                    </a>
                    @endif
                  </li>
                </ul>
              @endif
              @endforeach
  
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-light fa-box-full text-success"></i>
                  <p>
                    After Wash Scale
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                @foreach ($ra as $item)
                  @if ($item->role_access_group_access_id == $prv->privilege_group_access_id)
                <ul class="nav nav-treeview">
                  <li class="nav-item sidebar-menu-item">
                    @if ($item->selected==1 && $item->role_access_menu_id==9)
                    <a href="/report-aw" class="afterwash nav-link" >
                      <i class="far fa-circle nav-icon text-success"></i>
                      <p>Actual Loaded Packing List</p>
                    </a>
                    @endif
                    @if ($item->selected==1 && $item->role_access_menu_id==10)
                    <a href="/reportAWdetail" class="afterwash nav-link" >
                      <i class="far fa-circle nav-icon text-success"></i>
                      <p>Detail Loaded Packing List</p>
                    </a>
                    @endif
                  </li>
                </ul>
              @endif
              @endforeach

              <li class="nav-item sidebar-menu-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-light fa-box-full text-success"></i>
                  <p>
                    Before Wash RFID
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                @foreach ($ra as $item)
                  @if ($item->role_access_group_access_id == $prv->privilege_group_access_id)
                <ul class="nav nav-treeview">
                  <li class="nav-item sidebar-menu-item">
                    @if ($item->selected==1 && $item->role_access_menu_id==11)
                    <a href="/ScanplRFID" class="beforewashrfid nav-link" >
                      <i class="far fa-circle nav-icon text-success"></i>
                      <p>Actual Scanned Packing List</p>
                    </a>
                    @endif
                    @if ($item->selected==1 && $item->role_access_menu_id==12)
                    <a href="/DetailplRFID" class="beforewashrfid nav-link">
                      <i class="far fa-circle nav-icon text-success"></i>
                      <p>Detail Scanned Packing List</p>
                    </a>
                    @endif
                  </li>
                </ul>
                @endif
                @endforeach
              </li>
  
              <li class="nav-item" id="navafterwashrfid">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-light fa-box-full text-success"></i>
                  <p>
                    After Wash RFID
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                @foreach ($ra as $item)
                  @if ($item->role_access_group_access_id == $prv->privilege_group_access_id)
                <ul class="nav nav-treeview">
                  <li class="nav-item sidebar-menu-item">
                    @if ($item->selected==1 && $item->role_access_menu_id==14)
                    <a href="/reportAWRFID" class="afterwashrfid nav-link">
                      <i class="far fa-circle nav-icon text-success"></i>
                      <p>Actual Loaded Packing List</p>
                    </a>
                    @endif
                    @if ($item->selected==1 && $item->role_access_menu_id==15)
                    <a href="/DetailAWRFID" class="afterwashrfid nav-link">
                      <i class="far fa-circle nav-icon text-success"></i>
                      <p>Detail Loaded Packing List</p>
                    </a>
                    @endif
                  </li>
                </ul>
                @endif
                @endforeach
              </li>
              
              <li class="nav-header text-danger">Administrator</li>
              @foreach ($ra as $item)
              @if ($item->role_access_group_access_id == $prv->privilege_group_access_id)
              <li class="nav-item sidebar-menu-item">
                @if ($item->selected==1 && $item->role_access_menu_id==16)
                <a href="/ClearRFID" class="clearrfid nav-link">
                  <i class="nav-icon fa-light fa-credit-card-front text-danger"></i>
                  <p>Clear RFID</p>
                </a>
                @endif
              </li>
              @endif
              @endforeach
            </ul>
          </nav>
        </ul>
        </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  