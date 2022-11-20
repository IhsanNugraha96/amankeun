<small>
	<div class="card shadow mb-4">
		<div class="card-header py-2 shadow-sm">
			<div class="d-sm-flex align-items-center justify-content-between">
				<b class="m-0 font-weight-bold" style="color: #70AD47;">Detail data pembayaran "<?= $santri['nama']; ?>"</b>
			</div>
		</div>
		<div class="card-body shadow-sm">
			<div class="table-responsive">
				<table class="table table-bordered" width="100%" cellspacing="0" style="height: 100px;">
					<thead>
						<tr style="text-align: center;">
							<th width="10%">Tanggal</th>
							<th width="45%">Pembayaran</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($biaya){ 
							foreach ($biaya as $ls) {?>
								<tr style="text-align: center;">
									<td><?= substr($ls['tgl_bayar'],8,2).'-'.substr($ls['tgl_bayar'],5,2).'-'.substr($ls['tgl_bayar'],0,4); ?></td>
									<td><?= 'Rp. '. number_format($ls['jumlah'],0,',','.');?></td>
								</tr>

							<?php } 
						}
						else {?>
							<tr style="text-align: center;">
								<td colspan="2">tidak ada data pembayaran!</td>
							</tr>
						<?php }?>

					</tbody>

				</table>
			</div>  
		</div>
	</div>
</small>