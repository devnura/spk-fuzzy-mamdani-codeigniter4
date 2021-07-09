<?php

namespace App\Controllers;

use App\Models\KeluargaModel;
use App\Models\FuzzyfikasiModel;
use App\Models\ImplikasiModel;
use App\Models\komposisiModel;
use App\Models\DefuzzyfikasiModel;
use App\Models\KriteriaModel;
use App\Models\KategoriModel;
use App\Models\SubKriteriaModel;
use App\Models\HasilIndikatorModel;
use App\Models\HasilModel;
use App\Models\IndikatorModel;
use SebastianBergmann\Diff\Chunk;

class Fuzzy_mamdani extends BaseController
{
	protected $Keluarga;
	protected $Fuzzyfikasi;
	protected $Implikasi;
	protected $Komposisi;
	protected $Defuzzyfikasi;
	protected $Kriteria;
	protected $Kategori;
	protected $Sub_kriteria;
	protected $HasilIndikatorModel;
	protected $HasilModel;
	protected $IndikatorModel;

	public function __construct()
	{
		$this->Keluarga = new KeluargaModel();
		$this->Fuzzyfikasi = new FuzzyfikasiModel();
		$this->Implikasi = new ImplikasiModel();
		$this->Komposisi = new KomposisiModel();
		$this->Defuzzyfikasi = new DefuzzyfikasiModel();
		$this->Sub_kriteria = new SubkriteriaModel();
		$this->Kriteria = new KriteriaModel();
		$this->Kategori = new KategoriModel();
		$this->HasilIndikatorModel = new HasilIndikatorModel();
		$this->HasilModel = new HasilModel();
		$this->IndikatorModel = new IndikatorModel();
	}


	public function hitung_nilai($id_pendataan)
	{
		$data = [];
		$rekapitulasi = [];
		$datakriteria = $this->Kriteria->where('keterangan', 'input')->findAll();
		$datakategori = $this->Kategori->join('kriteria', 'kriteria.id_kriteria=kategori.id_kriteria')->where('kriteria.keterangan', 'input')->findAll();
		$indikator = $this->IndikatorModel->findAll();
		$hasil_indikator = $this->HasilIndikatorModel->where('id_pendataan', $id_pendataan)->findAll();

		for ($i = 0; $i < count($indikator); $i++) {
			if ($hasil_indikator[$i]['id_indikator'] == (1 + $i)) {
				$data[$indikator[$i]['id_indikator']] = $this->HasilIndikatorModel
					->select('hasil_indikator.id_indikator')
					->select('jawaban')
					->select('indikator')
					->select('id_kriteria')
					->where('id_pendataan', $id_pendataan)
					->where('hasil_indikator.id_indikator', (1 + $i))
					->join('indikator', 'indikator.id_indikator=hasil_indikator.id_indikator')
					->findColumn('jawaban', 'infikator.id_kriteria');
				$rekapitulasi[$i] = array_count_values($data[$indikator[$i]['id_indikator']]);

				if (isset($rekapitulasi[$i]['T'])) {
					$nilai[$i] = [
						'id_kriteria' => $indikator[$i]['id_kriteria'],
						'id_indikator' => $indikator[$i]['id_indikator'],
						'indikator' => $indikator[$i]['indikator'],
						'hasil' => 'T',
						'nilai' => '0'
					];
				} else if (isset($rekapitulasi[$i]['Y'])) {
					$nilai[$i] = [
						'id_kriteria' => $indikator[$i]['id_kriteria'],
						'id_indikator' => $indikator[$i]['id_indikator'],
						'indikator' => $indikator[$i]['indikator'],
						'hasil' => 'Y',
						'nilai' => '1'
					];
				} else if (!isset($rekapitulasi[$i]['T']) && !isset($rekapitulasi[$i]['Y'])) {
					$nilai[$i] = [
						'id_kriteria' => $indikator[$i]['id_kriteria'],
						'id_indikator' => $indikator[$i]['id_indikator'],
						'indikator' => $indikator[$i]['indikator'],
						'hasil' => 'N',
						'nilai' => 'N'
					];
				}
			}
		}
		for ($i = 0; $i < count($datakriteria); $i++) {
			for ($j = 0; $j < count($nilai); $j++) {
				if ($datakriteria[$i]['id_kriteria'] == $nilai[$j]['id_kriteria']) {
					$nilai_kriteria[$i][$j] = $nilai[$j]['nilai'];
				}
			}
			$hasil[$i] = array_count_values($nilai_kriteria[$i]);

			if (isset($hasil[$i]['N'])) {
				$n = $hasil[$i]['N'];
			} else {
				$n = 0;
			}

			if (isset($hasil[$i]['1'])) {
				$nilai1 = $hasil[$i]['1'];
			} else {
				$nilai1 = 0;
			}

			$pembagi = (float)  10 * ($nilai1 + $n);

			$y[$i] = [
				'id_kriteria' => $datakriteria[$i]['id_kriteria'],
				'nilai' => $pembagi
			];
		}
		$z[0] = $y[1];
		$z[1] = $y[0];
		// dd($z, $hasil);
		return $this->step_fuzzyfikasi($z, $id_pendataan, $datakriteria, $datakategori);
	}

	public function step_fuzzyfikasi($z, $id_pendataan, $datakriteria, $datakategori)
	{
		$nilai = [];
		for ($j = 0; $j < count($z); $j++) {
			for ($k = 0; $k < count($datakategori); $k++) {
				# code...
				if ($z[$j]['id_kriteria'] == $datakategori[$k]['id_kriteria']) {
					if ($datakategori[$k]['type'] == '1') {
						$y = $this->bahu_kiri($datakategori[$k]['left_side'], $datakategori[$k]['mid'], $datakategori[$k]['right_side'], $z[$j]['nilai']);
					} else if ($datakategori[$k]['type'] == '2') {
						$y = $this->segitiga($datakategori[$k]['left_side'], $datakategori[$k]['mid'], $datakategori[$k]['right_side'], $z[$j]['nilai']);
					} else if ($datakategori[$k]['type'] == '3') {
						$y = $this->bahu_kanan($datakategori[$k]['left_side'], $datakategori[$k]['mid'], $datakategori[$k]['right_side'], $z[$j]['nilai']);
					}
					array_push($nilai, [
						'id_pendataan' => $id_pendataan,
						'id_kriteria' => $z[$j]['id_kriteria'],
						'id_kategori' => $datakategori[$k]['id_kategori'],
						'nilai' => $y
					]);
				}
			}
		}
		// dd($nilai);
		$this->Fuzzyfikasi->insertBatch($nilai);
		return $this->step_implikasi($id_pendataan, $datakriteria, $nilai);
	}

	public function step_implikasi($id_pendataan, $datakriteria, $nilai)
	{
		$predikat = [];
		for ($i = 0; $i < count($datakriteria); $i++) {
			$data[$i] = [];
		}
		for ($j = 0; $j < count($data); $j++) {
			for ($i = 0; $i < count($nilai); $i++) {
				if ($nilai[$i]['id_kriteria'] == $datakriteria[$j]['id_kriteria']) {
					array_push($data[$j], $nilai[$i]);
				}
			}
		}
		if (count($data) == 2) {
			for ($i = 0; $i < count($data[0]); $i++) {
				for ($j = 0; $j < count($data[1]); $j++) {
					array_push($predikat, ['id_pendataan' => $id_pendataan, 'nilai_implikasi' => min($data[0][$i]['nilai'], $data[1][$j]['nilai'])]);
				}
			}
		} else	if (count($data) == 3) {
			for ($i = 0; $i < count($data[0]); $i++) {
				for ($j = 0; $j < count($data[1]); $j++) {
					for ($k = 0; $k < count($data[2]); $k++) {
						array_push($predikat, ['id_pendataan' => $id_pendataan, 'nilai_implikasi' => min($data[0][$i]['nilai'], $data[1][$j]['nilai']), $data[2][$k]['nilai']]);
					}
				}
			}
		}
		// dd($data[0], $data[1], $predikat);
		$this->Implikasi->insertBatch($predikat);
		return $this->step_komposisi($predikat, $id_pendataan);
	}

	public function step_komposisi($data, $id_pendataan)
	{
		$nilai = [];
		$kategorioutput = $this->Kategori->join('kriteria', 'kriteria.id_kriteria=kategori.id_kriteria')->where('kriteria.keterangan', 'output')->findAll();
		if (count($kategorioutput) == 2) {
			$keanggotaan['n1'] = (float) max($data[0]['nilai_implikasi'], $data[2]['nilai_implikasi']);
			$keanggotaan['n2'] = (float) max($data[1]['nilai_implikasi'], $data[3]['nilai_implikasi']);
		} else if (count($kategorioutput) == 3) {
			$keanggotaan['n1'] = (float) max($data[0]['nilai_implikasi'], $data[3]['nilai_implikasi'], $data[6]['nilai_implikasi']);
			$keanggotaan['n2'] = (float) max($data[1]['nilai_implikasi'], $data[4]['nilai_implikasi'], $data[7]['nilai_implikasi']);
			$keanggotaan['n3'] = (float) max($data[2]['nilai_implikasi'], $data[5]['nilai_implikasi'], $data[8]['nilai_implikasi']);
			if (max($keanggotaan) == $keanggotaan['n1']) {

				if (($keanggotaan['n1'] == 1) || ((($keanggotaan['n1'] > 0) && ($keanggotaan['n1'] < 1)) && (($keanggotaan['n2'] == 0) && ($keanggotaan['n3'] == 0)))) {
					$nilai['nilai_a1'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' => $this->x_decreased($kategorioutput[0]['left_side'], $kategorioutput[0]['mid'], $kategorioutput[0]['right_side'], $keanggotaan['n1'])
					];
					$nilai['nilai_a2'] = [
						'id_pendataan' =>  $id_pendataan,
						'nilai' =>  $this->x_decreased($kategorioutput[0]['left_side'], $kategorioutput[0]['mid'], $kategorioutput[0]['right_side'], $keanggotaan['n2'])
					];
				} else {
					$nilai['nilai_a1'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' => $this->x_decreased($kategorioutput[0]['left_side'], $kategorioutput[0]['mid'], $kategorioutput[0]['right_side'], $keanggotaan['n1'])
					];
					$nilai['nilai_a2'] = [
						'id_pendataan' =>  $id_pendataan,
						'nilai' =>  $this->x_decreased($kategorioutput[0]['left_side'], $kategorioutput[0]['mid'], $kategorioutput[0]['right_side'], $keanggotaan['n2'])
					];
					$nilai['nilai_a3'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' =>  $this->x_decreased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n2'])
					];
					$nilai['nilai_a4'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' =>  $this->x_decreased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n3'])
					];
				}
			} else if (max($keanggotaan) == $keanggotaan['n2']) {
				# code... 
				if ($keanggotaan['n2'] == 1) {
					$nilai['nilai_a1'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' => $this->x_increased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n1'])
					];
					$nilai['nilai_a2'] = [
						'id_pendataan' =>  $id_pendataan,
						'nilai' =>  $this->x_increased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n2'])
					];
					$nilai['nilai_a3'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' =>   $this->x_decreased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n3'])
					];
				} else if (($keanggotaan['n2'] > 0) && ($keanggotaan['n2'] < 1) && ($keanggotaan['n1'] == 0) && ($keanggotaan['n3'] == 0)) {
					$nilai['nilai_a1'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' => $this->x_increased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n1'])
					];
					$nilai['nilai_a2'] = [
						'id_pendataan' =>  $id_pendataan,
						'nilai' =>  $this->x_increased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n2'])
					];
					$nilai['nilai_a3'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' =>   $this->x_decreased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n2'])
					];
					$nilai['nilai_a4'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' =>   $this->x_decreased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n3'])
					];
				} else if ($keanggotaan['n1'] != 0) {
					$nilai['nilai_a1'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' => $this->x_increased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n1'])
					];
					$nilai['nilai_a2'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' => $this->x_increased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n2'])
					];
					$nilai['nilai_a3'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' => $this->x_decreased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n2'])
					];
					$nilai['nilai_a4'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' => $this->x_decreased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n3'])
					];
				} else if ($keanggotaan['n3'] != 0) {
					$nilai['nilai_a1'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' => $this->x_increased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n1'])
					];
					$nilai['nilai_a2'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' => $this->x_increased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n2'])
					];
					$nilai['nilai_a3'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' => $this->x_decreased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n2'])
					];
					$nilai['nilai_a4'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' => $this->x_decreased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n3'])
					];
				}
			} else if (max($keanggotaan) == $keanggotaan['n3']) {
				# code... 
				if (($keanggotaan['n3'] == 1) || ((($keanggotaan['n3'] > 0) && ($keanggotaan['n3'] < 1)) && (($keanggotaan['n1'] == 0) && ($keanggotaan['n2'] == 0)))) {
					$nilai['nilai_a1'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' => $this->x_increased($kategorioutput[2]['left_side'], $kategorioutput[2]['mid'], $kategorioutput[2]['right_side'], $keanggotaan['n2'])
					];
					$nilai['nilai_a2'] = [
						'id_pendataan' =>  $id_pendataan,
						'nilai' =>  $this->x_increased($kategorioutput[2]['left_side'], $kategorioutput[2]['mid'], $kategorioutput[2]['right_side'], $keanggotaan['n3'])
					];
				} else {
					$nilai['nilai_a1'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' => $this->x_increased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n1'])
					];
					$nilai['nilai_a2'] = [
						'id_pendataan' =>  $id_pendataan,
						'nilai' =>  $this->x_increased($kategorioutput[1]['left_side'], $kategorioutput[1]['mid'], $kategorioutput[1]['right_side'], $keanggotaan['n2'])
					];
					$nilai['nilai_a3'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' =>  $this->x_increased($kategorioutput[2]['left_side'], $kategorioutput[2]['mid'], $kategorioutput[2]['right_side'], $keanggotaan['n2'])
					];
					$nilai['nilai_a4'] = [
						'id_pendataan' => $id_pendataan,
						'nilai' =>  $this->x_increased($kategorioutput[2]['left_side'], $kategorioutput[2]['mid'], $kategorioutput[2]['right_side'], $keanggotaan['n3'])
					];
				}
			}
		}
		// dd($nilai);
		$this->Komposisi->insertBatch($nilai);
		return $this->step_deffuzzyfikasi($nilai, $id_pendataan, $keanggotaan, $kategorioutput);
	}

	public function step_deffuzzyfikasi($nilai, $id_pendataan, $keanggotaan, $kategorioutput)
	{
		if (max($keanggotaan) == $keanggotaan['n1']) {
			if (($keanggotaan['n1'] == 1) || ((($keanggotaan['n1'] > 0) && ($keanggotaan['n1'] < 1)) && (($keanggotaan['n2'] == 0) && ($keanggotaan['n3'] == 0)))) {
				$momen = [
					$this->integral($nilai['nilai_a1']['nilai'], $kategorioutput[0]['left_side'], $keanggotaan['n1']),
					$this->integral_decreased($nilai['nilai_a2']['nilai'], $nilai['nilai_a1']['nilai'], $kategorioutput[0]['right_side'], ($kategorioutput[0]['right_side'] - $kategorioutput[0]['mid'])),
				];
				$luas = [
					$this->luas($nilai['nilai_a2']['nilai'], $kategorioutput[0]['left_side'], $keanggotaan['n1']),
					$this->luas_trapesium($keanggotaan['n1'], $keanggotaan['n2'], $nilai['nilai_a1']['nilai'], $nilai['nilai_a2']['nilai']),
				];
			} else {
				$momen = [
					$this->integral($nilai['nilai_a1']['nilai'], $kategorioutput[0]['left_side'], $keanggotaan['n1']),
					$this->integral_decreased($nilai['nilai_a2']['nilai'], $nilai['nilai_a1']['nilai'], $kategorioutput[0]['right_side'], ($kategorioutput[0]['right_side'] - $kategorioutput[0]['mid'])),
					$this->integral($nilai['nilai_a3']['nilai'], $nilai['nilai_a2']['nilai'], $keanggotaan['n2']),
					$this->integral_decreased($nilai['nilai_a4']['nilai'], $nilai['nilai_a3']['nilai'], $kategorioutput[1]['right_side'], ($kategorioutput[1]['right_side'] - $kategorioutput[1]['mid'])),
				];
				$luas = [
					$this->luas($nilai['nilai_a1']['nilai'], $kategorioutput[0]['left_side'], $keanggotaan['n1']),
					$this->luas_trapesium($keanggotaan['n1'], $keanggotaan['n2'], $nilai['nilai_a2']['nilai'], $nilai['nilai_a1']['nilai']),
					$this->luas($nilai['nilai_a3']['nilai'], $nilai['nilai_a2']['nilai'], $keanggotaan['n2']),
					$this->luas_trapesium($keanggotaan['n2'], $keanggotaan['n3'], $nilai['nilai_a4']['nilai'], $nilai['nilai_a3']['nilai']),
				];
			}
		} else if (max($keanggotaan) == $keanggotaan['n2']) {
			// dd($nilai);
			if ($keanggotaan['n2'] == 1) {
				$momen = [
					$this->integral_increased($nilai['nilai_a2']['nilai'], $nilai['nilai_a1']['nilai'], $kategorioutput[1]['left_side'], ($kategorioutput[1]['mid'] - $kategorioutput[1]['left_side'])),
					$this->integral_decreased($nilai['nilai_a3']['nilai'], $nilai['nilai_a2']['nilai'], $kategorioutput[1]['right_side'], ($kategorioutput[1]['right_side'] - $kategorioutput[1]['mid'])),
				];
				$luas = [
					$this->luas_trapesium($keanggotaan['n1'], $keanggotaan['n2'], $nilai['nilai_a1']['nilai'], $nilai['nilai_a2']['nilai']),
					$this->luas_trapesium($keanggotaan['n2'], $keanggotaan['n3'], $nilai['nilai_a2']['nilai'], $nilai['nilai_a3']['nilai']),
				];
			} else if (($keanggotaan['n2'] > 0) && ($keanggotaan['n2'] < 1) && ($keanggotaan['n1'] == 0) && ($keanggotaan['n3'] == 0)) {
				$momen = [
					$this->integral_increased($nilai['nilai_a2']['nilai'], $nilai['nilai_a1']['nilai'], $kategorioutput[1]['left_side'], ($kategorioutput[1]['mid'] - $kategorioutput[1]['left_side'])),
					$this->integral($nilai['nilai_a3']['nilai'], $nilai['nilai_a2']['nilai'], $keanggotaan['n2']),
					$this->integral_decreased($nilai['nilai_a4']['nilai'], $nilai['nilai_a3']['nilai'], $kategorioutput[1]['right_side'], ($kategorioutput[1]['right_side'] - $kategorioutput[1]['mid'])),

				];
				$luas = [
					$this->luas_trapesium($keanggotaan['n1'], $keanggotaan['n2'], $nilai['nilai_a1']['nilai'], $nilai['nilai_a2']['nilai']),
					$this->luas($nilai['nilai_a3']['nilai'], $nilai['nilai_a2']['nilai'], $keanggotaan['n2']),
					$this->luas_trapesium($keanggotaan['n2'], $keanggotaan['n3'], $nilai['nilai_a3']['nilai'], $nilai['nilai_a4']['nilai']),
				];
			} else if ($keanggotaan['n1'] != 0) {

				$momen = [
					$this->integral($nilai['nilai_a1']['nilai'], $kategorioutput[0]['left_side'], $keanggotaan['n1']),
					$this->integral_increased($nilai['nilai_a2']['nilai'], $nilai['nilai_a1']['nilai'], $kategorioutput[1]['left_side'], ($kategorioutput[1]['mid'] - $kategorioutput[1]['left_side'])),
					$this->integral($nilai['nilai_a3']['nilai'], $nilai['nilai_a2']['nilai'], $keanggotaan['n2']),
					$this->integral_decreased($nilai['nilai_a4']['nilai'], $nilai['nilai_a3']['nilai'], $kategorioutput[1]['right_side'], ($kategorioutput[1]['right_side'] - $kategorioutput[1]['mid'])),
				];
				$luas = [
					$this->luas($nilai['nilai_a1']['nilai'], $kategorioutput[0]['left_side'], $keanggotaan['n1']),
					$this->luas_trapesium($keanggotaan['n1'], $keanggotaan['n2'], $nilai['nilai_a1']['nilai'], $nilai['nilai_a2']['nilai']),
					$this->luas($nilai['nilai_a3']['nilai'], $nilai['nilai_a2']['nilai'], $keanggotaan['n2']),
					$this->luas_trapesium($keanggotaan['n2'], $keanggotaan['n3'], $nilai['nilai_a3']['nilai'], $nilai['nilai_a4']['nilai']),
				];
			} else if ($keanggotaan['n3'] != 0) {
				$momen = [
					$this->integral_increased($nilai['nilai_a2']['nilai'], $nilai['nilai_a1']['nilai'], $kategorioutput[1]['left_side'], ($kategorioutput[1]['mid'] - $kategorioutput[1]['left_side'])),
					$this->integral($nilai['nilai_a3']['nilai'], $nilai['nilai_a2']['nilai'], $keanggotaan['n2']),
					$this->integral_decreased($nilai['nilai_a4']['nilai'], $nilai['nilai_a3']['nilai'], $kategorioutput[1]['right_side'], ($kategorioutput[1]['right_side'] - $kategorioutput[1]['mid'])),
					$this->integral($kategorioutput[2]['right_side'], $nilai['nilai_a4']['nilai'], $keanggotaan['n2']),
				];
				$luas = [
					$this->luas_trapesium($keanggotaan['n1'], $keanggotaan['n2'], $nilai['nilai_a1']['nilai'], $nilai['nilai_a2']['nilai']),
					$this->luas($nilai['nilai_a1']['nilai'], $kategorioutput[0]['left_side'], $keanggotaan['n2']),
					$this->luas_trapesium($keanggotaan['n2'], $keanggotaan['n3'], $nilai['nilai_a3']['nilai'], $nilai['nilai_a4']['nilai']),
					$this->luas($nilai['nilai_a3']['nilai'], $nilai['nilai_a2']['nilai'], $keanggotaan['n2']),
				];
			}
		} else if (max($keanggotaan) == $keanggotaan['n3']) {
			if (($keanggotaan['n3'] == 1) || ((($keanggotaan['n3'] > 0) && ($keanggotaan['n3'] < 1)) && (($keanggotaan['n1'] == 0) && ($keanggotaan['n2'] == 0)))) {
				$momen = [
					$this->integral_increased($nilai['nilai_a2']['nilai'], $nilai['nilai_a1']['nilai'], $kategorioutput[2]['left_side'], ($kategorioutput[2]['mid'] - $kategorioutput[2]['left_side'])),
					$this->integral($kategorioutput[2]['right_side'], $nilai['nilai_a2']['nilai'], $keanggotaan['n3']),
				];
				$luas = [
					$this->luas_trapesium($keanggotaan['n2'], $keanggotaan['n3'], $nilai['nilai_a1']['nilai'], $nilai['nilai_a2']['nilai']),
					$this->luas($kategorioutput[2]['right_side'], $nilai['nilai_a2']['nilai'], $keanggotaan['n3']),
				];
			} else {
				$momen = [
					$this->integral_increased($nilai['nilai_a2']['nilai'], $nilai['nilai_a1']['nilai'], $kategorioutput[1]['left_side'], ($kategorioutput[1]['mid'] - $kategorioutput[1]['left_side'])),
					$this->integral($nilai['nilai_a3']['nilai'], $nilai['nilai_a2']['nilai'], $keanggotaan['n2']),
					$this->integral_increased($nilai['nilai_a4']['nilai'], $nilai['nilai_a3']['nilai'], $kategorioutput[2]['left_side'], ($kategorioutput[2]['right_side'] - $kategorioutput[2]['mid'])),
					$this->integral($kategorioutput[2]['right_side'], $nilai['nilai_a4']['nilai'], $keanggotaan['n3']),
				];
				$luas = [
					$this->luas_trapesium($keanggotaan['n1'], $keanggotaan['n2'], $nilai['nilai_a1']['nilai'], $nilai['nilai_a2']['nilai']),
					$this->luas($nilai['nilai_a2']['nilai'], $nilai['nilai_a1']['nilai'], $keanggotaan['n2']),
					$this->luas_trapesium($keanggotaan['n2'], $keanggotaan['n3'], $nilai['nilai_a3']['nilai'], $nilai['nilai_a4']['nilai']),
					$this->luas($kategorioutput[2]['right_side'], $nilai['nilai_a4']['nilai'], $keanggotaan['n3']),
				];
			}
		}
		for ($i = 0; $i < count($luas); $i++) {
			$data[$i] = [
				'id_pendataan' => $id_pendataan, 'luas' => $luas[$i], 'momen' => $momen[$i]
			];
		}
		$hasil = [
			'id_pendataan' => $id_pendataan, 'nilai' => $this->cog(array_column($data, 'momen'), array_column($data, 'luas'))
		];
		// dd($keanggotaan, $hasil, $data);
		if ($this->Defuzzyfikasi->insertBatch($data)) {
			if ($this->HasilModel->insert($hasil)) {
				return redirect()->to('http://localhost:8080/pendataan_keluarga/change_status/' . $id_pendataan);
			}
		}
	}

	// -------------------------------------------------------------------
	// rumus-rumus
	// -------------------------------------------------------------------

	public function bahu_kiri($a, $b, $c, $nilai)
	{
		if ($nilai <= $b) {
			$data = 1;
		}
		if ($nilai >= $b && $nilai <= $c) {
			$data = round(($c - $nilai) / ($c - $b), 3);
		}
		if ($nilai >= $c) {
			$data = 0;
		}
		return $data;
	}

	public function bahu_kanan($a, $b, $c, $nilai)
	{
		if ($nilai <= $a) {
			$data = 0;
		}
		if ($nilai >= $a && $nilai <= $b) {
			$data = round(($nilai - $a) / ($b - $a), 3);
		}
		if ($nilai >= $b) {
			$data = 1;
		}
		return $data;
	}

	public function segitiga($a, $b, $c, $nilai)
	{
		if ($nilai <= $a || $nilai >= $c) {
			$data = 0;
		}
		if ($nilai >= $a && $nilai <= $b) {
			$data = round(($nilai - $a) / ($b - $a), 3);
		}
		if ($nilai >= $b && $nilai <= $c) {
			$data = round(($c - $nilai) / ($c - $b), 3);
		}
		return $data;
	}

	public function x_increased(float $a = null, float $b = null, float $c = null, float $y = null)
	{
		return round($a + (($b - $a) * $y), 2);
	}
	public function x_decreased(float $a = null, float $b = null, float $c = null, float $y = null)
	{
		return round($c - (($c - $b) * $y), 2);
	}

	public function integral(float $batas_atas, float $batas_bawah, float $n)
	{
		$nilai = ($n * (pow($batas_atas, 2) / 2)) - ($n * (pow($batas_bawah, 2) / 2));
		return round($nilai, 2);
	}

	public function integral_decreased(float $batas_atas, float $batas_bawah, float $penyebut, float $pembagi)
	{
		$nilai = ((($penyebut / ($pembagi * 2)) * (pow($batas_atas, 2))) - ((pow($batas_atas, 3)) / ($pembagi * 3))) - ((($penyebut / ($pembagi * 2)) * (pow($batas_bawah, 2))) - ((pow($batas_bawah, 3)) / ($pembagi * 3)));
		return round($nilai, 2);
	}
	public function integral_increased(float $batas_atas, float $batas_bawah, float $penyebut, float $pembagi)
	{
		$nilai = (((pow($batas_atas, 3)) / ($pembagi * 3)) - ((pow($batas_atas, 2) * $penyebut) / ($pembagi * 2))) - (((pow($batas_bawah, 3)) / ($pembagi * 3)) - ((pow($batas_bawah, 2) * $penyebut) / ($pembagi * 2)));
		// echo round($nilai, 2);
		return round($nilai, 2);
	}
	public function luas(float $batas_atas, float $batas_bawah, $n)
	{
		$nilai = ($n * $batas_atas) - ($n * $batas_bawah);
		return round($nilai, 2);
	}
	public function luas_trapesium(float $ta, float $tb, float $sa, float $sb)
	{
		$nilai = (($ta + $tb) * ($sb - $sa)) / 2;
		return round($nilai, 2);
	}
	public function cog($momen, $luas)
	{
		$data = array_sum($momen) / array_sum($luas);
		return round($data, 2);
	}
}
