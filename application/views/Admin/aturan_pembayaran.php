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
	<div class="card shadow mb-4 mt-3">
		<div class="card-header py-2 shadow-sm">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold" style="color: #70AD47;">Tabel data aturan biaya angkatan </h6>
				<div>
					<a href="#" class="d-sm-inline-block btn btn-sm btn-info shadow-sm" data-toggle="modal" data-target="#tambah_dataAturanPembayaran">Tambah Data</a>
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
							<th>Bangunan</th>
							<th>Litrik</th>
							<th>Kas</th>
							<th>Beras</th>
							<th>Kesehatan</th>
							<th>Lauk</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0;?>
						<?php foreach ($aturan_pembayaran as $atr) {?>
							<tr style="text-align: center;">
								<th scope="row"><?= $i+1; ?></th>
								<td><?= $atr['tahun_masuk'] ?></td>
								<td><b>Rp.</b><?= number_format($atr['bangunan'],0,',','.') ?></td>   
								<td>
									<p class="text-success">Mondok (<b>Rp.</b><?= $atr['listrik_mondok'] ?>/bln)</p>
									<p class="text-primary" style="margin-top: -10%;">Tidak Mondok (<b>Rp.</b><?= $atr['listrik_tdk_mondok'] ?>/bln)</p>
								</td>  
								<td><b>Rp.</b><?= number_format($atr['kas'] ,0,',','.')?>/bln</td>    
								<td><b>Rp.</b><?= number_format($atr['beras'],0,',','.') ?>/bln</td>    
								<td><b>Rp.</b><?= number_format($atr['kesehatan'],0,',','.') ?>/bln</td>    
								<td><b>Rp.</b><?= number_format($atr['lauk'],0,',','.') ?>/bln</td>        
								<td scope="row">
									<a href="" name="edit" class="badge badge-warning" data-toggle="modal" data-target="#edit_data_<?= $atr['id_aturan_bayar']?>">Edit</a>
									<a href="" name="hapus" class="badge badge-danger" data-toggle="modal" data-target="#hapus_aturan_<?= $atr['id_aturan_bayar']?>">Hapus</i></a>
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
<!-- Modal Tambah Aturan -->
<div class="modal fade" id="tambah_dataAturanPembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<form method="POST" action="<?= base_url('Administrator/tambah_dataAturanPembayaran'); ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name" class="ml-1">Tahun Angkatan</label>
								<input type="number" class="form-control" id="year" name="year" placeholder="Tahun masuk..." value="<?= date('Y'); ?>"required="" maxlength="4" minlength="4">
							</div> 
							<div class="form-group">
								<label for="name" class="ml-1">Uang Bangunan</label>
								<input type="number" class="form-control" id="bangunan" name="bangunan" placeholder="Rp. ..." required="">
							</div>
							<div class="form-group">
								<label for="name" class="ml-1">Uang Kas</label>
								<input type="number" class="form-control" id="kas" name="kas" placeholder="Rp. ..." required="">
							</div>
							<div class="form-group">
								<label for="name" class="ml-1">Uang beras</label>
								<input type="number" class="form-control" id="beras" name="beras" placeholder="Rp. ..." required="">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="name" class="ml-1">Uang Kesehatan</label>
								<input type="number" class="form-control" id="kesehatan" name="kesehatan" placeholder="Rp. ..." required="">
							</div>
							<div class="form-group">
								<label for="name" class="ml-1">Uang lauk</label>
								<input type="number" class="form-control" id="lauk" name="lauk" placeholder="Rp. ..." required="">
							</div>
							<div class="form-group">
								<label for="name" class="ml-1">Uang listrik santri mondok</label>
								<input type="number" class="form-control" id="listrik_m" name="listrik_m" placeholder="Rp. ..." required="">
							</div>
							<div class="form-group">
								<label for="name" class="ml-1">Uang listrik santri tdk mondok</label>
								<input type="number" class="form-control" id="listrik_tm" name="listrik_tm" placeholder="Rp. ..." required="">
							</div>
						</div>
					</div>	
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Tambah</button>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- modal edit aturan bayar -->

<?php $i=0; ?>
<?php foreach ($aturan_pembayaran as $atr) { ?>
	<div class="modal fade" id="edit_data_<?= $atr['id_aturan_bayar']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ubah Aturan Pembayaran</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>

				<form method="POST" action="<?= base_url('Administrator/ubah_dataAturanPembayaran/'.urlencode($atr['id_aturan_bayar'])); ?>">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="ml-1">Tahun Angkatan</label>
									<input type="number" class="form-control" id="year" name="year" placeholder="" value="<?=$atr['tahun_masuk']; ?>" readonly>
								</div> 
								<div class="form-group">
									<label for="name" class="ml-1">Uang Bangunan</label>
									<input type="number" class="form-control" id="bangunan" name="bangunan" placeholder="Rp. ..." value="<?=$atr['bangunan']; ?>" required="">
								</div>
								<div class="form-group">
									<label for="name" class="ml-1">Uang Kas</label>
									<input type="number" class="form-control" id="kas" name="kas" placeholder="Rp. ..." value="<?=$atr['kas']; ?>" required="">
								</div>
								<div class="form-group">
									<label for="name" class="ml-1">Uang beras</label>
									<input type="number" class="form-control" id="beras" name="beras" placeholder="Rp. ..." value="<?=$atr['beras']; ?>" required="">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="name" class="ml-1">Uang Kesehatan</label>
									<input type="number" class="form-control" id="kesehatan" name="kesehatan" placeholder="Rp. ..." value="<?=$atr['kesehatan']; ?>" required="">
								</div>
								<div class="form-group">
									<label for="name" class="ml-1">Uang lauk</label>
									<input type="number" class="form-control" id="lauk" name="lauk" placeholder="Rp. ..." value="<?=$atr['lauk']; ?>" required="">
								</div>
								<div class="form-group">
									<label for="name" class="ml-1">Uang listrik santri mondok</label>
									<input type="number" class="form-control" id="listrik_m" name="listrik_m" placeholder="Rp. ..." value="<?=$atr['listrik_mondok']; ?>" required="">
								</div>
								<div class="form-group">
									<label for="name" class="ml-1">Uang listrik santri tdk mondok</label>
									<input type="number" class="form-control" id="listrik_tm" name="listrik_tm" placeholder="Rp. ..." value="<?=$atr['listrik_tdk_mondok']; ?>" required="">
								</div>
							</div>
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


	<?php $j=0; ?>
	<?php foreach ($aturan_pembayaran as $atr) { ?>
		<div class="modal fade" id="hapus_aturan_<?= $atr['id_aturan_bayar']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">

						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body text-center">
						<i class="fa fa-exclamation-triangle fa-3x text-warning"></i>

						<h6>Hapus aturan keuangan</h6>
						<h5> angkatan <?= $atr['tahun_masuk']; ?>?</h5>
					</div>
					<div class="modal-footer">
						<a href="<?= base_url('Administrator/hapus_aturan_keuangan/'.urlencode($atr['id_aturan_bayar'])); ?>" class="btn btn-danger">Hapus</a>
					</div>
				</div>
			</div>
		</div>
		<?php  $j++; } ?>