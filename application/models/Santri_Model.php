<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Santri_Model extends CI_Model {

	public function getJmlSantriAll()
	{
		$query = "SELECT * FROM santri WHERE status = 1";
		return $this->db->query($query)->num_rows();
	}

	public function getJmlSantriPutraAktif()
	{
		$query = "SELECT * FROM santri WHERE jenis_kelamin = 'P' and status = 1";
		return $this->db->query($query)->num_rows();
	}

	public function getJmlSantriPutriAktif()
	{
		$query = "SELECT * FROM santri WHERE jenis_kelamin = 'L' and status = 1";
		return $this->db->query($query)->num_rows();
	}

	public function getDataSantriAll()
	{
		$query = "SELECT * FROM santri 
				JOIN angkatan 
				ON santri.id_angkatan = angkatan.id_angkatan
				JOIN orang_tua
				ON santri.id_orang_tua = orang_tua.id_ortu
				JOIN kategori_santri
				ON santri.id_kategori_santri = kategori_santri.id_kategori_santri
				WHERE santri.id_santri != '0'
				ORDER BY angkatan.tahun_masuk DESC";
		return $this->db->query($query)->result_array();
	}

	public function getDataSantriPutriAll()
	{
		$query = "SELECT * FROM santri 
				JOIN angkatan 
				ON santri.id_angkatan = angkatan.id_angkatan
				JOIN orang_tua
				ON santri.id_orang_tua = orang_tua.id_ortu
				JOIN kategori_santri
				ON santri.id_kategori_santri = kategori_santri.id_kategori_santri
				WHERE santri.jenis_kelamin = 'P'
				ORDER BY angkatan.tahun_masuk DESC";
		return $this->db->query($query)->result_array();
	}

	public function getDataSantriPutraAll()
	{
		$query = "SELECT * FROM santri 
				JOIN angkatan 
				ON santri.id_angkatan = angkatan.id_angkatan
				JOIN orang_tua
				ON santri.id_orang_tua = orang_tua.id_ortu
				JOIN kategori_santri
				ON santri.id_kategori_santri = kategori_santri.id_kategori_santri
				WHERE santri.jenis_kelamin = 'L'
				ORDER BY angkatan.tahun_masuk DESC";
		return $this->db->query($query)->result_array();
	}

	public function getDataSantriAllAktif()
	{
		$query = "SELECT * FROM santri 
				JOIN angkatan 
				ON santri.id_angkatan = angkatan.id_angkatan
				JOIN kategori_santri
				ON santri.id_kategori_santri = kategori_santri.id_kategori_santri
				WHERE santri.status = 1 ORDER BY angkatan.tahun_masuk ASC";
		return $this->db->query($query)->result_array();
	}

	public function getDataSantriAllAktifNonYatim()
	{
		$query = "SELECT * FROM santri 
				JOIN angkatan 
				ON santri.id_angkatan = angkatan.id_angkatan
				JOIN kategori_santri
				ON santri.id_kategori_santri = kategori_santri.id_kategori_santri
				WHERE santri.status = 1 and kategori_santri.yatim = 0 ORDER BY angkatan.tahun_masuk ASC";
		return $this->db->query($query)->result_array();
	}

	public function getDataSantriAllAktifNonYatimNonMondok()
	{
		$query = "SELECT * FROM santri 
				JOIN angkatan 
				ON santri.id_angkatan = angkatan.id_angkatan
				JOIN kategori_santri
				ON santri.id_kategori_santri = kategori_santri.id_kategori_santri
				WHERE santri.status = 1 and kategori_santri.yatim = 0 and kategori_santri.mondok = 1 ORDER BY angkatan.tahun_masuk ASC";
		return $this->db->query($query)->result_array();
	}

	public function getDataSantriByIdSantri($id_santri_terpilih)
	{
		$id = "'".$id_santri_terpilih."'";
		$query = "SELECT * FROM santri 
				JOIN angkatan 
				ON santri.id_angkatan = angkatan.id_angkatan
				JOIN orang_tua
				ON santri.id_orang_tua = orang_tua.id_ortu
				JOIN kategori_santri
				ON santri.id_kategori_santri = kategori_santri.id_kategori_santri
				WHERE santri.id_santri = $id";
		return $this->db->query($query)->row_array();
	}

	public function getDataAngkatan()
	{
		$query = "SELECT * FROM angkatan ORDER BY tahun_masuk DESC";
		return $this->db->query($query)->result_array();
	}

	public function getIdKategoriSantriByInput($mondok,$yatim)
	{
		$query = "SELECT id_kategori_santri FROM kategori_santri WHERE mondok = $mondok and yatim = $yatim";
		return $this->db->query($query)->row_array();
	}


	public function getJmlSantriAngkatan($id)
	{
		$query = "SELECT santri.nama,angkatan.tahun_masuk FROM santri JOIN angkatan ON santri.id_angkatan = angkatan.id_angkatan JOIN kategori_santri ON santri.id_kategori_santri = kategori_santri.id_kategori_santri WHERE santri.id_angkatan = '$id' ORDER BY angkatan.tahun_masuk DESC";
		return $this->db->query($query)->num_rows();
	}

	public function get_data_santri_angkatan($thn)
	{
		$query = "SELECT santri.nama,angkatan.tahun_masuk,kategori_santri.yatim,santri.id_santri FROM santri JOIN angkatan ON santri.id_angkatan = angkatan.id_angkatan JOIN kategori_santri ON santri.id_kategori_santri = kategori_santri.id_kategori_santri WHERE angkatan.tahun_masuk = '$thn'";
		return $this->db->query($query)->result_array();
	}


}