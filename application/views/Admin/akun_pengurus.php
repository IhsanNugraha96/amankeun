<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-dark"><?= $title; ?></h1>
	<div class="row">
		<div class="col-lg-8 ">
			<?= $this->session->flashdata('message'); ?>
		</div>
	</div>
	<!-- Content Row -->

	<!-- profil akun bedahara -->
	<div>
		<a href="#" class="d-sm-inline-block btn btn-sm btn-info shadow-sm float-right" data-toggle="modal" data-target="#tambah_akun" style="margin-right: 3%;">Tambah Akun</a>
	</div>
	<section class="bendahara" id="bendahara">
		<h5 class="mt-5 text-dark"><b>Akun Bendahara</b></h5>
		<div class="row">
			<div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
				<h6>Perbaharui data akun<br> jika diperlukan</h6>
			</div>
			<div class="col-lg-8 col-md-9 col-sm-9 col-xs-12">
				

				<?php if ($akun_bendahara) {
					foreach ($akun_bendahara as $bnd) 
						{?>
							<div class="card bg-white shadow mb-3" style="max-width: 90%; align-content: right; margin-left: 5%;">
								<div class="card-body text-center">
									<form class="user was-validated" method="post" action="<?= base_url('Akun/update_data_pengurus/').$bnd['id']; ?>" enctype="multipart/form-data">
										<div class="row">
											<div class="col-sm-4">
												<img class="img-profile rounded-circle mb-3 shadow img-thumbnail text-center" style="height: 110px; width: 110px;" alt="background profil" src="   <?= base_url('assets/img/pengurus/'.$bnd['image']) ?>" class="rounded-circle"><br>
												<b><?= $bnd['nama']; ?></b>
											</div>	
											<div class="col-sm-8">
												<div class="form-group" style="margin-right: 30%;" >
													<label for="username"><b>Username</b></label>
													<input type="text" class="form-control is_invalid form-control-sm shadow" id="username" name="username" aria-describedby="username" placeholder="<?= $bnd['username']; ?>" value="<?= $bnd['username']; ?>" required>
													<div class="invalid-feedback">
														Username harus di isi.
													</div>            
												</div>
												<div class="form-group" style="margin-right: 30%;" >
													<label for="password<?=$bnd['id'];?>"><b>Password</b></label>
													<input type="password" class="form-control is_invalid form-control-sm shadow" id="password" name="password" aria-describedby="Password" placeholder="<?= $bnd['password']; ?>" value="<?= $bnd['password']; ?>" required>
													<div class="invalid-feedback">
														Password harus di isi.
													</div>            
												</div>
											</div>
										</div>
									</div>

									<div class="card-footer">
										<button type="submit" class="btn btn-primary btn-sm shadow" style="float: right;"> Simpan </button>
										<a href="" class="btn btn-danger btn-sm shadow mx-1" data-toggle="modal" data-target="#hapus_akun_bendahara<?= $bnd['id']?>" style="float: right;"> Hapus Akun</a>
									</form>
								</div>
							</div>
						<?php } 
					}?>
				</div>
			</div>
		</section>

		<hr>
		<!-- akhir akun bendahara -->


		<!-- update akun pengurus -->
		<section class="pengurus" id="pengurus">
			<h5 class="mt-5 text-dark"><b>Akun Pengurus</b></h5>
			<div class="row">
				<div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
					<h6>Perbaharui data akun<br> jika diperlukan</h6>
				</div>
				<div class="col-lg-8 col-md-9 col-sm-9 col-xs-12">


					<?php if ($akun_pengurus) {
						foreach ($akun_pengurus as $png) 
							{?>
								<div class="card bg-white shadow mb-3" style="max-width: 90%; align-content: right; margin-left: 5%;">
									<div class="card-body text-center">
										<form class="user was-validated" method="post" action="<?= base_url('Akun/update_data_pengurus/').$png['id']; ?>" enctype="multipart/form-data">
											<div class="row">
												<div class="col-sm-4">
													<img class="img-profile rounded-circle mb-3 shadow img-thumbnail text-center" style="height: 110px; width: 110px;" alt="background profil" src="   <?= base_url('assets/img/pengurus/'.$png['image']) ?>" class="rounded-circle"><br>
													<b><?= $png['nama']; ?></b>
												</div>	
												<div class="col-sm-8">
													<div class="form-group" style="margin-right: 30%;" >
														<label for="username"><b>Username</b></label>
														<input type="text" class="form-control is_invalid form-control-sm shadow" id="username" name="username" aria-describedby="username" placeholder="<?= $png['username']; ?>" value="<?= $png['username']; ?>" required>
														<div class="invalid-feedback">
															Username harus di isi.
														</div>            
													</div> 
													<div class="form-group" style="margin-right: 30%;" >
														<label for="password"><b>Password</b></label>
														<input type="password" class="form-control is_invalid form-control-sm shadow" id="password" name="password" aria-describedby="password" placeholder="<?= $png['password']; ?>" value="<?= $png['password']; ?>" required>
														<div class="invalid-feedback">
															Password harus di isi.
														</div>            
													</div>
												</div>

												
											</div>


										</div>

										<div class="card-footer">
											<button type="submit" class="btn btn-primary btn-sm shadow" style="float: right;"> Simpan </button>
											<a href="" class="btn btn-danger btn-sm shadow mx-1" data-toggle="modal" data-target="#hapus_akun_pengurus<?= $png['id']?>" style="float: right;"> Hapus Akun</a>
										</form>
									</div>
								</div>
							<?php } 
						}?>



					</div>
				</div>
			</section>
			<!-- akhir akun pengurus -->

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- End of Main Content-->

<!-- Modal -->
<!-- Modal Tambah akun -->
<div class="modal fade" id="tambah_akun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Akun Baru</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<form method="POST" action="<?= base_url('Akun/tambah_akun'); ?>">
				<div class="modal-body">	
				<div class="form-group">
						<label for="role" class="ml-1">Pilih jenis akun</label>
						<select class="custom-select custom-select-sm" id="role" name="role" required>
	                        <option value="">--Pilih Jenis--</option>
	                        <!-- <option value="0">Administrator</option> -->
	                        <option value="1">Bendahara</option>
	                        <option value="2">Pengurus Putri</option>
	                        <option value="3">Pengurus Putra</option>	                    
	                    </select>
	                </div>						
					<div class="form-group">
						<label for="username" class="ml-1">Username</label>
						<input type="text" class="form-control" id="username" name="username" placeholder="Username..." required="">
					</div> 
					
					<div class="form-group">
						<labelpassword" class="ml-1">Password</label>
						<input type="text" class="form-control" id="password" name="password" placeholder="Password..." required="">
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



<!-- modal hapus akun bendahara -->
	<?php $j=0; ?>
	<?php foreach ($akun_bendahara as $bnd) { ?>
		<div class="modal fade" id="hapus_akun_bendahara<?= $bnd['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">

						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body text-center">
						<i class="fa fa-exclamation-triangle fa-3x text-warning"></i>
						<h5>Yakin untuk menghapus akun ini?</h5><br>
					</div>
					<div class="modal-footer">
						<a href="<?= base_url('Akun/hapus_akun/'.urlencode($bnd['id'])); ?>" class="btn btn-danger">Hapus</a>
					</div>
				</div>
			</div>
		</div>
		<?php  $j++; } ?>


<!-- modal hapus akun pengurus -->
	<?php $j=0; ?>
	<?php foreach ($akun_pengurus as $png) { ?>
		<div class="modal fade" id="hapus_akun_pengurus<?= $png['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">

						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body text-center">
						<i class="fa fa-exclamation-triangle fa-3x text-warning"></i>
						<h5>Yakin untuk menghapus akun ini?</h5><br>
					</div>
					<div class="modal-footer">
						<a href="<?= base_url('Akun/hapus_akun/'.urlencode($png['id'])); ?>" class="btn btn-danger">Hapus</a>
					</div>
				</div>
			</div>
		</div>
		<?php  $j++; } ?>