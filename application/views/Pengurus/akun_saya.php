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

	<!-- update profil akun -->
	<section class="ketua" id="ketua">
		<h5 class="mt-5 text-dark"><b>Ubah Data Akun</b></h5>
		<div class="row">
			<div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
				<h6>Perbaharui data <br> untuk informasi pengurus santri</h6>
			</div>
			<div class="col-lg-8 col-md-9 col-sm-9 col-xs-12">
				<div class="card bg-white shadow mb-3" style="max-width: 90%; align-content: right; margin-left: 5%;">

					<div class="card-body">
						<form class="user was-validated" method="post" action="<?= base_url('Akun/update_data/').$user['id']; ?>" enctype="multipart/form-data">
							<label for="foto_pengurus"><b>Photo</b></label><br>
							<img class="img-profile rounded-circle mb-3 shadow img-thumbnail" style="height: 110px; width: 110px;" alt="background profil" src="   <?= base_url('assets/img/pengurus/'.$user['image']) ?>" class="rounded-circle"><br>
							<div class="form-group">
								<label for="foto_pengurus" class="btn btn-outline-primary btn-sm shadow">Pilih Foto</label>
								<a href="<?= base_url('Akun/hapus_foto_user/').$user['id']; ?>" class="btn btn-outline-primary btn-sm shadow  mb-2">Hapus Foto</a><br>

								<input type="file" id="foto_pengurus" name="foto_pengurus" accept=".jpg,.jpeg,.png" value="Pilih Foto Profil" style="visibility:hidden;" onchange="this.form.submit();">
							</div>

							<div class="form-group" style="margin-right: 30%; margin-top: -5%;" >
								<label for="username"><b>Username</b></label>
								<input type="text" class="form-control is_invalid form-control-sm shadow" id="username" name="username" aria-describedby="username" placeholder="<?= $user['username']; ?>" value="<?= $user['username']; ?>" required>
								<div class="invalid-feedback">
									Username harus di isi.
								</div>            
							</div>

							<div class="form-group" style="margin-right: 30%;" >
								<label for="nama"><b>Nama Lengkap</b></label>
								<input type="text" class="form-control is_invalid form-control-sm shadow" id="nama" name="nama" aria-describedby="ketua" placeholder="<?= $user['nama']; ?>" value="<?= $user['nama']; ?>" required>
								<div class="invalid-feedback">
									Nama harus di isi.
								</div>            
							</div>

							<div class="form-group" style="margin-right: 30%;" >
								<label for="email"><b>Alamat Email</b></label>
								<input type="email" class="form-control is_invalid form-control-sm shadow" id="email" name="email" aria-describedby="ketua" placeholder="<?= $user['email']; ?>" value="<?= $user['email']; ?>" required>
								<div class="invalid-feedback">
									Alamat email harus di isi.
								</div>            
							</div>
						</div>

						<div class="card-footer">
							<button type="submit" class="btn btn-primary btn-sm shadow" style="float: right;"> Simpan </button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<hr>
	<!-- akhir update password -->


	<!-- update password -->
	<section class="password" id="password">
		<h5 class="mt-5 text-dark"><b>Ubah Password</b></h5>
		<div class="row">
			<div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
				<h6>Perbaharui password <br> untuk keamanan</h6>
			</div>
			<div class="col-lg-8 col-md-9 col-sm-9 col-xs-12">
				<div class="card bg-white shadow mb-3" style="max-width: 90%; align-content: right; margin-left: 5%;">

					<div class="card-body">
						<form class="user was-validated" method="post" action="<?= base_url('Akun/ubah_password/').$user['id']; ?>">
							<div class="form-group mt-3" style="margin-right: 30%;" >
								<label for="passwordlama"><b>Password lama</b></label>
								<input type="password" class="form-control form-password form-control-sm" id="passwordlama" name="passwordlama" placeholder="Password lama" required oninvalid="this.setCustomValidity('Anda belum mengisi password lama untuk akun anda..')" oninput="setCustomValidity('')" minlength="8" maxlength="50">
								<!-- menampilkan notifikasi kesalahan inputan -->
								<?= form_error('passwordlama', '<small class="text-danger pl-3">','</small>'); ?>
							</div>

							<div class="form-group mt-3" style="margin-right: 30%;" >
								<label for="passwordbaru"><b>Password baru</b></label>
								<input type="password" class="form-control form-password form-control-sm" id="passwordbaru" name="passwordbaru" placeholder="Password baru" required oninvalid="this.setCustomValidity('Anda belum mengisi password baru untuk akun anda..')" oninput="setCustomValidity('')" minlength="8" maxlength="50">
								<!-- menampilkan notifikasi kesalahan inputan -->
								<?= form_error('passwordbaru', '<small class="text-danger pl-3">','</small>'); ?>
							</div>

							<div class="form-group mt-3" style="margin-right: 30%;" >
								<label for="passwordbaru2"><b>Ulangi password</b></label>
								<input type="password" class="form-control form-password form-control-sm" id="passwordbaru2" name="passwordbaru2" placeholder="Password baru" required oninvalid="this.setCustomValidity('Harap mengulangi password baru anda..')" oninput="setCustomValidity('')" minlength="8" maxlength="50">
								<!-- menampilkan notifikasi kesalahan inputan -->
								<?= form_error('passwordbaru2', '<small class="text-danger pl-3">','</small>'); ?>
							</div>
						</div>

						<div class="card-footer">
							<button type="submit" class="btn btn-warning btn-sm shadow"> Ubah </button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- akhir update password -->


	<!-- End of Content Row -->


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content-->
