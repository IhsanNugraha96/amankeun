<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
// $role = $this->session->userdata('role_id');
// echo $role; die();
		if ($this->session->userdata('id_user')) 
		{
			
			if ($this->session->userdata('role_id') == 0 || $this->session->userdata('role_id') == 1) 
			{
				redirect('Amankeun/dashboard');
			}
			else
			{
				redirect('Pengurus');
			}
		}

		$this->load->model('Authentikasi');

	}


	
	public function index()
	{
		// aturan tambahan pada kolom input untuk validasi
		$this->form_validation->set_rules('username', 'Username/Email','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Data belum di isi!']);

		// echo $this->session->userdata('role_id'); die();

		if ($this->form_validation->run() == false)
		{				
			$data['title'] = "Login Page";

			$this->load->view('Auth/header');
			$this->load->view('Auth/index');
			$this->load->view('Auth/footer');
		}
		else
		{	
			$this->_login(); 
		}
	}


	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// mencari data user pada database

		$data_user = $this->Authentikasi->cek_user_by_username($username);
			// print_r($data_user); die();
			// echo "string"; die();
		if($data_user)
		{
			// cek passwordnya
			if(base64_decode($data_user['password']) == $password)
			{
				$data = [
					'id_user' 	=> $data_user['id'],
					'role_id'	=> $data_user['role_id']
				];

				$this->session->set_userdata($data);
				$this->session->set_flashdata('message','<div class="alert alert-warning shadow"  role="alert">Selamat Datang '. $data_user['nama'].'!</div>');
				if ($data_user['role_id'] == 0 || $data_user['role_id'] == 1) {
					redirect('Amankeun/dashboard');
				}else {
					redirect('Pengurus');
				}

			}
			else
			{
				$this->session->set_flashdata('message','<div class="alert alert-danger shadow" style="margin-top:-10%;" role="alert">Password salah!</div>');
				redirect('Auth');
			}
		}
		else
		{

			$this->session->set_flashdata('message','<div class="alert alert-danger shadow" style="margin-top:-10%;" role="alert">Username belum terdaftar! </div>');
			redirect('Auth');
		}
	}

}