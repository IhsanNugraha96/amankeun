<style type="text/css">
	.responsive-container {
		position: relative;
		overflow: hidden;
		padding-top: 56.25%;
	}

	.responsive-iframe {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		border: 0;
	}
</style>


<div class="container-fluid">

	<main id="main">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
		</div>


		<!-- Content Row -->
		<div class="row">
			<div class="col">
				
			</div>
		</div>

		<div class="card shadow mb-4 mt-3">
			<div class="card-header py-2 shadow-sm">
				<div class=" align-items-center justify-content-between text-center">
					<h6 class=" font-weight-bold" style="color: #70AD47;">PONDOK PESANTREN </h6><h6 class=" font-weight-bold" style="color: #70AD47;"> BUKU BESAR LAPORAN KEUANGAN </h6><h6 class=" font-weight-bold" style="color: #70AD47;">UNTUK PERIODE YANG BERAKHIR PADA TAHUN <?= $tahun; ?></h6>
					<div class="text-right">
						<a href="#export" class="d-sm-inline-block btn btn-sm btn-info shadow-sm" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample"><i class="far fa-file-excel text-white-50"></i> Ekspor Laporan</a>
					</div>

					<section id="bangunan" class="laporan section-bg">

						<div class="collapse " id="export">
							<div class="card-body text-center">
								<a href="" class="d-sm-inline-block badge btn-secondary shadow-sm m-1" data-toggle="modal" data-target="#pilihanExport1">Laporan Harian</a>

								<a href="" class="d-sm-inline-block badge badge-danger shadow-sm m-1" data-toggle="modal" data-target="#pilihanExport2">Laporan Mingguan</a>

								<a href="" class="d-sm-inline-block badge badge-warning shadow-sm m-1" data-toggle="modal" data-target="#pilihanExport3">Laporan Bulanan</a> 

								<a href="" class="d-sm-inline-block badge badge-success shadow-sm m-1" data-toggle="modal" data-target="#pilihanExport4">Laporan Tahunan</a>

								<!-- <a href="" class="d-sm-inline-block badge badge-primary shadow-sm m-1" data-toggle="modal" data-target="#pilihanExport5">Laporan Semua</a> -->
							</div>

						</div>
					</section>
				</div>
			</div>
			<div class="card-body shadow-sm">

				<ul class="nav justify-content-center nav-pills">
					<?php $i=1; foreach ($bulan as $bln) { ?>
						<li class="nav-item">
							<button class="btn btn-link btn-sm text-success" id="tombol_<?= $i; ?>" ><span id="bulan_<?= $i; ?>">
								<?php if ($i == '1') { echo "Jan";}
								elseif ($i == '2') { echo "Feb";}
								elseif ($i == '3') { echo "Mar";}
								elseif ($i == '4') { echo "Apr";}
								elseif ($i == '5') { echo "Mei";}
								elseif ($i == '6') { echo "Jun";}
								elseif ($i == '7') { echo "Jul";}
								elseif ($i == '8') { echo "Ags";}
								elseif ($i == '9') { echo "Sep";}
								elseif ($i == '10') { echo "Okt";}
								elseif ($i == '11') { echo "Nov";}
								elseif ($i == '12') { echo "Des";} ?></span>
							</button>
						</li>
						<?php $i++; } ?>
					</ul><br>


					<section id="kas" class="laporan  section-bg mb-5">


						<a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
							<B><u>Data Uang Kas</u></B><br>
						</a>

						<!-- Card Content - Collapse -->
						<div class="collapse " id="collapseCardExample1">
							<div class="card-body">
								<div class="row">
									<div class="col" style="padding: 0 0 0 3%">
										<div class="responsive-container" data-aos="fade-up">
											<span id="view1">
												<iframe src="<?= base_url('Amankeun/laporan_kas/01/'.$tahun)?>" class=" p-0 m-0 responsive-iframe"  frameborder="0"></iframe>
											</span>

										</div>
									</div>

								</div>
							</div>

						</div>
					</section>


					<hr style="height: 200%;">


					<section id="listrik" class="laporan  section-bg mb-5">
						<a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
							<B><u>Data Uang Listrik</u></B><br>
						</a>

						<!-- Card Content - Collapse -->
						<div class="collapse " id="collapseCardExample2">
							<div class="card-body">
								<div class="row">
									<div class="col" style="padding: 0 0 0 3%">
										<div class="responsive-container" data-aos="fade-up">
											<span id="view2">
												<iframe src="<?= base_url('Amankeun/laporan_listrik/01/'.$tahun)?>" class=" p-0 m-0 responsive-iframe"  frameborder="0"></iframe>
											</span>

										</div>
									</div>
								</div>
							</div>

						</div>
					</section>


					<hr style="height: 200%;">


					<section id="beras" class="laporan  section-bg mb-5">
						<a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
							<B><u>Data Uang Beras</u></B><br>
						</a>

						<!-- Card Content - Collapse -->
						<div class="collapse " id="collapseCardExample3">
							<div class="card-body">
								<div class="row">
									<div class="col" style="padding: 0 0 0 3%">
										<div class="responsive-container" data-aos="fade-up">
											<span id="view3">
												<iframe src="<?= base_url('Amankeun/laporan_beras/01/'.$tahun)?>" class=" p-0 m-0 responsive-iframe"  frameborder="0"></iframe>
											</span>

										</div>
									</div>
								</div>
							</div>

						</div>
					</section>



					<hr style="height: 200%;">


					<section id="lauk" class="laporan  section-bg mb-5">
						<a href="#collapseCardExample4" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
							<B><u>Data Uang Lauk</u></B><br>
						</a>

						<!-- Card Content - Collapse -->
						<div class="collapse " id="collapseCardExample4">
							<div class="card-body">
								<div class="row">
									<div class="col" style="padding: 0 0 0 3%">
										<div class="responsive-container" data-aos="fade-up">
											<span id="view4">
												<iframe src="<?= base_url('Amankeun/laporan_lauk/01/'.$tahun)?>" class=" p-0 m-0 responsive-iframe"  frameborder="0"></iframe>
											</span>

										</div>
									</div>
								</div>
							</div>

						</div>
					</section>



					<hr style="height: 200%;">


					<section id="kesehatan" class="laporan  section-bg mb-5">
						<a href="#collapseCardExample5" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
							<B><u>Data Uang Kesehatan</u></B><br>
						</a>

						<!-- Card Content - Collapse -->
						<div class="collapse " id="collapseCardExample5">
							<div class="card-body">
								<div class="row">
									<div class="col" style="padding: 0 0 0 3%">
										<div class="responsive-container" data-aos="fade-up">
											<span id="view5">
												<iframe src="<?= base_url('Amankeun/laporan_kesehatan/01/'.$tahun)?>" class=" p-0 m-0 responsive-iframe"  frameborder="0"></iframe>
											</span>

										</div>
									</div>
								</div>
							</div>

						</div>
					</section>



					<hr style="height: 200%;">


					<section id="infaq" class="laporan  section-bg mb-5">
						<a href="#collapseCardExample6" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
							<B><u>Data Uang Infaq</u></B><br>
						</a>

						<!-- Card Content - Collapse -->
						<div class="collapse " id="collapseCardExample6">
							<div class="card-body">
								<div class="row">
									<div class="col" style="padding: 0 0 0 3%">
										<div class="responsive-container" data-aos="fade-up">
											<span id="view6">
												<iframe src="<?= base_url('Amankeun/laporan_infaq/01/'.$tahun)?>" class=" p-0 m-0 responsive-iframe"  frameborder="0"></iframe>
											</span>

										</div>
									</div>
								</div>
							</div>

						</div>
					</section>



					<hr style="height: 200%;">


					<section id="bangunan" class="laporan  section-bg mb-5">
						<a href="#collapseCardExample7" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
							<B><u>Data Uang Bangunan</u></B><br>
						</a>

						<!-- Card Content - Collapse -->
						<div class="collapse " id="collapseCardExample7">
							<div class="card-body">
								<div class="row">
									<div class="col" style="padding: 0 0 0 3%">
										<div class="responsive-container" data-aos="fade-up">
											<span id="view7">
												<iframe src="<?= base_url('Amankeun/laporan_bangunan/01/'.$tahun)?>" class=" p-0 m-0 responsive-iframe"  frameborder="0"></iframe>
											</span>

										</div>
									</div>
								</div>
							</div>

						</div>
					</section>



					<hr style="height: 200%;">


					<section id="bantuan" class="laporan  section-bg mb-5">
						<a href="#collapseCardExample8" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
							<B><u>Data Uang Bantuan</u></B><br>
						</a>

						<!-- Card Content - Collapse -->
						<div class="collapse " id="collapseCardExample8">
							<div class="card-body">
								<div class="row">
									<div class="col" style="padding: 0 0 0 3%">
										<div class="responsive-container" data-aos="fade-up">
											<span id="view8">
												<iframe src="<?= base_url('Amankeun/laporan_bantuan/01/'.$tahun)?>" class=" p-0 m-0 responsive-iframe"  frameborder="0"></iframe>
											</span>

										</div>
									</div>
								</div>
							</div>

						</div>
					</section>


				</div>
			</div>



			<!-- End #main -->
		</main>
	</div>

</div>



<!-- <script type="text/javascript">
	document.getElementById("tombol_1").
	addEventListener("click", tampilkan_nilai_p1);


	function tampilkan_nilai_p1() 
	{
		<?php $thn = date('Y'); ?>
		let kas = '<iframe src="<?= base_url('Amankeun/laporan_kas/01/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        // var url = encodeURI(hasil);
        document.getElementById("view1").innerHTML=kas;
        console.log(kas);      
    }
</script> -->


<div class="modal fade" id="pilihanExport1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Export Laporan Data Keuangan Harian</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<form method="POST" action="<?= base_url('Ekspor/Laporan/1'); ?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="hari" class="ml-1">Pilih hari</label>
						<input type="date" class="form-control" id="hari" name="hari" required="">
					</div> 

					<div class="form-group">
						<label for="pilihan" class="ml-1">Pilih data</label>
						<select class="custom-select custom-select-sm" id="pilihan" name="pilihan" required>
							<option value="">--Pilih Laporan Data Keuangan--</option>
							<option value="1">1. Listrik</option>
							<option value="2">2. Kas</option>
							<option value="3">3. Beras</option>
							<option value="4">4. Kesehatan</option>
							<option value="5">5. Lauk</option>
							<option value="6">6. Infaq</option>
							<option value="7">7. Bangunan</option>
							<option value="8">8. Bantuan</option>
							<!-- <option value="9">9. Semua</option> -->
						</select>
					</div> 
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Ekspor</button>
				</div>
			</form>
		</div>
	</div>
</div>


<div class="modal fade" id="pilihanExport2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Export Laporan Data Keuangan Mingguan</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<form method="POST" action="<?= base_url('Ekspor/Laporan/2'); ?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="hari" class="ml-1">Pilih hari pertama dalam 7 hari</label>
						<input type="date" class="form-control" id="hari" name="hari" required="">
					</div> 

					<div class="form-group">
						<label for="pilihan" class="ml-1">Pilih data</label>
						<select class="custom-select custom-select-sm" id="pilihan" name="pilihan" required>
							<option value="">--Pilih Laporan Data Keuangan--</option>
							<option value="1">1. Listrik</option>
							<option value="2">2. Kas</option>
							<option value="3">3. Beras</option>
							<option value="4">4. Kesehatan</option>
							<option value="5">5. Lauk</option>
							<option value="6">6. Infaq</option>
							<option value="7">7. Bangunan</option>
							<option value="8">8. Bantuan</option>
							<!-- <option value="9">9. Semua</option> -->
						</select>
					</div> 
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Ekspor</button>
				</div>
			</form>
		</div>
	</div>
</div>


<div class="modal fade" id="pilihanExport3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Export Laporan Data Keuangan Bulanan</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<form method="POST" action="<?= base_url('Ekspor/Laporan/3'); ?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="bulan" class="ml-1">Pilih Bulan</label>
						<select class="custom-select custom-select-sm" id="bulan" name="bulan" required>
							<option value="">--Pilih Bulan--</option>
							<option value="01">1. Januari</option>
							<option value="02">2. Februari</option>
							<option value="03">3. Maret</option>
							<option value="04">4. April</option>
							<option value="05">5. Mei</option>
							<option value="06">6. Juni</option>
							<option value="07">7. Juli</option>
							<option value="08">8. Agustus</option>
							<option value="09">9. September</option>
							<option value="10">10. Oktober</option>
							<option value="11">11. November</option>
							<option value="12">12. Desember</option>
						</select>
					</div>
					<div class="form-group">
						<label for="tahun" class="ml-1">Pilih Tahun</label>
						<select class="custom-select custom-select-sm" id="tahun" name="tahun" required>
							<option value="">--Pilih Tahun--</option>
							<?php for ($i=0; $i < 6; $i++) {?>
								<option value="<?= $tahunan[$i]; ?>"><?= $tahunan[$i]; ?></option>
							<?php } ?>
							
						</select>
					</div> 

					<div class="form-group">
						<label for="pilihan" class="ml-1">Pilih data</label>
						<select class="custom-select custom-select-sm" id="pilihan" name="pilihan" required>
							<option value="">--Pilih Laporan Data Keuangan--</option>
							<option value="1">1. Listrik</option>
							<option value="2">2. Kas</option>
							<option value="3">3. Beras</option>
							<option value="4">4. Kesehatan</option>
							<option value="5">5. Lauk</option>
							<option value="6">6. Infaq</option>
							<option value="7">7. Bangunan</option>
							<option value="8">8. Bantuan</option>
							<!-- <option value="9">9. Semua</option> -->
						</select>
					</div> 
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Ekspor</button>
				</div>
			</form>
		</div>
	</div>
</div>



<div class="modal fade" id="pilihanExport4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Export Laporan Data Keuangan Tahunan</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<form method="POST" action="<?= base_url('Ekspor/Laporan/4'); ?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="tahun" class="ml-1">Pilih Tahun</label>
						<select class="custom-select custom-select-sm" id="tahun" name="tahun" required>
							<option value="">--Pilih Tahun--</option>
							<?php for ($i=0; $i < 6; $i++) {?>
								<option value="<?= $tahunan[$i]; ?>"><?= $tahunan[$i]; ?></option>
							<?php } ?>
							
						</select>
					</div> 

					<div class="form-group">
						<label for="pilihan" class="ml-1">Pilih data</label>
						<select class="custom-select custom-select-sm" id="pilihan" name="pilihan" required>
							<option value="">--Pilih Laporan Data Keuangan--</option>
							<option value="1">1. Listrik</option>
							<option value="2">2. Kas</option>
							<option value="3">3. Beras</option>
							<option value="4">4. Kesehatan</option>
							<option value="5">5. Lauk</option>
							<option value="6">6. Infaq</option>
							<option value="7">7. Bangunan</option>
							<option value="8">8. Bantuan</option>
							<!-- <option value="9">9. Semua</option> -->
						</select>
					</div> 
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Ekspor</button>
				</div>
			</form>
		</div>
	</div>
</div>


