<aside class="main-sidebar sidebar-dark-primary elevation-4 layout-fixed text-sm">
  <!-- Brand Logo -->
  <a href="../modhome" class="brand-link">
    <img src="../../dist/img/fav.png" alt="E-WASH" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-strong">E - WASH</span>
  </a>

  <div class="sidebar">

    <div class="form-inline mt-3">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search Menu..." aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

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
      <a href="../modhome" class="brand-link">
        <img src="../../dist/img/fav.png" alt="E - WASH" class="brand-image img-circle elevation-3 ml-0" style="opacity: .9">
        <span class="brand-text font-weight-light">E - WASH</span>
      </a>
      <div class="sidebar">

        <nav class="mt-2 text-sm">
          <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact" data-widget="treeview" role="menu" data-accordion="true">
            <li class="nav-header text-warning">Transaction</li>
            <li class="nav-item" id="navtransstyle">
              <a href="#" class="nav-link">
                <i class="nav-icon fa-light fa-credit-card-front text-warning"></i>
                <p>
                  Data Style
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../tra_style_gram" class="transstyle nav-link" id="tra_style_gram">
                    <i class="far fa-circle nav-icon text-warning"></i>
                    <p>Master Gramasi</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item" id="navsendout">
              <a href="../tra_send_out" class="sendout nav-link" id="tra_send_out">
                <i class="fal fa-truck-container nav-icon text-warning"></i>
                <p>Send Out Scale</p>
              </a>
            </li>
            <li class="nav-item" id="navsendrfid">
              <a href="../tra_send_rfid" class="sendrfid nav-link" id="tra_send_rfid">
                <i class="fal fa-truck-container nav-icon text-warning"></i>
                <p>Send Out RFID</p>
              </a>
            </li>
            <li class="nav-item" id="navunpack">
              <a href="../tra_unpack" class="unpack nav-link" id="tra_unpack">
                <i class="fal fa-box-open nav-icon text-warning"></i>
                <p>Unpack</p>
              </a>
            </li>

            <li class="nav-header text-success">Data Report</li>
            <li class="nav-item" id="navdataorder">
              <a href="#" class="nav-link">
                <i class="nav-icon fa-light fa-box-full text-success"></i>
                <p>
                  Data Order
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../rep_order_status" class="dataorder nav-link" id="rep_order_status">
                    <i class="far fa-circle nav-icon text-success"></i>
                    <p>Order Status</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item" id="navpacklist">
              <a href="../rep_packlist" class="packlist nav-link" id="rep_packlist">
                <i class="nav-icon fa-light fa-box-full text-success"></i>
                <p>Packing List</p>
              </a>
            </li>

            <li class="nav-item" id="navbeforewash">
              <a href="#" class="nav-link">
                <i class="nav-icon fa-light fa-box-full text-success"></i>
                <p>
                  Before Wash Scale
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../rep_pack_scanpl" class="beforewash nav-link" id="rep_pack_scanpl">
                    <i class="far fa-circle nav-icon text-success"></i>
                    <p>Actual Scanned Packing List</p>
                  </a>
                  <a href="../rep_pack_detailpl" class="beforewash nav-link" id="rep_pack_detailpl">
                    <i class="far fa-circle nav-icon text-success"></i>
                    <p>Detail Scanned Packing List</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item" id="navafterwash">
              <a href="#" class="nav-link">
                <i class="nav-icon fa-light fa-box-full text-success"></i>
                <p>
                  After Wash Scale
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../rep_afterwash_actpl" class="afterwash nav-link" id="rep_afterwash_actpl">
                    <i class="far fa-circle nav-icon text-success"></i>
                    <p>Actual Loaded Packing List</p>
                  </a>
                  <a href="../rep_afterwash_detailpl" class="afterwash nav-link" id="rep_afterwash_detailpl">
                    <i class="far fa-circle nav-icon text-success"></i>
                    <p>Detail Loaded Packing List</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item" id="navbeforewashrfid">
              <a href="#" class="nav-link">
                <i class="nav-icon fa-light fa-box-full text-success"></i>
                <p>
                  Before Wash RFID
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../rep_pack_scanpl_rfid" class="beforewashrfid nav-link" id="rep_pack_scanpl_rfid">
                    <i class="far fa-circle nav-icon text-success"></i>
                    <p>Actual Scanned Packing List</p>
                  </a>
                  <a href="../rep_pack_detailpl_rfid" class="beforewashrfid nav-link" id="rep_pack_detailpl_rfid">
                    <i class="far fa-circle nav-icon text-success"></i>
                    <p>Detail Scanned Packing List</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item" id="navafterwashrfid">
              <a href="#" class="nav-link">
                <i class="nav-icon fa-light fa-box-full text-success"></i>
                <p>
                  After Wash RFID
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../rep_afterwash_actpl_rfid" class="afterwashrfid nav-link" id="rep_afterwash_actpl_rfid">
                    <i class="far fa-circle nav-icon text-success"></i>
                    <p>Actual Loaded Packing List</p>
                  </a>
                  <a href="../rep_afterwash_detailpl_rfid" class="afterwashrfid nav-link" id="rep_afterwash_detailpl_rfid">
                    <i class="far fa-circle nav-icon text-success"></i>
                    <p>Detail Loaded Packing List</p>
                  </a>
                </li>
              </ul>
            </li>

            <?php if ($_SESSION['wdept'] == 'D13') { ?>
              <li class="nav-header text-danger">Administrator</li>
              <li class="nav-item" id="navclearrfid">
                <a href="../admin_clear_rfid" class="clearrfid nav-link" id="admin_clear_rfid">
                  <i class="nav-icon fa-light fa-credit-card-front text-danger"></i>
                  <p>Clear RFID</p>
                </a>
              </li>
            <?php } ?>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  </div>
</aside>
<div class="preloader d-flex justify-content-center align-items-center">
  <img class="animation__shake" src="../../dist/img/fav.png" alt="E - WASH" height="60" width="60">
  <label class="animation__shake ml-3"> E - WASH</label>
</div>
<style>
  .dt-buttons {
    float: left;
  }
</style>