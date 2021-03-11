<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{	
		echo view('common/HeaderSite');
		echo view('Site/Index');
		echo view('common/FooterSite');
	}
}
