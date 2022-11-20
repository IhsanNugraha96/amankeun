  <style type="text/css">
    .table td, .table th{ padding: 0.2rem; }
  </style>
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
      <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- notifikasi -->
    <div><?= $this->session->flashdata('message'); ?></div>       
    
    <!-- akhir notifikasi -->
    <!-- Content Row -->
  
    <div class="row">

      <!-- Area Chart -->
      <div class="col">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 align-items-center justify-content-between text-center">
            <h6 class="m-0 font-weight-bold text-success">Pondok Pesantren Miftahul Hidayah</h6>
            <!-- <small><b>Jl. .... No. ... Kota Garut</b></small><br> -->
            <small><b>Neraca Saldo Sampai Tanggal <?php $dns = date("Y-m-d"); ?> <?= substr($dns,8,2).'-'.substr($dns,5,2).'-'.substr($dns,0,4); ?></b></small><br>
            <small><b>Untuk Tahun Yang Berakhir Pada <?= date('Y'); ?></b></small>
          </div>
          <!-- Card Body -->
          <div class="card-body" style="font-size: 14px; padding: 2% 5% 2% 5%;">
            <div class="table-responsive">
              <table  class="table table-bordered" width="100%" cellspacing="0">
                <thead class="text-center">
                  <tr>
                    <th>Keterangan</th>
                    <th>Debit (Rp)</th>
                    <th>Kredit (Rp)</th>
                  </tr>
                </thead>
                <tbody class="text-right">
                  <tr>
                    <td class="text-left">Pendapatan biaya listrik</td>
                    <td>-</td>
                    <td><?= number_format(array_sum($jml_pemasukan_listrik),0,',','.'); ?></td>
                  </tr>
                  <tr>
                    <td class="text-left">Pendapatan kas</td>
                    <td>-</td>
                    <td><?= number_format(array_sum($jml_pemasukan_kas),0,',','.'); ?></td>
                  </tr>
                  <tr>
                  <tr>
                    <td class="text-left">Pendapatan biaya beras</td>
                    <td>-</td>
                    <td><?= number_format(array_sum($jml_pemasukan_beras),0,',','.'); ?></td>
                  </tr>
                  <tr>
                    <td class="text-left">Pendapatan biaya kesehatan</td>
                    <td>-</td>
                    <td><?= number_format(array_sum($jml_pemasukan_kesehatan),0,',','.'); ?></td>
                  </tr>
                  <tr>
                    <td class="text-left">Pendapatan biaya lauk</td>
                    <td>-</td>
                    <td><?= number_format(array_sum($jml_pemasukan_lauk),0,',','.'); ?></td>
                  </tr>
                  <tr>
                    <td class="text-left">Pendapatan infaq & sodaqoh</td>
                    <td>-</td>
                    <td><?= number_format(array_sum($jml_pemasukan_infaq),0,',','.'); ?></td>
                  </tr>
                  <tr>
                    <td class="text-left">Pendapatan uang bangunan</td>
                    <td>-</td>
                    <td><?= number_format(array_sum($jml_pemasukan_bangunan),0,',','.'); ?></td>
                  </tr>
                  <tr>
                    <td class="text-left">Pendapatan bantuan dari luar</td>
                    <td>-</td>
                    <td><?= number_format(array_sum($jml_pemasukan_bantuan),0,',','.'); ?></td>
                  </tr>


                  <tr>
                    <td class="text-left">Pengeluaran biaya listrik</td>
                    <td><?= number_format(array_sum($jml_pengeluaran_listrik),0,',','.'); ?></td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td class="text-left">Pengeluaran kas</td>
                    <td><?= number_format(array_sum($jml_pengeluaran_kas),0,',','.'); ?></td>
                    <td>-</td>
                  </tr>
                  <tr>
                  <tr>
                    <td class="text-left">Pengeluaran biaya beras</td>
                    <td><?= number_format(array_sum($jml_pengeluaran_beras),0,',','.'); ?></td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td class="text-left">Pengeluaran biaya kesehatan</td>
                    <td><?= number_format(array_sum($jml_pengeluaran_kesehatan),0,',','.'); ?></td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td class="text-left">Pengeluaran biaya lauk</td>
                    <td><?= number_format(array_sum($jml_pengeluaran_lauk),0,',','.'); ?></td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td class="text-left">Pengeluaran infaq & sodaqoh</td>
                    <td><?= number_format(array_sum($jml_pengeluaran_infaq),0,',','.'); ?></td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td class="text-left">Pengeluaran uang bangunan</td>
                    <td><?= number_format(array_sum($jml_pengeluaran_bangunan),0,',','.'); ?></td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td class="text-left">Pengeluaran bantuan dari luar</td>
                    <td><?= number_format(array_sum($jml_pengeluaran_bantuan),0,',','.'); ?></td>
                    <td>-</td>
                  </tr>
                </tbody>


                <tfoot class="font-weight-bold text-right">
                  <tr>
                    <td class="text-center">Total</td>
                    <td><?= number_format(array_sum($jml_pengeluaran_listrik)+array_sum($jml_pengeluaran_kas)+array_sum($jml_pengeluaran_beras)+array_sum($jml_pengeluaran_kesehatan)+array_sum($jml_pengeluaran_lauk)+array_sum($jml_pengeluaran_infaq)+array_sum($jml_pengeluaran_bangunan)+array_sum($jml_pengeluaran_bantuan),0,',','.') ?>
                    </td>
                    <td><?= number_format(array_sum($jml_pemasukan_listrik)+array_sum($jml_pemasukan_kas)+array_sum($jml_pemasukan_beras)+array_sum($jml_pemasukan_kesehatan)+array_sum($jml_pemasukan_lauk)+array_sum($jml_pemasukan_infaq)+array_sum($jml_pemasukan_bangunan)+array_sum($jml_pemasukan_bantuan),0,',','.') ?>
                    </td>
                  </tr>
                </tfoot> 
              </table>
            </div>
          </div>
        </div>
      </div>

      
    </div>

    

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
