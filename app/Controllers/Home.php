<?php

namespace App\Controllers;

class Home extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->client = \Config\Services::curlrequest();
	}


	public function index()

	{	
		$listeContact = $this->client->request('POST', 'http://contact/api', [
			'form_params' => [
				'paginate' => 10,
				'type' => '',
				'elements' => '',
			]
		]);

		$contacts = json_decode($listeContact->getBody());

		$data = [
			'contacts' => $contacts
		];

		//dd($contacts);

		echo view('common/HeaderSite');
		echo view('Site/Index', $data);
		echo view('common/FooterSite');
		
	}








}
