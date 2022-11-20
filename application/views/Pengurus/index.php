  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- notifikasi -->
    <div><?= $this->session->flashdata('message'); ?></div>       
    
    <!-- akhir notifikasi -->
    <!-- Content Row -->
    <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendapatan (Bulan ini)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format(array_sum($jumlah_pemasukan_santri)+array_sum($jumlah_pemasukan_donasi),0,',','.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <a href="<?= base_url('Pengeluaran'); ?>">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pengeluaran (Bulan ini)</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format( array_sum($jumlah_pengeluaran),0,',','.'); ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-receipt fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Saldo</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp. <?=  number_format($saldo,0,',','.'); ?></div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <a href="<?= base_url('Amankeun/data_santri'); ?>">      
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><?php if ($role_id != 2) { echo "Jumlah Santri";} else{echo "Jumlah Santriyah";} echo " aktif"; ?></div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_santri; ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <!-- Content Row -->




      <div class="row">
      
      <div class="col-xl-8 col-lg-7">
       <!-- Bar Chart -->
       <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-success">Diagram persentase saldo hari ini</h6>
        </div>
        <div class="card-body">
          <div class="chart-bar">
            <canvas id="myBarChart"></canvas>
          </div>
          <hr>
          <small>Data yang tersaji terkait persentase dari saldo dari setiap jenis dana.</small> 
        </div>
      </div>
    </div>


    <!-- Pie Chart -->
      <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Diagram persentase santri</h6>
            
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
              <canvas id="myPieChart"></canvas>
            </div>
            <div class="mt-4 text-center small">
              <span class="mr-2">
                <i class="fas fa-circle text-success"></i> Santri Putra
              </span>
              <span class="mr-2">
                <i class="fas fa-circle text-info"></i> Santri Putri
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>



  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
