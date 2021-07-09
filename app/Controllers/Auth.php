<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
	protected $userMmodel;
	protected $admin;
	protected $is_logedin;

	public function __construct()
	{
		$this->userModel = new AuthModel();
		$this->admin = false;
		$this->is_logedin = false;
	}

	public function index()
	{
		if (session('is_login') == true) {
			return redirect()->to('/home');
		}
		// $data = $this->userModel->get_user();
		$data = [
			'validation' => \Config\Services::validation()
		];
		return view('auth/login', $data);
	}

	//--------------------------------------------------------------------
	// Untuk authentikasi 
	//--------------------------------------------------------------------

	public function login()
	{
		if (!$this->validate([
			'username' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field}/email harus diisi'
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi'
				]
			],
		])) {
			$validation = \config\Services::validation();
			return redirect()->to('/auth')->withInput()->with('validation', $validation);
		} else {
			// jika validasi sukses
			$data = [
				'username' => $this->request->getPost('username'),
				'password' => $this->request->getPost('password')
			];

			// cari berdasarkan username dan email
			$cek = $this->userModel->where('email', $data['username'])->findAll();
			if ($cek) {
				if (password_verify($data['password'], $cek['0']['password'])) {
					session()->set('id', $cek['0']['id']);
					session()->set('name', $cek['0']['name']);
					session()->set('email', $cek['0']['email']);
					session()->set('level', $cek['0']['level']);
					session()->set('is_login', true);
					session()->setFlashdata('welcome', 'Selamat Datang');
					return redirect()->to('/home');
				} else {
					$validation = \config\Services::validation();
					session()->setFlashdata('failed_password', 'Password tidak cocok');
					return redirect()->to('/auth')->withInput()->with('validation', $validation);
				}
			} else {
				$validation = \config\Services::validation();
				session()->setFlashdata('failed_username', 'Username tidak ditemukan');
				return redirect()->to('/auth')->withInput()->with('validation', $validation);
			}
		}
	}

	public function log_out()
	{
		session()->destroy();
		return redirect()->to('/auth');
	}

	public function test()
	{
		$data = ['admin@admin.com'];
		dd($this->userModel->where('email', $data)->findAll());
	}
}
