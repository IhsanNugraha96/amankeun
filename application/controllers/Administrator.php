<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('id_user')) 
		{
			redirect('Auth');
		}
		else
		{
			if ($this->session->userdata('role_id') == 1) 
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
		echo "masuk";
	// 	$data['title'] = "Pengaturan Pembayaran";
	// 	$data['role_id'] = $this->session->userdata('role_id');
	// 	$id_user = $this->session->userdata('id_pengurus');
	// 	$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);

	// 	$this->load->view('Auth/sign_in',$data);	
	}

	public function pengaturan_pembayaran()
	{
		$data['title'] = "Pengaturan Pembayaran";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['aturan_pembayaran'] = $this->Keuangan_Model->get_all_aturan_pembayaran();

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/aturan_pembayaran', $data);
		$this->load->view('Template/footer_datatable');
	}

	public function tambah_dataAturanPembayaran()
	{
		$tgl 		= $this->input->post('year');
		$bangunan 	= $this->input->post('bangunan');
		$kas 		= $this->input->post('kas');
		$beras 		= $this->input->post('beras');
		$lauk 		= $this->input->post('lauk');
		$kesehatan 	= $this->input->post('kesehatan');
		$listrik_m 	= $this->input->post('listrik_m');
		$listrik_tm = $this->input->post('listrik_tm');
		$tahun 		= substr($tgl,0,4);

		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$kode = substr(str_shuffle($permitted_chars), 0, 4);

		$id_aturan = date("YmdGis").$kode;

		// cek apakah sudah ada aturan untuk angkatan yang di tambah
		$cekAngkatan = $this->Keuangan_Model->cekAngkatanByTahun($tahun);


		// jika ada
		if ($cekAngkatan != 0) 
		{
			$this->session->set_flashdata('message','<div class="alert alert-warning shadow" style="margin-top:-10%;" role="alert">Angkatan yang di input sudah di atur!</div>');
		}
		// jika tidak ada
		else
		{
			// siapkan data utk di input ke tbl angkatan
			$data_angkatan = [
				'id_angkatan'		=>date('Ymdhis').$kode,
				'tahun_masuk'		=>$tahun,
				'id_aturan_bayar'	=>$id_aturan
			];
			// input ke tbl angkatan
			$this->db->insert('angkatan',$data_angkatan);


			// siapkan data utk di input ke tbl aturan_pembayaran
			$data_aturan = [
				'id_aturan_bayar'	=> $id_aturan,
				'listrik_mondok'	=> $listrik_m,
				'listrik_tdk_mondok'=> $listrik_tm,
				'kas'				=> $kas,
				'beras'				=> $beras,
				'lauk'				=> $lauk,
				'kesehatan'			=> $kesehatan,
				'bangunan'			=> $bangunan
			];

			// input data ke tbl aturan_pembayaran
			$this->db->insert('aturan_pembayaran',$data_aturan);

			$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Aturan pembayaran baru sudah di input!</div>');
		}

		redirect('Administrator/pengaturan_pembayaran');
	}


	public function ubah_dataAturanPembayaran($id_atr)
	{
		$id = urldecode($id_atr);
		$bangunan 	= $this->input->post('bangunan');
		$kas 		= $this->input->post('kas');
		$beras 		= $this->input->post('beras');
		$lauk 		= $this->input->post('lauk');
		$kesehatan 	= $this->input->post('kesehatan');
		$listrik_m 	= $this->input->post('listrik_m');
		$listrik_tm = $this->input->post('listrik_tm');
		
		// siapkan data utk di input ke tbl aturan_pembayaran
		$data_aturan = [
			'listrik_mondok'	=> $listrik_m,
			'listrik_tdk_mondok'=> $listrik_tm,
			'kas'				=> $kas,
			'beras'				=> $beras,
			'lauk'				=> $lauk,
			'kesehatan'			=> $kesehatan,
			'bangunan'			=> $bangunan
		];

			// input data ke tbl aturan_pembayaran
		$this->db->set($data_aturan);
		$where = array('id_aturan_bayar' => $id);
		$this->db->where($where);
		$this->db->update('aturan_pembayaran');

		$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Aturan pembayaran berhasil diperbaharui!</div>');

		redirect('Administrator/pengaturan_pembayaran');
	}


	public function hapus_aturan_keuangan($id_atr)
	{
		$id = urldecode($id_atr);
		// cek apakah sudah ada santri untuk angkatan yang akan di hapus
		$cekAngkatan = $this->Keuangan_Model->cekJmlSantriByIdAtrAngkatan($id);

		// jika tidak ada santri terdaftar pada angkatan ini
		if ($cekAngkatan == 0) 
		{
			// hapus data dari tabel angkatan dan aturan pembayaran
			$this->db->delete('angkatan', array('id_aturan_bayar' => $id));
			$this->db->delete('aturan_pembayaran', array('id_aturan_bayar' => $id));

			$this->session->set_flashdata('message','<div class="alert alert-success shadow" role="alert">Aturan berhasil di hapus!</div>');
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-info shadow" role="alert">Aturan gagal di hapus, terdapat santri yang terdaftar pada angkatan ini!</div>');	
		}

		redirect('Administrator/pengaturan_pembayaran');
	}


	public function donasi()
	{
		$data['title'] = "Donasi Dari Luar";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['donasi'] = $this->Keuangan_Model->get_all_donasi_dr_luar();
		$bulan = date("Y-m");
		$data_pemasukan = $this->Keuangan_Model->get_data_pemasukan_donasi_bulan_ini($bulan);
		$data['saldo'] = $this->Keuangan_Model->get_saldo_akhir_donasi_dr_luar();

		$i=0;
		if ($data_pemasukan) 
		{
			foreach ($data_pemasukan as $dtpm) 
			{
				$data['pemasukan'][$i] = $dtpm['jumlah'];
				$i++; 
			}
		}
		else
		{
			$data['pemasukan'][0] = 0;
		}
		
		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/donasi_luar', $data);
		$this->load->view('Template/footer_datatable');
	}

	public function tambah_dataDonasi()
	{
		$this->form_validation->set_rules('date', 'Tanggal','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('jumlah', 'Jumlah','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('keterangan', 'Keterangan','required|trim', ['required' => 'Data belum di isi!']);
		
		if ($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert">Harap mengisi data dengan benar!</div>');
			redirect('Administrator/donasi');
		}
		else
		{	
			$tgl 		= $this->input->post('date');
			$jumlah 	= $this->input->post('jumlah');
			$keterangan = htmlspecialchars($this->input->post('keterangan', true));

			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$kode = substr(str_shuffle($permitted_chars), 0, 4);

			$id = date("YmdGis").$kode;

			// siapkan data utk di input ke tbl donasi
			$data_bantuan = [
				'id_bantuan'	=>$id,
				'tgl_bantuan'	=>$tgl,
				'keterangan'	=>$keterangan,
				'jumlah'		=>$jumlah
			];
			// input ke tbl bantuan donasi
			$this->db->insert('bantuan',$data_bantuan);


			$cek_saldo = $this->Keuangan_Model->cek_saldo_hari_ini($tgl);
			$get_saldo_sebelumnya = $this->Keuangan_Model->get_saldo_sebelumnya($tgl);
			$get_data_saldo_setelahnya = $this->Keuangan_Model->get_data_saldo_setelahnya($tgl);

			if (!$cek_saldo) 
			{
				// siapkan data utk di input ke tbl saldo
				$data_saldo = [
					'tanggal'	=>$tgl,
					'listrik'	=>$get_saldo_sebelumnya['listrik'],
					'kas'		=>$get_saldo_sebelumnya['kas'],
					'beras'		=>$get_saldo_sebelumnya['beras'],
					'lauk'		=>$get_saldo_sebelumnya['lauk'],
					'kesehatan'	=>$get_saldo_sebelumnya['kesehatan'],
					'bangunan'	=>$get_saldo_sebelumnya['bangunan'],
					'bantuan'	=>$get_saldo_sebelumnya['bantuan']+$jumlah,
					'infaq'		=>$get_saldo_sebelumnya['infaq']
				];

				// input ke tbl bantuan donasi
				$this->db->insert('saldo',$data_saldo);
			}
			else
			{
				// siapkan data utk di input ke tbl aturan_pembayaran
				$update_saldo = [
					'bantuan'	=> $cek_saldo['bantuan']+$jumlah
				];

				// update data ke tbl saldo
				$this->db->set($update_saldo);
				$where = array('tanggal' => $tgl);
				$this->db->where($where);
				$this->db->update('saldo');
			}


			// jika ada data saldo pada tgl setelah ditambah uang bantuan
			if ($get_data_saldo_setelahnya) 
			{
				$i=0;
				foreach ($get_data_saldo_setelahnya as $upd) 
				{
					$update = array('bantuan' => $upd['bantuan']+$jumlah);
					$this->db->set($update);
					$where = array('tanggal' => $upd['tanggal']);
					$this->db->where($where);
					$this->db->update('saldo');

					$i++;
				}
			}

			$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Data dana bantuan berhasil di input!</div>');

			redirect('Administrator/donasi');
		}
	}

	public function ubah_dataDonasi($id)
	{
		$this->form_validation->set_rules('jumlah', 'Jumlah','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('keterangan', 'Keterangan','required|trim', ['required' => 'Data belum di isi!']);
		
		if ($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert">Harap mengisi data dengan benar!</div>');
			redirect('Administrator/donasi');
		}
		else
		{	
			$jumlah 	= $this->input->post('jumlah');
			$keterangan = htmlspecialchars($this->input->post('keterangan', true));
			$dana_sebelumnya = $this->Keuangan_Model->get_data_bantuanDana_byId($id);
			$tgl = $dana_sebelumnya['tgl_bantuan'];

// die();


			$update = array('keterangan'=> $keterangan, 
				'jumlah'	=> $jumlah);

			// update tabel bantuan
			$this->db->set($update);
			$where = array('id_bantuan' => $id);
			$this->db->where($where);
			$this->db->update('bantuan');


			$update_bantuan = $jumlah - $dana_sebelumnya['jumlah'];
			

			// update tabel saldo
			$cek_saldo = $this->Keuangan_Model->cek_saldo_hari_ini($tgl);
			$get_data_saldo_setelahnya = $this->Keuangan_Model->get_data_saldo_setelahnya($tgl);

			
			// siapkan data utk di input ke tbl aturan_pembayaran
			$update_saldo = [
				'bantuan'	=> $cek_saldo['bantuan']+$update_bantuan
			];

				// update data ke tbl saldo
			$this->db->set($update_saldo);
			$where = array('tanggal' => $tgl);
			$this->db->where($where);
			$this->db->update('saldo');
			


			// jika ada data saldo pada tgl setelah ditambah uang bantuan
			if ($get_data_saldo_setelahnya) 
			{
				$i=0;
				foreach ($get_data_saldo_setelahnya as $upd) 
				{
					$update = array('bantuan' => $upd['bantuan']+$update_bantuan);
					$this->db->set($update);
					$where = array('tanggal' => $upd['tanggal']);
					$this->db->where($where);
					$this->db->update('saldo');

					$i++;
				}
			}

			$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Data dana bantuan berhasil di perbaharui!</div>');

			redirect('Administrator/donasi');
		}
	}

	public function hapus_data_donasi($id)
	{
		$data_sebelumnya = $this->Keuangan_Model->get_data_bantuanDana_byId($id);
		$tgl = $data_sebelumnya['tgl_bantuan'];

		// update tabel saldo
		$cek_saldo = $this->Keuangan_Model->cek_saldo_hari_ini($tgl);
		$get_data_saldo_setelahnya = $this->Keuangan_Model->get_data_saldo_setelahnya($tgl);


		// siapkan data utk di input ke tbl aturan_pembayaran
		$update_saldo = [
			'bantuan'	=> $cek_saldo['bantuan']-$data_sebelumnya['jumlah']
		];

		// update data ke tbl saldo
		$this->db->set($update_saldo);
		$where = array('tanggal' => $tgl);
		$this->db->where($where);
		$this->db->update('saldo');



			// jika ada data saldo pada tgl setelah ditambah uang bantuan
		if ($get_data_saldo_setelahnya) 
		{
			$i=0;
			foreach ($get_data_saldo_setelahnya as $upd) 
			{
				$update = array('bantuan' => $upd['bantuan']-$data_sebelumnya['jumlah']);
				$this->db->set($update);
				$where = array('tanggal' => $upd['tanggal']);
				$this->db->where($where);
				$this->db->update('saldo');

				$i++;
			}
		}

		// hapus data di tbl bantuan
		$this->db->delete('bantuan', array('id_bantuan' => $id));

		$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Data berhasil di hapus!</div>');

		redirect('Administrator/donasi');
	}


	public function get_berapa_bayar_listrik()
	{
		// $id_santri_terpilih = 1;
		$id_santri_terpilih = $_POST['id_santri'];
		// $data_santri = $this->Santri_Model->getDataSantriByIdSantri($id_santri_terpilih);
		$data_santri = $this->Keuangan_Model->get_data_biaya_iuran_santri($id_santri_terpilih);

		if ($data_santri['yatim'] == 0) 
		{
			if ($data_santri['mondok'] == 0) 
			{
				$jumlah_bayar = $data_santri['listrik_tdk_mondok'];
			}
			else
			{
				$jumlah_bayar = $data_santri['listrik_mondok'];
			}
		}
		elseif ($data_santri['yatim'] == 1)
		{
			$jumlah_bayar = 0;
		}
		echo $jumlah_bayar;
	}

	public function get_berapa_bayar_kesehatan()
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
				$jumlah_bayar = $data_santri['kesehatan'];
			}
		}
		elseif ($data_santri['yatim'] == 1)
		{
			$jumlah_bayar = 0;
		}
		echo $jumlah_bayar;
	}

	public function get_berapa_bayar_infaq()
	{
		echo "0";
	}

//  fungsi untuk pemasukan listrik
	public function listrik()
	{
		$data['title'] = "Uang Listrik Masuk";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['santri'] = $this->Santri_Model->getDataSantriAllAktifNonYatim();
		$data['data_bulan_listrik'] = $this->Keuangan_Model->get_data_bulan_listrik();
		$data['saldo'] = $this->Keuangan_Model->get_saldo_akhir_listrik();

		$i=0;
			if ($data['data_bulan_listrik']) 
			{
				foreach ($data['data_bulan_listrik'] as $dt) 
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
// print_r($data['santri']); die();

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/listrik', $data);
		$this->load->view('Template/footer_datatable');
	}

	public function detail_listrik($bulan)
	{
		$data['title'] = "Uang Listrik Masuk";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['data'] = $this->Keuangan_Model->get_data_listrik_satu_bulan($bulan);
		$data['belum_bayar'] = $this->Keuangan_Model->get_data_belum_bayar_listrik_bulanan($bulan);
		
		// print_r($data['belum_bayar']); die();

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/data_detail_perBulan', $data);
		$this->load->view('Template/footer_datatable');
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
			elseif ($kategori == 'kesehatan') {redirect('Administrator/kesehatan');}
			elseif ($kategori == 'Infaq') {redirect('Administrator/infaq');}
			
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


			if ($kategori == 'listrik') 
			{
				if ($santri_masuk <= $santri_bayar) 
				{
					$cek_status_pembayaran = $this->Keuangan_Model->cekStatusPembayaran($id_santri,$bulan_bayar,'1');
					// printr($cek_status_pembayaran); die();
					if ($cek_status_pembayaran == '0') 
					{
						// siapkan data utk di input ke tbl pembayaran
						$data_pembayaran_listrik = [
							'id_pembayaran'		=>$id,
							'id_santri'			=>$id_santri,
							'id_jenis_transaksi'=>'1',
							'jumlah'			=>$jumlah,
							'bulan_bayar'		=>$bulan_bayar,
							'tgl_bayar'			=>$tgl_transaksi
						];
						// input ke tbl pembayaran
						$this->db->insert('pembayaran',$data_pembayaran_listrik);
					}
					else
					{
						$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert"><b>'.  $santri['nama'] . '</b> sudah membayar uang listrik pada bulan yang di pilih!</div>');
						redirect('Administrator/listrik');
					}
					
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert"><b>'  .  $santri['nama'] . '</b> tidak mempunyai kewajiban untuk membayar uang listrik bulan yang di pilih!</div>');
					redirect('Administrator/listrik');
				}
			}


			else if ($kategori == 'kesehatan') 
			{
				if ($santri_masuk <= $santri_bayar) 
				{
					$cek_status_pembayaran = $this->Keuangan_Model->cekStatusPembayaran($id_santri,$bulan_bayar,'4');

					if ($cek_status_pembayaran == '0') 
					{
						// siapkan data utk di input ke tbl pembayaran
						$data_pembayaran_kesehatan = [
							'id_pembayaran'		=>$id,
							'id_santri'			=>$id_santri,
							'id_jenis_transaksi'=>'4',
							'jumlah'			=>$jumlah,
							'bulan_bayar'		=>$bulan_bayar,
							'tgl_bayar'			=>$tgl_transaksi
						];
						// input ke tbl pembayaran
						$this->db->insert('pembayaran',$data_pembayaran_kesehatan);
					}
					else
					{
						$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert"><b>'.  $santri['nama'] . '</b> sudah membayar uang kesehatan pada bulan yang di pilih!</div>');
						redirect('Administrator/kesehatan');
					}
					
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert"><b>'  .  $santri['nama'] . '</b> tidak mempunyai kewajiban untuk membayar uang kesehatan bulan yang di pilih!</div>');
					redirect('Administrator/kesehatan');
				}
			}
			else if ($kategori == 'Infaq') 
			{ 
				$this->form_validation->set_rules('jumlah', 'Jumlah','required|trim', ['required' => 'Data belum di isi!']);

				if ($this->form_validation->run() == false)
				{
					$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert">Harap mengisi data dengan benar!</div>');
					redirect('Administrator/infaq');
					
				}
				else
				{
					// siapkan data utk di input ke tbl pembayaran
					$data_pembayaran_infaq = [
						'id_pembayaran'		=>$id,
						'id_santri'			=>$id_santri,
						'id_jenis_transaksi'=>'6',
						'jumlah'			=>$jumlah,
						'bulan_bayar'		=>$tgl_transaksi,
						'tgl_bayar'			=>$tgl_transaksi
					];
					// input ke tbl pembayaran
					$this->db->insert('pembayaran',$data_pembayaran_infaq);
				}
			}
		
			$cek_saldo = $this->Keuangan_Model->cek_saldo_hari_ini($tgl_transaksi);
			$get_saldo_sebelumnya = $this->Keuangan_Model->get_saldo_sebelumnya($tgl_transaksi);
			$get_data_saldo_setelahnya = $this->Keuangan_Model->get_data_saldo_setelahnya($tgl_transaksi);

			if (!$cek_saldo) 
			{
				// siapkan data utk di input ke tbl saldo
				if ($kategori == 'listrik') 
				{
					$data_saldo = [
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik']+$jumlah,
						'kas'		=>$get_saldo_sebelumnya['kas'],
						'beras'		=>$get_saldo_sebelumnya['beras'],
						'lauk'		=>$get_saldo_sebelumnya['lauk'],
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan'],
						'bangunan'	=>$get_saldo_sebelumnya['bangunan'],
						'bantuan'	=>$get_saldo_sebelumnya['bantuan'],
						'infaq'		=>$get_saldo_sebelumnya['infaq']
					];
				}
				else if ($kategori == 'kesehatan') 
				{
					$data_saldo = [
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik'],
						'kas'		=>$get_saldo_sebelumnya['kas'],
						'beras'		=>$get_saldo_sebelumnya['beras'],
						'lauk'		=>$get_saldo_sebelumnya['lauk'],
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan']+$jumlah,
						'bangunan'	=>$get_saldo_sebelumnya['bangunan'],
						'bantuan'	=>$get_saldo_sebelumnya['bantuan'],
						'infaq'		=>$get_saldo_sebelumnya['infaq']
					];
				}
				else if ($kategori == 'Infaq') 
				{
					$data_saldo = [
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik'],
						'kas'		=>$get_saldo_sebelumnya['kas'],
						'beras'		=>$get_saldo_sebelumnya['beras'],
						'lauk'		=>$get_saldo_sebelumnya['lauk'],
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan'],
						'bangunan'	=>$get_saldo_sebelumnya['bangunan'],
						'bantuan'	=>$get_saldo_sebelumnya['bantuan'],
						'infaq'		=>$get_saldo_sebelumnya['infaq']+$jumlah
					];
				}
				

				// input ke tbl saldo
				$this->db->insert('saldo',$data_saldo);
			}
			else
			{
				// siapkan data utk di input ke tbl aturan_pembayaran
				if ($kategori == 'listrik') {
					$update_saldo = [
						'listrik'	=> $cek_saldo['listrik']+$jumlah
					]; }
				else if ($kategori == 'kesehatan') {
					$update_saldo = [
						'kesehatan'	=> $cek_saldo['kesehatan']+$jumlah
					]; }
				else if ($kategori == 'Infaq') {
					$update_saldo = [
						'infaq'	=> $cek_saldo['infaq']+$jumlah
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
					if ($kategori == 'listrik') {
						$update = array('listrik' => $upd['listrik']+$jumlah);}
					else if ($kategori == 'kesehatan') {
						$update = array('kesehatan' => $upd['kesehatan']+$jumlah);}
					else if ($kategori == 'Infaq') {
						$update = array('infaq' => $upd['infaq']+$jumlah);}
					$this->db->set($update);
					$where = array('tanggal' => $upd['tanggal']);
					$this->db->where($where);
					$this->db->update('saldo');

					$i++;
				}
			}



			if ($kategori == 'listrik') {
				$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Saldo listrik berhasil di input!</div>');
				redirect('Administrator/listrik');}

			else if ($kategori == 'kesehatan') {
				$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Saldo kesehatan berhasil di input!</div>');
				redirect('Administrator/kesehatan');}

			else if ($kategori == 'Infaq') {
				$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Saldo infaq berhasil di input!</div>');
				redirect('Administrator/infaq');}
		}
	}
	// akhir fungsi untuk menu pemasukan

	// awal fungsi untuk menu pemasukan/kesehatan
	public function  kesehatan()
	{
		$data['title'] = "Uang Kesehatan Masuk";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['santri'] = $this->Santri_Model->getDataSantriAllAktifNonYatimNonMondok();
		$data['data_bulan_kesehatan'] = $this->Keuangan_Model->get_data_bulan_kesehatan();
		$data['saldo'] = $this->Keuangan_Model->get_saldo_akhir_kesehatan();

		$i=0;
			if ($data['data_bulan_kesehatan']) 
			{
				foreach ($data['data_bulan_kesehatan'] as $dt) 
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


		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/kesehatan', $data);
		$this->load->view('Template/footer_datatable');
	}

	public function detail_kesehatan($bulan)
	{
		$data['title'] = "Uang Kesehatan Masuk";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['data'] = $this->Keuangan_Model->get_data_kesehatan_satu_bulan($bulan);
		$data['belum_bayar'] = $this->Keuangan_Model->get_data_belum_bayar_kesehatan_bulanan($bulan);
		

		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/data_detail_perBulan', $data);
		$this->load->view('Template/footer_datatable');
	}
	// akhir fungsi menu Pemasukan/kesehatan

	// awal fungsi untuk menu pemasukan/infaq
	public function infaq()
	{
		$data['title'] = "Uang Infaq Santri";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['santri'] = $this->Santri_Model->getDataSantriAllAktifNonYatim();
		$data['data_infaq'] = $this->Keuangan_Model->get_data_infaq();
		$bulan = date("Y-m");
		$data_pemasukan = $this->Keuangan_Model->get_data_pemasukan_infaq_bulan_ini($bulan);
		$data['saldo'] = $this->Keuangan_Model->get_saldo_akhir_infaq();

		$i=0;
		if ($data_pemasukan) 
		{
			foreach ($data_pemasukan as $dtpm) 
			{
				$data['pemasukan'][$i] = $dtpm['jumlah'];
				$i++; 
			}
		}
		else
		{
			$data['pemasukan'][0] = 0;
		}


		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/infaq', $data);
		$this->load->view('Template/footer_datatable');
	}

	public function ubah_dataInfaq($id)
	{
		$this->form_validation->set_rules('jumlah', 'Jumlah','required|trim', ['required' => 'Data belum di isi!']);
		
		if ($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert">Harap mengisi data dengan benar!</div>');
			redirect('Administrator/infaq');
		}
		else
		{	
			$jumlah 	= $this->input->post('jumlah');
			$dana_sebelumnya = $this->Keuangan_Model->get_data_pembayaran_byId($id);
			$tgl = $dana_sebelumnya['tgl_bayar'];
			$update = array('jumlah'	=> $jumlah);

			$update_infaq = $jumlah - $dana_sebelumnya['jumlah'];

			// update tabel pembayaran
			$this->db->set($update);
			$where = array('id_pembayaran' => $id);
			$this->db->where($where);
			$this->db->update('pembayaran');

			// update tabel saldo
			$cek_saldo = $this->Keuangan_Model->cek_saldo_hari_ini($tgl);
			$get_data_saldo_setelahnya = $this->Keuangan_Model->get_data_saldo_setelahnya($tgl);

			

			

			// siapkan data utk di input ke tbl aturan_pembayaran
			$update_saldo = [
				'infaq'	=> $cek_saldo['infaq']+$update_infaq
			];
// print_r($get_data_saldo_setelahnya); die();
// print_r($update_infaq).' - '.print_r($update_saldo); die();
			// update data ke tbl saldo
			$this->db->set($update_saldo);
			$where = array('tanggal' => $tgl);
			$this->db->where($where);
			$this->db->update('saldo');


			// jika ada data saldo pada tgl setelah ditambah uang bantuan
			if ($get_data_saldo_setelahnya) 
			{
				$i=0;
				foreach ($get_data_saldo_setelahnya as $upd) 
				{
					$update = array('infaq' => $upd['infaq']+$update_infaq);
					$this->db->set($update);
					$where = array('tanggal' => $upd['tanggal']);
					$this->db->where($where);
					$this->db->update('saldo');

					$i++;
				}
			}

			$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Data infaq berhasil di perbaharui!</div>');

			redirect('Administrator/infaq');
		}
	}

	public function hapus_data_infaq($id)
	{
		$data_sebelumnya = $this->Keuangan_Model->get_data_pembayaran_byId($id);
		$tgl = $data_sebelumnya['tgl_bayar'];

		// update tabel saldo
		$cek_saldo = $this->Keuangan_Model->cek_saldo_hari_ini($tgl);
		$get_data_saldo_setelahnya = $this->Keuangan_Model->get_data_saldo_setelahnya($tgl);


		// siapkan data utk di input ke tbl aturan_pembayaran
		$update_saldo = [
			'infaq'	=> $cek_saldo['infaq']-$data_sebelumnya['jumlah']
		];

		// update data ke tbl saldo
		$this->db->set($update_saldo);
		$where = array('tanggal' => $tgl);
		$this->db->where($where);
		$this->db->update('saldo');



			// jika ada data saldo pada tgl setelah ditambah uang bantuan
		if ($get_data_saldo_setelahnya) 
		{
			$i=0;
			foreach ($get_data_saldo_setelahnya as $upd) 
			{
				$update = array('infaq' => $upd['infaq']-$data_sebelumnya['jumlah']);
				$this->db->set($update);
				$where = array('tanggal' => $upd['tanggal']);
				$this->db->where($where);
				$this->db->update('saldo');

				$i++;
			}
		}

		// hapus data di tbl bantuan
		$this->db->delete('pembayaran', array('id_pembayaran' => $id));

		$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Data berhasil di hapus!</div>');

		redirect('Administrator/Infaq');
	}
	// Akhir menu pembayaran


	// Fungsi untuk menu pengeluaran

	public function pengeluaran()
	{
		$data['title'] = "Pengeluaran";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['santri'] = $this->Santri_Model->getDataSantriAllAktifNonYatim();
		$data['data_infaq'] = $this->Keuangan_Model->get_data_infaq();
		$bulan = date("Y-m");
		$data_pemasukan = $this->Keuangan_Model->get_data_pemasukan_infaq_bulan_ini($bulan);
		$data['saldo'] = $this->Keuangan_Model->get_saldo_akhir_infaq();

		$i=0;
		if ($data_pemasukan) 
		{
			foreach ($data_pemasukan as $dtpm) 
			{
				$data['pemasukan'][$i] = $dtpm['jumlah'];
				$i++; 
			}
		}
		else
		{
			$data['pemasukan'][0] = 0;
		}


		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/pengeluaran', $data);
		$this->load->view('Template/footer_datatable');
	}


	public function akun_saya()
	{
		$data['title'] = "Akun Saya";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);

		$this->load->view('Template/header');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/akun_saya', $data);
		$this->load->view('Template/footer');
	}

	public function akun_pengurus()
	{
		$data['title'] = 'Akun Pengurus';
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['akun_bendahara'] = $this->Akun_Model->getInfoAkunBendahara();
		$data['akun_pengurus'] = $this->Akun_Model->getInfoAkunPengurus();
// print_r($data['akun_bendahara']); die();
		$this->load->view('Template/header');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/akun_pengurus', $data);
		$this->load->view('Template/footer');
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
				redirect('Administrator/uang_bangunan');}

		// print_r($cek_status_pembayaran); die();
		
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


// tag akhir controller 
}