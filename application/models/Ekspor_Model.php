<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ekspor_Model extends CI_Model {

	public function get_data_pemasukan_hari($kd, $tgal)
	{
		$query = "SELECT pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar,pembayaran.bulan_bayar,santri.nama FROM pembayaran JOIN santri WHERE pembayaran.id_jenis_transaksi='$kd' and santri.id_santri = pembayaran.id_santri and tgl_bayar = '$tgal'";
		return $this->db->query($query)->result_array();
	}

	public function get_data_pengeluaran_hari($kd, $tgal)
	{
		$query = "SELECT * FROM pengeluaran WHERE id_kategori='$kd' and tgl_pengeluaran = '$tgal'";
		return $this->db->query($query)->result_array();
	}

	public function  get_jml_data_pemasukan_hari($kd,$tgal)
	{
		$query = "SELECT pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar,pembayaran.bulan_bayar,santri.nama FROM pembayaran JOIN santri WHERE pembayaran.id_jenis_transaksi='$kd' and santri.id_santri = pembayaran.id_santri and tgl_bayar = '$tgal'";
		return $this->db->query($query)->num_rows();
	}

	public function get_jml_data_pengeluaran_hari($kd, $tgal)
	{
		$query = "SELECT * FROM pengeluaran WHERE id_kategori='$kd' and tgl_pengeluaran = '$tgal'";
		return $this->db->query($query)->num_rows();
	}

	public function get_data_saldo_awal_hari($kd, $tgal)
	{
		$query = "SELECT * FROM saldo WHERE tanggal < '$tgal' ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_data_saldo_akhir_hari($kd, $tgal)
	{
		$query = "SELECT * FROM saldo WHERE tanggal <= '$tgal' ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}




// buat ekspor mingguan
	public function get_data_pemasukan_minggu($kd, $tgal ,$tgal_akhir)
	{
		$query = "SELECT pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar,pembayaran.bulan_bayar,santri.nama FROM pembayaran JOIN santri WHERE pembayaran.id_jenis_transaksi='$kd' and santri.id_santri = pembayaran.id_santri and tgl_bayar >= '$tgal' and tgl_bayar <= '$tgal_akhir' ORDER BY pembayaran.tgl_bayar ASC";
		return $this->db->query($query)->result_array();
	}

	public function get_data_pengeluaran_minggu($kd, $tgal ,$tgal_akhir)
	{
		$query = "SELECT * FROM pengeluaran WHERE id_kategori='$kd' and tgl_pengeluaran >= '$tgal' and tgl_pengeluaran <= '$tgal_akhir' ORDER BY pengeluaran.tgl_pengeluaran ASC";
		return $this->db->query($query)->result_array();
	}

	public function  get_jml_data_pemasukan_minggu($kd,$tgal ,$tgal_akhir)
	{
		$query = "SELECT pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar,pembayaran.bulan_bayar,santri.nama FROM pembayaran JOIN santri WHERE pembayaran.id_jenis_transaksi='$kd' and santri.id_santri = pembayaran.id_santri and tgl_bayar >= '$tgal' and tgl_bayar <= '$tgal_akhir'";
		return $this->db->query($query)->num_rows();
	}

	public function get_jml_data_pengeluaran_minggu($kd, $tgal ,$tgal_akhir)
	{
		$query = "SELECT * FROM pengeluaran WHERE id_kategori='$kd' and tgl_pengeluaran >= '$tgal' and tgl_pengeluaran <= '$tgal_akhir'";
		return $this->db->query($query)->num_rows();
	}

	public function get_data_saldo_awal_minggu($kd, $tgal ,$tgal_akhir)
	{
		$query = "SELECT * FROM saldo WHERE tanggal < '$tgal' ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_data_saldo_akhir_minggu($kd, $tgal ,$tgal_akhir)
	{
		$query = "SELECT * FROM saldo WHERE tanggal <= '$tgal_akhir' ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}



// buat ekspor bulanan
	public function get_data_pemasukan_bulan($kd, $bulan, $tahun)
	{
		$id = $tahun.'-'.$bulan;
		$query = "SELECT pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar,pembayaran.bulan_bayar,santri.nama FROM pembayaran JOIN santri WHERE pembayaran.id_jenis_transaksi='$kd' and santri.id_santri = pembayaran.id_santri and tgl_bayar like '$id%' ORDER BY pembayaran.tgl_bayar ASC";
		return $this->db->query($query)->result_array();
	}

	public function get_data_pengeluaran_bulan($kd, $bulan, $tahun)
	{
		$id = $tahun.'-'.$bulan;
		$query = "SELECT * FROM pengeluaran WHERE id_kategori='$kd' and tgl_pengeluaran like '$id%' ORDER BY pengeluaran.tgl_pengeluaran ASC";
		return $this->db->query($query)->result_array();
	}

	public function  get_jml_data_pemasukan_bulan($kd, $bulan, $tahun)
	{
		$id = $tahun.'-'.$bulan;
		$query = "SELECT pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar,pembayaran.bulan_bayar,santri.nama FROM pembayaran JOIN santri WHERE pembayaran.id_jenis_transaksi='$kd' and santri.id_santri = pembayaran.id_santri and tgl_bayar like '$id%'";
		return $this->db->query($query)->num_rows();
	}

	public function get_jml_data_pengeluaran_bulan($kd, $bulan, $tahun)
	{
		$id = $tahun.'-'.$bulan;
		$query = "SELECT * FROM pengeluaran WHERE id_kategori='$kd' and tgl_pengeluaran like '$id%'";
		return $this->db->query($query)->num_rows();
	}

	public function get_data_saldo_awal_bulan($kd, $bulan, $tahun)
	{
		$id = $tahun.'-'.$bulan;
		$awal = $tahun.'-'.$bulan.'-01';
		$query = "SELECT * FROM saldo WHERE tanggal < '$awal' ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_data_saldo_akhir_bulan($kd, $bulan, $tahun)
	{
		$akhir = $tahun.'-'.$bulan.'-31';
		$query = "SELECT * FROM saldo WHERE tanggal <= '$akhir' ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
		
	}




// buat ekspor tahunan
	public function get_data_pemasukan_tahun($kd, $tahun)
	{
		$query = "SELECT pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar,pembayaran.bulan_bayar,santri.nama FROM pembayaran JOIN santri WHERE pembayaran.id_jenis_transaksi='$kd' and santri.id_santri = pembayaran.id_santri and tgl_bayar like '$tahun%' ORDER BY pembayaran.tgl_bayar ASC";
		return $this->db->query($query)->result_array();
	}

	public function get_data_pengeluaran_tahun($kd, $tahun)
	{
		$query = "SELECT * FROM pengeluaran WHERE id_kategori='$kd' and tgl_pengeluaran like '$tahun%' ORDER BY pengeluaran.tgl_pengeluaran ASC";
		return $this->db->query($query)->result_array();
	}

	public function  get_jml_data_pemasukan_tahun($kd, $tahun)
	{
		$query = "SELECT pembayaran.id_pembayaran,pembayaran.jumlah,pembayaran.tgl_bayar,pembayaran.bulan_bayar,santri.nama FROM pembayaran JOIN santri WHERE pembayaran.id_jenis_transaksi='$kd' and santri.id_santri = pembayaran.id_santri and tgl_bayar like '$tahun%'";
		return $this->db->query($query)->num_rows();
	}

	public function get_jml_data_pengeluaran_tahun($kd, $tahun)
	{
		$query = "SELECT * FROM pengeluaran WHERE id_kategori='$kd' and tgl_pengeluaran like '$tahun%'";
		return $this->db->query($query)->num_rows();
	}

	public function get_data_saldo_awal_tahun($kd, $tahun)
	{
		$awal = $tahun.'-01-01';
		$query = "SELECT * FROM saldo WHERE tanggal < $awal ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
	}

	public function get_data_saldo_akhir_tahun($kd, $tahun)
	{
		$akhir = $tahun.'-12-31';
		$query = "SELECT * FROM saldo WHERE tanggal like '$tahun%' ORDER BY tanggal DESC";
		return $this->db->query($query)->row_array();
		
	}



}