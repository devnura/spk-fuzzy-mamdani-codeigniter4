<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function __construct()
	{
	}

	public function index()
	{
		$data = [
			'page' => 'home'
		];
		return view('dashboard', $data);
	}

	//--------------------------------------------------------------------

}
