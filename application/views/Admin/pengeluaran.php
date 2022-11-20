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
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengeluaran (Bulan ini)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.  <?= number_format( array_sum($pengeluaran),0,',','.'); ?></div>
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
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pengeluaran Listrik (Bulan ini)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format(array_sum($pengeluaran_listrik),0,',','.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-bolt fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pengeluaran Kas (Bulan ini)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format(array_sum($pengeluaran_kas),0,',','.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-piggy-bank fa-2x text-gray-300"></i>
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
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pengeluaran Beras (Bulan ini)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format(array_sum($pengeluaran_beras),0,',','.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-bottom-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pengeluaran Kesehatan (Bulan ini)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format(array_sum($pengeluaran_kesehatan),0,',','.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-briefcase-medical fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-bottom-dark shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Pengeluaran Lauk (Bulan ini)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format(array_sum($pengeluaran_lauk),0,',','.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-utensils fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-bottom-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pengeluaran Infaq (Bulan ini)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format(array_sum($pengeluaran_infaq),0,',','.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-donate fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-bottom-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pengeluaran Bangunan (Bulan ini)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format(array_sum($pengeluaran_bangunan),0,',','.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-mosque fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pengeluaran Donasi (Bulan ini)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format(array_sum($pengeluaran_bantuan),0,',','.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-hands-helping fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

	<div class="card shadow mb-4 mt-3">
		<div class="card-header py-2 shadow-sm">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold" style="color: #70AD47;">Tabel data pengeluaran </h6>
				<div>
					<a href="#" class="d-sm-inline-block btn btn-sm btn-info shadow-sm" data-toggle="modal" data-target="#tambah_dataPengeluaran">Tambah Data</a>
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
						<?php foreach ($pengeluaran_all as $dt) {?>
							<tr style="text-align: center;">
								<th scope="row"><?= $i+1; ?></th>
								<td><?= substr($dt['tgl_pengeluaran'],8,2).'-'.substr($dt['tgl_pengeluaran'],5,2).'-'.substr($dt['tgl_pengeluaran'],0,4); ?></td>
								<td><?= $dt['keterangan'] ?></td>   
								<td><b>Rp. </b><?= number_format($dt['jumlah'],0,',','.') ?></td>    
								<td scope="row">
									<?php if ($role_id == '0') 
				                    {	
				                      	if ($dt['id_kategori'] == '1' || $dt['id_kategori'] == '4' || $dt['id_kategori'] == '6' || $dt['id_kategori'] == '7' || $dt['id_kategori'] == '8') 
				                    	{?>
				                    		<a href="" name="edit" class="badge badge-warning" data-toggle="modal" data-target="#edit_data_<?= $dt['id_pengeluaran']?>">Edit</a>
											<a href="" name="hapus" class="badge badge-danger" data-toggle="modal" data-target="#hapus_data_<?= $dt['id_pengeluaran']?>">Hapus</i></a>
				                    	<?php }
				                    }

				                    elseif ($role_id == '1') 
				                    { 
				                    	if ($dt['id_kategori'] == '2' || $dt['id_kategori'] == '3' || $dt['id_kategori'] == '5' || $dt['id_kategori'] == '7') 
				                    	{?>
				                    		<a href="" name="edit" class="badge badge-warning" data-toggle="modal" data-target="#edit_data_<?= $dt['id_pengeluaran']?>">Edit</a>
											<a href="" name="hapus" class="badge badge-danger" data-toggle="modal" data-target="#hapus_data_<?= $dt['id_pengeluaran']?>">Hapus</i></a>
				                    	<?php }
				                    }?>
									
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
<!-- Modal Tambah data pengeluaran -->
<div class="modal fade" id="tambah_dataPengeluaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<form method="POST" action="<?= base_url('Pengeluaran/tambah_dataPengeluaran'); ?>">
				<div class="modal-body">							
					<div class="form-group">
						<label for="date" class="ml-1">Tanggal Transaksi</label>
						<input type="date" class="form-control" id="date" name="date" placeholder="Tanggal uang masuk..." required="">
					</div>

					<div class="form-group">
						<label for="jenis" class="ml-1">Pilih pengambilan dari saldo</label>
						<select class="custom-select custom-select-sm" id="jenis" name="jenis" required>
	                        <option value="">--Pilih Jenis--</option>
	                        <?php if ($role_id == '0') 
	                        {?>
	                        	<option value="1">1. Listrik</option>
	                        	<option value="4">2. Kesehatan</option>
	                        	<option value="6">3. Infaq/sodaqoh</option>
	                        	<option value="8">4. Donasi</option>
		                        <option value="7">5. Bangunan</option>
	                        <?php } 
	                        elseif ($role_id == '1') 
	                        	{ ?>
	                        	<option value="2">1. Kas</option>
		                        <option value="3">2. Beras</option>
		                        <option value="5">3. Lauk</option>
		                        <option value="7">4. Bangunan</option>
	                        <?php }?>
	                        
	                        
	                    </select>
	                </div>

					<div class="form-group">
						<label for="keterangan" class="ml-1">Keterangan</label>
						<textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan pengeluaran..." required=""></textarea>
					</div> 
					
					<div class="form-group">
						<label for="jumlah" class="ml-1">Jumlah</label>
						<input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Rp. ..." required="">
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


<?php $i=0; ?>
<?php foreach ($pengeluaran_all as $dt) { ?>
	<div class="modal fade" id="edit_data_<?= $dt['id_pengeluaran']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ubah data pengeluaran</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>

				<form method="POST" action="<?= base_url('Pengeluaran/ubah_dataPengeluaran/'.urlencode($dt['id_pengeluaran'])); ?>">
					<div class="modal-body">
						<div class="form-group">
						<label for="date" class="ml-1">Tanggal Transaksi</label>
						<input type="date" class="form-control" id="date" name="date" placeholder="Tanggal uang masuk..." required="" value="<?= $dt['tgl_pengeluaran'] ?>">
					</div>

					<div class="form-group">
						<label for="jenis" class="ml-1">Pilih pengambilan dari saldo</label>
						<select class="custom-select custom-select-sm" id="jenis" name="jenis" required>
	                        <option value="">--Pilih Jenis--</option>
	                        <?php if ($role_id == '0') 
	                        {?>
	                        	<option value="1" <?php if ($dt['id_kategori'] == '1') { echo "selected";} ?>>1. Listrik</option>
	                        	<option value="4"<?php if ($dt['id_kategori'] == '4') { echo "selected";} ?>>2. Kesehatan</option>
	                        	<option value="6"<?php if ($dt['id_kategori'] == '6') { echo "selected";} ?>>3. Infaq/sodaqoh</option>
	                        	<option value="8"<?php if ($dt['id_kategori'] == '8') { echo "selected";} ?>>4. Donasi</option>
	                        	<option value="7"<?php if ($dt['id_kategori'] == '7') { echo "selected";} ?>>5. Bangunan</option>
	                        <?php } 
	                        elseif ($role_id == '1') 
	                        	{ ?>
	                        	<option value="2"<?php if ($dt['id_kategori'] == '2') { echo "selected";} ?>>1. Kas</option>
		                        <option value="3"<?php if ($dt['id_kategori'] == '3') { echo "selected";} ?>>2. Beras</option>
		                        <option value="5"<?php if ($dt['id_kategori'] == '5') { echo "selected";} ?>>3. Lauk</option>
		                        <option value="7"<?php if ($dt['id_kategori'] == '7') { echo "selected";} ?>>4. Bangunan</option>
	                        <?php }?>
	                        
	                        
	                    </select>
	                </div>

					<div class="form-group">
						<label for="keterangan" class="ml-1">Keterangan</label>
						<textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan pengeluaran..." required=""><?= $dt['keterangan'] ?></textarea>
					</div> 
					
					<div class="form-group">
						<label for="jumlah" class="ml-1">Jumlah</label>
						<input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Rp. ..." value="<?= $dt['jumlah'] ?>" required="">
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


<!-- modal hapus data pengeluaran -->
	<?php $j=0; ?>
	<?php foreach ($pengeluaran_all as $dt) { ?>
		<div class="modal fade" id="hapus_data_<?= $dt['id_pengeluaran']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">

						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body text-center">
						<i class="fa fa-exclamation-triangle fa-3x text-warning"></i>
						<h5>Yakin untuk menghapus data pengeluaran ini?</h5><br>
						<h6 class="text-danger">Jika anda menghapus data ini, maka akan mempengaruhi data keuangan dari tanggal <b><?= substr($dt['tgl_pengeluaran'],8,2).'-'.substr($dt['tgl_pengeluaran'],5,2).'-'.substr($dt['tgl_pengeluaran'],0,4); ?></b></h6>
					</div>
					<div class="modal-footer">
						<a href="<?= base_url('Pengeluaran/hapus_data_pengeluaran/'.urlencode($dt['id_pengeluaran'])); ?>" class="btn btn-danger">Hapus</a>
					</div>
				</div>
			</div>
		</div>
		<?php  $j++; } ?>