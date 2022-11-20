<?php function bulan() {
	 } 
?>

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

			<div class="col-md-8 col-sm-12">
				<div class="card shadow mb-4 mt-3">
					<div class="card-header py-2 shadow-sm">
						<div class="d-sm-flex align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold" style="color: #70AD47;">Tabel data pembayaran 
								<?php if ($title=='Uang Kesehatan Masuk') { echo 'kesehatan';}
								elseif ($title=='Uang Listrik Masuk') { echo 'listrik';}
								elseif ($title=='Data Uang Kas') { echo 'kas';}
								elseif ($title=='Data Uang Beras') { echo 'beras';} ?> bulan 
									<?php if (substr($this->uri->segment(3),6,2) == '01') { echo "Januari ";}
										if (substr($this->uri->segment(3),6,2) == '02') { echo "Februari ";}
										if (substr($this->uri->segment(3),6,2) == '03') { echo "Maret ";}
										if (substr($this->uri->segment(3),6,2) == '04') { echo "April ";}
										if (substr($this->uri->segment(3),6,2) == '05') { echo "Mei ";}
										if (substr($this->uri->segment(3),6,2) == '06') { echo "Juni ";}
										if (substr($this->uri->segment(3),6,2) == '07') { echo "Juli ";}
										if (substr($this->uri->segment(3),6,2) == '08') { echo "Agustus ";}
										if (substr($this->uri->segment(3),6,2) == '09') { echo "September ";}
										if (substr($this->uri->segment(3),6,2) == '10') { echo "Oktober ";}
										if (substr($this->uri->segment(3),6,2) == '11') { echo "November ";}
										if (substr($this->uri->segment(3),6,2) == '12') { echo "Desember ";}
										echo substr($this->uri->segment(3),0,4); ?></h6>
								<div>
									<a href="<?php if ($title=='Uang Kesehatan Masuk') { echo base_url('Administrator/kesehatan');}
									elseif ($title=='Uang Listrik Masuk') { echo base_url('Administrator/listrik');}
									elseif ($title=='Data Uang Kas') { echo base_url('Bendahara/uang_kas');}
									elseif ($title=='Data Uang Beras') { echo base_url('Bendahara/uang_beras');} ?>" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-backward"></i> Kembali</a>
								</div>
							</div>
						</div>
						<div class="card-body shadow-sm">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr style="text-align: center;">
											<th style="width: 5%;">No</th>
											<th width="15%">Tgl Bayar</th>
											<th>Nama Santri</th>
											<th>Angkatan</th>
											<th>Jumlah</th>
										</tr>
									</thead>
									<tbody>
										<?php $i=0;?>
										<?php foreach ($data as $dt) {?>
											<tr style="text-align: center;">
												<th scope="row"><?= $i+1; ?></th>
												<td><small><?= substr($dt['tgl_bayar'],8,2).'-'.substr($dt['tgl_bayar'],5,2).'-'.substr($dt['tgl_bayar'],0,4); ?></small></td>
												<td><?= $dt['nama'] ?></td>
												<td><?= $dt['tahun_masuk'] ?></td>
												<td><b>Rp. </b><?= number_format($dt['jumlah'],0,',','.') ?></td>               
											</tr>
											<?php $i++; } ?>

										</tbody>
									</table>
								</div>  
							</div>
						</div>
					</div>

					<div class="col-md-4 col-sm-12">
						<div class="card shadow mb-4 mt-3">
							<div class="card-header py-2 shadow-sm">
								<div class="d-sm-flex align-items-center justify-content-between">
									<h6 class="m-0.5 font-weight-bold text-primary">Daftar santri belum bayar</h6>
									</div>
								</div>
								<div class="card-body shadow-sm">
									<div class="table-responsive">
										<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
											<thead>
												<tr style="text-align: center;">
													<th style="width: 5%;">No</th>
													<th>Nama Santri</th>
												</tr>
											</thead>
											<tbody>
												<?php $i=0;?>
												<?php foreach ($belum_bayar as $bl) {?>
													<tr style="text-align: center;">
														<th scope="row"><?= $i+1; ?></th>
														<td><?= $bl['nama'] ?> (<?= $bl['tahun_masuk'] ?>)</td>
													</tr>
													<?php $i++; } ?>

												</tbody>
											</table>
										</div>  
									</div>
								</div>
							</div>

						</div>

						<!-- End of Content Row -->



					</div>
					<!-- /.container-fluid -->

				</div>
				<!-- End of Main Content -->
