<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <!-- <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:  #70AD47;"> -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" style="background-color:  #fff;">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="<?= base_url() ?>assets/img/logo/icon.png" style="width: 70%;">
          <!-- <i class="fas fa-dollar-sign"></i> -->
        </div>
        <div class="sidebar-brand-text mx-3"><b class="text-success">AMAN</b>KEUN <sup>Ponpes</sup></div>
      </a>

      <?php if ($role_id == 0 || $role_id == 1){ ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Informasi
        </div>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?php if($title == 'Dashboard'){echo'active';} else{} ?>" style="margin-top: -10px;">
          <a class="nav-link" href="<?= base_url('Amankeun/dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Nav Item - Neraca Keuangan -->
        <li class="nav-item <?php if($title == 'Neraca Keuangan'){echo'active';} else{} ?>" style="margin-top: -20px;">
          <a class="nav-link" href="<?= base_url('Amankeun/neraca'); ?>">
           <i class="fas fa-chart-line"></i>
            <span>Neraca Keuangan</span></a>
        </li>

        <!-- Nav Item - kelola data -->
        <li class="nav-item <?php if($title == 'Laporan Keuangan'){echo'active';} else{} ?>" style="margin-top: -20px;">
          <a class="nav-link" href="<?= base_url('Amankeun/laporan_keuangan'); ?>">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Laporan Keuangan</span></a>
        </li>

        <!-- Nav Item - kelola data -->
        <li class="nav-item <?php if($title == 'Data Santri'){echo'active';} else{} ?>" style="margin-top: -20px;">
          <a class="nav-link" href="<?= base_url('Amankeun/data_santri'); ?>">
            <i class="fas fa-users"></i>
            <span>Data Santri</span></a>
        </li>

      <?php } ?>
      


      
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pengelolaan Data
      </div>

      <?php if ($role_id == 0) { ?>
        <!-- Nav Item - kelola data untuk Umi -->

        <!-- Nav Item - Pendapatan -->
        <li class="nav-item <?php if($title == 'Donasi Dari Luar' || $title == 'Uang Listrik Masuk' || $title == 'Uang Kesehatan Masuk' || $title == 'Uang Infaq Santri' || $title == 'Data Uang Bangunan' || $title == 'Data Uang Bangunan2') {echo"active";}?>" style="margin-top: -10px;">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-hand-holding-usd"></i>
            <span>Pendapatan</span>
          </a>
          <div id="collapseOne" class="collapse shadow <?php if($title == 'Donasi Dari Luar' || $title == 'Uang Listrik Masuk' || $title == 'Uang Kesehatan Masuk' || $title == 'Uang Infaq Santri' || $title == 'Data Uang Bangunan' || $title == 'Data Uang Bangunan2') {echo"show";}?>" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="text-light py-2 collapse-inner rounded" style="background-color: rgba(52, 244, 0, 0.2);">
              <h6 class="collapse-header">Data Pendapatan:</h6>
              <a class="collapse-item <?php if($title == 'Data Uang Bangunan' || $title == 'Data Uang Bangunan2'){echo'active';}?>" href="<?= base_url('Administrator/uang_bangunan') ?>">Uang Bangunan</a>
                <a class="collapse-item <?php if($title == 'Donasi Dari Luar'){echo'active';} ?>" href="<?= base_url('Administrator/donasi'); ?>">Donasi Dari Luar</a>
                <a class="collapse-item <?php if($title == 'Uang Listrik Masuk'){echo'active';} ?>" href="<?= base_url('Administrator/listrik'); ?>">Listrik</a>
                <a class="collapse-item <?php if($title == 'Uang Kesehatan Masuk'){echo'active';} ?>" href="<?= base_url('Administrator/kesehatan'); ?>">Kesehatan</a>
                <a class="collapse-item <?php if($title == 'Uang Infaq Santri'){echo'active';} ?>" href="<?= base_url('Administrator/infaq'); ?>">Infaq</a>
            </div>
          </div>
        </li>

        <!-- Nav Item - Pengaluaran -->
        <li class="nav-item <?php if($title == 'Pengeluaran'){echo'active';} else{} ?>" style="margin-top: -20px;">
          <a class="nav-link" href="<?= base_url('Pengeluaran') ?>">
            <i class="fas fa-receipt"></i>
            <span>Pengeluaran</span></a>
        </li>

        <!-- Nav Item - Pengaturan Keuangan -->
        <li class="nav-item <?php if($title == 'Pengaturan Pembayaran'){echo'active';} else{} ?>" style="margin-top: -20px;">
          <a class="nav-link" href="<?= base_url('Administrator/pengaturan_pembayaran') ?>">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan Pembayaran</span>
          </a>
        </li>

      <?php } elseif ($role_id == 1) { ?>

        <!-- Nav Item - kelola data untuk bendahara -->
        <li class="nav-item <?php if($title == 'Data Uang Kas' || $title == 'Data Uang Beras' || $title == 'Data Uang Lauk' || $title == 'Data Uang Bangunan' || $title == 'Data Uang Bangunan2'){echo'active';}?>">
          <a class="nav-link collapsed" 
           href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> 
           <i class="fas fa-hand-holding-usd"></i>
            <span>Pendapatan</span>
          </a>
          <div id="collapseTwo" class="collapse <?php if($title == 'Data Uang Kas' || $title == 'Data Uang Beras' || $title == 'Data Uang Lauk' || $title == 'Data Uang Bangunan' || $title == 'Data Uang Bangunan2') {echo"show";}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="text-light py-2 collapse-inner rounded" style="background-color: rgba(52, 244, 0, 0.2);">
              <h6 class="collapse-header">Data Pendapatan:</h6>
              <a class="collapse-item <?php if($title == 'Data Uang Bangunan' || $title == 'Data Uang Bangunan2'){echo'active';}?>" href="<?= base_url('Bendahara/uang_bangunan') ?>">Uang Bangunan</a>
                <a class="collapse-item <?php if($title == 'Data Uang Kas'){echo'active';}?>" href="<?= base_url('Bendahara/uang_kas') ?>">Uang Kas</a>
                <a class="collapse-item <?php if($title == 'Data Uang Beras'){echo'active';}?>" href="<?= base_url('Bendahara/uang_beras') ?>">Uang Beras</a>
                <a class="collapse-item <?php if($title == 'Data Uang Lauk'){echo'active';}?>" href="<?= base_url('Bendahara/uang_lauk') ?>">Uang Lauk</a>
            </div>
          </div>
        </li>

        <!-- Nav Item - kelola data untuk pengurus -->
        <li class="nav-item <?php if($title == 'Pengeluaran'){echo'active';} else{} ?>" style="margin-top: -20px;">
          <a class="nav-link" href="<?= base_url('Pengeluaran') ?>">
            <i class="fas fa-receipt"></i>
            <span>Pengeluaran</span></a>
        </li>



      <?php } else { ?>

                <!-- Nav Item - kelola data untuk pengurus -->
        <li class="nav-item <?php if($title == 'Data Santri'){echo'active';} else{} ?>" style="margin-top: -10px;">
          <a class="nav-link" href="<?= base_url('Pengurus') ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Santri / Santriyah</span></a>
        </li>

      <?php } ?>


      <?php if ($role_id == 0) { ?>
        <!-- Nav Item - Kelola Akun Untuk Umi-->
        <li class="nav-item <?php if($title == 'Akun Saya'){echo'active';} else{} ?>" style="margin-top: -20px;">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-user"></i>
            <span>Akun</span>
          </a>
          <div id="collapseUtilities" class="collapse <?php if($title == 'Akun Saya' || $title == 'Akun Pengurus') {echo"show";}?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Kelola Akun:</h6>
              <a class="collapse-item <?php if($title == 'Akun Saya'){echo'active';}?>" href="<?= base_url('Administrator/akun_saya') ?>">Akun Saya</a>
              <a class="collapse-item <?php if($title == 'Akun Pengurus'){echo'active';}?>" href="<?= base_url('Administrator/akun_pengurus') ?>">Akun Pengurus</a>
            </div>
          </div>
        </li>
      <?php } else{ ?>
        <!-- Nav Item - kelola akun untuk pengurus -->
        <li class="nav-item <?php if($title == 'Akun Saya'){echo'active';}?>" style="margin-top: -20px;">
          <a class="nav-link" href="<?= base_url('Akun/akun_saya'); ?>">
            <i class="fas fa-user"></i>
            <span>Akun Saya</span></a>
        </li>
      <?php } ?>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>

      <!-- Nav Item - About -->
      <li class="nav-item <?php if($title == 'About'){echo'active';}?>" style="margin-top: -10px;">
        <a class="nav-link" href="<?= base_url('Amankeun/about') ?>">
          <i class="far fa-question-circle"></i>
          <span>About</span></a>
      </li>

      <!-- Nav Item - Sign Out -->
      <li class="nav-item" style="margin-top: -20px;">
        <a class="nav-link" href="" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt"></i>
          <span>Sign Out</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->


<!-- Logout Modal -->
    <div class="modal modal-edu-general Customwidth-popup-WarningModal fade shadow" id="logoutModal" tabindex="-1" role="dialog" style="padding: 20px;">
    <div class="modal-dialog">
      <div class="modal-content shadow text-center">
        <div class="modal-close-area modal-close-df">
          <a class="close" data-dismiss="modal" href="#"><i class="fas fa-times"></i></a>
        </div>
        <div class="modal-body">
          <i class="far fa-frown fa-3x text-warning"></i>
          <h4 class="mt-2"><b>Yakin anda mau keluar?</b></h4>
          <p>Pilih tombol "Keluar" di bawah jika Anda siap mengakhiri sesi Anda saat ini.</p></div>
          <div class="modal-footer warning-md" style="margin-top: -7%;">
            <a class="btn btn-warning" href="<?= base_url('Logout') ?>">Keluar</a>
          </div>
        </div>
      </div>
    </div>
<!-- End Logout Modal -->