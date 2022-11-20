<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('id_user')) 
		{
			redirect('Auth');
		}
		else
		{
			if ($this->session->userdata('role_id') == 2 ||$this->session->userdata('role_id') == 3)
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
		$data['title'] = "Pengeluaran";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['santri'] = $this->Santri_Model->getDataSantriAllAktifNonYatim();
		$data['pengeluaran_all'] = $this->Keuangan_Model->get_data_pengeluaran_all();
		$bulan = date("Y-m");
		$data_pengeluaran = $this->Keuangan_Model->get_data_pengeluaran_bulan_ini($bulan);
		$data['pengeluaran_listrik'] = $this->Keuangan_Model->get_jumlah_pengeluaran_bulan_ini($bulan,'1');		
		$data['pengeluaran_kas'] = $this->Keuangan_Model->get_jumlah_pengeluaran_bulan_ini($bulan,'2');				
		$data['pengeluaran_beras'] = $this->Keuangan_Model->get_jumlah_pengeluaran_bulan_ini($bulan,'3');				
		$data['pengeluaran_kesehatan'] = $this->Keuangan_Model->get_jumlah_pengeluaran_bulan_ini($bulan,'4');				
		$data['pengeluaran_lauk'] = $this->Keuangan_Model->get_jumlah_pengeluaran_bulan_ini($bulan,'5');				
		$data['pengeluaran_infaq'] = $this->Keuangan_Model->get_jumlah_pengeluaran_bulan_ini($bulan,'6');					
		$data['pengeluaran_bangunan'] = $this->Keuangan_Model->get_jumlah_pengeluaran_bulan_ini($bulan,'7');						
		$data['pengeluaran_bantuan'] = $this->Keuangan_Model->get_jumlah_pengeluaran_bulan_ini($bulan,'8');

		// ambil data nilai all pengeluaran
		$i=0;
		if ($data_pengeluaran) 
		{
			foreach ($data_pengeluaran as $dtpm) 
			{
				$data['pengeluaran'][$i] = $dtpm['jumlah'];
				$i++; 
			}
		}
		else
		{
			$data['pengeluaran'][0] = 0;
		}

		// ambil data nilai pengeluaran listrik
		$i=0;
		if ($data['pengeluaran_listrik']) 
		{
			foreach ($data['pengeluaran_listrik'] as $dtpm) 
			{
				$data['pengeluaran_listrik'][$i] = $dtpm['jumlah'];
				$i++; 
			}
		}
		else
		{
			$data['pengeluaran_listrik'][0] = 0;
		}

		// ambil data nilai pengeluaran kas
		$i=0;
		if ($data['pengeluaran_kas']) 
		{
			foreach ($data['pengeluaran_kas'] as $dtpm) 
			{
				$data['pengeluaran_kas'][$i] = $dtpm['jumlah'];
				$i++; 
			}
		}
		else
		{
			$data['pengeluaran_kas'][0] = 0;
		}

		// ambil data nilai pengeluaran beras
		$i=0;
		if ($data['pengeluaran_beras']) 
		{
			foreach ($data['pengeluaran_beras'] as $dtpm) 
			{
				$data['pengeluaran_beras'][$i] = $dtpm['jumlah'];
				$i++; 
			}
		}
		else
		{
			$data['pengeluaran_beras'][0] = 0;
		}

		// ambil data nilai pengeluaran kesehatan
		$i=0;
		if ($data['pengeluaran_kesehatan']) 
		{
			foreach ($data['pengeluaran_kesehatan'] as $dtpm) 
			{
				$data['pengeluaran_kesehatan'][$i] = $dtpm['jumlah'];
				$i++; 
			}
		}
		else
		{
			$data['pengeluaran_kesehatan'][0] = 0;
		}


		// ambil data nilai pengeluaran lauk
		$i=0;
		if ($data['pengeluaran_lauk']) 
		{
			foreach ($data['pengeluaran_lauk'] as $dtpm) 
			{
				$data['pengeluaran_lauk'][$i] = $dtpm['jumlah'];
				$i++; 
			}
		}
		else
		{
			$data['pengeluaran_lauk'][0] = 0;
		}


		// ambil data nilai pengeluaran infaq
		$i=0;
		if ($data['pengeluaran_infaq']) 
		{
			foreach ($data['pengeluaran_infaq'] as $dtpm) 
			{
				$data['pengeluaran_infaq'][$i] = $dtpm['jumlah'];
				$i++; 
			}
		}
		else
		{
			$data['pengeluaran_infaq'][0] = 0;
		}

		// ambil data nilai pengeluaran bangunan
		$i=0;
		if ($data['pengeluaran_bangunan']) 
		{
			foreach ($data['pengeluaran_bangunan'] as $dtpm) 
			{
				$data['pengeluaran_bangunan'][$i] = $dtpm['jumlah'];
				$i++; 
			}
		}
		else
		{
			$data['pengeluaran_bangunan'][0] = 0;
		}


		// ambil data nilai pengeluaran bantuan
		$i=0;
		if ($data['pengeluaran_bantuan']) 
		{
			foreach ($data['pengeluaran_bantuan'] as $dtpm) 
			{
				$data['pengeluaran_bantuan'][$i] = $dtpm['jumlah'];
				$i++; 
			}
		}
		else
		{
			$data['pengeluaran_bantuan'][0] = 0;
		}


		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Admin/pengeluaran', $data);
		$this->load->view('Template/footer_datatable');
	}


	public function tambah_dataPengeluaran()
	{
		$this->form_validation->set_rules('date', 'Tanggal','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('jenis', 'Jenis','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('keterangan', 'Keterangan','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('jumlah', 'Jumlah','required|trim', ['required' => 'Data belum di isi!']);


		if ($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert">Harap mengisi data dengan benar!</div>');
			redirect('Pengeluaran');
			
		}
		else
		{	
			$tgl_transaksi 	= $this->input->post('date');
			$jenis			= $this->input->post('jenis');
			$keterangan		= $this->input->post('keterangan');
			$jumlah 		= $this->input->post('jumlah');
			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$kode = substr(str_shuffle($permitted_chars), 0, 6);
			$id = date("Ymdhis").$kode;

			$data_pengeluaran = [
				'id_pengeluaran'	=>$id,
				'tgl_pengeluaran'	=>$tgl_transaksi,
				'keterangan'		=>$keterangan,
				'jumlah'			=>$jumlah,
				'id_kategori'		=>$jenis
			];
			// input ke tbl pengeluaran
			$this->db->insert('pengeluaran',$data_pengeluaran);


			$cek_saldo = $this->Keuangan_Model->cek_saldo_hari_ini($tgl_transaksi);
			$get_saldo_sebelumnya = $this->Keuangan_Model->get_saldo_sebelumnya($tgl_transaksi);
			$get_data_saldo_setelahnya = $this->Keuangan_Model->get_data_saldo_setelahnya($tgl_transaksi);

			if (!$cek_saldo) 
			{
				if ($jenis == '1') 
				{
					$data_saldo = [
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik']-$jumlah,
						'kas'		=>$get_saldo_sebelumnya['kas'],
						'beras'		=>$get_saldo_sebelumnya['beras'],
						'lauk'		=>$get_saldo_sebelumnya['lauk'],
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan'],
						'bangunan'	=>$get_saldo_sebelumnya['bangunan'],
						'bantuan'	=>$get_saldo_sebelumnya['bantuan'],
						'infaq'		=>$get_saldo_sebelumnya['infaq']
					];
				}
				else if ($jenis == '2') 
				{
					$data_saldo = [
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik'],
						'kas'		=>$get_saldo_sebelumnya['kas']-$jumlah,
						'beras'		=>$get_saldo_sebelumnya['beras'],
						'lauk'		=>$get_saldo_sebelumnya['lauk'],
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan'],
						'bangunan'	=>$get_saldo_sebelumnya['bangunan'],
						'bantuan'	=>$get_saldo_sebelumnya['bantuan'],
						'infaq'		=>$get_saldo_sebelumnya['infaq']
					];
				}
				else if ($jenis == '3') 
				{
					$data_saldo = [
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik'],
						'kas'		=>$get_saldo_sebelumnya['kas'],
						'beras'		=>$get_saldo_sebelumnya['beras']-$jumlah,
						'lauk'		=>$get_saldo_sebelumnya['lauk'],
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan'],
						'bangunan'	=>$get_saldo_sebelumnya['bangunan'],
						'bantuan'	=>$get_saldo_sebelumnya['bantuan'],
						'infaq'		=>$get_saldo_sebelumnya['infaq']
					];
				}
				else if ($jenis == '4') 
				{
					$data_saldo = [
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik'],
						'kas'		=>$get_saldo_sebelumnya['kas'],
						'beras'		=>$get_saldo_sebelumnya['beras'],
						'lauk'		=>$get_saldo_sebelumnya['lauk'],
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan']-$jumlah,
						'bangunan'	=>$get_saldo_sebelumnya['bangunan'],
						'bantuan'	=>$get_saldo_sebelumnya['bantuan'],
						'infaq'		=>$get_saldo_sebelumnya['infaq']
					];
				}
				else if ($jenis == '5') 
				{
					$data_saldo = [
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik'],
						'kas'		=>$get_saldo_sebelumnya['kas'],
						'beras'		=>$get_saldo_sebelumnya['beras'],
						'lauk'		=>$get_saldo_sebelumnya['lauk']-$jumlah,
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan'],
						'bangunan'	=>$get_saldo_sebelumnya['bangunan'],
						'bantuan'	=>$get_saldo_sebelumnya['bantuan'],
						'infaq'		=>$get_saldo_sebelumnya['infaq']
					];
				}
				else if ($jenis == '6') 
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
						'infaq'		=>$get_saldo_sebelumnya['infaq']-$jumlah
					];
				}
				else if ($jenis == '7') 
				{
					$data_saldo = [
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik'],
						'kas'		=>$get_saldo_sebelumnya['kas'],
						'beras'		=>$get_saldo_sebelumnya['beras'],
						'lauk'		=>$get_saldo_sebelumnya['lauk'],
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan'],
						'bangunan'	=>$get_saldo_sebelumnya['bangunan']-$jumlah,
						'bantuan'	=>$get_saldo_sebelumnya['bantuan'],
						'infaq'		=>$get_saldo_sebelumnya['infaq']
					];
				}
				else if ($jenis == '8') 
				{
					$data_saldo = [
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik'],
						'kas'		=>$get_saldo_sebelumnya['kas'],
						'beras'		=>$get_saldo_sebelumnya['beras'],
						'lauk'		=>$get_saldo_sebelumnya['lauk'],
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan'],
						'bangunan'	=>$get_saldo_sebelumnya['bangunan'],
						'bantuan'	=>$get_saldo_sebelumnya['bantuan']-$jumlah,
						'infaq'		=>$get_saldo_sebelumnya['infaq']
					];
				}
				

				// input ke tbl saldo
				$this->db->insert('saldo',$data_saldo);
			}

			else
			{
				if ($jenis == '1') {
					$update_saldo = [
						'listrik'	=> $cek_saldo['listrik']-$jumlah
					]; }
				else if ($jenis == '2') {
					$update_saldo = [
						'kas'	=> $cek_saldo['kas']-$jumlah
					]; }
				else if ($jenis == '3') {
					$update_saldo = [
						'beras'	=> $cek_saldo['beras']-$jumlah
					]; }
				else if ($jenis == '4') {
					$update_saldo = [
						'kesehatan'	=> $cek_saldo['kesehatan']-$jumlah
					]; }
				else if ($jenis == '5') {
					$update_saldo = [
						'lauk'	=> $cek_saldo['lauk']-$jumlah
					]; }
				else if ($jenis == '6') {
					$update_saldo = [
						'infaq'	=> $cek_saldo['infaq']-$jumlah
					]; }
				else if ($jenis == '7') {
					$update_saldo = [
						'bangunan'	=> $cek_saldo['bangunan']-$jumlah
					]; }
				else if ($jenis == '8') {
					$update_saldo = [
						'bantuan'	=> $cek_saldo['bantuan']-$jumlah
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
					if ($jenis == '1') {
						$update = array('listrik' => $upd['listrik']-$jumlah);}
					else if ($jenis == '2') {
						$update = array('kas' => $upd['kas']-$jumlah);}
					else if ($jenis == '3') {
						$update = array('beras' => $upd['beras']-$jumlah);}
					else if ($jenis == '4') {
						$update = array('kesehatan' => $upd['kesehatan']-$jumlah);}
					else if ($jenis == '5') {
						$update = array('lauk' => $upd['lauk']-$jumlah);}
					else if ($jenis == '6') {
						$update = array('infaq' => $upd['infaq']-$jumlah);}
					else if ($jenis == '7') {
						$update = array('bangunan' => $upd['bangunan']-$jumlah);}
					else if ($jenis == '8') {
						$update = array('bantuan' => $upd['bantuan']-$jumlah);}


					$this->db->set($update);
					$where = array('tanggal' => $upd['tanggal']);
					$this->db->where($where);
					$this->db->update('saldo');

					$i++;
				}
			}

			$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Data pengeluaran berhasil di input!</div>');
				redirect('Pengeluaran');
		}
	}



	public function ubah_dataPengeluaran($id)
	{
		$this->form_validation->set_rules('date', 'Tanggal','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('jenis', 'Jenis','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('keterangan', 'Keterangan','required|trim', ['required' => 'Data belum di isi!']);
		$this->form_validation->set_rules('jumlah', 'Jumlah','required|trim', ['required' => 'Data belum di isi!']);


		if ($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message','<div class="alert alert-warning shadow" role="alert">Harap mengisi data dengan benar!</div>');
			redirect('Pengeluaran');
			
		}
		else
		{	
			$tgl_transaksi 	= $this->input->post('date');
			$jenis			= $this->input->post('jenis');
			$keterangan		= $this->input->post('keterangan');
			$jumlah 		= $this->input->post('jumlah');
			$pengeluaran_sebelumnya = $this->Keuangan_Model->get_data_Pengeluaran_byId($id);


			// cek tanggal transaksi
			// bila tgal transaksi berbeda dr data sebelumnya/di update
			if ($pengeluaran_sebelumnya['tgl_pengeluaran'] !== $tgl_transaksi) 
			{
				$cek_saldo = $this->Keuangan_Model->cek_saldo_hari_ini($tgl_transaksi);

				// jika tdk ada data di tbl saldo pd tgal yang baru
				if (!$cek_saldo) 
				{
					$get_saldo_sebelumnya = $this->Keuangan_Model->get_saldo_sebelumnya($tgl_transaksi);
				
					$tambah_data_saldo_baru =
					[
						'tanggal'	=>$tgl_transaksi,
						'listrik'	=>$get_saldo_sebelumnya['listrik'],
						'kas'		=>$get_saldo_sebelumnya['kas'],
						'beras'		=>$get_saldo_sebelumnya['beras'],
						'lauk'		=>$get_saldo_sebelumnya['lauk'],
						'kesehatan'	=>$get_saldo_sebelumnya['kesehatan'],
						'bangunan'	=>$get_saldo_sebelumnya['bangunan'],
						'bantuan'	=>$get_saldo_sebelumnya['bantuan'],
						'infaq'		=>$get_saldo_sebelumnya['infaq']
					];
					$this->db->insert('saldo',$tambah_data_saldo_baru);
				}
			}




			// kembalikan saldo kembali
				$cek_saldo = $this->Keuangan_Model->cek_saldo_hari_ini($pengeluaran_sebelumnya['tgl_pengeluaran']);

				if ($pengeluaran_sebelumnya['id_kategori'] == '1') { $update_saldo = ['listrik'	=> $cek_saldo['listrik']+$pengeluaran_sebelumnya['jumlah']];}
				else if ($pengeluaran_sebelumnya['id_kategori'] == '2') { $update_saldo = ['kas'	=> $cek_saldo['kas']+$pengeluaran_sebelumnya['jumlah']];}
				else if ($pengeluaran_sebelumnya['id_kategori'] == '3') { $update_saldo = ['beras'	=> $cek_saldo['beras']+$pengeluaran_sebelumnya['jumlah']];}
				else if ($pengeluaran_sebelumnya['id_kategori'] == '4') { $update_saldo = ['kesehatan'	=> $cek_saldo['kesehatan']+$pengeluaran_sebelumnya['jumlah']];}
				else if ($pengeluaran_sebelumnya['id_kategori'] == '5') { $update_saldo = ['lauk'	=> $cek_saldo['lauk']+$pengeluaran_sebelumnya['jumlah']];}
				else if ($pengeluaran_sebelumnya['id_kategori'] == '6') { $update_saldo = ['infaq'	=> $cek_saldo['infaq']+$pengeluaran_sebelumnya['jumlah']];}
				else if ($pengeluaran_sebelumnya['id_kategori'] == '7') { $update_saldo = ['bangunan'	=> $cek_saldo['bangunan']+$pengeluaran_sebelumnya['jumlah']];}
				else if ($pengeluaran_sebelumnya['id_kategori'] == '8') { $update_saldo = ['bantuan'	=> $cek_saldo['bantuan']+$pengeluaran_sebelumnya['jumlah']];}

				// kembalikan saldo pada tanggal transaksi sebelumnya
				$this->db->set($update_saldo);
				$where = array('tanggal' => $cek_saldo['tanggal']);
				$this->db->where($where);
				$this->db->update('saldo');



				// update saldo pada tanggal selanjutnya
				$get_data_saldo_setelahnya = $this->Keuangan_Model->get_data_saldo_setelahnya($pengeluaran_sebelumnya['tgl_pengeluaran']);

				if ($get_data_saldo_setelahnya) 
				{
					$i=0;
					foreach ($get_data_saldo_setelahnya as $upd) 
					{
						if ($pengeluaran_sebelumnya['id_kategori'] == '1') { $update_saldo = ['listrik'	=> $upd['listrik']+$pengeluaran_sebelumnya['jumlah']];}
						else if ($pengeluaran_sebelumnya['id_kategori'] == '2') { $update_saldo = ['kas'	=> $upd['kas']+$pengeluaran_sebelumnya['jumlah']];}
						else if ($pengeluaran_sebelumnya['id_kategori'] == '3') { $update_saldo = ['beras'	=> $upd['beras']+$pengeluaran_sebelumnya['jumlah']];}
						else if ($pengeluaran_sebelumnya['id_kategori'] == '4') { $update_saldo = ['kesehatan'	=> $upd['kesehatan']+$pengeluaran_sebelumnya['jumlah']];}
						else if ($pengeluaran_sebelumnya['id_kategori'] == '5') { $update_saldo = ['lauk'	=> $upd['lauk']+$pengeluaran_sebelumnya['jumlah']];}
						else if ($pengeluaran_sebelumnya['id_kategori'] == '6') { $update_saldo = ['infaq'	=> $upd['infaq']+$pengeluaran_sebelumnya['jumlah']];}
						else if ($pengeluaran_sebelumnya['id_kategori'] == '7') { $update_saldo = ['bangunan'	=> $upd['bangunan']+$pengeluaran_sebelumnya['jumlah']];}
						else if ($pengeluaran_sebelumnya['id_kategori'] == '8') { $update_saldo = ['bantuan'	=> $upd['bantuan']+$pengeluaran_sebelumnya['jumlah']];}


						$this->db->set($update_saldo);
						$where = array('tanggal' => $upd['tanggal']);
						$this->db->where($where);
						$this->db->update('saldo');

						$i++;
					}
				}
			// akhir kembalikan saldo kembali



			// kurangi saldo sesuai kategori pengeluaran
			$cek_saldo = $this->Keuangan_Model->cek_saldo_hari_ini($tgl_transaksi);
			$get_data_saldo_setelahnya = $this->Keuangan_Model->get_data_saldo_setelahnya($tgl_transaksi);


			if ($jenis == '1') { $kurangi_saldo = ['listrik'	=> $cek_saldo['listrik']-$jumlah];}
			else if ($jenis == '2') { $kurangi_saldo = ['kas'	=> $cek_saldo['kas']-$jumlah];}
			else if ($jenis == '3') { $kurangi_saldo = ['beras'	=> $cek_saldo['beras']-$jumlah];}
			else if ($jenis == '4') { $kurangi_saldo = ['kesehatan'	=> $cek_saldo['kesehatan']-$jumlah];}
			else if ($jenis == '5') { $kurangi_saldo = ['lauk'	=> $cek_saldo['lauk']-$jumlah];}
			else if ($jenis == '6') { $kurangi_saldo = ['infaq'	=> $cek_saldo['infaq']-$jumlah];}
			else if ($jenis == '7') { $kurangi_saldo = ['bangunan'	=> $cek_saldo['bangunan']-$jumlah];}
			else if ($jenis == '8') { $kurangi_saldo = ['bantuan'	=> $cek_saldo['bantuan']-$jumlah];}
			

			// update data ke tbl saldo
			$this->db->set($kurangi_saldo);
			$where = array('tanggal' => $tgl_transaksi);
			$this->db->where($where);
			$this->db->update('saldo');



			// jika ada data saldo pada tgl setelah diupdate data uang
			if ($get_data_saldo_setelahnya) 
			{
				$i=0;
				foreach ($get_data_saldo_setelahnya as $upd) 
				{
					if ($jenis == '1') { $update_saldo = ['listrik'	=> $upd['listrik']-$jumlah];}
					else if ($jenis == '2') { $update_saldo = ['kas'	=> $upd['kas']-$jumlah];}
					else if ($jenis == '3') { $update_saldo = ['beras'	=> $upd['beras']-$jumlah];}
					else if ($jenis == '4') { $update_saldo = ['kesehatan'	=> $upd['kesehatan']-$jumlah];}
					else if ($jenis == '5') { $update_saldo = ['lauk'	=> $upd['lauk']-$jumlah];}
					else if ($jenis == '6') { $update_saldo = ['infaq'	=> $upd['infaq']-$jumlah];}
					else if ($jenis == '7') { $update_saldo = ['bangunan'	=> $upd['bangunan']-$jumlah];}
					else if ($jenis == '8') { $update_saldo = ['bantuan'	=> $upd['bantuan']-$jumlah];}


					$this->db->set($update_saldo);
					$where = array('tanggal' => $upd['tanggal']);
					$this->db->where($where);
					$this->db->update('saldo');

					$i++;
				}
			}


			// siapkan data untuk update data pada tbl pengeluaran
			$data_pengeluaran = [
				'tgl_pengeluaran'	=>$tgl_transaksi,
				'keterangan'		=>$keterangan,
				'jumlah'			=>$jumlah,
				'id_kategori'		=>$jenis
			];

			// update ke tbl pengeluaran
			$this->db->set($data_pengeluaran);
			$where = array('id_pengeluaran' => $id);
			$this->db->where($where);
			$this->db->update('pengeluaran');


			$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Data pegeluaran berhasil di perbaharui!</div>');

			redirect('Pengeluaran');
				
		}

	}




	public function hapus_data_pengeluaran($id)
	{
		$cek_data  = $this->Keuangan_Model->get_data_Pengeluaran_byId($id);
		$cek_saldo = $this->Keuangan_Model->cek_saldo_hari_ini($cek_data['tgl_pengeluaran']);


		 

		if ($cek_data['id_kategori'] == '1') { $update_saldo = ['listrik'	=> $cek_saldo['listrik']+$cek_data['jumlah']];}
		else if ($cek_data['id_kategori'] == '2') { $update_saldo = ['kas'	=> $cek_saldo['kas']+$cek_data['jumlah']];}
		else if ($cek_data['id_kategori'] == '3') { $update_saldo = ['beras'	=> $cek_saldo['beras']+$cek_data['jumlah']];}
		else if ($cek_data['id_kategori'] == '4') { $update_saldo = ['kesehatan'	=> $cek_saldo['kesehatan']+$cek_data['jumlah']];}
		else if ($cek_data['id_kategori'] == '5') { $update_saldo = ['lauk'	=> $cek_saldo['lauk']+$cek_data['jumlah']];}
		else if ($cek_data['id_kategori'] == '6') { $update_saldo = ['infaq'	=> $cek_saldo['infaq']+$cek_data['jumlah']];}
		else if ($cek_data['id_kategori'] == '7') { $update_saldo = ['bangunan'	=> $cek_saldo['bangunan']+$cek_data['jumlah']];}
		else if ($cek_data['id_kategori'] == '8') { $update_saldo = ['bantuan'	=> $cek_saldo['bantuan']+$cek_data['jumlah']];}

		// kembalikan saldo pada tanggal transaksi sebelumnya
		$this->db->set($update_saldo);
		$where = array('tanggal' => $cek_saldo['tanggal']);
		$this->db->where($where);
		$this->db->update('saldo');



		// update saldo pada tanggal selanjutnya
		$get_data_saldo_setelahnya = $this->Keuangan_Model->get_data_saldo_setelahnya($cek_saldo['tanggal']);

		if ($get_data_saldo_setelahnya) 
		{
			$i=0;
			foreach ($get_data_saldo_setelahnya as $upd) 
			{
				if ($pengeluaran_sebelumnya['id_kategori'] == '1') { $update_saldo = ['listrik'	=> $upd['listrik']+$pengeluaran_sebelumnya['jumlah']];}
				else if ($pengeluaran_sebelumnya['id_kategori'] == '2') { $update_saldo = ['kas'	=> $upd['kas']+$pengeluaran_sebelumnya['jumlah']];}
				else if ($pengeluaran_sebelumnya['id_kategori'] == '3') { $update_saldo = ['beras'	=> $upd['beras']+$pengeluaran_sebelumnya['jumlah']];}
				else if ($pengeluaran_sebelumnya['id_kategori'] == '4') { $update_saldo = ['kesehatan'	=> $upd['kesehatan']+$pengeluaran_sebelumnya['jumlah']];}
				else if ($pengeluaran_sebelumnya['id_kategori'] == '5') { $update_saldo = ['lauk'	=> $upd['lauk']+$pengeluaran_sebelumnya['jumlah']];}
				else if ($pengeluaran_sebelumnya['id_kategori'] == '6') { $update_saldo = ['infaq'	=> $upd['infaq']+$pengeluaran_sebelumnya['jumlah']];}
				else if ($pengeluaran_sebelumnya['id_kategori'] == '7') { $update_saldo = ['bangunan'	=> $upd['bangunan']+$pengeluaran_sebelumnya['jumlah']];}
				else if ($pengeluaran_sebelumnya['id_kategori'] == '8') { $update_saldo = ['bantuan'	=> $upd['bantuan']+$pengeluaran_sebelumnya['jumlah']];}


				$this->db->set($update_saldo);
				$where = array('tanggal' => $upd['tanggal']);
				$this->db->where($where);
				$this->db->update('saldo');

				$i++;
			}
		}

		// hapus data di tbl pengeluaran
		$this->db->delete('pengeluaran', array('id_pengeluaran' => $id));

		$this->session->set_flashdata('message','<div class="alert alert-success shadow" style="margin-top:-10%;" role="alert">Data pegeluaran berhasil di hapus!</div>');

		redirect('Pengeluaran');
	}



}