<?php

namespace App\Controllers;

use App\Models\KeluargaModel;
use App\Models\AnggotaKeluargaModel;
use App\Models\TahunAktifModel;
use App\Models\PendataanModel;
use CodeIgniter\Session\Session;

class Pendataan_keluarga extends BaseController
{
	//--------------------------------------------------------------------
	// Properti controler data keluarga
	//--------------------------------------------------------------------

	protected $Keluarga;
	protected $AnggotaKeluarga;
	protected $Pendataan;
	protected $TahunAktifModel;
	//--------------------------------------------------------------------
	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// Controler pendataan keluarga
	//--------------------------------------------------------------------

	public function __construct()
	{
		$this->Keluarga = new KeluargaModel();
		$this->AnggotaKeluarga = new AnggotaKeluargaModel();
		$this->Pendataan = new PendataanModel();
		$this->TahunAktifModel = new TahunAktifModel();
	}



	public function index()
	{
		$data = [
			'page' => 'pendataankeluarga',
			'title' => 'Pendataan keluarga',
			'kelurahan' => $this->Daerah->findAll(),
			'keluarga' => $this->Keluarga->findAll()
		];

		return view('keluargasehat/data_keluarga', $data);
	}

	public function keluarga($nkk)
	{
		$data = [
			'page' => 'pendataankeluarga',
			'title' => 'Pendataan keluarga',
			'form_action' => 'http://localhost:8080/pendataan_keluarga/add/' . $nkk,
			'validation' => \Config\Services::validation(),
			'data_pendataan' => $this->Pendataan->where('nkk', $nkk)->findAll()
		];
		return view('keluargasehat/pendataan_keluarga', $data);
	}
	public function add()
	{
		$data = [
			'nkk' => $this->request->getPost('nkk'),
			'tgl_pendataan' => $this->request->getPost('tgl_pendataan'),
			'id_user' => session('id'),
			'tahun_aktif' =>  $this->request->getPost('tahun_aktif'),
			'status_pendataan' => '0'
		];
		// dd($data);
		if ($this->Pendataan->insert($data)) {
			return redirect()->to('http://localhost:8080/Profilkesehatan/indikator/' . $data['nkk'] . '/' . $this->Pendataan->getInsertID());
		}
	}

	public function change_status($id_pendataan)
	{
		$data = [
			'status_pendataan' => '1'
		];
		$this->Pendataan->update($id_pendataan, $data);
		return redirect()->to('http://localhost:8080/Profilkesehatan/');
	}

	public function delete($nkk, $id)
	{
		$this->Pendataan->delete(array('id_pendataan' => $id));;
		session()->setFlashdata('success_delete', 'Data berhasil dihapus');
		return redirect()->to('http://localhost:8080/pendataan_keluarga/keluarga/' . $nkk);
	}
	public function check_pendataan()
	{
		$data = $this->Pendataan->where('nkk', $this->request->getPost('nkk'))->where('tahun_aktif', $this->request->getPost('tahun_aktif'))->countAllResults();
		if ($data > 0) {
			$result = ['status' => true];
		} else {
			$result = ['status' => false];
		}
		return json_encode($result);
	}
}
