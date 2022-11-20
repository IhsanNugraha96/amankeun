<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentikasi extends CI_Model {

	
	public function cek_user_by_username($username)
	{
		$id = "'".$username."'";
		$query = "SELECT * FROM user WHERE username = $id";
		return $this->db->query($query)->row_array();
	}

}