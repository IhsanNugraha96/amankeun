<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	
	public function index()
	{
		// membersihkan session ('data email dan role_id')
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('role_id');	

		$this->session->set_flashdata('message','<div class="alert alert-success" style="margin-top:-10%;" role="alert">Anda berhasil keluar! </div>');

		// echo $this->session->userdata('role_id');
		redirect('Auth');
	}

}