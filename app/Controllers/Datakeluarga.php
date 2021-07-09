<?php

namespace App\Controllers;

use App\Models\KeluargaModel;
use App\Models\AnggotaKeluargaModel;
use App\Models\DaerahModel;
use App\Models\TahunAktifModel;


class Datakeluarga extends BaseController
{
	//--------------------------------------------------------------------
	// Properti controler data keluarga
	//--------------------------------------------------------------------

	protected $Keluarga;
	protected $AnggotaKeluarga;
	protected $Daerah;
	protected $TahunAktifModel;

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// Controler data keluarga
	//--------------------------------------------------------------------

	public function __construct()
	{
		$this->Keluarga = new KeluargaModel();
		$this->AnggotaKeluarga = new AnggotaKeluargaModel();
		$this->Daerah = new DaerahModel();
		$this->TahunAktifModel = new TahunAktifModel();
	}

	public function index()
	{
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();
		$data = [
			'page' => 'datakeluarga',
			'title' => 'Data Keluarga',
			'tahun_aktif' => $d['tahun_aktif'],
			'kelurahan' => $this->Daerah->findAll(),
			'keluarga' => $this->Keluarga->findAll()
		];

		return view('keluargasehat/data_keluarga', $data);
	}

	public function save_keluarga()
	{
		if (!$this->validate([
			'nkk' => [
				'rules' => 'required|decimal|is_unique[keluarga.nkk]|min_length[16]|max_length[16]',
				'errors' => [
					'required' => 'Field {field} harus diisi',
					'is_unique' => 'Nkk sudah sudah terdaftar',
					'decimal' => 'Field {field} harus diisi dengan angka',
					'min_length' => 'NKK harus terdiri dari 16 digit',
					'max_length' => 'NKK harus terdiri dari 16 digit'
				]
			],
			'kepala_keluarga' => [
				'rules' => 'required|alpha_space',
				'errors' => [
					'required' => 'Field {field} harus diisi',
					'alpha_space' => 'Field {field} Hanya boleh diisi dengan alphabet'
				]
			],
			'jumlah_art' => [
				'rules' => 'required|decimal',
				'errors' => [
					'required' => 'Field {field} harus diisi',
					'decimal' => 'Field {field} hanya boleh diisi dengan angka',
				]
			],
			'kelurahan' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Field {field} harus diisi',
				]
			],
			'rt' => [
				'rules' => 'required|decimal',
				'errors' => [
					'required' => 'Field {field} harus diisi',
				]
			],
			'rw' => [
				'rules' => 'required|decimal',
				'errors' => [
					'required' => 'Field {field} harus diisi',
				]
			],
		])) {
			$validation = \config\Services::validation();
			return redirect()->to('http://localhost:8080/datakeluarga/detil_keluarga')->withInput()->with('validation', $validation);
		} else {
			$this->Keluarga->insert($this->request->getVar());
			session()->setFlashdata('success', 'Data berhasil disimpan');
			session()->set('tab_active', 'anggota_keluarga');
			return redirect()->to('http://localhost:8080/anggotakeluarga/keluarga/' . $this->request->getPost('nkk'));
		}
	}

	public function update_keluarga()
	{
		$this->Keluarga->save($this->request->getVar());
		session()->setFlashdata('success', 'Data dengan NKK : ' . $this->request->getPost('nkk') . ' berhasil disimpan');
		return redirect()->to('http://localhost:8080/datakeluarga/');
	}

	public function keluarga($nkk)
	{
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();
		$data = [
			'page' => 'datakeluarga',
			'title' => 'Data Keluarga',
			'tahun_aktif' => $d['tahun_aktif'],
			'form_action' => 'http://localhost:8080/datakeluarga/update_keluarga',
			'validation' => \Config\Services::validation(),
			'kelurahan' => $this->Daerah->findAll(),
			'keluarga' => $this->Keluarga->where('nkk', $nkk)->first(),
		];
		return view('keluargasehat/detil_keluarga', $data);
	}

	public function deletekeluarga($nkk)
	{
		$this->Keluarga->delete($nkk);
		$this->AnggotaKeluarga->delete(array('nkk' => $nkk));;
		session()->setFlashdata('success_delete', 'Data dengan nkk : ' . $nkk . ' berhasil dihapus');
		return redirect()->to('http://localhost:8080/datakeluarga');
	}

	public function detil_keluarga()
	{
		$keluarga = [
			'nkk' => '',
			'kepala_keluarga' => '',
			'jumlah_art' => '',
			'kelurahan' => '',
			'rt' => '',
			'rw' => ''
		];
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();
		$data = [
			'page' => 'datakeluarga',
			'title' => 'Data Keluarga',
			'form_action' => 'http://localhost:8080/datakeluarga/save_keluarga',
			'validation' => \Config\Services::validation(),
			'kelurahan' => $this->Daerah->findAll(),
			'tahun_aktif' => $d['tahun_aktif'],
			'keluarga' => $keluarga
		];
		return view('keluargasehat/detil_keluarga', $data);
	}

	public function test($data)
	{
		echo $data;
	}
}
