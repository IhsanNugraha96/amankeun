<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>

		<div class="row">
			<div class="col-lg-12">
				<?= $this->session->flashdata('message'); ?>
			</div>
		</div>
	</div>


	<!-- Content Row -->
	<div class="row">
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Saldo</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($saldo['listrik'],0,',','.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

	<div class="card shadow mb-4 mt-3">
		<div class="card-header py-2 shadow-sm">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold" style="color: #70AD47;">Tabel data uang listrik </h6>
				<div>
					<a href="#" class="d-sm-inline-block btn btn-sm btn-info shadow-sm" data-toggle="modal" data-target="#tambah_dataPembayaran">Tambah Data Pembayaran</a>
				</div>
			</div>
		</div>
		<div class="card-body shadow-sm">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr style="text-align: center;">
							<th style="width: 5%;">No</th>
							<th width="15%">Tahun</th>
							<th>Bulan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0;?>
						<?php foreach ($tahun_pakai as $thn) {?>
							<tr style="text-align: center;">
								<th scope="row"><?= $i+1; ?></th>
								<td><?= substr($thn,0,4); ?></td>
								<td><?php $bulan = substr($thn,5,2); 
									if ($bulan == '01') { echo "Januari";}
									elseif ($bulan == '02') { echo "Februari";}
									elseif ($bulan == '03') { echo "Maret";}
									elseif ($bulan == '04') { echo "April";}
									elseif ($bulan == '05') { echo "Mei";}
									elseif ($bulan == '06') { echo "Juni";}
									elseif ($bulan == '07') { echo "Juli";}
									elseif ($bulan == '08') { echo "Agustus";}
									elseif ($bulan == '09') { echo "September";}
									elseif ($bulan == '10') { echo "Oktober";}
									elseif ($bulan == '11') { echo "November";}
									elseif ($bulan == '12') { echo "Desember";}
									?>	
								</td>    
								<td scope="row">
									<a href="<?= base_url('Administrator/detail_listrik/'.$thn) ?>" name="detail" class="badge badge-info">Lihat detail</a>
								</td>             
							</tr>
							<?php $i++; } ?>

						</tbody>
					</table>
				</div>  
			</div>
		</div>


		<!-- End of Content Row -->



	</div>
	<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<!-- Modal Tambah data Pembayaran Listrik -->
<div class="modal fade" id="tambah_dataPembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembayaran Uang Listrik</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<form method="POST" action="<?= base_url('Administrator/tambah_dataPembayaran/listrik'); ?>">
				<div class="modal-body">							
					<div class="form-group">
						<label for="date" class="ml-1">Tanggal Transaksi</label>
						<input type="date" class="form-control" id="date" name="date" placeholder="Tanggal uang masuk..." required="">
					</div>
					<div class="form-group">
						<label for="date2" class="ml-1">Pembayaran untuk Bulan</label>
						<input type="date" class="form-control" id="date2" name="date2" placeholder="Bulan..." required="">
						<sup class="text-danger">*pilih salah satu tanggal pada bulan yang dimaksud!</sup>
					</div> 
					<div class="form-group">
						<label for="santri" class="ml-1">Pilih Santri</label>
						<select class="custom-select custom-select-sm" id="santri" name="santri" required>
	                        <option value="">--Pilih Santri--</option>
	                        <?php $i=0; foreach ($santri as $snt) 
	                        {?>
	                        	<option value="<?= $snt['id_santri'] ?>"><?= ($i+1).'. '.$snt['nama'].' ('.$snt['tahun_masuk'].')'; ?></option>
	                        <?php $i++; } ?>
	                    </select>
	                </div>
					<div class="form-group" id="jumlah">
						<label for="jumlah" class="ml-1">Jumlah Bayar</label>
						<input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Rp. ..." value = "" readonly="">
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Tambah</button>

				</div>
			</form>
		</div>
	</div>
</div>