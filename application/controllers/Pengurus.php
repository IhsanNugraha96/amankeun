<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengurus extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('id_user')) 
		{
			redirect('Auth');
		}
		else
		{
			if ($this->session->userdata('role_id') == 0 || $this->session->userdata('role_id') == 1) 
			{
				redirect('Amankeun/dashboard');
			}
			elseif(!$this->session->userdata('role_id') == 2 || !$this->session->userdata('role_id') == 3)
			{
				redirect('Auth');
			}
		}

		$this->load->model('Akun_Model');
		$this->load->model('Santri_Model');
		$this->load->model('Keuangan_Model');

	}

	public function index()
	{
		$data['title'] = "Data Santri";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_pengurus = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_pengurus);
		// $data['santri'] = $this->Santri_Model->getDataSantriAll();

		if ($data['role_id'] == 2) 
		{
			$data['santri'] = $this->Santri_Model->getDataSantriPutraAll();
			if ($data['santri']) 
			{
				$i=0;
				foreach ($data['santri'] as $dts) 
				{
					$data['pembayaran'][$i] = $this->Keuangan_Model->getDataPembayaranSantri($dts['id_santri']);
					$i++;
				}
			}
		}
		elseif ($data['role_id'] == 3) 
		{
			$data['santri'] = $this->Santri_Model->getDataSantriPutriAll();
			if ($data['santri']) 
			{
				$i=0;
				foreach ($data['santri'] as $dts) 
				{
					$data['pembayaran'][$i] = $this->Keuangan_Model->getDataPembayaranSantri($dts['id_santri']);
					$i++;
				}
			}
		}
		
		$data['angkatan'] = $this->Santri_Model->getDataAngkatan();
// print_r($data['santri'][0]['tgl_keluar']); die();
		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Pengurus/dataSantri', $data);
		$this->load->view('Template/footer_datatable');
	}

	public function dataSantri($aksi,$id_santri)
	{
		$this->form_validation->set_rules('angkatan', 'Angkatan','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('nis', 'NIS','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('tgl_masuk', 'Masuk','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('mondok', 'Mondok','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('yatim', 'Yatim','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('nik', 'NIK','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('nama', 'Nama santri','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('tl', 'Tempat lahir','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('tlh', 'Tanggal Lahir','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('jkl', 'Jenis Kelamin','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('alamat', 'Alamat','required|trim', ['required' => 'Data belum di isi!']);

		$this->form_validation->set_rules('no_kk', 'KK','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('nama_ayah', 'Nama santri','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('nama_ibu', 'Nama santri','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('alamat_ortu', 'Alamat orang tua','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('no_telp', 'No. telp','required|trim', ['required' => 'Data belum di isi!']);
		
		
		if ($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger shadow" role="alert">Gagal menambah data baru, harap mengisi data dengan benar!</div>');
			redirect('Pengurus');
		}
		else
		{	
			$data_santri_edit = $this->Santri_Model->getDataSantriByIdSantri($id_santri);

			// jika ada foto yang di unggah
			$image = $_FILES['foto']['name'];	

			if($image)
			{

				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = '2048';
				$config['upload_path']   = './assets/img/santri/';



				$this->load->library('upload',$config);
				if ($aksi == 'tambah') 
				{
					if ($this->upload->do_upload('foto')) 
					{
						$foto = $this->upload->data('file_name');
					}
					else if ($_FILES['foto']['size'] >= '2048') 
					{
						$this->session->set_flashdata('message','<div class="alert alert-warning outline-dark shadow"  role="alert">Gagal menambah data, harap memilih gambar dengan ukuran dibawah 2MB!</div>');
						redirect('Pengurus');
					}
				}
				// jika ubah data
				else 
				{
					if ($this->upload->do_upload('foto')) 
					{
						$old_image = $data_santri_edit['foto'];

						if($old_image != 'default_image.jpg')
						{
							unlink(FCPATH . 'assets/img/santri/' . $old_image);						
						}

						$foto = $this->upload->data('file_name');
						$this->db->set('foto', $foto);

						$where = array('id_santri' => $data_santri_edit['id_santri'] );
						$this->db->where($where);
						$this->db->update('santri');

					}
					else if ($_FILES['foto']['size'] >= '2048') 
					{
						$this->session->set_flashdata('message','<div class="alert alert-warning outline-dark shadow"  role="alert">Gagal menambah data, harap memilih gambar dengan ukuran dibawah 2MB!</div>');
						redirect('Pengurus');
					}
				}
				
			}else
			{
				$foto = 'default_image.jpg';
			}


				


			$angkatan 	= $this->input->post('angkatan');
			$nis 		= htmlspecialchars($this->input->post('nis', true));
			$tgl_masuk 	= $this->input->post('tgl_masuk', true);
			$tgl_keluar = $this->input->post('tgl_keluar', true);
			$mondok 	= $this->input->post('mondok', true);
			$yatim 		= $this->input->post('yatim', true);
			$nik 		= htmlspecialchars($this->input->post('nik', true));
			$nama 		= htmlspecialchars($this->input->post('nama', true));
			$tempat_lahir = htmlspecialchars($this->input->post('tl', true));
			$tgl_lahir 	= $this->input->post('tlh', true);
			$j_kelamin 	= $this->input->post('jkl', true);
			$alamat 	= htmlspecialchars($this->input->post('alamat', true));

			$no_kk 			= htmlspecialchars($this->input->post('no_kk', true));
			$nama_ayah		= htmlspecialchars($this->input->post('nama_ayah', true));
			$nama_ibu 		= htmlspecialchars($this->input->post('nama_ibu', true));
			$alamat_ortu 	= htmlspecialchars($this->input->post('alamat_ortu', true));
			$no_telp 		= htmlspecialchars($this->input->post('no_telp', true));

			// dapatkan id kategori santri berdasarkan inputan
			$id_kategori = $this->Santri_Model->getIdKategoriSantriByInput($mondok,$yatim);

			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$kode = substr(str_shuffle($permitted_chars), 0, 4);

			$id = date("YmdGis").$kode;


			if ($tgl_keluar > date('Y-m-d') || $tgl_keluar < '0001-01-01'){
				$status = 1;
			}
			else if ($tgl_keluar < date('Y-m-d')) {
				$status = 0;
			}
			else{
				$status = 1;
			}
			// echo 8*60*60; echo " - ";
			// echo 60*60*24;
			// echo date('Ymdhis', -62170009632+2678401+86400+17280+14400+28800).' - '; 
			// echo strtotime (date("00000000000000"));
// echo $status; 
// die();
			// siapkan data utk di input ke tbl orang tua
			
			// input ke tbl orang_tua
			if ($aksi == 'tambah') 
			{
				$data_ortu = [
					'id_ortu'	=>$id,
					'ayah'		=>$nama_ayah,
					'ibu'		=>$nama_ibu,
					'no_kk'		=>$no_kk,
					'alamat_ortu'=>$alamat_ortu,
					'no_telp'	=>$no_telp
				];
				$this->db->insert('orang_tua',$data_ortu);
			}
			else 
			{
				$data_ortu = [
					'ayah'		=>$nama_ayah,
					'ibu'		=>$nama_ibu,
					'no_kk'		=>$no_kk,
					'alamat_ortu'=>$alamat_ortu,
					'no_telp'	=>$no_telp
				];

				$this->db->set($data_ortu);
				$where = array('id_ortu' => $data_santri_edit['id_ortu'] );
				$this->db->where($where);
				$this->db->update('orang_tua');		
			}

			
			// siapkan data utk di input ke tbl santri
			
			// input ke tbl santri
			if ($aksi == 'tambah') 
			{
				$data_santri = [
					'id_santri'		=>$id,
					'nik'			=>$nik,
					'nis'			=>$nis,
					'nama'			=>$nama,
					'jenis_kelamin'	=>$j_kelamin,
					'tempat_lahir'	=>$tempat_lahir,
					'tgl_lahir'		=>$tgl_lahir,
					'alamat'		=>$alamat,
					'foto'			=>$foto,
					'tgl_masuk'		=>$tgl_masuk,
					'tgl_keluar'	=>'0000-00-00',
					'status'		=>'1',
					'id_orang_tua'	=>$id,
					'id_angkatan'	=>$angkatan,
					'id_kategori_santri'=>$id_kategori['id_kategori_santri']
				];
				$this->db->insert('santri',$data_santri);
				$this->session->set_flashdata('message','<div class="alert alert-success outline-dark shadow"  role="alert">Data baru berhasil di tambahkan!</div>');
			}
			else
			{
				// if ($tgl_keluar == "0000-00-00" || $tgl_keluar >= date("Y-m-d")) {
				// 	$status = '1';
				// }
				// else { $status = '0';}

				$data_santri = [
					'nik'			=>$nik,
					'nis'			=>$nis,
					'nama'			=>$nama,
					'jenis_kelamin'	=>$j_kelamin,
					'tempat_lahir'	=>$tempat_lahir,
					'tgl_lahir'		=>$tgl_lahir,
					'alamat'		=>$alamat,
					'foto'			=>$foto,
					'tgl_masuk'		=>$tgl_masuk,
					'tgl_keluar'	=>$tgl_keluar,
					'status'		=>$status,
					'id_angkatan'	=>$angkatan,
					'id_kategori_santri'=>$id_kategori['id_kategori_santri']
				];
			// print_r($data_santri);die();
			// echo $data_santri_edit['id_santri']; die();	
				$this->db->set($data_santri);
				$where = array('id_santri' => $data_santri_edit['id_santri'] );
				$this->db->where($where);
				$this->db->update('santri');

				$this->session->set_flashdata('message','<div class="alert alert-success outline-dark shadow"  role="alert">Data santri berhasil diperbaharui!</div>');
			}
			
			redirect('Pengurus');
		}

	}

	public function hapus_data_santri($id_santri)
	{
		$data_santri_hapus = $this->Santri_Model->getDataSantriByIdSantri($id_santri);

		$data = [
			'nik' 			=> null,
			'nis'  			=> null	,
			'nama' 			=> 'Tidak diketahui'	,
			'jenis_kelamin'	=> '-',
			'tempat_lahir'  => '-'	,
			'tgl_lahir'  	=> '0000-00-00',
			'alamat'  		=> '-',
			'foto'  		=> '-',
			'status'  		=> '-',
			'id_orang_tua'  => '-',
			'id_kategori_santri' => '-'
		];

		$this->db->set($data);
		$where = array('id_santri' => $id_santri );
		$this->db->where($where);
		$this->db->update('santri');

		$this->db->delete('orang_tua', array('id_ortu' => $data_santri_hapus['id_orang_tua']));
		
		
		$this->session->set_flashdata('message','<div class="alert alert-success outline-dark shadow"  role="alert">Data santri berhasil di hapus!</div>');
		redirect('Pengurus');
	}

	public function pemasukan()
	{
		$data['title'] = "Tagihan Bulan Ini";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_pengurus = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_pengurus);
		$bulan = date('Y-m');
		$data['data'] = $this->Keuangan_Model->get_data_listrik_satu_bulan($bulan);
		$data['belum_bayar'] = $this->Keuangan_Model->get_data_belum_bayar_listrik_bulanan($bulan);

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/data_detail_perBulan', $data);
		$this->load->view('Template/footer_datatable');
	}

	public function pengeluaran()
	{
		$data['title'] = "Data Uang Keluar";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_pengurus = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_pengurus);

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Pengurus/data_pengeluaran');
		$this->load->view('Template/footer_datatable');
	}

	public function laporan()
	{
		$data['title'] = "Laporan Keuangan";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_pengurus = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_pengurus);

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Pengurus/laporan_keuangan');
		$this->load->view('Template/footer_datatable');
	}

	



}
