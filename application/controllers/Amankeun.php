<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amankeun extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('id_user'))
		{	
			redirect('Auth');
		}

		$this->load->model('Akun_Model');
		$this->load->model('Santri_Model');
		$this->load->model('Keuangan_Model');
	}

	public function dashboard()
	{
		$data['title'] 		= "Dashboard";
		$data['role_id'] 	= $this->session->userdata('role_id');
		$id_user 			= $this->session->userdata('id_user');
		$data['user'] 		= $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['jml_santri'] = $this->Santri_Model->getJmlSantriAll();
		$bulan 				= date("Y-m");
		$pemasukan_santri 	= $this->Keuangan_Model->getPemasukanBulanIni($bulan);
		$pemasukan_donasi 	= $this->Keuangan_Model->get_data_pemasukan_donasi_bulan_ini($bulan);
		$pengeluaran 		= $this->Keuangan_Model->get_data_pengeluaran_bulan_ini($bulan);
		$get_saldo 			= $this->Keuangan_Model->get_data_saldo_hari_ini(date('Y-m-d'));
		
		// print_r($pemasukan_santri); die();

		if ($get_saldo) 
		{
			$data['saldo']	= $get_saldo['listrik'] + $get_saldo['kas'] + $get_saldo['beras'] + $get_saldo['lauk'] + $get_saldo['kesehatan'] + $get_saldo['bangunan'] + $get_saldo['bantuan'] + $get_saldo['infaq'];
		}
		else
		{
			$data['saldo']	= 0 ;
		}
		 

		$i=0;
		if ($pemasukan_santri) 
		{
			foreach ($pemasukan_santri as $snt) 
			{
				$data['jumlah_pemasukan_santri'][$i] = $snt['jumlah'];
				$i++; 
			}

			if ($pemasukan_donasi) 
			{
				$j=0;
				foreach ($pemasukan_donasi as $dns) 
				{
					$data['jumlah_pemasukan_donasi'][$j] = $dns['jumlah']; 
					$j++;
				}
			}
			else
			{
				$data['jumlah_pemasukan_donasi'][0] = 0;
			}
		}
		else
		{
			$data['jumlah_pemasukan_santri'][0] = 0;

			if ($pemasukan_donasi) 
			{
				$j=0;
				foreach ($pemasukan_donasi as $dns) 
				{
					$data['jumlah_pemasukan_donasi'][$j] = $dns['jumlah']; 
					$j++;
				}
			}
			else
			{
				$data['jumlah_pemasukan_donasi'][0] = 0;
			}
		}



		if ($pengeluaran) 
		{
			foreach ($pengeluaran as $png) 
			{
				$data['jumlah_pengeluaran'][$i] = $png['jumlah'];
				$i++; 
			}

		}
		else
		{
			$data['jumlah_pengeluaran'][0] = 0;
		}



	// data untuk chart
	// bar chart
		$tgl = date('Y-m-d');
		$data['saldo_hari_ini'] = $this->Keuangan_Model->cek_saldo_hari_ini2($tgl);

		$array_saldo[0] = $data['saldo_hari_ini']['listrik'];
		$array_saldo[1] = $data['saldo_hari_ini']['kas'];
		$array_saldo[2] = $data['saldo_hari_ini']['beras'];
		$array_saldo[3] = $data['saldo_hari_ini']['lauk'];
		$array_saldo[4] = $data['saldo_hari_ini']['kesehatan'];
		$array_saldo[5] = $data['saldo_hari_ini']['bangunan'];
		$array_saldo[6] = $data['saldo_hari_ini']['bantuan'];
		$array_saldo[7] = $data['saldo_hari_ini']['infaq'];
		$data['max_saldo'] = max($array_saldo);
	

	// pie chart
		$data['jml_santri_putra'] = $this->Santri_Model->getJmlSantriPutraAktif();
		$data['jml_santri_putri'] = $this->Santri_Model->getJmlSantriPutriAktif();



		$this->load->view('Template/header');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Pengurus/index', $data);
		$this->load->view('Template/footer');		
		$this->load->view('Template/chart_dashboard',$data);
	}


	public function about()
	{
		$data['title'] = "About";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		
		$this->load->view('Template/header');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Template/about');
		$this->load->view('Template/footer');
	}

	public function neraca()
	{
		$data['title'] = "Neraca Keuangan";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] 		= $this->Akun_Model->getInfoAkun_byId($id_user);
		$pemasukan_listrik 	= $this->Keuangan_Model->get_pemasukan_1_tahun('1');
		$pemasukan_kas 		= $this->Keuangan_Model->get_pemasukan_1_tahun('2');
		$pemasukan_beras 	= $this->Keuangan_Model->get_pemasukan_1_tahun('3');
		$pemasukan_kesehatan= $this->Keuangan_Model->get_pemasukan_1_tahun('4');
		$pemasukan_lauk 	= $this->Keuangan_Model->get_pemasukan_1_tahun('5');
		$pemasukan_infaq 	= $this->Keuangan_Model->get_pemasukan_1_tahun('6');
		$pemasukan_bangunan = $this->Keuangan_Model->get_pemasukan_1_tahun('7');
		$pemasukan_bantuan 	= $this->Keuangan_Model->get_pemasukan_bantuan_1_tahun();

		$pengeluaran_listrik 	= $this->Keuangan_Model->get_pengeluaran_1_tahun('1');
		$pengeluaran_kas 		= $this->Keuangan_Model->get_pengeluaran_1_tahun('2');
		$pengeluaran_beras 		= $this->Keuangan_Model->get_pengeluaran_1_tahun('3');
		$pengeluaran_kesehatan	= $this->Keuangan_Model->get_pengeluaran_1_tahun('4');
		$pengeluaran_lauk 		= $this->Keuangan_Model->get_pengeluaran_1_tahun('5');
		$pengeluaran_infaq 		= $this->Keuangan_Model->get_pengeluaran_1_tahun('6');
		$pengeluaran_bangunan	= $this->Keuangan_Model->get_pengeluaran_1_tahun('7');
		$pengeluaran_bantuan 	= $this->Keuangan_Model->get_pengeluaran_1_tahun('8');

		if ($pemasukan_listrik) {
			$i=0;
			foreach ($pemasukan_listrik as $dt) {
				$data['jml_pemasukan_listrik'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pemasukan_listrik'][$i] = 0;
		}

		if ($pemasukan_kas) {
			$i=0;
			foreach ($pemasukan_kas as $dt) {
				$data['jml_pemasukan_kas'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pemasukan_kas'][$i] = 0;
		}

		if ($pemasukan_beras) {
			$i=0;
			foreach ($pemasukan_beras as $dt) {
				$data['jml_pemasukan_beras'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pemasukan_beras'][$i] = 0;
		}

		if ($pemasukan_kesehatan) {
			$i=0;
			foreach ($pemasukan_kesehatan as $dt) {
				$data['jml_pemasukan_kesehatan'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pemasukan_kesehatan'][$i] = 0;
		}

		if ($pemasukan_lauk) {
			$i=0;
			foreach ($pemasukan_lauk as $dt) {
				$data['jml_pemasukan_lauk'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pemasukan_lauk'][$i] = 0;
		}

		if ($pemasukan_infaq) {
			$i=0;
			foreach ($pemasukan_infaq as $dt) {
				$data['jml_pemasukan_infaq'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pemasukan_infaq'][$i] = 0;
		}

		if ($pemasukan_bantuan) {
			$i=0;
			foreach ($pemasukan_bantuan as $dt) {
				$data['jml_pemasukan_bantuan'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pemasukan_bantuan'][$i] = 0;
		}

		if ($pemasukan_bangunan) {
			$i=0;
			foreach ($pemasukan_bangunan as $dt) {
				$data['jml_pemasukan_bangunan'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pemasukan_bangunan'][$i] = 0;
		}





		if ($pengeluaran_listrik) {
			$i=0;
			foreach ($pengeluaran_listrik as $dt) {
				$data['jml_pengeluaran_listrik'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pengeluaran_listrik'][$i] = 0;
		}

		if ($pengeluaran_kas) {
			$i=0;
			foreach ($pengeluaran_kas as $dt) {
				$data['jml_pengeluaran_kas'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pengeluaran_kas'][$i] = 0;
		}

		if ($pengeluaran_beras) {
			$i=0;
			foreach ($pengeluaran_beras as $dt) {
				$data['jml_pengeluaran_beras'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pengeluaran_beras'][$i] = 0;
		}

		if ($pengeluaran_kesehatan) {
			$i=0;
			foreach ($pengeluaran_kesehatan as $dt) {
				$data['jml_pengeluaran_kesehatan'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pengeluaran_kesehatan'][$i] = 0;
		}

		if ($pengeluaran_lauk) {
			$i=0;
			foreach ($pengeluaran_lauk as $dt) {
				$data['jml_pengeluaran_lauk'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pengeluaran_lauk'][$i] = 0;
		}

		if ($pengeluaran_infaq) {
			$i=0;
			foreach ($pengeluaran_infaq as $dt) {
				$data['jml_pengeluaran_infaq'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pengeluaran_infaq'][$i] = 0;
		}

		if ($pengeluaran_bantuan) {
			$i=0;
			foreach ($pengeluaran_bantuan as $dt) {
				$data['jml_pengeluaran_bantuan'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pengeluaran_bantuan'][$i] = 0;
		}

		if ($pengeluaran_bangunan) {
			$i=0;
			foreach ($pengeluaran_bangunan as $dt) {
				$data['jml_pengeluaran_bangunan'][$i] = $dt['jumlah'];
				$i++;
			}
		}else{
			$data['jml_pengeluaran_bangunan'][$i] = 0;
		}
	
// print_r($data['jml_pengeluaran_listrik']); die();

		$this->load->view('Template/header');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Bendahara/neraca',$data);
		$this->load->view('Template/footer');
	}

	public function laporan_keuangan()
	{
		$data['title'] = "Laporan Keuangan";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_user = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_user);
		$data['tahun'] = date('Y');
		$data['bulan'] = ['1','2','3','4','5','6','7','8','9','10','11','12'];

		$j = 6;
		for ($i=0; $i < $j; $i++) 
		{ 
			$data['tahunan'][$i] = $data['tahun']-$i;
		}
		 
		// print_r($data['tahunan']);  
		// echo $data['tahun'];
		// die();

		$this->load->view('Template/header');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Bendahara/laporan', $data);
		$this->load->view('Template/footer',$data);
	}


	public function laporan_kas($bln, $thn)
	{
		$data['title'] = "Laporan Keuangan";
		$data['tahun'] = $this->Akun_Model->get_tahun();
		for ($i=1; $i < 10; $i++) 
		{ 
			if ($thn == $i) 
			{
				$thn = '0'.$i;
			}
		}
		$data_pengeluaran   = $this->Keuangan_Model->get_data_pengeluaran('2',$bln,$thn);
		$data_pemasukan 	= $this->Keuangan_Model->get_data_pemasukan('2',$bln,$thn);
		$jml_pengeluaran   	= $this->Keuangan_Model->get_jml_data_pengeluaran('2',$bln,$thn);
		$jml_pemasukan 		= $this->Keuangan_Model->get_jml_data_pemasukan('2',$bln,$thn);
		$data['th']	   = $thn;
		$data['bulan'] = $bln;
		$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan('2',$bln,$thn);
		$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan($bln,$thn);
		
		$jml_data = $jml_pemasukan+$jml_pengeluaran;

		if ($jml_data) 
		{
			
			for ($i=0; $i < $jml_data; $i++) 
			{ 
				if ($i < $jml_pemasukan) 
				{
					$data['kas'][$i] =
						[
							'kd'		=> 'pem',
							'id'		=>  $data_pemasukan[$i]['id_pembayaran'],
							'tgl'		=>	$data_pemasukan[$i]['tgl_bayar'],
							'keterangan'=>  'Pembayaran uang listrik '.$data_pemasukan[$i]['nama'].' untuk bulan '. 
										substr($data_pemasukan[$i]['bulan_bayar'],5,2).'-'.substr($data_pemasukan[$i]['bulan_bayar'],0,4),
							'jumlah'	=>	$data_pemasukan[$i]['jumlah']
						];				
				}
				
				else if ($i >= $jml_pemasukan) 
				{
					$data['kas'][$i] =
						[
							'kd'		=> 'pen',
							'id'		=>  $data_pengeluaran[$i-$jml_pemasukan]['id_pengeluaran'],
							'tgl'		=>	$data_pengeluaran[$i-$jml_pemasukan]['tgl_pengeluaran'],
							'keterangan'=>  $data_pengeluaran[$i-$jml_pemasukan]['keterangan'],
							'jumlah'	=>	$data_pengeluaran[$i-$jml_pemasukan]['jumlah']
						];		
				}
			}
		}
		else
		{
			$data['kas'] = 0;
		}

		if (!$data['saldo_awal_bln']) 
		{
			$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan2($bln,$thn);
		}

		if (!$data['saldo_akhir_bln']) 
		{
			$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan2($bln,$thn);
		}


		$this->load->view('Template/header_datatable');
		$this->load->view('Laporan/kas', $data);
		$this->load->view('Template/footer_laporan', $data);
	}


	public function laporan_listrik($bln, $thn)
	{
		$data['title'] = "Laporan Keuangan";
		$data['tahun'] = $this->Akun_Model->get_tahun();
		for ($i=1; $i < 10; $i++) 
		{ 
			if ($thn == $i) 
			{
				$thn = '0'.$i;
			}
		}

		
		$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan('1',$bln,$thn);
		$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan($bln,$thn);
		$data_pengeluaran   = $this->Keuangan_Model->get_data_pengeluaran('1',$bln,$thn);
		$data_pemasukan 	= $this->Keuangan_Model->get_data_pemasukan('1',$bln,$thn);
		$jml_pengeluaran   	= $this->Keuangan_Model->get_jml_data_pengeluaran('1',$bln,$thn);
		$jml_pemasukan 		= $this->Keuangan_Model->get_jml_data_pemasukan('1',$bln,$thn);
		$data['th']	   		= $thn;
		$data['bulan'] = $bln;
		$jml_data = $jml_pemasukan+$jml_pengeluaran;

		if ($jml_data) 
		{
			for ($i=0; $i < $jml_data; $i++) 
			{ 
				if ($i < $jml_pemasukan) 
				{
					$data['listrik'][$i] =
						[
							'kd'		=> 'pem',
							'id'		=>  $data_pemasukan[$i]['id_pembayaran'],
							'tgl'		=>	$data_pemasukan[$i]['tgl_bayar'],
							'keterangan'=>  'Pembayaran uang listrik '.$data_pemasukan[$i]['nama'].' untuk bulan '. 
										substr($data_pemasukan[$i]['bulan_bayar'],5,2).'-'.substr($data_pemasukan[$i]['bulan_bayar'],0,4),
							'jumlah'	=>	$data_pemasukan[$i]['jumlah']
						];				
				}
				
				else if ($i >= $jml_pemasukan) 
				{
					$data['listrik'][$i] =
						[
							'kd'		=> 'pen',
							'id'		=>  $data_pengeluaran[$i-$jml_pemasukan]['id_pengeluaran'],
							'tgl'		=>	$data_pengeluaran[$i-$jml_pemasukan]['tgl_pengeluaran'],
							'keterangan'=>  $data_pengeluaran[$i-$jml_pemasukan]['keterangan'],
							'jumlah'	=>	$data_pengeluaran[$i-$jml_pemasukan]['jumlah']
						];		
				}
			}
		}
		else
		{
			$data['listrik'] = 0;
		}


		if (!$data['saldo_awal_bln']) 
		{
			$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan2($bln,$thn);
		}

		if (!$data['saldo_akhir_bln']) 
		{
			$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan2($bln,$thn);
		}
		
// print_r($data['saldo_akhir_bln1']); die();
		$this->load->view('Template/header_datatable');
		$this->load->view('Laporan/listrik', $data);
		$this->load->view('Template/footer_laporan', $data);
	}


	public function laporan_beras($bln, $thn)
	{
		$data['title'] = "Laporan Keuangan";
		$data['tahun'] = $this->Akun_Model->get_tahun();
		for ($i=1; $i < 10; $i++) 
		{ 
			if ($thn == $i) 
			{
				$thn = '0'.$i;
			}
		}
		$data_pengeluaran   = $this->Keuangan_Model->get_data_pengeluaran('3',$bln,$thn);
		$data_pemasukan 	= $this->Keuangan_Model->get_data_pemasukan('3',$bln,$thn);
		$jml_pengeluaran   	= $this->Keuangan_Model->get_jml_data_pengeluaran('3',$bln,$thn);
		$jml_pemasukan 		= $this->Keuangan_Model->get_jml_data_pemasukan('3',$bln,$thn);
		$data['th']	   = $thn;
		$data['bulan'] = $bln;
		$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan('3',$bln,$thn);
		$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan($bln,$thn);
		
		$jml_data = $jml_pemasukan+$jml_pengeluaran;

		if ($jml_data) 
		{
			
			for ($i=0; $i < $jml_data; $i++) 
			{ 
				if ($i < $jml_pemasukan) 
				{
					$data['beras'][$i] =
						[
							'kd'		=> 'pem',
							'id'		=>  $data_pemasukan[$i]['id_pembayaran'],
							'tgl'		=>	$data_pemasukan[$i]['tgl_bayar'],
							'keterangan'=>  'Pembayaran uang listrik '.$data_pemasukan[$i]['nama'].' untuk bulan '. 
										substr($data_pemasukan[$i]['bulan_bayar'],5,2).'-'.substr($data_pemasukan[$i]['bulan_bayar'],0,4),
							'jumlah'	=>	$data_pemasukan[$i]['jumlah']
						];				
				}
				
				else if ($i >= $jml_pemasukan) 
				{
					$data['beras'][$i] =
						[
							'kd'		=> 'pen',
							'id'		=>  $data_pengeluaran[$i-$jml_pemasukan]['id_pengeluaran'],
							'tgl'		=>	$data_pengeluaran[$i-$jml_pemasukan]['tgl_pengeluaran'],
							'keterangan'=>  $data_pengeluaran[$i-$jml_pemasukan]['keterangan'],
							'jumlah'	=>	$data_pengeluaran[$i-$jml_pemasukan]['jumlah']
						];		
				}
			}
		}
		else
		{
			$data['beras'] = 0;
		}

		if (!$data['saldo_awal_bln']) 
		{
			$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan2($bln,$thn);
		}

		if (!$data['saldo_akhir_bln']) 
		{
			$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan2($bln,$thn);
		}

		$this->load->view('Template/header_datatable');
		$this->load->view('Laporan/beras', $data);
		$this->load->view('Template/footer_laporan', $data);
	}

	public function laporan_kesehatan($bln, $thn)
	{
		$data['title'] = "Laporan Keuangan";
		$data['tahun'] = $this->Akun_Model->get_tahun();
		for ($i=1; $i < 10; $i++) 
		{ 
			if ($thn == $i) 
			{
				$thn = '0'.$i;
			}
		}
		$data_pengeluaran   = $this->Keuangan_Model->get_data_pengeluaran('4',$bln,$thn);
		$data_pemasukan 	= $this->Keuangan_Model->get_data_pemasukan('4',$bln,$thn);
		$jml_pengeluaran   	= $this->Keuangan_Model->get_jml_data_pengeluaran('4',$bln,$thn);
		$jml_pemasukan 		= $this->Keuangan_Model->get_jml_data_pemasukan('4',$bln,$thn);
		$data['th']	   = $thn;
		$data['bulan'] = $bln;
		$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan('4',$bln,$thn);
		$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan($bln,$thn);
		
		$jml_data = $jml_pemasukan+$jml_pengeluaran;

		if ($jml_data) 
		{
			
			for ($i=0; $i < $jml_data; $i++) 
			{ 
				if ($i < $jml_pemasukan) 
				{
					$data['kesehatan'][$i] =
						[
							'kd'		=> 'pem',
							'id'		=>  $data_pemasukan[$i]['id_pembayaran'],
							'tgl'		=>	$data_pemasukan[$i]['tgl_bayar'],
							'keterangan'=>  'Pembayaran uang listrik '.$data_pemasukan[$i]['nama'].' untuk bulan '. 
										substr($data_pemasukan[$i]['bulan_bayar'],5,2).'-'.substr($data_pemasukan[$i]['bulan_bayar'],0,4),
							'jumlah'	=>	$data_pemasukan[$i]['jumlah']
						];				
				}
				
				else if ($i >= $jml_pemasukan) 
				{
					$data['kesehatan'][$i] =
						[
							'kd'		=> 'pen',
							'id'		=>  $data_pengeluaran[$i-$jml_pemasukan]['id_pengeluaran'],
							'tgl'		=>	$data_pengeluaran[$i-$jml_pemasukan]['tgl_pengeluaran'],
							'keterangan'=>  $data_pengeluaran[$i-$jml_pemasukan]['keterangan'],
							'jumlah'	=>	$data_pengeluaran[$i-$jml_pemasukan]['jumlah']
						];		
				}
			}
		}
		else
		{
			$data['kesehatan'] = 0;
		}


		if (!$data['saldo_awal_bln']) 
		{
			$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan2($bln,$thn);
		}

		if (!$data['saldo_akhir_bln']) 
		{
			$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan2($bln,$thn);
		}
		// echo $data['bulan']; die();
// print_r($data['saldo_awal_bln']);
// print_r($data['saldo_akhir_bln']); die();
		$this->load->view('Template/header_datatable');
		$this->load->view('Laporan/kesehatan', $data);
		$this->load->view('Template/footer_laporan', $data);
	}

	public function laporan_lauk($bln, $thn)
	{
		$data['title'] = "Laporan Keuangan";
		$data['tahun'] = $this->Akun_Model->get_tahun();
		for ($i=1; $i < 10; $i++) 
		{ 
			if ($thn == $i) 
			{
				$thn = '0'.$i;
			}
		}
		$data_pengeluaran   = $this->Keuangan_Model->get_data_pengeluaran('5',$bln,$thn);
		$data_pemasukan 	= $this->Keuangan_Model->get_data_pemasukan('5',$bln,$thn);
		$jml_pengeluaran   	= $this->Keuangan_Model->get_jml_data_pengeluaran('5',$bln,$thn);
		$jml_pemasukan 		= $this->Keuangan_Model->get_jml_data_pemasukan('5',$bln,$thn);
		$data['th']	   = $thn;
		$data['bulan'] = $bln;
		$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan('5',$bln,$thn);
		$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan($bln,$thn);
		
		$jml_data = $jml_pemasukan+$jml_pengeluaran;

		if ($jml_data) 
		{
			
			for ($i=0; $i < $jml_data; $i++) 
			{ 
				if ($i < $jml_pemasukan) 
				{
					$data['lauk'][$i] =
						[
							'kd'		=> 'pem',
							'id'		=>  $data_pemasukan[$i]['id_pembayaran'],
							'tgl'		=>	$data_pemasukan[$i]['tgl_bayar'],
							'keterangan'=>  'Pembayaran uang listrik '.$data_pemasukan[$i]['nama'].' untuk bulan '. 
										substr($data_pemasukan[$i]['bulan_bayar'],5,2).'-'.substr($data_pemasukan[$i]['bulan_bayar'],0,4),
							'jumlah'	=>	$data_pemasukan[$i]['jumlah']
						];				
				}
				
				else if ($i >= $jml_pemasukan) 
				{
					$data['lauk'][$i] =
						[
							'kd'		=> 'pen',
							'id'		=>  $data_pengeluaran[$i-$jml_pemasukan]['id_pengeluaran'],
							'tgl'		=>	$data_pengeluaran[$i-$jml_pemasukan]['tgl_pengeluaran'],
							'keterangan'=>  $data_pengeluaran[$i-$jml_pemasukan]['keterangan'],
							'jumlah'	=>	$data_pengeluaran[$i-$jml_pemasukan]['jumlah']
						];		
				}
			}
		}
		else
		{
			$data['lauk'] = 0;
		}


		if (!$data['saldo_awal_bln']) 
		{
			$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan2($bln,$thn);
		}

		if (!$data['saldo_akhir_bln']) 
		{
			$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan2($bln,$thn);
		}


		$this->load->view('Template/header_datatable');
		$this->load->view('Laporan/lauk', $data);
		$this->load->view('Template/footer_laporan', $data);
	}


	public function laporan_infaq($bln, $thn)
	{
		$data['title'] = "Laporan Keuangan";
		$data['tahun'] = $this->Akun_Model->get_tahun();
		for ($i=1; $i < 10; $i++) 
		{ 
			if ($thn == $i) 
			{
				$thn = '0'.$i;
			}
		}
		$data_pengeluaran   = $this->Keuangan_Model->get_data_pengeluaran('6',$bln,$thn);
		$data_pemasukan 	= $this->Keuangan_Model->get_data_pemasukan('6',$bln,$thn);
		$jml_pengeluaran   	= $this->Keuangan_Model->get_jml_data_pengeluaran('6',$bln,$thn);
		$jml_pemasukan 		= $this->Keuangan_Model->get_jml_data_pemasukan('6',$bln,$thn);
		$data['th']	   = $thn;
		$data['bulan'] = $bln;
		$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan('6',$bln,$thn);
		$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan($bln,$thn);
		
		$jml_data = $jml_pemasukan+$jml_pengeluaran;

		if ($jml_data) 
		{
			
			for ($i=0; $i < $jml_data; $i++) 
			{ 
				if ($i < $jml_pemasukan) 
				{
					$data['infaq'][$i] =
						[
							'kd'		=> 'pem',
							'id'		=>  $data_pemasukan[$i]['id_pembayaran'],
							'tgl'		=>	$data_pemasukan[$i]['tgl_bayar'],
							'keterangan'=>  'Pembayaran uang listrik '.$data_pemasukan[$i]['nama'].' untuk bulan '. 
										substr($data_pemasukan[$i]['bulan_bayar'],5,2).'-'.substr($data_pemasukan[$i]['bulan_bayar'],0,4),
							'jumlah'	=>	$data_pemasukan[$i]['jumlah']
						];				
				}
				
				else if ($i >= $jml_pemasukan) 
				{
					$data['infaq'][$i] =
						[
							'kd'		=> 'pen',
							'id'		=>  $data_pengeluaran[$i-$jml_pemasukan]['id_pengeluaran'],
							'tgl'		=>	$data_pengeluaran[$i-$jml_pemasukan]['tgl_pengeluaran'],
							'keterangan'=>  $data_pengeluaran[$i-$jml_pemasukan]['keterangan'],
							'jumlah'	=>	$data_pengeluaran[$i-$jml_pemasukan]['jumlah']
						];		
				}
			}
		}
		else
		{
			$data['infaq'] = 0;
		}



		if (!$data['saldo_awal_bln']) 
		{
			$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan2($bln,$thn);
		}

		if (!$data['saldo_akhir_bln']) 
		{
			$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan2($bln,$thn);
		}


		$this->load->view('Template/header_datatable');
		$this->load->view('Laporan/infaq', $data);
		$this->load->view('Template/footer_laporan', $data);
	}


	public function laporan_bangunan($bln, $thn)
	{
		$data['title'] = "Laporan Keuangan";
		$data['tahun'] = $this->Akun_Model->get_tahun();
		for ($i=1; $i < 10; $i++) 
		{ 
			if ($thn == $i) 
			{
				$thn = '0'.$i;
			}
		}
		$data_pengeluaran   = $this->Keuangan_Model->get_data_pengeluaran('7',$bln,$thn);
		$data_pemasukan 	= $this->Keuangan_Model->get_data_pemasukan('7',$bln,$thn);
		$jml_pengeluaran   	= $this->Keuangan_Model->get_jml_data_pengeluaran('7',$bln,$thn);
		$jml_pemasukan 		= $this->Keuangan_Model->get_jml_data_pemasukan('7',$bln,$thn);
		$data['th']	   = $thn;
		$data['bulan'] = $bln;
		$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan('7',$bln,$thn);
		$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan($bln,$thn);
		
		$jml_data = $jml_pemasukan+$jml_pengeluaran;

		if ($jml_data) 
		{
			
			for ($i=0; $i < $jml_data; $i++) 
			{ 
				if ($i < $jml_pemasukan) 
				{
					$data['bangunan'][$i] =
						[
							'kd'		=> 'pem',
							'id'		=>  $data_pemasukan[$i]['id_pembayaran'],
							'tgl'		=>	$data_pemasukan[$i]['tgl_bayar'],
							'keterangan'=>  'Pembayaran uang listrik '.$data_pemasukan[$i]['nama'].' untuk bulan '. 
										substr($data_pemasukan[$i]['bulan_bayar'],5,2).'-'.substr($data_pemasukan[$i]['bulan_bayar'],0,4),
							'jumlah'	=>	$data_pemasukan[$i]['jumlah']
						];				
				}
				
				else if ($i >= $jml_pemasukan) 
				{
					$data['bangunan'][$i] =
						[
							'kd'		=> 'pen',
							'id'		=>  $data_pengeluaran[$i-$jml_pemasukan]['id_pengeluaran'],
							'tgl'		=>	$data_pengeluaran[$i-$jml_pemasukan]['tgl_pengeluaran'],
							'keterangan'=>  $data_pengeluaran[$i-$jml_pemasukan]['keterangan'],
							'jumlah'	=>	$data_pengeluaran[$i-$jml_pemasukan]['jumlah']
						];		
				}
			}
		}
		else
		{
			$data['bangunan'] = 0;
		}


		if (!$data['saldo_awal_bln']) 
		{
			$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan2($bln,$thn);
		}

		if (!$data['saldo_akhir_bln']) 
		{
			$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan2($bln,$thn);
		}


		$this->load->view('Template/header_datatable');
		$this->load->view('Laporan/bangunan', $data);
		$this->load->view('Template/footer_laporan', $data);
	}


	public function laporan_bantuan($bln, $thn)
	{
		$data['title'] = "Laporan Keuangan";
		$data['tahun'] = $this->Akun_Model->get_tahun();
		for ($i=1; $i < 10; $i++) 
		{ 
			if ($bln == $i) 
			{
				$bln = '0'.$i;
			}
		}
		$data_pengeluaran   = $this->Keuangan_Model->get_data_pengeluaran('8',$bln,$thn);
		$data_pemasukan 	= $this->Keuangan_Model->get_data_pemasukan_bantuan('8',$bln,$thn);
		$jml_pengeluaran   	= $this->Keuangan_Model->get_jml_data_pengeluaran('8',$bln,$thn);
		$jml_pemasukan 		= $this->Keuangan_Model->get_jml_data_pemasukan_bantuan('8',$bln,$thn);

		
		$data['th']	   = $thn;
		$data['bulan'] = $bln;
		$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan('8',$bln,$thn);
		$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan($bln,$thn);
		// print_r($data['saldo_awal_bln']);
		// die();

		$jml_data = $jml_pemasukan+$jml_pengeluaran;

		if ($jml_data) 
		{
			
			for ($i=0; $i < $jml_data; $i++) 
			{ 
				if ($i < $jml_pemasukan) 
				{
					$data['bantuan'][$i] =
						[
							'kd'		=> 'pem',
							'id'		=>  $data_pemasukan[$i]['id_bantuan'],
							'tgl'		=>	$data_pemasukan[$i]['tgl_bantuan'],
							'keterangan'=>  $data_pemasukan[$i]['keterangan'],
							'jumlah'	=>	$data_pemasukan[$i]['jumlah']
						];				
				}
				
				else if ($i >= $jml_pemasukan) 
				{
					$data['bantuan'][$i] =
						[
							'kd'		=> 'pen',
							'id'		=>  $data_pengeluaran[$i-$jml_pemasukan]['id_pengeluaran'],
							'tgl'		=>	$data_pengeluaran[$i-$jml_pemasukan]['tgl_pengeluaran'],
							'keterangan'=>  $data_pengeluaran[$i-$jml_pemasukan]['keterangan'],
							'jumlah'	=>	$data_pengeluaran[$i-$jml_pemasukan]['jumlah']
						];		
				}
			}
		}
		else
		{
			$data['bantuan'] = 0;
		}
		

		if (!$data['saldo_awal_bln']) 
		{
			$data['saldo_awal_bln'] = $this->Keuangan_Model->get_data_saldo_awal_bulan2($bln,$thn);
		}

		if (!$data['saldo_akhir_bln']) 
		{
			$data['saldo_akhir_bln'] = $this->Keuangan_Model->get_data_saldo_akhir_bulan2($bln,$thn);
		}
		
		$this->load->view('Template/header_datatable');
		$this->load->view('Laporan/bantuan', $data);
		$this->load->view('Template/footer_laporan', $data);
	}

	public function detail_bangunan($id_santri)
	{
		$data['santri'] = $this->Santri_Model->getDataSantriByIdSantri($id_santri);

		$data['biaya'] 	= $this->Keuangan_Model->get_pembayaran_uang_bangunan_byIdSantri($id_santri);

		$this->load->view('Template/header_datatable');
		$this->load->view('Laporan/detail_pembayaran_uang_bangunan_santri',$data);
		$this->load->view('Template/footer_laporan', $data);
	}

	public function data_santri()
	{
		$data['title'] = "Data Santri";
		$data['role_id'] = $this->session->userdata('role_id');
		$id_pengurus = $this->session->userdata('id_user');
		$data['user'] = $this->Akun_Model->getInfoAkun_byId($id_pengurus);
		$data['santri'] = $this->Santri_Model->getDataSantriAll();

		$data['angkatan'] = $this->Santri_Model->getDataAngkatan();
// print_r($data['santri'][0]); die();
		$this->load->view('Template/header_datatable');
		$this->load->view('Template/sidebar', $data);
		$this->load->view('Template/navbar');
		$this->load->view('Pengurus/dataSantri', $data);
		$this->load->view('Template/footer_datatable');
	}

}