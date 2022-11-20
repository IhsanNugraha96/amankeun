<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ekspor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('id_user'))
		{	
			redirect('Auth');
		}

		$this->load->model('Ekspor_Model');
	}

	public function Laporan($id_ekspor)
	{
		if ($id_ekspor == '1' || $id_ekspor == '2') //Laporan Harian & Mingguan
		{
			$tgal 			= $this->input->post('hari');
			$pilihan_data 	= $this->input->post('pilihan');
		}
		else if ($id_ekspor == '3') //Laporan Bulanan
		{
			$bulan 			= $this->input->post('bulan');
			$tahun 			= $this->input->post('tahun');
			$pilihan_data 	= $this->input->post('pilihan');
			$tgal 			= $tahun.'-'.$bulan.'-01'; 

			// $akhir = $tahun.'-'.$bulan.'-32';
		}
		else if ($id_ekspor == '4') //Laporan Bulanan
		{
			$tahun 			= $this->input->post('tahun');
			$pilihan_data 	= $this->input->post('pilihan');
			$tgal 			= $tahun; 

			// $akhir = $tahun.'-'.$bulan.'-32';
		}

		// echo $akhir; die();

		if ($id_ekspor == '1') //Laporan Harian
		{
			// data uang listrik
			$dpng_listrik   		= $this->Ekspor_Model->get_data_pengeluaran_hari('1',$tgal);
			$dpm_listrik 			= $this->Ekspor_Model->get_data_pemasukan_hari('1',$tgal);
			$jml_pm_listrik			= $this->Ekspor_Model->get_jml_data_pemasukan_hari('1',$tgal);
			$jml_png_listrik		= $this->Ekspor_Model->get_jml_data_pengeluaran_hari('1',$tgal);
			$saldo_awal_listrik 	= $this->Ekspor_Model->get_data_saldo_awal_hari('1',$tgal);
			$saldo_akhir_listrik	= $this->Ekspor_Model->get_data_saldo_akhir_hari('1',$tgal);
		// print_r($saldo_akhir_listrik); die();

		// data uang kas
			$dpng_kas   		= $this->Ekspor_Model->get_data_pengeluaran_hari('2',$tgal);
			$dpm_kas 			= $this->Ekspor_Model->get_data_pemasukan_hari('2',$tgal);
			$jml_pm_kas			= $this->Ekspor_Model->get_jml_data_pemasukan_hari('2',$tgal);
			$jml_png_kas		= $this->Ekspor_Model->get_jml_data_pengeluaran_hari('2',$tgal);
			$saldo_awal_kas 	= $this->Ekspor_Model->get_data_saldo_awal_hari('2',$tgal);
			$saldo_akhir_kas	= $this->Ekspor_Model->get_data_saldo_akhir_hari('2',$tgal);

		// data uang beras
			$dpng_beras   		= $this->Ekspor_Model->get_data_pengeluaran_hari('3',$tgal);
			$dpm_beras 			= $this->Ekspor_Model->get_data_pemasukan_hari('3',$tgal);
			$jml_pm_beras		= $this->Ekspor_Model->get_jml_data_pemasukan_hari('3',$tgal);
			$jml_png_beras		= $this->Ekspor_Model->get_jml_data_pengeluaran_hari('3',$tgal);
			$saldo_awal_beras 	= $this->Ekspor_Model->get_data_saldo_awal_hari('3',$tgal);
			$saldo_akhir_beras	= $this->Ekspor_Model->get_data_saldo_akhir_hari('3',$tgal);

		// data uang kesehatan
			$dpng_kesehatan   		= $this->Ekspor_Model->get_data_pengeluaran_hari('4',$tgal);
			$dpm_kesehatan 			= $this->Ekspor_Model->get_data_pemasukan_hari('4',$tgal);
			$jml_pm_kesehatan		= $this->Ekspor_Model->get_jml_data_pemasukan_hari('4',$tgal);
			$jml_png_kesehatan		= $this->Ekspor_Model->get_jml_data_pengeluaran_hari('4',$tgal);
			$saldo_awal_kesehatan 	= $this->Ekspor_Model->get_data_saldo_awal_hari('4',$tgal);
			$saldo_akhir_kesehatan	= $this->Ekspor_Model->get_data_saldo_akhir_hari('4',$tgal);

		// data uang lauk
			$dpng_lauk   		= $this->Ekspor_Model->get_data_pengeluaran_hari('5',$tgal);
			$dpm_lauk 			= $this->Ekspor_Model->get_data_pemasukan_hari('5',$tgal);
			$jml_pm_lauk		= $this->Ekspor_Model->get_jml_data_pemasukan_hari('5',$tgal);
			$jml_png_lauk		= $this->Ekspor_Model->get_jml_data_pengeluaran_hari('5',$tgal);
			$saldo_awal_lauk 	= $this->Ekspor_Model->get_data_saldo_awal_hari('5',$tgal);
			$saldo_akhir_lauk	= $this->Ekspor_Model->get_data_saldo_akhir_hari('5',$tgal);

		// data uang infaq
			$dpng_infaq   		= $this->Ekspor_Model->get_data_pengeluaran_hari('6',$tgal);
			$dpm_infaq 			= $this->Ekspor_Model->get_data_pemasukan_hari('6',$tgal);
			$jml_pm_infaq		= $this->Ekspor_Model->get_jml_data_pemasukan_hari('6',$tgal);
			$jml_png_infaq		= $this->Ekspor_Model->get_jml_data_pengeluaran_hari('6',$tgal);
			$saldo_awal_infaq 	= $this->Ekspor_Model->get_data_saldo_awal_hari('6',$tgal);
			$saldo_akhir_infaq	= $this->Ekspor_Model->get_data_saldo_akhir_hari('6',$tgal);

		// data uang bangunan
			$dpng_bangunan   		= $this->Ekspor_Model->get_data_pengeluaran_hari('7',$tgal);
			$dpm_bangunan 			= $this->Ekspor_Model->get_data_pemasukan_hari('7',$tgal);
			$jml_pm_bangunan		= $this->Ekspor_Model->get_jml_data_pemasukan_hari('7',$tgal);
			$jml_png_bangunan		= $this->Ekspor_Model->get_jml_data_pengeluaran_hari('7',$tgal);
			$saldo_awal_bangunan 	= $this->Ekspor_Model->get_data_saldo_awal_hari('7',$tgal);
			$saldo_akhir_bangunan	= $this->Ekspor_Model->get_data_saldo_akhir_hari('7',$tgal);

		// data uang bantuan
			$dpng_bantuan   		= $this->Ekspor_Model->get_data_pengeluaran_hari('8',$tgal);
			$dpm_bantuan 			= $this->Ekspor_Model->get_data_pemasukan_hari('8',$tgal);
			$jml_pm_bantuan			= $this->Ekspor_Model->get_jml_data_pemasukan_hari('8',$tgal);
			$jml_png_bantuan		= $this->Ekspor_Model->get_jml_data_pengeluaran_hari('8',$tgal);
			$saldo_awal_bantuan 	= $this->Ekspor_Model->get_data_saldo_awal_hari('8',$tgal);
			$saldo_akhir_bantuan	= $this->Ekspor_Model->get_data_saldo_akhir_hari('8',$tgal);
		}

		else if ($id_ekspor == '2') //Laporan Mingguan
		{
			// 7 hari = 604800 detik

			$hitung_tgal_akhir = strtotime($tgal) + 604799;
			$tgal_akhir = date('Y-m-d', $hitung_tgal_akhir);
			// echo $tgal." - ".$tgal_akhir; die();

			// data uang listrik
			$dpng_listrik   		= $this->Ekspor_Model->get_data_pengeluaran_minggu('1',$tgal,$tgal_akhir);
			$dpm_listrik 			= $this->Ekspor_Model->get_data_pemasukan_minggu('1',$tgal,$tgal_akhir);
			$jml_pm_listrik			= $this->Ekspor_Model->get_jml_data_pemasukan_minggu('1',$tgal,$tgal_akhir);
			$jml_png_listrik		= $this->Ekspor_Model->get_jml_data_pengeluaran_minggu('1',$tgal,$tgal_akhir);
			$saldo_awal_listrik 	= $this->Ekspor_Model->get_data_saldo_awal_minggu('1',$tgal,$tgal_akhir);
			$saldo_akhir_listrik	= $this->Ekspor_Model->get_data_saldo_akhir_minggu('1',$tgal,$tgal_akhir);
		

		// data uang kas
			$dpng_kas   		= $this->Ekspor_Model->get_data_pengeluaran_minggu('2',$tgal,$tgal_akhir);
			$dpm_kas 			= $this->Ekspor_Model->get_data_pemasukan_minggu('2',$tgal,$tgal_akhir);
			$jml_pm_kas			= $this->Ekspor_Model->get_jml_data_pemasukan_minggu('2',$tgal,$tgal_akhir);
			$jml_png_kas		= $this->Ekspor_Model->get_jml_data_pengeluaran_minggu('2',$tgal,$tgal_akhir);
			$saldo_awal_kas 	= $this->Ekspor_Model->get_data_saldo_awal_minggu('2',$tgal,$tgal_akhir);
			$saldo_akhir_kas	= $this->Ekspor_Model->get_data_saldo_akhir_minggu('2',$tgal,$tgal_akhir);

		// data uang beras
			$dpng_beras   		= $this->Ekspor_Model->get_data_pengeluaran_minggu('3',$tgal,$tgal_akhir);
			$dpm_beras 			= $this->Ekspor_Model->get_data_pemasukan_minggu('3',$tgal,$tgal_akhir);
			$jml_pm_beras		= $this->Ekspor_Model->get_jml_data_pemasukan_minggu('3',$tgal,$tgal_akhir);
			$jml_png_beras		= $this->Ekspor_Model->get_jml_data_pengeluaran_minggu('3',$tgal,$tgal_akhir);
			$saldo_awal_beras 	= $this->Ekspor_Model->get_data_saldo_awal_minggu('3',$tgal,$tgal_akhir);
			$saldo_akhir_beras	= $this->Ekspor_Model->get_data_saldo_akhir_minggu('3',$tgal,$tgal_akhir);

		// data uang kesehatan
			$dpng_kesehatan   		= $this->Ekspor_Model->get_data_pengeluaran_minggu('4',$tgal,$tgal_akhir);
			$dpm_kesehatan 			= $this->Ekspor_Model->get_data_pemasukan_minggu('4',$tgal,$tgal_akhir);
			$jml_pm_kesehatan		= $this->Ekspor_Model->get_jml_data_pemasukan_minggu('4',$tgal,$tgal_akhir);
			$jml_png_kesehatan		= $this->Ekspor_Model->get_jml_data_pengeluaran_minggu('4',$tgal,$tgal_akhir);
			$saldo_awal_kesehatan 	= $this->Ekspor_Model->get_data_saldo_awal_minggu('4',$tgal,$tgal_akhir);
			$saldo_akhir_kesehatan	= $this->Ekspor_Model->get_data_saldo_akhir_minggu('4',$tgal,$tgal_akhir);

		// data uang lauk
			$dpng_lauk   		= $this->Ekspor_Model->get_data_pengeluaran_minggu('5',$tgal,$tgal_akhir);
			$dpm_lauk 			= $this->Ekspor_Model->get_data_pemasukan_minggu('5',$tgal,$tgal_akhir);
			$jml_pm_lauk		= $this->Ekspor_Model->get_jml_data_pemasukan_minggu('5',$tgal,$tgal_akhir);
			$jml_png_lauk		= $this->Ekspor_Model->get_jml_data_pengeluaran_minggu('5',$tgal,$tgal_akhir);
			$saldo_awal_lauk 	= $this->Ekspor_Model->get_data_saldo_awal_minggu('5',$tgal,$tgal_akhir);
			$saldo_akhir_lauk	= $this->Ekspor_Model->get_data_saldo_akhir_minggu('5',$tgal,$tgal_akhir);

		// data uang infaq
			$dpng_infaq   		= $this->Ekspor_Model->get_data_pengeluaran_minggu('6',$tgal,$tgal_akhir);
			$dpm_infaq 			= $this->Ekspor_Model->get_data_pemasukan_minggu('6',$tgal,$tgal_akhir);
			$jml_pm_infaq		= $this->Ekspor_Model->get_jml_data_pemasukan_minggu('6',$tgal,$tgal_akhir);
			$jml_png_infaq		= $this->Ekspor_Model->get_jml_data_pengeluaran_minggu('6',$tgal,$tgal_akhir);
			$saldo_awal_infaq 	= $this->Ekspor_Model->get_data_saldo_awal_minggu('6',$tgal,$tgal_akhir);
			$saldo_akhir_infaq	= $this->Ekspor_Model->get_data_saldo_akhir_minggu('6',$tgal,$tgal_akhir);

		// data uang bangunan
			$dpng_bangunan   		= $this->Ekspor_Model->get_data_pengeluaran_minggu('7',$tgal,$tgal_akhir);
			$dpm_bangunan 			= $this->Ekspor_Model->get_data_pemasukan_minggu('7',$tgal,$tgal_akhir);
			$jml_pm_bangunan		= $this->Ekspor_Model->get_jml_data_pemasukan_minggu('7',$tgal,$tgal_akhir);
			$jml_png_bangunan		= $this->Ekspor_Model->get_jml_data_pengeluaran_minggu('7',$tgal,$tgal_akhir);
			$saldo_awal_bangunan 	= $this->Ekspor_Model->get_data_saldo_awal_minggu('7',$tgal,$tgal_akhir);
			$saldo_akhir_bangunan	= $this->Ekspor_Model->get_data_saldo_akhir_minggu('7',$tgal,$tgal_akhir);

		// data uang bantuan
			$dpng_bantuan   		= $this->Ekspor_Model->get_data_pengeluaran_minggu('8',$tgal,$tgal_akhir);
			$dpm_bantuan 			= $this->Ekspor_Model->get_data_pemasukan_minggu('8',$tgal,$tgal_akhir);
			$jml_pm_bantuan			= $this->Ekspor_Model->get_jml_data_pemasukan_minggu('8',$tgal,$tgal_akhir);
			$jml_png_bantuan		= $this->Ekspor_Model->get_jml_data_pengeluaran_minggu('8',$tgal,$tgal_akhir);
			$saldo_awal_bantuan 	= $this->Ekspor_Model->get_data_saldo_awal_minggu('8',$tgal,$tgal_akhir);
			$saldo_akhir_bantuan	= $this->Ekspor_Model->get_data_saldo_akhir_minggu('8',$tgal,$tgal_akhir);
		}


		else if ($id_ekspor == '3') //Laporan Bulanan
		{
			
		// data uang listrik
			$dpng_listrik   		= $this->Ekspor_Model->get_data_pengeluaran_bulan('1',$bulan,$tahun);
			$dpm_listrik 			= $this->Ekspor_Model->get_data_pemasukan_bulan('1',$bulan,$tahun);
			$jml_pm_listrik			= $this->Ekspor_Model->get_jml_data_pemasukan_bulan('1',$bulan,$tahun);
			$jml_png_listrik		= $this->Ekspor_Model->get_jml_data_pengeluaran_bulan('1',$bulan,$tahun);
			$saldo_awal_listrik 	= $this->Ekspor_Model->get_data_saldo_awal_bulan('1',$bulan,$tahun);
			$saldo_akhir_listrik	= $this->Ekspor_Model->get_data_saldo_akhir_bulan('1',$bulan,$tahun);
		

		// data uang kas
			$dpng_kas   		= $this->Ekspor_Model->get_data_pengeluaran_bulan('2',$bulan,$tahun);
			$dpm_kas 			= $this->Ekspor_Model->get_data_pemasukan_bulan('2',$bulan,$tahun);
			$jml_pm_kas			= $this->Ekspor_Model->get_jml_data_pemasukan_bulan('2',$bulan,$tahun);
			$jml_png_kas		= $this->Ekspor_Model->get_jml_data_pengeluaran_bulan('2',$bulan,$tahun);
			$saldo_awal_kas 	= $this->Ekspor_Model->get_data_saldo_awal_bulan('2',$bulan,$tahun);
			$saldo_akhir_kas	= $this->Ekspor_Model->get_data_saldo_akhir_bulan('2',$bulan,$tahun);

		// data uang beras
			$dpng_beras   		= $this->Ekspor_Model->get_data_pengeluaran_bulan('3',$bulan,$tahun);
			$dpm_beras 			= $this->Ekspor_Model->get_data_pemasukan_bulan('3',$bulan,$tahun);
			$jml_pm_beras		= $this->Ekspor_Model->get_jml_data_pemasukan_bulan('3',$bulan,$tahun);
			$jml_png_beras		= $this->Ekspor_Model->get_jml_data_pengeluaran_bulan('3',$bulan,$tahun);
			$saldo_awal_beras 	= $this->Ekspor_Model->get_data_saldo_awal_bulan('3',$bulan,$tahun);
			$saldo_akhir_beras	= $this->Ekspor_Model->get_data_saldo_akhir_bulan('3',$bulan,$tahun);

		// data uang kesehatan
			$dpng_kesehatan   		= $this->Ekspor_Model->get_data_pengeluaran_bulan('4',$bulan,$tahun);
			$dpm_kesehatan 			= $this->Ekspor_Model->get_data_pemasukan_bulan('4',$bulan,$tahun);
			$jml_pm_kesehatan		= $this->Ekspor_Model->get_jml_data_pemasukan_bulan('4',$bulan,$tahun);
			$jml_png_kesehatan		= $this->Ekspor_Model->get_jml_data_pengeluaran_bulan('4',$bulan,$tahun);
			$saldo_awal_kesehatan 	= $this->Ekspor_Model->get_data_saldo_awal_bulan('4',$bulan,$tahun);
			$saldo_akhir_kesehatan	= $this->Ekspor_Model->get_data_saldo_akhir_bulan('4',$bulan,$tahun);

		// data uang lauk
			$dpng_lauk   		= $this->Ekspor_Model->get_data_pengeluaran_bulan('5',$bulan,$tahun);
			$dpm_lauk 			= $this->Ekspor_Model->get_data_pemasukan_bulan('5',$bulan,$tahun);
			$jml_pm_lauk		= $this->Ekspor_Model->get_jml_data_pemasukan_bulan('5',$bulan,$tahun);
			$jml_png_lauk		= $this->Ekspor_Model->get_jml_data_pengeluaran_bulan('5',$bulan,$tahun);
			$saldo_awal_lauk 	= $this->Ekspor_Model->get_data_saldo_awal_bulan('5',$bulan,$tahun);
			$saldo_akhir_lauk	= $this->Ekspor_Model->get_data_saldo_akhir_bulan('5',$bulan,$tahun);

		// data uang infaq
			$dpng_infaq   		= $this->Ekspor_Model->get_data_pengeluaran_bulan('6',$bulan,$tahun);
			$dpm_infaq 			= $this->Ekspor_Model->get_data_pemasukan_bulan('6',$bulan,$tahun);
			$jml_pm_infaq		= $this->Ekspor_Model->get_jml_data_pemasukan_bulan('6',$bulan,$tahun);
			$jml_png_infaq		= $this->Ekspor_Model->get_jml_data_pengeluaran_bulan('6',$bulan,$tahun);
			$saldo_awal_infaq 	= $this->Ekspor_Model->get_data_saldo_awal_bulan('6',$bulan,$tahun);
			$saldo_akhir_infaq	= $this->Ekspor_Model->get_data_saldo_akhir_bulan('6',$bulan,$tahun);

		// data uang bangunan
			$dpng_bangunan   		= $this->Ekspor_Model->get_data_pengeluaran_bulan('7',$bulan,$tahun);
			$dpm_bangunan 			= $this->Ekspor_Model->get_data_pemasukan_bulan('7',$bulan,$tahun);
			$jml_pm_bangunan		= $this->Ekspor_Model->get_jml_data_pemasukan_bulan('7',$bulan,$tahun);
			$jml_png_bangunan		= $this->Ekspor_Model->get_jml_data_pengeluaran_bulan('7',$bulan,$tahun);
			$saldo_awal_bangunan 	= $this->Ekspor_Model->get_data_saldo_awal_bulan('7',$bulan,$tahun);
			$saldo_akhir_bangunan	= $this->Ekspor_Model->get_data_saldo_akhir_bulan('7',$bulan,$tahun);

		// data uang bantuan
			$dpng_bantuan   		= $this->Ekspor_Model->get_data_pengeluaran_bulan('8',$bulan,$tahun);
			$dpm_bantuan 			= $this->Ekspor_Model->get_data_pemasukan_bulan('8',$bulan,$tahun);
			$jml_pm_bantuan			= $this->Ekspor_Model->get_jml_data_pemasukan_bulan('8',$bulan,$tahun);
			$jml_png_bantuan		= $this->Ekspor_Model->get_jml_data_pengeluaran_bulan('8',$bulan,$tahun);
			$saldo_awal_bantuan 	= $this->Ekspor_Model->get_data_saldo_awal_bulan('8',$bulan,$tahun);
			$saldo_akhir_bantuan	= $this->Ekspor_Model->get_data_saldo_akhir_bulan('8',$bulan,$tahun);
		}




	else if ($id_ekspor == '4') //Laporan Tahunan
		{
			
		// data uang listrik
			$dpng_listrik   		= $this->Ekspor_Model->get_data_pengeluaran_tahun('1',$tahun);
			$dpm_listrik 			= $this->Ekspor_Model->get_data_pemasukan_tahun('1',$tahun);
			$jml_pm_listrik			= $this->Ekspor_Model->get_jml_data_pemasukan_tahun('1',$tahun);
			$jml_png_listrik		= $this->Ekspor_Model->get_jml_data_pengeluaran_tahun('1',$tahun);
			$saldo_awal_listrik 	= $this->Ekspor_Model->get_data_saldo_awal_tahun('1',$tahun);
			$saldo_akhir_listrik	= $this->Ekspor_Model->get_data_saldo_akhir_tahun('1',$tahun);
		

		// data uang kas
			$dpng_kas   		= $this->Ekspor_Model->get_data_pengeluaran_tahun('2',$tahun);
			$dpm_kas 			= $this->Ekspor_Model->get_data_pemasukan_tahun('2',$tahun);
			$jml_pm_kas			= $this->Ekspor_Model->get_jml_data_pemasukan_tahun('2',$tahun);
			$jml_png_kas		= $this->Ekspor_Model->get_jml_data_pengeluaran_tahun('2',$tahun);
			$saldo_awal_kas 	= $this->Ekspor_Model->get_data_saldo_awal_tahun('2',$tahun);
			$saldo_akhir_kas	= $this->Ekspor_Model->get_data_saldo_akhir_tahun('2',$tahun);

		// data uang beras
			$dpng_beras   		= $this->Ekspor_Model->get_data_pengeluaran_tahun('3',$tahun);
			$dpm_beras 			= $this->Ekspor_Model->get_data_pemasukan_tahun('3',$tahun);
			$jml_pm_beras		= $this->Ekspor_Model->get_jml_data_pemasukan_tahun('3',$tahun);
			$jml_png_beras		= $this->Ekspor_Model->get_jml_data_pengeluaran_tahun('3',$tahun);
			$saldo_awal_beras 	= $this->Ekspor_Model->get_data_saldo_awal_tahun('3',$tahun);
			$saldo_akhir_beras	= $this->Ekspor_Model->get_data_saldo_akhir_tahun('3',$tahun);

		// data uang kesehatan
			$dpng_kesehatan   		= $this->Ekspor_Model->get_data_pengeluaran_tahun('4',$tahun);
			$dpm_kesehatan 			= $this->Ekspor_Model->get_data_pemasukan_tahun('4',$tahun);
			$jml_pm_kesehatan		= $this->Ekspor_Model->get_jml_data_pemasukan_tahun('4',$tahun);
			$jml_png_kesehatan		= $this->Ekspor_Model->get_jml_data_pengeluaran_tahun('4',$tahun);
			$saldo_awal_kesehatan 	= $this->Ekspor_Model->get_data_saldo_awal_tahun('4',$tahun);
			$saldo_akhir_kesehatan	= $this->Ekspor_Model->get_data_saldo_akhir_tahun('4',$tahun);

		// data uang lauk
			$dpng_lauk   		= $this->Ekspor_Model->get_data_pengeluaran_tahun('5',$tahun);
			$dpm_lauk 			= $this->Ekspor_Model->get_data_pemasukan_tahun('5',$tahun);
			$jml_pm_lauk		= $this->Ekspor_Model->get_jml_data_pemasukan_tahun('5',$tahun);
			$jml_png_lauk		= $this->Ekspor_Model->get_jml_data_pengeluaran_tahun('5',$tahun);
			$saldo_awal_lauk 	= $this->Ekspor_Model->get_data_saldo_awal_tahun('5',$tahun);
			$saldo_akhir_lauk	= $this->Ekspor_Model->get_data_saldo_akhir_tahun('5',$tahun);

		// data uang infaq
			$dpng_infaq   		= $this->Ekspor_Model->get_data_pengeluaran_tahun('6',$tahun);
			$dpm_infaq 			= $this->Ekspor_Model->get_data_pemasukan_tahun('6',$tahun);
			$jml_pm_infaq		= $this->Ekspor_Model->get_jml_data_pemasukan_tahun('6',$tahun);
			$jml_png_infaq		= $this->Ekspor_Model->get_jml_data_pengeluaran_tahun('6',$tahun);
			$saldo_awal_infaq 	= $this->Ekspor_Model->get_data_saldo_awal_tahun('6',$tahun);
			$saldo_akhir_infaq	= $this->Ekspor_Model->get_data_saldo_akhir_tahun('6',$tahun);

		// data uang bangunan
			$dpng_bangunan   		= $this->Ekspor_Model->get_data_pengeluaran_tahun('7',$tahun);
			$dpm_bangunan 			= $this->Ekspor_Model->get_data_pemasukan_tahun('7',$tahun);
			$jml_pm_bangunan		= $this->Ekspor_Model->get_jml_data_pemasukan_tahun('7',$tahun);
			$jml_png_bangunan		= $this->Ekspor_Model->get_jml_data_pengeluaran_tahun('7',$tahun);
			$saldo_awal_bangunan 	= $this->Ekspor_Model->get_data_saldo_awal_tahun('7',$tahun);
			$saldo_akhir_bangunan	= $this->Ekspor_Model->get_data_saldo_akhir_tahun('7',$tahun);

		// data uang bantuan
			$dpng_bantuan   		= $this->Ekspor_Model->get_data_pengeluaran_tahun('8',$tahun);
			$dpm_bantuan 			= $this->Ekspor_Model->get_data_pemasukan_tahun('8',$tahun);
			$jml_pm_bantuan			= $this->Ekspor_Model->get_jml_data_pemasukan_tahun('8',$tahun);
			$jml_png_bantuan		= $this->Ekspor_Model->get_jml_data_pengeluaran_tahun('8',$tahun);
			$saldo_awal_bantuan 	= $this->Ekspor_Model->get_data_saldo_awal_tahun('8',$tahun);
			$saldo_akhir_bantuan	= $this->Ekspor_Model->get_data_saldo_akhir_tahun('8',$tahun);
		}
		
		
		
		// print_r($jml_pm_bangunan); die();
		



		require(APPPATH. 'PHPExcel/PHPExcel.php');
		require(APPPATH. 'PHPExcel/PHPExcel/Writer/Excel2007.php');


		$object = new PHPExcel();
		$object->getProperties()->setCreator("AMANKEUN");
		$object->getProperties()->setLastModifiedBy("AMANKEUN");

		if ($pilihan_data == '1') {$object->getProperties()->setTitle("Data Laporan Keuangan Listrik Tanggal ".$tgal);}
		else if ($pilihan_data == '2') {$object->getProperties()->setTitle("Data Laporan Keuangan Kas Tanggal ".$tgal);}
		else if ($pilihan_data == '3') {$object->getProperties()->setTitle("Data Laporan Keuangan Beras Tanggal ".$tgal);}
		else if ($pilihan_data == '4') {$object->getProperties()->setTitle("Data Laporan Keuangan Kesehatan Tanggal ".$tgal);}
		else if ($pilihan_data == '5') {$object->getProperties()->setTitle("Data Laporan Keuangan Lauk Tanggal ".$tgal);}
		else if ($pilihan_data == '6') {$object->getProperties()->setTitle("Data Laporan Keuangan Infaq Tanggal ".$tgal);}
		else if ($pilihan_data == '7') {$object->getProperties()->setTitle("Data Laporan Keuangan Bangunan Tanggal ".$tgal);}
		else if ($pilihan_data == '8') {$object->getProperties()->setTitle("Data Laporan Keuangan Bantuan Tanggal ".$tgal);}
		// else if ($pilihan_data == '9') {$object->getProperties()->setTitle("Data Laporan Keuangan Tanggal ".$tgal);}



			// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		      'font' => array('bold' => true), // Set font nya jadi bold
		      'alignment' => array(
		        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		    ),
		      'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		    )
		  );

		    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
		      	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		    ),
			'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		    )
		);

		$style_angka = array(
			'alignment' => array(
		      	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, // Set text jadi ditengah secara horizontal (center)
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		    ),
			'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		    )
		);



		$object->setActiveSheetIndex(0);
		$object->getActiveSheet()->setCellValue('A2', "LAPORAN DATA KEUANGAN"); // Set kolom A2 dengan tulisan "LAPORAN DATA KEUANGAN"
		$object->getActiveSheet()->mergeCells('A2:E2'); // Set Merge Cell pada kolom A2 sampai E2
		$object->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A2
		$object->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 12 untuk kolom A2
		$object->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A2

		$object->getActiveSheet()->setCellValue('A3', "PONDOK PESANTREN (...)"); // Set kolom A3 dengan tulisan "PONDOK PESANTREN ...."
		$object->getActiveSheet()->mergeCells('A3:E3'); // Set Merge Cell pada kolom A3 sampai E3
		$object->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A3
		$object->getActiveSheet()->getStyle('A3')->getFont()->setSize(12); // Set font size 12 untuk kolom A3
		$object->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A3


		$object->getActiveSheet()->setCellValue('D4', "Data : "); // Set kolom E4 
		$object->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // Set text


		if ($id_ekspor == '1') //Laporan Harian
		{ $object->getActiveSheet()->setCellValue('E4', substr($tgal,8,2)."/".substr($tgal,5,2)."/".substr($tgal,0,4));} // Set kolom E4 
		else if ($id_ekspor == '2') //Laporan Mingguan
		{ $object->getActiveSheet()->setCellValue('E4', substr($tgal,8,2)."/".substr($tgal,5,2)."/".substr($tgal,0,4)."  -  ". substr($tgal_akhir,8,2)."/".substr($tgal_akhir,5,2)."/".substr($tgal_akhir,0,4));} // Set kolom E4 
		else if ($id_ekspor == '3') //Laporan Bulanan
		{ $object->getActiveSheet()->setCellValue('E4', "Bulan ".substr($tgal,5,2)."/".substr($tgal,0,4));} // Set kolom E4 
		else if ($id_ekspor == '4') //Laporan Tahunan
		{ $object->getActiveSheet()->setCellValue('E4', "Tahun ".substr($tgal,0,4));} // Set kolom E4 

		$object->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); // Set text 
		// print_r($dpm_kas); die();

		if ($pilihan_data == '1') 
			{$this->_listrik($dpng_listrik,$dpm_listrik,$jml_pm_listrik,$jml_png_listrik,$saldo_awal_listrik,$saldo_akhir_listrik,$style_col,$style_row,$style_angka,$object);}
		else if ($pilihan_data == '2'){ $this->_kas($dpng_kas,$dpm_kas,$jml_pm_kas,$jml_png_kas,$saldo_awal_kas,$saldo_akhir_kas,$style_col,$style_row,$style_angka,$object);}
		else if ($pilihan_data == '3') 
			{$this->_beras($dpng_beras,$dpm_beras,$jml_pm_beras,$jml_png_beras,$saldo_awal_beras,$saldo_akhir_beras,$style_col,$style_row,$style_angka,$object);}
		else if ($pilihan_data == '4') 
			{$this->_kesehatan($dpng_kesehatan,$dpm_kesehatan,$jml_pm_kesehatan,$jml_png_kesehatan,$saldo_awal_kesehatan,$saldo_akhir_kesehatan,$style_col,$style_row,$style_angka,$object);}
		else if ($pilihan_data == '5') 
			{$this->_lauk($dpng_lauk,$dpm_lauk,$jml_pm_lauk,$jml_png_lauk,$saldo_awal_lauk,$saldo_akhir_lauk,$style_col,$style_row,$style_angka,$object);}
		else if ($pilihan_data == '6') 
			{$this->_infaq($dpng_infaq,$dpm_infaq,$jml_pm_infaq,$jml_png_infaq,$saldo_awal_infaq,$saldo_akhir_infaq,$style_col,$style_row,$style_angka,$object);}
		else if ($pilihan_data == '7') 
			{$this->_bangunan($dpng_bangunan,$dpm_bangunan,$jml_pm_bangunan,$jml_png_bangunan,$saldo_awal_bangunan,$saldo_akhir_bangunan,$style_col,$style_row,$style_angka,$object);}
		else if ($pilihan_data == '8') 
			{$this->_bantuan($dpng_bantuan,$dpm_bantuan,$jml_pm_bantuan,$jml_png_bantuan,$saldo_awal_bantuan,$saldo_akhir_bantuan,$style_col,$style_row,$style_angka,$object);}
		


		// Set width kolom
		$object->getActiveSheet()->getColumnDimension('A')->setAutoSize(true); // Set width kolom A
		$object->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); // Set width kolom B
		$object->getActiveSheet()->getColumnDimension('C')->setAutoSize(true); // Set width kolom C
		$object->getActiveSheet()->getColumnDimension('D')->setAutoSize(true); // Set width kolom D
		$object->getActiveSheet()->getColumnDimension('E')->setAutoSize(true); // Set width kolom E
		

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$object->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$object->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		if ($id_ekspor == '1') 
		{
			$filename="Data Laporan Keuangan Harian Per Tanggal ".$tgal.'.xlsx';
			$object->getActiveSheet()->setTitle("Data Laporan Keuangan Harian");
		}
		else if ($id_ekspor == '2') 
		{
			$filename="Data Laporan Keuangan Mingguan".'.xlsx';
			$object->getActiveSheet()->setTitle("Data Laporan Keuangan Mingguan");
		}
		else if ($id_ekspor == '3') 
		{
			$filename="Data Laporan Keuangan Bulanan".'.xlsx';
			$object->getActiveSheet()->setTitle("Data Laporan Keuangan Bulanan");
		}
		else if ($id_ekspor == '4') 
		{
			$filename="Data Laporan Keuangan Tahunan".'.xlsx';
			$object->getActiveSheet()->setTitle("Data Laporan Keuangan Tahunan");
		}
		

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename. '"');
		header('Cache-Control: max-age=0');

		$writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
		$writer->save('php://output');

		exit;
	}


	public function export_harian_awal($id,$object,$style_row,$style_col)
	{
		// colom A5
		if ($id == '1') { $object->getActiveSheet()->setCellValue('A5', "1. Uang Listrik");}
		else if ($id == '2') { $object->getActiveSheet()->setCellValue('A5', "2. Uang Kas");}
		else if ($id == '3') { $object->getActiveSheet()->setCellValue('A5', "3. Uang Beras");}
		else if ($id == '4') { $object->getActiveSheet()->setCellValue('A5', "4. Uang Kesehatan");}
		else if ($id == '5') { $object->getActiveSheet()->setCellValue('A5', "5. Uang Lauk");}
		else if ($id == '6') { $object->getActiveSheet()->setCellValue('A5', "6. Uang Infaq");}
		else if ($id == '7') { $object->getActiveSheet()->setCellValue('A5', "7. Uang Bangunan");}
		else if ($id == '8') { $object->getActiveSheet()->setCellValue('A5', "8. Uang Bantuan");}

	 	// Set kolom A5 dengan tulisan "tersebut"
		$object->getActiveSheet()->mergeCells('A5:E5'); // Set Merge Cell pada kolom A5 sampai E5
		$object->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE); // Set bold kolom A5
		$object->getActiveSheet()->getStyle('A5')->getFont()->setSize(11); // Set font size 12 untuk kolom A5
		$object->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A5

		// colom A7
		$object->getActiveSheet()->setCellValue('A7', "Data Pemasukan"); // Set kolom A8 dengan tulisan "Saldo Awal"
		$object->getActiveSheet()->mergeCells('A7:E7'); // Set Merge Cell pada kolom A8 sampai E8
		$object->getActiveSheet()->getStyle('A7')->getFont()->setBold(TRUE); // Set bold kolom A8
		$object->getActiveSheet()->getStyle('A7:E7')->getFont()->setSize(11); // Set font size 12 untuk kolom A8
		$object->getActiveSheet()->getStyle('A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A7
		$object->getActiveSheet()->getStyle('A7')->applyFromArray($style_row);
		$object->getActiveSheet()->getStyle('A7:E7')->applyFromArray($style_row);




		$object->getActiveSheet()->setCellValue('A8', 'No.');
		$object->getActiveSheet()->setCellValue('B8', 'Tanggal');
		$object->getActiveSheet()->setCellValue('C8', 'Nama Santri');
		$object->getActiveSheet()->setCellValue('D8', 'Keterangan');
		$object->getActiveSheet()->setCellValue('E8', 'Jumlah (Rp)');


		//Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$object->getActiveSheet()->getStyle('A8')->applyFromArray($style_col);
		$object->getActiveSheet()->getStyle('B8')->applyFromArray($style_col);
		$object->getActiveSheet()->getStyle('C8')->applyFromArray($style_col);
		$object->getActiveSheet()->getStyle('D8')->applyFromArray($style_col);
		$object->getActiveSheet()->getStyle('E8')->applyFromArray($style_col);

		// colom A6
		$object->getActiveSheet()->setCellValue('A9', "Saldo Awal :"); // Set kolom A7 dengan tulisan "Saldo Awal"
		$object->getActiveSheet()->mergeCells('A9:D9'); // Set Merge Cell pada kolom A7 sampai D7
		$object->getActiveSheet()->getStyle('A9')->getFont()->setBold(TRUE); // Set bold kolom A7
		$object->getActiveSheet()->getStyle('A9:E9')->getFont()->setSize(11); // Set font size 12 untuk kolom A7
		$object->getActiveSheet()->getStyle('A9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A7
	}


	public function export_harian_akhir($id,$object,$style_row,$style_col,$style_angka,$dpm,$dpng,$saldo_akhir)
	{
		$no = 1;
		$baris = 10;

		if ($dpm) 
		{
			foreach ($dpm as $dt) 
			{
				$object->getActiveSheet()->setCellValue('A'.$baris, $no);
				$object->getActiveSheet()->setCellValue('B'.$baris, substr($dt['tgl_bayar'],8,2)."/".substr($dt['tgl_bayar'],5,2)."/".substr($dt['tgl_bayar'],0,4));
				$object->getActiveSheet()->setCellValue('C'.$baris, $dt['nama']);

				if ($id == '1') { $object->getActiveSheet()->setCellValue('D'.$baris, "Pembayaran uang listrik untuk bulan ".substr($dt['bulan_bayar'],5,2)."/".substr($dt['bulan_bayar'],0,4) );}
				else if ($id == '2') { $object->getActiveSheet()->setCellValue('D'.$baris, "Pembayaran uang kas untuk bulan ".substr($dt['bulan_bayar'],5,2)."/".substr($dt['bulan_bayar'],0,4) );}
				else if ($id == '3') { $object->getActiveSheet()->setCellValue('D'.$baris, "Pembayaran uang beras untuk bulan ".substr($dt['bulan_bayar'],5,2)."/".substr($dt['bulan_bayar'],0,4) );}
				else if ($id == '4') { $object->getActiveSheet()->setCellValue('D'.$baris, "Pembayaran uang kesehatan untuk bulan ".substr($dt['bulan_bayar'],5,2)."/".substr($dt['bulan_bayar'],0,4) );}
				else if ($id == '5') { $object->getActiveSheet()->setCellValue('D'.$baris, "Pembayaran uang lauk untuk bulan ".substr($dt['bulan_bayar'],5,2)."/".substr($dt['bulan_bayar'],0,4) );}
				else if ($id == '6') { $object->getActiveSheet()->setCellValue('D'.$baris, "Pembayaran uang infaq untuk bulan ".substr($dt['bulan_bayar'],5,2)."/".substr($dt['bulan_bayar'],0,4) );}
				else if ($id == '7') { $object->getActiveSheet()->setCellValue('D'.$baris, "Pembayaran uang bangunan ");}

				
				
				$object->getActiveSheet()->setCellValue('E'.$baris, $dt['jumlah']);


					// Apply style header yang telah kita buat tadi ke masing-masing kolom header
				$object->getActiveSheet()->getStyle('A'.$baris)->applyFromArray($style_row);
				$object->getActiveSheet()->getStyle('A'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
				$object->getActiveSheet()->getStyle('B'.$baris)->applyFromArray($style_row);
				$object->getActiveSheet()->getStyle('B'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$object->getActiveSheet()->getStyle('C'.$baris)->applyFromArray($style_row);
				$object->getActiveSheet()->getStyle('D'.$baris)->applyFromArray($style_row);
				$object->getActiveSheet()->getStyle('E'.$baris)->applyFromArray($style_angka);

				$no++;
				$baris++;
			}
		}
		else
		{
			$object->getActiveSheet()->setCellValue('A'.$baris, "Tidak ada pemasukan!"); 
			$object->getActiveSheet()->mergeCells('A'.$baris.':E'.$baris);
			$object->getActiveSheet()->getStyle('A'.$baris)->getFont()->setBold(FALSE); 
			$object->getActiveSheet()->getStyle('A'.$baris.':E'.$baris)->getFont()->setSize(11); 
			$object->getActiveSheet()->getStyle('A'.$baris.':E'.$baris)->applyFromArray($style_row);
			$object->getActiveSheet()->getStyle('A'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

			$baris++;
		}


		$baris2 = $baris+2; 

		$object->getActiveSheet()->setCellValue('A'.$baris2, "Data Pengeluaran");
		$object->getActiveSheet()->mergeCells('A'.$baris2.':E'.$baris2); 
		$object->getActiveSheet()->getStyle('A'.$baris2)->getFont()->setBold(TRUE); 
		$object->getActiveSheet()->getStyle('A'.$baris2.':E'.$baris2)->getFont()->setSize(11);
		$object->getActiveSheet()->getStyle('A'.$baris2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
		$object->getActiveSheet()->getStyle('A'.$baris2.':E'.$baris2)->applyFromArray($style_row);


		$no = 1;
		$baris3 = $baris2+1;
		if ($dpng) 
		{


			foreach ($dpng as $dt) 
			{
				$object->getActiveSheet()->setCellValue('A'.$baris3, $no);
				$object->getActiveSheet()->setCellValue('B'.$baris3, substr($dt['tgl_pengeluaran'],8,2)."/".substr($dt['tgl_pengeluaran'],5,2)."/".substr($dt['tgl_pengeluaran'],0,4));
				$object->getActiveSheet()->setCellValue('C'.$baris3, '');
				$object->getActiveSheet()->setCellValue('D'.$baris3, $dt['keterangan']);
				$object->getActiveSheet()->setCellValue('E'.$baris3, "-".$dt['jumlah']);


					// Apply style header yang telah kita buat tadi ke masing-masing kolom header
				$object->getActiveSheet()->getStyle('A'.$baris3)->applyFromArray($style_row);
				$object->getActiveSheet()->getStyle('A'.$baris3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$object->getActiveSheet()->getStyle('B'.$baris3)->applyFromArray($style_row);		    		
				$object->getActiveSheet()->getStyle('B'.$baris3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$object->getActiveSheet()->getStyle('C'.$baris3)->applyFromArray($style_row);
				$object->getActiveSheet()->getStyle('D'.$baris3)->applyFromArray($style_row);
				$object->getActiveSheet()->getStyle('E'.$baris3)->applyFromArray($style_angka);

				$no++;
				$baris3++;
			}
		}
		else 
		{
		    	// print_r($saldo_akhir_listrik); die();
			$object->getActiveSheet()->setCellValue('A'.$baris3, "Tidak ada pengeluaran!"); 
			$object->getActiveSheet()->mergeCells('A'.$baris3.':E'.$baris3);
			$object->getActiveSheet()->getStyle('A'.$baris3)->getFont()->setBold(FALSE); 
			$object->getActiveSheet()->getStyle('A'.$baris3.':E'.$baris3)->getFont()->setSize(11); 
			$object->getActiveSheet()->getStyle('A'.$baris3.':E'.$baris3)->applyFromArray($style_row);
			$object->getActiveSheet()->getStyle('A'.$baris3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

			$baris3++;
		}


		$object->getActiveSheet()->setCellValue('A'.$baris3, "Saldo Akhir :"); 
		$object->getActiveSheet()->mergeCells('A'.$baris3.':D'.$baris3);
		$object->getActiveSheet()->getStyle('A'.$baris3)->getFont()->setBold(TRUE);
		$object->getActiveSheet()->getStyle('A'.$baris3.':E'.$baris3)->getFont()->setSize(11);
		$object->getActiveSheet()->getStyle('A'.$baris3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		if ($id == '1') {$object->getActiveSheet()->setCellValue('E'.$baris3, $saldo_akhir['listrik']);}
		else if ($id == '2') { $object->getActiveSheet()->setCellValue('E'.$baris3, $saldo_akhir['kas']);}
		else if ($id == '3') { $object->getActiveSheet()->setCellValue('E'.$baris3, $saldo_akhir['beras']);}
		else if ($id == '4') { $object->getActiveSheet()->setCellValue('E'.$baris3, $saldo_akhir['kesehatan']);}
		else if ($id == '5') { $object->getActiveSheet()->setCellValue('E'.$baris3, $saldo_akhir['lauk']);}
		else if ($id == '6') { $object->getActiveSheet()->setCellValue('E'.$baris3, $saldo_akhir['infaq']);}
		else if ($id == '7') { $object->getActiveSheet()->setCellValue('E'.$baris3, $saldo_akhir['bangunan']);}
		else if ($id == '8') { $object->getActiveSheet()->setCellValue('E'.$baris3, $saldo_akhir['bantuan']);}


		$object->getActiveSheet()->getStyle('A'.$baris3.':D'.$baris3)->applyFromArray($style_row);
		$object->getActiveSheet()->getStyle('E'.$baris3)->applyFromArray($style_angka);
	}

	public function export_harian_bantuan_awal($id,$object,$style_row,$style_col)
	{
		// colom A5
		$object->getActiveSheet()->setCellValue('A5', "8. Uang Bantuan");

	 	// Set kolom A5 dengan tulisan "tersebut"
		$object->getActiveSheet()->mergeCells('A5:D5'); // Set Merge Cell pada kolom A5 sampai E5
		$object->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE); // Set bold kolom A5
		$object->getActiveSheet()->getStyle('A5')->getFont()->setSize(11); // Set font size 12 untuk kolom A5
		$object->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A5

		// colom A7
		$object->getActiveSheet()->setCellValue('A7', "Data Pemasukan"); // Set kolom A8 dengan tulisan "Saldo Awal"
		$object->getActiveSheet()->mergeCells('A7:D7'); // Set Merge Cell pada kolom A8 sampai E8
		$object->getActiveSheet()->getStyle('A7')->getFont()->setBold(TRUE); // Set bold kolom A8
		$object->getActiveSheet()->getStyle('A7:D7')->getFont()->setSize(11); // Set font size 12 untuk kolom A8
		$object->getActiveSheet()->getStyle('A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A7
		$object->getActiveSheet()->getStyle('A7')->applyFromArray($style_row);
		$object->getActiveSheet()->getStyle('A7:D7')->applyFromArray($style_row);




		$object->getActiveSheet()->setCellValue('A8', 'No.');
		$object->getActiveSheet()->setCellValue('B8', 'Tanggal');
		$object->getActiveSheet()->setCellValue('C8', 'Keterangan');
		$object->getActiveSheet()->setCellValue('D8', 'Jumlah (Rp)');


		//Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$object->getActiveSheet()->getStyle('A8')->applyFromArray($style_col);
		$object->getActiveSheet()->getStyle('B8')->applyFromArray($style_col);
		$object->getActiveSheet()->getStyle('C8')->applyFromArray($style_col);
		$object->getActiveSheet()->getStyle('D8')->applyFromArray($style_col);

		// colom A6
		$object->getActiveSheet()->setCellValue('A9', "Saldo Awal :"); // Set kolom A7 dengan tulisan "Saldo Awal"
		$object->getActiveSheet()->mergeCells('A9:C9'); // Set Merge Cell pada kolom A7 sampai D7
		$object->getActiveSheet()->getStyle('A9')->getFont()->setBold(TRUE); // Set bold kolom A7
		$object->getActiveSheet()->getStyle('A9:C9')->getFont()->setSize(11); // Set font size 12 untuk kolom A7
		$object->getActiveSheet()->getStyle('A9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A7
	}


	public function export_harian_bantuan_akhir($id,$object,$style_row,$style_col,$style_angka,$dpm,$dpng,$saldo_akhir)
	{
		$no = 1;
		$baris = 10;
// print_r($saldo_akhir); die();
		if ($dpm) 
		{
			foreach ($dpm as $dt) 
			{
				$object->getActiveSheet()->setCellValue('A'.$baris, $no);
				$object->getActiveSheet()->setCellValue('B'.$baris, substr($dt['tgl_bayar'],8,2)."/".substr($dt['tgl_bayar'],5,2)."/".substr($dt['tgl_bayar'],0,4));
				$object->getActiveSheet()->setCellValue('C'.$baris, $dt['keterangan'] );
				$object->getActiveSheet()->setCellValue('D'.$baris, $dt['jumlah']);


					// Apply style header yang telah kita buat tadi ke masing-masing kolom header
				$object->getActiveSheet()->getStyle('A'.$baris)->applyFromArray($style_row);
				$object->getActiveSheet()->getStyle('A'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
				$object->getActiveSheet()->getStyle('B'.$baris)->applyFromArray($style_row);
				$object->getActiveSheet()->getStyle('B'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$object->getActiveSheet()->getStyle('C'.$baris)->applyFromArray($style_row);
				$object->getActiveSheet()->getStyle('D'.$baris)->applyFromArray($style_angka);

				$no++;
				$baris++;
			}
		}
		else
		{
			$object->getActiveSheet()->setCellValue('A'.$baris, "Tidak ada pemasukan!"); 
			$object->getActiveSheet()->mergeCells('A'.$baris.':D'.$baris);
			$object->getActiveSheet()->getStyle('A'.$baris)->getFont()->setBold(FALSE); 
			$object->getActiveSheet()->getStyle('A'.$baris.':D'.$baris)->getFont()->setSize(11); 
			$object->getActiveSheet()->getStyle('A'.$baris.':D'.$baris)->applyFromArray($style_row);
			$object->getActiveSheet()->getStyle('A'.$baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

			$baris++;
		}


		$baris2 = $baris+2; 

		$object->getActiveSheet()->setCellValue('A'.$baris2, "Data Pengeluaran");
		$object->getActiveSheet()->mergeCells('A'.$baris2.':D'.$baris2); 
		$object->getActiveSheet()->getStyle('A'.$baris2)->getFont()->setBold(TRUE); 
		$object->getActiveSheet()->getStyle('A'.$baris2.':D'.$baris2)->getFont()->setSize(11);
		$object->getActiveSheet()->getStyle('A'.$baris2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
		$object->getActiveSheet()->getStyle('A'.$baris2.':D'.$baris2)->applyFromArray($style_row);


		$no = 1;
		$baris3 = $baris2+1;
		if ($dpng) 
		{


			foreach ($dpng as $dt) 
			{
				$object->getActiveSheet()->setCellValue('A'.$baris3, $no);
				$object->getActiveSheet()->setCellValue('B'.$baris3, substr($dt['tgl_pengeluaran'],8,2)."/".substr($dt['tgl_pengeluaran'],5,2)."/".substr($dt['tgl_pengeluaran'],0,4));
				$object->getActiveSheet()->setCellValue('C'.$baris3, $dt['keterangan']);
				$object->getActiveSheet()->setCellValue('D'.$baris3, "-".$dt['jumlah']);


					// Apply style header yang telah kita buat tadi ke masing-masing kolom header
				$object->getActiveSheet()->getStyle('A'.$baris3)->applyFromArray($style_row);
				$object->getActiveSheet()->getStyle('A'.$baris3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$object->getActiveSheet()->getStyle('B'.$baris3)->applyFromArray($style_row);		    		
				$object->getActiveSheet()->getStyle('B'.$baris3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$object->getActiveSheet()->getStyle('C'.$baris3)->applyFromArray($style_row);
				$object->getActiveSheet()->getStyle('D'.$baris3)->applyFromArray($style_angka);

				$no++;
				$baris3++;
			}
		}
		else 
		{
		    	// print_r($saldo_akhir_listrik); die();
			$object->getActiveSheet()->setCellValue('A'.$baris3, "Tidak ada pengeluaran!"); 
			$object->getActiveSheet()->mergeCells('A'.$baris3.':D'.$baris3);
			$object->getActiveSheet()->getStyle('A'.$baris3)->getFont()->setBold(FALSE); 
			$object->getActiveSheet()->getStyle('A'.$baris3.':D'.$baris3)->getFont()->setSize(11); 
			$object->getActiveSheet()->getStyle('A'.$baris3.':D'.$baris3)->applyFromArray($style_row);
			$object->getActiveSheet()->getStyle('A'.$baris3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

			$baris3++;
		}


		$object->getActiveSheet()->setCellValue('A'.$baris3, "Saldo Akhir :"); 
		$object->getActiveSheet()->mergeCells('A'.$baris3.':C'.$baris3);
		$object->getActiveSheet()->getStyle('A'.$baris3)->getFont()->setBold(TRUE);
		$object->getActiveSheet()->getStyle('A'.$baris3.':C'.$baris3)->getFont()->setSize(11);
		$object->getActiveSheet()->getStyle('A'.$baris3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		$object->getActiveSheet()->setCellValue('D'.$baris3, $saldo_akhir['bantuan']);


		$object->getActiveSheet()->getStyle('A'.$baris3.':C'.$baris3)->applyFromArray($style_row);
		$object->getActiveSheet()->getStyle('D'.$baris3)->applyFromArray($style_angka);
	}

	public function _listrik($dpng_listrik,$dpm_listrik,$jml_pm_listrik,$jml_png_listrik,$saldo_awal_listrik,$saldo_akhir_listrik,$style_col,$style_row,$style_angka,$object)
	{
		// panggil fungsi eksport harian awal 
		$this->export_harian_awal('1',$object,$style_row,$style_col);

		$object->getActiveSheet()->setCellValue('E9', $saldo_awal_listrik['listrik']); // Set kolom E6 dengan tulisan "saldo"
		$object->getActiveSheet()->getStyle('A9:D9')->applyFromArray($style_row);
		$object->getActiveSheet()->getStyle('E9')->applyFromArray($style_angka);

		// panggil fungsi eksport harian akhir 
		$this->export_harian_akhir('1',$object,$style_row,$style_col,$style_angka,$dpm_listrik,$dpng_listrik,$saldo_akhir_listrik);

	}


	public function _kas($dpng_kas,$dpm_kas,$jml_pm_kas,$jml_png_kas,$saldo_awal_kas,$saldo_akhir_kas,$style_col,$style_row,$style_angka,$object)
	{
		// panggil fungsi eksport harian awal 
		$this->export_harian_awal('2',$object,$style_row,$style_col);

		$object->getActiveSheet()->setCellValue('E9', $saldo_awal_kas['kas']); // Set kolom E6 dengan tulisan "saldo"
		$object->getActiveSheet()->getStyle('A9:D9')->applyFromArray($style_row);
		$object->getActiveSheet()->getStyle('E9')->applyFromArray($style_angka);

		// panggil fungsi eksport harian akhir 
		$this->export_harian_akhir('2',$object,$style_row,$style_col,$style_angka,$dpm_kas,$dpng_kas,$saldo_akhir_kas);

	}


	public function _beras($dpng_beras,$dpm_beras,$jml_pm_beras,$jml_png_beras,$saldo_awal_beras,$saldo_akhir_beras,$style_col,$style_row,$style_angka,$object)
	{
		// panggil fungsi eksport harian awal 
		$this->export_harian_awal('3',$object,$style_row,$style_col);

	    $object->getActiveSheet()->setCellValue('E9', $saldo_awal_beras['beras']); // Set kolom E6 dengan tulisan "saldo"
	    $object->getActiveSheet()->getStyle('A9:D9')->applyFromArray($style_row);
	    $object->getActiveSheet()->getStyle('E9')->applyFromArray($style_angka);

		// panggil fungsi eksport harian akhir 
	    $this->export_harian_akhir('3',$object,$style_row,$style_col,$style_angka,$dpm_beras,$dpng_beras,$saldo_akhir_beras);

	}




	public function _kesehatan($dpng_kesehatan,$dpm_kesehatan,$jml_pm_kesehatan,$jml_png_kesehatan,$saldo_awal_kesehatan,$saldo_akhir_kesehatan,$style_col,$style_row,$style_angka,$object)
	{
		// panggil fungsi eksport harian awal 
		$this->export_harian_awal('4',$object,$style_row,$style_col);

	    $object->getActiveSheet()->setCellValue('E9', $saldo_awal_kesehatan['kesehatan']); // Set kolom E6 dengan tulisan "saldo"
	    $object->getActiveSheet()->getStyle('A9:D9')->applyFromArray($style_row);
	    $object->getActiveSheet()->getStyle('E9')->applyFromArray($style_angka);

		// panggil fungsi eksport harian akhir 
	    $this->export_harian_akhir('4',$object,$style_row,$style_col,$style_angka,$dpm_kesehatan,$dpng_kesehatan,$saldo_akhir_kesehatan);
	}


	public function _lauk($dpng_lauk,$dpm_lauk,$jml_pm_lauk,$jml_png_lauk,$saldo_awal_lauk,$saldo_akhir_lauk,$style_col,$style_row,$style_angka,$object)
	{
		// panggil fungsi eksport harian awal 
		$this->export_harian_awal('5',$object,$style_row,$style_col);


	    $object->getActiveSheet()->setCellValue('E9', $saldo_awal_lauk['lauk']); // Set kolom E6 dengan tulisan "saldo"
	    $object->getActiveSheet()->getStyle('A9:D9')->applyFromArray($style_row);
	    $object->getActiveSheet()->getStyle('E9')->applyFromArray($style_angka);

	    // panggil fungsi eksport harian akhir 
	    $this->export_harian_akhir('5',$object,$style_row,$style_col,$style_angka,$dpm_lauk,$dpng_lauk,$saldo_akhir_lauk);
	}


	public function _infaq($dpng_infaq,$dpm_infaq,$jml_pm_infaq,$jml_png_infaq,$saldo_awal_infaq,$saldo_akhir_infaq,$style_col,$style_row,$style_angka,$object)
	{
		// panggil fungsi eksport harian awal 
		$this->export_harian_awal('6',$object,$style_row,$style_col);


		$object->getActiveSheet()->setCellValue('E9', $saldo_awal_infaq['infaq']); // Set kolom E6 dengan tulisan "saldo"
		$object->getActiveSheet()->getStyle('A9:D9')->applyFromArray($style_row);
		$object->getActiveSheet()->getStyle('E9')->applyFromArray($style_angka);

		// panggil fungsi eksport harian akhir 
		$this->export_harian_akhir('6',$object,$style_row,$style_col,$style_angka,$dpm_infaq,$dpng_infaq,$saldo_akhir_infaq);
	}


	public function _bangunan($dpng_bangunan,$dpm_bangunan,$jml_pm_bangunan,$jml_png_bangunan,$saldo_awal_bangunan,$saldo_akhir_bangunan,$style_col,$style_row,$style_angka,$object)
	{
		// panggil fungsi eksport harian awal 
		$this->export_harian_awal('7',$object,$style_row,$style_col);


		$object->getActiveSheet()->setCellValue('E9', $saldo_awal_bangunan['bangunan']); // Set kolom E6 dengan tulisan "saldo"
		$object->getActiveSheet()->getStyle('A9:D9')->applyFromArray($style_row);
		$object->getActiveSheet()->getStyle('E9')->applyFromArray($style_angka);

		// panggil fungsi eksport harian akhir 
		$this->export_harian_akhir('7',$object,$style_row,$style_col,$style_angka,$dpm_bangunan,$dpng_bangunan,$saldo_akhir_bangunan);
	}

	public function _bantuan($dpng_bantuan,$dpm_bantuan,$jml_pm_bantuan,$jml_png_bantuan,$saldo_awal_bantuan,$saldo_akhir_bantuan,$style_col,$style_row,$style_angka,$object)
	{
		// panggil fungsi eksport harian awal 
		$this->export_harian_bantuan_awal('8',$object,$style_row,$style_col);


		$object->getActiveSheet()->setCellValue('D9', $saldo_awal_bantuan['bantuan']); // Set kolom E6 dengan tulisan "saldo"
		$object->getActiveSheet()->getStyle('A9:C9')->applyFromArray($style_row);
		$object->getActiveSheet()->getStyle('D9')->applyFromArray($style_angka);

		// panggil fungsi eksport harian akhir 
		$this->export_harian_bantuan_akhir('8',$object,$style_row,$style_col,$style_angka,$dpm_bantuan,$dpng_bantuan,$saldo_akhir_bantuan);
	}

	

}


	// 1 = Listrik 
	// 2 = Kas  
	// 3 = Beras
	// 4 = Kesehatan
	// 5 = Lauk 
	// 6 = Infaq
	// 7 = Bangunan
	// 8 = Bantuan
	// 9 = Laporan Keuangan