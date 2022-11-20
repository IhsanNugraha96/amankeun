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
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format(array_sum($saldo),0,',','.'); ?></div>
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
				<h6 class="m-0 font-weight-bold" style="color: #70AD47;">Tabel data uang bangunan  </h6>
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
							<th width="15%">Angkatan</th>
							<th>Jml Santri</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0;?>
						<?php foreach ($data_angkatan as $dt) {?>
							<tr style="text-align: center;">
								<th scope="row"><?= $i+1; ?></th>
								<td><?= $dt['tahun_masuk']; ?></td>
								<td><?= $jml_santri[$i]; ?></td>    
								<td scope="row">
									<?php if ($role_id == '0'){ ?>
										<a href="<?= base_url('Administrator/detail_bangunan/'.$dt['tahun_masuk']) ?>" name="detail" class="badge badge-info">Lihat detail</a>
									<?php } 
									else if ($role_id == '1') {?>
										<a href="<?= base_url('Bendahara/detail_bangunan/'.$dt['tahun_masuk']) ?>" name="detail" class="badge badge-info">Lihat detail</a>
									<?php }?>
									
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
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembayaran Uang Bangunan</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<?php if ($role_id == '0'){ ?>
				<form method="POST" action="<?= base_url('Administrator/tambah_dataPembayaran_bangunan'); ?>">
			<?php } 
			else if ($role_id == '1') {?>
				<form method="POST" action="<?= base_url('Bendahara/tambah_dataPembayaran_bangunan'); ?>">
			<?php }?>
			<!-- <form method="POST" action="<?= base_url('Bendahara/tambah_dataPembayaran_bangunan'); ?>"> -->
				<div class="modal-body">							
					<div class="form-group">
						<label for="date" class="ml-1">Tanggal Transaksi</label>
						<input type="date" class="form-control" id="date" name="date" placeholder="Tanggal uang masuk..." required="">
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
					<div class="form-group" id="biaya">
						<label for="biaya" class="ml-1">Jumlah Bayar</label>
						<input type="number" class="form-control" id="biaya" name="biaya" placeholder="Rp. ..." value = "">
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