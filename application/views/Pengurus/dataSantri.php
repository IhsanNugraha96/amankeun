<!-- Begin Page Content -->
<div class="container-fluid">



	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data <?php if ($role_id !== 2) { echo "Santri";} else {echo"Santriyah";} ?></h1>

		<!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
	</div>
	<div class="row">
		<div class="col-lg-12">
			<?= $this->session->flashdata('message'); ?>
		</div>
	</div>

	<!-- Content Row -->
	<div class="card shadow mb-4 mt-3">
		<div class="card-header py-2 shadow-sm">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold" style="color: #70AD47;">Tabel data <?php if ($role_id !== 2) { echo "santri";} else {echo"santriyah";} ?> </h6>
				<div>
					<?php if ($role_id > 1) {?>
					<a href="" class="d-sm-inline-block btn btn-sm btn-info shadow-sm" data-toggle="modal" data-target="#tambah_santri">Tambah Data</a>
				<?php } ?>
				</div>
			</div>
		</div>
		<div class="card-body shadow-sm">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr style="text-align: center;">
							<th style="width: 5%;">No</th>
							<th width="15%">Foto</th>
							<th>Nama Lengkap</th>
							<th>Tempat Lahir</th>
							<th>Tanggal Lahir</th>
							<th>Angkatan</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; ?>
						<?php foreach ($santri as $snt) { ?>
							<tr style="text-align: center;">
								<th scope="row"><?=$i+1; ?></th>
								<td>
									<img class="img-profile" src="<?= base_url('assets/img/santri/'.$snt['foto']); ?>" style="width: 50%;">
								</td>
								<td><?=$snt['nama']; ?></td>   
								<td><?=$snt['tempat_lahir']; ?></td>  
								<td><?=$snt['tgl_lahir']; ?></td>  
								<td><?=$snt['tahun_masuk']; ?></td>   
								<td><?php if ($snt['status'] == '1' || $snt['tgl_keluar'] == "0000-00-00") { echo '<b class="text-success"> Aktif <b>'; } else { echo '<b class="text-danger"> Tidak Aktif <b>';} ?></td>     
									<td scope="row">
										<a href="" name="detail" class="badge badge-info" data-toggle="modal" data-target="#detail_santri_<?= $snt['id_santri']; ?>"><i class="fas fa-info"></i></a>
										<?php if ($role_id > 1) { ?>
										<a href="" name="reset" class="badge badge-warning" data-toggle="modal" data-target="#edit_data_<?= $snt['id_santri']; ?>"><i class="fas fa-edit"></i></a>
										<a href="" name="detail" class="badge badge-danger" data-toggle="modal" data-target="#hapus_data_santri_<?= $snt['id_santri']; ?>"><i class="fas fa-trash"></i></a>	
										<?php } ?>									
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

	</div>
	<!-- End of Main Content -->


	<!-- Modal -->
	<div id="tambah_santri" class="modal modal-edu-general fade shadow" role="dialog" style="padding: 50px;">
		<div class="modal-dialog">
			<div class="modal-content shadow">
				<div class="modal-close-area modal-close-df" style="padding: 2%;">
					<a class="close" data-dismiss="modal" href="#"><i class="fas fa-times"></i></a>
				</div>

				<div class="modal-body">
					<div class=" text-center">
						<h5><b>Formulir Data Santri Baru</b></h5>
					</div>

					<div style="width: 100%;">
						<form method="POST" action="<?= base_url('Pengurus/dataSantri/tambah/0'); ?>" enctype="multipart/form-data">
							<div class="modal-body">

								<!-- <img class="mb-3 shadow img-thumbnail" style="height: 110px; width: 110px;" alt="background profil" src=""><br> -->

								<hr><b class="text-info"><u>Data Santri</u></b><br><br>
								<div class="form-group">
									<label for="angkatan" class="ml-1">Tahun Angkatan</label>
									<select class="custom-select custom-select-sm" id="angkatan" name="angkatan" required>
										<option value="">--Pilih Tahun--</option>
										<?php foreach ($angkatan as $ang) 
										{?>
											<option value="<?= $ang['id_angkatan'] ?>"><?= $ang['tahun_masuk']; ?></option>
										<?php } ?>
									</select>
								</div> 
								<div class="form-group">
									<label for="nis" class="ml-1">NI Santri</label>
									<input type="text" class="form-control" id="nis" name="nis" placeholder="..." required="">
								</div>
								<div class="form-group">
									<label for="tgl_masuk" class="ml-1">Tgl. masuk</label>
									<input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" placeholder="..." required="">
								</div>
								<div class="form-group">
									<label for="mondok" class="ml-1">Mondok</label>
									<select class="custom-select custom-select-sm" id="mondok" name="mondok" required>
										<option value="">--Pilih salah satu--</option>
										<option value="1">Ya</option>						                        
										<option value="0">Tidak</option>
									</select>
								</div>
								<div class="form-group">
									<label for="yatim" class="ml-1">Yatim</label>
									<select class="custom-select custom-select-sm" id="yatim" name="yatim" required>
										<option value="">--Pilih salah satu--</option>
										<option value="1">Ya</option>						                        
										<option value="0">Tidak</option>
									</select>
								</div> <br>


								<hr><b class="text-info"><u>Data Diri</u></b><br><br>
								<div class="form-group">
									<label for="nik" class="ml-1">NIK</label>
									<input type="number" class="form-control" id="nik" name="nik" placeholder="..." required="">
								</div>
								<div class="form-group">
									<label for="nama" class="ml-1">Nama</label>
									<input type="text" class="form-control" id="nama" name="nama" placeholder="..." required="">
								</div>
								<div class="form-group">
									<label for="tl" class="ml-1">Tempat lahir</label>
									<input type="text" class="form-control" id="tl" name="tl" placeholder="..." required="">
								</div>
								<div class="form-group">
									<label for="tlh" class="ml-1">Tgl. lahir</label>
									<input type="date" class="form-control" id="tlh" name="tlh" placeholder="..." required="">
								</div>
								<div class="form-group" hidden="true">
									<label for="jkl" class="ml-1">J. kelamin</label>
									<select class="custom-select custom-select-sm" id="jkl" name="jkl" required>
										<option value="">--Pilih salah satu--</option>
										<option value="L" <?php if ($role_id == "2") { echo "selected"; } ?>>Laki-Laki</option>				                        
										<option value="P" <?php if ($role_id == "3") { echo "selected"; } ?>>Perempuan</option>
									</select>
								</div>
								<div class="form-group">
									<label for="alamat" class="ml-1">Alamat</label>
									<textarea class="form-control" id="alamat" name="alamat" placeholder="..." required=""></textarea>
								</div>
								<div class="form-group">
									<label for="foto">Photo</label><br>
									<input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png" value="Pilih Foto Profil">
								</div>



								<hr><b class="text-info"><u>Data Orang Tua</u></b><br><br>
								<div class="form-group">
									<label for="no_kk" class="ml-1">No Kartu Keluarga</label>
									<input type="number" class="form-control" id="no_kk" name="no_kk" placeholder="..." required="">
								</div>
								<div class="form-group">
									<label for="nama_ayah" class="ml-1">Nama Ayah</label>
									<input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="..." required="">
								</div>
								<div class="form-group">
									<label for="nama_ibu" class="ml-1">Nama Ibu</label>
									<input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="..." required="">
								</div>
								<div class="form-group">
									<label for="alamat_ortu" class="ml-1">Alamat</label>
									<textarea class="form-control" id="alamat_ortu" name="alamat_ortu" placeholder="..." required=""></textarea>
								</div>
								<div class="form-group">
									<label for="no_telp" class="ml-1">No. Telp.</label>
									<input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="..." required="">
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
		</div>
	</div>





	<?php $i=0;
	foreach ($santri as $snt) {?>
		<div id="detail_santri_<?= $snt['id_santri']; ?>" class="modal modal-edu-general fade shadow" role="dialog" style="padding: 50px;">
			<div class="modal-dialog">
				<div class="modal-content shadow">
					<div class="modal-close-area modal-close-df" style="padding: 2%;">
						<a class="close" data-dismiss="modal" href="#"><i class="fas fa-times"></i></a>
					</div>
					<div class="modal-body">
						<div class=" text-center">
							<img class="img-profile mb-2 shadow-sm" src="<?= base_url('assets/img/santri/'.$snt['foto']); ?>" style="width: 30%;">
							<h5 class="text-success"><b><?= $snt['nama']; ?></b></h5><br>
						</div>

						<div style="width: 100%;">
							<table class="table table-bordered" id="" width="100%" cellspacing="0">

								<tbody>
									<tr class="text-info">
										<th colspan="2">Data Santri</th>
									</tr>
									<tr>
										<td><b>Angkatan</b></td>   
										<td><?=$snt['tahun_masuk']; ?></td>   
									</tr>
									<tr>
										<td><b>Tgl Masuk</b></td>   
										<td><?= substr($snt['tgl_masuk'],8,2).'-'.substr($snt['tgl_masuk'],5,2).'-'.substr($snt['tgl_masuk'],0,4); ?></td>   
									</tr>
									<tr>
										<td><b>Tgl Keluar</b></td>   
										<td><?php if ($snt['tgl_keluar'] == '0000-00-00') {echo '-';} else{ echo substr($snt['tgl_keluar'],8,2).'-'.substr($snt['tgl_keluar'],5,2).'-'.substr($snt['tgl_keluar'],0,4); } ?></td>   
									</tr>
									<tr>
										<td><b>Mondok</b></td>   
										<td><?php if ($snt['mondok'] == '0') {echo 'Tidak';} else{ echo 'Ya'; } ?></td>   
									</tr>
									<tr><td colspan="2"></td></tr>




									<tr class="text-info">
										<th colspan="2">Data Diri</th>
									</tr>
									<tr>
										<td><b>NIS</b></td>   
										<td><?=$snt['nis']; ?></td>   
									</tr>
									<tr>
										<td>NIK</td>   
										<td><?=$snt['nik']; ?></td> 
									</tr>
									<tr>
										<td>TTL</td>   
										<td><?=$snt['tempat_lahir'].', '.substr($snt['tgl_lahir'],8,2).'-'.substr($snt['tgl_lahir'],5,2).'-'.substr($snt['tgl_lahir'],0,4); ?></td>   
									</tr>
									<tr>
										<td>J.Kelamin</td>   
										<td><?=$snt['jenis_kelamin']; ?></td>   
									</tr>
									<tr>
										<td>Alamat</td>   
										<td><?=$snt['alamat']; ?></td>   
									</tr>
									
									<tr><td colspan="2"></td></tr>


									<tr class="text-info">
										<th colspan="2">Data Orang Tua</th>
									</tr>
									<tr>
										<td>No KK</td>   
										<td><?=$snt['no_kk']; ?></td> 
									</tr>
									<tr>
										<td>Ayah</td>   
										<td><?=$snt['ayah']; ?></td> 
									</tr>
									<tr>
										<td>Ibu</td>   
										<td><?=$snt['ibu']; ?></td> 
									</tr>
									<tr>
										<td>No. Telp</td>   
										<td><?=$snt['no_telp']; ?></td> 
									</tr>
									<tr>
										<td>Alamat</td>   
										<td><?=$snt['alamat_ortu']; ?></td> 
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">
						<a href="#" data-dismiss="modal" class="btn btn-info">close</a>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>


	<!-- modal edit -->
	<?php $i=0;
	foreach ($santri as $snt) {?>
		<div id="edit_data_<?= $snt['id_santri']; ?>" class="modal modal-edu-general fade shadow" role="dialog" style="padding: 50px;">
			<div class="modal-dialog">
				<div class="modal-content shadow">
					<div class="modal-close-area modal-close-df"  style="padding: 2%;">
						<a class="close" data-dismiss="modal" href="#"><i class="fas fa-times"></i></a>
					</div>
					<form method="POST" action="<?= base_url('Pengurus/dataSantri/ubah/'.$snt['id_santri']); ?>" enctype="multipart/form-data">
					<div class="modal-body">
						<hr><b><u>Data Santri</u></b><br><br>
								<div class="form-group">
									<label for="angkatan" class="ml-1">Tahun Angkatan</label>
									<select class="custom-select custom-select-sm" id="angkatan" name="angkatan" required>
										<option value="">--Pilih Tahun--</option>
										<?php foreach ($angkatan as $ang) 
										{?>
											<option value="<?= $ang['id_angkatan'] ?>" <?php if ($snt['id_angkatan'] == $ang['id_angkatan']) { echo "selected"; } ?>><?= $ang['tahun_masuk']; ?></option>
										<?php } ?>
									</select>
								</div> 
								<div class="form-group">
									<label for="nis" class="ml-1">NI Santri</label>
									<input type="text" class="form-control" id="nis" name="nis" placeholder="..." value="<?= $snt['nis']; ?>" required="">
								</div>
								<div class="form-group">
									<label for="tgl_masuk" class="ml-1">Tgl. masuk</label>
									<input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" placeholder="..." required="" value="<?= $snt['tgl_masuk']; ?>">
								</div>
								<div class="form-group">
									<label for="tgl_keluar" class="ml-1">Tgl. keluar</label>
									<input type="date" class="form-control" id="tgl_keluar" name="tgl_keluar" placeholder="..." value="<?= $snt['tgl_keluar']; ?>"> 
								</div>
								<div class="form-group">
									<label for="mondok" class="ml-1">Mondok</label>
									<select class="custom-select custom-select-sm" id="mondok" name="mondok" required>
										<option value="">--Pilih salah satu--</option>
										<option value="1" <?php if ($snt['mondok'] == "1") { echo "selected"; } ?>>Ya</option>						                        
										<option value="0" <?php if ($snt['mondok'] == "0") { echo "selected"; } ?>>Tidak</option>
									</select>
								</div>
								<div class="form-group">
									<label for="yatim" class="ml-1">Yatim</label>
									<select class="custom-select custom-select-sm" id="yatim" name="yatim" required>
										<option value="">--Pilih salah satu--</option>
										<option value="1" <?php if ($snt['yatim'] == "1") { echo "selected"; } ?>>Ya</option>						                        
										<option value="0" <?php if ($snt['yatim'] == "0") { echo "selected"; } ?>>Tidak</option>
									</select>
								</div> <br>


								<hr><b><u>Data Diri</u></b><br><br>
								<div class="form-group">
									<label for="nik" class="ml-1">NIK</label>
									<input type="number" class="form-control" id="nik" name="nik" placeholder="..." required="" value="<?= $snt['nik']; ?>">
								</div>
								<div class="form-group">
									<label for="nama" class="ml-1">Nama</label>
									<input type="text" class="form-control" id="nama" name="nama" placeholder="..." required="" value="<?= $snt['nama']; ?>">
								</div>
								<div class="form-group">
									<label for="tl" class="ml-1">Tempat lahir</label>
									<input type="text" class="form-control" id="tl" name="tl" placeholder="..." required="" value="<?= $snt['tempat_lahir']; ?>">
								</div>
								<div class="form-group">
									<label for="tlh" class="ml-1">Tgl. lahir</label>
									<input type="date" class="form-control" id="tlh" name="tlh" placeholder="..." required="" value="<?= $snt['tgl_lahir']; ?>">
								</div>
								<div class="form-group" hidden="true">
									<label for="jkl" class="ml-1">J. kelamin</label>
									<select class="custom-select custom-select-sm" id="jkl" name="jkl" required>
										<option value="">--Pilih salah satu--</option>
										<option value="L" <?php if ($role_id == "2") { echo "selected"; } ?>>Laki-Laki</option>				                        
										<option value="P" <?php if ($role_id == "3") { echo "selected"; } ?>>Perempuan</option>
									</select>
								</div>
								<div class="form-group">
									<label for="alamat" class="ml-1">Alamat</label>
									<textarea class="form-control" id="alamat" name="alamat" placeholder="..." required=""><?= $snt['alamat']; ?></textarea>
								</div>
								<div class="form-group">
									<label for="foto">Photo</label><br>
									<img class="img-profile rounded-circle mb-3 shadow img-thumbnail" style="height: 110px; width: 110px;" alt="background profil" src="   <?= base_url('assets/img/santri/'.$snt['foto']) ?>" class="rounded-circle"><br>
									<input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png" value="Pilih Foto Profil">
								</div>



								<hr><b><u>Data Orang Tua</u></b><br><br>
								<div class="form-group">
									<label for="no_kk" class="ml-1">No Kartu Keluarga</label>
									<input type="number" class="form-control" id="no_kk" name="no_kk" placeholder="..." required="" value="<?= $snt['no_kk']; ?>">
								</div>
								<div class="form-group">
									<label for="nama_ayah" class="ml-1">Nama Ayah</label>
									<input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="..." required="" value="<?= $snt['ayah']; ?>">
								</div>
								<div class="form-group">
									<label for="nama_ibu" class="ml-1">Nama Ibu</label>
									<input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="..." required="" value="<?= $snt['ibu']; ?>">
								</div>
								<div class="form-group">
									<label for="alamat_ortu" class="ml-1">Alamat</label>
									<textarea class="form-control" id="alamat_ortu" name="alamat_ortu" placeholder="..." required=""><?= $snt['alamat_ortu']; ?></textarea>
								</div>
								<div class="form-group">
									<label for="no_telp" class="ml-1">No. Telp.</label>
									<input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="..." required="" value="<?= $snt['no_telp']; ?>">
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
	<?php } ?>


	<!-- modal hapus -->
	<?php $i=0;
	foreach ($santri as $snt) {?>
		<div id="hapus_data_santri_<?= $snt['id_santri']; ?>" class="modal modal-edu-general fade shadow" role="dialog" style="padding: 50px;">
			<div class="modal-dialog">
				<div class="modal-content shadow">
					<div class="modal-close-area modal-close-df" style="padding: 2%;">
						<a class="close" data-dismiss="modal" href="#"><i class="fas fa-times"></i></a>
					</div>
					<div class="modal-body text-center">
						<img class="img-profile mb-2" src="<?= base_url('assets/img/santri/'.$snt['foto']) ?>" style="width: 40%;">
						<h5 class="text-info"><b><?= $snt['nama']; ?></b></h5><br>
						<h4>Hapus dari daftar santri?</h4>
						<small class="text-danger"><b>terdapat <?= $pembayaran[$i] ?> transaksi pembayaran..</b> <br> (jika data di hapus, maka data pembayaran yang telah dilakukan oleh <?= $snt['nama']; ?> akan menjadi anonim)</small>
					</div>
					<div class="modal-footer">
						<a href="<?= base_url('Pengurus/hapus_data_santri/'.$snt['id_santri']) ?>" class="btn btn-danger">hapus</a>
					</div>
				</div>
			</div>
		</div>
		<?php $i++; } ?>