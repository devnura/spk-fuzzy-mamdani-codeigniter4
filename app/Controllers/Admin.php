<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use App\Models\IndikatorModel;
use App\Models\TahunAktifModel;
use Config\Validation;
use CodeIgniter\I18n\Time;

class Admin extends BaseController
{
	protected $AdminModel;
	protected $data = [];
	protected $validation;
	protected $IndikatorModel;
	protected $KriteriaModel;
	protected $SubKriteriaModel;
	protected $TahunAktifModel;

	public function __construct()
	{
		$this->KriteriaModel = new KriteriaModel();
		$this->SubKriteriaModel = new SubKriteriaModel();
		$this->AdminModel = new UsersModel();
		$this->IndikatorModel = new IndikatorModel();
		$this->TahunAktifModel = new TahunAktifModel();
		$this->validation = new Validation();
	}

	public function index()
	{
		$user = [
			'id' => '',
			'name' => '',
			'password' => '',
			'email' => '',
			'level' => '',
			'active' => '',
		];
		$data = [
			'page' => 'manage_user',
			'form_action' => 'http://localhost:8080/admin/create_user',
			'validation' => \Config\Services::validation(),
			'tabel_user' => $this->AdminModel->findAll(),
			'update' => $user
		];
		return view('admin/manage_users', $data);
	}

	//--------------------------------------------------------------------
	// untu manajemen user
	//--------------------------------------------------------------------

	public function manage_user()
	{
		$user = [
			'id' => '',
			'name' => '',
			'password' => '',
			'email' => '',
			'level' => '',
			'active' => '',
		];
		$data = [
			'page' => 'manage_user',
			'title' => 'Kelola user',
			'form_action' => 'http://localhost:8080/admin/create_user',
			'validation' => \Config\Services::validation(),
			'tabel_user' => $this->AdminModel->findAll(),
			'update' => $user
		];
		return view('admin/manage_users', $data);
	}

	/* Create */
	public function create_user()
	{
		if (!$this->validate([
			'email' => [
				'rules' => 'required|valid_email|is_unique[users.email]',
				'errors' => [
					'required' => 'Field {field} harus diisi',
					'is_unique' => 'Field alamat email sudah digunakan'
				]
			],
			'name' => [
				'rules' => 'required|alpha_space',
				'errors' => [
					'required' => 'Field {field} harus diisi'
				]
			],
			'password' => [
				'rules' => 'required|min_length[8]',
				'errors' => [
					'required' => 'Field {field} harus diisi',
					'min_length' => 'Field {field} setidaknya terdiri dari 8 karakter'
				]
			]
		])) {
			$validation = \config\Services::validation();
			return redirect()->to('http://localhost:8080/admin/manage_user')->withInput()->with('validation', $validation);
		} else {
			$data['name'] = $this->request->getPost('name');
			$data['email'] = $this->request->getPost('email');
			$data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
			($this->request->getPost('level') ? $data['level'] = $this->request->getPost('level') : $data['level'] = '3');
			($this->request->getPost('active') ? $data['active'] = $this->request->getPost('active') : $data['active'] = '2');
			if ($this->AdminModel->insert($data)) {
				session()->setFlashdata('success_create', 'Data berhasil disimpan');
				return redirect()->to('http://localhost:8080/admin/manage_user');
			}
		}
	}
	/* Read */
	public function read_user()
	{
		if ($this->request->getPost('email')) {
			return json_encode($this->AdminModel->where('email', $this->request->getPost('email'))->get()->getResultArray());
		}
		return json_encode($this->AdminModel->findAll());
	}
	// get_update
	public function user_update($id)
	{
		$update = $this->AdminModel->asObject()->where('id', $id)->first();
		// dd($update->name);
		$user = [
			'id' => $update->id,
			'name' => $update->name,
			'email' => $update->email,
			'password' => $update->password,
			'level' => $update->level,
			'active' => $update->active,
		];
		$data = [
			'page' => 'manage_user',
			'form_action' => 'http://localhost:8080/admin/update_user',
			'validation' => \Config\Services::validation(),
			'tabel_user' => $this->AdminModel->findAll(),
			'update' => $user
		];
		return view('admin/manage_users', $data);
	}
	/* Update */
	public function update_user()
	{
		if (!$this->validate([
			'name' => [
				'rules' => 'required|alpha_space',
				'errors' => [
					'required' => 'Field {field} harus diisi'
				]
			],
		])) {
			$validation = \config\Services::validation();
			return redirect()->to('http://localhost:8080/admin/manage_user')->withInput()->with('validation', $validation);
		} else {
			$password = $this->request->getPost('op');
			if ($this->request->getPost('password') != "") {
				$password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
			}
			$data = [
				'id' => $this->request->getPost('id'),
				'email' => $this->request->getPost('email'),
				'password' => $password,
				'name' => $this->request->getPost('name'),
				'level' => $this->request->getPost('level'),
				'active' => $this->request->getPost('active'),
			];
			if ($this->AdminModel->save($data)) {
				session()->setFlashdata('success_update', 'Data berhasil diupdate');
				return redirect()->to('http://localhost:8080/admin/manage_user');
			}
		}
	}
	/* Delete */
	public function delete_user($id)
	{
		$this->AdminModel->delete($id);
		session()->setFlashdata('success_delete', 'Data berhasil dihapus');
		return redirect()->to('http://localhost:8080/admin/manage_user');
	}


	//--------------------------------------------------------------------
	// Kelola Indikator
	//--------------------------------------------------------------------
	public function kelola_indikator()
	{
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();
		$data = [
			'page' => 'kelola_kuesioner',
			'title' => 'Kelola Indikator',
			'tahun_aktif' => $d['tahun_aktif'],
			'form_action' => 'http://localhost:8080/admin/create_user',
			'validation' => \Config\Services::validation(),
			'indikator' => $this->IndikatorModel->join('kriteria', 'kriteria.id_kriteria=indikator.id_kriteria')->findAll(),
			'kriteria' => $this->KriteriaModel->findAll()
		];
		// dd($data['indikator']);
		return view('admin/kelola_indikator', $data);
	}
	public function insert_indikator()
	{
		// dd($this->request->getVar());
		if ($this->IndikatorModel->insert($this->request->getVar())) {
			session()->setFlashdata('success', 'Data berhasil disimpan');
			return redirect()->to('http://localhost:8080/admin/kelola_indikator');
		}
	}
	public function save_indikator()
	{
		// dd($this->request->getVar());
		if ($this->IndikatorModel->save($this->request->getVar())) {
			session()->setFlashdata('success', 'Data berhasil disimpan');
			return redirect()->to('http://localhost:8080/admin/kelola_indikator');
		}
	}
	public function delete_indikator($id_indikator)
	{
		if ($this->IndikatorModel->delete($id_indikator)) {
			session()->setFlashdata('success', 'Data berhasil dihapus');
			return redirect()->to('http://localhost:8080/admin/kelola_indikator');
		}
	}

	//--------------------------------------------------------------------
	// Kelola Tahun aktif
	//--------------------------------------------------------------------
	public function kelola_tahun_aktif()
	{
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();
		$data = [
			'page' => 'kelola_tahun_aktif',
			'title' => 'Kelola Tahun Aktif',
			'form_action' => 'http://localhost:8080/admin/create_tahun_aktif',
			'tahun_aktif' => $d['tahun_aktif'],
			'data_tahun_aktif' => $this->TahunAktifModel->findAll(),
			'validation' => \Config\Services::validation()
		];
		return view('admin/kelola_tahun_aktif', $data);
	}
	public function frm_tahun_aktif($tahun_aktif = false)
	{
		$d = $this->TahunAktifModel->where('status_aktif', 1)->first();
		if ($tahun_aktif) {
			$update = $this->TahunAktifModel->where('tahun_aktif', $tahun_aktif)->first();
			$data = [
				'page' => 'frm_tahun_aktif',
				'title' => 'Kelola Tahun Aktif',
				'form_action' => 'http://localhost:8080/admin/update_tahun_aktif',
				'update' => $update,
				'tahun_aktif' => $d['tahun_aktif'],
				'validation' => \Config\Services::validation()
			];
		} else {
			$data = [
				'page' => 'frm_tahun_aktif',
				'title' => 'Kelola Tahun Aktif',
				'form_action' => 'http://localhost:8080/admin/create_tahun_aktif',
				'update' => ['tahun_aktif' => '', 'tanggal_penutupan' => ''],
				'tahun_aktif' => $d['tahun_aktif'],
				'validation' => \Config\Services::validation()
			];
		}
		return view('admin/frm_tahun_aktif', $data);
	}
	public function create_tahun_aktif()
	{
		$post = $this->request->getPost('tanggal');
		$data = [];
		// $d = explode('-', $this->request->getPost('tanggal'));
		$d = explode('-', $post);
		$data['tanggal_pembukaan'] = str_replace('/', '-', trim($d[0]));
		$data['tanggal_penutupan'] = str_replace('/', '-', trim($d[1]));

		$db = [
			'tahun_aktif' => $this->request->getPost('tahun_aktif'),
			'tanggal_pembukaan' => $data['tanggal_pembukaan'],
			'tanggal_penutupan' => $data['tanggal_penutupan'],
			'status_aktif' => '0'
		];
		// dd($db);
		$this->TahunAktifModel->insert($db);
		session()->setFlashdata('success', 'Data berhasil disimpan');
		return redirect()->to('http://localhost:8080/admin/kelola_tahun_aktif');
	}

	public function delete_tahun($tahun)
	{
		if ($this->TahunAktifModel->delete($tahun)) {
			session()->setFlashdata('deleted', 'Data berhasil dihapus');
			return redirect()->to('http://localhost:8080/admin/kelola_tahun_aktif');
		} else {
			session()->setFlashdata('deleted', 'Data gagal dihapus');
			return redirect()->to('http://localhost:8080/admin/kelola_tahun_aktif');
		}
	}
	public function activated($tahun_aktif)
	{
		if ($this->TahunAktifModel->query("UPDATE tahun_aktif SET status_aktif = 0")) {
			$data = [
				'tahun_aktif' => $tahun_aktif,
				'status_aktif' => 1
			];
			if ($this->TahunAktifModel->save($data)) {
				session()->setFlashdata('success', 'Data berhasil disimpan');
				return redirect()->to('http://localhost:8080/admin/kelola_tahun_aktif');
			}
		}
	}

	public function check_tahun()
	{
		if ($this->TahunAktifModel->where('tahun_aktif', $this->request->getPost('tahun_aktif'))->countAllResults()) {
			$data = ['status' => true];
		} else {
			$data = ['status' => false];
		}
		return json_encode($data);
	}
}
