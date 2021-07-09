<?php

namespace App\Controllers;

use App\Models\KeluargaModel;
use App\Models\AnggotaKeluargaModel;
use App\Models\PendataanModel;
use App\Models\IndikatorModel;
use App\Models\HasilIndikatorModel;
use App\Models\TahunAktifModel;
use CodeIgniter\I18n\Time;


class ProfilKesehatan extends BaseController
{
	//--------------------------------------------------------------------
	// Properti controler data keluarga
	//--------------------------------------------------------------------

	protected $Keluarga;
	protected $AnggotaKeluarga;
	protected $Pendataan;
	protected $IndikatorModel;
	protected $HasilIndikatorModel;
	protected $TahunAktifModel;

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// Controler data keluarga
	//--------------------------------------------------------------------

	public function __construct()
	{
		$this->Keluarga = new KeluargaModel();
		$this->IndikatorModel = new IndikatorModel();
		$this->HasilIndikatorModel = new HasilIndikatorModel();
		$this->TahunAktifModel = new TahunAktifModel();
		$this->AnggotaKeluarga = new AnggotaKeluargaModel();
		$this->Pendataan = new PendataanModel();
	}
	public function test()
	{
	}
	public function index()
	{
		// dd($this->Pendataan->where('tahun_aktif', 2020)->where('id_user', session('id'))->join('keluarga', 'keluarga.nkk=pendataan.nkk')->findAll());
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();
		$time1 = Time::parse($d['tanggal_pembukaan']);
		$time2 = Time::parse($d['tanggal_penutupan']);
		$now = Time::now();
		if ($now->isAfter($time1) && $now->isBefore($time2)) {
			$aktif = true;
		} else {
			$aktif = false;
		}
		$data = [
			'page' => 'profil_kesehatan',
			'title' => 'Profil Kesehatan',
			'aktif' => $d['tahun_aktif'],
			'status' => $aktif,
			'tahun_aktif' => $d['tahun_aktif'],
			'keluarga' => $this->Keluarga->findAll(),
			'keluarga_terdata' => $this->Pendataan->where('tahun_aktif', $d['tahun_aktif'])
				->where('id_user', session('id'))
				->join('keluarga', 'keluarga.nkk=pendataan.nkk')
				->findAll()
		];
		// dd($data['keluarga_terdata']);

		return view('keluargasehat/profil_kesehatan', $data);
	}

	public function riwayat_pendataan()
	{
		// dd($this->Pendataan->where('tahun_aktif', 2020)->where('id_user', session('id'))->join('keluarga', 'keluarga.nkk=pendataan.nkk')->findAll());
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();

		$aktif = true;

		$data = [
			'page' => 'riwayat_pendataan',
			'title' => 'Riwayat Pendataan',
			'aktif' => $d['tahun_aktif'],
			'status' => $aktif,
			'tahun_aktif' => $d['tahun_aktif'],
			'keluarga_terdata' => $this->Pendataan
				->where('id_user', session('id'))
				->join('keluarga', 'keluarga.nkk=pendataan.nkk')
				->join('hasil', 'hasil.id_pendataan=pendataan.id_pendataan')
				->findAll()
		];
		// dd($data['keluarga_terdata']);
		return view('keluargasehat/riwayat_pendataan', $data);
	}
	public function keluarga($nkk)
	{
		// dd($this->Pendataan->where('nkk', $nkk)->findAll());
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();
		$data = [
			'page' => 'pendataankeluarga',
			'title' => 'Profil Kesehatan',
			'tahun_aktif' => $d['tahun_aktif'],
			'form_action' => 'http://localhost:8080/pendataan_keluarga/add/' . $nkk,
			'validation' => \Config\Services::validation(),
			'data_pendataan' => $this->Pendataan->where('nkk', $nkk)->findAll()
		];
		return view('keluargasehat/pendataan_keluarga', $data);
	}

	public function add($nkk, $tahun_aktif)
	{
		$data = [
			'nkk' => $nkk,
			'tgl_pendataan' => $this->request->getPost('tgl_pendataan'),
			'tahun_aktif' => $tahun_aktif,
			'status_pendataan' => 0
		];
		$this->Pendataan->insert($data);
		session()->setFlashdata('success', 'Data berhasil disimpan');
		return redirect()->to('http://localhost:8080/pendataan_keluarga/keluarga/' . $nkk);
	}

	public function delete($nkk, $id)
	{
		$this->Pendataan->delete(array('id_pendataan' => $id));;
		session()->setFlashdata('success_delete', 'Data berhasil dihapus');
		return redirect()->to('http://localhost:8080/pendataan_keluarga/keluarga/' . $nkk);
	}


	public function indikator($nkk, $id_pendataan)
	{
		// dd($this->kuesioner_keluarga($id_pendataan, $nkk));
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();
		$keluarga = $this->Keluarga->where('nkk', $nkk)->first();
		$data = [
			'validation' => \Config\Services::validation(),
			'page' => 'Indikator',
			'title' => 'Indikator Keluarga Sehatan',
			'nkk' => $nkk,
			'tahun_aktif' => $d['tahun_aktif'],
			'indikator' => $this->IndikatorModel->findAll(),
			'id_pendataan' => $id_pendataan,
			'jumlah_art' => $keluarga['jumlah_art'],
			'data_anggota' => $this->indikator_keluarga($id_pendataan, $nkk)
		];
		$jumlah_sudah = [];
		for ($i = 0; $i < count($data['data_anggota']); $i++) {
			$tgl_lahir = Time::parse($data['data_anggota'][$i]['tanggal_lahir']);
			$data['data_anggota'][$i] += ['umur' => $tgl_lahir->getAge()];
			if ($data['data_anggota'][$i]['status'] == true) {
				$jumlah_sudah[$i] = [$i];
			}
		}
		$dt = count($jumlah_sudah);
		$data += ['jumlah_sudah' => $dt];
		// dd($data['data_anggota']);
		return view('keluargasehat/indikator', $data);
	}

	public function get_indikator()
	{
		return json_encode($this->IndikatorModel->findAll());
	}
	// =================================================================================================
	// 
	//  ================================================================================================

	public function get_result($whit_answer = false)
	{
		$data = $this->AnggotaKeluarga->where('nik', $this->request->getPost('nik'))->first();

		if ($whit_answer) {
			$result = [
				'nama' => $data['nama'],
				'nik' => $data['nik'],
				'tanggal_lahir' => $data['tanggal_lahir'],
				'hubungan_keluarga' => $this->cek_hubungan($data['hubungan_keluarga']),
				'jenis_kelamin' => $this->cek_jenkel($data['jenis_kelamin']),
				// 'answer' => $this->get_answer($this->request->getPost('id_pendataan'), $data['nik'])
			];
		} else {
			$result = [
				'nama' => $data['nama'],
				'nik' => $data['nik'],
				'tanggal_lahir' => $data['tanggal_lahir'],
				'hubungan_keluarga' => $this->cek_hubungan($data['hubungan_keluarga']),
				'jenis_kelamin' => $this->cek_jenkel($data['jenis_kelamin']),
			];
		}

		return json_encode($result);
	}

	public function get_answer()
	{
		$result = $this->AnggotaKeluarga
			->where('hasil_indikator.id_pendataan', $this->request->getPost('id_pendataan'))
			->where('hasil_indikator.nik', $this->request->getPost('nik'))
			->join('hasil_indikator', 'hasil_indikator.nik = anggota_keluarga.nik')
			->join('indikator', 'indikator.id_indikator = hasil_indikator.id_indikator')
			->findAll();
		return json_encode($result);
	}

	public function get_rekapitulasi()
	{
		$data = [];
		$rekapitulasi = [];
		// $datakriteria = $this->Kriteria->where('keterangan', 'output')->findColumn('id_kriteria');
		$kuesioner = $this->IndikatorModel->findAll();
		$hasil_kuesioner = $this->HasilIndikatorModel->findAll();
		for ($i = 0; $i < count($kuesioner); $i++) {
			if ($hasil_kuesioner[$i]['id_indikator'] == (1 + $i)) {
				$data += [$kuesioner[$i]['id_indikator'] => $this->HasilIndikatorModel
					->where('id_pendataan', $this->request->getPost('id_pendataan'))
					->where('id_indikator', (1 + $i))
					->findColumn('jawaban')];
			}
			$Kuesioner = array_count_values($data[(1 + $i)]);
			if (isset($Kuesioner['T']) == 0 && isset($Kuesioner['Y']) == 0) {
				// produce "N";
				$rekapitulasi[$i] = ['kuesioner' => $kuesioner[$i]['indikator'], $i => 'N'];
			} else if (isset($Kuesioner['T']) > 0) {
				// produce "T";
				$rekapitulasi[$i] = ['kuesioner' => $kuesioner[$i]['indikator'], $i => 'T'];
			} else {
				// produce "Y";
				$rekapitulasi[$i] = ['kuesioner' => $kuesioner[$i]['indikator'], $i => 'Y'];
			}
		}
		return json_encode($rekapitulasi);
	}

	public function insert_result()
	{
		$count = $this->IndikatorModel->countAll();
		for ($i = 0; $i < $count; $i++) {
			$data[$i] = [
				'id_pendataan' => $this->request->getvar('id_pendataan'),
				'nik' => $this->request->getvar('nik'),
				'id_indikator' => 1 + $i,
				'jawaban' => $this->request->getVar('jawaban_' . (1 + $i))
			];
		}
		if ($this->HasilIndikatorModel->insertBatch($data)) {
			session()->setFlashdata('success', 'Data berhasil disimpan');
			return redirect()->to('http://localhost:8080/profilkesehatan/indikator/' . $this->request->getvar('nkk') . '/' . $this->request->getvar('id_pendataan'));
		}
	}

	public function set_update_result()
	{
		// dd($this->request->getVar());
		$data_old = $this->get_id_hasil($this->request->getPost('id_pendataan'), $this->request->getPost('nik'));
		$data_new = $this->request->getVar();
		for ($i = 0; $i < count($data_old); $i++) {
			$data[$i] = [
				'id_hasil_indikator' => $data_old[$i]['id_hasil_indikator'],
				'id_pendataan' => $data_new['id_pendataan'],
				'nik' => $data_new['nik'],
				'id_kuesioner' => (1 + $i),
				'jawaban' => $this->request->getPost('jawaban_' . (1 + $i))
			];
		}
		if ($this->HasilIndikatorModel->updateBatch($data, 'id_hasil_indikator')) {
			session()->setFlashdata('success', 'Data berhasil disimpan');
			return redirect()->to('http://localhost:8080/profilkesehatan/indikator/' . $this->request->getvar('nkk') . '/' . $this->request->getvar('id_pendataan'));
		}

		// dd($data);
	}

	public function get_id_hasil($id_pendataan, $nik)
	{
		$result = $this->HasilIndikatorModel
			->select('id_hasil_indikator')
			->where('id_pendataan', $id_pendataan)
			->where('nik', $nik)
			->findAll();
		return $result;
	}

	public function indikator_keluarga($id_pendataan, $nkk)
	{
		// $hasil = $this->HasilKuesionerModel->where(['id_pendataan' => $id_pendataan])->where('id_kuesioner', 1)->findAll();
		$keluarga = $this->AnggotaKeluarga->where('nkk', $nkk)->findAll();

		for ($i = 0; $i < count($keluarga); $i++) {
			if ($this->HasilIndikatorModel->where('id_pendataan', $id_pendataan)->where('nik', $keluarga[$i]['nik'])->findAll()) {
				$status = true;
			} else {
				$status = false;
			}
			$data[$i] = [
				'nama' => $keluarga[$i]['nama'],
				'nik' => $keluarga[$i]['nik'],
				'jenis_kelamin' => $this->cek_jenkel($keluarga[$i]['jenis_kelamin']),
				'tanggal_lahir' => $keluarga[$i]['tanggal_lahir'],
				'hubungan_keluarga' => $this->cek_hubungan($keluarga[$i]['hubungan_keluarga']),
				'status' => $status
			];
		}
		return $data;
	}

	public function cek_hubungan($id)
	{
		// hubungan keluarga
		if ($id == 1) {
			$data =  'Kepala keluarga';
		} else if ($id == 2) {
			$data =  'Istri';
		} else if ($id == 3) {
			$data =  'Anak';
		} else if ($id == 4) {
			$data =  'Menantu';
		} else if ($id == 5) {
			$data =  'Cucu';
		} else if ($id == 6) {
			$data =  'Orang tua';
		} else if ($id == 7) {
			$data =  'Lainya';
		}
		return $data;
	}

	public function cek_jenkel($id)
	{
		if ($id == 1) {
			$data = 'Laki-laki';
		} else {
			$data = 'Perempuan';
		}
		return $data;
	}
}
