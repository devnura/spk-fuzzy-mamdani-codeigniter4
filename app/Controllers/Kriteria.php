<?php

namespace App\Controllers;

use App\Models\KriteriaModel;
use App\Models\KategoriModel;
use App\Models\TahunAktifModel;
use Config\Validation;
use CodeIgniter\I18n\Time;

class Kriteria extends BaseController
{

	protected $validation;
	protected $IndikatorModel;
	protected $KriteriaModel;
	protected $KategoriModel;
	protected $TahunAktifModel;

	public function __construct()
	{
		$this->KriteriaModel = new KriteriaModel();
		$this->KategoriModel = new KategoriModel();
		$this->TahunAktifModel = new TahunAktifModel();
		$this->validation = new Validation();
	}

	//--------------------------------------------------------------------
	// untu Kelola kriteria
	//--------------------------------------------------------------------

	public function index()
	{
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();
		$data = [
			'page' => 'kelola_kriteria',
			'title' => 'Kelola Kriteria',
			'tahun_aktif' => $d['tahun_aktif'],
			'form_action' => 'http://localhost:8080/kriterian/create_user',
			'validation' => \Config\Services::validation(),
			'kriteria' => $this->KriteriaModel->table('kriteria')->findAll(),
			// 'sub_kriteria' => $this->SubKriteriaModel->findAll()
		];
		return view('admin/kelola_kriteria', $data);
	}

	public function save_kriteria()
	{
		// dd($this->request->getPost());
		if ($this->KriteriaModel->save($this->request->getVar())) {
			session()->setFlashdata('success', 'Data berhasil disimpan');
			return redirect()->to('http://localhost:8080/kriteria');
		}
	}

	public function delete_kriteria($id)
	{
		if ($this->KriteriaModel->delete($id)) {
			session()->setFlashdata('success', 'Data dengan id ' . $id . ' berhasil dihapus');
			return redirect()->to('http://localhost:8080/kriteria');
		}
	}

	public function kategori($id_kriteria)
	{
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();
		$data = [
			'page' => 'kelola_kategori',
			'title' => 'Kelola Kategori',
			'id_kriteria' => $id_kriteria,
			'tahun_aktif' => $d['tahun_aktif'],
			'form_action' => 'http://localhost:8080/kriteria/create_user',
			'validation' => \Config\Services::validation(),
			'kategori' => $this->KategoriModel->where('id_kriteria', $id_kriteria)->findAll(),
			// 'sub_kriteria' => $this->SubKriteriaModel->findAll()
		];
		// dd($data);
		return view('admin/kelola_kategori', $data);
	}

	public function get_kategori($id_kriteria = false)
	{
		$data = $this->KategoriModel->where('id_kriteria', $id_kriteria)->findAll();
		return json_encode($data);
	}

	public function save_kategori($id_kriteria)
	{
		// dd($this->request->getVar());
		if ($this->KategoriModel->save($this->request->getVar())) {
			session()->setFlashdata('success', 'Data berhasil disimpan');
			return redirect()->to('http://localhost:8080/kriteria/kategori/' . $id_kriteria);
		}
	}

	public function delete_kategori($id, $id_kriteria)
	{
		if ($this->KategoriModel->delete($id)) {
			session()->setFlashdata('success', 'Data berhasil dihapus');
			return redirect()->to('http://localhost:8080/kriteria/kategori/' . $id_kriteria);
		}
	}
}
