<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_Model extends CI_Model {

	
	public function getInfoAkun_byId($id_pengurus)
	{
		$id = "'".$id_pengurus."'";
		$query = "SELECT * FROM user WHERE id = $id";
		return $this->db->query($query)->row_array();
	}

	public function cekInfoAkun_byUsername($username)
	{
		$id = "'".$username."'";
		$query = "SELECT * FROM user WHERE username = $id";
		return $this->db->query($query)->num_rows();
	}

	public function cekInfoAkun_byEmail($email)
	{
		$id = "'".$email."'";
		$query = "SELECT * FROM user WHERE email = $id";
		return $this->db->query($query)->num_rows();
	}

	public function getInfoAkunPengurus()
	{
		$query = "SELECT * FROM user WHERE role_id >= '2'";
		return $this->db->query($query)->result_array();
	}

	public function getInfoAkunBendahara()
	{
		$query = "SELECT * FROM user WHERE role_id = 1";
		return $this->db->query($query)->result_array();
	}

	public function get_tahun()
	{
		$query = "SELECT DISTINCT bulan_bayar FROM pembayaran ORDER BY bulan_bayar ASC";
		return $this->db->query($query)->result_array();
	}

}