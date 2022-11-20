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
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendapatan (Bulan ini)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format(array_sum($pemasukan),0,',','.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Saldo</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($saldo['bantuan'],0,',','.'); ?></div>
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
				<h6 class="m-0 font-weight-bold" style="color: #70AD47;">Tabel data donasi masuk </h6>
				<div>
					<a href="#" class="d-sm-inline-block btn btn-sm btn-info shadow-sm" data-toggle="modal" data-target="#tambah_dataDonasi">Tambah Data</a>
				</div>
			</div>
		</div>
		<div class="card-body shadow-sm">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr style="text-align: center;">
							<th style="width: 5%;">No</th>
							<th width="15%">Tanggal</th>
							<th>Keterangan</th>
							<th>Jumlah</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0;?>
						<?php foreach ($donasi as $dns) {?>
							<tr style="text-align: center;">
								<th scope="row"><?= $i+1; ?></th>
								<td><?= substr($dns['tgl_bantuan'],8,2).'-'.substr($dns['tgl_bantuan'],5,2).'-'.substr($dns['tgl_bantuan'],0,4); ?></td>
								<td><?= $dns['keterangan'] ?></td>   
								<td><b>Rp. </b><?= number_format($dns['jumlah'],0,',','.') ?></td>    
								<td scope="row">
									<a href="" name="edit" class="badge badge-warning" data-toggle="modal" data-target="#edit_data_<?= $dns['id_bantuan']?>">Edit</a>
									<a href="" name="hapus" class="badge badge-danger" data-toggle="modal" data-target="#hapus_data_<?= $dns['id_bantuan']?>">Hapus</i></a>
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
<!-- Modal Tambah data donasi -->
<div class="modal fade" id="tambah_dataDonasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<form method="POST" action="<?= base_url('Administrator/tambah_dataDonasi'); ?>">
				<div class="modal-body">							
					<div class="form-group">
						<label for="date" class="ml-1">Tanggal Masuk</label>
						<input type="date" class="form-control" id="date" name="date" placeholder="Tanggal uang masuk..." required="">
					</div> 
					<div class="form-group">
						<label for="jumlah" class="ml-1">Jumlah Donasi</label>
						<input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Rp. ..." required="">
					</div>
					<div class="form-group">
						<label for="keterangan" class="ml-1">Keterangan</label>
						<textarea class="form-control" id="keterangan" name="keterangan" placeholder="..." required=""></textarea>
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


<!-- modal edit donasi -->

<?php $i=0; ?>
<?php foreach ($donasi as $dns) { ?>
	<div class="modal fade" id="edit_data_<?= $dns['id_bantuan']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ubah data donasi</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>

				<form method="POST" action="<?= base_url('Administrator/ubah_dataDonasi/'.urlencode($dns['id_bantuan'])); ?>">
					<div class="modal-body">
						<div class="form-group">
							<label for="tanggal" class="ml-1">Tanggal Masuk</label>
							<input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal uang masuk..." value="<?= $dns['tgl_bantuan']; ?>" required="" readonly>
						</div> 
						<div class="form-group">
							<label for="jumlah" class="ml-1">Jumlah Donasi</label>
							<input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Rp. ..." value="<?= $dns['jumlah']; ?>" required="">
						</div>
						<div class="form-group">
							<label for="keterangan" class="ml-1">Keterangan</label>
							<textarea class="form-control" id="keterangan" name="keterangan" placeholder="..." required=""><?= $dns['keterangan']; ?></textarea>
						</div>	
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php  $i++; } ?>


<!-- modal hapus data bantuan -->
	<?php $j=0; ?>
	<?php foreach ($donasi as $dns) { ?>
		<div class="modal fade" id="hapus_data_<?= $dns['id_bantuan']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">

						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body text-center">
						<i class="fa fa-exclamation-triangle fa-3x text-warning"></i>
						<h5>Yakin untuk menghapus data donasi?</h5><br>
						<h6 class="text-danger">Jika anda menghapus data ini, maka akan mempengaruhi data keuangan dari tanggal <b><?= substr($dns['tgl_bantuan'],8,2).'-'.substr($dns['tgl_bantuan'],5,2).'-'.substr($dns['tgl_bantuan'],0,4); ?></b></h6>
					</div>
					<div class="modal-footer">
						<a href="<?= base_url('Administrator/hapus_data_donasi/'.urlencode($dns['id_bantuan'])); ?>" class="btn btn-danger">Hapus</a>
					</div>
				</div>
			</div>
		</div>
		<?php  $j++; } ?>