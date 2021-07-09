<?php

namespace App\Controllers;

use App\Models\AnggotakeluargaModel;
use App\Models\keluargaModel;
use App\Models\TahunAktifModel;

class Anggotakeluarga extends BaseController
{
	//--------------------------------------------------------------------
	// Properti controler data keluarga
	//--------------------------------------------------------------------

	protected $AnggotakeluargaModel;
	protected $KeluargaModel;
	protected $TahunAktif;

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// Construct
	//--------------------------------------------------------------------

	public function __construct()
	{

		$this->AnggotakeluargaModel = new AnggotakeluargaModel();
		$this->KeluargaModel = new KeluargaModel();
		$this->TahunAktifModel = new TahunAktifModel();
	}

	public function naskah($nkk)
	{
		dd($this->AnggotakeluargaModel->where('nkk', $nkk)->findAll());
	}

	//--------------------------------------------------------------------

	public function index()
	{
		$data = [
			'validation' => \Config\Services::validation(),
			'page' => 'anggota_keluarga',
			'title' => 'Anggota Keluarga',
			'id_keluarga' => session('id_keluarga')
		];

		return view('keluargasehat/anggota_keluarga', $data);
	}

	//--------------------------------------------------------------------
	// CRUD Data Anggota Keluarga
	//--------------------------------------------------------------------

	/* Create */
	public function create_data($nkk)
	{
		if (!$this->validate([
			'nik' => [
				'rules' => 'required|is_unique[anggota_keluarga.nik]|min_length[16]',
				'errors' => [
					'required' => '{field} harus diisi',
					'is_unique' => '{field} sudah terdaftar'
				]
			],
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'tanggal_lahir' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'jenis_kelamin' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'hubungan_keluarga' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
		])) {
			$validation = \config\Services::validation();
			$url = 'http://localhost:8080/anggotakeluarga/keluarga/' . $nkk;
			return redirect()->to($url)->withInput()->with('validation', $validation);
		} else {
			$data = [
				'nik' => $this->request->getPost('nik'),
				'nama' => $this->request->getPost('nama'),
				'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
				'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
				'hubungan_keluarga' => $this->request->getPost('hubungan_keluarga'),
				'nkk' => $nkk,
			];
			$this->AnggotakeluargaModel->insert($data);
			session()->setFlashdata('success_anggota', 'Data berhasil disimpan');
			return redirect()->to('http://localhost:8080/anggotakeluarga/keluarga/' . $nkk);
		}
	}

	/* Read */
	public function keluarga($nkk)
	{
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();
		$data_angggota_keluarga = [
			'nik' => '',
			'nama' => '',
			'tanggal_lahir' => '',
			'jenis_kelamin' => '',
			'hubungan_keluarga' => ''
		];
		$jumlah_art = $this->KeluargaModel->where('nkk', $nkk)->first();
		$data = [
			'validation' => \Config\Services::validation(),
			'page' => 'anggota_keluarga',
			'Title' => 'Anggota keluarga',
			'tahun_aktif' => $d['tahun_aktif'],
			'form_action' => 'http://localhost:8080/anggotakeluarga/create_data/' . $nkk,
			'nkk' => $nkk,
			'jumlah_art' => $jumlah_art['jumlah_art'],
			'data_anggota' => $this->AnggotakeluargaModel->where('nkk', $nkk)->findAll(),
			'data_anggota_keluarga' => $data_angggota_keluarga,
			'update' => false
		];

		return view('keluargasehat/anggota_keluarga', $data);
	}

	/* Update */
	public function get_anggota($nkk, $nik)
	{
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();
		$jumlah_art = $this->KeluargaModel->where('nkk', $nkk)->first();
		$data = [
			'validation' => \Config\Services::validation(),
			'page' => 'anggota_keluarga',
			'title' => 'Anggota keluarga',
			'tahun_aktif' => $d['tahun_aktif'],
			'form_action' => 'http://localhost:8080/anggotakeluarga/update_data/' . $nkk . '/' . $nik,
			'nkk' => $nkk,
			'jumlah_art' => $jumlah_art['jumlah_art'],
			'data_anggota' => $this->AnggotakeluargaModel->where('nkk', $nkk)->findAll(),
			'data_anggota_keluarga' => $this->AnggotakeluargaModel->where('nik', $nik)->first(),
			'update' => true
		];

		return view('keluargasehat/anggota_keluarga', $data);
	}
	public function update_data($nkk, $nik)
	{
		if (!$this->validate([
			'nik' => [
				'rules' => 'required|min_length[16]',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'tanggal_lahir' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'jenis_kelamin' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
			'hubungan_keluarga' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
		])) {
			$validation = \config\Services::validation();
			$url = 'http://localhost:8080/anggotakeluarga/keluarga/' . $nkk;
			return redirect()->to($url)->withInput()->with('validation', $validation);
		} else {
			$data = [
				'nik' => $this->request->getPost('nik'),
				'nama' => $this->request->getPost('nama'),
				'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
				'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
				'hubungan_keluarga' => $this->request->getPost('hubungan_keluarga'),
				'nkk' => $nkk,
			];
			$this->AnggotakeluargaModel->update($data['nik'], $data);
			session()->setFlashdata('success_anggota', 'Data dengan nik : ' . $this->request->getPost('nik') . ' berhasil disimpan');
			return redirect()->to('http://localhost:8080/anggotakeluarga/keluarga/' . $nkk);
		}
	}

	public function update_anggota()
	{
		dd($this->request->getVar());
	}
	public function add_anggota()
	{
		dd($this->request->getVar());
	}

	/* Delete */
	public function delete_anggota($nkk, $nik)
	{
		$this->AnggotakeluargaModel->delete($nik);
		session()->setFlashdata('success_delete', 'Data denga nik ' . $nik . ' berhasil dihapus');
		return redirect()->to('http://localhost:8080/anggotakeluarga/keluarga/' . $nkk);
	}

	public function test()
	{
		$nkk = 123;
		$url = 'http://localhost:8080/anggotakeluarga/keluarga/' . $nkk;
		echo $url;
	}

	public function check_nik()
	{
		if ($this->AnggotakeluargaModel->where('nik', $this->request->getPost('nik'))->countAllResults()) {
			$data = ['status' => true];
		} else {
			$data = ['status' => false];
		}
		// dd($data);
		return json_encode($data);
	}
	//--------------------------------------------------------------------
}
