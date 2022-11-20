<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan_Model extends CI_Model {

	public function get_all_aturan_pembayaran()
	{
		$query = "SELECT * FROM aturan_pembayaran JOIN angkatan
				ON aturan_pembayaran.id_aturan_bayar = angkatan.id_aturan_bayar
				ORDER BY angkatan.tahun_masuk DESC";
		return $this->db->query($query)->result_array();
	}

	public function cekAngkatanByTahun($tahun)
	{
		$id = "'".$tahun."'";
		$query = "SELECT * FROM angkatan WHERE tahun_masuk = $id";
		return $this->db->query($query)->num_rows();
	}

	public function cekJmlSantriByIdAtrAngkatan($atr)
	{
		$id = "'".$atr."'";
		$query = "SELECT * FROM angkatan JOIN santri
				ON angkatan.id_angkatan = santri.id_angkatan
				WHERE angkatan.id_aturan_bayar = $id";
		return $this->db->query($query)->num_rows();
	}

	public function getPemasukanBulanIni($bulan)
	{
		$query = "SELECT * FROM pembayaran WHERE tgl_bayar like '$bulan%'";
		return $this->db->query($query)->result_array();
	}

	public function get_data_pengeluaran_bulan_ini($bulan)
	{
		$query = "SELECT * FROM pengeluaran WHERE tgl_pengeluaran like '$bulan%'";
		return $this->db->query($query)->result_array();
	}

	public function get_all_donasi_dr_luar()
	{
		$query = "SELECT * FROM bantuan ORDER BY tgl_bantuan DESC";
		return $this->db->query($query)->result_array();
	}

	public function get_data_pemasukan_donasi_bulan_ini($bulan)
	{
		$query = "SELECT jumlah FROM bantuan WHERE tgl_bantuan like '$bulan%'";
		return $this->db->query($query)->result_array();
	}

	public function get_saldo_akhir_donasi_dr_luar()
	{
		$query = "SELECT bantuan FROM saldo ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function cek_saldo_hari_ini($tgl)
	{
		$id = "'".$tgl."'";
		$query = "SELECT * FROM saldo WHERE tanggal = $id";
		return $this->db->query($query)->row_array();
	}

	public function cek_saldo_hari_ini2($tgl)
	{
		$id = "'".$tgl."'";
		$query = "SELECT * FROM saldo WHERE tanggal <= $id ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_saldo_sebelumnya($tgl)
	{
		$id = "'".$tgl."'";
		$query = "SELECT * FROM saldo WHERE tanggal < $id ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_data_saldo_setelahnya($tgl)
	{
		$id = "'".$tgl."'";
		$query = "SELECT * FROM saldo WHERE tanggal > $id ORDER BY tanggal DESC";
		return $this->db->query($query)->result_array();
	}

	public function get_data_bantuanDana_byId($id)
	{
		$id2 = "'".$id."'";
		$query = "SELECT * FROM bantuan WHERE id_bantuan = $id2";
		return $this->db->query($query)->row_array();
	}

	public function get_data_bulan_listrik()
	{
		$query = "SELECT * FROM pembayaran WHERE id_jenis_transaksi = '1' ORDER BY bulan_bayar DESC";
		return $this->db->query($query)->result_array();
	}

	public function get_data_belum_bayar_listrik_bulanan($bln)
	{
		$bulan = $bln.'-01';

		$query = "SELECT a.nama, b.tahun_masuk FROM santri a INNER JOIN angkatan b ON a.id_angkatan=b.id_angkatan 
					WHERE (a.id_kategori_santri='1' or a.id_kategori_santri='4') and a.tgl_masuk<= '$bulan' and a.id_santri NOT IN (SELECT id_santri FROM pembayaran WHERE id_jenis_transaksi = '1' and bulan_bayar like '$bln%')";
		return $this->db->query($query)->result_array();
	}

	public function get_saldo_akhir_listrik()
	{
		$query = "SELECT listrik FROM saldo ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_all_uang_listrik_Setahun($tahun)
	{
		$query = "SELECT jumlah FROM pembayaran WHERE id_jenis_transaksi = '1' and bulan_bayar like '$tahun%'";
		return $this->db->query($query)->result_array();
	}

	public function get_data_listrik_satu_bulan($bulan)
	{
		$query = "SELECT santri.nama,angkatan.tahun_masuk,pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar FROM pembayaran 
				JOIN santri
				ON pembayaran.id_santri = santri.id_santri 
				JOIN angkatan
				ON santri.id_angkatan = angkatan.id_angkatan
				WHERE pembayaran.id_jenis_transaksi = '1' and pembayaran.bulan_bayar like '$bulan%'";
		return $this->db->query($query)->result_array();
	}

	public function get_data_biaya_iuran_santri($id_santri_terpilih)
	{
		$id = "'".$id_santri_terpilih."'";
		$query = "SELECT * FROM santri
				JOIN kategori_santri ON santri.id_kategori_santri = kategori_santri.id_kategori_santri
				JOIN angkatan ON santri.id_angkatan = angkatan.id_angkatan
				JOIN aturan_pembayaran ON angkatan.id_aturan_bayar = aturan_pembayaran.id_aturan_bayar
				WHERE santri.id_santri = $id";
		return $this->db->query($query)->row_array();
	}


	public function get_data_bulan_kesehatan()
	{
		$query = "SELECT * FROM pembayaran WHERE id_jenis_transaksi = '4' ORDER BY bulan_bayar DESC";
		return $this->db->query($query)->result_array();
	}

	public function get_saldo_akhir_kesehatan()
	{
		$query = "SELECT kesehatan FROM saldo ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_data_kesehatan_satu_bulan($bulan)
	{
		$query = "SELECT santri.nama,angkatan.tahun_masuk,pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar FROM pembayaran 
				JOIN santri
				ON pembayaran.id_santri = santri.id_santri 
				JOIN angkatan
				ON santri.id_angkatan = angkatan.id_angkatan
				WHERE pembayaran.id_jenis_transaksi = '4' and pembayaran.bulan_bayar like '$bulan%'";
		return $this->db->query($query)->result_array();
	}

	public function get_data_belum_bayar_kesehatan_bulanan($bln)
	{
		$bulan = $bln.'-01';

		$query = "SELECT a.nama, b.tahun_masuk FROM santri a INNER JOIN angkatan b ON a.id_angkatan=b.id_angkatan 
					WHERE (a.id_kategori_santri='1' or a.id_kategori_santri='4') and a.tgl_masuk<= '$bulan' and a.id_santri 
					NOT IN (SELECT id_santri FROM pembayaran WHERE id_jenis_transaksi = '4' and bulan_bayar like '$bln%')";
		return $this->db->query($query)->result_array();
	}

	public function get_data_infaq()
	{
		$query = "SELECT santri.nama,angkatan.tahun_masuk,pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar FROM pembayaran 
				JOIN santri
				ON pembayaran.id_santri = santri.id_santri 
				JOIN angkatan
				ON santri.id_angkatan = angkatan.id_angkatan
				WHERE pembayaran.id_jenis_transaksi = '6' ORDER BY pembayaran.tgl_bayar DESC";
		return $this->db->query($query)->result_array();
	}

	public function get_data_pemasukan_infaq_bulan_ini($bulan)
	{
		$query = "SELECT jumlah FROM pembayaran WHERE tgl_bayar like '$bulan%' and id_jenis_transaksi = '6'";
		return $this->db->query($query)->result_array();
	}

	public function get_saldo_akhir_infaq()
	{
		$query = "SELECT infaq FROM saldo ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_data_pembayaran_byId($id)
	{
		$kd = "'".$id."'";
		$query = "SELECT * FROM pembayaran WHERE id_pembayaran = $kd";
		return $this->db->query($query)->row_array();
	}

	public function getDataPembayaranSantri($id_santri)
	{
		$id = "'".$id_santri."'";
		$query = "SELECT * FROM pembayaran WHERE id_santri = $id";
		return $this->db->query($query)->num_rows();
	}


	public function get_data_bulan_kas()
	{
		$query = "SELECT * FROM pembayaran WHERE id_jenis_transaksi = '2' ORDER BY bulan_bayar DESC";
		return $this->db->query($query)->result_array();
	}

	public function get_saldo_akhir_kas()
	{
		$query = "SELECT kas FROM saldo ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_data_kas_satu_bulan($bulan)
	{
		$query = "SELECT santri.nama,angkatan.tahun_masuk,pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar FROM pembayaran 
				JOIN santri
				ON pembayaran.id_santri = santri.id_santri 
				JOIN angkatan
				ON santri.id_angkatan = angkatan.id_angkatan
				WHERE pembayaran.id_jenis_transaksi = '2' and pembayaran.bulan_bayar like '$bulan%'";
		return $this->db->query($query)->result_array();
	}

	public function get_data_belum_bayar_kas_bulanan($bln)
	{
		$bulan = $bln.'-01';

		$query = "SELECT a.nama, b.tahun_masuk FROM santri a INNER JOIN angkatan b ON a.id_angkatan=b.id_angkatan 
					WHERE (a.id_kategori_santri='1' or a.id_kategori_santri='4') and a.tgl_masuk<= '$bulan' and a.id_santri 
					NOT IN (SELECT id_santri FROM pembayaran WHERE id_jenis_transaksi = '2' and bulan_bayar like '$bln%')";
		return $this->db->query($query)->result_array();
	}

	public function cekStatusPembayaran($id_santri,$bulan_bayar,$id_pembayaran)
	{
		$bulan = substr($bulan_bayar,0,7);
		$query = "SELECT * FROM pembayaran WHERE id_santri = '$id_santri' and id_jenis_transaksi = $id_pembayaran and bulan_bayar like '$bulan%'";
		return $this->db->query($query)->num_rows();
	}


	public function get_data_bulan_beras()
	{
		$query = "SELECT * FROM pembayaran WHERE id_jenis_transaksi = '3' ORDER BY bulan_bayar DESC";
		return $this->db->query($query)->result_array();
	}

	public function get_saldo_akhir_beras()
	{
		$query = "SELECT beras FROM saldo ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_data_beras_satu_bulan($bulan)
	{
		$query = "SELECT santri.nama,angkatan.tahun_masuk,pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar FROM pembayaran 
				JOIN santri
				ON pembayaran.id_santri = santri.id_santri 
				JOIN angkatan
				ON santri.id_angkatan = angkatan.id_angkatan
				WHERE pembayaran.id_jenis_transaksi = '3' and pembayaran.bulan_bayar like '$bulan%'";
		return $this->db->query($query)->result_array();
	}

	public function get_data_belum_bayar_beras_bulanan($bln)
	{
		$bulan = $bln.'-01';

		$query = "SELECT a.nama, b.tahun_masuk FROM santri a INNER JOIN angkatan b ON a.id_angkatan=b.id_angkatan 
					WHERE (a.id_kategori_santri='1' or a.id_kategori_santri='4') and a.tgl_masuk<= '$bulan' and a.id_santri 
					NOT IN (SELECT id_santri FROM pembayaran WHERE id_jenis_transaksi = '3' and bulan_bayar like '$bln%')";
		return $this->db->query($query)->result_array();
	}



	public function get_data_bulan_lauk()
	{
		$query = "SELECT * FROM pembayaran WHERE id_jenis_transaksi = '5' ORDER BY bulan_bayar DESC";
		return $this->db->query($query)->result_array();
	}

	public function get_saldo_akhir_lauk()
	{
		$query = "SELECT lauk FROM saldo ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_data_lauk_satu_bulan($bulan)
	{
		$query = "SELECT santri.nama,angkatan.tahun_masuk,pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar FROM pembayaran 
				JOIN santri
				ON pembayaran.id_santri = santri.id_santri 
				JOIN angkatan
				ON santri.id_angkatan = angkatan.id_angkatan
				WHERE pembayaran.id_jenis_transaksi = '5' and pembayaran.bulan_bayar like '$bulan%'";
		return $this->db->query($query)->result_array();
	}

	public function get_data_belum_bayar_lauk_bulanan($bln)
	{
		$bulan = $bln.'-01';

		$query = "SELECT a.nama, b.tahun_masuk FROM santri a INNER JOIN angkatan b ON a.id_angkatan=b.id_angkatan 
					WHERE (a.id_kategori_santri='1' or a.id_kategori_santri='4') and a.tgl_masuk<= '$bulan' and a.id_santri 
					NOT IN (SELECT id_santri FROM pembayaran WHERE id_jenis_transaksi = '5' and bulan_bayar like '$bln%')";
		return $this->db->query($query)->result_array();
	}



	public function get_jumlah_pengeluaran_bulan_ini($bulan,$id)
	{
		$query = "SELECT * FROM pengeluaran WHERE tgl_pengeluaran like '$bulan%' and id_kategori = $id";
		return $this->db->query($query)->result_array();
	}


	public function get_data_pengeluaran_all()
	{
		$query = "SELECT * FROM pengeluaran ORDER BY tgl_pengeluaran DESC";
		return $this->db->query($query)->result_array();
	}

	public function get_data_Pengeluaran_byId($id)
	{
		$kd = "'".$id."'";
		$query = "SELECT * FROM pengeluaran WHERE id_pengeluaran = $kd";
		return $this->db->query($query)->row_array();
	}

	public function get_data_pengeluaran($kd,$bln,$thn)
	{
		$id = $thn.'-'.$bln;
		$query = "SELECT * FROM pengeluaran WHERE id_kategori='$kd' and tgl_pengeluaran like'$id%'";
		return $this->db->query($query)->result_array();
	}

	public function get_jml_data_pengeluaran($kd,$bln,$thn)
	{
		$id = $thn.'-'.$bln;
		$query = "SELECT * FROM pengeluaran WHERE id_kategori='$kd' and tgl_pengeluaran like'$id%'";
		return $this->db->query($query)->num_rows();
	}

	public function get_data_pemasukan($kd,$bln,$thn)
	{
		$id = $thn.'-'.$bln;
		$query = "SELECT pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar,pembayaran.bulan_bayar,santri.nama FROM pembayaran JOIN santri WHERE pembayaran.id_jenis_transaksi='$kd' and santri.id_santri = pembayaran.id_santri and tgl_bayar like'$id%'";
		return $this->db->query($query)->result_array();
	}

	public function get_data_pemasukan_bantuan($kd,$bln,$thn)
	{
		$id = $thn.'-'.$bln;
		$query = "SELECT * FROM bantuan WHERE  tgl_bantuan like'$id%'";
		return $this->db->query($query)->result_array();
	}

	public function get_jml_data_pemasukan_bantuan($kd,$bln,$thn)
	{
		$id = $thn.'-'.$bln;
		$query = "SELECT* FROM bantuan WHERE tgl_bantuan like'$id%'";
		return $this->db->query($query)->num_rows();
	}

	public function get_jml_data_pemasukan($kd,$bln,$thn)
	{
		$id = $thn.'-'.$bln;
		$query = "SELECT pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar,santri.nama FROM pembayaran JOIN santri WHERE pembayaran.id_jenis_transaksi='$kd' and santri.id_santri = pembayaran.id_santri and tgl_bayar like'$id%'";
		return $this->db->query($query)->num_rows();
	}

	public function get_data_saldo_awal_bulan($kode,$bln,$thn)
	{
		if ($bln <= 10) 
		{
			$id = $thn.'-0'.($bln-1);
		}
		else
		{
			$id = $thn.'-'.($bln-1);
		}

		// echo "$id"; die();
		
		$query = "SELECT * FROM saldo WHERE tanggal like'$id%' ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_data_saldo_awal_bulan2($bln,$thn)
	{
		
			$id = "'$thn-$bln-01'";
		$query = "SELECT * FROM saldo WHERE tanggal < $id ORDER BY tanggal DESC";

		// echo $query; die();
		return $this->db->query($query)->row_array();
	}

	public function get_data_saldo_akhir_bulan($bln,$thn)
	{
		$id = $thn.'-'.$bln;
		$query = "SELECT * FROM saldo WHERE tanggal like'$id%' ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_data_saldo_akhir_bulan2($bln,$thn)
	{
		$id = "'$thn-$bln-32'";
		$query = "SELECT * FROM saldo WHERE tanggal <= $id ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
		// echo $query; die();
	}


	public function get_data_uang_bangunan()
	{
		$query = "SELECT pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar,pembayaran.bulan_bayar,santri.nama FROM pembayaran JOIN santri WHERE pembayaran.id_jenis_transaksi='7' and santri.id_santri = pembayaran.id_santri ";
		return $this->db->query($query)->result_array();
	}

	public function get_data_angkatan()
	{
		$query = "SELECT * FROM angkatan WHERE tahun_masuk !='0000' ORDER BY tahun_masuk DESC";
		return $this->db->query($query)->result_array();
	}

	public function get_saldo_uang_bangunan()
	{
		$query = "SELECT bangunan FROM saldo ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_biaya_uang_bangunan($thn)
	{
		$query = "SELECT aturan_pembayaran.bangunan FROM aturan_pembayaran JOIN angkatan ON aturan_pembayaran.id_aturan_bayar = angkatan.id_aturan_bayar WHERE tahun_masuk = '$thn'";
		return $this->db->query($query)->row_array();
	}

	public function get_pembayaran_uang_bangunan_byIdSantri($id_santri)
	{
		$query = "SELECT * FROM pembayaran WHERE id_santri = '$id_santri' and id_jenis_transaksi = '7'";
		return $this->db->query($query)->result_array();
	}

	public function get_pembayaran_uang_bangunan_byIdSantri2($id_santri)
	{
		$query = "SELECT jumlah FROM pembayaran WHERE id_santri = '$id_santri' and id_jenis_transaksi = '7'";
		return $this->db->query($query)->result_array();
	}

	public function cekMaksimalPembayaranUangBangunan($id_santri)
	{
		$query = "SELECT aturan_pembayaran.bangunan FROM aturan_pembayaran JOIN angkatan
				ON aturan_pembayaran.id_aturan_bayar = angkatan.id_aturan_bayar
				JOIN santri ON angkatan.id_angkatan = santri.id_angkatan 
				WHERE santri.id_santri = '$id_santri'";
		return $this->db->query($query)->row_array();
	}

	public function get_data_saldo_hari_ini($date)
	{
		$query = "SELECT * FROM saldo WHERE tanggal <= '$date' ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_pemasukan_1_tahun($id)
	{
		$year = date('Y');
		$query = "SELECT jumlah FROM pembayaran WHERE id_jenis_transaksi = '$id' and tgl_bayar like'$year%'";
		return $this->db->query($query)->result_array();
	}

	public function get_pemasukan_bantuan_1_tahun()
	{
		$year = date('Y');
		$query = "SELECT jumlah FROM bantuan WHERE tgl_bantuan like'$year%'";
		return $this->db->query($query)->result_array();
	}

	public function get_pengeluaran_1_tahun($id)
	{
		$year = date('Y');
		$query = "SELECT jumlah FROM pengeluaran WHERE id_kategori = '$id' and tgl_pengeluaran like'$year%'";
		return $this->db->query($query)->result_array();
	}


}