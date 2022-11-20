<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data Uang Bangunan</h1>

		<div class="row">
			<div class="col-lg-12">
				<?= $this->session->flashdata('message'); ?>
			</div>
		</div>
	</div>

	<!-- Content Row -->
	<div class="row">

		<div class="col-md-7 col-sm-12">
			<div class="card shadow mb-4 mt-3">
				<div class="card-header py-2 shadow-sm">
					<div class="d-sm-flex align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold" style="color: #70AD47;">Tabel data pembayaran uang bangunan angkatan <?= $tahun; ?></h6>
						<div>
							<a href="<?php if ($role_id=='1') { echo base_url('Bendahara/uang_bangunan');}
							elseif ($role_id =='0') { echo base_url('Administrator/uang_bangunan');} ?>" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-backward"></i> Kembali</a>
						</div>
					</div>
				</div>
				<div class="card-body shadow-sm">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr style="text-align: center;">
									<th style="width: 5%;">No</th>
									<th>Nama Santri</th>
									<th>Biaya</th>
									<th>Detail Pembayaran</th>

								</tr>
							</thead>
							<tbody>
								<?php $i=0;?>
								<?php foreach ($data_santri as $dt) {?>
									<tr style="text-align: center;">
										<th scope="row"><?= $i+1; ?></th>
										<td><?= $dt['nama'] ?></td>
										<td><?php if ($dt['yatim'] == '1') { echo "Gratis";} else {echo "Rp. ".number_format($biaya['bangunan'],0,',','.');} ?>

									</td>
									<td><button class="btn btn-sm btn-info" id="tombol_<?= $dt['id_santri']; ?>">
										lihat
									</button>
								</td>               
							</tr>
							<?php $i++; } ?>
						</tbody>
					</table>
				</div>  
			</div>
		</div>
	</div>

	<div class="col-md-5 col-sm-12">
		<section id="detail_bangunan" class="detail_bangunan  section-bg mt-3">
			<iframe src="<?= base_url('Amankeun/detail_bangunan/'.$data_santri[0]['id_santri'])?>" class=" p-0 m-0 responsive-iframe"  frameborder="0" style="width: 100%; height: 50vh;"></iframe>
			
			</section>
		</div>

	</div>

	<!-- End of Content Row -->



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
