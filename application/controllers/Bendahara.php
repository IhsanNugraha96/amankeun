<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bendahara extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('id_user')) 
		{
			redirect('Auth');
		}
		else
		{
			if ($this->session->userdata('role_id') == 0)
			{
				redirect('Amankeun/dashboard');
			}
			elseif($this->session->userdata('role_id') == 2 ||$this->session->userdata('role_id') == 3)
			{
				redirect('Pengurus/datasantri');
			}
		}


		$this->load->model('Akun_Model');
		$this->load->model('Keuangan_Model');
		$this->load->model('Santri_Model');

	}


	public function index()
	{

	}


	public function uang_kas()
	{
		$data['title'] = "Data Uang Kas";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['santri'] = $this->Santri_Model->getDataSantriAllAktifNonYatim();
		$data['data_bulan_kas'] = $this->Keuangan_Model->get_data_bulan_kas();
		$data['saldo'] = $this->Keuangan_Model->get_saldo_akhir_kas();

		$i=0;
			if ($data['data_bulan_kas']) 
			{
				foreach ($data['data_bulan_kas'] as $dt) 
				{
					$data['tahun'][$i] = substr($dt['bulan_bayar'], 0, 7);
					$data['bulan'][$i] = substr($dt['bulan_bayar'], 5, 2);
					$i++;
				}
			}	
			else
			{
				$data['tahun'] = array('0' => date('Y'), );
			}		

		arsort($data['tahun']);
		$data['tahun_pakai'] = array_unique($data['tahun']);
// print_r($data['bulan']); die();

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Bendahara/kas', $data);
		$this->load->view('Template/footer_datatable');
	}


	public function uang_beras()
	{
		$data['title'] = "Data Uang Beras";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['santri'] = $this->Santri_Model->getDataSantriAllAktifNonYatim();
		$data['data_bulan_beras'] = $this->Keuangan_Model->get_data_bulan_beras();
		$data['saldo'] = $this->Keuangan_Model->get_saldo_akhir_beras();

		$i=0;
			if ($data['data_bulan_beras']) 
			{
				foreach ($data['data_bulan_beras'] as $dt) 
				{
					$data['tahun'][$i] = substr($dt['bulan_bayar'], 0, 7);
					$data['bulan'][$i] = substr($dt['bulan_bayar'], 5, 2);
					$i++;
				}
			}	
			else
			{
				$data['tahun'] = array('0' => date('Y'), );
			}		

		arsort($data['tahun']);
		$data['tahun_pakai'] = array_unique($data['tahun']);
// print_r($data['bulan']); die();

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Bendahara/beras', $data);
		$this->load->view('Template/footer_datatable');
	}

	public function uang_lauk()
	{
		$data['title'] = "Data Uang Lauk";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['santri'] = $this->Santri_Model->getDataSantriAllAktifNonYatim();
		$data['data_bulan_lauk'] = $this->Keuangan_Model->get_data_bulan_lauk();
		$data['saldo'] = $this->Keuangan_Model->get_saldo_akhir_lauk();

		$i=0;
			if ($data['data_bulan_lauk']) 
			{
				foreach ($data['data_bulan_lauk'] as $dt) 
				{
					$data['tahun'][$i] = substr($dt['bulan_bayar'], 0, 7);
					$data['bulan'][$i] = substr($dt['bulan_bayar'], 5, 2);
					$i++;
				}
			}	
			else
			{
				$data['tahun'] = array('0' => date('Y'), );
			}		

		arsort($data['tahun']);
		$data['tahun_pakai'] = array_unique($data['tahun']);
// print_r($data['bulan']); die();

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Bendahara/lauk', $data);
		$this->load->view('Template/footer_datatable');
	}

	public function uang_bangunan()
	{
		$data['title'] = "Data Uang Bangunan";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['santri'] = $this->Santri_Model->getDataSantriAllAktifNonYatim();
		$data['data_angkatan'] = $this->Keuangan_Model->get_data_angkatan();
		$data['saldo'] = $this->Keuangan_Model->get_saldo_uang_bangunan();

		if ($data['data_angkatan']) 
		{
			$i=0;
			foreach ($data['data_angkatan'] as $dt) 
			{
				$data['jml_santri'][$i] = $this->Santri_Model->getJmlSantriAngkatan($dt['id_angkatan']);

				$i++;
			}
		}
		else
		{
			$data['jml_santri'][0] = 0;
		}
// print_r($data['jml_santri']); die();

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Bendahara/bangunan', $data);
		$this->load->view('Template/footer_datatable');
	}

	public function get_berapa_bayar_kas()
	{
		// $id_santri_terpilih = 1;
		$id_santri_terpilih = $_POST['id_santri'];
		// $data_santri = $this->Santri_Model->getDataSantriByIdSantri($id_santri_terpilih);
		$data_santri = $this->Keuangan_Model->get_data_biaya_iuran_santri($id_santri_terpilih);

		if ($data_santri['yatim'] == 0) 
		{
			if ($data_santri['mondok'] == 0) 
			{
				$jumlah_bayar = 0;
			}
			else
			{
				$jumlah_bayar = $data_santri['kas'];
			}
		}
		elseif ($data_santri['yatim'] == 1)
		{
			$jumlah_bayar = 0;
		}
		echo $jumlah_bayar;
	}

	public function get_berapa_bayar_beras()
	{
		// $id_santri_terpilih = 1;
		$id_santri_terpilih = $_POST['id_santri'];
		// $data_santri = $this->Santri_Model->getDataSantriByIdSantri($id_santri_terpilih);
		$data_santri = $this->Keuangan_Model->get_data_biaya_iuran_santri($id_santri_terpilih);

		if ($data_santri['yatim'] == 0) 
		{
			if ($data_santri['mondok'] == 0) 
			{
				$jumlah_bayar = 0;
			}
			else
			{
				$jumlah_bayar = $data_santri['beras'];
			}
		}
		elseif ($data_santri['yatim'] == 1)
		{
			$jumlah_bayar = 0;
		}
		echo $jumlah_bayar;
	}


	public function get_berapa_bayar_lauk()
	{
		// $id_santri_terpilih = 1;
		$id_santri_terpilih = $_POST['id_santri'];
		// $data_santri = $this->Santri_Model->getDataSantriByIdSantri($id_santri_terpilih);
		$data_santri = $this->Keuangan_Model->get_data_biaya_iuran_santri($id_santri_terpilih);

		if ($data_santri['yatim'] == 0) 
		{
			if ($data_santri['mondok'] == 0) 
			{
				$jumlah_bayar = 0;
			}
			else
			{
				$jumlah_bayar = $data_santri['lauk'];
			}
		}
		elseif ($data_santri['yatim'] == 1)
		{
			$jumlah_bayar = 0;
		}
		echo $jumlah_bayar;
	}

	public function tambah_dataPembayaran($kategori)
	{
		$this->form_validation->set_rules('date', 'Tanggal','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('date2', 'Tanggal','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('santri', 'Id Santri','required|trim', ['required' => 'Data belum di isi!']);

		if ($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert">Harap mengisi data dengan benar!</div>');
			if ($kategori == 'listrik') {redirect('Administrator/listrik');}
			elseif ($kategori == 'kas') {redirect('Bendahara/uang_kas');}
			
		}
		else
		{	
			$tgl_transaksi 	= $this->input->post('date');
			$bulan_bayar	= $this->input->post('date2');
			$jumlah 		= $this->input->post('jumlah');
			$id_santri 		= $this->input->post('santri');
			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$kode = substr(str_shuffle($permitted_chars), 0, 6);
			$id = date("Ymdhis").$kode;

			$santri = $this->Santri_Model->getDataSantriByIdSantri($id_santri);
			$santri_masuk = "'".substr($santri['tgl_masuk'], 0,7)."'";
			$santri_bayar = "'".substr($bulan_bayar, 0,7)."'";


			if ($kategori == 'kas') 
			{

				if ($santri_masuk <= $santri_bayar) 
				{
					$cek_status_pembayaran = $this->Keuangan_Model->cekStatusPembayaran($id_santri,$bulan_bayar,'2');

					if ($cek_status_pembayaran == '0') 
					{
						// print_r($cek_status_pembayaran); die();
						// siapkan data utk di input ke tbl pembayaran
						$data_pembayaran_kas = [
							'id_pembayaran'		=>$id,
							'id_santri'			=>$id_santri,
							'id_jenis_transaksi'=>'2',
							'jumlah'			=>$jumlah,
							'bulan_bayar'		=>$bulan_bayar,
							'tgl_bayar'			=>$tgl_transaksi
						];
						// input ke tbl pembayaran
						$this->db->insert('pembayaran',$data_pembayaran_kas);
					}
					else
					{
						$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert"><b>'.  $santri['nama'] . '</b> sudah membayar uang kas pada bulan yang di pilih!</div>');
						redirect('Bendahara/uang_kas');
					}
					
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert"><b>'  .  $santri['nama'] . '</b> tidak mempunyai kewajiban untuk membayar uang kas bulan yang di pilih!</div>');
					redirect('Bendahara/uang_kas');
				}
				
			}
			else if ($kategori == 'beras') 
			{
				if ($santri_masuk <= $santri_bayar) 
				{
					$cek_status_pembayaran = $this->Keuangan_Model->cekStatusPembayaran($id_santri,$bulan_bayar,'3');

					if ($cek_status_pembayaran == '0') 
					{
						// siapkan data utk di input ke tbl pembayaran
						$data_pembayaran_beras = [
							'id_pembayaran'		=>$id,
							'id_santri'			=>$id_santri,
							'id_jenis_transaksi'=>'3',
							'jumlah'			=>$jumlah,
							'bulan_bayar'		=>$bulan_bayar,
							'tgl_bayar'			=>$tgl_transaksi
						];
						// input ke tbl pembayaran
						$this->db->insert('pembayaran',$data_pembayaran_beras);
					}
					else
					{
						$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert"><b>'.  $santri['nama'] . '</b> sudah membayar uang beras pada bulan yang di pilih!</div>');
						redirect('Bendahara/uang_beras');
					}
					
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert"><b>'  .  $santri['nama'] . '</b> tidak mempunyai kewajiban untuk membayar uang beras bulan yang di pilih!</div>');
					redirect('Bendahara/uang_beras');
				}
			}
			else if ($kategori == 'lauk') 
			{ 
				if ($santri_masuk <= $santri_bayar) 
				{
					$cek_status_pembayaran = $this->Keuangan_Model->cekStatusPembayaran($id_santri,$bulan_bayar,'5');

					if ($cek_status_pembayaran == '0') 
					{
						// siapkan data utk di input ke tbl pembayaran
						$data_pembayaran_lauk = [
							'id_pembayaran'		=>$id,
							'id_santri'			=>$id_santri,
							'id_jenis_transaksi'=>'5',
							'jumlah'			=>$jumlah,
							'bulan_bayar'		=>$bulan_bayar,
							'tgl_bayar'			=>$tgl_transaksi
						];
						// input ke tbl pembayaran
						$this->db->insert('pembayaran',$data_pembayaran_lauk);
					}
					else
					{
						$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert"><b>'.  $santri['nama'] . '</b> sudah membayar uang lauk pada bulan yang di pilih!</div>');
						redirect('Bendahara/uang_lauk');
					}
					
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert"><b>'  .  $santri['nama'] . '</b> tidak mempunyai kewajiban untuk membayar uang lauk bulan yang di pilih!</div>');
					redirect('Bendahara/uang_lauk');
				}
			}

		
			$cek_saldo = $this->Keuangan_Model->cek_saldo_hari_ini($tgl_transaksi);
			$get_saldo_sebelumnya = $this->Keuangan_Model->get_saldo_sebelumnya($tgl_transaksi);
			$get_data_saldo_setelahnya = $this->Keuangan_Model->get_data_saldo_setelahnya($tgl_transaksi);

			if (!$cek_saldo) 
			{
				// siapkan data utk di input ke tbl saldo
				if ($kategori == 'kas') 
				{
					$data_saldo = [
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik'],
						'kas'		=>$get_saldo_sebelumnya['kas']+$jumlah,
						'beras'		=>$get_saldo_sebelumnya['beras'],
						'lauk'		=>$get_saldo_sebelumnya['lauk'],
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan'],
						'bangunan'	=>$get_saldo_sebelumnya['bangunan'],
						'bantuan'	=>$get_saldo_sebelumnya['bantuan'],
						'infaq'		=>$get_saldo_sebelumnya['infaq']
					];
				}
				else if ($kategori == 'beras') 
				{
					$data_saldo = [
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik'],
						'kas'		=>$get_saldo_sebelumnya['kas'],
						'beras'		=>$get_saldo_sebelumnya['beras']+$jumlah,
						'lauk'		=>$get_saldo_sebelumnya['lauk'],
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan'],
						'bangunan'	=>$get_saldo_sebelumnya['bangunan'],
						'bantuan'	=>$get_saldo_sebelumnya['bantuan'],
						'infaq'		=>$get_saldo_sebelumnya['infaq']
					];
				}
				else if ($kategori == 'lauk') 
				{
					$data_saldo = [
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik'],
						'kas'		=>$get_saldo_sebelumnya['kas'],
						'beras'		=>$get_saldo_sebelumnya['beras'],
						'lauk'		=>$get_saldo_sebelumnya['lauk']+$jumlah,
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan'],
						'bangunan'	=>$get_saldo_sebelumnya['bangunan'],
						'bantuan'	=>$get_saldo_sebelumnya['bantuan'],
						'infaq'		=>$get_saldo_sebelumnya['infaq']
					];
				}
				

				// input ke tbl saldo
				$this->db->insert('saldo',$data_saldo);
			}
			else
			{
				if ($kategori == 'kas') {
					$update_saldo = [
						'kas'	=> $cek_saldo['kas']+$jumlah
					]; }
				else if ($kategori == 'beras') {
					$update_saldo = [
						'beras'	=> $cek_saldo['beras']+$jumlah
					]; }
				else if ($kategori == 'lauk') {
					$update_saldo = [
						'lauk'	=> $cek_saldo['lauk']+$jumlah
					]; }

				// update data ke tbl saldo
				$this->db->set($update_saldo);
				$where = array('tanggal' => $tgl_transaksi);
				$this->db->where($where);
				$this->db->update('saldo');
			}


			// jika ada data saldo pada tgl setelah ditambah, update untuk seterusnya
			if ($get_data_saldo_setelahnya) 
			{
				$i=0;
				foreach ($get_data_saldo_setelahnya as $upd) 
				{
					if ($kategori == 'kas') {
						$update = array('kas' => $upd['kas']+$jumlah);}
					else if ($kategori == 'beras') {
						$update = array('beras' => $upd['beras']+$jumlah);}
					else if ($kategori == 'lauk') {
						$update = array('lauk' => $upd['lauk']+$jumlah);}
					$this->db->set($update);
					$where = array('tanggal' => $upd['tanggal']);
					$this->db->where($where);
					$this->db->update('saldo');

					$i++;
				}
			}



			if ($kategori == 'kas') {
				$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Saldo kas berhasil di input!</div>');
				redirect('Bendahara/uang_kas');}

			else if ($kategori == 'beras') {
				$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Saldo beras berhasil di input!</div>');
				redirect('Bendahara/uang_beras');}

			else if ($kategori == 'lauk') {
				$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Saldo lauk berhasil di input!</div>');
				redirect('Bendahara/uang_lauk');}
		}
	}

	public function tambah_dataPembayaran_bangunan()
	{

		$role_id = $this->session->userdata('role_id');


		$this->form_validation->set_rules('date', 'Tanggal','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('santri', 'Id Santri','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('biaya', 'Biaya','required|trim', ['required' => 'Data belum di isi!']);

		if ($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert">Harap mengisi data dengan benar!</div>');
			if ($role_id == '0') {redirect('Administrator/uang_bangunan');}
			elseif ($role_id == '1') {redirect('Bendahara/uang_bangunan');}
			
		}
		else
		{	
			$tgl_transaksi 	= $this->input->post('date');
			$jumlah 		= $this->input->post('biaya');
			$id_santri 		= $this->input->post('santri');
			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$kode = substr(str_shuffle($permitted_chars), 0, 6);
			$id = date("Ymdhis").$kode;

			$santri = $this->Santri_Model->getDataSantriByIdSantri($id_santri);
			$santri_masuk = "'".substr($santri['tgl_masuk'], 0,7)."'";
			$santri_bayar = "'".substr($tgl_transaksi, 0,7)."'";
			$maksimal_bayar = $this->Keuangan_Model->cekMaksimalPembayaranUangBangunan($id_santri);


			$cek_status_pembayaran = $this->Keuangan_Model->get_pembayaran_uang_bangunan_byIdSantri2($id_santri);
			
			if ($cek_status_pembayaran) 
			{
				$i=0;
				foreach ($cek_status_pembayaran as $cek) 
				{
					$jumlah_bayar[$i] = $cek['jumlah'];
					$i++;
				}
			}
			else
			{
				$jumlah_bayar[0] = 0 ;
			}

// print_r($santri); die();
			if ($jumlah <= $maksimal_bayar['bangunan']) 
			{ 
				if (array_sum($jumlah_bayar)+$jumlah <= $maksimal_bayar['bangunan']) 
				{
					// siapkan data utk di input ke tbl pembayaran
					$data_pembayaran_bangunan = [
						'id_pembayaran'		=>$id,
						'id_santri'			=>$id_santri,
						'id_jenis_transaksi'=>'7',
						'jumlah'			=>$jumlah,
						'bulan_bayar'		=>$tgl_transaksi,
						'tgl_bayar'			=>$tgl_transaksi
					];
							// input ke tbl pembayaran
					$this->db->insert('pembayaran',$data_pembayaran_bangunan);
				}
				elseif (array_sum($jumlah_bayar)+$jumlah >= $maksimal_bayar['bangunan']) 
				{ 
					// echo "besar"; die();
					$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert">Data gagal di input, data uang yang di input + data uang yang sudah masuk terlalu besar dari biaya bangunan yang harus dibayar!</div>');
					if ($role_id == '0') {redirect('Administrator/uang_bangunan');}
					elseif ($role_id == '1') {redirect('Bendahara/uang_bangunan');}
				}
				
			} 
			else if($jumlah > $maksimal_bayar['bangunan'])
			{
				$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert"> Data gagal di input, Jumlah uang yang di input terlalu besar!</div>');
					if ($role_id == '0') {redirect('Administrator/uang_bangunan');}
					elseif ($role_id == '1') {redirect('Bendahara/uang_bangunan');}
			}
			else
			{ 
					// echo "string"; die();
				$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert">Data gagal di input, <b>'.  $santri['nama'] . '</b> sudah melunasi pembayaran uang bangunan!</div>');
				if ($role_id == '0') {redirect('Administrator/uang_bangunan');}
				elseif ($role_id == '1') {redirect('Bendahara/uang_bangunan');}
			}
// die();


			$cek_saldo = $this->Keuangan_Model->cek_saldo_hari_ini($tgl_transaksi);
			$get_saldo_sebelumnya = $this->Keuangan_Model->get_saldo_sebelumnya($tgl_transaksi);
			$get_data_saldo_setelahnya = $this->Keuangan_Model->get_data_saldo_setelahnya($tgl_transaksi);

			if (!$cek_saldo) 
			{
				// siapkan data utk di input ke tbl saldo
				$data_saldo = [
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik'],
						'kas'		=>$get_saldo_sebelumnya['kas'],
						'beras'		=>$get_saldo_sebelumnya['beras'],
						'lauk'		=>$get_saldo_sebelumnya['lauk'],
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan'],
						'bangunan'	=>$get_saldo_sebelumnya['bangunan']+$jumlah,
						'bantuan'	=>$get_saldo_sebelumnya['bantuan'],
						'infaq'		=>$get_saldo_sebelumnya['infaq']
					];

				// input ke tbl saldo
				$this->db->insert('saldo',$data_saldo);
			}
			else
			{
				$update_saldo = [
						'bangunan'	=> $cek_saldo['bangunan']+$jumlah
				]; 

				// update data ke tbl saldo
				$this->db->set($update_saldo);
				$where = array('tanggal' => $tgl_transaksi);
				$this->db->where($where);
				$this->db->update('saldo');
			}


			// jika ada data saldo pada tgl setelah ditambah, update untuk seterusnya
			if ($get_data_saldo_setelahnya) 
			{
				$i=0;
				foreach ($get_data_saldo_setelahnya as $upd) 
				{
					$update = array('bangunan' => $upd['bangunan']+$jumlah);

					$this->db->set($update);
					$where = array('tanggal' => $upd['tanggal']);
					$this->db->where($where);
					$this->db->update('saldo');

					$i++;
				}
			}



			$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Saldo bangunan berhasil di input!</div>');
				redirect('Bendahara/uang_bangunan');}

		// print_r($cek_status_pembayaran); die();
		
	}
	// akhir fungsi untuk menu pemasukan


	public function detail_kas($bulan)
	{
		$data['title'] = "Data Uang Kas";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['data'] = $this->Keuangan_Model->get_data_kas_satu_bulan($bulan);
		$data['belum_bayar'] = $this->Keuangan_Model->get_data_belum_bayar_kas_bulanan($bulan);
		
		// print_r($data['belum_bayar']); die();

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/data_detail_perBulan', $data);
		$this->load->view('Template/footer_datatable');
	}

	public function detail_beras($bulan)
	{
		$data['title'] = "Data Uang Beras";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['data'] = $this->Keuangan_Model->get_data_beras_satu_bulan($bulan);
		$data['belum_bayar'] = $this->Keuangan_Model->get_data_belum_bayar_beras_bulanan($bulan);
		
		// print_r($data['belum_bayar']); die();

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/data_detail_perBulan', $data);
		$this->load->view('Template/footer_datatable');
	}

	public function detail_lauk($bulan)
	{
		$data['title'] = "Data Uang Lauk";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['data'] = $this->Keuangan_Model->get_data_lauk_satu_bulan($bulan);
		$data['belum_bayar'] = $this->Keuangan_Model->get_data_belum_bayar_lauk_bulanan($bulan);
		
		// print_r($data['belum_bayar']); die();

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/data_detail_perBulan', $data);
		$this->load->view('Template/footer_datatable');
	}

	public function detail_bangunan($thn)
	{
		$data['title'] = "Data Uang Bangunan2";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['data_santri'] = $this->Santri_Model->get_data_santri_angkatan($thn);
		$data['tahun'] = $thn;
		$data['biaya'] = $this->Keuangan_Model->get_biaya_uang_bangunan($thn);
		
		// print_r($data['data_santri']); die();

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/data_detail_bangunan', $data);
		$this->load->view('Template/footer_datatable', $data);
	}


// akhir class controller
}