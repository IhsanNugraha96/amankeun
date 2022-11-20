<small>
	<div class="card shadow mb-4 mt-3">
		<div class="card-header py-2 shadow-sm">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold" style="color: #70AD47;">Tabel data uang kesehatan <?php 	if ($bulan == '01') { echo "Januari";}
									elseif ($bulan == '02') { echo "Februari";}
									elseif ($bulan == '03') { echo "Maret";}
									elseif ($bulan == '04') { echo "April";}
									elseif ($bulan == '05') { echo "Mei";}
									elseif ($bulan == '06') { echo "Juni";}
									elseif ($bulan == '07') { echo "Juli";}
									elseif ($bulan == '08') { echo "Agustus";}
									elseif ($bulan == '09') { echo "September";}
									elseif ($bulan == '10') { echo "Oktober";}
									elseif ($bulan == '11') { echo "November";}
									elseif ($bulan == '12') { echo "Desember";} ?></h6>
				
			</div>
		</div>
		<div class="card-body shadow-sm">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="max-height: 100px;">
					<thead>
						<tr style="text-align: center;">
							<th width="3%">No</th>
							<th width="10%">Tanggal</th>
							<th width="45%">Keterangan</th>
							<th>Debit</th>
							<th>Kredit</th>							
							<th>Saldo</th>
						</tr>
						<tr class="text-center font-weight-bold text-primary">
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Saldo Awal Bulan</td>
							<td>Rp. <?php echo number_format($saldo_awal_bln['kesehatan'],0,',','.');?></td>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; if ($kesehatan) {
							foreach ($kesehatan as $ls) {?>
								<tr style="text-align: center;">
									<td><?= $i+1; ?></td>
									<td><?= substr($ls['tgl'],8,2).'-'.substr($ls['tgl'],5,2).'-'.substr($ls['tgl'],0,4); ?></td>
									<td><?= $ls['keterangan']; ?></td>
									<td><?php if ($ls['kd'] == 'pem') { echo 'Rp. '. number_format($ls['jumlah'],0,',','.');} else {echo '-';}?></td>
									<td><?php if ($ls['kd'] == 'pen') { echo 'Rp. '. number_format($ls['jumlah'],0,',','.');} else {echo '-';}?></td>
									<td></td>
								</tr>
							<?php $i++;} 
						}?>

					</tbody>

					<tfoot>

						<tr class="text-center font-weight-bold text-primary">
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Saldo Akhir Bulan</td>
							<td>Rp. <?php echo number_format($saldo_akhir_bln['kesehatan'],0,',','.');?></td>
						</tr>
					</tfoot>	
				</table>
			</div>  
		</div>
	</div>
</small>