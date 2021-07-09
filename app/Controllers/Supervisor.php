<?php

namespace App\Controllers;

use App\Models\KeluargaModel;
use App\Models\AnggotaKeluargaModel;
use App\Models\PendataanModel;
use App\Models\HasilindikatorModel;
use App\Models\HasilModel;

use App\Models\FuzzyfikasiModel;
use App\Models\ImplikasiModel;
use App\Models\komposisiModel;
use App\Models\DefuzzyfikasiModel;

use App\Models\KategoriModel;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use App\Models\IndikatorModel;
use App\Models\TahunAktifModel;

use CodeIgniter\I18n\Time;

class Supervisor extends BaseController
{
	//--------------------------------------------------------------------
	// Properti controler data keluarga
	//--------------------------------------------------------------------

	protected $Keluarga;
	protected $AnggotaKeluarga;
	protected $Pendataan;
	protected $HasilindikatorModel;
	protected $HasilModel;
	protected $TahunAktifModel;
	protected $Fuzzyfikasi;
	protected $Implikasi;
	protected $Komposisi;
	protected $Defuzzyfikasi;
	protected $kategori;

	protected $Kriteria;
	protected $Sub_kriteria;
	protected $IndikatorModel;
	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// Controler pendataan keluarga
	//--------------------------------------------------------------------

	public function __construct()
	{
		$this->Keluarga = new KeluargaModel();
		$this->AnggotaKeluarga = new AnggotaKeluargaModel();
		$this->Pendataan = new PendataanModel();
		$this->HasilindikatorModel = new HasilindikatorModel();
		$this->HasilModel = new HasilModel();

		$this->Fuzzyfikasi = new FuzzyfikasiModel();
		$this->Implikasi = new ImplikasiModel();
		$this->Komposisi = new KomposisiModel();
		$this->Defuzzyfikasi = new DefuzzyfikasiModel();
		$this->TahunAktifModel = new TahunAktifModel();

		$this->Kategori = new KategoriModel();
		$this->Kriteria = new KriteriaModel();
		$this->IndikatorModel = new IndikatorModel();
	}

	public function index()
	{
		$data = [
			'page' => 'hasil_analisis',
			'title' => 'Hasil Analisis',
			'data_tahun_aktif' => $this->TahunAktifModel->findAll()
		];

		return view('supervisor/profilkesehatan', $data);
	}

	public function view_tahun($tahun)
	{
		$data = [
			'page' => 'hasil_analisis',
			'title' => 'Hasil Analisis',
			'keluarga' => $this->Pendataan->where('tahun_aktif', $tahun)->where('status_pendataan', 1)->join('keluarga', 'keluarga.nkk=pendataan.nkk')->findAll()
		];

		return view('supervisor/viewtahun', $data);
	}

	public function keluarga($nkk)
	{
		$data = [
			'page' => 'pendataankeluarga',
			'title' => 'Hasil Analisis',
			'form_action' => 'http://localhost:8080/pendataan_keluarga/add/' . $nkk,
			'validation' => \Config\Services::validation(),
			'data_pendataan' => $this->Pendataan->where('nkk', $nkk)->where('status_pendataan', 1)->findAll()
		];
		return view('supervisor/pendataan', $data);
	}
	public function hasil_analisis($nkk, $id_pendataan)
	{
		$myTime = Time::now();
		// dd($this->Fuzzyfikasi->where('id_pendataan', $id_pendataan)->join('kriteria', 'kriteria.id_kriteria=fuzzyfikasi.id_kriteria')->findAll());
		$nilai_z = $this->HasilModel->where('id_pendataan', $id_pendataan)->first();
		$kategori = $this->Kriteria->join('kategori', 'kategori.id_kriteria=kriteria.id_kriteria')->where('keterangan', 'output')->findAll();
		// dd($kategori, $nilai_z);
		if ($nilai_z['nilai'] <= $kategori[0]['mid']) {
			$status = 'Tidak Sehat';
		} else if ($nilai_z['nilai'] > $kategori[0]['mid'] && $nilai_z['nilai'] < $kategori[2]['mid']) {
			$status = 'Sehat';
		} else {
			$status = 'Sehat';
		}
		$data = [
			'id_pen' => $id_pendataan,
			'page' => 'hasil_analisis',
			'title' => 'Hasil Analisis',
			'sekarang' => $myTime->getDay() . '/' . $myTime->getMonth() . '/' . $myTime->getYear(),
			'hasil_kuesioner' => $this->get_rekapitulasi($id_pendataan),
			'kuesioner' => $this->IndikatorModel->findAll(),
			'kriteria' => $this->get_kriteria(),
			'keluarga' => $this->Keluarga->where('nkk', $nkk)->first(),
			'fuzzyfikasi' => $this->Fuzzyfikasi->where('id_pendataan', $id_pendataan)->join('kriteria', 'kriteria.id_kriteria=fuzzyfikasi.id_kriteria')->findAll(),
			'implikasi' => $this->Implikasi->where('id_pendataan', $id_pendataan)->findAll(),
			'komposisi_aturan' => $this->Komposisi->where('id_pendataan', $id_pendataan)->findAll(),
			'defuzzyfikasi' => $this->Defuzzyfikasi->where('id_pendataan', $id_pendataan)->findAll(),
			'nilai_z' => $nilai_z,
			'status' => $status
		];
		// dd($data['kriteria']);
		return view('supervisor/hasilanalisis', $data);
		// dd($id_pendataan, $nkk);
	}
	public function get_rekapitulasi($id_pendataan)
	{
		$data = [];
		$rekapitulasi = [];
		// $datakriteria = $this->Kriteria->where('keterangan', 'output')->findColumn('id_kriteria');
		$kuesioner = $this->IndikatorModel->findAll();
		$hasil_kuesioner = $this->HasilindikatorModel->findAll();
		for ($i = 0; $i < count($kuesioner); $i++) {
			if ($hasil_kuesioner[$i]['id_indikator'] == (1 + $i)) {
				$data += [$kuesioner[$i]['id_indikator'] => $this->HasilindikatorModel
					->where('id_pendataan', $id_pendataan)
					->where('id_indikator', (1 + $i))
					->findColumn('jawaban')];
			}
			$Kuesioner = array_count_values($data[(1 + $i)]);
			if (isset($Kuesioner['T']) == 0 && isset($Kuesioner['Y']) == 0) {
				// produce "N";
				$rekapitulasi += [$i => 'N'];
			} else if (isset($Kuesioner['T']) > 0) {
				// produce "T";
				$rekapitulasi += [$i => 'T'];
			} else {
				// produce "Y";
				$rekapitulasi += [$i => 'Y'];
			}
		}
		return $rekapitulasi;
	}

	public function get_kriteria()
	{
		$datakriteria = $this->Kriteria->where('keterangan', 'output')->findAll();

		return $datakriteria;
	}

	public function to_print($nkk, $id_pendataan)
	{
		$myTime = Time::now();
		$nilai_z = $this->HasilModel->where('id_pendataan', $id_pendataan)->first();
		if ($nilai_z['nilai'] <= 50) {
			$status = 'Tidak Sehat';
		} else if ($nilai_z > 50 && $nilai_z < 80) {
			$status = 'Sehat';
		} else {
			$status = 'Sehat';
		}
		$data = [
			'page' => 'hasil_analisis',
			'title' => 'Hasil Analisis',
			'sekarang' => $myTime->getDay() . '/' . $myTime->getMonth() . '/' . $myTime->getYear(),
			'hasil_kuesioner' => $this->get_rekapitulasi($id_pendataan),
			'kuesioner' => $this->IndikatorModel->findAll(),
			'kriteria' => $this->get_kriteria(),
			'keluarga' => $this->Keluarga->where('nkk', $nkk)->first(),
			'fuzzyfikasi' => $this->Fuzzyfikasi->where('id_pendataan', $id_pendataan)->findAll(),
			'implikasi' => $this->Implikasi->where('id_pendataan', $id_pendataan)->findAll(),
			'komposisi_aturan' => $this->Komposisi->where('id_pendataan', $id_pendataan)->findAll(),
			'defuzzyfikasi' => $this->Defuzzyfikasi->where('id_pendataan', $id_pendataan)->findAll(),
			'nilai_z' => $nilai_z,
			'status' => $status
		];
		// dd($data['kriteria']);
		return view('supervisor/print-hasilanalisis', $data);
		// dd($id_pendataan, $nkk);


	}

	public function to_print_tahun($tahun_aktif)
	{

		$myTime = Time::now();
		// dd($this->Pendataan->where('tahun_aktif', 2020)->where('id_user', session('id'))->join('keluarga', 'keluarga.nkk=pendataan.nkk')->findAll());
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();

		$aktif = true;
		$kategori = $this->Kriteria->join('kategori', 'kategori.id_kriteria=kriteria.id_kriteria')->where('keterangan', 'output')->findAll();
		$data = [
			'kategori' => 'kategori',
			'page' => 'profil_kesehatan',
			'title' => 'Riwayat Pendataan',
			'sekarang' => $myTime->getDay() . '/' . $myTime->getMonth() . '/' . $myTime->getYear(),
			'aktif' => $d['tahun_aktif'],
			'tahun_aktif' => $d['tahun_aktif'],
			'keluarga' => $this->Keluarga->findAll(),
			'keluarga_terdata' => $this->Pendataan
				->select('pendataan.tahun_aktif')
				->select('pendataan.tgl_pendataan')
				->select('keluarga.nkk')
				->select('keluarga.kepala_keluarga')
				->select('keluarga.kelurahan')
				->select('keluarga.rt')
				->select('keluarga.rw')
				->select('users.name')
				->select('hasil.nilai')
				->where('pendataan.tahun_aktif', $tahun_aktif)
				->join('users', 'users.id=pendataan.id_user')
				->join('keluarga', 'keluarga.nkk=pendataan.nkk')
				->join('hasil', 'hasil.id_pendataan=pendataan.id_pendataan')
				->findAll()
		];
		// dd($data['keluarga_terdata']);
		return view('supervisor/print-tahunan', $data);
	}
}
