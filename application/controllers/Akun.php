<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('id_user'))
		{	
			redirect('Auth');
		}

		$this->load->model('Akun_Model');

	}

	public function update_data($id_user)
	{
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);

		$this->form_validation->set_rules('username', 'Username', 'trim');
		$this->form_validation->set_rules('nama', 'Nama', 'trim');
		$this->form_validation->set_rules('email', 'Email', 'trim');

		$username = htmlspecialchars($this->input->post('username', true)); 
		$email = htmlspecialchars($this->input->post('email', true));  
		$nama = htmlspecialchars($this->input->post('nama', true));

		$cek_email = $this->Akun_Model->cekInfoAkun_byEmail($email);
		$cek_username = $this->Akun_Model->cekInfoAkun_byUsername($username); 

	// jika form tidak di isi
		if ($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message','<div class="alert alert-warning outline-dark shadow"  role="alert">Akun gagal di perbaharui, harap mengisi data dengan benar!</div>');
			redirect('Akun/akun_saya');
		}

	// jika form di isi dengan benar
		else
		{	 
		// jika ada foto yang di unggah
			$image = $_FILES['foto_pengurus']['name'];	

			if($image)
			{

				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = '2048';
				$config['upload_path']   = './assets/img/pengurus/';

 

				$this->load->library('upload',$config);
				if ($this->upload->do_upload('foto_pengurus')) 
				{
					$old_image = $data['user']['image'];

					if($old_image != 'default_image.jpg')
					{
						unlink(FCPATH . 'assets/img/pegurus/' . $old_image);						
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);

				}

				else if ($_FILES['foto_pengurus']['size'] >= '2048') 
				{
					$this->session->set_flashdata('message','<div class="alert alert-warning outline-dark shadow"  role="alert">Akun gagal di perbaharui, harap memilih gambar dengan ukuran dibawah 2MB!</div>');
					redirect('Akun/akun_saya');
				}

				$where = array('id' => $id_user );
				$this->db->where($where);
				$this->db->update('user');

				$this->session->set_flashdata('message','<div class="alert alert-light outline-dark shadow"  role="alert">Image berhasil diperbaharui!</div>');					
			}

			// jika tidak ada image yang di upload
			else
			{
				if ($cek_username == '0') 
				{
					if ($cek_email == '0') 
					{

						$data = [
							'username' 	=> $username,
							'email' 	=> $email,
							'nama'		=> $nama
						];

						$this->db->set($data);
						$this->db->where('id', $id_pengurus);
						$this->db->update('user');

						$this->session->set_flashdata('message','<div class="alert alert-light outline-dark shadow"  role="alert">Akun anda berhasil diperbaharui!</div>');	
					}
					elseif ($email == $data['user']['email']) 
					{
						$data = [
							'username' 	=> $username,
							'email' 	=> $email,
							'nama'		=> $nama
						];

						$this->db->set($data);
						$this->db->where('id', $id_user);
						$this->db->update('user');

						$this->session->set_flashdata('message','<div class="alert alert-light outline-dark shadow"  role="alert">Username berhasil diperbaharui!</div>');	
					}
					else
					{
						$this->session->set_flashdata('message','<div class="alert alert-warning outline-dark shadow"  role="alert">Username sudah digunakan!</div>');
					}

				}
				elseif ($username == $data['user']['username']) 
				{
					if ($cek_email == '0') 
					{
						$data = [
							'username' 	=> $username,
							'email' 	=> $email,
							'nama'		=> $nama
						];

						$this->db->set($data);
						$this->db->where('id', $id_user);
						$this->db->update('user');

						$this->session->set_flashdata('message','<div class="alert alert-light outline-dark shadow"  role="alert">Alamat email sudah diperbaharui!</div>');	
					}
					elseif ($email == $data['user']['email'] && $nama != $data['user']['nama']) 
					{
						$data = [
							'username' 	=> $username,
							'email' 	=> $email,
							'nama'		=> $nama
						];

						$this->db->set($data);
						$this->db->where('id', $id_user);
						$this->db->update('user');

						$this->session->set_flashdata('message','<div class="alert alert-light outline-dark shadow"  role="alert">Nama lengkap sudah diperbaharui!</div>');
					}
					elseif ($email == $data['user']['email'] && $nama == $data['user']['nama']) 
					{
						$this->session->set_flashdata('message','<div class="alert alert-info outline-dark shadow"  role="alert">Tidak ada yang di perbaharui!</div>');
					}
					else
					{
						$this->session->set_flashdata('message','<div class="alert alert-warning outline-dark shadow"  role="alert">Alamat email sudah digunakan!</div>');
					}

				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-warning outline-dark shadow"  role="alert">Username sudah digunakan!</div>');				
				}	
			}

			redirect('Akun/akun_saya');
		}
	}


	public function hapus_foto_user($id_user)
	{
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$old_image = $data['user']['image'];
		if ($old_image != 'default_image.jpg') 
		{
			unlink(FCPATH . 'assets/img/pengurus/' . $old_image);
		}


		$this->db->set('image', 'default_image.jpg');
		$where = array('id' => $data['user']['id'] );
		$this->db->where($where);
		$this->db->update('user');

		$this->session->set_flashdata('message','<div class="alert alert-light outline-dark shadow"  role="alert">Foto profil berhasil di hapus!</div>');
		redirect('Akun/akun_saya');
	}



	public function ubah_password($id_user)
	{ 
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);

		$this->form_validation->set_rules('passwordlama', 'Password lama', 'trim');
		$this->form_validation->set_rules('passwordbaru', 'Password baru', 'trim');
		$this->form_validation->set_rules('passwordbaru2', 'Verifikasi Password', 'trim');


		$passwordlama = htmlspecialchars($this->input->post('passwordlama', true));  
		$passwordbaru = htmlspecialchars($this->input->post('passwordbaru', true));
		$passwordbaru2 = htmlspecialchars($this->input->post('passwordbaru2', true));

		if ($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message','<div class="alert alert-warning outline-dark shadow"  role="alert">Password gagal di perbaharui, harap mengisi data dengan benar!</div>');
			redirect('Akun/akun_saya');

		}
		else
		{	
			if ($passwordlama != base64_decode($data['user']['password'])) 
			{
				$this->session->set_flashdata('message','<div class="alert alert-warning outline-dark shadow"  role="alert">Password lama tidak sesuai!</div>');
				redirect('Akun/akun_saya');
			}
			elseif ($passwordbaru != $passwordbaru2) 
			{

				$this->session->set_flashdata('message','<div class="alert alert-warning outline-dark shadow"  role="alert">Password baru tidak sama, harap input password baru dengan benar!</div>');
				redirect('Akun/akun_saya');
			}
			else
			{
				$password_baru3 = base64_encode($passwordbaru);

				$this->db->set('password',$password_baru3);
				$this->db->where('id', $id_user);
				$this->db->update('user');

				$this->session->set_flashdata('message','<div class="alert alert-light outline-dark shadow"  role="alert">Password berhasil diperbaharui!</div>');
				redirect('Akun/akun_saya');
			}			
		}
	}

	public function update_data_pengurus($id_user)
	{
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);

		$this->form_validation->set_rules('username', 'Username', 'trim');
		$this->form_validation->set_rules('password', 'Password', 'trim');

		$username = htmlspecialchars($this->input->post('username', true)); 
		$password = htmlspecialchars($this->input->post('password', true));

		$cek_username = $this->Akun_Model->cekInfoAkun_byUsername($username); 
// echo base64_decode( $data['user']['password']).' - '.base64_decode( $password); die();
	// jika form tidak di isi
		if ($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message','<div class="alert alert-warning outline-dark shadow"  role="alert">Akun gagal di perbaharui, harap mengisi data dengan benar!</div>');
			redirect('Admin/akun_pengurus');
		}

	// jika form di isi dengan benar
		else
		{	 
			if ($cek_username == '0') 
			{
				if ($password == $data['user']['password'] )
				{
					$data = ['username' 	=> $username]; 

					$this->session->set_flashdata('message','<div class="alert alert-light outline-dark shadow"  role="alert">Username berhasil diperbaharui!</div>');	
				}
				elseif ($password != $data['user']['password']) 
				{
					$data = [
						'username' 	=> $username,
						'password' 	=> $password
					];
					$this->session->set_flashdata('message','<div class="alert alert-light outline-dark shadow"  role="alert">Username dan password berhasil diperbaharui!</div>');
				}
			}

			elseif ($cek_username > '0') 
			{
				if ($password != $data['user']['password']) 
				{
					$data = ['password' 	=> $password];

					$this->session->set_flashdata('message','<div class="alert alert-light outline-dark shadow"  role="alert">Password berhasil diperbaharui!</div>');
				}
				elseif ($password == $data['user']['password']) 
				{
					$data = [
						'username' 	=> $username,
						'password' 	=> $password
					];
					$this->session->set_flashdata('message','<div class="alert alert-light outline-dark shadow"  role="alert">tidak ada data yang diperbaharui!</div>');
				}
			}

			$this->db->set($data);
			$this->db->where('id', $id_user);
			$this->db->update('user');
		}
		redirect('Administrator/akun_pengurus');
	}


	public function tambah_akun()
	{
		$this->form_validation->set_rules('role', 'Role', 'trim');
		$this->form_validation->set_rules('username', 'Username', 'trim');
		$this->form_validation->set_rules('password', 'Password', 'trim');

		$role 	  = htmlspecialchars($this->input->post('role', true)); 
		$username = htmlspecialchars($this->input->post('username', true)); 
		$password = htmlspecialchars($this->input->post('password', true));

		$cek_username = $this->Akun_Model->cekInfoAkun_byUsername($username);

		if ($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message','<div class="alert alert-warning outline-dark shadow"  role="alert">Akun gagal di perbaharui, harap mengisi data dengan benar!</div>');
			redirect('Admin/akun_pengurus');
		}
		else
		{	 
			if ($cek_username == '0') 
			{
				$data = [
					'id'		=>'',
					'username' 	=> $username,
					'email'		=> 'email',
					'password' 	=> $password,
					'nama'		=> $username,
					'image'		=> 'default_image.jpg',
					'role_id' 	=> $role
				];

				$this->db->insert('user',$data);

				$this->session->set_flashdata('message','<div class="alert alert-light outline-dark shadow"  role="alert">Berhasil menambah akun baru!</div>');
			}

			elseif ($cek_username > '0') 
			{
				$this->session->set_flashdata('message','<div class="alert alert-light outline-dark shadow"  role="alert">Username sudah digunakan!</div>');
			}

			
		}
		redirect('Administrator/akun_pengurus');

	}


	public function hapus_akun($id_akun)
	{
		$id = urldecode($id_akun);
		// hapus data di tbl user
		$this->db->delete('user', array('id' => $id));

		$this->session->set_flashdata('message','<div class="alert alert-light outline-dark shadow"  role="alert">Akun berhasil dihapus!</div>');
		redirect('Administrator/akun_pengurus');
	}


	public function akun_saya()
	{
		$data['title'] = "Akun Saya";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_pengurus = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_pengurus);

		// print_r($data['user']); die();
		$this->load->view('Template/header');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Pengurus/akun_saya');
		$this->load->view('Template/footer');
	}


}